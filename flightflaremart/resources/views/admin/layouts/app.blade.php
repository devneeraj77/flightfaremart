<!DOCTYPE html>
@include('layouts.htmlcore')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Welcome')</title>
    @include('layouts.head')
    {{-- Alpine.js for small interactivity (sidebar toggle, dropdowns) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Minimal CSS for structure until you link a framework */
        body {
            margin: 0;
            background-color: #f4f7f6;
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
        }

        #sidebar-wrapper {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            transition: all 0.3s;
        }

        #page-content-wrapper {
            flex-grow: 1;
        }

        #topbar {
            background-color: white;
            border-bottom: 1px solid #e7e7e7;

            box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <div id="wrapper">
        @include('admin.layouts.sidebar')

        <div id="page-content-wrapper">

            <header id="topbar">
                <h4>@yield('title', 'Dashboard')</h4>
                <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

                    <div class="flex items-center gap-3">
                        <!-- Mobile menu button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center gap-2 rounded-md p-2 text-slate-600 hover:bg-slate-100 sm:hidden">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <span class="sr-only">Open sidebar</span>
                        </button>

                        <div class="hidden sm:flex sm:items-center sm:gap-4">
                            <h1 class="text-lg font-semibold">@yield('page_title', 'Dashboard')</h1>
                            <nav class="text-sm text-slate-500">@yield('breadcrumb')</nav>
                        </div>

                    </div>

                    <div class="flex items-center gap-4">
                        <div class="hidden sm:flex sm:items-center sm:gap-3">
                            <label class="relative block">
                                <input type="search" placeholder="Search..." class="w-48 rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm placeholder-slate-400 focus:ring-0 focus:outline-none">
                            </label>

                            <button class="rounded-md p-2 hover:bg-slate-100">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118.6 14H17" />
                                </svg>
                            </button>
                        </div>

                        <!-- Profile dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 rounded-full bg-white p-1 text-sm hover:shadow">
                                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=4F46E5&color=fff" alt="Admin">
                                <span class="hidden sm:inline-block text-sm font-medium">Admin</span>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-44 rounded-md border border-slate-100 bg-white shadow-lg">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-slate-50">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-slate-50">Settings</a>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-slate-50">Log out</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </header>


            <main class="py-4">
                @yield('content')
            </main>
            
            @include('admin.layouts.adminFooter')
            

        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

</body>

</html>