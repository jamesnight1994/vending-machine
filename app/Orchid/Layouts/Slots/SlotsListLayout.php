<?php

namespace App\Orchid\Layouts\Slots;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SlotsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'slots';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('row'),
            TD::make('capacity'),
            TD::make('stock'),
            TD::make('image'),
        ];
    }
}
