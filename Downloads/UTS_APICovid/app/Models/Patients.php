<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    # mendefinisikan model agar column tabel bisa di gunakan
    protected $fillable = [
        'name', 'phone', 'status', 'address', 'in_date_at', 'out_date_at'
    ];
}