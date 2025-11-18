<?php
include 'includes/header.php';
include 'includes/db_connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = '';
$book = null;

// Fetch book details
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $book = $res->fetch_assoc();
    $stmt->close();

    if (!$book) {
        $message = "<div class='alert alert-warning text-center shadow-sm'>Book not found.</div>";
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $price = trim($_POST['price']);
    $category = trim($_POST['category']);

    if ($title && $author && $price && $category) {
        if (is_numeric($price)) {
            $stmt = $conn->prepare("UPDATE books SET title=?, author=?, price=?, category=? WHERE id=?");
            $stmt->bind_param("ssdsi", $title, $author, $price, $category, $id);
            if ($stmt->execute()) {
                $message = "<div class='alert alert-success text-center shadow-sm'><i class='bi bi-check-circle'></i> Book updated successfully!</div>";
                // refresh book info
                $book['title'] = $title;
                $book['author'] = $author;
                $book['price'] = $price;
                $book['category'] = $category;
            } else {
                $message = "<div class='alert alert-danger text-center shadow-sm'><i class='bi bi-exclamation-octagon'></i> Failed to update book: ".$conn->error."</div>";
            }
            $stmt->close();
        } else {
            $message = "<div class='alert alert-warning text-center shadow-sm'><i class='bi bi-exclamation-triangle'></i> Price must be numeric.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning text-center shadow-sm'><i class='bi bi-info-circle'></i> All fields are required.</div>";
    }
}
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">

      <div class="card shadow-lg rounded-4 p-5">
        <h2 class="text-center fw-bold text-primary mb-4">
          <i class="bi bi-pencil-square"></i> Update Book
        </h2>

        <?= $message ?>

        <?php if($book): ?>
        <form method="POST" class="needs-validation" novalidate>
          <div class="mb-3">
            <label class="form-label fw-semibold">Book Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($book['title']) ?>" required>
            <div class="invalid-feedback">Please enter a title.</div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Author</label>
            <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($book['author']) ?>" required>
            <div class="invalid-feedback">Please enter the author’s name.</div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Price ($)</label>
            <input type="text" name="price" class="form-control" value="<?= htmlspecialchars($book['price']) ?>" required>
            <div class="invalid-feedback">Please enter a valid price.</div>
          </div>
          <div class="mb-4">
            <label class="form-label fw-semibold">Category</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($book['category']) ?>" required>
            <div class="invalid-feedback">Please enter the category.</div>
          </div>
          <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
            <i class="bi bi-save"></i> Update Book
          </button>
        </form>
        <?php endif; ?>

        <div class="text-center mt-3">
          <a href="books.php" class="text-decoration-none fw-semibold">
            <i class="bi bi-arrow-left-circle"></i> Back to Books
          </a>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
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

<style>
body { background: linear-gradient(135deg, #f0f8ff, #ffffff); }
.card { transition: all 0.3s ease; }
.card:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
</style>

<?php include 'includes/footer.php'; ?>
