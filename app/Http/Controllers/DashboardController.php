<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
  /**
   * This method retrun the main page of dashboard
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // if (Auth::user()->role->slug == 'user') {
    //   return view('dashboard');
    // }
    return view('dashboard.pages.index');
  }
}
