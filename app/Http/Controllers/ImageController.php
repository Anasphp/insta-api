<?php 

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
   public function uploadImage(Request $request)
    {
       $image = $request->file('file_name');
       $imageName = 'image-'.time().'.'.'jpg';
       $destinationPath = base_path('public/images');
       $image->move($destinationPath, $imageName);

       return response()->json($imageName);
    }

    public function getImage(Request $request)
    {
        dd(123);
    }


}