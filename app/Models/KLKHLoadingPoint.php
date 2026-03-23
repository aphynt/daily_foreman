<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class KLKHLoadingPoint extends Model
{
    //
    protected $table = 'prd_klkh_loadingpoint';

    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = (string) Uuid::uuid4()->toString();
    //     });
    // }
}
