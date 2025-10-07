<x-layout.app>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24  antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg  format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-white">
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-white">
                                    {{ $post->user->name }}
                                </a>
                                <p class="text-base text-gray-400">
                                    <time datetime="{{ $post->created_at->toDateTimeString() }}"
                                          title="{{ $post->created_at->toFormattedDateString() }}"
                                    >
                                        {{ $post->created_at->toFormattedDateString() }} at {{ $post->created_at->toTimeString() }}
                                    </time>
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight lg:mb-6 lg:text-4xl text-white">
                        {{ $post->title }}
                    </h1>
                </header>
                <p class="lead">
                    {{ $post->content }}
                </p>
            </article>
        </div>
    </main>

    <x-horizonal-line/>

    <section class="py-2 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-white">Discussion ({{ $comments->total() }})</h2>
            </div>

            @guest
                <h2>Log in to comment</h2>
            @endguest

            @auth
                <form class="mb-6" action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-2">
                        <x-form.textarea id="comment" name="comment"
                                         placeholder="Write a comment..." rows="6"
                                         required
                        >{{ old('content') }}</x-form.textarea>
                        <x-form.input-error type="comment" />
                    </div>

                    <x-button type="submit">
                        Post comment
                    </x-button>
                </form>
            @endauth

            <x-horizonal-line/>

            @forelse($comments as $comment)

                <article class="p-2 text-base rounded-lg ">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-white font-semibold">
                                {{ $comment->user->name }}
                            </p>
                            <p class="text-sm text-gray-400">
                                <time datetime="{{ $comment->created_at->toDateString() }}"
                                      title="{{ $comment->created_at->toFormattedDateString() }}"
                                >
                                    {{ $comment->created_at->toFormattedDateString() }} at {{ $comment->created_at->toTimeString() }}
                                </time>
                            </p>
                        </div>

                        @if($comment->user_id === auth()->id())
                            <div>
                                <form class="inline-block"
                                      action="{{ route('posts.comments.destroy', [$post, $comment]) }}"
                                      method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <x-small-button type="submit">
                                        Delete
                                    </x-small-button>
                                </form>
                            </div>
                        @endif
                    </footer>
                    <p class="text-gray-400">
                        {{ $comment->comment }}
                    </p>

                </article>

                @if(!$loop->last)
                    <x-horizonal-line/>
                @endif

            @empty
                <h3>No comments yet</h3>
            @endforelse

            {!! $comments->links() !!}
        </div>
    </section>

    <script>

    </script>
</x-layout.app>