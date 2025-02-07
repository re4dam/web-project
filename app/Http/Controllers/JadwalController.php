<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Keranjang;
use App\Models\Produk_Book;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(){
        $user = auth()->user();
        if($user->is_admin == 1){
            $jadwals = Jadwal::with('user')->get();
        }
        else {
            $jadwals = Jadwal::where('id_user', $user->id)->get();
        }

        return view('frontend.jadwal',compact('jadwals'));
    }
    public function cancel(Request $request){
        $jadwal = Jadwal::find($request->id_jadwal);

        if ($jadwal) {
            $jadwal->status = 'Cancelled';
            $jadwal->save();
    
            return redirect()->back()->with('success', 'Schedule cancelled successfully.');
        }
    
        return redirect()->back()->with('error', 'Schedule not found.');
    }
    public function book(Request $request)
    {
        // Validate the request data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Calculate the duration in days
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $interval = $startDate->diff($endDate);
        $duration = $interval->days + 1; // Including the end date

        // Retrieve the cart items for the authenticated user
        $keranjang = Keranjang::where('id_user', auth()->id())->with('produk')->get();

        // Duplicate the cart items into Produk_Book
        foreach ($keranjang as $item) {
            Produk_Book::create([
                'id_user' => $item->id_user,
                'id_produk' => $item->id_produk,
                'jumlah' => $item->jumlah,
                'harga_total' => $item->produk->harga * $item->jumlah * $duration,
            ]);
        }

        // Create a new schedule entry
        $jadwal = Jadwal::create([
            'id_user' => auth()->id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'keterangan' => $request->keterangan,
        ]);

        // Retrieve the duplicated items from Produk_Book
        $produkBookItems = Produk_Book::where('id_user', auth()->id())->where('created_at',$jadwal->created_at)->get();

        // Attach the duplicated items to the schedule
        foreach ($produkBookItems as $item) {
            $jadwal->book()->attach($item->id);
        }

        // Clear the cart
        Keranjang::where('id_user', auth()->id())->delete();

        return redirect()->back()->with('success', 'Schedule booked successfully!');
    }

    public function show(Request $request)
    {
        $id = $request->jadwal;
        $jadwal = Jadwal::with(['book.produk','pembayaran'])->where('id', $request->jadwal)->first();

        // return response()->json([$jadwal]);
        return view('frontend.jadwal_detail', compact('jadwal'));
    }

    public function pinjam(Request $request){
        $idJadwal = $request->id_jadwal;
        $jadwal = Jadwal::where('id',$idJadwal)->first();

        // return response()->json([$jadwal,$idJadwal]);
        return view('frontend.peminjaman',compact('jadwal'));
    }

    public function serahkembali(Request $request){
        $user = auth()->user();
        $jadwal = Jadwal::where('id',$request->id_jadwal)->first();

        if ($request->hasFile('buktiSerah')) {
            $file = $request->file('buktiSerah');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store the file in the public/buktiSerah directory
            $filePath = $file->storeAs('public/buktiSerah', $fileName);
            
            // Set the bukti attribute to the relative path for public access
            $jadwal->buktiSerah = 'storage/buktiSerah/' . $fileName;
        }

        else if ($request->hasFile('buktiKembali')) {
            $file = $request->file('buktiKembali');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store the file in the public/buktiKembali directory
            $filePath = $file->storeAs('public/buktiKembali', $fileName);
            
            // Set the bukti attribute to the relative path for public access
            $jadwal->buktiKembali = 'storage/buktiKembali/' . $fileName;
        }

        $jadwal->save();

        // Redirect back to the schedule page
        return redirect()->route('jadwal')->with('success', 'Proof of payment submitted successfully!');
    }

    public function kembali(Request $request){
        $request->validate([
            'buktiSerah' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $jadwal = Jadwal::where('id',$request->id_jadwal)->first();

        if ($request->hasFile('butkiKembali')) {
            $file = $request->file('butkiKembali');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store the file in the public/butkiKembali directory
            $filePath = $file->storeAs('public/butkiKembali', $fileName);
            
            // Set the bukti attribute to the relative path for public access
            $jadwal->butkiKembali = 'storage/butkiKembali/' . $fileName;
        }

        $jadwal->save();
        
        return response()->json([$request]);
        // Redirect back to the schedule page
        return redirect()->route('jadwal')->with('success', 'Proof of payment submitted successfully!');
    }

}
