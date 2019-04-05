<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function adminPage()
    {
        if (!Auth::check())
        {
            
            return false;
        }
        else
        {
            if(Auth::user()->admin == 0)
            {
                return false;
            }
        }
        return true;
    }

    public static function checkAdmin()
    {
      if(Auth()->user()->admin != 1)
      {
          return view('/home');
      }
    }

    public static function getAge($userDob)
    {
        $dob = new \DateTime($userDob);

        $now = new \DateTime();
        
        $difference = $now->diff($dob);

        $age = $difference->y;

        return $age;
    }
}
