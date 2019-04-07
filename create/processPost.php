<?php 
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    include 'ImageResize.php';
    session_start();
  
    
    if($_POST){
        
        $Title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Content = filter_input(INPUT_POST, 'details', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $UserID = $_SESSION['user_id'];
        $HeroID = $_POST['heroes'];

        if(strlen($Title) < 0 OR (strlen($Description) < 0 OR strlen($Description > 280)) OR strlen($Content) < 0 OR $_POST['heroes'] < 0){
            echo "error processing post!";
        } else {

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
            }
        }
        
        if(isset($upload_error_detected)){

        } else {
            if (isset($image_upload_detected)){
                $query = "INSERT INTO cms_userbuilds (HeroID, UserID, Title, Description, Content, BuildImage) VALUES (:HeroID, :UserID, :Title, :Description, :Content, :BuildImage)";         
                $statement = $db->prepare($query);
    
                $statement->bindValue(":HeroID", $HeroID);
                $statement->bindValue(":UserID", $UserID);
                $statement->bindValue(":Title", $Title);
                $statement->bindValue(":Description", $Description);
                $statement->bindValue(":Content", $Content);
                $statement->bindValue(":BuildImage", $image_filename);
                $statement->execute();
                header('location:..\index.php');
            }
            if (!isset($new_image_path)){
                $query = "INSERT INTO cms_userbuilds (HeroID, UserID, Title, Description, Content) VALUES (:HeroID, :UserID, :Title, :Description, :Content)";         
                $statement = $db->prepare($query);
                $statement->bindValue(":HeroID", $HeroID);
                $statement->bindValue(":UserID", $UserID);
                $statement->bindValue(":Title", $Title);
                $statement->bindValue(":Description", $Description);
                $statement->bindValue(":Content", $Content);
                $statement->execute();
                header('location:..\index.php');
            }
        }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error processing image</title>
</head>
<body>
    <p>Error when processing build! Error Number: <?= $_FILES['image']['error'] ?></p>
</body>
</html>