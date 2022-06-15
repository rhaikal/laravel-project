<?php

namespace App\Models;

use App\Models\User;
use App\Models\PesananDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $with = ['pesananDetail', 'user'];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesananDetail()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
