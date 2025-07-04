<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    private const IMAGE_PATH = '/storage/public/gallery/';

    private function getCategoryValue($category)
    {
        return match($category) {
            'image' => 1,
            'video' => 2,
            'document' => 3,
            default => 1
        };
    }

    private function getCategoryText($value)
    {
        return match($value) {
            1 => 'image',
            2 => 'video',
            3 => 'document',
            default => 'image'
        };
    }

    public function index(Request $request)
    {
        $query = Gallery::with('translations');

        // Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Lọc theo trạng thái
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Tìm kiếm theo tiêu đề
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('translations', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $galleries = $query->orderBy('order')->paginate(10)->withQueryString();
        
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title_vi' => 'string|max:255',
            'title_en' => 'string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'integer|in:1,2,3',
            'order' => 'integer|min:0',
            'status' => 'boolean',
        ];

        if ($request->category == 2) {
            if ($request->video_type === 'upload') {
                $rules['video_file'] = 'required|file|mimes:mp4,mov,avi|max:102400';
            } else {
                $rules['video_url'] = 'required|url|max:255';
            }
        }
        if ($request->category == 3) {
            $rules['document_file'] = 'required|file|mimes:pdf|max:10240';
        }
        $request->validate($rules);

        $data = $request->only(['category', 'order', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        // Reset các trường
        $data['video_url'] = null;
        $data['document_url'] = null;

        if ($request->category == 2) { // Video
            if ($request->video_type === 'upload' && $request->hasFile('video_file')) {
                $data['video_url'] = $this->uploadVideo($request->file('video_file'));
            } elseif ($request->video_type === 'url') {
                $data['video_url'] = $request->video_url;
            }
        } elseif ($request->category == 3) { // Tài liệu
            if ($request->hasFile('document_file')) {
                $data['document_url'] = $this->uploadDocument($request->file('document_file'));
            }
        }

        $gallery = Gallery::create($data);

        $gallery->translations()->createMany([
            [
                'locale' => 'vi',
                'title' => $request->title_vi,
            ],
            [
                'locale' => 'en',
                'title' => $request->title_en,
            ],
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Thêm hình ảnh thành công.');
    }

    public function edit(Gallery $gallery)
    {
        $translations = $gallery->translations()->get()->keyBy('locale');
        return view('admin.gallery.edit', compact('gallery', 'translations'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $rules = [
            'title_vi' => 'string|max:255',
            'title_en' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'integer|in:1,2,3',
            'order' => 'integer|min:0',
            'status' => 'boolean',
        ];
        if ($request->category == 2) {
            if ($request->video_type === 'upload') {
                $rules['video_file'] = 'required|file|mimes:mp4,mov,avi|max:102400';
            } else {
                $rules['video_url'] = 'required|url|max:255';
            }
        }
        if ($request->category == 3) {
            $rules['document_file'] = 'required|file|mimes:pdf|max:10240';
        }
        $request->validate($rules);

        $data = $request->only(['category', 'order', 'status']);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::delete('public/' . $gallery->image);
            }
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        // Reset các trường
        $data['video_url'] = null;
        $data['document_url'] = null;

        if ($request->category == 2) { // Video
            if ($request->video_type === 'upload' && $request->hasFile('video_file')) {
                if ($gallery->video_url && !filter_var($gallery->video_url, FILTER_VALIDATE_URL)) {
                    Storage::delete('public/' . $gallery->video_url);
                }
                $data['video_url'] = $this->uploadVideo($request->file('video_file'));
            } elseif ($request->video_type === 'url') {
                if ($gallery->video_url && !filter_var($gallery->video_url, FILTER_VALIDATE_URL)) {
                    Storage::delete('public/' . $gallery->video_url);
                }
                $data['video_url'] = $request->video_url;
            }
        } elseif ($request->category == 3) { // Tài liệu
            if ($request->hasFile('document_file')) {
                if ($gallery->document_url) {
                    Storage::delete('public/' . $gallery->document_url);
                }
                $data['document_url'] = $this->uploadDocument($request->file('document_file'));
            }
        } else {
            if ($gallery->video_url && !filter_var($gallery->video_url, FILTER_VALIDATE_URL)) {
                Storage::delete('public/' . $gallery->video_url);
            }
            if ($gallery->document_url) {
                Storage::delete('public/' . $gallery->document_url);
            }
        }

        $gallery->update($data);

        $gallery->translations()->updateOrCreate(
            ['locale' => 'vi'],
            ['title' => $request->title_vi]
        );
        $gallery->translations()->updateOrCreate(
            ['locale' => 'en'],
            ['title' => $request->title_en]
        );

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Cập nhật hình ảnh thành công.');
    }

    private function uploadImage($file)
    {
        $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gallery', $imageName);
        return self::IMAGE_PATH . $imageName;
    }

    private function uploadVideo($file)
    {
        $videoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gallery', $videoName);
        return self::IMAGE_PATH . $videoName;
    }

    private function uploadDocument($file)
    {
        $documentName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gallery', $documentName);
        return self::IMAGE_PATH . $documentName;
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::delete('public' . $gallery->image);
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.index')
            ->with('success', 'Hình ảnh đã được xóa thành công.');
    }
} 