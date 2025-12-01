<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\CurrencyRate;
use Illuminate\Database\Seeder;

class CurrencyRatesSeeder extends Seeder
{
    public function run(): void
    {
        $rates = [
            ['from_currency' => 'USD', 'to_currency' => 'EGP', 'rate' => 30.90],
            ['from_currency' => 'EGP', 'to_currency' => 'USD', 'rate' => 0.0324],
            ['from_currency' => 'EUR', 'to_currency' => 'EGP', 'rate' => 33.50],
            ['from_currency' => 'EGP', 'to_currency' => 'EUR', 'rate' => 0.0299],
            ['from_currency' => 'GBP', 'to_currency' => 'EGP', 'rate' => 39.10],
            ['from_currency' => 'EGP', 'to_currency' => 'GBP', 'rate' => 0.0256],
            ['from_currency' => 'SAR', 'to_currency' => 'EGP', 'rate' => 8.24],
            ['from_currency' => 'EGP', 'to_currency' => 'SAR', 'rate' => 0.1214],
            ['from_currency' => 'AED', 'to_currency' => 'EGP', 'rate' => 8.41],
            ['from_currency' => 'EGP', 'to_currency' => 'AED', 'rate' => 0.1189],
            ['from_currency' => 'KWD', 'to_currency' => 'EGP', 'rate' => 100.60],
            ['from_currency' => 'EGP', 'to_currency' => 'KWD', 'rate' => 0.0099],
            ['from_currency' => 'USD', 'to_currency' => 'EUR', 'rate' => 0.92],
            ['from_currency' => 'EUR', 'to_currency' => 'USD', 'rate' => 1.09],
        ];

        $effectiveDate = now()->toDateString();

        foreach ($rates as $data) {
            CurrencyRate::firstOrCreate(
                [
                    'from_currency' => $data['from_currency'],
                    'to_currency' => $data['to_currency'],
                    'effective_date' => $effectiveDate,
                ],
                [
                    'rate' => $data['rate'],
                    'is_active' => true,
                    'created_by' => 1,
                ]
            );
        }
    }
}
