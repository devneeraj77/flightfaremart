<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Testimonial;

class Testimonials extends Component
{
    public $testimonials;

    public function __construct($testimonials = null)
    {
        // if no testimonials passed, load from DB
        $this->testimonials = $testimonials ?? Testimonial::latest()->get();
    }

    public function render()
    {
        return view('components.testimonials');
    }
}
