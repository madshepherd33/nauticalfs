<?php
$directory = 'c:/xampp/htdocs/public_html/img/our_work/electric';
$files = glob($directory . '/*.{jpg,jpeg,JPG,JPEG}', GLOB_BRACE);

if ($files === false) {
    echo "Failed to glob files\n";
    exit(1);
}

// Sort files to have a consistent order
sort($files);

$index = 1;
foreach ($files as $file) {
    if (!file_exists($file))
        continue;

    $info = getimagesize($file);
    if ($info === false)
        continue;

    $image = @imagecreatefromjpeg($file);
    if (!$image) {
        echo "Failed to load $file\n";
        continue;
    }

    $new_filename = $directory . '/electric' . $index . '.webp';

    // Convert and save
    if (imagewebp($image, $new_filename, 80)) {
        echo "Converted " . basename($file) . " to electric$index.webp\n";
        unlink($file); // Remove original
        $index++;
    } else {
        echo "Failed to convert " . basename($file) . "\n";
    }

    imagedestroy($image);
}
echo "Conversion complete.\n";
?>