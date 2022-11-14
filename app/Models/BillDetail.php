<?php

namespace App\Models;

use App\Models\Traits\Relationship\BillDetailRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDetail extends Model
{
    use
    BillDetailRelationship, 
    SoftDeletes;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    protected $with = ['books', 'bills'];

    protected $dates = ['created_at', 'updated_at'];

    public $asYouType = true;
    
}
