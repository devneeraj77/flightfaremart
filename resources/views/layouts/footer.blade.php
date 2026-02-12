<div class="relative z-20 max-w-5xl mx-auto px-4 -mb-32">
    <div class="bg-white rounded-[3rem] p-10 md:p-16 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
        <div class="relative w-48 h-48 hidden lg:block">
             <img src="{{ asset('img/hero-banner-circle.png') }}" class="rounded-full object-cover w-full h-full shadow-lg" alt="Fly Smarter">
        </div>
        
        <div class="flex-1">
            <h2 class="text-4xl md:text-5xl font-black text-black leading-tight mb-6">
                Fly Smarter, Pay Smarter,<br>Travel With Crypto
            </h2>
            <button class="bg-[#1D35D1] text-white px-10 py-4 rounded-full font-bold text-sm tracking-widest hover:bg-blue-800 transition transform hover:scale-105">
                COMPARE
            </button>
        </div>

        <div class="hidden md:flex flex-col gap-4">
             <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg overflow-hidden translate-x-10">
                 <img src="https://i.pravatar.cc/150?u=1" class="w-full h-full object-cover">
             </div>
             <div class="w-16 h-16 rounded-full border-4 border-white shadow-lg overflow-hidden -translate-x-4">
                 <img src="https://i.pravatar.cc/150?u=2" class="w-full h-full object-cover">
             </div>
        </div>
    </div>
</div>

<footer class="w-full bg-[#1D35D1] text-white font-sans relative overflow-hidden pt-48 pb-12">
    
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-30">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="dotPattern" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse">
                    <circle cx="40" cy="40" r="18" fill="white" fill-opacity="0.8" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dotPattern)" />
        </svg>
    </div>

    <div class="absolute top-20 left-1/2 transform -translate-x-1/2 z-10 flex flex-col items-center">
        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center p-4 shadow-xl">
             <img src="{{ asset('img/logo-blue.svg') }}" alt="Logo" class="w-full h-auto">
        </div>
        <div class="mt-4 text-[10px] font-bold tracking-[0.4em] uppercase text-white/60">
            Est. 2026 | FlightFareMart
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
            
            <div>
                <h3 class="text-lg font-black mb-6 uppercase tracking-wider">Company</h3>
                <ul class="space-y-3 text-sm text-blue-100">
                    <li><a href="/" class="hover:text-white transition">Home</a></li>
                    <li><a href="#" class="hover:text-white transition">About</a></li>
                    <li><a href="#" class="hover:text-white transition">Services</a></li>
                    <li><a href="#" class="hover:text-white transition">Blogs</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-black mb-6 uppercase tracking-wider">Travel Guides</h3>
                <ul class="space-y-3 text-sm text-blue-100">
                    <li><a href="#" class="hover:text-white transition">Cancellation & Refund</a></li>
                    <li><a href="#" class="hover:text-white transition">Change Flight</a></li>
                    <li><a href="#" class="hover:text-white transition">Compensation</a></li>
                    <li><a href="#" class="hover:text-white transition">Seat Upgrade</a></li>
                    <li><a href="#" class="hover:text-white transition">Voucher</a></li>
                    <li><a href="#" class="hover:text-white transition">Lost & Found</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-black mb-6 uppercase tracking-wider">Legal</h3>
                <ul class="space-y-3 text-sm text-blue-100">
                    <li><a href="#" class="hover:text-white transition">Terms and Conditions</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Site Map</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-black mb-6 uppercase tracking-wider">Subscribe</h3>
                <p class="text-sm text-blue-100 mb-6">Join our community to receive updates</p>
                <form class="flex items-center">
                    <input type="email" placeholder="mail@site.com" class="w-full bg-blue-800/40 border border-blue-400/50 rounded-l-xl px-4 py-3 text-sm focus:outline-none">
                    <button class="bg-white text-[#1D35D1] px-6 py-3 rounded-r-xl font-bold text-sm">Subscribe</button>
                </form>
            </div>
        </div>

        <hr class="border-blue-400/30 mb-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-black italic mb-2 tracking-tighter uppercase">Fly Fare Mart</h2>
                <p class="text-[10px] text-blue-300 max-w-md">Stop searching and start flying. FlightFareMart combines cutting-edge tech with radical transparency to bring the horizon closer to your wallet.</p>
            </div>

            <div class="flex gap-4">
                <a href="#" class="w-10 h-10 border border-blue-400/50 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-700 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 border border-blue-400/50 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-700 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
            </div>
        </div>
        
        <div class="mt-10 flex flex-col md:flex-row justify-between text-[9px] text-blue-300 opacity-60">
            <p>Disclaimer: Blah Blah Blah...........</p>
            <p>2026 FlightFareMart. All right reserved</p>
        </div>
    </div>
</footer>