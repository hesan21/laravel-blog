<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @if (Session::has('message'))
                <div class="pt-6 container mx-auto">
                    <div class="flex items-center bg-blue-100 border border-blue-500 text-blue-700 text-sm font-bold px-4 py-3 rounded-lg hover:shadow-lg" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                        <p>
                            {{ Session::get('message') }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="bg-gray-200 text-gray-800 text-center p-3">
                Created by: Hesan Naveed
            </footer>
        </div>
        @include('partials.popup')
        <script>
            let modalVisible = false;
            const modal = document.getElementById('modal');

            function showModal(event) {
                event.preventDefault();

                if(modalVisible !== true) {
                    modalVisible = true;
                    checkShowModal();
                }
            }

            function checkShowModal() {
                if(modalVisible === false) {
                    modal.classList.add('hidden');
                } else {
                    modal.classList.remove('hidden');
                }
            }

            function closeModal() {
                modalVisible = false;
                modal.classList.add('hidden');
            }

            function submitDeleteForm () {
                document.getElementById('deleteBlogForm').submit();
            }

            checkShowModal()
        </script>
        @stack('scripts')
    </body>
</html>
