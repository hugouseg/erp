<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $table = 'system_settings';

    /**
     * Generic key/value settings storage.
     *
     * - key      : unique identifier (e.g. "app.name", "pos.receipt.footer")
     * - value    : json value
     * - type     : optional type hint (string,int,bool,array,json,encrypted,...)
     * - group    : logical group (e.g. "app","mail","pos","hr")
     * - is_public: whether it can be exposed to clients without auth
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'is_public',
    ];

    protected $casts = [
        'value'     => 'array',
        'is_public' => 'bool',
    ];

    /** Scopes */

    public function scopeKey($q, string $key)
    {
        return $q->where('key', $key);
    }

    public function scopeGroup($q, string $group)
    {
        return $q->where('group', $group);
    }
}
