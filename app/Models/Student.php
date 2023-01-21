<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_id',
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'address',
        'city',
        'region',
        'country',
        'postal_code',
        'dob',
        'email',
    ];
    
    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
    
    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    /** table course_student */
    public function myCourse()
    {
        return $this->hasOne(CourseStudent::class);
    }

    public function getDueAttribute()
    {
        $ps = $this->myCourse;
        return $ps->fees - $ps->fees_received;
    }

    public function myPayments()
    {
        return $this->hasMany(PaymentsStudent::class); //->orderBy('created_at', 'DESC');
    }

    public function getPaymentsAttribute()
    {
        $payments = $this->myPayments;
        $myPayments = [];
        foreach($payments as $payment) {
            $myPayments[] = [
                'payment' => $payment,
                'user' => $payment->user,
                'method_payment' => $payment->method_payment
            ];
        }
        return $myPayments;
    }



    public function agent_payment()
    {
        return $this->hasMany(AgentPayment::class);
    }
    
    /**
     * The course that belong to the student.
     */
    public function course()
    {
        return $this->belongsToMany(Course::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('student_id', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
    
    
}
