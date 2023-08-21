<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Inertia\Inertia;

class PokemonController extends Controller
{
    public function index(){
        $pokemons = $this->getPokemonsData(25);

        return Inertia::render('Pokemon/Index', [
            'pokemons' => $pokemons,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $pokemon)
    {  
        $pokemon = $this->getPokemon($pokemon);

        $favorite = new FavoriteController();
        $isFavorite = $favorite->isFavorite($pokemon->id);

        return Inertia::render('Pokemon/Show', [
            'pokemon' => $pokemon,
            'favorite' => $isFavorite
        ]);
    }

    public function getPokemon(String $pokemon){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/pokemon/'.$pokemon);
        $response = $client->send($gRequest);

        return json_decode($response->getBody());
    }

    public function getPokemons($limit = 20){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/pokemon?limit='.$limit);
        $response = $client->send($gRequest);

        return json_decode($response->getBody());
    }   

    public function getPokemonsData($limit){
        $pokemons = $this->getPokemons($limit)->results;
        $pokemonsData = [];

        foreach($pokemons as $pokemon){;
            $pokemonData = $this->getPokemon($pokemon->name);
            array_push($pokemonsData, $pokemonData);
        }
        return $pokemonsData;
    }
}
