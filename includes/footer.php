<?php
// footer.php
?>
</main>

<!-- 🌙 MODERN FOOTER -->
<footer class="mt-auto">
  <div class="container">
    <div class="row align-items-center py-3">
      <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
        <h5 class="mb-2" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">
          <i class="bi bi-book-half"></i> Readers' Haven
        </h5>
        <p class="mb-0 small text-muted">Your Literary Sanctuary</p>
      </div>
      
      <div class="col-md-4 text-center mb-3 mb-md-0">
        <p class="mb-0">
          <i class="bi bi-heart-fill text-danger"></i> Made with passion for book lovers
        </p>
        <p class="mb-0 small mt-1">
          © <?php echo date('Y'); ?> All Rights Reserved
        </p>
      </div>
      
      <div class="col-md-4 text-center text-md-end">
        <div class="social-links">
          <a href="https://www.facebook.com/areeb0055" target="_blank" class="text-decoration-none me-3" title="Facebook">
            <i class="bi bi-facebook fs-4"></i>
          </a>
          <a href="https://twitter.com/areeb10031" target="_blank" class="text-decoration-none me-3" title="Twitter">
            <i class="bi bi-twitter fs-4"></i>
          </a>  
          <a href="https://www.instagram.com/areeb.xdd/" target="_blank" class="text-decoration-none me-3" title="Instagram">
            <i class="bi bi-instagram fs-4"></i>
          </a>
          <a href="https://github.com/Areeb005" target="_blank" class="text-decoration-none" title="GitHub">
            <i class="bi bi-github fs-4"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<style>
  .social-links a {
    color: #ecf0f1;
    transition: all 0.3s ease;
    display: inline-block;
  }
  
  .social-links a:hover {
    transform: translateY(-5px) scale(1.1);
    color: #3498db;
  }
</style>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Smooth Scroll Animation -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
    
    // Animate elements on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);
    
    document.querySelectorAll('.card, .alert').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(el);
    });
  });
</script>
</body>
</html>
