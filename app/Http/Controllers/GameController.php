<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with(['genres', 'platforms'])->paginate(30); // 30 games per page
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $platforms = Platform::all();
        $tags = Tag::all();
        return view('games.create', compact('genres', 'platforms', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;

        $game = new Game();
        $game->id_rawg = empty($request->id_rawg) ? null : $request->id_rawg; //can save a null

        //logic to have a unique slug
        while (Game::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $game->slug = $slug;
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
    public function show(string $slug)
    {
        $game = Game::with(['genres', 'platforms', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $genres = Genre::all();
        $tags = Tag::all();
        $platforms = Platform::all();

        return view('games.edit', compact('game', 'genres', 'platforms', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
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
        $game->tags()->sync($request->tags);

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game->genres()->detach();
        $game->platforms()->detach();
        $game->tags()->detach();
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $games = Game::with(['genres', 'platforms'])
                ->where('name', 'like', "%{$search}%")
                ->paginate(30);
        } else {
            $games = Game::with(['genres', 'platforms'])
                ->paginate(30);
        }

        return view('games.search', compact('games', 'search'));
    }

    public function dashboard()
    {
        // Get total counts
        $totalGames = Game::count();
        $totalGenres = Genre::count();
        $totalPlatforms = Platform::count();
        $totalTags = Tag::count();

        // Get top rated games
        $topRatedGames = Game::orderBy('rating', 'desc')->take(5)->get();

        // Get most common genres
        $popularGenres = Genre::withCount('games')->orderBy('games_count', 'desc')->take(5)->get();

        // Get most common platforms
        $popularPlatforms = Platform::withCount('games')->orderBy('games_count', 'desc')->take(5)->get();

        // Get recently added games
        $recentGames = Game::latest()->take(5)->get();

        // Get average rating
        $averageRating = Game::avg('rating');

        return view('dashboard', compact(
            'totalGames',
            'totalGenres',
            'totalPlatforms',
            'totalTags',
            'topRatedGames',
            'popularGenres',
            'popularPlatforms',
            'recentGames',
            'averageRating'
        ));
    }
}
