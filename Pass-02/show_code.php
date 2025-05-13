<li id="show_code">
    <h3>代码</h3>
<pre>
<code class="line-numbers language-php">$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        // Check if the uploaded file is an image of type jpeg, png, or gif
        if (($_FILES['upload_file']['type'] == 'image/jpeg') || ($_FILES['upload_file']['type'] == 'image/png') || ($_FILES['upload_file']['type'] == 'image/gif')) {
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH . '/' . $_FILES['upload_file']['name'];  // Corrected missing semicolon here
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($temp_file, $img_path)) {
                $is_upload = true;
            } else {
                $msg = 'Error during upload!';
            }
        } else {
            $msg = 'Invalid file type, please upload again!';
        }
    } else {
        $msg = UPLOAD_PATH . ' folder does not exist, please create it manually!';
    }
}
