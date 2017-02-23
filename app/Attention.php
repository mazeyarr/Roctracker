<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
    protected $fillable = ['tablename', 'message', 'status', 'fk_id', 'fk_users'];
}
