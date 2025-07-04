<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    private const IMAGE_PATH = '/storage/public/banners/';

    public function index()
    {
        $banners = Banner::where('category', 1)
            ->orderBy('order')
            ->get();
        
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'img.required' => 'Vui lòng chọn hình ảnh.',
            'img.image' => 'Vui lòng chọn file ảnh.',
            'img.mimes' => 'File ảnh phải có định dạng jpeg, png, jpg, gif.',
            'img.max' => 'File ảnh không được vượt quá 5MB.',
            'link.required' => 'Vui lòng nhập đường dẫn.',
            'order.required' => 'Vui lòng nhập thứ tự.',
        ];

        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'link' => 'nullable|string|max:255',
            'order' => 'required|integer',
        ], $messages);

        // Xử lý upload ảnh
        $imagePath = null;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time()  . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/banners', $imageName);
            $imagePath = self::IMAGE_PATH . $imageName;
        }

        // Tạo banner mới
        $banner = Banner::create([
            'img' => $imagePath,
            'link' => $request->link,
            'category' => 1,
            'order' => $request->order,
            'active' => $request->active ?? 0
        ]);


        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner đã được thêm thành công.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $messages = [
            'img.image' => 'Vui lòng chọn file ảnh.',
            'img.mimes' => 'File ảnh phải có định dạng jpeg, png, jpg, gif.',
            'img.max' => 'File ảnh không được vượt quá 5MB.',
            'link.required' => 'Vui lòng nhập đường dẫn.',
            'order.required' => 'Vui lòng nhập thứ tự.',
        ];

        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'link' => 'nullable|string|max:255',
            'order' => 'required|integer',
        ], $messages);
        // Cập nhật thông tin banner
        $banner->update([
            'link' => $request->link,
            'order' => $request->order,
            'active' => $request->active ?? 0
        ]);

        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile('img')) {
            if ($banner->img) {
                Storage::delete('public' . $banner->img);
            }
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/banners', $imageName);
            $banner->img = self::IMAGE_PATH . $imageName;
            $banner->save();
        }


        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner đã được cập nhật thành công.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->img) {
            Storage::delete('public' . $banner->img);
        }
        $banner->delete();
        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner đã được xóa thành công.');
    }
} 