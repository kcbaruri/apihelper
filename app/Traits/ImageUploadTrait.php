<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    public function uploadFiles($request, $path, $userId = null)
    {
        $fileName = 'default-avatar.png';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtent = $file->getClientOriginalExtension(); //file extension
            $extent = array('jpeg', 'jpg', 'bmp', 'png', 'svg');
            if (in_array($fileExtent, $extent)) {
              if($userId){
                $fileName = $userId . '.' . $file->getClientOriginalExtension();
              }else{
                $fileName = uniqid() . str_random(5) . time() . '.' . $file->getClientOriginalExtension();
              }
                Storage::disk('public-root')->put($path . $fileName, file_get_contents($file));
            }
        }

        return $path . $fileName;
    }
}
