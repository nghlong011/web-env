<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    private const IMAGE_PATH = '/storage/public/settings/';

    public function index()
    {
        return view('admin.settings.index');
    }

    public function showGroup($parentId)
    {
        $settings = Setting::where('parent_id', $parentId)->with('translations')->get();
        $groupTitle = match ((int)$parentId) {
            0 => 'Trang chủ',
            1 => 'Trang giới thiệu',
            2 => 'Thông tin chung',
            default => 'Nhóm không xác định',
        };
        return view('admin.settings.group', compact('settings', 'groupTitle'));
    }

    public function edit(Setting $setting)
    {
        $setting->load('translations');
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $messages = [
            'image.image' => 'Vui lòng chọn file ảnh.',
            'image.mimes' => 'File ảnh phải có định dạng jpeg, png, jpg, gif.',
            'image.max' => 'File ảnh không được vượt quá 2MB.',
            'vi_name.required' => 'Vui lòng nhập tên tiếng Việt.',
            'en_name.required' => 'Vui lòng nhập tên tiếng Anh.',
            'vi_description.required' => 'Vui lòng nhập mô tả tiếng Việt.',
            'en_description.required' => 'Vui lòng nhập mô tả tiếng Anh.',
        ];

        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        if ($setting->key !== 'logo') {
            $rules['vi_name'] = 'required|string|max:255';
            $rules['en_name'] = 'required|string|max:255';
            $rules['vi_description'] = 'required|string';
            $rules['en_description'] = 'required|string';
        }

        $request->validate($rules, $messages);

        // Cập nhật thông tin
        $setting->update([
            'active' => $request->active ?? true,
        ]);

        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile('image')) {
            if ($setting->image_path) {
                Storage::delete('public' . $setting->image_path);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/settings', $imageName);
            $setting->image_path = self::IMAGE_PATH . $imageName;
            $setting->save();
        }

        // Cập nhật bản dịch
        if ($setting->key !== 'logo') {
            $setting->translations()->where('language', 'vi')->update([
                'name' => $request->vi_name,
                'description' => $request->vi_description,
            ]);

            $setting->translations()->where('language', 'en')->update([
                'name' => $request->en_name,
                'description' => $request->en_description,
            ]);
        }

        return redirect()->route('admin.settings.group', $setting->parent_id)
            ->with('success', 'Thông tin đã được cập nhật thành công.');
    }
} 