<?php

namespace App\Orchid\Screens\Items;

use App\Models\Item;
use App\Orchid\Layouts\Items\ItemsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;


class ItemsIndexScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'items' => Item::paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Items';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.items.create')
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
            ItemsListLayout::class,
        ];
    }
}
