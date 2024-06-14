<?php

namespace App\Http\Controllers;


class ResourcesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('resources');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wallpaperIndex()
    {
        $files = scandir(public_path('wallpaper'));
        $images = array_values(array_filter($files, fn($file) => in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])));
        return view('wallpaper', ['images' => $images]);
    }

}
