<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'rooms',
        'beds',
        'bathrooms',
        'description',
        'square_meters',
        'address',
        'latitude',
        'longitude',
        'cover_image',
        'is_visible',
    ];


    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'services_apartments', 'apartment_id', 'service_id');
    }

    public function sponsorships(): BelongsToMany
    {
        return $this->belongsToMany(Sponsorship::class, 'sponsorships_apartments', 'apartment_id', 'sponsorship_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
