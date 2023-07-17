<?php

namespace App\Models;

use App\Models\Traits\Attribute\BannerAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes,
        BannerAttribute
    ;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    public $asYouType = true;
}
