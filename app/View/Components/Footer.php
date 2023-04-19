<?php

namespace App\View\Components;

use App\Models\Counter;
use Illuminate\View\Component;

class Footer extends Component
{
    public $counters;

    const POSITION = 3;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->counters =  Counter::where('position',self::POSITION)->where('status',1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
