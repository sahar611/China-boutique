<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
 
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
  

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\User;
class MainController extends Controller
{
	public function __construct()
    {
        //
    }
 
 	  public function index()
    {
       
        

        return view('app');
    }
    
}
