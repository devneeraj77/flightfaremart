<!DOCTYPE html>
{{-- Assumed Includes --}}
@extends('admin.layouts.app') 

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

@section('content')
<section>
  <!-- set here my dashboard showcase activity my total blog posts, categories and recently my create posts and(add as your preference in need any activity status) -->
</section>
@endsection

</html>