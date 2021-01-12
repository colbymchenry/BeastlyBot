<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Category extends Model
{
    protected $fillable = ['name', 'icon', 'priority', 'assign', 'email', 'setting'];
 
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}