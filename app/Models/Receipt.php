<?php

namespace App\Models;

use App\Models\Traits\Relationship\ReceiptRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use ReceiptRelationship,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    // protected $with = ['Books'];

    protected $dates = ['created_at', 'updated_at'];

    public $asYouType = true;
    
}
