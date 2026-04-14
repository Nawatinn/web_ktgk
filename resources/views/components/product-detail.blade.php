<x-laptop-layout :title="$title" :categories="$categories">
@if(session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif
<div class="row mt-4">

    <!-- Hình -->
    <div class="col-md-4 text-center">
        <img src="{{ asset('storage/image/' . $product->hinh_anh) }}"
             style="max-width:100%; border:1px solid #ddd; padding:10px;">
    </div>

    <!-- Thông tin -->
    <div class="col-md-8">

        <!-- Tên -->
        <h5 style="font-weight:bold;">
            {{ $product->tieu_de ?? $product->ten }}
        </h5>

        <!-- Mô tả -->
        <div style="font-size:14px; line-height:1.6">

            <p><b>CPU:</b> {{ $product->cpu }}</p>
            <p><b>RAM:</b> {{ $product->ram }}</p>
            <p><b>Ổ cứng:</b> {{ $product->luu_tru }}</p>
            <p><b>Chip đồ họa:</b> {{ $product->chip_do_hoa }}</p>
            <p><b>Nhu cầu:</b> {{ $product->nhu_cau }}</p>
            <p><b>Màn hình:</b> {{ $product->man_hinh }}</p>
            <p><b>Hệ điều hành:</b> {{ $product->he_dieu_hanh }}</p>

        </div>

        <!-- Giá -->
        <p style="font-size:16px;">
            <b>Giá:</b>
            <span style="color:red; font-weight:bold;">
                {{ number_format($product->gia) }} VND
            </span>
        </p>

        <!-- Thêm giỏ -->
        <div class="d-flex align-items-center">

            <span>Số lượng mua:</span>

            @auth
                <form action="{{ route('cart.add') }}" method="POST"
                      class="d-flex align-items-center ml-2">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <input type="number" name="so_luong" value="1" min="1"
                        class="form-control mx-2" style="width:70px; height:30px;">

                    <button class="btn btn-primary btn-sm">
                        Thêm vào giỏ hàng
                    </button>
                </form>
            @else
                <input type="number" value="1" disabled
                       class="form-control mx-2" style="width:70px; height:30px;">

                <a href="{{ route('login') }}" class="btn btn-warning btn-sm ml-2">
                    Đăng nhập để mua
                </a>
            @endauth

        </div>

    </div>

</div>

<hr>

<hr>

<div class="row">

    <div class="col-md-4"></div>

    <div class="col-md-8">

        <h5 style="font-weight:bold;">Thông tin khác</h5>

        <div style="font-size:14px; line-height:1.6">
            <p><b>Khối lượng:</b> {{ $product->khoi_luong }}</p>
            <p><b>Webcam:</b> {{ $product->webcam }}</p>
            <p><b>Pin:</b> {{ $product->pin }}</p>
            <p><b>Kết nối không dây:</b> {{ $product->ket_noi_khong_day }}</p>
            <p><b>Bàn phím:</b> {{ $product->ban_phim }}</p>
            <p><b>Cổng kết nối:</b> {!! $product->cong_ket_noi !!}</p>
        </div>

    </div>

</div>

</x-laptop-layout>