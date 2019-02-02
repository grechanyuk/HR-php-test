<?php

namespace App;

use App\Helpers\Constants;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['partner_id', 'status', 'client_email'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, OrderProduct::class, null, 'id', null, 'product_id');
    }

    public function scopeOverdue()
    {
        return $this->where('delivery_dt', '<', Carbon::now())->where('status', 10)->orderBy('delivery_dt', 'DESC');
    }

    public function scopeCurrent()
    {
        return $this->where('delivery_dt', '>', Carbon::now())
            ->where('delivery_dt', '<', Carbon::createFromTimestamp(time() + 24 * 60 * 60))
            ->where('status', 10)->orderBy('delivery_dt');
    }

    public function scopeNew()
    {
        return $this->where('delivery_dt', '>', Carbon::now())
            ->whereStatus(0)->orderBy('delivery_dt');
    }

    public function scopeFinished()
    {
        return $this->where('delivery_dt', '>', Carbon::yesterday())
            ->where('delivery_dt', '<', Carbon::tomorrow())
            ->whereStatus(Constants::$FINISH_ORDER_STATUS)
            ->orderBy('delivery_dt', 'DESC');
    }
}
