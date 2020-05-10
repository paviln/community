<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'ip', 'port', 'img', 'game_id', 'category_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['info', 'players', 'rules', 'ping'];

    public function getInfoAttribute($value)
    {
        return $value ? $value : null;
    }

    public function getPlayersAttribute($value)
    {
        return $value ? $value : null;
    }

    public function getRulesAttribute($value)
    {
        return $value ? $value : null;
    }

    public function getPingAttribute($value)
    {
        return $value ? $value : null;
    }

    /**
     * Get the game that belongs to the server.
     */
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    /**
     * Get the category that belongs to the server.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the ip as int
     *
     * @param $value
     * @return string
     */
    public function getIpAttribute($value)
    {
        return long2ip($value);
    }

    /**
     * Set the ip as dot format
     *
     * @param  string  $value
     * @return void
     */
    public function setIpAttribute($value)
    {
        $this->attributes['ip'] = ip2long($value);
    }
}
