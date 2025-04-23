<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Thêm Nhân viên Mới</h2>

{{-- Hiển thị lỗi validation nếu có --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('nhanviens.store') }}" method="POST" enctype="multipart/form-data"> {{-- enctype="multipart/form-data" là BẮT BUỘC khi upload file --}}
    @csrf {{-- Token CSRF --}}

    <div>
        <label for="ho_ten">Họ Tên:</label>
        <input type="text" name="ho_ten" id="ho_ten" value="{{ old('ho_ten') }}" required> {{-- old() giúp giữ lại giá trị cũ khi validation lỗi --}}
    </div>
    {{-- ... các trường khác (ngày sinh, giới tính, SĐT, email, địa chỉ) tương tự ... --}}
     <div>
        <label for="gioi_tinh">Giới Tính:</label>
        <select name="gioi_tinh" id="gioi_tinh">
            <option value="">-- Chọn --</option>
            <option value="Nam" {{ old('gioi_tinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
            <option value="Nữ" {{ old('gioi_tinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
             <option value="Khác" {{ old('gioi_tinh') == 'Khác' ? 'selected' : '' }}>Khác</option>
        </select>
    </div>

     <div>
        <label for="avatar">Ảnh Đại diện:</label>
        <input type="file" name="avatar" id="avatar">
    </div>

    {{-- Phần chọn phòng ban và chức vụ (nếu thêm cùng lúc) --}}
    <div>
        <label for="phong_ban_id">Phòng Ban:</label>
        <select name="phong_ban_id" id="phong_ban_id">
             <option value="">-- Chọn Phòng Ban --</option>
            @foreach ($phongBans as $pb)
                <option value="{{ $pb->id_phong_ban }}" {{ old('phong_ban_id') == $pb->id_phong_ban ? 'selected' : '' }}>{{ $pb->ten_phong_ban }}</option>
            @endforeach
        </select>
    </div>
     <div>
        <label for="chuc_vu">Chức vụ:</label>
         <input type="text" name="chuc_vu" id="chuc_vu" value="{{ old('chuc_vu') }}">
    </div>


    <button type="submit">Lưu Nhân viên</button>
</form>
{{-- ... --}}
</body>
</html>