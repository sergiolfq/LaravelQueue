<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelJob extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     * 
     */   
    public $timestamps = false;
    protected $fillable = ['payload','attempts','reserved_at','available_at','created_at'];
    protected $table = 'jobs';
    const CACHE_KEY = 'ModelJob';
    
}