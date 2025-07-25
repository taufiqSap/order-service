<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'rental_days',
        'total_price',
        'status',
    ];
    protected $casts = [
        'rental_days' => 'integer',
        'total_price' => 'integer',
        'status' => 'string',
    ];
    public function payment()
    {  

    return $this->hasOne(Payment::class);
}

}