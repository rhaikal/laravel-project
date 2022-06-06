<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
 
    protected $with = ['pesananDetail'];

    protected $guarded = ['id'];

    public function pesananDetail()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
