<?php


namespace App\Models\Traits\Attribute;


use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait ProductAttribute
{
    public function getStatusLabelAttribute()
    {
        if ($this->status == config('common.product.status.Active')) {
            return '<span class="badge badge-success">Hoạt động</span>';
        } else {
            return '<span class="badge badge-secondary">Không hoạt động</span>';
        }
    }

    public function getCurrentPromotionAttribute()
    {
        if ($this->promotions->count()) {
            return $this->promotions()->where('date_start', '<=', Carbon::now())->first();
        }
        return null;
    }
}
