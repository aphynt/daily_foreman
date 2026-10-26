<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeAvatarController extends Controller
{
    public function show(Request $request, string $filename)
    {
        $avatar = (string) ($request->user()?->avatar ?? '');
        if ($avatar === '' || $filename !== $avatar || basename(str_replace('\\', '/', $filename)) !== $filename) {
            abort(404);
        }

        if (!preg_match('/\.(?:jpe?g|png|gif|webp)\z/i', $filename)) {
            abort(404);
        }

        try {
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = Storage::disk('employee_photos');
            if ($disk->exists($filename)) {
                return $disk->response($filename, null, [
                    'Cache-Control' => 'private, max-age=300',
                    'X-Content-Type-Options' => 'nosniff',
                ]);
            }
        } catch (\Throwable $exception) {
            report($exception);
        }
        return redirect(asset('dashboard/assets/images/user/avatar-1.png'));
    }
}
