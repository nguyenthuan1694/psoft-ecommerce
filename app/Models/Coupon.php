<?php

namespace App\Models;

use App\Models\Traits\Attribute\CouponAttribute;
use App\Models\Traits\Method\CouponMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use CouponMethod,
        CouponAttribute,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
