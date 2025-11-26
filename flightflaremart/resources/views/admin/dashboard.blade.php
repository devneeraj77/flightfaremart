<!DOCTYPE html>
{{-- Assumed Includes --}}
<<<<<<< HEAD
@extends('admin.layouts.app') 
=======
@include('layouts.htmlcore')
>>>>>>> b13c830a9d8d64a54ab9e5b52d125eeba53d2599

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - FlightFlareMart</title>
  @include('layouts.head')
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    /* CSS to hide Alpine.js elements until they are initialized */
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<<<<<<< HEAD
@section('content')
<div>dasfgda</div>
@endsection
=======
<body class="md:w-full text-left text-sm hover:bg-base-300">

  <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

    <aside class="w-64 bg-[#11180f] text-white flex-shrink-0 min-h-screen p-6">
      <div class="text-2xl font-semibold mb-8">
        FlightFlareMart
        Admin Panel
      </div>
      <nav class="space-y-2">

        {{-- Dashboard Link --}}
        <a href="{{ route('admin.dashboard') }}" class="block py-1 px-3 rounded hover:bg-slate-700 @if(request()->routeIs('admin.dashboard')) bg-slate-700 @endif">Dashboard</a>

        <a href="#" class="block py-1 px-3 rounded hover:bg-slate-700">Flights</a>
        <a href="#" class="block py-1 px-3 rounded hover:bg-slate-700">Bookings</a>
        <a href="#" class="block py-1 px-3 rounded hover:bg-slate-700">Users</a>

        <div class="mt-6">
          <p class="uppercase text-xs text-slate-400 mb-2">Blog Management</p>

          {{-- All Posts Link --}}
          <a href="{{ route('blog.allposts') }}" class="block py-2 px-3 rounded hover:bg-slate-700 @if(request()->routeIs('admin.blog.allposts')) bg-slate-700 @endif">All Posts</a>


          <a href="#" class="block py-2 px-3 rounded hover:bg-slate-700">Categories</a>
        </div>
      </nav>
    </aside>

    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black/50 sm:hidden" @click="sidebarOpen = false"></div>

    <div class="flex flex-1 flex-col overflow-hidden">
      <header class="w-full border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

          <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center gap-2 rounded-md p-2 text-slate-600 hover:bg-slate-100 sm:hidden">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler text-accent icons-tabler-filled icon-tabler-layout-sidebar">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M6 21a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3zm12 -16h-8v14h8a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1" />
              </svg>
              <span class="sr-only">Open sidebar</span>
            </button>

            <div class="hidden sm:flex sm:items-center sm:gap-4">
              {{-- PAGE TITLE --}}
              <h1 class="text-lg font-semibold">@yield('page_title', 'Dashboard')</h1>
              {{-- BREADCRUMB --}}
              <nav class="text-sm text-slate-500">@yield('breadcrumb')</nav>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="hidden sm:flex sm:items-center sm:gap-3">
              <label class="relative block">
                <input type="search" placeholder="Search..." class="w-48 rounded-md border border-slate-200 bg-base-300 px-3 py-2 text-sm placeholder-slate-400 focus:ring-0 focus:outline-none">
              </label>

              <button class="rounded-md p-2 hover:bg-slate-100">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118.6 14H17" />
                </svg>
              </button>
            </div>

            <div x-data="{ open: false }" class="relative">
              <button @click="open = !open" class="flex items-center gap-2 rounded-full bg-white p-1 text-sm hover:shadow">
                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ session('admin_name') }}" alt="Admin">
                <span class="hidden sm:inline-block text-sm font-medium">Welcome, {{ session('admin_name') }}</span>
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <div x-show="open" **x-cloak** @click.outside="open = false" x-transition class="absolute text-accent right-0 mt-2 w-44 rounded-md border border-slate-100 bg-white shadow-lg">
                <a href="#" class="block px-4 py-2 text-sm hover:bg-base-300">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm hover:bg-base-300">Settings</a>
                <a href="{{ route('admin.logout') }}" class="text-decoration-none text-accent block px-4 py-2 text-sm hover:bg-base-300">Logout</a>
              </div>
            </div>
          </div>

        </div>
      </header>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

        {{-- MAIN CONTENT YIELD --}}
        @yield('content')

        <footer class="mt-8 text-center text-xs text-slate-400">
          © {{ date('Y') }} FlightFareMart — Admin Dashboard
        </footer>

      </main>
    </div>
  </div>
</body>
>>>>>>> b13c830a9d8d64a54ab9e5b52d125eeba53d2599

</html>