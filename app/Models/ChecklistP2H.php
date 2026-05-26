<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistP2H extends Model
{
    //
    // protected $table = 'prd_opr_checklistp2h';

    protected $connection = 'p2h';

    protected $table = 'opr_oprchecklist';
    public $timestamps = false;

    protected $guarded = [];


}
