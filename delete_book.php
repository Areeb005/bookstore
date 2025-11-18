<?php
include 'includes/header.php';
include 'includes/db_connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = '';

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "<div class='alert alert-success text-center shadow-sm'>
                        <i class='bi bi-check-circle'></i> Book deleted successfully!
                    </div>";
    } else {
        $message = "<div class='alert alert-danger text-center shadow-sm'>
                        <i class='bi bi-exclamation-octagon'></i> Failed to delete book: " . $conn->error . "
                    </div>";
    }
    $stmt->close();
} else {
    $message = "<div class='alert alert-warning text-center shadow-sm'>
                    <i class='bi bi-info-circle'></i> Invalid book ID.
                </div>";
}
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg rounded-4 p-4 text-center">
        <h3 class="fw-bold text-danger mb-3"><i class="bi bi-trash"></i> Delete Book</h3>
        <?= $message ?>
        <a href="books.php" class="btn btn-success mt-3"><i class="bi bi-arrow-left-circle"></i> Back to Books</a>
      </div>
    </div>
  </div>
</div>

<style>
body { background: linear-gradient(135deg, #fff8f8, #ffeaea); }
.card { transition: all 0.3s ease; }
.card:hover { transform: translateY(-3px); }
</style>

<?php include 'includes/footer.php'; ?>
