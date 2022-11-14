<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    protected $dates = ['created_at', 'updated_at'];

    public $asYouType = true;
    
}
