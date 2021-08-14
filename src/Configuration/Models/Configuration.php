<?php

namespace GamingEngine\Core\Configuration\Models;

use Closure;
use GamingEngine\Core\Configuration\Enumerations\ConfigurationValueTypes;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationLockedException;
use GamingEngine\Core\Configuration\Observers\ConfigurationObserver;
use GamingEngine\Core\Framework\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Configuration extends Model
{
    use HasFactory;
    use SoftDeletes;

    private static bool $locked = true;

    public static function leaveUnlocked()
    {
        static::$locked = false;
    }

    public static function unlock(Closure $closure)
    {
        static::$locked = false;

        $response = $closure();

        static::$locked = true;

        return $response;
    }

    public static function scopeCategory(Builder $query, string $type)
    {
        $query->whereCategory($type);
    }

    protected static function boot()
    {
        parent::boot();
        static::observe(ConfigurationObserver::class);
    }

    /**
     * Retrieves the type-casted version of the configuration
     *
     * @return bool|float|int|string|null
     */
    public function getValueAttribute()
    {
        return $this->coerceValue(
            $this->attributes['value'] === null
                ? $this->attributes['default_value']
                : $this->attributes['value']
        );
    }

    /**
     * Converts the provided value to the appropriate data type.
     *
     * @param mixed|null $value
     * @return bool|float|int|string|null
     */
    private function coerceValue($value)
    {
        switch ($this->type) {
            case ConfigurationValueTypes::BOOLEAN:
                return in_array($value, ['1', 1, 'true', true], true);
            case ConfigurationValueTypes::INTEGER:
                return intval($value);
            case ConfigurationValueTypes::NUMBER:
                return floatval($value);
            case ConfigurationValueTypes::STRING:
            default:
                return $value;
        }
    }

    public function setValueAttribute(?string $value)
    {
        if ($value === null) {
            $this->attributes['value'] = null;

            return;
        }

        $this->attributes['value'] = $this->coerceValue($value);
    }

    public function setDefaultValueAttribute(?string $value)
    {
        if (static::$locked) {
            throw new ConfigurationLockedException($this, $value);
        }

        $this->attributes['default_value'] = $this->coerceValue($value);
    }

    public function getPropertyNameAttribute(): string
    {
        return Str::camel($this->key);
    }
}
