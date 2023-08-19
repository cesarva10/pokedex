<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
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
}
