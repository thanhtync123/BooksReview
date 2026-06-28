<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StarRating extends Component
{
    public $rating;
    public function __construct($rating)
    {
        $this->rating=$rating;
    }

    public function render(): View|Closure|string
    {
        return view('components.star-rating');
    }
}
