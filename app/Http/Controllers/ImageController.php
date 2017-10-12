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
     * Delete Profile Pics
     *
     * @return back()
     */
    public function deleteProfilePic(){
        $this->deleteOldProfilePics();
        return back()
            ->with('success', 'You have successfully deleted your profile pic');
    }

    /**
     * Delete old pictures from storage && find all pictures on image table and delete it
     *
     * @return void
     */
    protected function deleteOldProfilePics(){
        // Delete old profile picture from storage
        // $old_profile_pic = str_replace('storage', 'public', $this->getProfilePic()->name);
        if(!$this->getProfilePic() == null){
            Storage::delete('public/' . $this->getProfilePic()->name);
            
            // Find all profile pictures on image table and delete it
            if($this->getProfilePic()->count() > 0){
                $this->getProfilePic()->delete();
            }
        }

        return $this;
    }
    /**
     * Update Profile Records
     *
     * @return void
     */
    protected function updateProfileImgId(){
        $profile = Auth::user()->profile()->first();
        
        if($profile){
            $profile->img_id = $this->getProfilePic()->id;
            $profile->save();
        }

        return $this;
    }
    
    /**
     * Store image to table
     *
     * @return void
     */
    protected function storeImageToTable($name, $type){
        $image = new Image();
        $image->user_id = Auth::user()->id;
        $image->type = $type;
        $image->name = $name;

        Auth::user()->images()->save($image);

        return $this;
    }

    /**
     * Store image to storage
     *
     * @param Request->file
     * @return void
     */
    protected function storeImageToStorage($file, $imageName){
        $file->storeAs('public', $imageName);
        return $this;
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
        
        // Delete old profile pics
        $this->deleteOldProfilePics()
            // Store file to storage/app/public/images
            ->storeImageToStorage($file, $imageName)
            // Store record to images table
            ->storeImageToTable($imageName, $type)
            // Update record on profile table
            ->updateProfileImgId();

        //return
        return back()
            ->with('status', 'You have updated your profile picture.')
            ->with('image', $imageName);
        
    }

}
