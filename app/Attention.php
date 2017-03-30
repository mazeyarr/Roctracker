<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This Class is only used when there is attention needed of a user, where the system cannot comply
 *
 * Class Attention
 * @package App
 */
class Attention extends Model
{
    /** @var array this array will enable mass imports */
    protected $fillable = ['tablename', 'message', 'status', 'fk_id', 'fk_users'];
}
