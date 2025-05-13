<?php
include '../config.php';
include '../head.php';
include '../menu.php';

function isImage($filename){
    $types = '.jpeg|.png|.gif';
    if(file_exists($filename)){
        $info = getimagesize($filename);
        $ext = image_type_to_extension($info[2]);
        if(stripos($types,$ext)>=0){
            return $ext;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

$is_upload = false;
$msg = null;
if(isset($_POST['submit'])){
    $temp_file = $_FILES['upload_file']['tmp_name'];
    $res = isImage($temp_file);
    if(!$res){
        $msg = "Unknown file, upload failed!";
    }else{
        $img_path = UPLOAD_PATH."/".rand(10, 99).date("YmdHis").$res;
        if(move_uploaded_file($temp_file,$img_path)){
            $is_upload = true;
        } else {
            $msg = "Upload error!";
        }
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Task</h3>
            <p>Upload a <code>web shell</code> to the server.</p>
            <p>Note:</p>
            <p>1. Ensure the uploaded web shell still contains a complete <code>shell</code> or <code>webshell</code> code.</p>
            <p>2. Use a <a href="<?php echo INC_VUL_PATH;?>" target="_blank">file inclusion vulnerability</a> to execute the malicious code within the web shell.</p>
            <p>3. The web shell must successfully upload with the <code>.jpg</code>, <code>.png</code>, or <code>.gif</code> extensions to pass!</p>
        </li>
        <li>
            <h3>Upload Area</h3>
            <form enctype="multipart/form-data" method="post">
                <p>Please select the image to upload:</p>
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
