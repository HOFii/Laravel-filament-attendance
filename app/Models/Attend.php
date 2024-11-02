<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;

    public $table = 'attendances';

    protected $fillable = [
        'user_id',
        'status',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(related: User::class);
    }
}
