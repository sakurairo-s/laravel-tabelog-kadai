<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Shop extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price_min',
        'price_max',
        'business_hour_start',
        'business_hour_end',
        'address',
        'phone_number',
        'holiday',
        'registered_at',
        'image',
    ];
        

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorited_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
    
    public function popularSortable($query, $direction) {
        return $query->withCount('reservations')->orderBy('reservations_count', $direction);
    }
}
