<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trainer extends Authenticatable implements JWTSubject
{

    protected $fillable = [
                        'name',
                        'user_name',
                        'email',
                        'password',
                        'phone_number',
                        'secret_key',
                        'login_type',
                        'dob',
                        'weight',
                        'height',
                        'profile_image',
                        'gym_name',
                        'status' 
    ];

    public static function addEdit($data,$password)
    {       
        return Trainer::updateOrCreate(
            ['id' => @$data['id']],
            [
                'name'          => @$data['name'],
                'user_name'     => @$data['user_name'],
                'email'         => @$data['email'],
                'password'      => @$password,
                'phone_number'  => @$data['phone_number'],
                'dob'           => @$data['dob'],
                'weight'        => @$data['weight'],
                'height'        => @$data['height'],
                'gym_name'      => @$data['gym_name'],
                'status'        => @$data['status']
            ]
        );
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
      
}
