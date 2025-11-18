<?php include 'includes/header.php'; ?>
<?php include 'includes/db_connect.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
          <h2 class="text-center mb-4 fw-bold text-success">
            <i class="bi bi-plus-circle"></i> Add a New Book
          </h2>

          <?php
          $message = '';
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $title = trim($_POST['title']);
              $author = trim($_POST['author']);
              $price = trim($_POST['price']);
              $category = trim($_POST['category']);

              if ($title && $author && $price && $category) {
                  if (is_numeric($price)) {
                      $sql = "INSERT INTO books (title, author, price, category) VALUES ('$title','$author','$price','$category')";
                      if (mysqli_query($conn, $sql)) {
                          $message = "<div class='alert alert-success text-center shadow-sm fade show'>
                                      <i class='bi bi-check-circle'></i> Book added successfully!
                                      </div>";
                      } else {
                          $message = "<div class='alert alert-danger text-center shadow-sm fade show'>
                                      <i class='bi bi-exclamation-octagon'></i> Database error: " . mysqli_error($conn) . "</div>";
                      }
                  } else {
                      $message = "<div class='alert alert-warning text-center shadow-sm fade show'>
                                  <i class='bi bi-exclamation-triangle'></i> Price must be numeric.</div>";
                  }
              } else {
                  $message = "<div class='alert alert-warning text-center shadow-sm fade show'>
                              <i class='bi bi-info-circle'></i> All fields are required.</div>";
              }
          }
          ?>

          <!-- Loader -->
          <div id="loader" class="text-center my-4" style="display: none;">
            <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-secondary">Adding book...</p>
          </div>

          <!-- Response message -->
          <div id="response-message"><?php echo $message; ?></div>

          <!-- Form -->
          <form id="addBookForm" method="POST" action="" class="needs-validation" novalidate>
            <div class="mb-3">
              <label class="form-label fw-semibold">Book Title</label>
              <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter book title" required>
              <div class="invalid-feedback">Please enter a title.</div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Author</label>
              <input type="text" name="author" class="form-control form-control-lg" placeholder="Enter author name" required>
              <div class="invalid-feedback">Please enter the author’s name.</div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Price ($)</label>
              <input type="text" name="price" class="form-control form-control-lg" placeholder="Enter book price" required>
              <div class="invalid-feedback">Please enter a valid price.</div>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Category</label>
              <input type="text" name="category" class="form-control form-control-lg" placeholder="Enter category" required>
              <div class="invalid-feedback">Please enter the category.</div>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 fs-5 fw-semibold shadow-sm">
              <i class="bi bi-plus-circle"></i> Add Book
            </button>
          </form>
        </div>
      </div>

      <div class="text-center mt-4">
        <a href="books.php" class="text-decoration-none fw-semibold">
          <i class="bi bi-arrow-left-circle"></i> Back to Books
        </a>
      </div>

    </div>
  </div>
</div>

<!-- Optional styling & smooth transitions -->
<style>
  body {
    background: linear-gradient(135deg, #f8fff8, #e9f7ef);
  }
  .card {
    transition: all 0.3s ease;
  }
  .card:hover {
    transform: translateY(-3px);
  }
  .btn-success:hover {
    background-color: #157347 !important;
    transform: translateY(-2px);
  }
</style>

<script>
  // Loader animation
  const form = document.getElementById('addBookForm');
  form.addEventListener('submit', () => {
    document.getElementById('loader').style.display = 'block';
  });

  // Bootstrap form validation
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>

<?php include 'includes/footer.php'; ?>
