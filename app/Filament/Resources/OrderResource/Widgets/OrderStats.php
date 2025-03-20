<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count()),
            Stat::make('Order Processing', Order::query()->where('status', 'processing')->count()),
            Stat::make('Order Shipped', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Average Price', function () {
                $avg = Order::query()->avg('grand_total');
                if ($avg >= 1000000) {
                    return 'Rp ' . number_format($avg / 1000000, 1) . 'M';
                } elseif ($avg >= 1000) {
                    return 'Rp ' . number_format($avg / 1000, 1) . 'K';
                }
                return 'Rp ' . number_format($avg, 0, ',', '.');
            })
        ];
    }
}
