<?php
require_once 'header.php';

$data = [
    'show' => false,
    'file_size' => '',
    'file_name' => '',
    'file_locatin' => '',
    'error' => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES)) {
        // appy file to variable
        $file = $_FILES['filetoupload'];
        // convert file size to KB
        $file_size = floor($file['size'] / 1024);

        // manage where to store the file
        $target_dir = 'uploads\\';
        $target_file = $target_dir . basename($file['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // check if file already exists
        if (file_exists($target_file)) {
            $data['error'] = 'sorry the file already exists.<br>';
        } else {
            if (!file_exists($target_dir)) {
                mkdir($target_dir);
            }
        }

        // check file size 
        if ($file_size > 500) {
            $data['error'] .= 'the file is too big.<br>';
        }

        // manage file formats
        $valid_formats = ['png', 'jpg', 'jpeg', 'gif'];
        if (!in_array($file_type, $valid_formats)) {
            $data['error'] .= 'file format is not valid.';
        }

        // if everything is ok try to upload the file
        if ($data['error'] === '') {
            $result = move_uploaded_file($file['tmp_name'], $target_file);
            if ($result) {
                $data['file_name'] = basename($file['name']);
                $data['file_size'] = $file_size . 'KB';
                $data['file_location'] = str_replace('\\', '/', $target_file);
                $data['show'] = true;
            }
        }
    }
}
?>
<!doctype html>
<html lang='en'>

<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content=width=device-width, initial-scale=1,shrink-to-fit=no'>
    <title>Upload Example</title>
</head>

<body>
    <header>
        <h1>Simple File Uploading</h1>
        <h2>Track your files easily</h2>
    </header>
    <main>
        <section>
            <?php if ($data['error'] !== '') : ?>
                <div style="padding:10px;background-color:lightcoral;color:#f1f2f3;margin:1rem;">
                    <?php echo $data['error']; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
                <input type="file" name="filetoupload">
                <input type="submit" value="Ok">
            </form>
        </section>
        <?php if ($data['show']) : ?>
            <section style="margin-top:2rem;">
                <div>
                    <div>
                        <img src="<?php echo $data['file_location'] ?>" alt="picture">
                    </div>
                    <div>
                        <label for="filename">Name : </label>
                        <input type="text" readonly value="<?php echo $data['file_name']; ?>" id="filename">
                    </div>
                    <div>
                        <label for="filesize">Size : </label>
                        <input type="text" readonly value="<?php echo $data['file_size']; ?>" id="filesize">
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>
</body>

</html>