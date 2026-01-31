<style>
	/* Hero Section matching Our Approach style */
	.profile-hero {
		background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
		padding: 80px 20px;
		text-align: center;
		position: relative;
		overflow: hidden;
		margin-bottom: 0;
	}

	.profile-hero::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
		opacity: 0.3;
	}

	.profile-hero h1 {
		font-size: 3.5rem;
		font-weight: 800;
		color: #fff;
		margin: 0 0 10px;
		position: relative;
		z-index: 1;
		text-transform: uppercase;
		letter-spacing: 3px;
	}

	.profile-hero p {
		font-size: 1.2rem;
		color: rgba(255, 255, 255, 0.8);
		max-width: 800px;
		margin: 0 auto;
		line-height: 1.5;
		position: relative;
		z-index: 1;
	}



	/* Vision & Mission Layout */
	.vision-mission-section {
		padding: 100px 0;
		background: #fff;
	}

	.alternating-flex {
		display: flex;
		align-items: center;
		gap: 80px;
		margin-bottom: 120px;
		flex-wrap: wrap;
	}

	.alternating-flex:last-child {
		margin-bottom: 0;
	}

	.flex-img {
		flex: 1;
		min-width: 350px;
	}

	.flex-img img {
		width: 100%;
		border-radius: 4px;
		box-shadow: 15px 15px 30px rgba(0, 0, 0, 0.1);
		transition: 0.5s;
	}

	.flex-img:hover img {
		transform: scale(1.02);
		box-shadow: 20px 20px 40px rgba(0, 0, 0, 0.15);
	}

	.flex-text {
		flex: 1;
		min-width: 350px;
	}

	.flex-text h3 {
		font-size: 2.5rem;
		font-weight: 800;
		color: #000;
		margin-bottom: 25px;
		position: relative;
	}

	.flex-text h3::after {
		content: '';
		position: absolute;
		bottom: -10px;
		left: 0;
		width: 100px;
		height: 4px;
		background: #000;
	}

	.flex-text p {
		font-size: 1.15rem;
		color: #444;
		line-height: 1.8;
	}

	/* Values Grid Section */
	.values-section {
		padding: 100px 0;
		background: #f9f9f9;
		text-align: center;
	}

	.values-section h2 {
		font-size: 3rem;
		font-weight: 800;
		color: #000;
		margin-bottom: 60px;
	}

	.values-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
		gap: 25px;
	}

	.value-card {
		background: #fff;
		padding: 40px;
		border: 1px solid #eee;
		text-align: left;
		transition: 0.4s;
	}

	.value-card:hover {
		background: #000;
		transform: translateY(-8px);
	}

	.value-card h4 {
		font-size: 1.4rem;
		font-weight: 700;
		color: #000;
		margin-bottom: 15px;
		transition: 0.4s;
	}

	.value-card p {
		font-size: 0.95rem;
		color: #666;
		line-height: 1.6;
		transition: 0.4s;
	}

	.value-card:hover h4,
	.value-card:hover p {
		color: #fff;
	}

	/* Testimonial Quote Section */
	.testimonial-area {
		padding: 60px 0;
		background: url('./img/cprofile3.jpg') no-repeat center center;
		background-size: cover;
		position: relative;
		text-align: center;
	}

	.testimonial-area::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgba(0, 0, 0, 0.8);
	}

	.testimonial-container {
		position: relative;
		z-index: 1;
		max-width: 800px;
		margin: 0 auto;
		color: #fff;
	}

	.testimonial-area p {
		font-size: 1.1rem;
		font-style: italic;
		line-height: 1.6;
		opacity: 0.85;
	}

	.testimonial-area i {
		font-size: 1.5rem;
		margin-bottom: 15px;
		color: rgba(255, 255, 255, 0.2);
	}

	@media (max-width: 768px) {
		.profile-hero h1 {
			font-size: 2.5rem;
		}

		.flex-text h3 {
			font-size: 2rem;
		}

		.alternating-flex {
			gap: 40px;
			margin-bottom: 60px;
		}

		.alternating-flex:nth-child(even) .flex-img {
			order: -1;
		}
	}
</style>

<!-- Hero Section -->
<section class="profile-hero">
	<div class="container">
		<h1>Company Profile</h1>
		<p>Welcome to Nautical Fix Solutions' Company Profile. Get to know our vision, mission, and core values that
			guide us in the maritime industry.</p>
	</div>
</section>



<!-- Vision & Mission -->
<section class="vision-mission-section">
	<div class="container">
		<!-- Vision -->
		<div class="alternating-flex">
			<div class="flex-img">
				<img src="./img/cprofile2.jpg" alt="Our Vision">
			</div>
			<div class="flex-text">
				<h3>OUR VISION</h3>
				<p>
					At Nautical Fix Solutions, we envision a maritime industry that is safer, more efficient, and
					environmentally responsible. We strive to lead the way in ship repair and maintenance, setting new
					standards and pushing the boundaries of what's possible.
				</p>
			</div>
		</div>

		<!-- Mission -->
		<div class="alternating-flex" style="flex-direction: row-reverse;">
			<div class="flex-img">
				<img src="./img/cprofile1.jpg" alt="Our Mission">
			</div>
			<div class="flex-text" style="text-align: right;">
				<h3 style="display: inline-block;">OUR MISSION</h3>
				<p>
					Our mission is to provide exceptional ship repair, drydock, and onboard services that empower our
					clients to navigate the seas with confidence. We are committed to ensuring the reliability,
					sustainability, and longevity of maritime assets.
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Values Section -->
<section class="values-section">
	<div class="container">
		<h2>OUR CORE VALUES</h2>
		<div class="values-grid">
			<div class="value-card">
				<h4>Integrity</h4>
				<p>We operate with the highest level of integrity, honesty, and transparency. Trust is the foundation of
					our client relationships.</p>
			</div>
			<div class="value-card">
				<h4>Excellence</h4>
				<p>We relentlessly pursue excellence in every project, adhering to the strictest quality and safety
					standards.</p>
			</div>
			<div class="value-card">
				<h4>Innovation</h4>
				<p>We embrace innovation and technology to continuously improve our services, making them more efficient
					and eco-friendly.</p>
			</div>
			<div class="value-card">
				<h4>Compliance</h4>
				<p>We adhere to all relevant industry regulations and standards, ensuring that every project is legally
					and ethically sound.</p>
			</div>
			<div class="value-card">
				<h4>Customer-Centric</h4>
				<p>Our clients are our partners, and we place them at the center of our operations. We listen,
					understand, and deliver to exceed expectations.</p>
			</div>
			<div class="value-card">
				<h4>Environmental Responsibility</h4>
				<p>We are committed to reducing our ecological footprint and promoting sustainability in the maritime
					industry.</p>
			</div>
			<div class="value-card">
				<h4>Teamwork</h4>
				<p>Our success is the result of our dedicated and skilled team, working together to achieve the best
					outcomes.</p>
			</div>
		</div>
	</div>
</section>

<!-- Final Quote -->
<section class="testimonial-area">
	<div class="container">
		<div class="testimonial-container">
			<i class="fas fa-quote-left"></i>
			<p>Nautical Fix Solutions' Company Profile reflects our dedication to excellence, innovation, and
				environmental responsibility. These core elements - our vision, mission, and values - drive us to serve
				the maritime industry with the utmost commitment and integrity.</p>
		</div>
	</div>
</section>