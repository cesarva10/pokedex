<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Inertia\Inertia;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemonTypes = $this->getpokemonTypes();
        
        return Inertia::render('Types/Index', [
            'pokemonTypes' => $pokemonTypes
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $type)
    {
        $pokemonType = $this->getPokemonTypeData($type, 15);

        if(!$pokemonType)
            return Inertia::render('404', [
                'module' => 'tipo de pokemon',
                'value' => $type
            ]);

        return Inertia::render('Types/Show', [    
            'pokemons' => $pokemonType
        ]);
    }

    public function getPokemonType(String $type){
        $client = new Client();

        try {
            $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/type/'.$type);
            $response = $client->send($gRequest);
        } catch (ClientException $e) {
            return null;            
        }        

        return json_decode($response->getBody());
    }    

    public function getPokemonTypes(){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/type/');
        $response = $client->send($gRequest);

        return json_decode($response->getBody());
    }

    public function getPokemonTypeData(String $type, $limit){
        $pokemons = $this->getPokemonType($type);

        if(!$pokemons)
            return null;

        $pokemons = $this->getPokemonType($type)->pokemon;

        $typeData = [];

        foreach(array_slice($pokemons, 0, $limit) as $pokemon){
            $pokemonData = new PokemonController();
            $data = $pokemonData->getPokemon($pokemon->pokemon->name);
            array_push($typeData, $data);
        }

        return $typeData;
    }
}
