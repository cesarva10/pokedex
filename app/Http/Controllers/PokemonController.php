<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Inertia\Inertia;

class PokemonController extends Controller
{
    public function index(){
        return Inertia::render('Dashboard', [
            'pokemonTypes' => $this->getTypes(),
            'recentFavorites' => $this->getRecentFavorites(4),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $pokemon)
    {  
        $pokemon = $this->getPokemon($pokemon);
        $favorite = $this->isFavorite($pokemon->id);

        return Inertia::render('Pokemon/Show', [
            'pokemon' => $pokemon,
            'favorite' => $favorite
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

    public function getType(Request $request){
        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/type/'.$request->type);
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

    public function getRecentFavorites($limit) {
        return Favorite::latest('created_at')
                        ->take(4)
                        ->get();
    }

    public function isFavorite($pokemon) {
        return Favorite::where('user', Auth::id())
                        ->where('pokemon', $pokemon)
                        ->first();
    }
}
