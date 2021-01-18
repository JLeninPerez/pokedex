<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;

class PokedexControllerTest extends TestCase
{
    public function testGetHomeViewSuccess()
    {
        $response = $this->get('/pokedex');
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function testGetSingleCardInformation()
    {
        $response = $this->get('/pokedex/name?pokemonName=pikachu');
        $response->assertStatus(200);
        $response->assertViewIs('info');
    }

    public function testGetFilterListByPokemonName()
    {
        $response = $this->get('/pokedex/name?pokemonName=bul');
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function testGetInfoByPokemonId()
    {
        $response = $this->get('/pokedex/id/1');
        $response->assertStatus(200);
        $response->assertViewIs('info');
    }

    public function testGetViewNotFound()
    {
        $response = $this->get('/not_exist');
        $response->assertStatus(200);
        $response->assertViewIs('not_found');
    }
}
