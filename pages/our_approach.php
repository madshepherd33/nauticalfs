<style>
	/* Hero Section matching Services.php style */
	.approach-hero {
		background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
		padding: 80px 20px;
		text-align: center;
		position: relative;
		overflow: hidden;
		margin-bottom: 0;
	}

	.approach-hero::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
		opacity: 0.3;
	}

	.approach-hero h1 {
		font-size: 3.5rem;
		font-weight: 800;
		color: #fff;
		margin: 0 0 20px;
		position: relative;
		z-index: 1;
		text-transform: uppercase;
		letter-spacing: 3px;
	}

	.approach-hero p {
		font-size: 1.25rem;
		color: rgba(255, 255, 255, 0.8);
		max-width: 800px;
		margin: 0 auto;
		line-height: 1.6;
		position: relative;
		z-index: 1;
	}

	/* Main Content Styling */
	.approach-intro {
		padding: 100px 0;
		background: #fff;
	}

	.intro-flex {
		display: flex;
		align-items: center;
		gap: 60px;
		flex-wrap: wrap;
	}

	.intro-image {
		flex: 1;
		min-width: 300px;
		position: relative;
	}

	.intro-image img {
		width: 100%;
		border-radius: 4px;
		box-shadow: 20px 20px 0px #000;
		transition: 0.5s;
	}

	.intro-image:hover img {
		transform: translate(10px, 10px);
		box-shadow: 10px 10px 0px #333;
	}

	.intro-text {
		flex: 1;
		min-width: 300px;
	}

	.intro-text h2 {
		font-size: 2.5rem;
		font-weight: 700;
		color: #000;
		margin-bottom: 30px;
		position: relative;
	}

	.intro-text h2::after {
		content: '';
		position: absolute;
		bottom: -10px;
		left: 0;
		width: 60px;
		height: 3px;
		background: #000;
	}

	.intro-text p {
		font-size: 1.1rem;
		color: #444;
		line-height: 1.8;
	}

	/* Steps Grid */
	.approach-steps {
		padding: 100px 0;
		background: #f9f9f9;
	}

	.steps-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
		gap: 30px;
	}

	.step-card {
		background: #fff;
		padding: 50px;
		border: 1px solid #eee;
		transition: all 0.4s ease;
		position: relative;
		overflow: hidden;
	}

	.step-card:hover {
		background: #000;
		transform: translateY(-10px);
		border-color: #000;
	}

	.step-number {
		font-size: 4rem;
		font-weight: 900;
		color: rgba(0, 0, 0, 0.05);
		position: absolute;
		top: 10px;
		right: 20px;
		transition: 0.4s;
	}

	.step-card:hover .step-number {
		color: rgba(255, 255, 255, 0.1);
	}

	.step-card h3 {
		font-size: 1.5rem;
		font-weight: 700;
		color: #000;
		margin-bottom: 20px;
		transition: 0.4s;
	}

	.step-card p {
		font-size: 1rem;
		color: #666;
		line-height: 1.7;
		transition: 0.4s;
	}

	.step-card:hover h3,
	.step-card:hover p {
		color: #fff;
	}

	/* Final CTA Area */
	.approach-footer {
		padding: 60px 0;
		background: url('./img/ourapproach2.jpg') no-repeat center center;
		background-size: cover;
		position: relative;
		text-align: center;
		color: #fff;
	}

	.approach-footer::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgba(0, 0, 0, 0.85);
	}

	.footer-content {
		position: relative;
		z-index: 1;
		max-width: 900px;
		margin: 0 auto;
	}

	.footer-content h3 {
		font-size: 1.4rem;
		font-weight: 500;
		line-height: 1.5;
		margin-bottom: 25px;
		color: #fff;
	}

	.btn-submit-modern {
		display: inline-block;
		padding: 12px 30px;
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
		font-size: 13px;
		text-decoration: none;
	}

	.btn-submit-modern:hover {
		background: #000;
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
	}

	@media (max-width: 768px) {
		.approach-hero h1 {
			font-size: 2.2rem;
		}

		.intro-text h2 {
			font-size: 2rem;
		}

		.step-card {
			padding: 30px;
		}
	}
</style>

<!-- Hero Section -->
<section class="approach-hero">
	<div class="container">
		<h1>Our Approach</h1>
		<p>Built on a foundation of expertise, dedication, and innovation to
			ensure your fleet's excellence.</p>
	</div>
</section>

<!-- Introduction Section -->
<section class="approach-intro">
	<div class="container">
		<div class="intro-flex">
			<div class="intro-image">
				<img src="./img/ourapproach1.jpg" alt="Our Approach Professional"
					style="filter: contrast(120%) saturate(110%);">
			</div>
			<div class="intro-text">
				<h2>OUR PHILOSOPHY</h2>
				<p>
					In this section, we'd like to introduce you to Nautical Fix Solutions' unique approach to ship
					repair and maintenance. Our approach is built on a foundation of expertise, dedication, and
					innovation. We don't just fix ships; we engineer long-term reliability for your maritime operations.
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Steps Grid Section -->
<section class="approach-steps">
	<div class="container">
		<div class="steps-grid">
			<!-- Step 1 -->
			<div class="step-card">
				<span class="step-number">01</span>
				<h3>Customer-Centric Philosophy</h3>
				<p>
					At Nautical Fix Solutions, we place our customers at the core of everything we do. Our approach
					begins with a deep understanding of your needs and challenges. We believe in forging strong
					partnerships with our clients to ensure that their expectations are not only met but exceeded.
				</p>
			</div>

			<!-- Step 2 -->
			<div class="step-card">
				<span class="step-number">02</span>
				<h3>Exceptional Quality</h3>
				<p>
					We are committed to delivering top-notch ship repair services. Our team of experienced professionals
					takes pride in their work, and we stand behind the quality of every project we undertake. Safety,
					precision, and quality are the pillars of our approach.
				</p>
			</div>

			<!-- Step 3 -->
			<div class="step-card">
				<span class="step-number">03</span>
				<h3>Sustainability and Environment</h3>
				<p>
					In today's world, environmental responsibility is more critical than ever. We integrate sustainable
					practices into our approach to minimize the environmental impact of ship repair and maintenance. We
					are committed to a greener future for the maritime industry.
				</p>
			</div>

			<!-- Step 4 -->
			<div class="step-card">
				<span class="step-number">04</span>
				<h3>Innovation and Technology</h3>
				<p>
					We stay at the forefront of the industry by embracing the latest technologies and innovative
					solutions. Our approach includes a continuous drive for improvement and efficiency in ship repair
					processes to save you time and cost.
				</p>
			</div>

			<!-- Step 5 -->
			<div class="step-card">
				<span class="step-number">05</span>
				<h3>Tailored Solutions</h3>
				<p>
					No two ships are the same, and we understand that each vessel requires a unique approach. We offer
					tailored solutions to address the specific needs of your fleet, ensuring custom-fit excellence for
					every project.
				</p>
			</div>

			<!-- Step 6 -->
			<div class="step-card">
				<span class="step-number">06</span>
				<h3>Collaborative Partnerships</h3>
				<p>
					Nautical Fix Solutions is not just a service provider; we are your partners in ensuring the
					longevity and performance of your vessels. Our collaborative approach fosters trust, transparency,
					and reliability.
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Final Section -->
<section class="approach-footer">
	<div class="container">
		<div class="footer-content">
			<h3>At Nautical Fix Solutions, our approach isn't just about repairing ships; it's about building lasting
				relationships and ensuring the smooth operation of your maritime assets.</h3>
			<a href="index.php?f=our_work" class="btn-submit-modern">Explore Our Work</a>
		</div>
	</div>
</section>