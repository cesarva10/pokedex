<?php

namespace App\Http\Controllers;

use App\Models\Type;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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
        $pokemonType = $this->getpokemonType($type);
        
        return Inertia::render('Types/Show', [
            'typeData' => $pokemonType,            
            'pokemons' => $pokemonType->pokemon
        ]);
    }

    public function getPokemonType(String $type){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/type/'.$type);
        $response = $client->send($gRequest);

        return json_decode($response->getBody());
    }    

    public function getPokemonTypes(){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/type/');
        $response = $client->send($gRequest);

        return json_decode($response->getBody());
    }
}
