<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use App\Models\Mountain;
use App\Models\Rental;
use App\Models\User;

class AdminDashboardController extends Controller 
{ 
    public function __invoke()
    {
        $stats = [
            'mountains'       => Mountain::count(),
            'gear'            => Gear::count(),
            'customers'       => User::where('role', 'customer')->count(),
            'rentals'         => Rental::count(),
            'pending_rentals' => Rental::where('status', 'Pending')->count(),
            'active_rentals'  => Rental::where('status', 'On Rent')->count(),
            'completed'       => Rental::where('status', 'Completed')->count(),
            'total_revenue'   => Rental::sum('total_price'),
        ];

        $recentRentals = Rental::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentRentals'));
    } 
}
