<?php

namespace Tests\Feature\Service;

use App\Services\PokedexService;
use Tests\TestCase;

class PokedexServiceTest extends TestCase
{
    public function testGetRandomListWithSuccessStructure()
    {
        $service = (new PokedexService())->getRandomList()[0];
        $this->assertArrayHasKey('id', $service);
        $this->assertArrayHasKey('name', $service);
        $this->assertArrayHasKey('image', $service);
        $this->assertArrayHasKey('url', $service);
    }

    public function testGetSuccessPokemonInfoByName()
    {
        $pokemonName = 'Pikachu';

        $response = [
            'id' => 25,
            'name' => 'Pikachu',
            'experience' => 112,
            'type' => [[
                'slot' => 1,
                'type' => [
                    'name' => 'electric',
                    'url' => 'https://pokeapi.co/api/v2/type/13/'
                ]
            ]],
            'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png'
        ];

        $service = (new PokedexService())->getPokemon($pokemonName);
        $this->assertEquals($response, $service);
    }

    public function testGetListOfPokemonsByPartialPokemonName()
    {
        $pokemonName = 'bul';
        $response = [
            [
                'id' => '1',
                'name' => 'bulbasaur',
                'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png',
                'url' => '/pokedex/id/1'
            ],
            [
                'id' => '209',
                'name' => 'snubbull',
                'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/209.png',
                'url' => '/pokedex/id/209'
            ],
            [
                'id' => '210',
                'name' => 'granbull',
                'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/210.png',
                'url' => '/pokedex/id/210'
            ],
            [
                'id' => '787',
                'name' => 'tapu-bulu',
                'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/787.png',
                'url' => '/pokedex/id/787'
            ]
        ];

        $service = (new PokedexService())->getPokemon($pokemonName);
        $this->assertEquals($response, $service);
    }
}
