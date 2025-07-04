<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Menu extends Component
{
    public $openSubmenu = '';
    public $isMobile = false;
    public $showSearchBox = false;

    public function mount($isMobile = false)
    {
        $this->isMobile = $isMobile;
    }

    public function toggleSubmenu($menuName)
    {
        if ($this->openSubmenu === $menuName) {
            $this->openSubmenu = '';
        } else {
            $this->openSubmenu = $menuName;
        }
    }

    public function closeAllSubmenus()
    {
        $this->openSubmenu = '';
    }

    public function toggleSearchBox()
    {
        $this->showSearchBox = !$this->showSearchBox;
    }

    public function render()
    {
        return view('livewire.components.menu');
    }
}
