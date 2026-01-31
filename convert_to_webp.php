<?php
/**
 * Improved WebP conversion script that respects EXIF orientation
 */

function convertToWebp($dir)
{
    if (!is_dir($dir))
        return;

    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..')
            continue;

        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            convertToWebp($path);
            continue;
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'jp'])) {
            $webpPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME) . '.webp';

            if (file_exists($webpPath)) {
                echo "Skipping $path (WebP already exists)\n";
                // Even if webp exists, we should delete the source if it's there
                unlink($path);
                continue;
            }

            echo "Converting $path to WebP...";

            $image = null;
            if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'jp') {
                $image = @imagecreatefromjpeg($path);

                // Handle EXIF orientation
                try {
                    $exif = @exif_read_data($path);
                    if ($image && $exif && !empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 3:
                                $image = imagerotate($image, 180, 0);
                                break;
                            case 6:
                                $image = imagerotate($image, -90, 0);
                                break;
                            case 8:
                                $image = imagerotate($image, 90, 0);
                                break;
                        }
                    }
                } catch (Exception $e) {
                    // Ignore exif errors
                }

            } elseif ($extension === 'png') {
                $image = @imagecreatefrompng($path);
                if ($image) {
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                }
            }

            if ($image) {
                if (imagewebp($image, $webpPath, 80)) {
                    echo " OK\n";
                    unlink($path);
                } else {
                    echo " FAILED\n";
                }
                imagedestroy($image);
            } else {
                echo " FAILED (Could not create image resource)\n";
            }
        }
    }
}

echo "Starting conversion...\n";
convertToWebp('img/our_work');
convertToWebp('img/conv');
echo "Conversion complete!\n";
