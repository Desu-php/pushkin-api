<?php

namespace App\Http\Controllers;

class FilesDownloadController extends Controller
{
    public function __construct()
    {
        // $this->middleware('jwt.auth');
    }

    public function index( $applicationId, $filename)
    {
        $path = storage_path('app/applications/' . $applicationId . '/' . $filename);
        return response()->file($path);
    }
}
