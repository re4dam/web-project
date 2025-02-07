<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function show(Request $request){
        $idJadwal = $request->input('id_jadwal');
        $total = $request->input('harga_total');

        // return response()->json([$idJadwal,$total]);

        return view('frontend.pembayaran',compact('idJadwal','total'));
    }

    public function bayar(Request $request){
        if($request->state == 1){
            if($request->payment_method == "Transfer Bank"){
                $bayar = Pembayaran::create([
                    'id_jadwal' => $request->id_jadwal,
                    'metode' => ['payment_metode' => $request->payment_method, 'bank' => $request->bank],
                    'total' => $request->total,
                ]);

                $jadwal = Jadwal::findOrFail( $bayar->id_jadwal );
                $jadwal->status = 'Waiting For Payment';
                $jadwal->save();

                return view('frontend.pembuktian',['bayar' => $bayar]);
            } elseif($request->payment_method == "QRIS"){
                $bayar = Pembayaran::create([
                    'id_jadwal' => $request->id_jadwal,
                    'metode' => ['payment_metode' => $request->payment_method],
                    'total' => $request->total,
                ]);

                $jadwal = Jadwal::findOrFail( $bayar->id_jadwal );
                $jadwal->status = 'Waiting For Payment';
                $jadwal->save();

                return view('frontend.pembuktian',['bayar' => $bayar]);
            }
            else {
                return redirect()->route('jadwal');
            }
        } elseif ($request->state == 2){
            $bayar = Pembayaran::findOrFail($request->id_jadwal);

            // return response()->json($bayar);

            return view('frontend.pembuktian',['bayar' => $bayar]); 
        } else {
            echo 'halo'.$request->state;
        }
    }

    public function view(Request $request){
        $bayar = Pembayaran::findOrFail($request->id_jadwal);

        return view('frontend.pembuktian',['bayar' => $bayar]);
    }

    public function bukti(Request $request)
    {
        // Find the Pembayaran record by its ID
        $bayar = Pembayaran::findOrFail($request->id);

        // Upload and save the proof of payment
        if ($request->hasFile('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store the file in the public/proof_of_payments directory
            $filePath = $file->storeAs('public/proof_of_payments', $fileName);
            
            // Set the bukti attribute to the relative path for public access
            $bayar->bukti = 'storage/proof_of_payments/' . $fileName;
        }

        // Save the Pembayaran record
        $bayar->save();

        // Update the status of the related Jadwal
        $jadwal = Jadwal::findOrFail($bayar->id_jadwal);
        $jadwal->status = 'Waiting For Approval';
        $jadwal->save();

        // Redirect back to the schedule page
        return redirect()->route('jadwal')->with('success', 'Proof of payment submitted successfully!');
    }

    
}
