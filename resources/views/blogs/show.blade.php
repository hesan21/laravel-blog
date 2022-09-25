<x-app-layout>
    <div class="py-6 flex justify-center align-center">
        <div class="w-full md:w-3/4 mx-2 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
            <img class="w-full max-h-screen object-contain bg-gray-200"
                src="{{ $blog->image? asset($blog->image->path) : asset('blogs/dummy.png') }}" alt="" />

            <div>
                <h2 class="font-sans text-5xl font-bold p-5">{{ $blog->title }}</h2>
                <small class="p-5 text-gray-500 font-bold">Posted On: {{ $blog->created_at }}</small>

                <hr>

                <div class="w-full text-left my-2 px-5 max-w-full prose">
                    {!! $blog->body !!}
                </div>

                <hr>

                <p class="p-3 text-gray-500">
                    Blog Created By:
                    <a class="text-blue-800 underline hover:text-blue-500" href="{{ route('profile', $blog->creator_id) }}">{{ $blog->creator->name }}</a>
                </p>
            </div>
        </div>
    </div>

</x-app-layout>
