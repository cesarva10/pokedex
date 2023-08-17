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
        $favoritesUser = Favorite::where('user', Auth::id())->get();

        return Inertia::render('Favorites/Index', [
            'favoritesUser' => $favoritesUser
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
     * Display the specified resource.
     */
    public function show(Favorite $pokemon)
    {
        return view('favorites.show', compact('pokemon'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('favorites.index')->with('success','Pokemon has been deleted successfully');
    }
}