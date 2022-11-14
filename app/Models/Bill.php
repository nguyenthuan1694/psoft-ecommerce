<?php

namespace App\Models;

use App\Models\Traits\Relationship\BillRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use BillRelationship,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    // protected $with = ['Books'];

    protected $dates = ['created_at', 'updated_at'];

    public $asYouType = true;
    
}
