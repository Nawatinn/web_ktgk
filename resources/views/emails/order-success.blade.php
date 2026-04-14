<h2>Đặt hàng thành công 🎉</h2>

<p>Cảm ơn bạn đã mua hàng!</p>

<table border="1" cellpadding="5">
    <tr>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
    </tr>

    @foreach($cart as $item)
    <tr>
        <td>{{ $item['ten'] }}</td>
        <td>{{ $item['so_luong'] }}</td>
        <td>{{ number_format($item['gia']) }}đ</td>
    </tr>
    @endforeach
</table>

<h3>Tổng tiền: {{ number_format($tong) }}đ</h3>