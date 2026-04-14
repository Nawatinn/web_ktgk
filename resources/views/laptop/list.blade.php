<x-laptop-layout>
<x-slot name="title">
    Laptop
</x-slot>

<style>
    /* Khung chính */
    .main-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Card */
    .card-custom {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 0 10px #ddd;
    }

    /* Table */
    table {
        width: 100% !important;
    }

    th, td {
        vertical-align: middle !important;
        font-size: 14px;
    }

    /* DÒNG XEN KẼ MÀU XÁM */
    #laptop-table tbody tr:nth-child(even) {
        background-color: #f7f7f7;
    }

    #laptop-table tbody tr:hover {
        background-color: #e9f3ff;
        transition: 0.2s;
    }

    /* Ảnh */
    td img {
        width: 60px;
        border-radius: 5px;
    }

    /* Nút */
    .btn-sm {
        font-size: 13px;
        padding: 6px;
    }

    /* Fix DataTable */
    .dataTables_wrapper {
        width: 100%;
        padding: 0;
    }

    .dataTables_length {
        float: left;
    }

    .dataTables_filter {
        float: right;
    }

    .dataTables_info {
        margin-top: 10px;
    }

    /* PAGINATION ĐẸP HƠN */
    .dataTables_paginate {
        margin-top: 15px;
        text-align: center;
    }

    .dataTables_paginate .paginate_button {
        padding: 6px 12px !important;
        margin: 2px;
        border-radius: 6px;
        border: 1px solid #ddd !important;
        background: #fff !important;
        color: #333 !important;
        cursor: pointer;
    }

    .dataTables_paginate .paginate_button:hover {
        background: #007bff !important;
        color: white !important;
        border-color: #007bff !important;
    }

    .dataTables_paginate .paginate_button.current {
        background: #007bff !important;
        color: white !important;
        border-color: #007bff !important;
        font-weight: bold;
    }

    .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<div class="main-wrapper mt-3">
    <div class="card-custom">

        <!-- Tiêu đề -->
        <h4 class="text-center text-primary fw-bold mb-3">
            QUẢN LÝ SẢN PHẨM
        </h4>

        <!-- Thông báo -->
        @if(session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Bảng -->
        <table id="laptop-table" class="table table-bordered table-hover">
            <thead style="background:#f5f5f5;">
                <tr>
                    <th>Tiêu đề</th>
                    <th>CPU</th>
                    <th>RAM</th>
                    <th>Ổ cứng</th>
                    <th>Khối lượng</th>
                    <th>Nhu cầu</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->tieu_de }}</td>
                    <td>{{ $row->cpu }}</td>
                    <td>{{ $row->ram }}</td>
                    <td>{{ $row->luu_tru }}</td>
                    <td>{{ $row->khoi_luong }}</td>
                    <td>{{ $row->nhu_cau }}</td>

                    <td>{{ number_format($row->gia,0,',','.') }}</td>

                    <td>
                        <img src="{{ asset('storage/image/'.$row->hinh_anh) }}">
                    </td>

                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('laptopdetail',$row->id) }}" 
                               class="btn btn-primary btn-sm w-50">
                                Xem
                            </a>

                            <form method="POST" action="{{ route('laptopdelete') }}" class="w-50">
                                @csrf
                                <input type="hidden" name="id" value="{{ $row->id }}">

                                <button class="btn btn-danger btn-sm w-100"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTable -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#laptop-table').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        stateSave: true,
        autoWidth: false
    });
});
</script>

</x-laptop-layout>