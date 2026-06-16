<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use Filament\Widgets\ChartWidget;

class PendapatanChart extends ChartWidget
{
    protected ?string $heading = 'Pendapatan Bulanan';

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getData(): array
    {
        $data = [];

        for ($i = 1; $i <= 12; $i++) {

            $data[] = Pembayaran::query()
                ->where('status', 'berhasil')
                ->whereMonth('dibayar_pada', $i)
                ->sum('jumlah');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data,
                ],
            ],

            'labels' => [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
