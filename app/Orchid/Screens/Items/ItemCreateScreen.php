<?php

namespace App\Orchid\Screens\Items;

use App\Models\Item;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Image;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ItemCreateScreen extends Screen
{
    public $item;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Item $item): iterable
    {
        return [
            'item' => $item
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Add an Item';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->item->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->item->exists),
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
                Input::make('item.name')
                    ->title('Name')
                    ->placeholder('Enter name of the item')
                    ->help('A short specific name for the item'),
                    
                Input::make('item.slot_no')
                    ->title('Slot Number')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Item Slot Number'),

                Input::make('item.stock')
                    ->type('number')
                    ->title('Stock')
                    ->placeholder('Attractive but mysterious title')
                    ->help('How many are you stocking in the venidng machine.'),

                Picture::make('item.image')
                    ->title('Image'),
            ])
        ];
    }
}
