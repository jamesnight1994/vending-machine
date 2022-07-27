<?php

namespace App\Http\Livewire;

use App\Models\{Item,Slot};
use Livewire\Component;

class ViewItems extends Component
{
    public $cols,$rows;
    public $collectedCash, $selectedItem;
    public array $denoms;

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
        $collectedCash = $this->collectCash;
        $selectedItem = $this->selectItem;
        // check if the amount is enough
        if($collectCash == $selectItem['price']){
            $item = Item::find($selectItem['id'])->decrement('stock',1);
        }
        
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
        $this->selectedItem = $item;
    }
    
    public function render()
    {
        return view('livewire.view-items');
    }
}
