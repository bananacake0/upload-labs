<li id="show_code">
    <h3>代码</h3>
<pre>
<code class="line-numbers language-php">$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $deny_ext = array(".php", ".php5", ".php4", ".php3", ".php2", ".php1", ".html", ".htm", ".phtml", ".pht", ".pHp", ".pHp5", ".pHp4", ".pHp3", ".pHp2", ".pHp1", ".Html", ".Htm", ".pHtml", ".jsp", ".jspa", ".jspx", ".jsw", ".jsv", ".jspf", ".jtml", ".jSp", ".jSpx", ".jSpa", ".jSw", ".jSv", ".jSpf", ".jHtml", ".asp", ".aspx", ".asa", ".asax", ".ascx", ".ashx", ".asmx", ".cer", ".aSp", ".aSpx", ".aSa", ".aSax", ".aScx", ".aShx", ".aSmx", ".cEr", ".sWf", ".swf", ".ini");
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name); // Remove trailing dot from filename
        $file_ext = strrchr($file_name, '.');
        $file_ext = strtolower($file_ext); // Convert to lowercase
        $file_ext = str_ireplace('::$DATA', '', $file_ext); // Remove string '::$DATA'
        $file_ext = trim($file_ext); // Remove leading and trailing whitespace

        if (!in_array($file_ext, $deny_ext)) {
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH . '/' . $file_name;
            if (move_uploaded_file($temp_file, $img_path)) {
                $is_upload = true;
            } else {
                $msg = 'Upload error!';
            }
        } else {
            $msg = 'This file type is not allowed to be uploaded!';
        }
    } else {
        $msg = UPLOAD_PATH . ' directory does not exist, please create it manually!';
    }
}
