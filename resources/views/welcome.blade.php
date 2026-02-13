<!DOCTYPE html>

@include('layouts.htmlcore')

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://unpkg.com/embla-carousel/embla-carousel.umd.js"></script>
  <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
  <title>FlightFareMart | Find the Cheapest Flights & Best Airfare Deals</title>
  <meta name="description" content="FlightFareMart is your trusted source for finding the cheapest flights worldwide. Compare airfare, discover deals, and book your next trip with guaranteed low prices.">
  <meta name="keywords" content="FlightFareMart, cheapest flights, flight booking, best airfare deals, low cost airline tickets, discount flights, flight comparison, travel deals, book flights online">
  @include('layouts.head')
  <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body class=" antialiased bg-base-100  overflow-x-hidden  px-2 ">
  <x-preloading />
  @include('layouts.navmanu')
  <main>
    <section class="xl:max-w-7xl lg:mx-10 xl:mx-auto  relative">

      <div class="relative bg-cover bg-center  bg-no-repeat lg:rounded-[3rem] p-2 md:p-10 md:my-10 min-h-[600px]"
        style="background-image: url('{{ asset('/img/hero-banner.png') }}')">

        <div class="relative s z-10">
          <p class="uppercase  tracking-widest text-neutral font-bold mb-4 text-xs">
            Elevate your travel journey
          </p>
          <h1 class="text-5xl md:text-6xl  leading-tight text-black font-semibold mb-16 max-w-2xl">
            Experience<br>The Magic Of<br>Flights
          </h1>

          <div class="relative z-40 w-full lg:max-w-5xl">
            <x-flight-search-form class="relative shadow-2xl" />
          </div>
        </div>

        <div class="absolute hidden lg:flex bottom-20 right-0 z-50 flex items-center gap-4">

          <div class="flex pt-4 -space-x-4">
            <img class="w-14 h-14 rounded-full shadow-md object-cover" src="https://i.pravatar.cc/100?u=1" alt="User">
            <img class="w-14 h-14 rounded-full shadow-md object-cover" src="https://i.pravatar.cc/100?u=2" alt="User">
            <img class="w-14 h-14 rounded-full shadow-md object-cover" src="https://i.pravatar.cc/100?u=3" alt="User">
          </div>

          <div class="bg-base-200 rounded-4xl p-6 flex items-center gap-6">
            <div class="text-left">
              <div class="flex items-center gap-2 group cursor-pointer">
                <span class="text-2xl  text-accent mb-2">Know More</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
              </div>
              <!-- <p class="text-sm uppercase font-bold text-gray-400 mt-1 tracking-tighter">Awesome Places</p> -->
              <p class="text-xs text-neutral max-w-[130px] leading-tight">Visit those places at least one time in your life.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class=" flex flex-col md:flex-row justify-between items-center gap-8 border-b border-gray-100 pb-10">
      </div> -->
      <div class="p-2 pt-8 md:p-0 flex flex-col md:flex-row justify-between items-center gap-12 border-b border-base-200 pb-12">
        <div class="flex items-center gap-4">
          <span class="text-sm font-bold uppercase tracking-widest text-neutral">Follow us on -</span>
          <div class="flex gap-3">
            <a href="#" class="bg-accent text-accent-content p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-youtube">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8" />
                <path d="M10 9l5 3l-5 3l0 -6" />
              </svg></a>
            <a href="#" class="bg-accent text-accent-content p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-x">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 4l11.733 16h4.267l-11.733 -16l-4.267 0" />
                <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
              </svg></a>
            <a href="#" class="bg-accent text-accent-content p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4l0 -8" />
                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                <path d="M16.5 7.5v.01" />
              </svg></a>
            <a href="#" class="bg-accent text-accent-content p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
              </svg></a>
          </div>
        </div>

        <div class="flex flex-wrap items-center gap-8 opacity-70 grayscale hover:grayscale-0 transition-all">
          <div class="flex items-center font-bold text-xl gap-1"><span>Delta Air Lines</span></div>
          <div class="flex items-center font-bold text-xl gap-1"><span>American Airlines</span></div>
          <div class="flex items-center font-bold text-xl gap-1"><span>Qatar Airways</span></div>
          <div class="flex items-center font-bold text-xl gap-1"><span>Expedia</span></div>
        </div>
      </div>
    </section>
    <!-- add -->
    </section>
    <!-- section 2 -->
    <section class="py-24 mx-auto max-w-7xl ">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl  text-accent mb-3">Popular Flight Deals Right Now</h2>
        <p class="uppercase tracking-[0.3em] text-neutral text-base font-bold">Trip On</p>
      </div>

      <div class="flex flex-col lg:flex-row gap-12 px-6">
        <div class="lg:w-3/5 w-full grid 
            grid-cols-2 md:grid-cols-3 
            gap-4 md:gap-5 
            auto-rows-[180px] sm:auto-rows-[200px] md:auto-rows-[140px]">

          <div class="col-span-1 row-span-1 md:row-span-3 relative overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm">
            <img src="https://images.unsplash.com/photo-1485871981521-5b1fd3805eee?q=60&w=650&auto=format&fit=crop"
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Historic building">
          </div>

          <div class="col-span-1  row-span-1 md:col-span-2 relative overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm">
            <img src="https://images.unsplash.com/photo-1547448415-e9f5b28e570d?q=60&w=650&auto=format&fit=crop"
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Mountain lake">
          </div>

          <div class="col-span-1 md:row-span-1 lg:row-span-3 relative overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm">
            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?q=60&w=400&auto=format&fit=crop"
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Hiking trail">
          </div>

          <div class="col-span-1 row-span-1 relative overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm">
            <img src="https://images.unsplash.com/photo-1618259278412-2819cbdea4dc?q=60&w=400&auto=format&fit=crop"
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Red canyon road">
          </div>

          <div class="col-span-1 row-span-1  md:row-span-2 relative overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm">
            <img src="https://images.unsplash.com/photo-1520175480921-4edfa2983e0f?q=60&w=400&auto=format&fit=crop"
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Valley view">
          </div>

          <div class="col-span-1 row-span-1 relative overflow-hidden rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm">
            <img src="https://images.unsplash.com/photo-1624138784614-87fd1b6528f8?q=60&w=400&auto=format&fit=crop"
              class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="Kayaking">
          </div>
        </div>

        <div class="lg:w-2/5 flex flex-col justify-center">
          <h3 class="text-4xl md:text-5xl  text-accent leading-[1.15] mb-8">
            You are planning the<br>next trip!
          </h3>

          <div class="space-y-6 text-neutral text-lg leading-relaxed mb-10">
            <p>
              Plan your next trip to fulfill your desires. Visit our trending page, which helps you find outstanding deals in great destinations. Our website brings all those things which make your journey.
            </p>
            <p>
              Discover those destinations that make you relax & create unforgettable memories. Whether you're planning any big international journey or a normal weekend getaway.
            </p>
          </div>

          <div>
            <a href="#" class="inline-block bg-accent text-accent-content px-12 py-4 rounded-full font-bold text-sm tracking-widest shadow-xl hover:bg-accent/90 transition-all transform hover:scale-105 active:scale-95">
              Find More
            </a>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-accent py-20 px-4 sm:px-6 lg:px-8 text-accent-content overflow-hidden ">
      <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16">

        <div class="lg:w-1/2 ">
          <h2 class="text-4xl md:text-5xl  mb-4 text-accent-content">Why Travelers Choose Us?</h2>
          <p class="text-accent-content/80 mb-12 max-w-lg">Our mission is to drive progress and enhance the lives of our customers by delivering superior products and services that exceed.</p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
              <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <h4 class="text-xl font-bold mb-2">Best Price Guarantee</h4>
              <p class="text-sm text-accent-content/80">Get the lowest fares with no hidden changes.</p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl  border-white/20">
              <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
              </div>
              <h4 class="text-xl font-bold mb-2">24/7 Support</h4>
              <p class="text-sm text-accent-content/80">We're always here to help you.</p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
              <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
              </div>
              <h4 class="text-xl font-bold mb-2">Secure & Trusted</h4>
              <p class="text-sm text-accent-content/80">Book with conditions, your data is safe.</p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
              <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
              </div>
              <h4 class="text-xl font-bold mb-2">Flexible Options</h4>
              <p class="text-sm text-accent-content/80">Easy cancellations and changes.</p>
            </div>
          </div>
        </div>

        <div class="lg:w-1/2 relative flex justify-center items-center h-[500px]">
          <div class="w-80 h-80 rounded-full  overflow-hidden relative z-20 shadow-2xl">
            <img src="https://images.unsplash.com/photo-1527631746610-bca00a040d60?q=80&w=800" class="w-full h-full object-cover" alt="Travelers">
          </div>
          <div class="absolute top-0 right-10 w-72 h-72 rounded-full overflow-hidden z-10 shadow-xl">
            <img src="https://images.unsplash.com/photo-1541410965313-d53b3c16ef17?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover" alt="Plane">
          </div>
          <div class="absolute bottom-10 right-0 w-52 h-52 rounded-full  overflow-hidden z-30 shadow-xl">
            <img src="https://images.unsplash.com/photo-1502003148287-a82ef80a6abc?q=80&w=388&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover" alt="Destination">
          </div>
        </div>
      </div>
    </section>
    <section class="py-16 md:py-24 bg-base-200  overflow-hidden"
      x-data="{ 
            emblaApi: null,
            selectedIndex: 0,
            canScrollNext: false,
            canScrollPrev: false,
            scrollSnaps: [],
            init() {
                const options = { loop: false, align: 'start', containScroll: 'trimSnaps' };
                this.emblaApi = EmblaCarousel(this.$refs.viewport, options);
                
                const updateState = () => {
                    this.selectedIndex = this.emblaApi.selectedScrollSnap();
                    this.canScrollPrev = this.emblaApi.canScrollPrev();
                    this.canScrollNext = this.emblaApi.canScrollNext();
                    this.scrollSnaps = this.emblaApi.scrollSnapList();
                };

                this.emblaApi.on('init', updateState);
                this.emblaApi.on('select', updateState);
                this.emblaApi.on('reInit', updateState);
            },
            scrollNext() {
                this.emblaApi.scrollNext();
            },
            scrollTo(index) {
                this.emblaApi.scrollTo(index);
            }
         }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 mb-12 py-4">
          <div class="md:w-1/3">
            <h2 class="text-4xl md:text-5xl text-primary  leading-tight ">
              Where Will You<br>Explore Next?
            </h2>
          </div>

          <div class="hidden md:block w-px h-24 bg-gray-200"></div>

          <div class="md:w-1/3">
            <p class="text-gray-500 text-sm leading-relaxed">
              Engage casual browsers to convert passive interest into active flight searches.
            </p>
          </div>

          <div class="hidden md:block w-px h-24 bg-gray-200"></div>

          <div class="md:w-auto shrink-0">
            <a href="{{ route('blog.index') }}"
              class="bg-[#1D35D1] text-white px-10 py-4 rounded-full font-bold text-xs tracking-widest hover:bg-blue-800 transition shadow-xl transform hover:scale-105 active:scale-95 block text-center">
               VIEW ALL DESTINATIONS
            </a>
          </div>
        </div>
        <div class="relative group">
          <div class="overflow-hidden" x-ref="viewport">
            <div class="flex gap-6 touch-pan-y pb-8">

              @php
              $slides = [
              ['city' => 'Japan', 'img' => 'https://images.unsplash.com/photo-1528127269322-539801943592?q=80&w=600'],
              ['city' => 'London', 'img' => 'https://plus.unsplash.com/premium_photo-1671734045770-4b9e1a5e53a0?q=80&w=600'],
              ['city' => 'Paris', 'img' => 'https://images.unsplash.com/photo-1511739001486-6bfe10ce785f?q=80&w=600'],
              ['city' => 'Miami', 'img' => 'https://images.unsplash.com/photo-1514214246283-d427a95c5d2f?q=80&w=600'],
              ['city' => 'Singapore', 'img' => 'https://images.unsplash.com/photo-1720941001711-2d1a1d46cc83?q=80&w=600']
              ];
              @endphp

              @foreach($slides as $slide)
              <div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[30%] flex-[0_0_85%] sm:flex-[0_0_45%] lg:flex-[0_0_30%] group/card">
                <div class="relative h-[450px] overflow-hidden rounded-[2.5rem] shadow-sm">
                  <img src="{{ $slide['img'] }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110"
                    alt="{{ $slide['city'] }}">

                  <div class="absolute inset-x-6 bottom-6">
                    <div class="bg-white/20 backdrop-blur-lg border border-white/30 rounded-3xl py-4 text-center shadow-xl">
                      <span class="text-white  text-sm uppercase tracking-[0.3em]">{{ $slide['city'] }}</span>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <button
            @click="scrollNext()"
            x-show="canScrollNext"
            class="absolute right-0 top-1/2 -translate-y-1/2 z-30 bg-accent text-accent-content p-5 rounded-full shadow-2xl translate-x-1/2 hover:scale-110 transition active:scale-95">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
              <path d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
        <div class="flex justify-center gap-3 mt-4">
          <template x-for="(snap, index) in scrollSnaps" :key="index">
            <button
              @click="scrollTo(index)"
              class="h-2 rounded-full transition-all duration-300"
              :class="selectedIndex === index ? 'w-8 bg-accent' : 'w-2 bg-primary/10'"></button>
          </template>
        </div>
      </div>
    </section>
    <section class="text-white bg-primary py-24 px-4 sm:px-6 lg:px-8 border-t border-white/10 ">
      <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl   mb-4">Loved by over thousand travelers -</h2>
        <p class="text-white/70 mb-16">Real stories from real people! See how our services have transformed their experiences.</p>

        <style>
          @keyframes scroll-left {
            0% {
              transform: translateX(0);
            }

            100% {
              transform: translateX(-50%);
            }
          }

          @keyframes scroll-right {
            0% {
              transform: translateX(-50%);
            }

            100% {
              transform: translateX(0);
            }
          }

          .animate-scroll-left {
            animation: scroll-left 40s linear infinite;
          }

          .animate-scroll-right {
            animation: scroll-right 40s linear infinite;
          }

          .pause-hover:hover {
            animation-play-state: paused;
          }
        </style>

        <div class="space-y-8 overflow-hidden text-white [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
          <!-- Row 1: Scroll Left -->
          <div class="flex gap-6 animate-scroll-left w-max pause-hover">
            {{-- Duplicate the loop to create seamless infinite scroll --}}
            @for ($k = 0; $k < 2; $k++)
              @for ($i=0; $i < 8; $i++)
              <div class="w-[300px] bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20 text-left flex-shrink-0">
              <div class="flex text-warning mb-4">
                @for ($j = 0; $j < 5; $j++)
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                  @endfor
              </div>
              <p class=" text-sm mb-6 leading-relaxed">Many users appreciate platforms that are easy to navigate, allowing both recruiters and candidates.</p>
              <div class="flex items-center gap-3">
                <img class="w-10 h-10 rounded-full object-cover" src="https://i.pravatar.cc/150?u={{$i}}" alt="User">
                <div>
                  <p class="text-white font-bold text-xs uppercase tracking-wider">Donald Trump</p>
                </div>
              </div>
          </div>
          @endfor
          @endfor
        </div>

        <!-- Row 2: Scroll Right -->
        <div class="flex gap-6 text-white animate-scroll-right w-max pause-hover">
          {{-- Duplicate the loop to create seamless infinite scroll --}}
          @for ($k = 0; $k < 2; $k++)
            @for ($i=8; $i < 16; $i++)
            <div class="w-[300px] bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20 text-left flex-shrink-0">
            <div class="flex text-warning mb-4">
              @for ($j = 0; $j < 5; $j++)
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                @endfor
            </div>
            <p class="text-white text-sm mb-6 leading-relaxed">Many users appreciate platforms that are easy to navigate, allowing both recruiters and candidates.</p>
            <div class="flex items-center gap-3">
              <img class="w-10 h-10 rounded-full object-cover" src="https://i.pravatar.cc/150?u={{$i}}" alt="User">
              <div>
                <p class="text-white font-bold text-xs uppercase tracking-wider">Donald Trump</p>
              </div>
            </div>
        </div>
        @endfor
        @endfor
      </div>
      </div>
      </div>
    </section>
    <section class="">
      <x-latest-blog-posts />
    </section>
  </main>
  @include('layouts.footer')
</body>

</html>