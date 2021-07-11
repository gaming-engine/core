<?php

namespace GamingEngine\Core\Framework\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrameworkMigration extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];
}
