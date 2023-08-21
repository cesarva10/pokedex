<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Inertia\Inertia;

class PokemonController extends Controller
{
    public function index(){
        $pokemons = $this->getPokemonsData(15);

        return Inertia::render('Pokemon/Index', [
            'pokemons' => $pokemons,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $pokemon)
    {  
        $pokemonData = $this->getPokemon($pokemon);

        if(!$pokemonData)
            return Inertia::render('404', [
                'module' => 'pokemon',
                'value' => $pokemon
            ]);

        $favorite = new FavoriteController();
        $isFavorite = $favorite->isFavorite($pokemonData->id);

        return Inertia::render('Pokemon/Show', [
            'pokemon' => $pokemonData,
            'favorite' => $isFavorite
        ]);
    }

    public function getPokemon(String $pokemon){
        $client = new Client();

        try {
            $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/pokemon/'.$pokemon);
            $response = $client->send($gRequest);
        } catch (ClientException $e) {
            return null;            
        }

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
