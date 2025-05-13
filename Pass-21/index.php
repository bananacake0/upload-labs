<?php
include '../config.php';
include '../common.php';
include '../head.php';
include '../menu.php';

if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {

        $is_upload = false;
        $msg = null;
        if(!empty($_FILES['upload_file'])){
            // MIME type check
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

    } else {
        $msg = UPLOAD_PATH . ' folder does not exist, please create it manually!';
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
                <p>Please select the image to upload:</p>
                <input class="input_file" type="file" name="upload_file"/>
                <p>Save as:</p>
                <input class="input_text" type="text" name="save_name" value="upload-20.jpg" /><br/>
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
