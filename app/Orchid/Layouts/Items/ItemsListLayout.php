<?php

namespace App\Orchid\Layouts\Items;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ItemsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'items';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name'),
            TD::make('price'),
            TD::make('image'),
        ];
    }
}
