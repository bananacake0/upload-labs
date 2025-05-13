$is_upload = false;
$msg = null;

if(isset($_POST['submit'])){
    $ext_arr = array('jpg', 'png', 'gif');  // Allowed file extensions
    $file_name = $_FILES['upload_file']['name'];
    $temp_file = $_FILES['upload_file']['tmp_name'];
    $file_ext = substr($file_name, strrpos($file_name, ".") + 1);  // Extract the file extension
    $upload_file = UPLOAD_PATH . '/' . $file_name;

    if(move_uploaded_file($temp_file, $upload_file)){  // Move the uploaded file
        if(in_array($file_ext, $ext_arr)){  // Check if the file extension is allowed
             $img_path = UPLOAD_PATH . '/' . rand(10, 99) . date("YmdHis") . "." . $file_ext;
             rename($upload_file, $img_path);  // Rename the file
             $is_upload = true;
        }else{
            $msg = "Only .jpg, .png, .gif file types are allowed!";
            unlink($upload_file);  // Delete the file if not allowed
        }
    }else{
        $msg = 'Error during upload!';
    }
}
