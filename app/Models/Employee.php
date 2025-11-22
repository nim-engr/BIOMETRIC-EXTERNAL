<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    'biometric_number',
    'first_name',
    'middle_initial',
    'family_name',
    'name_extension',
    'position',
    'employment_status',
    'sup_first_name',
    'sup_middle_initial',
    'sup_family_name',
    'sup_name_extension'
    ];

    public function biometricLogs()
    {
        return $this->hasMany(BiometricLog::class);
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_initial} {$this->family_name} {$this->name_extension}");
    }

    public function getSupervisorFullNameAttribute()
    {
        return trim("{$this->sup_first_name} {$this->sup_middle_initial} {$this->sup_family_name} {$this->sup_name_extension}");
    }
}