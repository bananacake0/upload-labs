<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-php">$is_upload = false;
$msg = null;
if (isset($_POST['submit'])){
    // Get uploaded file basic information: name, type, size, and temporary file path
    $filename = $_FILES['upload_file']['name'];
    $filetype = $_FILES['upload_file']['type'];
    $tmpname = $_FILES['upload_file']['tmp_name'];

    $target_path = UPLOAD_PATH . '/' . basename($filename);

    // Get file extension
    $fileext = substr(strrchr($filename,"."),1);

    // Check if the extension and type are valid before uploading
    if (($fileext == "jpg") && ($filetype == "image/jpeg")) {
        if (move_uploaded_file($tmpname, $target_path)) {
            // Generate a new image from the uploaded image
            $im = imagecreatefromjpeg($target_path);

            if ($im == false) {
                $msg = "This file is not a valid JPG image!";
                @unlink($target_path);
            } else {
                // Assign a filename to the new image
                srand(time());
                $newfilename = strval(rand()) . ".jpg";
                // Display the re-rendered image (created from the uploaded one)
                $img_path = UPLOAD_PATH . '/' . $newfilename;
                imagejpeg($im, $img_path);
                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload error!";
        }

    } else if (($fileext == "png") && ($filetype == "image/png")) {
        if (move_uploaded_file($tmpname, $target_path)) {
            // Generate a new image from the uploaded image
            $im = imagecreatefrompng($target_path);

            if ($im == false) {
                $msg = "This file is not a valid PNG image!";
                @unlink($target_path);
            } else {
                // Assign a filename to the new image
                srand(time());
                $newfilename = strval(rand()) . ".png";
                // Display the re-rendered image (created from the uploaded one)
                $img_path = UPLOAD_PATH . '/' . $newfilename;
                imagepng($im, $img_path);

                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload error!";
        }

    } else if (($fileext == "gif") && ($filetype == "image/gif")) {
        if (move_uploaded_file($tmpname, $target_path)) {
            // Generate a new image from the uploaded image
            $im = imagecreatefromgif($target_path);
            if ($im == false) {
                $msg = "This file is not a valid GIF image!";
                @unlink($target_path);
            } else {
                // Assign a filename to the new image
                srand(time());
                $newfilename = strval(rand()) . ".gif";
                // Display the re-rendered image (created from the uploaded one)
                $img_path = UPLOAD_PATH . '/' . $newfilename;
                imagegif($im, $img_path);

                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload error!";
        }
    } else {
        $msg = "Only image files with .jpg|.png|.gif extensions are allowed!";
    }
}
</code>
</pre>
</li>
