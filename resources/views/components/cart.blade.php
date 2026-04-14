@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif
<x-laptop-layout :title="'Giỏ hàng'" :categories="$categories">

<div style="max-width:800px; margin:0 auto;">

    <h5 class="text-center mt-3 mb-3" style="color:#0d6efd; font-weight:bold;">
        DANH SÁCH SẢN PHẨM
    </h5>

    <table class="table table-bordered text-center">
        <thead style="background:#f5f5f5;">
            <tr>
                <th>STT</th>
                <th class="text-left">Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp

            @foreach($cart as $id => $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td class="text-left">
                    {{ $item['ten'] }}
                </td>
                <td>{{ $item['so_luong'] }}</td>
                <td>{{ number_format($item['gia']) }}đ</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach

            <!-- Tổng -->
            <tr>
                <td colspan="3"><b>Tổng cộng</b></td>
                <td colspan="2"><b>{{ number_format($tong) }}đ</b></td>
            </tr>
        </tbody>
    </table>

    <!-- Thanh toán -->
    <div class="text-center mt-3">

        <div style="width:250px; margin:0 auto;">
            <label><b>Hình thức thanh toán</b></label>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf

                <select name="payment" class="form-control mb-2">
                    <option value="1">Tiền mặt</option>
                    <option value="2">Chuyển khoản</option>
                </select>

                <button class="btn btn-primary">
                    ĐẶT HÀNG
                </button>
            </form>
        </div>

    </div>

</div>

</x-laptop-layout>