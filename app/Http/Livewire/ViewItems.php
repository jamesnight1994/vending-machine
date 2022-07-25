<?php

namespace App\Http\Livewire;

use App\Models\Slot;
use Livewire\Component;

class ViewItems extends Component
{
    public $cols,$rows;

    public function __construct() {
        $slots = Slot::where('capacity','>','0')->get()->toArray();
        
        $cols = collect($slots)->groupBy('col')->toArray();
        $rows = collect($slots)->groupBy('row')->toArray();
        // dd($cols);
        
        $this->cols = $cols;
        $this->rows = $rows;
    }
    public function render()
    {
        return view('livewire.view-items');
    }
}
