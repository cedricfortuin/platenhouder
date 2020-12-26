<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordModel extends Model
{
    use HasFactory;

    protected $table = 'records';

    protected $fillable = [
        'name',
        'artist',
        'owner',
        'amount',
        'type'
    ];
}
