<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($page = 1; $page <= 7; $page++) {
            $response = Http::get('https://api.rawg.io/api/games', [
                'key' => env('RAWG_API_KEY'),
                'ordering' => '-rating',
                'page_size' => 40,
                'page' => $page
            ]);

            $games = $response->json()['results'];

            foreach ($games as $g) {
                // Descrizione dettagliata
                $details = Http::get("https://api.rawg.io/api/games/{$g['id']}", [
                    'key' => env('RAWG_API_KEY')
                ])->json();

                // Salva gioco
                $existing = Game::where('id_rawg', $g['id'])->first();
                if ($existing) {
                    continue; // salta se già esiste
                }

                $game = new Game();
                $game->id_rawg = $g['id'];
                $game->slug = $g['slug'];
                $game->name = $g['name'];
                $game->released = $g['released'] ?? null;
                $game->background_image = $g['background_image'] ?? null;
                $game->rating = $g['rating'] ?? null;
                $game->playtime = $g['playtime'] ?? null;
                $game->description = $details['description_raw'] ?? null;
                $game->esrb_rating = $details['esrb_rating']['name'] ?? null;
                $game->save();
                // Aggiungi generi
                if (isset($g['genres'])) {
                    foreach ($g['genres'] as $gData) {
                        $existing = Genre::where('rawg_id', $gData['id'])->first();
                        if (!$existing) {
                            $genre = new Genre();
                            $genre->rawg_id = $gData['id'];
                            $genre->name = $gData['name'];
                            $genre->slug = $gData['slug'];
                            $genre->save();
                        } else {
                            $genre = $existing;
                        }
                        $game->genres()->attach($genre->id);
                    }
                }

                // Aggiungi piattaforme
                if (isset($g['platforms'])) {
                    foreach ($g['platforms'] as $pData) {
                        $plat = $pData['platform'];
                        $existing = Platform::where('rawg_id', $plat['id'])->first();
                        if (!$existing) {
                            $platform = new Platform();
                            $platform->rawg_id = $plat['id'];
                            $platform->name = $plat['name'];
                            $platform->slug = $plat['slug'];
                            $platform->save();
                        } else {
                            $platform = $existing;
                        }
                        $game->platforms()->attach($platform->id);
                    }
                }
            }
        }
    }
}
