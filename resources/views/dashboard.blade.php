<x-app-layout>
    <div class="py-6 flex">
        <div class="w-full lg:w-3/4 p-4">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <form action="{{ route('dashboard')}}"
                    class="p-6 bg-white text-xl pb-5 block lg:flex align-center justify-between">

                    <input
                        type="text"
                        name="keyword"
                        class="w-full lg:w-5/6 rounded-xl text-pink-500"
                        value="{{ Request::get('keyword') }}"
                        placeholder="Search a Blog Post.." />

                    <x-button class="w-full mt-2 justify-center md:w-1/3 md:ml-auto lg:mt-0 lg:w-auto">
                        Filter Search
                    </x-button>
                </form>

                <hr>
            </div>

            <div class="bg-white my-2 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg ease-in-out duration-300 cursor-pointer lg:flex lg:align-center">
                <img
                    class="w-full max-h-52 lg:w-1/4 object-contain bg-gray-200"
                    src="{{ asset('blogs/dummy.png') }}" alt="" />

                <div class="w-full lg:w-3/4 p-4">
                    <h3 class="text-2xl font-bold">
                        Blog Title
                    </h3>

                    <p class="p-3 text-gray-500">
                        Created by:
                        <a
                            class="text-blue-800 underline hover:text-blue-500"
                            href="{{ route('profile', auth()->id()) }}">
                            John Doe
                        </a>
                    </p>

                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a
                        type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.
                    </p>

                    <x-link href="{{ route('blogs.show', 1) }}">
                        View full Blog
                    </x-link>
                </div>
            </div>
        </div>

        <div class="hidden lg:block lg:w-1/4 p-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="font-bold">
                    Blogs Created
                </div>

                <div class="text-blue-700 text-2xl">
                    {{ auth()->user()->blogs()->count() }}
                </div>

                <hr class="my-3">

                <x-link href="{{ route('blogs.create') }}">
                    Create a New Blog Post
                </x-link>
            </div>
        </div>
    </div>
</x-app-layout>
