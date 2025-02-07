<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index(){
        $bayars = Pembayaran::with('jadwal.user')->get();

        // return response()->json($bayars);
        return view('frontend.uang',compact('bayars'));
    }

    public function topBayar(){
        $bayars = Pembayaran::orderBy('total','desc')->take(10)->get();

        // Debugging: Log the data
        Log::info($bayars);

        return view('frontend.uang', compact('bayars'));
    }

    public function Action(Request $request)
    {
        $jadwalId = $request->input('id_jadwal');
        $action = $request->input('action');

        $jadwal = Jadwal::find($jadwalId);

        // return response()->json([$jadwal]);

        switch ($action) {
            case 'detail':
                return redirect()->route('detail', ['jadwal' => $jadwalId]);
            case 'approve':
                $jadwal->status = 'Waiting For Retrieval';
                $jadwal->save();
                return redirect()->route('jadwal')->with('success', 'Jadwal approved successfully.');
            case 'deny':
                if($jadwal->status == 'Waiting For Retrieval'){
                    $jadwal->buktiSerah = null;
                }
                elseif($jadwal->status == 'Borrowed'){
                    $jadwal->buktiKembali = null;
                }
                $jadwal->save();
                return redirect()->route('jadwal')->with('success', 'Jadwal denied successfully.');
            case 'borrowed':
                $jadwal->status = 'Borrowed';
                $jadwal->save();
                return redirect()->route('jadwal')->with('success', 'Jadwal denied successfully.');
            case 'returned':
                $jadwal->status = 'Returned';
                $jadwal->save();
                return redirect()->route('jadwal')->with('success', 'Jadwal denied successfully.');
            default:
                return redirect()->route('jadwal')->with('error', 'Invalid action.');
        }

    }

    public function Peminjaman(Request $request){
        $peminjaman = new Peminjaman();
        $peminjaman->id_jadwal = $request->id;
        if ($request->hasFile('buktiSerah')) {
            $file = $request->file('buktiSerah');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('buktiSerah', $fileName);
            $peminjaman->bukti_serah = $fileName; // Assign the generated filename
        }
        
        $peminjaman->save();

        $jadwal = Jadwal::findOrFail($request->jadwal);
        $jadwal->status = 'Borrowed';
        $jadwal->save();
        
        return response()->json($peminjaman);
        return view('frontend.peminjaman',compact('jadwal'));
    }

    public function Pengembalian(Request $request){
        $peminjaman = Peminjaman::findOrFail($request->id);
        if ($request->hasFile('buktiKembali')) {
            $file = $request->file('buktiKembali');
            $path = $file->store('bukti_kembali', 'public');
            $normalPath = str_replace('\\', '/',$path);
            $peminjaman->bukti_kembali = $normalPath;
        }
        $peminjaman->save();
            
        $jadwal = Jadwal::findOrFail($request->id);
        $jadwal->status = 'Returned';
        $jadwal->save();

        return response()->json([$peminjaman,$jadwal]);
        // return redirect()->route('jadwal')->with('success', 'Proof of payment submitted successfully!');
        // return route('/');
    }

}
