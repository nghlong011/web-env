<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function __construct()
    {
        // Đảm bảo user đã đăng nhập
        $this->middleware('auth');
        
        // Đảm bảo CSRF protection cho upload
        $this->middleware('web');
    }

    public function uploadImage(Request $request)
    {
        try {
            // Kiểm tra kích thước file trước khi validate
            $uploadMaxSize = $this->parseSize(ini_get('upload_max_filesize'));
            $postMaxSize = $this->parseSize(ini_get('post_max_size'));
            $maxFileSize = min($uploadMaxSize, $postMaxSize);
            
            $request->validate([
                'upload' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif,webp',
                    'max:' . ($maxFileSize / 1024) // Convert back to KB for validation
                ]
            ], [
                'upload.required' => 'Vui lòng chọn file để upload.',
                'upload.image' => 'File phải là hình ảnh.',
                'upload.mimes' => 'File phải có định dạng: jpeg, png, jpg, gif, webp.',
                'upload.max' => 'Kích thước file không được vượt quá ' . ($maxFileSize / 1024 / 1024) . 'MB.'
            ]);

            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                
                // Tạo thư mục uploads nếu chưa tồn tại
                $uploadPath = storage_path('app/public/uploads');
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0777, true);
                    Log::info('Created upload directory: ' . $uploadPath);
                }
                
                // Lưu file
                $path = $file->storeAs('uploads', $fileName, 'public');
                
                if ($path) {
                    // Kiểm tra file có tồn tại không
                    if (Storage::disk('public')->exists('uploads/' . $fileName)) {
                        $url = asset('storage/uploads/' . $fileName);
                        
                        // Kiểm tra nếu đây là AJAX request (XHR)
                        if ($request->ajax() || $request->wantsJson()) {
                            return response()->json([
                                'url' => $url,
                                'uploaded' => 1,
                                'fileName' => $fileName
                            ]);
                        }
                        
                        // Response cho CKEditor form upload (nếu vẫn còn sử dụng)
                        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                        if ($CKEditorFuncNum) {
                            $msg = 'Image uploaded successfully';
                            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                            
                            return response($response)->header('Content-Type', 'text/html; charset=utf-8');
                        }
                        
                        // Response mặc định
                        return response()->json([
                            'url' => $url,
                            'uploaded' => 1,
                            'fileName' => $fileName
                        ]);
                    } else {
                        Log::error('File not found after upload', [
                            'path' => $path
                        ]);
                        throw new \Exception('File not found after upload');
                    }
                }
            }

            Log::error('Upload failed', [
                'hasFile' => $request->hasFile('upload'),
                'all' => $request->all()
            ]);

            return response()->json([
                'error' => [
                    'message' => 'Upload failed'
                ]
            ], 400);

        } catch (\Exception $e) {
            Log::error('Upload error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            // Kiểm tra nếu đây là AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'error' => [
                        'message' => $e->getMessage()
                    ]
                ], 500);
            }
            
            // Response cho CKEditor form upload (nếu vẫn còn sử dụng)
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            if ($CKEditorFuncNum) {
                $msg = 'Upload failed: ' . $e->getMessage();
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '', '$msg')</script>";
                return response($response)->header('Content-Type', 'text/html; charset=utf-8');
            }
            
            return response()->json([
                'error' => [
                    'message' => $e->getMessage()
                ]
            ], 500);
        }
    }

    /**
     * Lấy thông tin cấu hình upload
     */
    public function getUploadConfig()
    {
        $config = [
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'max_execution_time' => ini_get('max_execution_time'),
            'memory_limit' => ini_get('memory_limit'),
            'max_file_uploads' => ini_get('max_file_uploads'),
            'file_uploads' => ini_get('file_uploads') ? 'Enabled' : 'Disabled',
        ];

        return response()->json($config);
    }

    /**
     * Chuyển đổi kích thước từ string sang bytes
     * Ví dụ: "8M" -> 8388608 bytes
     */
    private function parseSize($size)
    {
        $size = trim($size);
        $last = strtolower($size[strlen($size) - 1]);
        $size = (int) $size;
        
        switch ($last) {
            case 'g':
                $size *= 1024;
            case 'm':
                $size *= 1024;
            case 'k':
                $size *= 1024;
        }
        
        return $size;
    }
} 