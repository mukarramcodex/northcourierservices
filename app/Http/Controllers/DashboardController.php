<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $totalParcels = Parcel::count();
        $deliveredParcels = Parcel::where('status', 'Delivered')->count();
        $inTransitParcels = Parcel::where('status', 'In Transit')->count();
        $recentParcels = Parcel::latest()->paginate(10);

        $data = compact(
            'totalParcels',
            'deliveredParcels',
            'inTransitParcels',
            'recentParcels',
        );

        switch ($user->role) {
            case 'admin':
                return view('dashboard.admin', $data);
            case 'manager':
                return view('dashboard.manager', $data);
            case 'staff':
                return view('dashboard.staff', $data);
            default:
                abort(403, 'Unauthorized' );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
