<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    private const IMAGE_PATH = '/storage/public/partners/';

    public function index()
    {
        $partners = Partner::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])->orderBy('sort_order', 'asc')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'logo.required' => 'Vui lòng chọn logo.',
            'logo.image' => 'Vui lòng chọn file ảnh.',
            'logo.mimes' => 'File ảnh phải có định dạng jpeg, png, jpg, gif.',
            'logo.max' => 'File ảnh không được vượt quá 2MB.',
        ];

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], $messages);

        // Xử lý upload logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $request->sort_order . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/partners', $logoName);
            $logoPath = self::IMAGE_PATH . $logoName;
        }

        // Tạo đối tác mới
        $partner = Partner::create([
            'logo' => $logoPath,
            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? Partner::max('sort_order') + 1
        ]);

        // Tạo translation cho đối tác
        $partner->translations()->create([
            'locale' => app()->getLocale(),
            'name' => $request->name ?? null,
            'description' => $request->description ?? null,
            'website' => $request->website ?? null
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Đối tác đã được thêm thành công.');
    }

    public function edit(Partner $partner)
    {
        $partner->load(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }]);
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $messages = [
            'logo.image' => 'Vui lòng chọn file ảnh.',
            'logo.mimes' => 'File ảnh phải có định dạng jpeg, png, jpg, gif.',
            'logo.max' => 'File ảnh không được vượt quá 2MB.',
        ];

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], $messages);

        // Cập nhật thông tin đối tác
        $partner->update([
            'status' => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? $partner->sort_order
        ]);

        // Cập nhật hoặc tạo translation
        $translation = $partner->translations()->where('locale', app()->getLocale())->first();
        if ($translation) {
            $translation->update([
                'name' => $request->name ?? null,
                'description' => $request->description ?? null,
                'website' => $request->website ?? null
            ]);
        } else {
            $partner->translations()->create([
                'locale' => app()->getLocale(),
                'name' => $request->name ?? null,
                'description' => $request->description ?? null,
                'website' => $request->website ?? null
            ]);
        }

        // Xử lý upload logo mới nếu có
        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::delete('public' . $partner->logo);
            }
            $logo = $request->file('logo');
            $logoName = time() . '_' . $request->sort_order . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/partners', $logoName);
            $partner->logo = self::IMAGE_PATH . $logoName;
            $partner->save();
        }

        return redirect()->route('admin.partners.index')
            ->with('success', 'Đối tác đã được cập nhật thành công.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::delete('public' . $partner->logo);
        }
        $partner->delete();
        return redirect()->route('admin.partners.index')
            ->with('success', 'Đối tác đã được xóa thành công.');
    }
}