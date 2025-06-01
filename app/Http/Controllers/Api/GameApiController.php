<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Tag;

class GameApiController extends Controller
{
    // Return paginated list of games with relations
    public function index()
    {
        $games = Game::with(['genres', 'platforms', 'tags'])->orderBy('rating', 'asc')->orderBy('released', 'desc')->paginate(10);

        return response()->json($games);
    }

    // Return a single game by ID
    public function show(Game $game)
    {
        $game->load(['genres', 'platforms', 'tags']);
        return response()->json($game);
    }

    public function topRated()
    {
        $games = Game::with(['genres', 'platforms', 'tags'])
            ->orderBy('metacritic', 'desc')
            ->orderBy('released', 'desc')
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();

        return response()->json($games);
    }

    // Get all genres
    public function genres()
    {
        return response()->json(Genre::all());
    }

    // Get all platforms
    public function platforms()
    {
        return response()->json(Platform::all());
    }

    // Get all tags
    public function tags()
    {
        return response()->json(Tag::all());
    }
}
