<?php

namespace App\Http\Livewire;

use App\Models\{Item,Slot};
use Livewire\Component;

class ViewItems extends Component
{
    public $cols,$rows;
    public $collectedCash, $selectedItem, $status;
    public array $denoms;

    public function __construct() {
        $slots = Slot::has('item')->with(['item'])->get();
        
        $cols = collect($slots)->groupBy('col')->toArray();
        $rows = collect($slots)->groupBy('row')->toArray();
        // dd();
        
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

    public function cleanUp()
    {
        $this->selectedItem = null;
        $this->collectedCash = 0;
    }
    public function buy()
    {
        $collectedCash = $this->collectedCash;
        $selectedItem = $this->selectedItem;
        $price = $selectedItem['price']??[];

        // check if the amount is enough
        if($collectedCash == $price && !is_null($selectedItem)){
            $item = Item::find($selectedItem['id']);
            if($item->stock > 0){
                $item->decrement('stock',1);
                $this->status = $selectedItem['name']."purchased";
                $this->cleanUp();
            }else{
                $this->status = $selectedItem['name']."is out of stock";
            }
        }
        if($collectedCash > $price && !is_null($selectedItem)){
            // if the collected cash is less than the price
            $item = Item::find($selectedItem['id']);
            if($item->stock > 0){
                $item->decrement('stock',1);
                $this->status = $selectedItem['name']."purchased";
                $this->cleanUp();
            }else{
                $this->status = $selectedItem['name']."is out of stock";
            }
        }
        if($collectedCash < $price && !is_null($selectedItem)) {
            // if the collected cash is less than the price
            $this->status = "Please enter enough cash to purchase: ".$selectedItem['name'];
        }
        if(is_null($selectedItem)){
            $this->status = "No item selected";
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
