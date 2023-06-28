<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request, User $user)
    {
        $lastImage = $user->image;
        Storage::delete(substr($lastImage->path, 8));
        $lastImage->delete();

        $image = $request->file('image');
        $path = "storage/" . Storage::put('images', $image);
        $newImage = Image::query()->create([
            'name' => $image->getClientOriginalName(),
            'path' => $path
        ]);

        $user->update([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'description' => $request['description'],
            'image_id' => $newImage->id
        ]);
        return $user->with('image')->get();
    }
}
