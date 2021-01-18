<?php

namespace App\Http\Controllers;

use App\Services\PokedexService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PokedexController extends Controller
{

    /**
     * @var PokedexService
     */
    private $service;

    /**
     * @var Request
     */
    private $request;

    /**
     * PokedexController constructor.
     * @param Request $request
     * @param PokedexService $service
     */
    public function __construct(Request $request, PokedexService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $randomList = $this->service->getRandomList();
        return view('home')->with(['pokemons' => $randomList]);

    }

    /**
     * @param string $pokemonId
     * @return View
     */
    public function getInfoById(string $pokemonId): View
    {
        $pokemon = $this->service->getPokemon($pokemonId);
        return view('info')->with(['pokemons' => $pokemon]);
    }

    /**
     * @return View
     */
    public function getInfoByName(): View
    {
        $pokemonName = $this->request->input('pokemonName');

        $validator = Validator::make(['pokemonName' => $pokemonName], [
            'pokemonName' => 'required|alpha',
        ]);

        if ($validator->fails()) {
            return view('home')->with(['pokemons' => Cache::get('randomList'), 'alert' => true]);
        }

        $pokemon = $this->service->getPokemon(strtolower($pokemonName));
        $view = isset($pokemon['type']) ? 'info' : 'home';
        return view($view)->with(['pokemons' => $pokemon]);
    }
}
