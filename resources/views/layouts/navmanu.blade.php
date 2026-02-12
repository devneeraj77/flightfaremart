<header class="w-full fixed top-0 left-0 z-50 bg-primary dark:bg-[#0b1e1f] border-b border-[#19140035] dark:border-[#3E3E3A]">
  <!-- <div class="text-center font-medium py-2 bg-gradient-to-r from-base-200 dark:from-base-200/10 to-transparent text-xs dark:text-secondary">
    <p>Exclusive Price Drop! Hurry, <span class="underline underline-offset-2">Offer Ends Soon!</span></p>
  </div> -->

  <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
    
    <div class="flex items-center">
      <a href="{{ url('/') }}" itemscope itemtype="https://schema.org/WebSite" class="flex items-center gap-2 text-xl font-bold tracking-tight text-[#1b1b18] dark:text-[#EDEDEC]">
        <link itemprop="url" href="https://flightfaremart.com/" />
        <meta itemprop="name" content="FlightFareMart" />
        <svg xmlns="http://www.w3.org/2000/svg" class="text-accent dark:text-secondary" width="32" height="32" viewBox="0 0 36 36">
            <path fill="currentColor" d="M6.25 11.5L12 13.16l6.32-4.59l-9.07.26a.5.5 0 0 0-.25.08l-2.87 1.65a.51.51 0 0 0 .12.94" />
            <path fill="currentColor" d="M34.52 6.36L28.22 5a3.78 3.78 0 0 0-3.07.67L6.12 19.5l-4.57-.2a1.25 1.25 0 0 0-.83 2.22l4.45 3.53a.55.55 0 0 0 .53.09c1.27-.49 6-3 11.59-6.07l1.12 11.51a.55.55 0 0 0 .9.37l2.5-2.08a.76.76 0 0 0 .26-.45l2.37-13.29c4-2.22 7.82-4.37 10.51-5.89a1.55 1.55 0 0 0-.43-2.88" />
        </svg>
        <span>flightflaremart</span>
        
      </a>
    </div>

    <div class="hidden md:block">
      <ul class="flex items-center space-x-8 text-sm font-medium text-secondary">
        <li><a href="/" class="hover:text-accent transition-colors">Home</a></li>
        <li><a href="/about" class="hover:text-accent transition-colors">About</a></li>
        <li><a href="/blog" class="hover:text-accent transition-colors">Blog</a></li>
        <li><a href="/contact" class="hover:text-accent transition-colors">Contact</a></li>
        <li class="flex items-center gap-1 cursor-pointer hover:text-accent transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
        </li>
      </ul>
    </div>

    <div class="flex items-center space-x-5">
      
      <div class="checkbox-wrapper-35 hidden sm:flex justify-center scale-90">
        <input value="private" name="switch" id="switch" type="checkbox" class="switch" onchange="toggleTheme()">
        <label for="switch">
          <span class="switch-x-text">Theme</span>
          <span class="switch-x-toggletext">
            <span class="switch-x-unchecked">Light</span>
            <span class="switch-x-checked">Dark</span>
          </span>
        </label>
      </div>

      @auth
        <span class="hidden lg:inline text-xs text-secondary">Hello, {{ Auth::user()->name }}</span>
        <a href="{{ route('logout') }}" class="text-sm font-medium text-secondary hover:text-accent transition-colors">Logout</a>
      @else
        <a href="{{ route('login') }}" class="text-sm font-medium text-secondary hover:text-accent transition-colors">Login</a>
      @endauth

      <button id="menu-btn" class="md:hidden text-secondary hover:text-accent">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
    </div>
  </nav>

  <div id="mobile-menu" class="hidden md:hidden bg-primary dark:bg-[#0b1e1f] border-t border-[#19140035] dark:border-[#3E3E3A] p-4 shadow-lg">
    <ul class="flex flex-col space-y-4 text-sm font-medium text-secondary">
      <li><a href="/" class="hover:text-accent transition-colors">Home</a></li>
      <li><a href="/about" class="hover:text-accent transition-colors">About</a></li>
      <li><a href="/blog" class="hover:text-accent transition-colors">Blog</a></li>
      <li><a href="/contact" class="hover:text-accent transition-colors">Contact</a></li>
      @auth
        <li><span class="text-xs">Hello, {{ Auth::user()->name }}</span></li>
        <li><a href="{{ route('logout') }}" class="hover:text-accent transition-colors">Logout</a></li>
      @else
        <li><a href="{{ route('login') }}" class="hover:text-accent transition-colors">Login</a></li>
      @endauth
    </ul>
  </div>
</header>

<div class="h-16"></div>