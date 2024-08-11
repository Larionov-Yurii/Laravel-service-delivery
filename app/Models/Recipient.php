<?php
/**
 * Manages recipient information, including name, phone, email, and address.
 * Defines a one-to-many relationship with parcels.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'address',
    ];

    /**
     * Get the parcels for the recipient.
     */
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
}
