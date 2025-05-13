<li id="show_code">
    <h3>Code</h3>
<pre>
<code class="line-numbers language-javascript">function checkFile() {
    var file = document.getElementsByName('upload_file')[0].value;
    if (file == null || file == "") {
        alert("Please select a file to upload!");
        return false;
    }
    // Define allowed file types for upload
    var allow_ext = ".jpg|.png|.gif";
    // Extract the file extension from the uploaded file
    var ext_name = file.substring(file.lastIndexOf("."));
    // Check if the file type is allowed for upload
    if (allow_ext.indexOf(ext_name + "|") == -1) {
        var errMsg = "This file type is not allowed. Please upload a file of type " + allow_ext + ". The current file type is: " + ext_name;
        alert(errMsg);
        return false;
    }
}
</code>
</pre>
</li>
