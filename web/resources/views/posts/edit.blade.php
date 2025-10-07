<x-layout.app>
    <x-slot:header>Edit your post</x-slot:header>

    <section>
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-white">Add a new blog post</h2>
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-2">
                    <div>
                        <x-form.input-label for="title">
                            Title
                        </x-form.input-label>
                        <div>
                            <x-form.input id="title" type="title" name="title" required placeholder="Title" value="{{ old('title') ?? $post->title }}"/>
                            <x-form.input-error type="title" />
                        </div>
                    </div>
                    <div>
                        <x-form.input-label for="content">
                            Content
                        </x-form.input-label>
                        <div>
                            <x-form.textarea id="content" name="content" placeholder="Blog contents">{{ old('content') ?? $post->content }}</x-form.textarea>
                            <x-form.input-error type="content" />
                        </div>
                    </div>
                </div>

                <x-button class="w-auto mt-4">
                    Save
                </x-button>
            </form>
        </div>
    </section>
</x-layout.app>