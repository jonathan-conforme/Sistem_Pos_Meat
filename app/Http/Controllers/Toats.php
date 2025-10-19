<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    public $type;
    public $message;

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'success', $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.toast');
    }
}
