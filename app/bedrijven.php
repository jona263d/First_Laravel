<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bedrijven extends Model
{

	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'naam', 'adres', 'telefoonnr', 'email', 'postcode',
    ];

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bedrijven';
}
