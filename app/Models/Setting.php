<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];

    // Helper to get value
    public static function getValue($key, $default = null)
    {
        $setting = self::find($key);
        return $setting ? $setting->value : $default;
    }

    // Helper to set value
    public static function setValue($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
