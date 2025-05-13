<?php
include '../config.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit']))
{
    require_once("./myupload.php");
    $imgFileName =time();
    $u = new MyUpload($_FILES['upload_file']['name'], $_FILES['upload_file']['tmp_name'], $_FILES['upload_file']['size'],$imgFileName);
    $status_code = $u->upload(UPLOAD_PATH);
    switch ($status_code) {
        case 1:
            $is_upload = true;
            $img_path = $u->cls_upload_dir . $u->cls_file_rename_to;
            break;
        case 2:
            $msg = 'The file has been uploaded but was not renamed.';
            break;
        case -1:
            $msg = 'This file cannot be uploaded to the server\'s temporary file storage directory.';
            break;
        case -2:
            $msg = 'Upload failed, upload directory is not writable.';
            break;
        case -3:
            $msg = 'Upload failed, this file type cannot be uploaded.';
            break;
        case -4:
            $msg = 'Upload failed, the uploaded file is too large.';
            break;
        case -5:
            $msg = 'Upload failed, a file with the same name already exists on the server.';
            break;
        case -6:
            $msg = 'File cannot be uploaded, the file could not be copied to the target directory.';
            break;
        default:
            $msg = 'Unknown error!';
            break;
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Task</h3>
            <p>Upload a <code>webshell</code> to the server.</p>
        </li>
        <li>
            <h3>Upload Area</h3>
            <form enctype="multipart/form-data" method="post">
                <p>Please choose the image to upload:</p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="Upload"/>
            </form>
            <div id="msg">
                <?php
                    if($msg != null){
                        echo "Tip: ".$msg;
                    }
                ?>
            </div>
            <div id="img">
                <?php
                    if($is_upload){
                        echo '<img src="'.$img_path.'" width="250px" />';
                    }
                ?>
            </div>
        </li>
        <?php
            if($_GET['action'] == "show_code"){
                include 'show_code.php';
            }
        ?>
    </ol>
</div>

<?php
include '../footer.php';
?>
