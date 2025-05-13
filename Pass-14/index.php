<?php
include '../config.php';
include '../head.php';
include '../menu.php';

function getRealFileType($filename){
    $file = fopen($filename, "rb");
    $bin = fread($file, 2); // Only read the first 2 bytes
    fclose($file);
    $strInfo = @unpack("C2chars", $bin);
    $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
    $fileType = '';
    switch($typeCode){
        case 255216:
            $fileType = 'jpg';
            break;
        case 13780:
            $fileType = 'png';
            break;
        case 7173:
            $fileType = 'gif';
            break;
        default:
            $fileType = 'unknown';
    }
    return $fileType;
}

$is_upload = false;
$msg = null;
if(isset($_POST['submit'])){
    $temp_file = $_FILES['upload_file']['tmp_name'];
    $file_type = getRealFileType($temp_file);

    if($file_type == 'unknown'){
        $msg = "File is unknown, upload failed!";
    }else{
        $img_path = UPLOAD_PATH."/".rand(10, 99).date("YmdHis").".".$file_type;
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
            <p>Upload <code>Image Shell</code> to the server.</p>
            <p>Note:</p>
            <p>1. Ensure that the uploaded image shell still contains complete <code>One-liner</code> or <code>webshell</code> code.</p>
            <p>2. Use the <a href="<?php echo INC_VUL_PATH;?>" target="_blank">file inclusion vulnerability</a> to execute the malicious code in the image shell.</p>
            <p>3. The image shell must successfully upload with extensions <code>.jpg</code>, <code>.png</code>, and <code>.gif</code> to pass!</p>
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
                    if($msg != null){
                        echo "Message: ".$msg;
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
