<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
