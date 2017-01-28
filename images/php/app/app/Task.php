<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'priority_id',
        'due_date',
        'timezone',
        'description',
        'creator_id',
        'assignedTo_id'
    ];

    protected $with = [
      'creator',
      'assignedTo',
      'priority'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'assignedTo_id',
        'creator_id',
        'priority_id'
    ];

    public function creator() {
      return $this->belongsTo('App\User', 'creator_id');
    }

    public function assignedTo() {
      return $this->belongsTo('App\User', 'assignedTo_id');
    }

    public function priority() {
      return $this->belongsTo('App\Priority');
    }
}
