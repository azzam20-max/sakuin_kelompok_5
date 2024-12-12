<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pemasukan = Transaction::incomes()->get()->sum('amount'); 
        $pengeluaran = Transaction::expenses()->get()->sum('amount'); 
        // pemasukan bisa menggunakan query berikut 
        // $pemasukan = Transaction::join('categories', 'transactions.category_id', '=', 'categories.id')
        //         ->where('categories.is_expense', false)
        //         ->sum('amount');

        return [
            Stat::make('Total Pemasukan',  $pemasukan ),
            Stat::make('Total Pengeluaran', $pengeluaran),
            Stat::make('Selisih Keuangan', $pemasukan - $pengeluaran),
        ];
    }
}
