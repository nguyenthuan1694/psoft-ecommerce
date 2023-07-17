<?php

namespace App\Models;

use App\Models\Traits\Relationship\OrderDetailRelationship;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use OrderDetailRelationship;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    protected $with = ['products'];
}
