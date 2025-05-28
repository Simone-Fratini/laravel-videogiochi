<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with(['genres', 'platforms'])->get(); //giochi con anche generi e piattaforme
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $platforms = Platform::all();
        return view('games.create', compact('genres', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $game = new Game();
        $game->id_rawg = $request->id_rawg;
        $game->slug = $request->slug;
        $game->name = $request->name;
        $game->released = $request->released;
        $game->background_image = $request->background_image;
        $game->rating = $request->rating;
        $game->playtime = $request->playtime;
        $game->description = $request->description;
        $game->esrb_rating = $request->esrb_rating;
        $game->save();

        $game->genres()->sync($request->genres);
        $game->platforms()->sync($request->platforms);

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
