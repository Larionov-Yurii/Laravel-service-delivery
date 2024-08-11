<?php
/**
 * Stores parcel details like dimensions, weight, and associated courier.
 * Defines the relationship to a single recipient.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipient_id',
        'width',
        'height',
        'length',
        'weight',
        'courier',
    ];

    /**
     * Get the recipient associated with the parcel.
     */
    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }
}
