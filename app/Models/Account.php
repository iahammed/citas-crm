<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function agent_payment()
    {
        return $this->hasMany(AgentPayment::class);
    }

    public function method_payment()
    {
        return $this->hasMany(MethodPayment::class);
    }
}
