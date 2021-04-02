<?php

namespace App\Models;

use Laravel\Passport\Client as OAuthClient;
use Ramsey\Uuid\Provider\Node\RandomNodeProvider;
use Ramsey\Uuid\Uuid;

class PassportClient extends OAuthClient
{
    /** 
     * Indicates if the IDs are UUID's. 
     * 
     * @var bool 
     */ 
    public $incrementing = false; 

    public static function boot()
    { 
        parent::boot(); 
    
        static::creating(function ($model) {

            $nodeProvider = new RandomNodeProvider();

            $uuid = Uuid::uuid1($nodeProvider->getNode());
            
            $model->{$model->getKeyName()} = $uuid; 
        }); 
    } 

}
