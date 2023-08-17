<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Auth;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemonsUser = Pokemon::where('user', Auth::id())->get();
        return view('pokemons.index', compact($pokemonsUser));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pokemons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'pokemon' => 'required'
        ]);
        
        Pokemon::create($request->post());

        return redirect()->route('pokemons.index')->with('success','Pokemon has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        return view('pokemons.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        return view('pokemons.edit', compact('pokemon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        $request->validate([
            'user' => 'required',
            'pokemon' => 'required'
        ]);
        
        $pokemon->fill($request->post())->save();

        return redirect()->route('copokemonsmpanies.index')->with('success','Pokemon has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('companies.index')->with('success','Pokemon has been deleted successfully');
    }

    public function getPokemon(Request $request){

        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/pokemon/'.$request->name);
        $response = $client->send($gRequest);

        $response_body = (string)$response->getBody();
        dd($response_body);
    }

    public function getPokemons(Request $request){

        $client = new Client();

        $gRequest = new GuzzleRequest('GET', 'https://pokeapi.co/api/v2/pokemon?limit='.$request->limit);
        $response = $client->send($gRequest);

        $response_body = (string)$response->getBody();
        dd($response_body);
    }
}
