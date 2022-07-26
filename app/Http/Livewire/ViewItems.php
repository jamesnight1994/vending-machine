<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use Livewire\Component;

class ViewItems extends Component
{
    public $cols,$rows;

    public function __construct() {
        $slots = Slot::has('item')->with(['item'])->get();
        
        $cols = collect($slots)->groupBy('col')->toArray();
        $rows = collect($slots)->groupBy('row')->toArray();
        // dd();
        
        $this->cols = $cols;
        $this->rows = $rows;
    }
    public function render()
    {
        return view('livewire.view-items');
    }
}
