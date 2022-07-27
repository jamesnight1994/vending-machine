<?php

namespace App\Http\Livewire;

use App\Models\{Item,Slot};
use Livewire\Component;

class ViewItems extends Component
{
    public $cols,$rows;

    public array $selectedItem, $denoms;

    public function __construct() {
        $slots = Slot::has('item')->with(['item'])->get();
        
        $cols = collect($slots)->groupBy('col')->toArray();
        $rows = collect($slots)->groupBy('row')->toArray();
        // dd();
        
        $this->cart = [];
        $this->denoms = [
            [
                'value' => 5,
                'type' => 'cent',
                'image' => '',
            ],
            [
                'value' => 10,
                'type' => 'cent',
                'image' => '',
            ],
            [
                'value' => 25,
                'type' => 'cent',
                'image' => '',
            ],
            [
                'value' => 50,
                'type' => 'cent',
                'image' => '',
            ],
            [
                'value' => 1,
                'type' => 'dollar',
                'image' => '',
            ],
            [
                'value' => 2,
                'type' => 'dollar',
                'image' => '',
            ],
            [
                'value' => 5,
                'type' => 'dollar',
                'image' => '',
            ],
            
            [
                'value' => 10,
                'type' => 'dollar',
                'image' => '',
            ],
            [
                'value' => 20,
                'type' => 'dollar',
                'image' => '',
            ],
            [
                'value' => 50,
                'type' => 'dollar',
                'image' => '',
            ],
            [
                'value' => 100,
                'type' => 'dollar',
                'image' => '',
            ]
        ];
        $this->cols = $cols;
        $this->rows = $rows;
    }

    public function buy(array $denoms)
    {
        $cash = json_decode($denoms);
        $cash = collect($cash);
        $total = 0;
        
        // take the cents see how many dollars they add up to
        $cash->where('type','cent')->each(function($denom,$key) use($total){
            $total += $denom['value'];

        });
        // convert to dollars
        $total = $total/100;

        // add up the dollars
        $cash->where('type','dollar')->each(function($denom,$key) use($total){
            $total += $deno['value'];

        });

        dd($total);
        
    }

    public function selectItem(array $item)
    {
        $this->selectedItem[] = $item;
    }
    
    public function render()
    {
        return view('livewire.view-items');
    }
}
