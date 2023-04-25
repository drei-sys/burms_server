<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TORItem extends Model
{
    use HasFactory;

    protected $table = 'tor_item';

    protected $fillable = [
        'tor_request_id',
        'sy_id',
        'subject_id',
        'rating',
        'created_by',
        'updated_by',
    ];
}
