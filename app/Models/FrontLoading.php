<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Traits\HasDraft;

class FrontLoading extends Model
{
    use HasDraft;
    //
    protected $table = 'prd_daily_foreman_front_loading';

    protected $fillable = [
        'statusenabled',
        'uuid',
        'daily_report_uuid',
        'daily_report_id',
        'nomor_unit',
        'checked',
        'keterangan',
        'siang',
        'malam',
        'is_draft',
    ];

    protected $guarded = [];

    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'daily_report_uuid');
    }

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = (string) Uuid::uuid4()->toString();
    //     });
    // }
}
