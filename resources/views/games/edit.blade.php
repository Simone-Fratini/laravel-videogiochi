<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Edit Game</h2>

                    <form action="{{ route('games.update', $game->slug) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug', $game->slug) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @error('slug')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Released Date -->
                            <div>
                                <label for="released" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Release Date</label>
                                <input type="date" name="released" id="released" value="{{ old('released', $game->released) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @error('released')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Background Image -->
                            <div>
                                <label for="background_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Background Image</label>
                                <div class="mt-1 flex items-center gap-4">
                                    <div class="flex-1">
                                        <input type="file" accept="image/*" name="background_image" id="background_image" 
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                        <p class="mt-1 text-sm text-gray-500">Leave empty to keep current image</p>
                                    </div>
                                    @if($game->background_image)
                                        <div class="flex-shrink-0">
                                            <img src="{{ Str::startsWith($game->background_image, 'http') ? $game->background_image : asset('storage/' . $game->background_image) }}" 
                                                alt="Current background" class="w-20 h-20 object-cover rounded border border-gray-300">
                                        </div>
                                    @endif
                                </div>
                                @error('background_image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rating -->
                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating</label>
                                <input type="number" step="0.01" name="rating" id="rating" value="{{ old('rating', $game->rating) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @error('rating')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Playtime -->
                            <div>
                                <label for="playtime" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Playtime (hours)</label>
                                <input type="number" name="playtime" id="playtime" value="{{ old('playtime', $game->playtime) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                @error('playtime')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ESRB Rating -->
                            <div>
                                <label for="esrb_rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ESRB Rating</label>
                                <select name="esrb_rating" id="esrb_rating" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                    <option value="">Select Rating</option>
                                    <option value="Everyone" {{ old('esrb_rating', $game->esrb_rating) == 'Everyone' ? 'selected' : '' }}>Everyone</option>
                                    <option value="Everyone 10+" {{ old('esrb_rating', $game->esrb_rating) == 'Everyone 10+' ? 'selected' : '' }}>Everyone 10+</option>
                                    <option value="Teen" {{ old('esrb_rating', $game->esrb_rating) == 'Teen' ? 'selected' : '' }}>Teen</option>
                                    <option value="Mature" {{ old('esrb_rating', $game->esrb_rating) == 'Mature' ? 'selected' : '' }}>Mature</option>
                                    <option value="Adults Only" {{ old('esrb_rating', $game->esrb_rating) == 'Adults Only' ? 'selected' : '' }}>Adults Only</option>
                                </select>
                                @error('esrb_rating')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="6" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">{{ old('description', $game->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Genres -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Genres</label>
                            <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($genres as $genre)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}" 
                                            {{ in_array($genre->id, old('genres', $game->genres->pluck('id')->toArray())) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <label class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $genre->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('genres')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Platforms -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Platforms</label>
                            <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($platforms as $platform)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="platforms[]" value="{{ $platform->id }}" 
                                            {{ in_array($platform->id, old('platforms', $game->platforms->pluck('id')->toArray())) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <label class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $platform->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('platforms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                            <select name="tags[]" id="tags" class="select2-tags mt-1 block w-full" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $game->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tags')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('games.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 focus:bg-gray-400 dark:focus:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Update Game
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
