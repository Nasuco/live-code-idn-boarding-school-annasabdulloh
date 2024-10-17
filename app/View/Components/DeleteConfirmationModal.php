<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteConfirmationModal extends Component
{
    public $deleteId;
    /**
     * Create a new component instance.
     */
    public function __construct($deleteId = null)
    {
        $this->deleteId = $deleteId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-confirmation-modal');
    }
}
