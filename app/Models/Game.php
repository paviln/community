<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'platform'];

    /**
     * Get the servers belonging to the game.
     */
    public function servers()
    {
        return $this->hasMany('App\Models\Server');
    }

    /**
     * Get the categories  belonging to the game.
     */
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

}
