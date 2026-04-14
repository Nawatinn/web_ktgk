<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;
class LaptopController3 extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $tong = 0;

        foreach ($cart as $item) {
            $tong += $item['gia'] * $item['so_luong'];
        }

        $categories = DB::table('danh_muc_laptop')->get();

        return view('components.cart', [
            'cart' => $cart,
            'tong' => $tong,
            'categories' => $categories,
            'title' => 'Giỏ hàng'
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
                         ->with('success', 'Đã xóa sản phẩm');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                            ->with('error', 'Giỏ hàng trống');
        }

        $tong = 0;
        foreach ($cart as $item) {
            $tong += $item['gia'] * $item['so_luong'];
        }

        $donHangId = DB::table('don_hang')->insertGetId([
            'ngay_dat_hang' => now(),
            'tinh_trang' => 1,
            'hinh_thuc_thanh_toan' => $request->payment,
            'user_id' => auth()->check() ? auth()->id() : 1
        ]);

        foreach ($cart as $id => $item) {
            DB::table('chi_tiet_don_hang')->insert([
                'ma_don_hang' => $donHangId,
                'laptop_id' => $id,
                'so_luong' => $item['so_luong'],
                'don_gia' => $item['gia']
            ]);
        }

        if (auth()->check()) {
            Mail::to(auth()->user()->email)
                ->send(new OrderSuccessMail($cart, $tong));
        }

        session()->forget('cart');

        return redirect()->route('cart.index')
                        ->with('success', 'Đặt hàng thành công! Đã gửi email.');
    }
    public function show($id)
    {
        $product = DB::table('san_pham')->where('id', $id)->first();

        $categories = DB::table('danh_muc_laptop')->get();

        return view('components.product-detail', [
            'product' => $product,
            'categories' => $categories,
            'title' => $product->ten
        ]);
    }
    public function addToCart(Request $request)
{
    $id = $request->id;
    $so_luong = $request->so_luong;

    $product = DB::table('san_pham')->where('id', $id)->first();

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['so_luong'] += $so_luong;
    } else {
        $cart[$id] = [
            'ten' => $product->ten,
            'gia' => $product->gia,
            'so_luong' => $so_luong,
            'hinh_anh' => $product->hinh_anh
        ];
    }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
}