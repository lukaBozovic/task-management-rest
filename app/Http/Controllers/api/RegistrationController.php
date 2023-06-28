<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request){
        //upload image
        $image = $request->file('image');
        $path = "storage/" . Storage::put('images', $image);
        $newImage = Image::query()->create([
            'name' => $image->getClientOriginalName(),
            'path' => $path
        ]);
        return User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'description' => $request['description'],
            'image_id' => $newImage->id
        ])->with('image')->get();
    }
}
