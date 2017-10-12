<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\Image;
use Storage;
use App\Events\ImageUploaded;
use App\Events\ProfilePicsDeleted;

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

        $data = [
            'profile_pic' => $this->getProfilePic(),
        ];

        event(new ProfilePicsDeleted($data));

        return back()
            ->with('success', 'You have successfully deleted your profile pic');
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
        
        $data = [
            'file' => $file,
            'imageName' => $imageName, 
            'type' => $type,
            'profile_pic' => $this->getProfilePic(),
        ];

        event(new ImageUploaded($data));

        //return
        return back()
            ->with('status', 'You have updated your profile picture.')
            ->with('image', $imageName);
        
    }

}
