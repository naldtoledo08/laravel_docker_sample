<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class DashboardController extends Controller
{
    private $userService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time = strtotime('now');
        $current_month = date('m', $time);
        $month_year = date('F Y', $time);
        $date_today = date('F d, Y', $time);
        $new_user_current_month = $this->userService->getNewUserByMonth($current_month);
        $new_user_current_month_count = $new_user_current_month->count();


        $data = [
            'date_today' => $date_today,
            'current_month' => $current_month,
            'month_year'    => $month_year,
            'new_user_current_month' => $month_year,
            'new_user_current_month_count' => $new_user_current_month_count,
        ];
       
        return view('dashboard/index', $data);
    }
}
