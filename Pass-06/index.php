<?php
include '../config.php';  // Includes configuration file
include '../common.php';  // Includes common functions
include '../head.php';    // Includes the header
include '../menu.php';    // Includes the menu

$is_upload = false;  // Flag for successful upload
$msg = null;         // Message to display errors or status

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Check if the upload directory exists
    if (file_exists(UPLOAD_PATH)) {
        // Deny extensions array: list of file extensions not allowed
        $deny_ext = array(".php",".php5",".php4",".php3",".php2",".html",".htm",".phtml",".pht",".pHp",".pHp5",".pHp4",".pHp3",".pHp2",".Html",".Htm",".pHtml",".jsp",".jspa",".jspx",".jsw",".jsv",".jspf",".jtml",".jSp",".jSpx",".jSpa",".jSw",".jSv",".jSpf",".jHtml",".asp",".aspx",".asa",".asax",".ascx",".ashx",".asmx",".cer",".aSp",".aSpx",".aSa",".aSax",".aScx",".aShx",".aSmx",".cEr",".sWf",".swf",".htaccess",".ini");

        // Clean up file name and extract the extension
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name); // Remove any trailing dots in the file name
        $file_ext = strrchr($file_name, '.');
        $file_ext = str_ireplace('::$DATA', '', $file_ext); // Remove any unwanted data in file extension
        $file_ext = trim($file_ext); // Remove spaces

        // Check if the file extension is in the deny list
        if (!in_array($file_ext, $deny_ext)) {
            // Set the path for storing the uploaded file
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH . '/' . date("YmdHis") . rand(1000, 9999) . $file_ext;

            // Try moving the uploaded file to the destination folder
            if (move_uploaded_file($temp_file, $img_path)) {
                $is_upload = true; // Set the upload flag to true on success
            } else {
                $msg = '上传出错！'; // Display error message
            }
        } else {
            $msg = '此文件类型不允许上传！'; // Display restricted file type message
        }
    } else {
        $msg = UPLOAD_PATH . '文件夹不存在,请手工创建！'; // Display error if the upload folder doesn't exist
    }
}
?>

<!-- HTML Section -->
<div id="upload_panel">
    <ol>
        <li>
            <h3>任务</h3>
            <p>上传一个<code>webshell</code>到服务器。</p>
        </li>
        <li>
            <h3>上传区</h3>
            <form enctype="multipart/form-data" method="post" onsubmit="return checkFile()">
                <p>请选择要上传的图片：<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="上传"/>
            </form>
            <div id="msg">
                <?php
                    if($msg != null){
                        echo "提示：".$msg;  // Display message (error or success)
                    }
                ?>
            </div>
            <div id="img">
                <?php
                    if($is_upload){
                        echo '<img src="'.$img_path.'" width="250px" />';  // Display image preview on successful upload
                    }
                ?>
            </div>
        </li>
        <?php
            if($_GET['action'] == "show_code"){
                include 'show_code.php';  // Include code if requested
            }
        ?>
    </ol>
</div>

<?php
include '../footer.php';  // Include footer
?>
