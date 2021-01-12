<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'ticket_id', 'title', 'selected_id', 'priority', 'message', 'img', 'url', 'status'
    ];
 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
 
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}