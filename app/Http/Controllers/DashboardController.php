<?php

namespace Gespro\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function dashboard()
  {
      return view('dashboard.index');
  }
}
