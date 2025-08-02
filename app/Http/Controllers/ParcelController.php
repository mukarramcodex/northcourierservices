<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcels = Parcel::latest()->paginate(10);
        $parcels = Parcel::with('bookingOfficer')->get();
        return view('Parcels.index', compact('parcels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastReceipt = Parcel::orderBy('id', 'desc')->value('receipt_number');
        $nextReceipt = $lastReceipt ? (int)$lastReceipt + 1 : 10000;

        return view('Parcels.create', [
            'nextReceipt' => str_pad($nextReceipt, 4, '0', STR_PAD_LEFT),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|unique:parcels',
            'receipt_number' => 'required|unique:parcels',
            'tracking_number' => 'required|unique:parcels',
            'origin' => 'required',
            'booking_point' => 'required',
            'destination' => 'required',
            'delivery_point' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'booking_officer' => 'required',
            'sender_name' => 'required',
            'sender_cnic' => 'required',
            'sender_phone' => 'required',
            'sender_email' => 'required|email',
            'receiver_name' => 'required',
            'receiver_cnic' => 'required',
            'receiver_phone' => 'required',
            'receiver_email' => 'required|email',
            'booking_time' => 'required',
            'total_amount' => 'required',
            'packing_type' => 'required',
            'goods_description' => 'required',
            'remarks' => 'required',
            'fare' => 'required',
            'weight' => 'required',
        ]);
        $parcel = Parcel::create($validated);
        // return redirect()->route('parcels.index')->with('success', 'Parcel created Successfully');
        return redirect()->route('parcel.download', $parcel->tracking_number);
    }

    /**
     * Display the specified resource.
     */
    public function show(Parcel $parcel)
    {
        return view('Parcels.show', compact('parcel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parcel $parcel)
    {
        return view('Parcels.edit', compact('parcel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parcel $parcel)
    {
         $validated = $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'sender_name' => 'required',
            'sender_phone' => 'required',
            'sender_email' => 'required|email',
            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            'receiver_email' => 'required|email',
        ]);

        $parcel->update($validated);

        return redirect()->route('Parcels.index')->with('success', 'Parcel Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcel $parcel)
    {
        $parcel->delete();
        return redirect()->route('Parcels.index')->with('success', 'Parcel Deleted.');
    }
}
