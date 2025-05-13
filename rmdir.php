<?php
// Function to recursively delete directories and files
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");

function del_dir($dir) {
    $n_success = 0;
    $n_fail = 0;

    if ($handle = opendir("$dir")) {
        while (false !== ($item = readdir($handle))) {
            if ($item != "." && $item != "..") {
                if (is_dir("$dir/$item")) {
                    del_dir("$dir/$item");  // Recursively delete subdirectories
                } else {
                    if (unlink("$dir/$item")) {
                        $n_success++; // File deleted successfully
                    } else {
                        $n_fail++;    // File deletion failed
                    }
                }
            }
        }
        closedir($handle);

        if (rmdir($dir)) {
            $n_success++; // Directory deleted successfully
        } else {
            $n_fail++;    // Directory deletion failed
        }

        return 'Deleted successfully: ' . $n_success . ', Failed deletions: ' . $n_fail . '!';
    }
}

// Function to create upload/readme.php file with warning message
function touch_upload_readme() {
    $filepath = './upload/readme.php';
    file_put_contents($filepath, "<?php echo \"This directory is used to store uploaded files. This file is a system note—do not delete!\";?>");
}

// If the action is 'clean_upload_file', delete upload directory and recreate it
if ($_GET['action'] == 'clean_upload_file') {
    echo del_dir("upload");
    // Recreate upload directory and readme.php file
    sleep(0.5);
    mkdir("upload");
    touch_upload_readme();
}
?>
