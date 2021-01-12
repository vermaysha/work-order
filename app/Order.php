<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wo_number', 'title', 'category', 'assign_id', 'from_id', 'description', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'assign_id', 'from_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * The relations included from the model's JSON form.
     *
     * @var array
    */
    protected $with = [
        'assign', 'from'
    ];

    public function assign() {
        return $this->belongsTo(User::class, 'assign_id');
    }

    public function from() {
        return $this->belongsTo(User::class, 'from_id');
    }
}
