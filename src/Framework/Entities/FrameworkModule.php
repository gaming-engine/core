<?php

namespace GamingEngine\Core\Framework\Entities;

use GamingEngine\Core\Framework\Observers\FrameworkModuleObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrameworkModule extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::observe(FrameworkModuleObserver::class);
    }
}
