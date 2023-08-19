<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Inertia\Inertia;

class PokemonController extends Controller
{
    public function index(){
        $favorite = new FavoriteController();
        $type = new TypeController();

        $recentFavorites = $favorite->getRecentFavorites(4);
        $pokemonTypes = $type->getPokemonTypes();

        return Inertia::render('Dashboard', [
            'pokemonTypes' => $pokemonTypes,
            'recentFavorites' => $recentFavorites,
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

    public function getPokemons(Request $request){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/pokemon?limit='.$request->limit);
        $response = $client->send($gRequest);

        $response_body = (string)$response->getBody();
        dd($response_body);
    }

    public function getTypes($limit = null){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/type?limit='.$limit);
        $response = $client->send($gRequest);
        
        return json_decode($response->getBody());
    }
}
