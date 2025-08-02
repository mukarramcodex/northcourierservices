<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected $fillable = [
        'booking_id',
        'receipt_number',
        'qr_code',
        'sender_name',
        'sender_phone',
        'sender_cnic',
        'sender_email',
        'receiver_name',
        'receiver_phone',
        'receiver_cnic',
        'receiver_email',
        'origin',
        'destination',
        'booking_point',
        'delivery_point',
        'dimension',
        'packing_type',
        'pieces',
        'goods_description',
        'remarks',
        'fare',
        'discount',
        'amount',
        'total_amount',
        'booking_time',
        'booking_officer',
        'branch',
        'status',
        'payment_status',
        'tracking_number',
    ];

    protected $casts = [
        'booking_time' => 'datetime',
    ];

    public function scopeDelivered($query)
    {
        return $query->where('status', 'Delivered');
    }

    public function scopeInTransit($query)
    {
        return $query->where('status', 'In Transit');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_email');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_email');
    }

    public function bookingOfficer()
    {
        return $this->belongsTo(User::class, 'booking_officer');
    }

    public function trackingLogs()
    {
        return $this->hasMany(TrackingLog::class);
    }

    use HasFactory;
}
