<?php include 'includes/header.php'; ?>

<!-- Hero Section with Modern Design -->
<div class="container py-5">
  
  <!-- Main Hero Card -->
  <div class="row align-items-center justify-content-center mb-5">
    <div class="col-lg-10">
      <div class="card hero-card p-5 text-center position-relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="hero-bg-decoration"></div>
        
        <div class="position-relative z-index-2">
          <!-- Animated Icon -->
          <div class="hero-icon mb-4">
            <i class="bi bi-book-half display-1"></i>
          </div>
          
          <!-- Main Heading -->
          <h1 class="display-3 fw-bold mb-3 hero-title">
            Welcome to <span class="text-gradient">Readers' Haven</span>
          </h1>
          
          <!-- Subtitle -->
          <p class="lead text-muted mb-4 fs-4">
            <i class="bi bi-stars text-warning"></i>
            Discover, Explore, and Manage Your Literary World
            <i class="bi bi-stars text-warning"></i>
          </p>
          
          <!-- Feature Badges -->
          <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
            <span class="badge feature-badge">
              <i class="bi bi-lightning-charge"></i> Fast & Efficient
            </span>
            <span class="badge feature-badge">
              <i class="bi bi-shield-check"></i> Secure Storage
            </span>
            <span class="badge feature-badge">
              <i class="bi bi-search"></i> Smart Search
            </span>
            <span class="badge feature-badge">
              <i class="bi bi-palette"></i> Beautiful UI
            </span>
          </div>
          
          <!-- Call to Action Buttons -->
          <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mt-4">
            <a href="books.php" class="btn btn-lg btn-primary px-5 py-3 shadow-lg">
              <i class="bi bi-book"></i> Browse Books
            </a>
            <a href="add_book.php" class="btn btn-lg btn-outline-success px-5 py-3 shadow">
              <i class="bi bi-plus-circle"></i> Add a Book
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Feature Cards Section -->
  <div class="row g-4 mt-4">
    
    <!-- Feature 1 -->
    <div class="col-md-4">
      <div class="card feature-card h-100 text-center p-4 border-0">
        <div class="feature-icon mb-3">
          <i class="bi bi-collection display-4"></i>
        </div>
        <h4 class="fw-bold mb-3">Extensive Collection</h4>
        <p class="text-muted">
          Build and manage your personal library with ease. Add unlimited books and organize them your way.
        </p>
      </div>
    </div>
    
    <!-- Feature 2 -->
    <div class="col-md-4">
      <div class="card feature-card h-100 text-center p-4 border-0">
        <div class="feature-icon mb-3">
          <i class="bi bi-pencil-square display-4"></i>
        </div>
        <h4 class="fw-bold mb-3">Easy Management</h4>
        <p class="text-muted">
          Update book details, prices, and categories effortlessly. Full CRUD operations at your fingertips.
        </p>
      </div>
    </div>
    
    <!-- Feature 3 -->
    <div class="col-md-4">
      <div class="card feature-card h-100 text-center p-4 border-0">
        <div class="feature-icon mb-3">
          <i class="bi bi-graph-up-arrow display-4"></i>
        </div>
        <h4 class="fw-bold mb-3">Track Your Inventory</h4>
        <p class="text-muted">
          Monitor your book collection with advanced search and filtering. Stay organized and efficient.
        </p>
      </div>
    </div>
    
  </div>
  
  <!-- Stats Section -->
  <div class="row mt-5">
    <div class="col-12">
      <div class="card stats-card p-4">
        <div class="row text-center g-4">
          <div class="col-md-3 col-6">
            <div class="stat-item">
              <i class="bi bi-book-fill display-4 text-primary mb-2"></i>
              <h3 class="fw-bold mb-0">Unlimited</h3>
              <p class="text-muted mb-0">Books</p>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="stat-item">
              <i class="bi bi-people-fill display-4 text-success mb-2"></i>
              <h3 class="fw-bold mb-0">Authors</h3>
              <p class="text-muted mb-0">Worldwide</p>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="stat-item">
              <i class="bi bi-tags-fill display-4 text-warning mb-2"></i>
              <h3 class="fw-bold mb-0">Categories</h3>
              <p class="text-muted mb-0">All Genres</p>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="stat-item">
              <i class="bi bi-star-fill display-4 text-danger mb-2"></i>
              <h3 class="fw-bold mb-0">Premium</h3>
              <p class="text-muted mb-0">Experience</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>

<!-- Custom Styles for Homepage -->
<style>
  .hero-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 248, 255, 0.95) 100%);
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border-radius: 30px;
    position: relative;
    overflow: hidden;
  }
  
  .hero-bg-decoration {
    position: absolute;
    top: -50%;
    right: -20%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
  }
  
  @keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(-20px, -20px) rotate(180deg); }
  }
  
  .hero-icon i {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: pulse 2s ease-in-out infinite;
  }
  
  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
  }
  
  .hero-title {
    animation: slideInDown 0.8s ease-out;
  }
  
  @keyframes slideInDown {
    from {
      opacity: 0;
      transform: translateY(-30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .feature-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 10px 20px;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 25px;
    transition: all 0.3s ease;
  }
  
  .feature-badge:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
  }
  
  .feature-card {
    transition: all 0.4s ease;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
  }
  
  .feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
  }
  
  .feature-icon i {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease;
  }
  
  .feature-card:hover .feature-icon i {
    transform: scale(1.1) rotate(5deg);
  }
  
  .stats-card {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  }
  
  .stat-item {
    transition: all 0.3s ease;
  }
  
  .stat-item:hover {
    transform: scale(1.05);
  }
  
  .stat-item i {
    transition: all 0.3s ease;
  }
  
  .stat-item:hover i {
    transform: translateY(-5px);
  }
  
  .z-index-2 {
    z-index: 2;
    position: relative;
  }
  
  /* Responsive adjustments */
  @media (max-width: 768px) {
    .display-3 {
      font-size: 2.5rem;
    }
    
    .hero-bg-decoration {
      width: 300px;
      height: 300px;
    }
  }
</style>

<?php include 'includes/footer.php'; ?>
