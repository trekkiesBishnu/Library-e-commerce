<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index(){
        $totalBook=Book::count();
        $totalOrder=Order::count();
        $totalBookCategory=Category::count();

         $user=User::count();
         $admin= Role::where('name','Admin')->count();

        $todayDate=Carbon::now()->format('y-m-d');
        $OrderMonth=Carbon::now()->format('m');
        $OrderYear=Carbon::now()->format('Y');

        $totalDailyOrder=Order::whereDate('created_at',$todayDate)->count();
        $totalMonthOrder=Order::whereMonth('created_at',$OrderMonth)->count();
        $totalYEAROrder=Order::whereYear('created_at',$OrderYear)->count();

        $completeOrder=Order::where('status_message','completed')->count();


        return view('admin.home',compact('totalBook','totalOrder','totalBookCategory','totalDailyOrder',
                                            'user','admin','totalMonthOrder','totalYEAROrder','completeOrder'));
    }
}
