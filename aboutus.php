<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us – NELFund</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f9f7;
      margin: 0;
      padding: 0;
    }
    header {
      background: linear-gradient(to right, #1e7e34, #28a745);
      color: white;
      padding: 60px 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    header h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    header p {
      font-size: 1.2rem;
      opacity: 0.9;
    }

    .section {
      padding: 60px 20px;
    }

    .card-icon {
      font-size: 3rem;
      color: #28a745;
      margin-bottom: 15px;
    }

    .feature-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-8px);
    }

    .team-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      text-align: center;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .team-card:hover {
      transform: translateY(-5px);
    }

    .team-card img {
      width: 100%;
      height: 280px;
      object-fit: cover;
    }

    .team-card h5 {
      margin: 15px 0 5px;
      font-weight: bold;
    }

    footer {
      background: #155724;
      color: white;
      text-align: center;
      padding: 25px 10px;
      margin-top: 60px;
    }

    @media (max-width: 767px) {
      header h1 {
        font-size: 2.2rem;
      }
    }
  </style>
</head>
<body>

<header data-aos="fade-down">
  <div class="container">
    <h1><i class="fas fa-hand-holding-usd"></i> About NCGFund</h1>
    <p><bolder>National Credit Grant Fund</bolder> is focused on Empowering dreams. Supporting innovation. Building a better future for Nigeria.</p>
  </div>
</header>

<section class="section bg-light" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="mb-5 text-success">What We Do</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card" data-aos="zoom-in">
          <div class="card-icon"><i class="fas fa-lightbulb"></i></div>
          <h5>Empowering Innovators</h5>
          <p>We support creative minds across Nigeria with the funding and mentorship they need to bring bold ideas to life.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card" data-aos="zoom-in" data-aos-delay="100">
          <div class="card-icon"><i class="fas fa-chart-line"></i></div>
          <h5>Fostering Growth</h5>
          <p>NCGFund invests in ideas that drive economic growth, from startups to community projects, across all sectors.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card" data-aos="zoom-in" data-aos-delay="200">
          <div class="card-icon"><i class="fas fa-users"></i></div>
          <h5>Inclusive Support</h5>
          <p>We are committed to empowering youth, women, and underserved communities with equal access to funding opportunities.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="mb-5 text-success">Our Vision</h2>
    <p class="lead">To be Nigeria’s leading funding platform that empowers individuals and organizations to drive sustainable impact through innovation, entrepreneurship, and creativity.</p>
  </div>
</section>

<section class="py-5 bg-light" data-aos="fade-up">
  <div class="container text-center">
    <h2 class="mb-4 text-success fw-bold"><i class="fas fa-users-cog me-2"></i>Meet the Stakeholders</h2>
    <p class="mb-5 text-muted">Our ecosystem brings together essential players in transforming the future of education and employment in Nigeria.</p>

    <div class="row g-4">

      <!-- Students -->
      <div class="col-md-6 col-lg-3">
        <div class="stakeholder-card p-4 shadow-sm rounded bg-white h-100" data-aos="zoom-in">
          <div class="mb-3">
            <i class="fas fa-user-graduate fa-3x text-success"></i>
          </div>
          <h5 class="fw-semibold">Students</h5>
          <p class="text-muted small">Empowered through accessible educational funding and skill development.</p>
        </div>
      </div>

      <!-- Nigerian Education Fund -->
      <div class="col-md-6 col-lg-3">
        <div class="stakeholder-card p-4 shadow-sm rounded bg-white h-100" data-aos="zoom-in" data-aos-delay="100">
          <div class="mb-3">
            <i class="fas fa-university fa-3x text-success"></i>
          </div>
          <h5 class="fw-semibold">Nigerian Education Fund</h5>
          <p class="text-muted small">Provides financial support and policy alignment to drive national education goals.</p>
        </div>
      </div>

      <!-- Employers -->
      <div class="col-md-6 col-lg-3">
        <div class="stakeholder-card p-4 shadow-sm rounded bg-white h-100" data-aos="zoom-in" data-aos-delay="200">
          <div class="mb-3">
            <i class="fas fa-briefcase fa-3x text-success"></i>
          </div>
          <h5 class="fw-semibold">Employers</h5>
          <p class="text-muted small">Offer internship, mentorship, and career opportunities to trained graduates.</p>
        </div>
      </div>

      <!-- Government -->
      <div class="col-md-6 col-lg-3">
        <div class="stakeholder-card p-4 shadow-sm rounded bg-white h-100" data-aos="zoom-in" data-aos-delay="300">
          <div class="mb-3">
            <i class="fas fa-landmark fa-3x text-success"></i>
          </div>
          <h5 class="fw-semibold">Government Agencies</h5>
          <p class="text-muted small">Regulate and support the framework that enables sustainable growth.</p>
        </div>
      </div>

    </div>
  </div>
</section>



<footer>
  <p>&copy; <?= date("Y") ?> NCGFund – Nigeria Creative Growth Fund. All rights reserved.</p>
</footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ duration: 1000, once: true });</script>
</body>
</html>

