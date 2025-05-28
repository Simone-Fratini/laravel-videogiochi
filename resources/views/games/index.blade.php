<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-8 px-6 bg-custom-gray">

        <div class="mb-4">
            <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                ➕ Add New Game
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Genres</th>
                        <th class="px-4 py-2 border">Platforms</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                        <tr>
                            <td class="px-4 py-2 border">{{ $game->name }}</td>
                            <td class="px-4 py-2 border">
                                @foreach ($game->genres as $genre)
                                    <span>{{ $genre->name }}</span>@if (!$loop->last), @endif
                                @endforeach
                            </td>
                            <td class="px-4 py-2 border">
                                @foreach ($game->platforms as $platform)
                                    <span>{{ $platform->name }}</span>@if (!$loop->last), @endif
                                @endforeach
                            </td>
                            <td class="px-4 py-2 border space-x-2">
                                <a href="{{ route('games.show', $game->id) }}" class="text-blue-600 hover:underline">👁️ Show</a>
                                <a href="{{ route('games.edit', $game->id) }}" class="text-yellow-600 hover:underline">✏️ Edit</a>
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($games->isEmpty())
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No games found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
