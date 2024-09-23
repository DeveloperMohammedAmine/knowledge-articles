<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'phone_number',
        'job',
        'image',
        'country',
    ];

    public $timestamps = false;

    public function user() {
        return $this -> hasOne('App\Models\User');
    }






}
