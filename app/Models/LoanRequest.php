<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name', 'dob', 'pan', 'email', 'phone', 'address',
        'loan_amount', 'loan_purpose', 'loan_term', 'employment_status',
        'annual_income', 'employer_name', 'application_status',
        'request_hash'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->request_hash = substr(hash('sha256', uniqid()), 0, 12);
        });
    }
}
