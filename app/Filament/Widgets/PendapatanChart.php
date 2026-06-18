<?php

namespace App\Filament\Widgets;

use App\Models\Pembayaran;
use Filament\Widgets\ChartWidget;

class PendapatanChart extends ChartWidget
{
    protected ?string $heading = 'Pendapatan Bulanan';

    protected ?string $description = 'Grafik total pendapatan setiap bulan';

    protected int|string|array $columnSpan = 2;

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
                    'backgroundColor' => '#f59e0b',
                    'hoverBackgroundColor' => '#d97706',
                    'borderRadius' => 8,
                    'borderSkipped' => false,
                    'maxBarThickness' => 50,
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

    protected function getOptions(): array
    {
        return [
            'responsive' => true,

            'plugins' => [
                'legend' => [
                    'display' => false,
                ],

                'tooltip' => [
                    'callbacks' => [
                        'label' => "function(context) {
                            return 'Rp ' + context.raw.toLocaleString('id-ID');
                        }",
                    ],
                ],
            ],

            'scales' => [
                'y' => [
                    'beginAtZero' => true,

                    'grid' => [
                        'color' => '#e2e8f0',
                        'drawBorder' => false,
                    ],

                    'ticks' => [
                        'color' => '#64748b',
                    ],
                ],

                'x' => [
                    'grid' => [
                        'display' => false,
                    ],

                    'ticks' => [
                        'color' => '#64748b',
                    ],
                ],
            ],
        ];
    }
}
