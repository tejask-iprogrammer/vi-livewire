<?php
/**
 * The class for handling validation requests from TestimonialsController::deleteAction()
 *
 *
 * @author Sachin S. <sachins@iprogrammer.com>
 * @package Admin
 * @since 1.0
 */

namespace App\Helpers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Intervention\Image\ImageManagerStatic as Image;
use Guzzle\Http\EntityBody;
use File;
use Config;
use Storage;
use DB;
use Route;
use App;

class ImageHelper {

    /**
     * upload user avatar
     * @return String
     */
    public static function s3UploadImage($data , $directory ,$data1) {
            // echo "<pre>";print_r($directory."<br>");
            dd($data['fileName']);
        // $s3 = Storage::disk('s3');
        if (empty($data['fileName']) || $data['fileName'] == '') {
            $fileName = 'banner-' . $data['imgId'] . '-' . time() . '.' . $data['fileName']->getClientOriginalExtension();
        }else{
            $fileName = (explode(".",$data['fileName']->getClientOriginalName()));
            $fileName =  $fileName[0];
            $fileName = $fileName.'-' . $data['imgId'] . '-' . time() . '.' . $data['fileName']->getClientOriginalExtension();
        }
    //   dd($fileName);
        // $path = self::getUserUploadFolder();
        // $fileObj->move(public_path() . $path, $fileName);
        // $this->avatar->storeAs($directory , $inputs['profile_photo_path']->getClientOriginalName(), 's3');
        // dd($data1);
        // $directory1= DIRECTORY_SEPARATOR."user1";
        // dd($directory1);
        // $path = self::getuploadFolder($data['imgId'],$directory);
        $val = $data1->storeAs("arpredirection", $fileName, 's3');
        return $val;
    }

    // public static function getuploadFolder($offercategory = '',$directory) {
    //     $offer_category_folder = $directory;
    //     $path =  "".DIRECTORY_SEPARATOR . $offer_category_folder;
    //     self::checkDirectory(public_path() . $path);

    //     return $path;
    // }
    // public static function checkDirectory($dirPath = '') {
    //     if (!\File::exists($dirPath)) {
    //         \File::makeDirectory($dirPath, 0775, true);
    //     }
    // }
    
}
