<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'conversations';

    /**
     * Fillable attributs
     * 
     * @var array
     */
    protected $fillable = [
        'uid',
        'from_id',
        'to_id',
        'status'
    ];

    /**
     * Get conversation messages
     * 
     * @return object
     */
    public function messages()
    {
        return $this->hasMany(ConversationMessage::class, 'conversation_id');
    }

    /**
     * Get user that send the message
     * 
     * @return object 
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    /**
     * Get user that receive the message
     * 
     * @return object
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    /**
     * Scope to get conversation that have active status
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * scope to get all user conversations
     */
    public function scopeAllConversations($query)
    {
            return $query->active()->where('from_id', auth()->user()->id)
                                   ->orWhere('to_id', auth()->user()->id)
                                   ->orderBy('updated_at', 'desc');
    }

    /**
     * scope to get request conversation
     * 
     * @return object
     */
    public function scopeGetConversation($query, $uid)
    {
        return $query->where('uid', $uid)->first();
    }
}
