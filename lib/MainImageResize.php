<?php
/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 07.01.2018
 * Time: 0:34
 */

require '../lib/SimpleImage.php';

$images_dir = '../i/dress/2018/005';
//$images_dir = '../i/dress/_design/003';

$thumbs_dir = $images_dir.'/t';

$image_files = get_files($images_dir);
if(count($image_files)) {
    $index = 0; $count=1;
    foreach($image_files as $index => $file) {
        $index++;
        $thumbnail_image = $thumbs_dir.'/'.$file;
        if(!file_exists($thumbnail_image)) {
            $extension = get_file_extension($thumbnail_image);
            if($extension) {
                $src=$images_dir.'/'.$file;
                make_thumb($src,$thumbnail_image);
//                echo "$count $src -> $thumbnail_image \n";
                $count++;
            }
        }

    }
    --$count; echo "$count files converted. \n";
} else { echo 'There are no images in this gallery.'; }

// Ignore notices
error_reporting(E_ALL & ~E_NOTICE);


/* function:  generates thumbnail */
function make_thumb($src,$dest) {
    try {
        // Create a new SimpleImage object
        $image = new \claviska\SimpleImage();

        // load file
        $image->fromFile($src);
        // img getMimeType
        $mime = $image->getMimeType();
        // Manipulate it
        $image
            ->autoOrient()                          // adjust orientation based on exif data
            ->bestFit(200, 300) // proportionally resize to fit inside a 250x400 box
//        ->flip('x')                           // flip horizontally
//        ->colorize('DarkGreen')               // tint dark green
//        ->sharpen()
            ->border('darkgray', 1)      // add a 2 pixel black border
//        ->overlay('flag.png', 'bottom right') // add a watermark image
//        ->toScreen();                         // output to the screen
            ->toFile($dest,$mime,80);
//    echo "mime type: ".$mime;
    } catch(Exception $err) {
        // Handle errors
        echo $err->getMessage();
    }
}

/* function:  returns files from dir */
function get_files($images_dir,$exts = array('jpg')) {
    $files = array();
    if($handle = opendir($images_dir)) {
        while(false !== ($file = readdir($handle))) {
            $extension = strtolower(get_file_extension($file));
            if($extension && in_array($extension,$exts)) {
                $files[] = $file;
            }
        }
        closedir($handle);
    }
    return $files;
}

/* function:  returns a file's extension */
function get_file_extension($file_name) {
    return substr(strrchr($file_name,'.'),1);
}











