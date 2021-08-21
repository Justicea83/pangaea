<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string url
 */
class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['url','topic_id'];
}
