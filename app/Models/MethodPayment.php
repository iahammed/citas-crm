<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'name'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function payment_student()
    {
        return $this->hasOne(PaymentsStudent::class);
    }
    
}
