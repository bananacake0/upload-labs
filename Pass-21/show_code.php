<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">$is_upload = false;
$msg = null;
if(!empty($_FILES['upload_file'])){
    // Check MIME type
    $allow_type = array('image/jpeg','image/png','image/gif');
    if(!in_array($_FILES['upload_file']['type'],$allow_type)){
        $msg = "Uploading this file type is not allowed!";
    }else{
        // Check filename
        $file = empty($_POST['save_name']) ? $_FILES['upload_file']['name'] : $_POST['save_name'];
        if (!is_array($file)) {
            $file = explode('.', strtolower($file));
        }

        $ext = end($file);
        $allow_suffix = array('jpg','png','gif');
        if (!in_array($ext, $allow_suffix)) {
            $msg = "Uploading this file extension is not allowed!";
        }else{
            $file_name = reset($file) . '.' . $file[count($file) - 1];
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH . '/' .$file_name;
            if (move_uploaded_file($temp_file, $img_path)) {
                $msg = "File uploaded successfully!";
                $is_upload = true;
            } else {
                $msg = "File upload failed!";
            }
        }
    }
}else{
    $msg = "Please select a file to upload!";
}
</code>
</pre>
</li>
