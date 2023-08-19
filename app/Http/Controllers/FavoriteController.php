<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favoritesData = $this->getFavoritesData();

        return Inertia::render('Favorites/Index', [
            'favoritesData' => $favoritesData
        ]);
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
        
        Favorite::create($request->post());

        return redirect()->route('favorites.index')->with('success','Pokemon has been created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('favorites.index')->with('success','Pokemon has been deleted successfully');
    }

    public function getFavorites(){
        return Favorite::where('user', Auth::id())
                        ->get();
    }

    public function getFavoritesData(){
        $favorites = $this->getFavorites();
        $favoritesData = [];

        foreach($favorites as $favorite){
            $pokemon = new PokemonController();
            $pokemonData = $pokemon->getPokemon($favorite->pokemon);
            $pokemonData->favorite = $favorite;
            array_push($favoritesData, $pokemonData);
        }

        return $favoritesData;
    }

    public function getRecentFavorites($limit) {
        return Favorite::latest('created_at')
                        ->take($limit)
                        ->get();
    }

    public function isFavorite($pokemon) {
        return Favorite::where('user', Auth::id())
                        ->where('pokemon', $pokemon)
                        ->first();
    }
}