<?php

namespace App\Http\Livewire;

use App\Models\{Item,Slot};
use Livewire\Component;

class ViewItems extends Component
{
    public $cols,$rows;
    public $collectedCash;
    public array $selectedItem, $denoms;

    public function __construct() {
        $slots = Slot::has('item')->with(['item'])->get();
        
        $cols = collect($slots)->groupBy('col')->toArray();
        $rows = collect($slots)->groupBy('row')->toArray();
        // dd();
        
        $this->cart = [];
        $this->collectedCash = 0;
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

    public function buy()
    {
         // take the cents see how many dollars they add up to
         $cash->where('type','cent')->each(function($denom,$key) use($total){
            $total += $denom['value']??0;
        });
        // convert to dollars
        $total = $total/100;

        // add up the dollars
        $cash->where('type','dollar')->each(function($denom,$key) use($total){
            $total += $deno['value']??0;

        });
    }

    public function collectCash(array $denom)
    {
        $total = (float) 0;
        
       // if it is a cent
       if($denom['type'] == 'cent'){
        $total += $denom['value']/100;
       }elseif($denom['type'] == 'dollar'){
        $total += $denom['value'];
       }

        $this->collectedCash += $total;
        
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
