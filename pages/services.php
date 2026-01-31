<style>
    /* Hero Section */
    .services-hero {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        padding: 60px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 0;
    }

    .services-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .services-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 15px;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .services-hero p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .services-hero h1 {
            font-size: 2rem;
        }

        .services-hero p {
            font-size: 1rem;
        }

        .services-hero {
            padding: 40px 20px;
        }
    }
</style>

<!-- Hero Section -->
<div class="services-hero">
    <h1>Our Services</h1>
    <p>At Nautical Fix Solutions, we offer a comprehensive suite of services that aim to keep your maritime assets in
        optimal condition. Explore our offerings, including Ballast Water Management Systems and IMO retrofit solutions,
        and discover how we can support your fleet's success.</p>
</div>

<!-- Services Main Section -->
<section class="services-main-section" style="padding: 50px 0; background-color: #ffffff;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 0px;">

        <!-- Shipyard Services -->
        <div class="service-item service-item-left fade-in"
            style="margin-bottom: 100px; display: flex; align-items: center; min-height: 500px; flex-direction: row;">
            <div class="service-image-container" style="flex: 0 0 48%; max-width: 48%; padding: 0 30px;">
                <img src="./img/services2.jpg" alt="Shipyard Services" class="service-img-hover"
                    style="width: 100%; height: 450px; object-fit: cover; border-radius: 8px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); transition: transform 0.4s ease, box-shadow 0.4s ease; border: 1px solid #e0e0e0;">
            </div>
            <div class="service-content-container" style="flex: 0 0 52%; max-width: 52%; padding: 0 40px;">
                <h2 class="service-item-title"
                    style="font-size: 2.2rem; font-weight: 700; color: #000000; margin-bottom: 35px;">Shipyard Services
                </h2>
                <ul class="service-details-list" style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">Ship
                                Repairs</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                We specialize in a wide range of ship repairs, from routine maintenance to complex
                                overhauls. Our expert team ensures your vessel is back in optimal condition.
                            </p>
                        </div>
                    </li>
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">
                                Refitting and Conversion</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                Transform and upgrade your ships with our refitting and conversion services. Enhance
                                efficiency, capacity, and compliance.
                            </p>
                        </div>
                    </li>
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">Ballast
                                Water Management System</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                Ensure compliance with IMO regulations by integrating advanced Ballast Water Management
                                Systems, designed to meet environmental standards.
                            </p>
                        </div>
                    </li>
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">IMO
                                Retrofit Systems</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                We offer retrofit solutions to bring your vessels up to the latest IMO compliance
                                requirements, covering systems such as exhaust gas cleaning (scrubbers) and more.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Drydock Service -->
        <div class="service-item service-item-right fade-in"
            style="margin-bottom: 100px; display: flex; align-items: center; min-height: 500px; flex-direction: row-reverse;">
            <div class="service-image-container" style="flex: 0 0 48%; max-width: 48%; padding: 0 30px;">
                <img src="./img/services3.jpg" alt="Drydock Service" class="service-img-hover"
                    style="width: 100%; height: 450px; object-fit: cover; border-radius: 8px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); transition: transform 0.4s ease, box-shadow 0.4s ease; border: 1px solid #e0e0e0;">
            </div>
            <div class="service-content-container" style="flex: 0 0 52%; max-width: 52%; padding: 0 40px;">
                <h2 class="service-item-title"
                    style="font-size: 2.2rem; font-weight: 700; color: #000000; margin-bottom: 35px;">Drydock Service
                </h2>
                <ul class="service-details-list" style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">
                                State-of-the-Art Drydocks</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                Explore our state-of-the-art drydocking options selected as per project requirements
                                equipped to handle vessels of varying sizes and types.
                            </p>
                        </div>
                    </li>
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">
                                Maintenance and Inspections</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                Ensure your ships are in peak condition with our drydock maintenance and inspection
                                services.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Onboard Solutions -->
        <div class="service-item service-item-left fade-in"
            style="margin-bottom: 100px; display: flex; align-items: center; min-height: 500px; flex-direction: row;">
            <div class="service-image-container" style="flex: 0 0 48%; max-width: 48%; padding: 0 30px;">
                <img src="./img/services4.jpg" alt="Onboard Solutions" class="service-img-hover"
                    style="width: 100%; height: 450px; object-fit: cover; border-radius: 8px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); transition: transform 0.4s ease, box-shadow 0.4s ease; border: 1px solid #e0e0e0;">
            </div>
            <div class="service-content-container" style="flex: 0 0 52%; max-width: 52%; padding: 0 40px;">
                <h2 class="service-item-title"
                    style="font-size: 2.2rem; font-weight: 700; color: #000000; margin-bottom: 35px;">Onboard Solutions
                </h2>
                <ul class="service-details-list" style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">Onboard
                                Repairs</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                In addition to our shoreside services, we offer onboard solutions to address urgent
                                maintenance and repairs directly on your vessel.
                            </p>
                        </div>
                    </li>
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">
                                Emergency Response</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                Count on us for rapid response and emergency repairs, minimizing downtime and
                                disruptions to your operations.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Quality Assurance -->
        <div class="service-item service-item-left fade-in"
            style="margin-bottom: 100px; display: flex; align-items: center; min-height: 500px; flex-direction: row;">

            <div class="service-content-container" style="flex: 0 0 52%; max-width: 52%; padding: 0 40px;">
                <h2 class="service-item-title"
                    style="font-size: 2.2rem; font-weight: 700; color: #000000; margin-bottom: 35px;">Quality Assurance
                </h2>
                <ul class="service-details-list" style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">Safety
                                and Compliance</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                We prioritize safety and adherence to industry regulations, providing you with peace of
                                mind.
                            </p>
                        </div>
                    </li>
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">Quality
                                Control</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                Our rigorous quality control measures ensure that every project meets our high
                                standards.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="service-image-container" style="flex: 0 0 48%; max-width: 48%; padding: 0 30px;">
                <img src="./img/services5.jpg" alt="Quality Assurance" class="service-img-hover"
                    style="width: 100%; height: 450px; object-fit: cover; border-radius: 8px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); transition: transform 0.4s ease, box-shadow 0.4s ease; border: 1px solid #e0e0e0;">
            </div>
        </div>

        <!-- Customized Packages -->
        <div class="service-item service-item-right fade-in"
            style="margin-bottom: 100px; display: flex; align-items: center; min-height: 500px; flex-direction: row-reverse;">

            <div class="service-content-container" style="flex: 0 0 52%; max-width: 52%; padding: 0 40px;">
                <h2 class="service-item-title"
                    style="font-size: 2.2rem; font-weight: 700; color: #000000; margin-bottom: 35px;">Customized
                    Packages</h2>
                <ul class="service-details-list" style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 30px; position: relative; padding-left: 35px;">
                        <div class="service-content">
                            <h3 class="service-detail-title"
                                style="font-size: 1.3rem; color: #000000; font-weight: 600; margin-bottom: 8px;">
                                Tailored Solutions</h3>
                            <p class="service-detail-description"
                                style="color: #666666; font-size: 1rem; line-height: 1.7;">
                                We understand that each vessel is unique. Our services can be tailored to meet your
                                specific needs, whether you have a single ship or an entire fleet.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="service-image-container" style="flex: 0 0 48%; max-width: 48%; padding: 0 30px;">
                <img src="./img/services6.jpg" alt="Customized Packages" class="service-img-hover"
                    style="width: 100%; height: 450px; object-fit: cover; border-radius: 8px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); transition: transform 0.4s ease, box-shadow 0.4s ease; border: 1px solid #e0e0e0;">
            </div>
        </div>

    </div>
</section>

<style>
    /* Mouse ile üzerine gelince resmin canlanması */
    .service-img-hover {
        filter: contrast(1.2) saturate(1.2);
        /* Makes images naturally lively */
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
    }

    .service-img-hover {
        overflow: hidden;
        /* Prevents image from breaking out of container */
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-img-hover:hover {
        transform: scale(1.1) translateY(-4px);
        /* Entire box grows */
        box-shadow: 0 16px 32px rgba(0, 51, 102, 0.2),
            0 6px 12px rgba(0, 51, 102, 0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-img-hover img {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
        width: 100%;
    }

    .service-img-hover:hover img {
        transform: scale(1.1);
        /* Image grows slightly more inside the box */
    }
    }

    /* SADECE BU SAYFA İÇİN - Navbar'ı etkilemez */
    .services-main-section .service-details-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: -2px;
        color: #000000;
        font-weight: bold;
        font-size: 1.3rem;
        background: rgba(0, 0, 0, 0.05);
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #000000;
    }

    .services-main-section .service-item-right .service-details-list li {
        padding-left: 0;
        padding-right: 35px;
        text-align: right;
    }

    .services-main-section .service-item-right .service-details-list li::before {
        left: auto;
        right: 0;
    }

    /* Hover efekti */
    .services-main-section .service-image:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    /* Fade-in Animation */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive için */
    @media (max-width: 992px) {
        .services-main-section .service-item {
            flex-direction: column !important;
            min-height: auto !important;
            margin-bottom: 80px !important;
        }

        .services-main-section .service-image-container,
        .services-main-section .service-content-container {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
        }

        .services-main-section .service-image-container {
            margin-bottom: 40px !important;
        }

        .services-main-section .service-image {
            height: 350px !important;
        }

        .services-main-section .main-feature-image {
            height: 400px !important;
            margin-bottom: 60px !important;
        }

        .services-main-section .service-item-title {
            font-size: 1.9rem !important;
            text-align: center !important;
        }

        .services-main-section .service-details-list li {
            padding-left: 35px !important;
            text-align: left !important;
        }

        .services-main-section .service-item-right .service-details-list li {
            padding-right: 0 !important;
            padding-left: 35px !important;
            text-align: left !important;
        }

        .services-main-section .service-item-right .service-details-list li::before {
            left: 0 !important;
            right: auto !important;
        }

        .services-main-section .services-title {
            font-size: 2.5rem !important;
        }
    }

    @media (max-width: 768px) {
        .services-main-section {
            padding: 60px 0 !important;
        }

        .services-main-section .services-title {
            font-size: 2.2rem !important;
        }

        .services-main-section .services-intro {
            font-size: 1rem !important;
        }

        .services-main-section .main-feature-image {
            height: 350px !important;
            margin-bottom: 50px !important;
        }

        .services-main-section .service-item-title {
            font-size: 1.7rem !important;
        }

        .services-main-section .service-image {
            height: 300px !important;
        }

        .services-main-section .service-detail-title {
            font-size: 1.2rem !important;
        }
    }

    @media (max-width: 480px) {
        .services-main-section .services-title {
            font-size: 1.9rem !important;
        }

        .services-main-section .main-feature-image {
            height: 280px !important;
        }

        .services-main-section .service-item-title {
            font-size: 1.5rem !important;
        }

        .services-main-section .service-image {
            height: 250px !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fadeElements = document.querySelectorAll('.fade-in');

        const fadeInOnScroll = () => {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 100;

                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        };

        // Initial check
        fadeInOnScroll();

        // Check on scroll
        window.addEventListener('scroll', fadeInOnScroll);
    });
    const v = document.getElementById('serviceVideo');


</script>