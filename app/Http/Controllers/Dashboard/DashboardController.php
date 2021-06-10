<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * This method retrun the main page of dashboard
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('dashboard.pages.index');
  }
}
