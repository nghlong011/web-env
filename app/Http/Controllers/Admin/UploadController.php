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
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
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
                    if (Storage::exists($path)) {
                        $url = asset('storage/uploads/' . $fileName);
                        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                        $msg = 'Image uploaded successfully';
                        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                        
                        @header('Content-type: text/html; charset=utf-8');
                        echo $response;
                        exit;
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
            return response()->json([
                'error' => [
                    'message' => $e->getMessage()
                ]
            ], 500);
        }
    }
} 