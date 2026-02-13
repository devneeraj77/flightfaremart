<!-- Styles / Scripts -->
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
@vite(['resources/css/app.css', 'resources/js/app.js'])
@else
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

@endif
@props([
'title' => null,
'canonical' => null,
])

@php
    $canonicalUrl = $canonical ?? url()->current();

    // Remove /public from canonical URL
    $canonicalUrl = preg_replace('#/public(/|$)#', '/', $canonicalUrl);

    // Normalize trailing slash
    $canonicalUrl = rtrim($canonicalUrl, '/');
@endphp

<link rel="canonical" href="{{ $canonicalUrl }}">


{{-- Meta --}}
<meta name="robots" content="noindex, follow">

{{-- Google Analytics --}}
@include('layouts.analytics')