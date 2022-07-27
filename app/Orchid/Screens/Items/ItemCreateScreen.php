<?php

namespace App\Orchid\Screens\Items;

use App\Models\{Item,Slot};
use Illuminate\Http\Request;
use Orchid\Attachment\File;
use Orchid\Screen\Fields\Image;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\{Quill,Select};
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

            Button::make('Create')
                ->icon('plus')
                ->method('createOrUpdate')
                ->canSee(!$this->item->exists),

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
        $availableSlots = Slot::whereDoesntHave('item')->get()
            ->transform(function($slot,$key){
                return [
                    'id' => $slot->id,
                    'slot' => $slot->col.$slot->row,
                ];
            })->pluck('slot','id');
            return [
            Layout::rows([
                Input::make('item.name')
                    ->title('Name')
                    ->placeholder('Enter name of the item')
                    ->help('A short specific name for the item'),
                    
                Select::make('item.slot')
                    ->title('Slot')
                    ->options($availableSlots)
                    ->empty('No select'),
                    
                Input::make('item.price')
                    ->title('price')
                    ->empty('No select'),

                Input::make('item.stock')
                    ->type('number')
                    ->title('Stock')
                    ->placeholder('How many items do you want to load')
                    ->help('How many are you stocking in the venidng machine.'),

                Picture::make('item.image')
                    ->title('Image'),
            ])
        ];
    }

    /**
     * @param Item    $item
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Item $item, Request $request)
    {
        $slot = Slot::find($request->item['slot']);
        $request->validate([
            'item.name' => 'required',
            'item.price' => 'required',
            'item.slot' => 'required',
            'item.image' => 'required',
            'item.stock' => 'required',
        ]);
        
        
        $item->fill($request->get('item'))
            ->slot()->associate($request->item['slot'])
            ->save();
        
        $slot->save();

        Alert::info('You have successfully loaded an item.');

        return redirect()->route('platform.items.edit');
    }

    /**
     * @param Item $item
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Item $item)
    {
        $item->delete();

        Alert::info('You have successfully deleted the item.');

        return redirect()->route('platform.post.list');
    }
}
