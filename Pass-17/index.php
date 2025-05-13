<?php
include '../config.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;

if (isset($_POST['submit'])) {
    // Get the basic info of the uploaded file: name, type, temporary file path
    $filename = $_FILES['upload_file']['name'];
    $filetype = $_FILES['upload_file']['type'];
    $tmpname = $_FILES['upload_file']['tmp_name'];

    $target_path = UPLOAD_PATH . '/' . basename($filename);

    // Get the extension of the uploaded file
    $fileext = substr(strrchr($filename, "."), 1);

    // Check if the file extension and MIME type are valid before proceeding
    if (($fileext == "jpg") && ($filetype == "image/jpeg")) {
        if (move_uploaded_file($tmpname, $target_path)) {
            // Use the uploaded image to generate a new image
            $im = imagecreatefromjpeg($target_path);

            if ($im == false) {
                $msg = "This file is not a valid JPG image!";
                @unlink($target_path);
            } else {
                // Give the new image a new filename
                srand(time());
                $newfilename = strval(rand()) . ".jpg";
                // Display the re-rendered image (generated from the uploaded one)
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
            // Use the uploaded image to generate a new image
            $im = imagecreatefrompng($target_path);

            if ($im == false) {
                $msg = "This file is not a valid PNG image!";
                @unlink($target_path);
            } else {
                // Give the new image a new filename
                srand(time());
                $newfilename = strval(rand()) . ".png";
                // Display the re-rendered image (generated from the uploaded one)
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
            // Use the uploaded image to generate a new image
            $im = imagecreatefromgif($target_path);
            if ($im == false) {
                $msg = "This file is not a valid GIF image!";
                @unlink($target_path);
            } else {
                // Give the new image a new filename
                srand(time());
                $newfilename = strval(rand()) . ".gif";
                // Display the re-rendered image (generated from the uploaded one)
                $img_path = UPLOAD_PATH . '/' . $newfilename;
                imagegif($im, $img_path);

                @unlink($target_path);
                $is_upload = true;
            }
        } else {
            $msg = "Upload error!";
        }
    } else {
        $msg = "Only image files with .jpg, .png, or .gif extensions are allowed!";
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Task</h3>
            <p>Upload a <code>trojan image</code> to the server.</p>
            <p>Note:</p>
            <p>1. Ensure the uploaded trojan image still contains a complete <code>one-liner</code> or <code>webshell</code> code.</p>
            <p>2. Use a <a href="<?php echo INC_VUL_PATH;?>" target="_bank">file inclusion vulnerability</a> to execute the malicious code inside the trojan image.</p>
            <p>3. You must successfully upload trojan images with all three extensions: <code>.jpg</code>, <code>.png</code>, and <code>.gif</code> to pass!</p>
        </li>
        <li>
            <h3>Upload Area</h3>
            <form enctype="multipart/form-data" method="post">
                <p>Please select an image to upload:</p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="Upload"/>
            </form>
            <div id="msg">
                <?php
                    if ($msg != null) {
                        echo "Notice: " . $msg;
                    }
                ?>
            </div>
            <div id="img">
                <?php
                    if ($is_upload) {
                        echo '<img src="' . $img_path . '" width="250px" />';
                    }
                ?>
            </div>
        </li>
        <?php
            if ($_GET['action'] == "show_code") {
                include 'show_code.php';
            }
        ?>
    </ol>
</div>

<?php
include '../footer.php';
?>
