<?php

namespace App\Orchid\Screens\Slots;

use App\Models\Slot;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Image;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\{NumberRange,Picture};
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class SlotCreateScreen extends Screen
{
    public $slot;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Slot $slot): iterable
    {
        return [
            'slot' => $slot
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Add an slot';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create slots')
                ->icon('plus')
                ->method('create'),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                  
                Input::make('slot.cols')
                    ->title('Columns')->type('number')
                    ->help('Number of columns'),

                Input::make('slot.rows')
                    ->title('Rows')->type('number')
                    ->help('Number of rows'),

                Input::make('slot.capacity')
                    ->title('Capacity')->type('number')
                    ->help('Capacity for each slot'),

            ])
        ];
    }
    
    public function create(Slot $slot, Request $request)
    {
        $input = $request->slot;;
        $cols = [];
        $alphabet = range('A','Z');
        // for each column 0<x<26 && each row will be an alphabet
        for($i =0; $i<$input['cols'];$i++){
            $col = $alphabet[$i];

            // each row x<$input['rows']
            for($j=1;$j<=$input['rows'];$j++){
                $cols [] = [
                    'col' => $col,
                    'row' => $j,
                    'capacity' => $input['capacity'],
                ];

            }
        }
        $slot->insert($cols);

        $racks = $input['cols'] * $input['rows'];
        $capacity = $input['capacity'];
        Alert::info("You have successfully created an {$racks} each with a capacity of {$capacity}.");

    }
}
