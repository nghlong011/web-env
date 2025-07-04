<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    private const IMAGE_PATH = '/storage/public/news/';

    public function index(Request $request)
    {
        $query = News::query();

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // Lọc theo danh mục
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Lọc theo khoảng thời gian
        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        $news = $query->with('translations')->latest()->paginate(10);
        $categories = News::distinct()->pluck('category');
        
        return view('admin.news.index', compact('news', 'categories'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'order.required' => 'Vui lòng nhập thứ tự.',
            'title_vi.required' => 'Vui lòng nhập tiêu đề (Tiếng Việt).',
            'title_en.required' => 'Vui lòng nhập tiêu đề (Tiếng Anh).',
            'description_vi.required' => 'Vui lòng nhập mô tả (Tiếng Việt).',
            'description_en.required' => 'Vui lòng nhập mô tả (Tiếng Anh).',
            'content_vi.required' => 'Vui lòng nhập nội dung (Tiếng Việt).',
            'content_en.required' => 'Vui lòng nhập nội dung (Tiếng Anh).',
            'image.required' => 'Vui lòng chọn ảnh thumbnail.',
            'image.image' => 'Vui lòng chọn file ảnh.',
            'image.mimes' => 'File ảnh phải có định dạng jpeg, png, jpg, gif.',
            'image.max' => 'File ảnh không được vượt quá 2MB.',
            'category.required' => 'Vui lòng chọn danh mục.',
            'date.required' => 'Vui lòng chọn ngày.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'slug_vi.required' => 'Vui lòng nhập slug (Tiếng Việt).',
            'slug_en.required' => 'Vui lòng nhập slug (Tiếng Anh).',
            'slug_vi.unique' => 'Slug tiếng Việt đã tồn tại.',
            'slug_en.unique' => 'Slug tiếng Anh đã tồn tại.',
            'meta_title_vi.required' => 'Vui lòng nhập meta title (Tiếng Việt).',
            'meta_title_en.required' => 'Vui lòng nhập meta title (Tiếng Anh).',
            'meta_description_vi.required' => 'Vui lòng nhập meta description (Tiếng Việt).',
            'meta_description_en.required' => 'Vui lòng nhập meta description (Tiếng Anh).',
            'meta_keywords_vi.required' => 'Vui lòng nhập meta keywords (Tiếng Việt).',
            'meta_keywords_en.required' => 'Vui lòng nhập meta keywords (Tiếng Anh).',
        ];

        $request->validate([
            'order' => 'required|integer',
            'title_vi' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_vi' => 'required|string',
            'description_en' => 'required|string',
            'content_vi' => 'required|string',
            'content_en' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|boolean',
            'slug_vi' => 'required|string|max:255|unique:news_translations,slug',
            'slug_en' => 'required|string|max:255|unique:news_translations,slug',
            'meta_title_vi' => 'required|string|max:255',
            'meta_title_en' => 'required|string|max:255',
            'meta_description_vi' => 'required|string|max:160',
            'meta_description_en' => 'required|string|max:160',
            'meta_keywords_vi' => 'required|string|max:255',
            'meta_keywords_en' => 'required|string|max:255'
        ], $messages);

        // Xử lý upload ảnh trước
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $request->slug_vi . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/news', $imageName);
            $imagePath = self::IMAGE_PATH . $imageName;
        }

        // Tạo tin tức mới với đường dẫn ảnh
        $news = News::create([
            'category' => $request->category,
            'order' => $request->order ?? 0,
            'date' => $request->date,
            'status' => $request->status,
            'image' => $imagePath
        ]);

        // Tạo bản dịch tiếng Việt
        NewsTranslation::create([
            'news_id' => $news->id,
            'locale' => 'vi',
            'title' => $request->title_vi,
            'content' => $request->content_vi,
            'description' => $request->description_vi,
            'slug' => $request->slug_vi,
            'meta_title' => $request->meta_title_vi,
            'meta_description' => $request->meta_description_vi,
            'meta_keywords' => $request->meta_keywords_vi,
            'og_title' => $request->title_vi,
            'og_description' => $request->description_vi,
            'og_image' => $news->image,
            'h1' => $request->title_vi,
            'alt_text' => $request->title_vi
        ]);

        // Tạo bản dịch tiếng Anh
        NewsTranslation::create([
            'news_id' => $news->id,
            'locale' => 'en',
            'title' => $request->title_en,
            'content' => $request->content_en,
            'description' => $request->description_en,
            'slug' => $request->slug_en,
            'meta_title' => $request->meta_title_en,
            'meta_description' => $request->meta_description_en,
            'meta_keywords' => $request->meta_keywords_en,
            'og_title' => $request->title_en,
            'og_description' => $request->description_en,
            'og_image' => $news->image,
            'h1' => $request->title_en,
            'alt_text' => $request->title_en
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'Tin tức đã được thêm thành công.');
    }

    public function edit(News $news)
    {
        // Lấy bản dịch cho cả 2 ngôn ngữ
        $translations = $news->translations()->get()->keyBy('locale');
        return view('admin.news.edit', compact('news', 'translations'));
    }

    public function update(Request $request, News $news)
    {
        $messages = [
            'title_vi.required' => 'Vui lòng nhập tiêu đề (Tiếng Việt).',
            'title_en.required' => 'Vui lòng nhập tiêu đề (Tiếng Anh).',
            'description_vi.required' => 'Vui lòng nhập mô tả (Tiếng Việt).',
            'description_en.required' => 'Vui lòng nhập mô tả (Tiếng Anh).',
            'content_vi.required' => 'Vui lòng nhập nội dung (Tiếng Việt).',
            'content_en.required' => 'Vui lòng nhập nội dung (Tiếng Anh).',
            'order.required' => 'Vui lòng nhập thứ tự.',
            'image.image' => 'Vui lòng chọn file ảnh.',
            'image.mimes' => 'File ảnh phải có định dạng jpeg, png, jpg, gif.',
            'image.max' => 'File ảnh không được vượt quá 2MB.',
            'category.required' => 'Vui lòng chọn danh mục.',
            'date.required' => 'Vui lòng chọn ngày.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'slug_vi.required' => 'Vui lòng nhập slug (Tiếng Việt).',
            'slug_en.required' => 'Vui lòng nhập slug (Tiếng Anh).',
            'slug_vi.unique' => 'Slug tiếng Việt đã tồn tại.',
            'slug_en.unique' => 'Slug tiếng Anh đã tồn tại.',
            'meta_title_vi.required' => 'Vui lòng nhập meta title (Tiếng Việt).',
            'meta_title_en.required' => 'Vui lòng nhập meta title (Tiếng Anh).',
            'meta_description_vi.required' => 'Vui lòng nhập meta description (Tiếng Việt).',
            'meta_description_en.required' => 'Vui lòng nhập meta description (Tiếng Anh).',
            'meta_keywords_vi.required' => 'Vui lòng nhập meta keywords (Tiếng Việt).',
            'meta_keywords_en.required' => 'Vui lòng nhập meta keywords (Tiếng Anh).',
        ];
        
        // Lấy slug hiện tại của tin tức
        $currentSlugs = $news->translations()->pluck('slug', 'locale')->toArray();
        
        $request->validate([
            'title_vi' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_vi' => 'required|string',
            'description_en' => 'required|string',
            'content_vi' => 'required|string',
            'content_en' => 'required|string',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|boolean',
            'slug_vi' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($currentSlugs) {
                    if ($value !== $currentSlugs['vi'] && NewsTranslation::where('slug', $value)->exists()) {
                        $fail('Slug tiếng Việt đã tồn tại.');
                    }
                }
            ],
            'slug_en' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($currentSlugs) {
                    if ($value !== $currentSlugs['en'] && NewsTranslation::where('slug', $value)->exists()) {
                        $fail('Slug tiếng Anh đã tồn tại.');
                    }
                }
            ],
            'meta_title_vi' => 'required|string|max:255',
            'meta_title_en' => 'required|string|max:255',
            'meta_description_vi' => 'required|string|max:160',
            'meta_description_en' => 'required|string|max:160',
            'meta_keywords_vi' => 'required|string|max:255',
            'meta_keywords_en' => 'required|string|max:255'
        ], $messages);

        // Cập nhật tin tức chính
        $news->update([
            'order' => $request->order ?? 0,
            'category' => $request->category,
            'date' => $request->date,
            'status' => $request->status
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::delete('public' . $news->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $news->slug . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/news', $imageName);
            $news->image = self::IMAGE_PATH . $imageName;
            $news->save();
        }

        // Cập nhật bản dịch tiếng Việt
        $news->translations()->updateOrCreate(
            ['locale' => 'vi'],
            [
                'title' => $request->title_vi,
                'content' => $request->content_vi,
                'description' => $request->description_vi,
                'slug' => $request->slug_vi,
                'meta_title' => $request->meta_title_vi,
                'meta_description' => $request->meta_description_vi,
                'meta_keywords' => $request->meta_keywords_vi,
                'og_title' => $request->title_vi,
                'og_description' => $request->description_vi,
                'og_image' => $news->image,
                'h1' => $request->title_vi,
                'alt_text' => $request->title_vi
            ]
        );

        // Cập nhật bản dịch tiếng Anh
        $news->translations()->updateOrCreate(
            ['locale' => 'en'],
            [
                'title' => $request->title_en,
                'content' => $request->content_en,
                'description' => $request->description_en,
                'slug' => $request->slug_en,
                'meta_title' => $request->meta_title_en,
                'meta_description' => $request->meta_description_en,
                'meta_keywords' => $request->meta_keywords_en,
                'og_title' => $request->title_en,
                'og_description' => $request->description_en,
                'og_image' => $news->image,
                'h1' => $request->title_en,
                'alt_text' => $request->title_en
            ]
        );

        return redirect()->route('admin.news.index')
            ->with('success', 'Tin tức đã được cập nhật thành công.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::delete('public/' . $news->image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')
            ->with('success', 'Tin tức đã được xóa thành công.');
    }
} 