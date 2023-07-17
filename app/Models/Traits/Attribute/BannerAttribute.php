<?php


namespace App\Models\Traits\Attribute;


use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait BannerAttribute
{
    public function getStatusLabelAttribute()
    {
        if ($this->status == config('common.banner.status.active')) {
            return '<span class="badge badge-success">Hoạt động</span>';
        } else {
            return '<span class="badge badge-secondary">Không hoạt động</span>';
        }
    }
}
