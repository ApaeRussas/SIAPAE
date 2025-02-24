<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $state = 'records';
    protected $fillable = [
        'title_header',
        'date',
        'text',
        'type_ata',
        'number_signatures',
        'special_signatures',
        'relatives_frequencies',
    ];
}
