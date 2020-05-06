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
    protected $fillable = ['name', 'ip', 'port', 'img'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['info', 'players', 'rules', 'ping'];

    /**
     * Get the user's full name.
     *
     * @param $value
     * @return string
     */
    public function getIpAttribute($value)
    {
        return long2ip($value);
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setIpAttribute($value)
    {
        $this->attributes['ip'] = ip2long($value);
    }
}
