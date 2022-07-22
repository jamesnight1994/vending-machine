<?php

namespace App\Orchid\Screens\Slots;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\Slots\SlotsListLayout;

class SlotIndexScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'slots' => [],
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Slots';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            SlotsListLayout::class,
        ];
    }
}
