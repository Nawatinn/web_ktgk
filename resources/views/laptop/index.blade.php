<x-laptop-layout>
    <x-slot name="title">
        Laptop
    </x-slot>
    <div style="text-align:center; margin:15px 0;">
        <span>Tìm kiếm theo</span>

        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}">
            <button class="btn-sort">Giá tăng dần</button>
        </a>

        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}">
            <button class="btn-sort">Giá giảm dần</button>
        </a>
    </div>
    <div class='list-laptop'>
        @foreach($laptops as $row)
            <div class='laptop'>
                <a href="{{ url('/laptop/'.$row->id) }}">
                    
                    <!-- Hình ảnh -->
                    <img src="{{ asset('storage/image/'.$row->hinh_anh) }}" 
                         width="100%" height="180px"><br>

                    <!-- Tiêu đề -->
                    <b>{{ $row->tieu_de }}</b><br/>


                    <!-- Giá -->
                    <p style="color:red; font-weight:bold">
                        {{ number_format($row->gia) }} VND
                    </p>

                </a>
            </div>  
        @endforeach
    </div>

</x-laptop-layout>