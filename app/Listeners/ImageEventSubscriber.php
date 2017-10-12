<?php

namespace App\Listeners;
use App\Profile;
use App\Image;
use Storage;
use Illuminate\Support\Facades\Auth;

class ImageEventSubscriber
{
    /**
     * Handle image update event
     *
     */
    public function onImageUpdate($event){
        $this
        // Delete old profile pics from storage and image table
        ->deleteOldProfilePics($event->data)
        // Store file to storage/app/public
        ->storeImageToStorage($event->data)
        // Store record to images table
        ->storeImageToTable($event->data);
    }

    /**
     * Handle image delete event
     *
     */
    public function onImageDelete($event){
        $this->deleteOldProfilePics($event->data);
    }

    /**
     * Register the listenrs for the subscriber.
     *
     * @param Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events){
        $events->listen(
            'App\Events\ImageUploaded',
            'App\Listeners\ImageEventSubscriber@onImageUpdate'
        );

        $events->listen(
            'App\Events\ProfilePicsDeleted',
            'App\Listeners\ImageEventSubscriber@onImageDelete'
        );
    }

    /**
     * Delete old pictures from storage && find all pictures on image table and delete it
     *
     * @return void
     */
    public function deleteOldProfilePics($data){
        $profilePic = $data['profile_pic'];
        // Delete old profile picture from storage
        // $old_profile_pic = str_replace('storage', 'public', $this->getProfilePic()->name);
        if(!$profilePic == null){
            Storage::delete('public/' . $profilePic->name);
            
            // Find all profile pictures on image table and delete it
            if($profilePic->count() > 0){
                $profilePic->delete();
            }
        }

        
        return $this;
    }

    /**
     * Store image to storage
     *
     * @param Request->file
     * @return void
     */
    protected function storeImageToStorage($data){
        $data['file']->storeAs('public', $data['imageName']);
        return $this;
    }

    /**
     * Store image to table
     *
     * @return void
     */
    protected function storeImageToTable($data){
        $image = new Image();
        $image->user_id = Auth::user()->id;
        $image->type = $data['type'];
        $image->name = $data['imageName'];

        Auth::user()->images()->save($image);

        return $this;
    }

}