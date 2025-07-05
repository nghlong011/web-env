<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpFoundation\Response;

class HandlePostTooLarge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (PostTooLargeException $e) {
            // Kiểm tra nếu request có header X-Requested-With (AJAX request)
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'error' => [
                        'message' => 'Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn.',
                        'details' => 'Giới hạn upload hiện tại: ' . ini_get('upload_max_filesize')
                    ]
                ], 413);
            }

            // Redirect với thông báo lỗi cho request thường
            return redirect()->back()->withErrors([
                'upload' => 'Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn ' . ini_get('upload_max_filesize')
            ]);
        }
    }
} 