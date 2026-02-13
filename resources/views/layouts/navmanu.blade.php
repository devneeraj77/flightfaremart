<header x-data="{ isScrolled: false, isMenuOpen: false }" 
        x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 10 })"
        class="w-full top-0 left-0 z-50 transition-all duration-500"
        :class="isScrolled ? ' backdrop-blur-lg py-3' : 'py-5'">
    
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-xl font-bold tracking-tight transition-colors duration-500"
               :class="isScrolled ? 'text-primary ' : 'text-black'">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="32" height="32" viewBox="0 0 36 36">
                    <path fill="currentColor" d="M6.25 11.5L12 13.16l6.32-4.59l-9.07.26a.5.5 0 0 0-.25.08l-2.87 1.65a.51.51 0 0 0 .12.94" />
                    <path fill="currentColor" d="M34.52 6.36L28.22 5a3.78 3.78 0 0 0-3.07.67L6.12 19.5l-4.57-.2a1.25 1.25 0 0 0-.83 2.22l4.45 3.53a.55.55 0 0 0 .53.09c1.27-.49 6-3 11.59-6.07l1.12 11.51a.55.55 0 0 0 .9.37l2.5-2.08a.76.76 0 0 0 .26-.45l2.37-13.29c4-2.22 7.82-4.37 10.51-5.89a1.55 1.55 0 0 0-.43-2.88" />
                </svg>
                <span class="hidden md:block font-display uppercase text-lg">flightflaremart</span>
            </a>
        </div>

        <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
            @php
                $navLinks = [
                    ['name' => 'Home', 'url' => '/'],
                    ['name' => 'About', 'url' => '/about'],
                    ['name' => 'Blog', 'url' => '/blog'],
                    ['name' => 'Contact', 'url' => '/contact'],
                ];
            @endphp

            @foreach($navLinks as $link)
                <a href="{{ $link['url'] }}" 
                   class="relative group text-base transition-colors duration-300"
                   :class="isScrolled ? 'text-gray-700 ' : 'text-black/90'">
                    <span class="group-hover:text-primary">{{ $link['name'] }}</span>
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endforeach
        </div>

        <div class="flex items-center space-x-5">
            <!-- @auth
                <span class="hidden lg:inline text-xs transition-colors" :class="isScrolled ? 'text-gray-600 dark:text-black' : 'text-black/80'">Hello, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" class="text-sm font-medium hover:text-primary transition-colors" :class="isScrolled ? 'text-primary dark:text-black' : 'text-black'">Logout</a>
            @else
                <a href="{{ route('login') }}" 
                   class="hidden md:block px-6 py-2 rounded-full font-semibold transition-all duration-500"
                   :class="isScrolled ? 'bg-secondary text-black hover:bg-primary' : 'bg-white text-primary hover:bg-primary hover:text-black'">
                  Login
                </a>
            @endauth -->
            <button  >
              <a href="" class="bg-accent text-accent-content px-8 py-3 rounded-full font-bold text-xs tracking-widest hover:bg-accent/90 transition shadow-lg shrink-0">Contact Us</a>
            </button>

            <button @click="isMenuOpen = !isMenuOpen" class="md:hidden transition-colors" :class="isScrolled ? 'text-primary ' : 'text-black'">
                <svg x-show="!isMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="isMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <div x-show="isMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         class="md:hidden bg-white  border-t border-gray-100  p-4 shadow-xl">
        <ul class="flex flex-col space-y-4 text-center font-display text-xl">
            @foreach($navLinks as $link)
                <li><a href="{{ $link['url'] }}" class="text-primary  hover:text-primary">{{ $link['name'] }}</a></li>
            @endforeach
            <hr class="border-gray-100 ">
            @auth
                <li><a href="{{ route('logout') }}" class="text-primary">Logout</a></li>
            @else
                <li><a href="{{ route('login') }}" class="inline-block bg-primary text-black px-8 py-2 rounded-full">Login</a></li>
            @endauth
        </ul>
    </div>
</header>