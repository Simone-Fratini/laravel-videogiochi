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
    /**
     * Display a listing of the games.
     */
    public function index(Request $request)
    {
        $query = Game::with(['genres', 'platforms', 'tags']);

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by genre
        if ($request->has('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('name', $request->genre);
            });
        }

        // Filter by platform
        if ($request->has('platform')) {
            $query->whereHas('platforms', function ($q) use ($request) {
                $q->where('name', $request->platform);
            });
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        // Sort by
        if ($request->has('sort')) {
            $direction = $request->has('direction') && $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy($request->sort, $direction);
        } else {
            $query->orderBy('name', 'asc');
        }

        $games = $query->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $games
        ]);
    }

    /**
     * Display the specified game.
     */
    public function show(Game $game)
    {
        return response()->json([
            'status' => 'success',
            'data' => $game->load(['genres', 'platforms', 'tags'])
        ]);
    }

    /**
     * Get all available genres.
     */
    public function genres()
    {
        $genres = Genre::orderBy('name')->get();
        return response()->json([
            'status' => 'success',
            'data' => $genres
        ]);
    }

    /**
     * Get all available platforms.
     */
    public function platforms()
    {
        $platforms = Platform::orderBy('name')->get();
        return response()->json([
            'status' => 'success',
            'data' => $platforms
        ]);
    }

    /**
     * Get all available tags.
     */
    public function tags()
    {
        $tags = Tag::orderBy('name')->get();
        return response()->json([
            'status' => 'success',
            'data' => $tags
        ]);
    }
}
