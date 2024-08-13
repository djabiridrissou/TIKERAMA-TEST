<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $primaryKey = 'ticket_id';

    public $timestamps = false;

    protected $fillable = [
        'ticket_event_id',
        'ticket_email',
        'ticket_phone',
        'ticket_price',
        'ticket_order_id',
        'ticket_key',
        'ticket_ticket_type_id',
        'ticket_status',
        'ticket_created_on',
    ];

    // Relations avec d'autres modèles
    public function event()
    {
        return $this->belongsTo(Event::class, 'ticket_event_id', 'event_id');
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_ticket_type_id', 'ticket_type_id');
    }
}
