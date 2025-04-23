<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="{{ route('nhanviens.create') }}">Thêm Nhân viên Mới</a> {{-- Sử dụng tên route đã định nghĩa --}}

<table>
    {{-- ... thead ... --}}
    <tbody>
        @foreach ($danhSachNhanVien as $nhanVien)
            <tr>
                {{-- ... hiển thị các cột thông tin ... --}}
                <td>
                    @foreach ($nhanVien->phongBan as $pb)
                        {{ $pb->ten_phong_ban }}@if (!$loop->last), @endif
                    @endforeach
                </td>
                 <td>
                    @foreach ($nhanVien->phongBan as $pb)
                        {{ $pb->pivot->chuc_vu }}@if (!$loop->last), @endif {{-- Lấy chức vụ từ bảng trung gian --}}
                    @endforeach
                </td>
                <td>
                     @if ($nhanVien->avatar)
                         {{-- Giả định bạn đã chạy php artisan storage:link --}}
                        <img src="{{ asset('storage/' . $nhanVien->avatar) }}" alt="Avatar" width="50">
                    @else
                        Không có ảnh
                    @endif
                </td>
                <td>
                    {{-- Link xem chi tiết (nếu có) --}}
                     <a href="{{ route('nhanviens.show', $nhanVien->id_nhan_vien) }}">Xem</a> |

                    {{-- Link Sửa --}}
                    <a href="{{ route('nhanviens.edit', $nhanVien->id_nhan_vien) }}">Sửa</a> |

                    {{-- Form Xóa (nên dùng form POST giả lập DELETE) --}}
                    <form action="{{ route('nhanviens.destroy', $nhanVien->id_nhan_vien) }}" method="POST" style="display:inline;">
                        @csrf {{-- Token CSRF bắt buộc --}}
                        @method('DELETE') {{-- Giả lập phương thức DELETE --}}
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        {{-- ... trường hợp không có dữ liệu ... --}}
    </tbody>
</table>
{{-- ... --}}
</body>
</html>