<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsStudent extends Model
{
    use HasFactory;

    protected $table = 'payments_students';

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }

    public function agent_payment()
    {
        return $this->hasMany(AgentPayment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
