<x-app-layout>
    <div class="py-8 px-6 bg-custom-gray">
        <div class="max-w-7xl mx-auto">
            <!-- Header with back button -->
            <a href="{{ route('games.index') }}" 
               class="text-white hover:text-gray-300 transition duration-150">
                ← Back to Games
            </a>
            <div class="mb-6 flex justify-between items-center mt-6">
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl font-bold text-white">{{ $game->name }}</h2>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('games.edit', $game->slug) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                        ✏️ Edit Game
                    </a>
                    <form action="{{ route('games.destroy', $game->slug) }}" 
                          method="POST" 
                          class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this game?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                            🗑️ Delete Game
                        </button>
                    </form>
                </div>
            </div>

            <!-- Game Details Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl overflow-hidden">
                <div class="p-6">
                    <!-- Game Image and Basic Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Game Image -->
                        <div class="md:col-span-1">
                            @if($game->background_image)
                                <img src="{{ Str::startsWith($game->background_image, 'http') ? $game->background_image : asset('storage/' . $game->background_image) }}" 
                                     alt="{{ $game->name }}" 
                                     class="w-full h-64 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 dark:text-gray-500">No image available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Basic Info -->
                        <div class="md:col-span-2">
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Release Date</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $game->released ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Rating</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $game->rating ?? 'Not rated' }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Playtime</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $game->playtime ?? 'Not specified' }} hours</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">ESRB Rating</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $game->esrb_rating ?? 'Not rated' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Genres Platforms and tags-->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Genres -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3">Genres</h3>
                            <div class="flex flex-wrap gap-2">
                                @forelse($game->genres as $genre)
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $genre->name }}
                                    </span>
                                @empty
                                    <p class="text-gray-500 dark:text-gray-400">No genres specified</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Platforms -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3">Platforms</h3>
                            <div class="flex flex-wrap gap-2">
                                @forelse($game->platforms as $platform)
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        {{ $platform->name }}
                                    </span>
                                @empty
                                    <p class="text-gray-500 dark:text-gray-400">No platforms specified</p>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- Tags -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @forelse($game->tags as $tag)
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-500 text-green-800 dark:bg-red-500 dark:text-green-200">
                                        {{ $tag->name }}
                                    </span>
                                @empty
                                    <p class="text-gray-500 dark:text-gray-400">No tags specified</p>
                                @endforelse
                            </div>
                        </div>
                    </div>


                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3">Description</h3>
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-600 dark:text-gray-400">
                                {{ $game->description ?? 'No description available.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
