<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyRate extends Model
{
    protected $fillable = [
        'from_currency',
        'to_currency',
        'rate',
        'effective_date',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'rate' => 'decimal:6',
        'effective_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForPair($query, string $from, string $to)
    {
        return $query->where('from_currency', strtoupper($from))
            ->where('to_currency', strtoupper($to));
    }

    public function scopeEffectiveOn($query, $date = null)
    {
        $date = $date ?? now()->toDateString();
        return $query->where('effective_date', '<=', $date)
            ->orderByDesc('effective_date');
    }

    public static function getRate(string $from, string $to, $date = null): ?float
    {
        if (strtoupper($from) === strtoupper($to)) {
            return 1.0;
        }

        $rate = static::query()
            ->active()
            ->forPair($from, $to)
            ->effectiveOn($date)
            ->first();

        return $rate ? (float) $rate->rate : null;
    }

    public static function convert(float $amount, string $from, string $to, $date = null): ?float
    {
        $rate = static::getRate($from, $to, $date);
        
        if ($rate === null) {
            return null;
        }

        return round($amount * $rate, 2);
    }
}
