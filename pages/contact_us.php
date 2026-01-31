<?php
// 1. FORM GÖNDERME MANTIĞI
if (isset($_POST['submit_contact'])) {
    $to = "info@nauticalfs.com";
    $name = htmlspecialchars($_POST['customer_name']);
    $email = htmlspecialchars($_POST['customer_email']);
    $company = htmlspecialchars($_POST['customer_company']);
    $message = htmlspecialchars($_POST['customer_message']);

    $subject = "Contact Form: " . $name;
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $body = "New message from contact form:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Company: $company\n\n";
    $body .= "Message:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Your message has been sent successfully!'); window.location.href='index.php?f=contact_us';</script>";
    } else {
        echo "<script>alert('Error: Message could not be sent.');</script>";
    }
}
?>

<style>
    /* Hero Section - Matching Services & Our Work */
    .contact-hero {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        padding: 60px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 0;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .contact-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
        margin: 0;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* Card Styles */
    .info-card {
        padding: 40px;
        border: 1px solid #eee;
        background: #fff;
        transition: all 0.4s ease;
        box-sizing: border-box;
        width: 100%;
        position: relative;
    }

    .info-card:hover {
        transform: translateY(-8px);
        border-color: #000;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .card-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
        text-align: center;
        color: #000;
    }

    /* Contact Links */
    .contact-link {
        color: #000;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .contact-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -2px;
        left: 0;
        background: #000;
        transition: width 0.3s;
    }

    .contact-link:hover::after {
        width: 100%;
    }

    /* Copy Button */
    .copy-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        color: #666;
        font-size: 0.9rem;
        margin-left: 8px;
        transition: all 0.3s ease;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .copy-btn:hover {
        background: #f0f0f0;
        color: #000;
    }

    .copy-btn.copied {
        color: #28a745;
    }

    /* WhatsApp Button */
    .whatsapp-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #25D366;
        color: #fff;
        padding: 12px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        margin-top: 10px;
    }

    .whatsapp-btn:hover {
        background: #128C7E;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        color: #fff;
    }

    .whatsapp-btn i {
        font-size: 1.3rem;
    }

    /* Map Section */
    .map-section {
        padding: 70px 0;
        background: #fff;
    }

    .map-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .map-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .map-header h2 {
        font-size: 2.2rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .map-wrapper {
        position: relative;
        width: 100%;
        padding-bottom: 40%;
        height: 0;
        overflow: hidden;
    }

    .map-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Form Styles */
    .btn-submit {
        background: #000;
        color: #fff;
        width: 240px;
        height: 60px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .btn-submit:hover {
        background: #333;
        letter-spacing: 2px;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .form-item-custom {
        width: 100%;
        padding: 18px;
        border: 1px solid #e0e0e0;
        background: #fcfcfc;
        margin-bottom: 20px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .form-item-custom:focus {
        outline: none;
        border-color: #000;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
    }

    /* Success Notification */
    .success-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: #fff;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        display: none;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Social Media Section */
    .social-section {
        text-align: center;
        padding: 30px 0;
        border-top: 1px solid #eee;
        margin-top: 20px;
    }

    .social-section h4 {
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        color: #000;
    }

    .social-links {
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border: 2px solid #000;
        border-radius: 50%;
        color: #000;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }

    .social-link:hover {
        background: #000;
        color: #fff;
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .grid-mobile {
            grid-template-columns: 1fr !important;
            padding: 0 10px !important;
        }

        .map-wrapper {
            padding-bottom: 60%;
        }

        .container {
            padding: 0 15px !important;
        }

        .info-card {
            padding: 30px 20px;
        }

        .contact-hero h1 {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .contact-hero {
            padding: 40px 20px;
        }

        .whatsapp-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <h1>Contact Us</h1>
    </div>
</section>

<section style="padding: 70px 0; text-align: center;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 100px;">
        <div class="grid-mobile" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <!-- Addresses Card -->
            <div class="info-card" style="text-align: left;">
                <div class="card-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h3
                    style="font-size: 1.1rem; margin-bottom: 20px; text-transform: uppercase; text-align: center; color: #000;">
                    Addresses</h3>
                <p style="font-size: 0.95rem;"><strong>Head Quarters:</strong><br>Çiftlik mahallesi Yalova İzmit
                    Karayolu Caddesi Koçlar 114A İçkapı No:18 Çiftlikköy, Yalova</p>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                <p style="font-size: 0.95rem;"><strong>Workshop Address:</strong><br>Çavuşçiftliği Köyü, Tersaneler
                    mevkii, Emek Sokak No:31/1 Altınova, Yalova</p>
            </div>

            <!-- Contact Card -->
            <div class="info-card">
                <div class="card-icon"><i class="fas fa-headset"></i></div>
                <h3 style="font-size: 1.1rem; margin-bottom: 20px; text-transform: uppercase; color: #000;">Contact</h3>
                <p style="font-size: 0.95rem;">
                    <strong>Eng. Tarkan Büyükoral</strong><br>
                    <a href="tel:+905319248098" class="contact-link">+90 531 924 80 98</a>
                    <button class="copy-btn" onclick="copyToClipboard('+905319248098', this)" title="Copy">
                        <i class="far fa-copy"></i>
                    </button>
                </p>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                <p style="font-size: 0.95rem;">
                    <strong>Eng. Ahmet Aytekin</strong><br>
                    <a href="tel:+905303247251" class="contact-link">+90 530 324 72 51</a>
                    <button class="copy-btn" onclick="copyToClipboard('+905303247251', this)" title="Copy">
                        <i class="far fa-copy"></i>
                    </button>
                </p>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                <p style="font-size: 0.95rem;">
                    <strong>Eng. Ahmet Okan Çayır</strong><br>
                    <a href="tel:+905362974248" class="contact-link">+90 536 297 42 48</a>
                    <button class="copy-btn" onclick="copyToClipboard('+905362974248', this)" title="Copy">
                        <i class="far fa-copy"></i>
                    </button>
                </p>

                <!-- WhatsApp Button -->
                <a href="https://wa.me/905319248098" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i>
                    <span>Chat on WhatsApp</span>
                </a>
            </div>

            <!-- Support Card -->
            <div class="info-card">
                <div class="card-icon"><i class="fas fa-envelope"></i></div>
                <h3 style="font-size: 1.1rem; margin-bottom: 20px; text-transform: uppercase; color: #000;">Support</h3>
                <div style="margin-bottom: 15px;">
                    <a href="mailto:info@nauticalfs.com" class="contact-link">info@nauticalfs.com</a>
                    <button class="copy-btn" onclick="copyToClipboard('info@nauticalfs.com', this)" title="Copy">
                        <i class="far fa-copy"></i>
                    </button>
                </div>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                <div style="margin-bottom: 15px;">
                    <a href="mailto:technical@nauticalfs.com" class="contact-link">technical@nauticalfs.com</a>
                    <button class="copy-btn" onclick="copyToClipboard('technical@nauticalfs.com', this)" title="Copy">
                        <i class="far fa-copy"></i>
                    </button>
                </div>

                <!-- Social Media Section -->
                <div class="social-section">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/company/nautical-fix-solutions-inc" target="_blank"
                            class="social-link" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="map-container">
        <div class="map-header">
            <h2>Our Location</h2>
            <div style="width: 50px; height: 3px; background: #000; margin: 0 auto;"></div>
        </div>
        <div class="map-card">
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.776957535536!2d29.473668374924948!3d40.70090963829621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cb1f24cf682043%3A0x746a3aae962d6a8a!2sNautical%20Fix%20Solutions%20Gemi%20Bak%C4%B1m%20Onar%C4%B1m%20Sanayi%20ve%20Ticaret%20Limited%20%C5%9Eirketi!5e0!3m2!1str!2str!4v1767970268076!5m2!1str!2str"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

<section style="padding: 60px 0; background: #fff;">
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; font-weight: 800; text-transform: uppercase;">Get in Touch</h2>
        </div>
        <form method="POST" action="">
            <div class="grid-mobile" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <input type="text" name="customer_name" placeholder="Full Name" class="form-item-custom" required>
                <input type="email" name="customer_email" placeholder="Email Address" class="form-item-custom" required>
            </div>
            <input type="text" name="customer_company" placeholder="Company Name" class="form-item-custom">
            <textarea name="customer_message" placeholder="How can we help you?" class="form-item-custom"
                style="height: 160px;" required></textarea>
            <div style="text-align: center;">
                <button type="submit" name="submit_contact" class="btn-submit">Send Message</button>
            </div>
        </form>
    </div>
</section>

<!-- Success Notification -->
<div id="successNotification" class="success-notification">
    <i class="fas fa-check-circle" style="margin-right: 10px;"></i>
    <span id="notificationText">Copied to clipboard!</span>
</div>

<script>
    document.title = "Contact Us - Nautical Fix Solutions";

    // Copy to Clipboard Function
    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(function () {
            // Show success feedback
            const icon = button.querySelector('i');
            const originalClass = icon.className;

            // Change icon to checkmark
            icon.className = 'fas fa-check';
            button.classList.add('copied');

            // Show notification
            showNotification('Copied to clipboard!');

            // Reset after 2 seconds
            setTimeout(function () {
                icon.className = originalClass;
                button.classList.remove('copied');
            }, 2000);
        }).catch(function (err) {
            console.error('Failed to copy: ', err);
            showNotification('Failed to copy', true);
        });
    }

    // Show Notification
    function showNotification(message, isError = false) {
        const notification = document.getElementById('successNotification');
        const notificationText = document.getElementById('notificationText');

        notificationText.textContent = message;
        notification.style.background = isError ? '#dc3545' : '#28a745';
        notification.style.display = 'block';

        setTimeout(function () {
            notification.style.display = 'none';
        }, 3000);
    }

    // Form submission success notification
    <?php if (isset($_POST['submit_contact']) && mail($to, $subject, $body, $headers)): ?>
        window.addEventListener('load', function () {
            showNotification('Message sent successfully!');
        });
    <?php endif; ?>
</script>