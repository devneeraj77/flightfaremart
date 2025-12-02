<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.head')
    <title>@yield('title', 'Blog')</title>
</head>
<body class="min-h-screen">
    @include('layouts.navmanu')

    <div class="container mx-auto py-8">
        <div class="flex flex-col lg:flex-row ">

            <main class="w-full lg:w-3/4 px-4">
                @yield('main-content')
            </main>

            <aside class="w-full lg:w-1/4 px-4 mt-8 lg:mt-0">
                @yield('sidebar')
            </aside>

        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
