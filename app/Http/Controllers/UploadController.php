<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class UploadController extends Controller
{
    public function index()
    {
        $path = public_path() . '/' . 'callista_alifia.jpg';
        $fileName = 'jkt48/' . time() . '_' . uniqid() . '.jpg';

        Storage::disk('google')->put($fileName, File::get($path));

        return response()->json([
            'success' => true
        ]);
    }

    public function download()
    {
        $filePath = '1681903202_643fce62ecefb.jpg';

        $data = Gdrive::get($filePath);

        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Content-disposition', 'attachment; filename="' . $data->filename . '"');
    }
}
