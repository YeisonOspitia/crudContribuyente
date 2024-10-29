<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContribuyenteForm extends Component
{
    public $contribuyente;
    public $action;
    public $method;

    public function __construct($contribuyente = null, $action, $method = 'POST')
    {
        $this->contribuyente = $contribuyente;
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $usuario = auth()->user()->name;
        return view('components.contribuyente-form', compact('usuario'));
    }
}
