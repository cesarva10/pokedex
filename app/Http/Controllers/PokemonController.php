<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Inertia\Inertia;
use Ramsey\Uuid\Type\Integer;

class PokemonController extends Controller
{
    public function index(){
        $pokemons = $this->getPokemons();

        return Inertia::render('Pokemon/Index', [
            'pokemons' => $pokemons->results,
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

    public function getTypes($limit = null){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/type?limit='.$limit);
        $response = $client->send($gRequest);
        
        return json_decode($response->getBody());
    }
}
