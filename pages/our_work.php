<!-- Modern Gallery System -->
<style>
    * {
        box-sizing: border-box;
    }

    /* Hero Section */
    .gallery-hero {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        padding: 60px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .gallery-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .gallery-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 15px;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .gallery-hero p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        position: relative;
        z-index: 1;
    }

    /* Page Background */
    .gallery-page {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 0;
    }

    /* Tabs Section */
    .tabs-section {
        background: #f5f5f5;
        padding: 40px 20px 30px;
        margin: 0;
    }

    /* Category Description */
    .category-description {
        max-width: 800px;
        margin: 0 auto 40px;
        text-align: center;
        padding: 0 20px;
        display: none;
        animation: fadeInText 0.5s ease;
    }

    .category-description.active {
        display: block;
    }

    .category-description h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #000;
        margin: 0 0 12px;
    }

    .category-description p {
        font-size: 1rem;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    @keyframes fadeInText {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Category Tabs */
    .gallery-tabs {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin: 0 0 30px;
        flex-wrap: wrap;
        padding: 0 20px;
    }

    .tab-btn {
        padding: 14px 32px;
        background: #fff;
        border: 2px solid #e0e0e0;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        color: #666;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .tab-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.1);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .tab-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .tab-btn:hover {
        border-color: #000;
        color: #000;
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .tab-btn.active {
        background: #000;
        border-color: #000;
        color: #fff;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        transform: translateY(-2px);
    }

    .tab-btn.active::before {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Masonry Grid */
    .gallery-container {
        display: none;
        column-count: 4;
        column-gap: 15px;
        padding: 0 20px;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .gallery-container.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-container.fade-out {
        opacity: 0;
        transform: translateY(-20px);
    }

    .gallery-item {
        break-inside: avoid;
        margin-bottom: 15px;
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        cursor: zoom-in;
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        animation: fadeInUp 0.6s ease forwards;
    }

    .gallery-item.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .gallery-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        z-index: 10;
    }

    .gallery-item img {
        width: 100%;
        display: block;
        border-radius: 8px;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.4s ease;
        filter: grayscale(20%) contrast(105%) brightness(98%);
    }

    .gallery-item:hover img {
        transform: scale(1.08);
        filter: grayscale(0%) contrast(110%) brightness(105%);
    }

    /* Image Overlay on Hover */
    .gallery-item-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding: 20px;
        border-radius: 8px;
        pointer-events: none;
    }

    .gallery-item:hover .gallery-item-overlay {
        opacity: 1;
    }

    .gallery-item-info {
        color: #fff;
        text-align: center;
        transform: translateY(10px);
        transition: transform 0.4s ease;
    }

    .gallery-item:hover .gallery-item-info {
        transform: translateY(0);
    }

    .gallery-item-info h4 {
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .gallery-item-info p {
        font-size: 12px;
        margin: 0;
        opacity: 0.9;
    }

    /* Loading Skeleton */
    .gallery-item-skeleton {
        break-inside: avoid;
        margin-bottom: 15px;
        height: 200px;
        background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s ease-in-out infinite;
        border-radius: 8px;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    /* Lightbox */
    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .lightbox.active {
        display: flex;
        opacity: 1;
    }

    .lightbox-content {
        position: relative;
        max-width: 90%;
        max-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 0 60px rgba(0, 0, 0, 0.8);
        filter: grayscale(0%) contrast(105%) saturate(105%);
        cursor: zoom-in;
        transition: transform 0.3s ease, opacity 0.3s ease;
        opacity: 1;
    }

    .lightbox-img.zoomed {
        transform: scale(2);
        cursor: zoom-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(50px) scale(0.9);
        }

        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    @keyframes slideInReverse {
        from {
            opacity: 0;
            transform: translateX(-50px) scale(0.9);
        }

        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .lightbox.active .lightbox-content {
        animation: fadeInScale 0.4s ease;
    }

    .lightbox-img.slide-left {
        animation: slideIn 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    .lightbox-img.slide-right {
        animation: slideInReverse 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    /* Lightbox Controls */
    .lb-close {
        position: fixed;
        top: 20px;
        right: 30px;
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 10001;
    }

    .lb-close:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    .lb-nav {
        position: fixed;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 10001;
    }

    .lb-nav:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-50%) scale(1.1);
    }

    .lb-prev {
        left: 30px;
    }

    .lb-next {
        right: 30px;
    }

    .lb-counter {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 20px;
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        z-index: 10001;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .gallery-container {
            column-count: 3;
        }
    }

    @media (max-width: 768px) {
        .gallery-hero h1 {
            font-size: 2rem;
        }

        .gallery-hero p {
            font-size: 1rem;
        }

        .gallery-hero {
            padding: 40px 20px;
        }

        .gallery-container {
            column-count: 2;
            column-gap: 10px;
        }

        .gallery-item {
            margin-bottom: 10px;
        }

        .lb-nav {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .lb-prev {
            left: 15px;
        }

        .lb-next {
            right: 15px;
        }
    }

    @media (max-width: 480px) {
        .gallery-container {
            column-count: 1;
        }

        .tab-btn {
            padding: 10px 20px;
            font-size: 12px;
        }
    }
</style>

<?php
// Configuration for Categories and folders
$categories = [
    'coat' => [
        'title' => 'Coating Works',
        'desc_title' => 'Professional Coating & Painting',
        'desc' => 'High-quality hull treatment, grit blasting, and advanced marine coating applications. We ensure your vessel is protected against corrosion with industry-leading standards.',
        'folder' => 'img/our_work/coat'
    ],
    'dd' => [
        'title' => 'Dry Dock',
        'desc_title' => 'Dry Docking Operations',
        'desc' => 'Comprehensive dry docking services including underwater maintenance, anode replacement, and structural inspections. We manage efficient dock stays to minimize off-hire time.',
        'folder' => 'img/our_work/dd'
    ],
    'mec' => [
        'title' => 'Mechanical',
        'desc_title' => 'Mechanical Repairs & Add-ons',
        'desc' => 'Expert mechanical solutions from main engine overhauls to auxiliary machinery repairs and system upgrades. Our technicians deliver precision work for optimal vessel performance.',
        'folder' => 'img/our_work/mec'
    ],
    'steel' => [
        'title' => 'Steel Works',
        'desc_title' => 'Steelworks',
        'desc' => 'Specialized hull plating renewal, structural repairs, and custom steel fabrication. We utilize high-grade materials and certified welding procedures for all maritime metalwork.',
        'folder' => 'img/our_work/steel'
    ]
];

// Function to get images from a folder
function getImages($folder)
{
    if (!is_dir($folder))
        return [];

    $files = glob($folder . '/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);

    // Natural sorting to follow meaningful naming (e.g., sac1, sac2, sac10)
    natsort($files);

    return array_values($files);
}
?>

<!-- Hero Section -->
<div class="gallery-hero">
    <h1>Our Work</h1>
    <p>Explore our portfolio of maritime excellence</p>
</div>

<section class="gallery-page">

    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="container">

            <!-- Category Tabs -->
            <div class="gallery-tabs">
                <?php $isFirst = true; ?>
                <?php foreach ($categories as $id => $cat): ?>
                    <button class="tab-btn <?php echo $isFirst ? 'active' : ''; ?>" data-category="<?php echo $id; ?>">
                        <?php echo $cat['title']; ?>
                    </button>
                    <?php $isFirst = false; ?>
                <?php endforeach; ?>
            </div>

            <!-- Category Descriptions -->
            <?php $isFirst = true; ?>
            <?php foreach ($categories as $id => $cat): ?>
                <div id="desc-<?php echo $id; ?>" class="category-description <?php echo $isFirst ? 'active' : ''; ?>">
                    <h3>
                        <?php echo $cat['desc_title']; ?>
                    </h3>
                    <p>
                        <?php echo $cat['desc']; ?>
                    </p>
                </div>
                <?php $isFirst = false; ?>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Gallery Section -->
    <div class="container" style="padding-top: 40px; padding-bottom: 60px;">

        <?php $isFirst = true; ?>
        <?php foreach ($categories as $id => $cat): ?>
            <div id="<?php echo $id; ?>" class="gallery-container <?php echo $isFirst ? 'active' : ''; ?>">
                <?php
                $images = getImages($cat['folder']);
                if (empty($images)):
                    ?>
                    <p style="text-align: center; color: #999; padding: 40px;">No images available in this category yet.</p>
                <?php else: ?>
                    <?php foreach ($images as $index => $img): ?>
                        <div class="gallery-item" data-index="<?php echo $index; ?>"
                            style="animation-delay: <?php echo $index * 0.05; ?>s;">
                            <img src="<?php echo $img; ?>" alt="<?php echo $cat['title']; ?>" loading="lazy">
                            <div class="gallery-item-overlay">
                                <div class="gallery-item-info">
                                    <h4><?php echo $cat['title']; ?></h4>
                                    <p>Click to view full size</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php $isFirst = false; ?>
        <?php endforeach; ?>

    </div>
</section>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <button class="lb-close">&times;</button>
    <button class="lb-nav lb-prev"><i class="fas fa-chevron-left"></i></button>
    <button class="lb-nav lb-next"><i class="fas fa-chevron-right"></i></button>
    <div class="lightbox-content">
        <img src="" alt="Preview" class="lightbox-img">
    </div>
    <div class="lb-counter"><span id="current">1</span> / <span id="total">1</span></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab-btn');
        const galleries = document.querySelectorAll('.gallery-container');
        const lightbox = document.getElementById('lightbox');
        const lbImg = lightbox.querySelector('.lightbox-img');
        const lbClose = lightbox.querySelector('.lb-close');
        const lbPrev = lightbox.querySelector('.lb-prev');
        const lbNext = lightbox.querySelector('.lb-next');
        const currentSpan = document.getElementById('current');
        const totalSpan = document.getElementById('total');

        let currentImages = [];
        let currentIndex = 0;

        // Tab Switching with smooth transitions
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const category = tab.dataset.category;
                const targetGallery = document.getElementById(category);

                // Fade out current gallery
                const activeGallery = document.querySelector('.gallery-container.active');
                if (activeGallery && activeGallery !== targetGallery) {
                    activeGallery.classList.add('fade-out');
                    setTimeout(() => {
                        activeGallery.classList.remove('active', 'fade-out');
                    }, 300);
                }

                // CSS state management
                tabs.forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.category-description').forEach(d => d.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById('desc-' + category).classList.add('active');

                // Fade in new gallery with staggered items
                setTimeout(() => {
                    targetGallery.classList.add('active');
                    staggerGalleryItems(targetGallery);
                }, 300);

                // Re-initialize gallery data for lightbox
                setTimeout(() => {
                    attachGalleryEvents();
                }, 600);
            });
        });

        // Stagger animation for gallery items
        function staggerGalleryItems(container) {
            const items = container.querySelectorAll('.gallery-item');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(30px) scale(0.95)';
                setTimeout(() => {
                    item.classList.add('visible');
                }, index * 50);
            });
        }

        // Attach click events to gallery items
        function attachGalleryEvents() {
            const activeGallery = document.querySelector('.gallery-container.active');
            if (!activeGallery) return;

            const items = activeGallery.querySelectorAll('.gallery-item img');
            currentImages = Array.from(items);
            totalSpan.textContent = currentImages.length;

            items.forEach((img, index) => {
                const galleryItem = img.closest('.gallery-item');
                galleryItem.onclick = () => openLightbox(index);
            });
        }

        // Lightbox zoom functionality
        let isZoomed = false;
        lbImg.addEventListener('dblclick', () => {
            if (isZoomed) {
                lbImg.classList.remove('zoomed');
                isZoomed = false;
            } else {
                lbImg.classList.add('zoomed');
                isZoomed = true;
            }
        });

        // Reset zoom when changing images
        function resetZoom() {
            lbImg.classList.remove('zoomed');
            isZoomed = false;
        }

        function openLightbox(index) {
            currentIndex = index;
            // Set source immediately to avoid flash of previous image
            lbImg.src = currentImages[currentIndex].src;
            currentSpan.textContent = currentIndex + 1;

            // Remove any leftover animation classes
            lbImg.classList.remove('slide-left', 'slide-right');

            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
            // Clear source after a delay to ensure it's not visible during close transition
            setTimeout(() => {
                lbImg.src = '';
                resetZoom();
            }, 300);
        }

        function updateLightbox(direction = 'left') {
            if (currentImages.length === 0) return;

            // Reset zoom
            resetZoom();

            // Fade out current image
            lbImg.style.opacity = '0';

            setTimeout(() => {
                // Remove old animation classes
                lbImg.classList.remove('slide-left', 'slide-right');

                // Trigger reflow
                void lbImg.offsetWidth;

                // Set new source
                lbImg.src = currentImages[currentIndex].src;
                currentSpan.textContent = currentIndex + 1;

                // Add animation class
                lbImg.classList.add(direction === 'left' ? 'slide-left' : 'slide-right');

                // Fade back in
                lbImg.style.opacity = '1';
            }, 150);
        }

        function nextImage() {
            if (currentImages.length <= 1) return;
            currentIndex = (currentIndex + 1) % currentImages.length;
            updateLightbox('left');
        }

        function prevImage() {
            if (currentImages.length <= 1) return;
            currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
            updateLightbox('right');
        }

        // Event Listeners
        lbClose.onclick = closeLightbox;
        lbNext.onclick = (e) => { e.stopPropagation(); nextImage(); };
        lbPrev.onclick = (e) => { e.stopPropagation(); prevImage(); };
        lightbox.onclick = (e) => { if (e.target === lightbox) closeLightbox(); };

        // Keyboard Navigation
        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
        });

        // Initialize with staggered animation
        function initGallery() {
            const activeGallery = document.querySelector('.gallery-container.active');
            if (activeGallery) {
                staggerGalleryItems(activeGallery);
            }
            attachGalleryEvents();
        }

        // Initialize on load
        initGallery();

        // Handle image loading
        const galleryImages = document.querySelectorAll('.gallery-item img');
        galleryImages.forEach(img => {
            img.addEventListener('load', function () {
                this.style.opacity = '1';
            });
            img.addEventListener('error', function () {
                this.style.opacity = '0.5';
            });
        });
    });
</script>