<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Search Form -->
                    <form action="{{ route('games.search') }}" method="GET" class="mb-6">
                        <div class="flex gap-4">
                            <input type="text" 
                                   name="search" 
                                   value="{{ $search }}" 
                                   placeholder="Search games..." 
                                   class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Results -->
                    @if($games->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($games as $game)
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                    <h3 class="text-lg font-semibold">{{ $game->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        {{ $game->description }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No games found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>