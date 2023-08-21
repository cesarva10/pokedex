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
            'pokemon' => 'integer|min:1|required'
        ]);
        
        $favorite = new Favorite();
        $favorite->user = Auth::id();
        $favorite->pokemon = $request->pokemon;

        $favorite->save();

        return $this->index();    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pokemon = Favorite::where('user', Auth::id())
                            ->where('pokemon', $id)
                            ->first();

        if (!$pokemon) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $pokemon->delete();

        return response()->json('Pokemón favorito eliminado '.$id, 200);
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
        return Favorite::where('user', Auth::id())
                        ->latest('created_at')
                        ->take($limit)
                        ->get();
    }

    public function isFavorite($pokemon) {
        return Favorite::where('user', Auth::id())
                        ->where('pokemon', $pokemon)
                        ->first();
    }
}