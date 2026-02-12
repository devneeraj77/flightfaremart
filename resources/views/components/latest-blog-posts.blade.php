@if($posts->isNotEmpty())
<section class="py-16 md:py-24 bg-[#F0F2FF] font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-gray-200 pb-8 gap-6">
            <div class="max-w-xl">
                <h2 class="text-4xl md:text-5xl font-black text-black mb-4">
                    Travel Tips, Insights<br>& Inspiration
                </h2>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Stay updated with the latest travel trends, destinations guides, and flight booking tips, from hidden gems to money-saving hacks. Our blog is here to make your journey smarter and more exciting.
                </p>
            </div>
            <a href="{{ route('blog.index') }}" class="bg-[#1D35D1] text-white px-8 py-3 rounded-full font-bold text-xs tracking-widest hover:bg-blue-800 transition shadow-lg">
                READ ALL ARTICLES
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($posts as $post)
            @if($post->category && $post->author)
            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm flex flex-col sm:flex-row h-full transition-transform hover:scale-[1.01]">
                
                <div class="sm:w-2/5 relative min-h-[200px]">
                    <a href="{{ route('blog.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                        <img 
                            class="absolute inset-0 w-full h-full object-cover p-3 rounded-[2rem]" 
                            src="{{ $post->imageAsset->image_url ?? 'https://via.placeholder.com/400x400' }}" 
                            alt="{{ $post->title }}">
                    </a>
                </div>

                <div class="sm:w-3/5 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="flex items-center gap-2 text-[#1D35D1] font-bold text-[10px] uppercase tracking-wider">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                                {{ $post->category->name }}
                            </span>
                            <span class="text-gray-400 text-[10px] font-bold uppercase">
                                {{ $post->published_at->format('M d, Y') }}
                            </span>
                        </div>

                        <a href="{{ route('blog.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                            <h3 class="text-xl font-black text-black leading-tight mb-3 hover:text-blue-700 transition">
                                {{ Str::limit($post->title, 45) }}
                            </h3>
                        </a>

                        <p class="text-gray-400 text-xs leading-relaxed mb-4">
                            {{ Str::limit($post->excerpt, 85) }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                        <div class="text-[10px] font-bold">
                            <span class="text-gray-400">AUTHOR:</span> 
                            <span class="text-black uppercase ml-1">{{ $post->author->name }}</span>
                        </div>
                        <a href="{{ route('blog.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}" 
                           class="text-[#1D35D1] font-black text-[10px] uppercase border border-gray-200 px-4 py-2 rounded-full hover:bg-gray-50 transition">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif