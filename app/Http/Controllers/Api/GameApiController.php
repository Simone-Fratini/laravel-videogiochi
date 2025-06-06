<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Tag;
use Illuminate\Http\Request;

class GameApiController extends Controller
{
    // Return paginated list of games
    public function index(Request $request)
    {
        $query = Game::with(['genres', 'platforms', 'tags']);

        // Add search filter 
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Add genre filter
        if ($request->has('genre') && $request->input('genre') != 'All Genres') {
            $genreId = $request->input('genre');
            $query->whereHas('genres', function ($q) use ($genreId) {
                $q->where('genres.id', $genreId);
            });
        }

        // Add platform filter
        if ($request->has('platform') && $request->input('platform') != 'All Platforms') {
            $platformId = $request->input('platform');
            $query->whereHas('platforms', function ($q) use ($platformId) {
                $q->where('platforms.id', $platformId);
            });
        }

        if ($request->has('newreleases')) {
            $query->orderBy('released', 'desc');
        }

        if ($request->has('topRated')) {
            $query->orderBy('released', 'desc');
        }

        $games = $query->orderBy('rating', 'asc')
            ->orderBy('released', 'desc')
            ->paginate(30);

        $genres = Genre::all();
        $platforms = Platform::all();

        return response()->json([
            'games' => $games,
            'tags' => $genres,
            'platforms' => $platforms
        ]);
    }

    // Return a single game by ID
    public function show(Game $game)
    {
        $game->load(['genres', 'platforms', 'tags']);
        return response()->json($game);
    }

    public function topRated(Request $request)
    {
        $query = Game::with(['genres', 'platforms', 'tags']);

        if ($request->has('platform') && $request->input('platform') != 'All') {
            $platformName = $request->input('platform');
            $query->whereHas('platforms', function ($q) use ($platformName) {
                $q->where('platforms.name', $platformName);
            });
        }

        $games = $query->orderBy('metacritic', 'desc')
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
