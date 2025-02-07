<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $keranjang = Keranjang::with('produk')->where('id_user', auth()->id())->get();
        return view('frontend.keranjang', compact('keranjang'));
    }

    public function add(Request $request, $productId)
    {
        $userId = auth()->user()->id;
        $product = Produk::find($productId);

        $cartItem = Keranjang::firstOrCreate(
            ['id_produk' => $productId],
            ['id_user' => $userId,'jumlah' => $request->input('jumlah', 0)]
        );
        $cartItem->jumlah += $request->input('quantity', 1);
        $cartItem->save();

        return redirect()->route('produk')->with('success', 'Product added to cart');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Keranjang::findOrFail($id);

        if ($request->input('action') === 'increase') {
            $cartItem->jumlah += 1;
        } elseif ($request->input('action') === 'decrease') {
            $cartItem->jumlah -= 1;
            if ($cartItem->jumlah < 1) {
                $cartItem->delete();
                return redirect()->route('cart.show')->with('success', 'Product removed from cart');
            }
        }

        $cartItem->save();

        return redirect()->route('cart.show')->with('success', 'Cart updated successfully');
    }

    public function destroy($id)
    {
        $cartItem = Keranjang::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.show')->with('success', 'Product removed from cart');
    }

    public function remove($id)
    {
        $cartItem = Keranjang::find($id);
        $cartItem->delete();

        return redirect()->route('home')->with('success', 'Product removed from cart');
    }
}
