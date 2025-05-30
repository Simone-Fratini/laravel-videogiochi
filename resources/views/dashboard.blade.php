<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Total Games</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-400">{{ $totalGames }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Genres</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-400">{{ $totalGenres }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Platforms</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-400">{{ $totalPlatforms }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Tags</h3>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-400">{{ $totalTags }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top Rated Games -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-300">Top Rated Games</h3>
                        <div class="space-y-4">
                            @foreach($topRatedGames as $game)
                                <div class="flex items-center space-x-4">
                                    @if($game->background_image)
                                        <img src="{{ $game->background_image }}" alt="{{ $game->name }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-400">{{ $game->name }}</h4>
                                        <div class="flex items-center text-yellow-500">
                                            <span>★</span>
                                            <span class="ml-1">{{ number_format($game->rating, 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Popular Genres -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-300">Popular Genres</h3>
                        <div class="space-y-4">
                            @foreach($popularGenres as $genre)
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-400">{{ $genre->name }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">{{ $genre->games_count }} games</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Popular Platforms -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-300">Popular Platforms</h3>
                        <div class="space-y-4">
                            @foreach($popularPlatforms as $platform)
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-400">{{ $platform->name }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">{{ $platform->games_count }} games</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recently Added Games -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-300">Recently Added Games</h3>
                        <div class="space-y-4">
                            @foreach($recentGames as $game)
                                <div class="flex items-center space-x-4">
                                    @if($game->background_image)
                                        <img src="{{ $game->background_image }}" alt="{{ $game->name }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-500 dark:text-gray-400">{{ $game->name }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-500">
                                            Added {{ $game->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-300">Quick Actions</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('games.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Add New Game
                            </a>
                            <a href="{{ route('games.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                View All Games
                            </a>
                            <a href="{{ route('games.search') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                Search Games
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
