<x-layout.app>
    <x-slot:header>
        Blog Posts
    </x-slot:header>


    <div class="grid gap-8 lg:grid-cols-2">
        @foreach($posts as $post)

            <article class="flex flex-col p-6 bg-gray-700 rounded-lg border border-b-gray-400 shadow-md text-gray-400">
                <div class="flex justify-between items-center mb-5 text-gray-300">
                    <span class="text-sm">{{ $post->created_at->diffForHumans(now()) }}</span>
                    @if($post->user_id === auth()->id())
                        <div>
                            <x-small-button href="{{ route('posts.edit', $post) }}" class="mr-2">
                                Edit
                            </x-small-button>

                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <x-small-button type="submit">
                                    Delete
                                </x-small-button>
                            </form>
                        </div>
                    @endif

                </div>
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-200">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <p class="mb-5 font-light text-gray-300">{{ $post->content }}</p>
                <div style="margin-top: auto">
                    <p class="mb-1 font-light text-gray-300 text-xs text-primary-500">Comments: {{ $post->comments_count ?? 0 }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                        <span class="font-medium dark:text-white">
                              {{ $post->user->name }}
                          </span>
                        </div>
                        <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center font-medium text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-4">
        {!! $posts->links() !!}
    </div>
</x-layout.app>