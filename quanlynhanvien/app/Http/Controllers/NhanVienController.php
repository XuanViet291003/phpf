<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\PhongBan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use App\Models\NhanVienPhongBan; 

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danhSachNhanVien = NhanVien::with('phongBan')->get();
        return view('nhanvien.index', compact('danhSachNhanVien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     $phongBans = PhongBan::all(); 
     return view('nhanvien.create', compact('phongBans')); 
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // 1. Kiểm tra dữ liệu (Validation)
    $request->validate([
        'ho_ten' => 'required|string|max:255',
        'ngay_sinh' => 'nullable|date',
        'gioi_tinh' => 'nullable|in:Nam,Nữ,Khác',
        'so_dien_thoai' => 'nullable|string|max:20',
        'email' => 'nullable|email|unique:nhan_vien,email', 
        'dia_chi' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        'phong_ban_id' => 'nullable|exists:phong_ban,id_phong_ban',
        'chuc_vu' => 'nullable|string|max:100',
    ]);


    $data = $request->except('avatar', 'phong_ban_id', 'chuc_vu');
    $data['avatar'] = null; 

    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $data['avatar'] = $path; 
    }

    $nhanVien = NhanVien::create($data);

    if ($request->filled('phong_ban_id') && $request->filled('chuc_vu')) {
         NhanVienPhongBan::create([
            'id_nhan_vien' => $nhanVien->id_nhan_vien,
            'id_phong_ban' => $request->phong_ban_id,
            'chuc_vu' => $request->chuc_vu,
         ]);
         // $nhanVienPhongBan = new NhanVienPhongBan();
         // $nhanVienPhongBan->nhanVien()->associate($nhanVien);
         // $nhanVienPhongBan->phongBan()->associate(PhongBan::find($request->phong_ban_id));
         // $nhanVienPhongBan->chuc_vu = $request->chuc_vu;
         // $nhanVienPhongBan->save();

        // Hoặc dùng phương thức attach() nếu bạn đã định nghĩa belongsToMany trong Model NhanVien
         // $nhanVien->phongBan()->attach($request->phong_ban_id, ['chuc_vu' => $request->chuc_vu]);
    }

    return redirect()->route('nhanviens.index')->with('success', 'Thêm nhân viên thành công!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nhanVien = NhanVien::findOrFail($id); 
        $phongBans = PhongBan::all(); 


    return view('nhanvien.edit', compact('nhanVien', 'phongBans')); //, 'currentPhongBanInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
