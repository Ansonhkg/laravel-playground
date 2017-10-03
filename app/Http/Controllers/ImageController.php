<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\Image;
use Storage;

class ImageController extends Controller
{
    /**
     * Get the image URL
     *
     * @return string imageUrl
     */
    public function getProfilePic(){
        return Auth::user()->profilePic()->first();
    }
    /**
     * Update Profile Picture
     *
     * @param Request $request
     * @return void
     */
    public function updateProfilePic(Request $request){
        $type = 'profile';
        return $this->postImage($request, $type);
    }
    /**
     * Delete old pictures from storage && find all pictures on image table and delete it
     *
     * @return void
     */
    public function resetProfileImage(){
        // Delete old profile picture from stoage
        $old_profile_pic = str_replace('storage', 'public', $this->getProfilePic()->path);
        Storage::delete($old_profile_pic);

        // Find all profile pictures on image table and delete it
        if($this->getProfilePic()->count() > 0){
            $this->getProfilePic()->delete();
        }
    }
    /**
     * Update Profile Records
     *
     * @return void
     */
    public function updateProfileImage(){
        $profile = Auth::user()->profile()->first();
        
        if($profile){
            $profile->img_id = $this->getProfilePic()->id;
            $profile->save();
        }
    }
    /**
     * Store Image
     *
     * @return void
     */
    public function storeImage($path, $type){
        $image = new Image();
        $image->user_id = Auth::user()->id;
        $image->type = $type;
        $image->path = $path;

        Auth::user()->images()->save($image);
    }

    /**
     * Upload Image
     *
     * @param Request $request
     * @param [type] $type
     * @return void
     */
    private function postImage(Request $request, $type){

        // Validation
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpeg,png,gif|dimensions:min-width:100,min-height:200',
        ]);
        
        $file = $request->file('image');
        
        // Check if file is uploaded (but not stored)
        if (!$file->isValid()) {
            return back()
            ->with('status', 'Unable to upload picture.')
            ->with('image', $imageName);
        }

        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $imageName = str_slug(date('Y-m-d-h-i-s') . $filename . str_random()) . '.' . $file->extension();
        
        // Store file to storage/app/public/images
        $file->storeAs('public/images', $imageName);
        
        // Reset Profile Records
        if(!$this->getProfilePic() == null){
            $this->resetProfileImage();
        }

        // Store record to images table
        $this->storeImage('storage/images/' . $imageName, $type);
        
        // Update record on profile table
        $this->updateProfileImage();

        //return
        return back()
            ->with('status', 'You have updated your profile picture.')
            ->with('image', $imageName);
        
    }

}
