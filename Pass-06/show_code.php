<?php
include '../config.php';
include '../common.php';
include '../head.php';
include '../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $deny_ext = array(".php", ".php5", ".php4", ".php3", ".php2", ".html", ".htm", ".phtml", ".pht", ".pHp", ".pHp5", ".pHp4", ".pHp3", ".pHp2", ".Html", ".Htm", ".pHtml", ".jsp", ".jspa", ".jspx", ".jsw", ".jsv", ".jspf", ".jtml", ".jSp", ".jSpx", ".jSpa", ".jSw", ".jSv", ".jSpf", ".jHtml", ".asp", ".aspx", ".asa", ".asax", ".ascx", ".ashx", ".asmx", ".cer", ".aSp", ".aSpx", ".aSa", ".aSax", ".aScx", ".aShx", ".aSmx", ".cEr", ".sWf", ".swf", ".htaccess", ".ini");
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name); // Remove trailing dots from the filename
        $file_ext = strrchr($file_name, '.');
        $file_ext = str_ireplace('::$DATA', '', $file_ext); // Remove any unwanted strings like '::$DATA'
        $file_ext = trim($file_ext); // Trim spaces from the file extension

        if (!in_array($file_ext, $deny_ext)) {
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH . '/' . date("YmdHis") . rand(1000, 9999) . $file_ext;
            if (move_uploaded_file($temp_file, $img_path)) {
                $is_upload = true;
            } else {
                $msg = 'Upload error!'; // Error message if upload fails
            }
        } else {
            $msg = 'This file type is not allowed for upload!'; // Error message for restricted file types
        }
    } else {
        $msg = UPLOAD_PATH . ' directory does not exist. Please create it manually!'; // Error message if the upload directory does not exist
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
            <form enctype="multipart/form-data" method="post" onsubmit="return checkFile()">
                <p>Please select an image to upload:</p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="Upload"/>
            </form>
            <div id="msg">
                <?php
                    if ($msg != null) {
                        echo "Tip: " . $msg;
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
