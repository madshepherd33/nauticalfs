<?php
// 1. BASIT GERİ DÖNÜŞ FORMU (Sadece Email)
$form_message = '';
$form_message_type = '';

if (isset($_POST['submit_callback'])) {
    $to = "info@nauticalfs.com";
    $email = filter_var(trim($_POST['callback_email']), FILTER_SANITIZE_EMAIL);

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Sanitize email for headers to prevent header injection
        $email_safe = filter_var($email, FILTER_SANITIZE_EMAIL);

        $subject = "Callback Request: " . $email_safe;
        $headers = "From: " . $email_safe . "\r\n";
        $headers .= "Reply-To: " . $email_safe . "\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

        $body = "New callback request received.\n\n";
        $body .= "Potential Client Email: " . $email_safe . "\n";
        $body .= "Please contact them as soon as possible.";

        if (mail($to, $subject, $body, $headers)) {
            $form_message = 'Thank you! We will contact you shortly.';
            $form_message_type = 'success';
            // Clear form after successful submission
            $_POST['callback_email'] = '';
        } else {
            $form_message = 'Error: Could not send request. Please try again or contact us directly.';
            $form_message_type = 'error';
        }
    } else {
        $form_message = 'Please enter a valid email address.';
        $form_message_type = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="custom/eventually/assets/css/main.css" />
</head>

<body>

    <div class="main-page-wrapper">
        <div class="hero-section" style="width: 100%; background: #f8f9fa; padding: 0; position: relative; z-index: 1;">
            <div class="video-container"
                style="max-width: 1200px; height: 30vh; min-height: 550px; margin: 0 auto; position: relative; overflow: hidden; border-radius: 8px;">
                <video loop autoplay muted playsinline
                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 100%; width: 100%; min-width: 100%; object-fit: cover;">
                    <source src="./videos/mainvideo.mp4" type="video/mp4">
                </video>
                <div
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.25); pointer-events: none;">
                </div>
                <div
                    style="position: absolute; bottom: 60px; left: 60px; z-index: 5; max-width: 600px; text-align: left;">
                    <h1
                        style="color: #ffffff; font-size: 2.4rem; font-weight: 300; margin-bottom: 25px; line-height: 1.3; letter-spacing: 1px; text-shadow: 2px 2px 15px rgba(0,0,0,0.8);">
                        Your partner in <br>
                        <span style="font-weight: 700; border-bottom: 2px solid #fff;">Repair & Maintenance</span>
                    </h1>
                    <a href="./index.php?f=our_work" class="btn-hero-modern"
                        aria-label="Explore our work and projects">Explore Our Work</a>
                </div>
                <div style="position: absolute; bottom: 60px; right: 60px; z-index: 5; text-align: right;">
                    <a href="https://www.linkedin.com/company/nautical-fix-solutions-inc" target="_blank"
                        rel="noopener noreferrer" aria-label="Visit our LinkedIn page" style="display: inline-flex; align-items: center; justify-content: center; width: 50px; height: 50px; 
                              background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); 
                              border: 2px solid rgba(255, 255, 255, 0.8); border-radius: 50%; 
                              transition: all 0.3s ease; text-decoration: none;">
                        <i class="fab fa-linkedin-in" style="color: #ffffff; font-size: 24px;" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="gray-wrapper" style="background: #f8f9fa; padding: 0; margin: 0;">
            <section class="about-section clearfix" style="padding: 60px 0; position: relative; background: #fff;">
                <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                    <div style="display: flex; align-items: center; gap: 60px; flex-wrap: wrap;">
                        <!-- Image Side -->
                        <div style="flex: 1; min-width: 300px;">
                            <div class="img-hover-container"
                                style="border-radius: 8px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                                <img src="./img/mainabout.jpg"
                                    alt="Nautical Fix Solutions - Maritime excellence and ship maintenance services"
                                    loading="lazy"
                                    style="width: 100%; height: auto; display: block; transition: transform 0.6s ease; filter: contrast(115%) brightness(90%) saturate(110%);">
                            </div>
                        </div>

                        <!-- Text Side -->
                        <div style="flex: 1.2; min-width: 300px;">
                            <h2
                                style="font-size: 2.2rem; color: #000; font-weight: 800; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 2px; position: relative; padding-bottom: 15px;">
                                PIONEERING MARITIME EXCELLENCE
                                <div
                                    style="position: absolute; bottom: 0; left: 0; width: 60px; height: 3px; background: #000;">
                                </div>
                            </h2>

                            <p style="color: #333; font-size: 1.1rem; line-height: 1.8; margin-bottom: 30px;">
                                Founded in 2023 in Yalova's maritime hub, <strong>Nautical Fix
                                    Solutions</strong> was born from a vision to redefine ship maintenance. We combine
                                high-level technical expertise with global standards to ensure your fleet remains
                                operational and efficient.
                            </p>

                            <div
                                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-top: 30px;">
                                <div>
                                    <h3
                                        style="font-size: 1.25rem; color: #000; font-weight: 700; margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                        <i class="fas fa-eye" style="font-size: 1rem;"></i> OUR VISION
                                    </h3>
                                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">
                                        We envision a maritime industry that is safer, more efficient, and
                                        environmentally responsible.
                                    </p>
                                </div>
                                <div>
                                    <h3
                                        style="font-size: 1.25rem; color: #000; font-weight: 700; margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                        <i class="fas fa-bullseye" style="font-size: 1rem;"></i> OUR MISSION
                                    </h3>
                                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">
                                        To provide exceptional technical services that empower our clients to navigate
                                        the seas with absolute confidence.
                                    </p>
                                </div>
                            </div>

                            <div style="margin-top: 40px;">
                                <a href="./index.php?f=company_profile" class="custom-btn-black"
                                    aria-label="View our full company profile">View Full Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Conversion Project Slider Section -->
            <section id="conversion-section"
                style="padding: 30px 0; background: #fff; position: relative; overflow: hidden;">
                <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                    <div style="text-align: center; margin-bottom: 25px;">
                        <h2
                            style="font-size: 2rem; color: #000; font-weight: 700; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 2px;">
                            Experience our transformation excellence.</h2>
                        <div style="width: 80px; height: 3px; background: #000; margin: 0 auto;"></div>
                    </div>

                    <?php
                    // Scan img/conv for before/after pairs
                    $conv_folder = 'img/conv';
                    $slider_pairs = [];

                    if (is_dir($conv_folder)) {
                        $files = glob($conv_folder . '/*.{jpg,jpeg,png,JPG,JPEG,PNG,webp,WEBP}', GLOB_BRACE);
                        foreach ($files as $file) {
                            $filename = basename($file);
                            // Check if it follows 'number[before|after].ext' pattern
                            if (preg_match('/^(\d+)(before|after)\./i', $filename, $matches)) {
                                $num = $matches[1];
                                $type = strtolower($matches[2]);
                                $slider_pairs[$num][$type] = $file;
                            }
                        }
                        // Sort pairs by number
                        ksort($slider_pairs);
                    }

                    // Check if we have any valid pairs
                    $has_valid_pairs = false;
                    foreach ($slider_pairs as $pair) {
                        if (isset($pair['before']) && isset($pair['after'])) {
                            $has_valid_pairs = true;
                            break;
                        }
                    }
                    ?>

                    <?php if ($has_valid_pairs): ?>
                        <div id="comparison-carousel" class="owl-carousel owl-theme" role="region"
                            aria-label="Before and after project transformations">
                            <?php
                            foreach ($slider_pairs as $num => $pair):
                                // Only display if we have both before and after
                                if (isset($pair['before']) && isset($pair['after'])):
                                    ?>
                                    <!-- Project <?php echo $num; ?> -->
                                    <div class="item">
                                        <div class="comparison-slider-wrapper">
                                            <div class="comparison-slider" role="img"
                                                aria-label="Project <?php echo $num; ?> transformation comparison">
                                                <div class="compare-img after-img">
                                                    <img class="owl-lazy" data-src="<?php echo htmlspecialchars($pair['after']); ?>"
                                                        alt="After transformation - Project <?php echo $num; ?>">
                                                    <div class="label label-after" aria-hidden="true">AFTER</div>
                                                </div>
                                                <div class="compare-img before-img"
                                                    style="clip-path: inset(0 20% 0 0); width: 100%;">
                                                    <img class="owl-lazy"
                                                        data-src="<?php echo htmlspecialchars($pair['before']); ?>"
                                                        alt="Before transformation - Project <?php echo $num; ?>">
                                                    <div class="label label-before" aria-hidden="true">BEFORE</div>
                                                </div>
                                                <div class="slider-handle" style="left: 80%;" aria-hidden="true">
                                                    <div class="handle-circle"><i class="fas fa-arrows-alt-h"
                                                            aria-hidden="true"></i></div>
                                                </div>
                                                <input type="range" min="0" max="100" value="80" class="slider-input"
                                                    aria-label="Adjust comparison slider for Project <?php echo $num; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state-message" style="text-align: center; padding: 60px 20px; color: #666;">
                            <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 20px; opacity: 0.5;"></i>
                            <p style="font-size: 1.1rem;">Project transformations will be displayed here soon.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <!-- Dynamic Mosaic Portfolio Section -->
        <section id="featured-work" style="padding: 60px 0; background: #fff; overflow: hidden;">
            <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <div
                    style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; gap: 20px; flex-wrap: wrap; border-bottom: 2px solid #f0f0f0; padding-bottom: 30px;">
                    <div style="max-width: 500px;">
                        <h2
                            style="font-size: 2.2rem; color: #000; font-weight: 900; text-transform: uppercase; letter-spacing: -1px; line-height: 1; margin-bottom: 12px;">
                            Pioneering <span style="display: block; color: #666; font-weight: 300;">Craftsmanship</span>
                        </h2>
                        <p style="color: #666; font-size: 0.95rem; margin: 0; line-height: 1.5;">
                            A curated selection of our most impactful maritime transformations.
                        </p>
                    </div>
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <button id="shuffle-mosaic" class="btn-refresh-modern" title="Shuffle Projects">
                            <i class="fas fa-random"></i> SHUFFLE
                        </button>
                        <a href="./index.php?f=our_work" class="btn-full-gallery-top">
                            VIEW FULL GALLERY <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <?php
                // Get ALL images for mosaic shuffle
                $category_names = [
                    'coat' => 'Coating Works',
                    'dd' => 'Dry Dock',
                    'mec' => 'Mechanical',
                    'steel' => 'Steel Works'
                ];
                $all_available_images = [];
                foreach ($category_names as $folder => $name) {
                    $path = "img/our_work/$folder";
                    if (is_dir($path)) {
                        $imgs = glob($path . "/*.{jpg,jpeg,png,JPG,JPEG,PNG,webp,WEBP}", GLOB_BRACE);
                        if ($imgs) {
                            foreach ($imgs as $img) {
                                $all_available_images[] = [
                                    'src' => $img,
                                    'cat' => $name
                                ];
                            }
                        }
                    }
                }

                // Keep the same PHP logic for initial load, but we'll use JS for shuffle
                shuffle($all_available_images);
                // We show 6 items in a grid that fills 4 columns
                // Item 1: 2x1, Item 2: 1x1, Item 3: 1x1 (Total 4)
                // Item 4: 1x1, Item 5: 1x1, Item 6: 2x1 (Total 4)
                // Total 8 slots occupied by 6 items
                $display_count = min(count($all_available_images), 6);
                $mosaic_images = array_slice($all_available_images, 0, $display_count);
                ?>

                <div class="mosaic-container" id="mosaic-grid">
                    <?php foreach ($mosaic_images as $index => $item):
                        $size_class = '';
                        if ($index === 0)
                            $size_class = 'mosaic-wide';
                        if ($index === 5)
                            $size_class = 'mosaic-wide';
                        ?>
                        <div class="mosaic-item <?php echo $size_class; ?> reveal-on-scroll is-visible">
                            <img src="<?php echo htmlspecialchars($item['src']); ?>" alt="Project">
                            <div class="mosaic-overlay"></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="text-align: center; margin-top: 40px; border-top: 1px solid #f0f0f0; padding-top: 30px;">
                    <p style="font-size: 0.85rem; color: #999; margin: 0;">&copy; Nautical Fix Solutions - Professional
                        Maritime Services</p>
                </div>
            </div>
        </section>

        <style>
            .mosaic-container {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-auto-rows: 240px;
                gap: 15px;
                position: relative;
            }

            .btn-refresh-modern {
                background: #000;
                border: 2px solid #000;
                padding: 10px 22px;
                font-size: 0.8rem;
                font-weight: 800;
                letter-spacing: 1px;
                cursor: pointer;
                border-radius: 4px;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 10px;
                color: #fff;
            }

            .btn-refresh-modern:hover {
                background: #333;
                border-color: #333;
                transform: translateY(-2px);
            }

            .btn-full-gallery-top {
                background: transparent;
                border: 2px solid #000;
                padding: 10px 22px;
                font-size: 0.8rem;
                font-weight: 800;
                letter-spacing: 1px;
                cursor: pointer;
                border-radius: 4px;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 10px;
                color: #000;
                text-decoration: none;
            }

            .btn-full-gallery-top:hover {
                background: #000;
                color: #fff;
                transform: translateY(-2px);
            }

            .mosaic-item {
                position: relative;
                overflow: hidden;
                border-radius: 6px;
                background: #f8f9fa;
                cursor: pointer;
                opacity: 0;
                transform: translateY(20px);
                transition: transform 0.5s ease-out, opacity 0.5s ease-out;
            }

            .mosaic-item.is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            .mosaic-wide {
                grid-column: span 2;
            }

            .mosaic-tall {
                grid-row: span 2;
            }

            .mosaic-large {
                grid-column: span 2;
                grid-row: span 2;
            }

            .mosaic-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .mosaic-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0);
                transition: background 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .mosaic-tag {
                background: #fff;
                color: #000;
                padding: 8px 20px;
                font-size: 0.75rem;
                font-weight: 800;
                width: fit-content;
                border-radius: 4px;
                transform: scale(0.85);
                opacity: 0;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 1px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .mosaic-item:hover img {
                transform: scale(1.08);
            }

            .mosaic-item:hover .mosaic-overlay {
                background: rgba(0, 0, 0, 0.4);
            }

            .mosaic-item:hover .mosaic-tag {
                transform: scale(1);
                opacity: 1;
            }

            .btn-explore-portfolio {
                display: inline-flex;
                align-items: center;
                gap: 15px;
                text-decoration: none;
                color: #000;
                font-weight: 800;
                text-transform: uppercase;
                font-size: 0.95rem;
                letter-spacing: 1px;
                position: relative;
                padding: 10px 0;
            }

            .btn-explore-portfolio i {
                transition: transform 0.3s ease;
            }

            .btn-explore-portfolio::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 30px;
                height: 2px;
                background: #000;
                transition: width 0.3s ease;
            }

            .btn-explore-portfolio:hover i {
                transform: translateX(10px);
            }

            .btn-explore-portfolio:hover::after {
                width: 100%;
            }

            @media (max-width: 992px) {
                .mosaic-container {
                    grid-template-columns: repeat(2, 1fr);
                    grid-auto-rows: 200px;
                }
            }

            @media (max-width: 576px) {
                .mosaic-container {
                    grid-template-columns: 1fr;
                    grid-auto-rows: 250px;
                }

                .mosaic-wide,
                .mosaic-tall,
                .mosaic-large {
                    grid-column: span 1;
                    grid-row: span 1;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const mosaicGrid = document.getElementById('mosaic-grid');
                const shuffleBtn = document.getElementById('shuffle-mosaic');
                const allImages = <?php echo json_encode($all_available_images); ?>;

                function renderMosaic() {
                    if (allImages.length === 0) return;

                    const shuffled = [...allImages].sort(() => 0.5 - Math.random());
                    const selected = shuffled.slice(0, 6);

                    shuffleBtn.classList.add('loading');
                    mosaicGrid.style.opacity = '0.3';

                    setTimeout(() => {
                        mosaicGrid.innerHTML = '';
                        selected.forEach((item, index) => {
                            let sizeClass = '';
                            if (index === 0) sizeClass = 'mosaic-wide';
                            if (index === 5) sizeClass = 'mosaic-wide';

                            const div = document.createElement('div');
                            div.className = `mosaic-item ${sizeClass} is-visible`;
                            div.innerHTML = `
                                <img src="${item.src}" alt="Project">
                                <div class="mosaic-overlay"></div>
                            `;
                            mosaicGrid.appendChild(div);
                        });

                        mosaicGrid.style.opacity = '1';
                        shuffleBtn.classList.remove('loading');
                    }, 300);
                }

                if (shuffleBtn) {
                    shuffleBtn.addEventListener('click', renderMosaic);
                }

                // Intersection Observer for scroll reveal
                const revealItems = document.querySelectorAll('.reveal-on-scroll');
                const observerOptions = { threshold: 0.1 };
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);
                revealItems.forEach((item, index) => {
                    item.style.transitionDelay = `${(index % 4) * 0.1}s`;
                    observer.observe(item);
                });
            });
        </script>


        <section id="services-section" style="padding: 60px 0; background: #f2f4f6; position: relative;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <div style="text-align: center; margin-bottom: 60px; position: relative;">
                    <h2 style="font-size: 2.5rem; color: #000; margin-bottom: 15px; font-weight: 700;">OUR SERVICES</h2>
                    <div style="width: 80px; height: 2px; background: #000; margin: 0 auto;"></div>
                </div>

                <div id="services-carousel" class="services-carousel owl-carousel owl-theme">
                    <!-- Card 1 -->
                    <div class="item">
                        <div class="service-card-v2">
                            <a href="./index.php?f=services" class="card-inner">
                                <div class="img-wrapper">
                                    <img src="./img/services2.jpg"
                                        alt="Shipyard services - Professional maritime repair and maintenance"
                                        loading="lazy">
                                    <div class="img-overlay"></div>
                                </div>
                                <div class="card-content">
                                    <h3>Shipyard Services</h3>
                                    <div class="read-more-btn">
                                        <span>Read More</span>
                                        <i class="fas fa-long-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="item">
                        <div class="service-card-v2">
                            <a href="./index.php?f=services" class="card-inner">
                                <div class="img-wrapper">
                                    <img src="./img/services3.jpg"
                                        alt="Drydock service - Comprehensive ship maintenance in dry dock facilities"
                                        loading="lazy">
                                    <div class="img-overlay"></div>
                                </div>
                                <div class="card-content">
                                    <h3>Drydock Service</h3>
                                    <div class="read-more-btn">
                                        <span>Read More</span>
                                        <i class="fas fa-long-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="item">
                        <div class="service-card-v2">
                            <a href="./index.php?f=services" class="card-inner">
                                <div class="img-wrapper">
                                    <img src="./img/services4.jpg"
                                        alt="Onboard solutions - Expert technical services for vessels at sea"
                                        loading="lazy">
                                    <div class="img-overlay"></div>
                                </div>
                                <div class="card-content">
                                    <h3>Onboard Solutions</h3>
                                    <div class="read-more-btn">
                                        <span>Read More</span>
                                        <i class="fas fa-long-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="item">
                        <div class="service-card-v2">
                            <a href="./index.php?f=services" class="card-inner">
                                <div class="img-wrapper">
                                    <img src="./img/services5.jpg" alt="Quality">
                                    <div class="img-overlay"></div>
                                </div>
                                <div class="card-content">
                                    <h3>Quality Assurance</h3>
                                    <div class="read-more-btn">
                                        <span>Read More</span>
                                        <i class="fas fa-long-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="item">
                        <div class="service-card-v2">
                            <a href="./index.php?f=services" class="card-inner">
                                <div class="img-wrapper">
                                    <img src="./img/services6.jpg"
                                        alt="Customized packages - Tailored maritime solutions for your specific needs"
                                        loading="lazy">
                                    <div class="img-overlay"></div>
                                </div>
                                <div class="card-content">
                                    <h3>Customized Packages</h3>
                                    <div class="read-more-btn">
                                        <span>Read More</span>
                                        <i class="fas fa-long-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact-section"
            style="padding: 60px 0; background: url('./img/maincontactus.jpg') no-repeat center center; background-size: cover; position: relative; overflow: hidden; display: flex; align-items: center;">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%); z-index: 1;">
            </div>

            <div class="container"
                style="position: relative; z-index: 2; width: 100%; max-width: 1200px; padding: 0 20px;">
                <div class="contact-flex-wrapper">
                    <div class="contact-info-text">
                        <h2
                            style="font-size: 2.5rem; font-weight: 800; color: #fff; line-height: 1.2; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;">
                            GLOBAL EXCELLENCE <br><span style="color: rgba(255,255,255,0.7);">IN MARINE SOLUTIONS</span>
                        </h2>
                        <p
                            style="font-size: 1.1rem; color: rgba(255,255,255,0.8); margin-bottom: 0; max-width: 450px; line-height: 1.6;">
                            Our specialist engineers provide comprehensive maintenance and technical solutions for
                            vessels worldwide.
                        </p>
                    </div>

                    <div class="contact-form-card">
                        <form method="POST" action="" id="callback-form"
                            aria-label="Professional callback request form">
                            <?php if ($form_message): ?>
                                <div class="form-message form-message-<?php echo $form_message_type; ?>" role="alert"
                                    aria-live="polite">
                                    <i
                                        class="fas <?php echo $form_message_type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                                    <span><?php echo htmlspecialchars($form_message); ?></span>
                                </div>
                            <?php endif; ?>
                            <div style="display: flex; flex-direction: column; gap: 12px;">
                                <label for="callback_email"
                                    style="color: #fff; font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase; font-weight: 600; opacity: 0.9;">Professional
                                    Callback</label>
                                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <input type="email" id="callback_email" name="callback_email"
                                        placeholder="Your corporate email..."
                                        value="<?php echo isset($_POST['callback_email']) && $form_message_type !== 'success' ? htmlspecialchars($_POST['callback_email']) : ''; ?>"
                                        style="flex: 1; min-width: 220px; padding: 14px 20px; border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.6); color: #fff; border-radius: 4px; outline: none; font-size: 15px; transition: all 0.3s;"
                                        required aria-required="true" aria-describedby="email-help">
                                    <button type="submit" name="submit_callback" class="btn-submit-modern"
                                        id="submit-callback-btn">
                                        <span class="btn-text">Request Info</span>
                                        <span class="btn-loading" style="display: none;">
                                            <i class="fas fa-spinner fa-spin"></i> Sending...
                                        </span>
                                    </button>
                                </div>
                                <small id="email-help" style="color: rgba(255,255,255,0.6); font-size: 0.85rem;">We'll
                                    contact you within 24 hours.</small>
                            </div>
                        </form>
                        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.1);">
                            <a href="mailto:info@nauticalfs.com" aria-label="Send email to info@nauticalfs.com"
                                style="color: #fff; text-decoration: none; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; opacity: 0.7; transition: 0.3s;">
                                <i class="fas fa-envelope" aria-hidden="true"></i> info@nauticalfs.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        /* Z-Index Ayarları */
        .hero-section,
        .video-container {
            z-index: 1 !important;
        }

        /* Fotoğraf Animasyonları */
        .img-hover-container img,
        .img-zoom-wrapper img {
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .img-hover-container:hover img {
            transform: scale(1.05);
        }

        /* Before/After Slider */
        .comparison-slider-wrapper {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.15);
            background: #eee;
        }

        .comparison-slider {
            position: relative;
            width: 100%;
            aspect-ratio: 3 / 2;
            /* Taller aspect ratio as requested */
            max-height: 750px;
            user-select: none;
            overflow: hidden;
            background: #000;
            /* Backdrop for contain if needed */
        }

        .compare-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .compare-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Changed to cover for a better reveal effect without zooming */
            display: block;
            pointer-events: none;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            transform: translateZ(0);
        }

        /* Toned down vibrancy enhancements for After images */
        .after-img img {
            filter: contrast(1.05) saturate(1.1) brightness(1.02);
        }

        /* Subtle enhancement for Before to maintain quality but keep it "raw" */
        .before-img img {
            filter: contrast(1.02) brightness(0.95);
        }

        .before-img {
            z-index: 2;
            will-change: clip-path;
            /* Border removed to use slider-handle instead, avoiding clipping issues with clip-path */
        }

        .slider-handle {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 1.5px;
            background: rgba(255, 255, 255, 0.8);
            z-index: 3;
            pointer-events: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            backface-visibility: hidden;
            transform: translateZ(0);
        }

        .handle-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 42px;
            height: 42px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: #000;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .slider-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            z-index: 10;
            cursor: col-resize;
        }

        .label {
            position: absolute;
            top: 20px;
            padding: 6px 14px;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            border-radius: 3px;
            z-index: 5;
            pointer-events: none;
            text-transform: uppercase;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .label-before {
            left: 20px;
        }

        .label-after {
            right: 20px;
        }

        @media (max-width: 768px) {
            .comparison-slider {
                max-height: 400px;
            }

            .handle-circle {
                width: 44px;
                height: 44px;
                font-size: 16px;
            }
        }

        .services-carousel .item {
            padding: 15px;
        }

        #comparison-carousel .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: #000 !important;
            color: #fff !important;
            border-radius: 50% !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: 0.3s;
            z-index: 100;
        }

        #comparison-carousel .owl-nav .owl-prev {
            left: -30px;
        }

        #comparison-carousel .owl-nav .owl-next {
            right: -30px;
        }

        @media (max-width: 1250px) {
            #comparison-carousel .owl-nav .owl-prev {
                left: 10px;
            }

            #comparison-carousel .owl-nav .owl-next {
                right: 10px;
            }
        }

        .services-carousel .item {
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            height: 100%;
        }

        /* Owl Carousel Custom Styles */
        .services-carousel .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background: #fff !important;
            color: #000 !important;
            border-radius: 50% !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            z-index: 10;
        }

        .services-carousel .owl-nav button:hover {
            background: #000 !important;
            color: #fff !important;
        }

        .services-carousel .owl-nav .owl-prev {
            left: -25px;
        }

        .services-carousel .owl-nav .owl-next {
            right: -25px;
        }

        .services-carousel .owl-dots {
            text-align: center;
            margin-top: 30px;
        }

        .services-carousel .owl-dot span {
            width: 10px !important;
            height: 10px !important;
            background: #ddd !important;
            transition: 0.3s;
        }

        .services-carousel .owl-dot.active span {
            background: #000 !important;
            width: 25px !important;
        }

        .service-card-v2 {
            background: #fff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            height: 100%;
        }

        .service-card-v2:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .card-inner {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .img-wrapper {
            width: 100%;
            height: 240px;
            overflow: hidden;
            position: relative;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .service-card-v2:hover .img-wrapper img {
            transform: scale(1.08);
        }

        .img-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .service-card-v2:hover .img-overlay {
            opacity: 1;
        }

        .card-content {
            padding: 25px 30px;
            background: #fff;
        }

        .card-content h3 {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1a1a1a;
            transition: color 0.3s ease;
        }

        .service-card-v2:hover .card-content h3 {
            color: #000;
        }

        .read-more-btn {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .read-more-btn i {
            margin-left: 8px;
            transition: transform 0.3s ease;
            font-size: 0.85rem;
        }

        .service-card-v2:hover .read-more-btn {
            color: #000;
        }

        .service-card-v2:hover .read-more-btn i {
            transform: translateX(5px);
        }


        /* Hero Button Modern */
        .btn-hero-modern {
            display: inline-block;
            background-color: #ffffff;
            color: #000000;
            padding: 14px 35px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        .btn-hero-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            background-color: #000000;
            color: #ffffff;
        }

        .custom-btn-black {
            background: transparent;
            color: #000;
            padding: 14px 32px;
            border: 2px solid #000;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: 0.3s;
            border-radius: 4px;
        }

        .custom-btn-black:hover {
            background: #000;
            color: #fff !important;
        }

        .custom-btn-video {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            color: #fff;
            padding: 16px 45px;
            border: 2px solid #fff;
            text-decoration: none;
            font-weight: 700;
            display: inline-block;
            transition: 0.4s;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-radius: 4px;
        }

        .custom-btn-video:hover {
            background: #fff;
            color: #000 !important;
            transform: scale(1.05);
        }

        .custom-btn-video-sm {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            color: #fff;
            padding: 12px 30px;
            border: 1.5px solid #fff;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 2px;
            display: inline-block;
            transition: 0.4s;
            font-size: 0.9rem;
        }

        .custom-btn-video-sm:hover {
            background: #fff;
            color: #000 !important;
        }

        /* LinkedIn Icon Hover */
        .video-container a[href*="linkedin"]:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            transform: scale(1.1);
            border-color: #fff !important;
        }

        /* Contact Section New Styles */
        .contact-flex-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 50px;
        }

        .contact-info-text {
            flex: 1;
        }

        .contact-form-card {
            flex: 1;
            background: rgba(0, 0, 0, 0.85);
            /* Solid dark background */
            padding: 30px 40px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-submit-modern {
            padding: 14px 25px;
            background: #fff;
            color: #000;
            border: none;
            border-radius: 4px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-size: 14px;
        }

        .btn-submit-modern:hover {
            background: #000;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        @media (max-width: 992px) {
            .contact-flex-wrapper {
                flex-direction: column;
                text-align: center;
                gap: 40px;
            }

            .contact-info-text h2 {
                font-size: 2.5rem !important;
            }

            .contact-form-card {
                width: 100%;
                padding: 30px 20px;
            }
        }

        /* Form Message Styles */
        .form-message {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            animation: slideIn 0.3s ease;
        }

        .form-message-success {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.4);
        }

        .form-message-error {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
            border: 1px solid rgba(244, 67, 54, 0.4);
        }

        .form-message i {
            font-size: 1.1rem;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Empty State Styles */
        .empty-state-message {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state-message i {
            font-size: 3rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        /* Form Input Focus States */
        #callback_email:focus {
            border-color: rgba(255, 255, 255, 0.4) !important;
            background: rgba(0, 0, 0, 0.7) !important;
        }

        /* Button Loading State */
        .btn-submit-modern:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .video-container {
                height: 60vh !important;
            }

            h1 {
                font-size: 1.7rem !important;
            }

            .services-carousel .item {
                padding: 10px 0;
            }

            .services-carousel .owl-nav button {
                display: none !important;
                /* Hide arrows on mobile for better space */
            }

            .btn-submit-modern {
                width: 100%;
            }

            .form-message {
                font-size: 0.85rem;
                padding: 10px 12px;
            }
        }
    </style>

    <script>
        // Form submission enhancement
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('callback-form');
            const submitBtn = document.getElementById('submit-callback-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            if (form) {
                form.addEventListener('submit', function (e) {
                    const emailInput = document.getElementById('callback_email');

                    // Basic client-side validation
                    if (!emailInput.value || !emailInput.value.includes('@')) {
                        e.preventDefault();
                        return false;
                    }

                    // Show loading state
                    if (btnText && btnLoading) {
                        btnText.style.display = 'none';
                        btnLoading.style.display = 'inline-block';
                        submitBtn.disabled = true;
                    }
                });

                // Auto-hide success message after 5 seconds
                const successMessage = document.querySelector('.form-message-success');
                if (successMessage) {
                    setTimeout(function () {
                        successMessage.style.transition = 'opacity 0.5s ease';
                        successMessage.style.opacity = '0';
                        setTimeout(function () {
                            successMessage.remove();
                        }, 500);
                    }, 5000);
                }
            }
        });
    </script>
</body>

</html>