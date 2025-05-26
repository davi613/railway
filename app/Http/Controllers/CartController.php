<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Ambil data keranjang berdasarkan pelanggan yang login

    $cartItems = Keranjang::with('obat')
    ->where('id_pelanggan', auth('pelanggan')->id())
    ->get();

        $total = $cartItems->sum('subtotal');

        return view('cart.index', compact('cartItems', 'total'),[
            'title' => 'Keranjang'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_obat' => 'required|exists:obat,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $obat = Obat::findOrFail($request->id_obat);

        // Cek apakah item sudah ada di keranjang
        $existingCart = Keranjang::where('id_pelanggan', Auth::id())
            ->where('id_obat', $request->id_obat)
            ->first();

        if ($existingCart) {
            // Update quantity jika sudah ada
            $existingCart->jumlah_order += $request->quantity;
            $existingCart->subtotal = $existingCart->jumlah_order * $existingCart->harga;
            $existingCart->save();
        } else {
            // Tambahkan baru jika belum ada
            $idPelanggan = auth('pelanggan')->id();
            Keranjang::create([
                'id_pelanggan' => $idPelanggan,
                'id_obat' => $request->id_obat,
                'jumlah_order' => $request->quantity,
                'harga' => $obat->harga_jual,
                'subtotal' => $obat->harga_jual * $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cartItem = Keranjang::findOrFail($id);
        $cartItem->jumlah_order = $request->quantity;
        $cartItem->subtotal = $cartItem->harga * $request->quantity;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'subtotal' => $cartItem->subtotal,
            'total' => Keranjang::where('id_pelanggan', Auth::id())->sum('subtotal')
        ]);
    }

    public function destroy($id)
    {
        $cartItem = Keranjang::findOrFail($id);
        $cartItem->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
}