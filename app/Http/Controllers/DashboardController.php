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
    if (Auth::user()->level() == 2) {
      return view('dashboard.admin.pages.index');
    }
    return view('dashboard.front.index');
  }
}
