<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property Collection subscriptions
 */
class Topic extends Model
{
    use HasFactory;

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(TopicMessage::class);
    }
}
