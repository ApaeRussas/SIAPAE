<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $state = 'expenses';
    protected $fillable = [
        'type',
        'price',
        'date_of_emission',
        'fiscal_number',
        'cupom_number',
        'enterprise',
        'description',
    ];

}
