<?php
include 'config.php';
include 'head.php';
include 'menu.php';
?>
<style type="text/css">
#head_menu a{
	display: none;
}
</style>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Introduction</h3>
            <p><code>upload-labs</code> is a platform written in <code>php</code> language, specifically designed to collect various file upload vulnerabilities encountered in penetration testing and CTF challenges. Its purpose is to help everyone gain a comprehensive understanding of upload vulnerabilities. Currently, there are 21 levels, each containing a different upload method.</p>
        </li>
        <li>
            <h3>Notes</h3>
            <p>1. There is no fixed solution for each level, so don't limit your thinking!</p>
            <p>2. The <code>writeup</code> provided by this project is only for reference. We hope everyone can share their own approach to solving the challenges.</p>
            <p>3. If you're really stuck, you can click on <code>View Hint</code>.</p>
            <p>4. If you're working with a black-box scenario and can't solve it, you can click on <code>View Source Code</code>.</p>
        </li>
        <li>
            <h3>Future Updates</h3>
            <p>If new upload vulnerability types are encountered in penetration testing practice, they will be updated in <code>upload-labs</code>. Of course, if you also wish to participate in this work, feel free to submit <code>pull requests</code> to me!</p>
            <p>Project URL: <code>https://github.com/c0ny1/upload-labs</code></p>
        </li>
	</ol>
</div>

<?php
include 'footer.php'
?>
