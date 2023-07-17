<?php

namespace App\Models;

use App\Models\Traits\Attribute\OrderAttribute;
use App\Models\Traits\Relationship\OrderRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use OrderRelationship,
        OrderAttribute,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    protected $with = ['order_details'];

    protected $dates = ['created_at', 'updated_at'];
}
