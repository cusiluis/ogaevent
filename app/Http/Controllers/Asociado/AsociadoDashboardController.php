<?php
namespace App\Http\Controllers\Asociado;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AsociadoDashboardController extends Controller
{
    public function index()
    {
        return view('asociado.dashboard');
    }
}