<?php

namespace App\Models;

use App\Models\User;
use App\Models\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'tel_number',
        'email',
        'table_id',
        'res_date',
        'guest_number',
        'user_id'
    ];

    protected $dates = [
        'res_date'
    ];


    public function User()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
