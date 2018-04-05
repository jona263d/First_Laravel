<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class CustomUserController extends Controller
{
    public function PRegister()
    {

        return view('PreRegister');
    }
}