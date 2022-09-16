<x-app-layout>
    <div class="py-6 container sm:flex mx-auto">
        <div class="w-full sm:w-1/4">
            <div class="bg-white rounded shadow-sm sm:rounded-lg text-center p-2">
                <img
                    class="w-1/4 rounded-full mx-auto"
                    src="https://w7.pngwing.com/pngs/956/160/png-transparent-head-the-dummy-avatar-man-user.png" alt="">

                <h2 class="font-bold py-2">
                    {{ $user->name }}
                </h2>

                <hr class="my-2">

                <div class="font-bold">
                    Blogs Posted:
                </div>

                <div class="text-blue-700 text-2xl">
                    {{ $user->blogs()->count() }}
                </div>

                @if (auth()->id() === $user->id)
                    <x-link href="{{ route('blogs.create') }}">
                        Create a New Blog
                    </x-link>
                @endif
            </div>
        </div>

        <div class="w-full sm:w-3/4 bg-white rounded overflow-hidden shadow-sm sm:rounded-lg p-2 mt-2 sm:mt-0 sm:ml-5">
            <h3 class="text-2xl uppercase text-center p-2 border-b-2">
                Created Blogs List
            </h3>

            <div class="inline-block lg:flex lg:align-center lg:flex-wrap">
                @foreach ($user->blogs as $blog)
                <div class="w-full lg:w-1/2 mt-6 px-6 py-4 shadow-md sm:rounded-lg hover:shadow-lg">
                    <img
                        class="max-w-full max-h-52 mx-auto"
                        src="{{ $blog->image ? asset($blog->image->file_path) : asset('blogs/dummy.png')}}" alt="">

                    <hr class="my-2">

                    <div class="flex justify-between align-center">
                        <h3>{{ $blog->title }}</h3>

                        <div class="flex">
                            <x-link href="{{ route('blogs.show', $blog->id) }}">
                                View
                            </x-link>

                            @if (3 === auth()->id())
                                <form class="mx-1" action="{{ route('blogs.delete', $blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button>
                                        Delete
                                    </x-button>
                                </form>

                                <x-link href="{{ route('blogs.edit', $blog->id) }}">
                                    Edit
                                </x-link>
                            @endif
                        </div>
                    </div>

                    <hr class="my-2">

                    <p>
                        {!! Str::limit($blog->body, 100) !!}
                    </p>
                </div>
                @endforeach
            </div>

            <p class="my-2">
                {{ $user->blogs->links() }}
            </p>
        </div>
    </div>
</x-app-layout>
