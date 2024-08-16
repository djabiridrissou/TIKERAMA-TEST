<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIntent extends Model
{
    use HasFactory;
    
    protected $table = 'orders_intents';

    protected $primaryKey = 'order_intent_id';

    protected $fillable = [
        'order_intent_price',
        'order_intent_type',
        'user_email',
        'user_phone',
        'expiration_date',
        'statut',
        'quantity'
    ];

    public function typeTicket() {
        return $this->belongsTo(TicketType::class, 'order_intent_type');
    }
}
