<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'image_path',
        'file',
        'message',
    ];

    protected $casts = [
        'file' => 'array',
    ];

    protected static function booted()
    {
            // Preenche o user_id apenas no momento da criação
            static::creating(function ($model) {
                $model->user_id = Auth::id();
        });

            // Sobrescreve o user_id durante a atualização do modelo
            static::updating(function ($model) {
                $model->user_id = Auth::id();
        });
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
