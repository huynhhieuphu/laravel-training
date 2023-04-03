<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Button extends Component
{
    public $buttonState;
    public $title;
    public function __construct($buttonState = 'primary', $title = 'Add')
    {
        $this->buttonState = $buttonState;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.button');
    }
}
