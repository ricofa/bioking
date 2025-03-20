<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'new' => Tab::make()->query(fn($query) => $query->Where('status', 'new')),
            'processing' => Tab::make()->query(fn($query) => $query->Where('status', 'processing')),
            'shipped' => Tab::make()->query(fn($query) => $query->Where('status', 'shipped')),
            'delivered' => Tab::make()->query(fn($query) => $query->Where('status', 'delivered')),
            'cancelled' => Tab::make()->query(fn($query) => $query->Where('status', 'cancelled')),
        ];
    }
}
