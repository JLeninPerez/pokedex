<?php

namespace App\Services;

use App\Exceptions\GenericException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class PokedexService
{
    /**
     * @var
     */
    public $config;

    /**
     * @var Client
     */
    private $client;

    /**
     * Const
     */
    const MAX_LIMIT = 898;
    const DEFAULT_LIMIT = 10;

    /**
     * PokedexService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->config = config('app.service');
    }

    /**
     * @return array
     */
    public function getRandomList() : array
    {
        $randomList = $this->buildRandomList();
        Cache::put('randomList', $randomList);
        return $randomList;
    }

    /**
     * @param string $pokemonName
     * @return array
     * @throws GenericException
     */
    public function getPokemon(string $pokemonName) : array
    {
        $info = $this->sendRequest("/pokemon/$pokemonName", true);

        return array_key_exists('results', $info) ?
            $this->filterList($info['results'], $pokemonName) :
            self::filterResponse($info);
    }

    /**
     * @return array
     * @throws GenericException
     */
    private function buildRandomList() : array
    {
        $information = [];
        $response = $this->sendRequest('/pokemon/?limit=' . self::MAX_LIMIT);

        foreach (self::generateRandomNumbers() as $number) {
            $information[] = $response['results'][$number];
        }

        return self::filterList($information);
    }

    /**
     * @return array
     */
    private static function generateRandomNumbers() : array
    {
        $numbers = [];

        while (count($numbers) < self::DEFAULT_LIMIT) {
            $number = rand(0, self::MAX_LIMIT - 1);

            if (!in_array($number, $numbers)) {
                $numbers[] = $number;
            }
        }

        return $numbers;
    }

    /**
     * @param string $endpoint
     * @param bool $skipException
     * @return array
     * @throws GenericException
     */
    private function sendRequest(string $endpoint, bool $skipException = false) : array
    {
        try {
            $response = $this->client->get($this->config['pokedex'] . $endpoint);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            if ($skipException && $e->getCode() === 404) {
                return $this->sendRequest('/pokemon/?limit=' . self::MAX_LIMIT);
            }

            throw new GenericException(trans('pokemon'));
        }
    }

    /**
     * @param array $pokemonInfo
     * @return array
     */
    private static function filterResponse(array $pokemonInfo) : array
    {
        return [
            'id' => $pokemonInfo['id'],
            'name' => ucwords($pokemonInfo['name']),
            'experience' => $pokemonInfo['base_experience'],
            'type' => $pokemonInfo['types'],
            'image' => $pokemonInfo['sprites']['other']['official-artwork']['front_default'],
        ];
    }

    /**
     * @param array $pokemonList
     * @param string $keyword
     * @return array
     * @throws GenericException
     */
    private function filterList(array $pokemonList, string $keyword = '') : array
    {
        $information = [];

        foreach ($pokemonList as $list) {
            if (empty($keyword) || self::validateString($list['name'], $keyword)) {
                $pokemonId = explode('/', $list['url'])[6];

                $information[] = [
                    'id' => $pokemonId,
                    'name' => $list['name'],
                    'image' => $this->config['image'] . "/$pokemonId.png",
                    'url' => '/pokedex/id/' . $pokemonId,
                ];
            }
        }

        if (empty($information)) {
            throw new GenericException('pokemon');
        }

        return $information;
    }

    /**
     * @param string $pokemonName
     * @param string $keyword
     * @return bool
     */
    private static function validateString(string $pokemonName, string $keyword) : bool
    {
        return strpos($pokemonName, $keyword) !== false;
    }
}
