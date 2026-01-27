<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public string $type;

    public function __construct(string $type = 'primary')
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('components.button');
    }
}
