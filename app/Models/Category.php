<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'game_id'];

    /**
     * Get the game that belongs to the category.
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    /**
     * Get the servers belonging to the game.
     */
    public function servers()
    {
        return $this->hasMany('App\Models\Server');
    }
}
