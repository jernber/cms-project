<?php
    include 'ImageResize.php';

    // file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        $mime_type_is_pdf        = in_array(mime_content_type($temporary_path), $allowed_mime_types);
        
        if ($mime_type_is_pdf){
            $mime_type_is_valid = true;
        }
        return $file_extension_is_valid && $mime_type_is_valid;
    }
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

    if ($image_upload_detected) { 
        $image_filename        = $_FILES['image']['name'];
        $temporary_image_path  = $_FILES['image']['tmp_name'];
        $new_image_path        = file_upload_path($image_filename);
        if (file_is_an_image($temporary_image_path, $new_image_path)) {
            move_uploaded_file($temporary_image_path, $new_image_path);
            $ext = pathinfo($image_filename, PATHINFO_EXTENSION);
            
            if($ext != 'pdf'){
            resizer($image_filename);
            }
        }
    }

    function resizer($image){
        $image_med = new \Gumlet\ImageResize('uploads'. DIRECTORY_SEPARATOR .$image);
        $image_med->resizeToWidth(400);
        $image_med->save('uploads/medium' . $image);
        
        $image_thumb = new \Gumlet\ImageResize('uploads'. DIRECTORY_SEPARATOR .$image);
        $image_thumb->resizeToWidth(50);
        $image_thumb->save('uploads/thumbnail' . $image);
    }
?>