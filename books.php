<?php
include 'includes/header.php';
include 'includes/db_connect.php';

// Handle search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Pagination setup
$limit = 12;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query with search filter
$query = "SELECT * FROM books";
if ($search) {
    $query .= " WHERE title LIKE ? OR author LIKE ? OR category LIKE ?";
}
$query .= " ORDER BY id DESC LIMIT ?, ?";
$stmt = $conn->prepare($query);
if ($search) {
    $searchParam = "%$search%";
    $stmt->bind_param("sssii", $searchParam, $searchParam, $searchParam, $offset, $limit);
} else {
    $stmt->bind_param("ii", $offset, $limit);
}
$stmt->execute();
$res = $stmt->get_result();
$books = $res->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Count total records for pagination
$countQuery = "SELECT COUNT(*) AS total FROM books";
if ($search) {
    $countQuery .= " WHERE title LIKE ? OR author LIKE ? OR category LIKE ?";
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
} else {
    $stmt = $conn->prepare($countQuery);
}
$stmt->execute();
$totalRes = $stmt->get_result()->fetch_assoc();
$totalBooks = $totalRes['total'];
$totalPages = ceil($totalBooks / $limit);
$stmt->close();
?>

<div class="container py-5">

  <!-- Page Header Section -->
  <div class="row mb-5">
    <div class="col-12">
      <div class="page-header-card p-4 text-center">
        <h1 class="display-4 fw-bold mb-2">
          <i class="bi bi-book-fill"></i> 
          <span class="text-gradient">Book Collection</span>
        </h1>
        <p class="lead text-muted">Discover and manage your literary treasures</p>
      </div>
    </div>
  </div>

  <!-- Search and Action Bar -->
  <div class="row mb-4">
    <div class="col-lg-8 mx-auto">
      <div class="search-bar-wrapper">
        <form class="d-flex gap-2" method="GET" action="">
          <div class="input-group search-input-group">
            <span class="input-group-text border-0 bg-white">
              <i class="bi bi-search text-muted"></i>
            </span>
            <input 
              type="text" 
              name="search" 
              class="form-control border-0" 
              placeholder="Search by title, author, or category..." 
              value="<?= htmlspecialchars($search) ?>"
            >
          </div>
          <button class="btn btn-primary px-4" type="submit">
            <i class="bi bi-search"></i> Search
          </button>
          <a href="add_book.php" class="btn btn-success px-4">
            <i class="bi bi-plus-circle"></i> Add
          </a>
        </form>
      </div>
    </div>
  </div>

  <?php if (empty($books)) : ?>
    <div class="row">
      <div class="col-lg-6 mx-auto">
        <div class="alert empty-state-alert text-center p-5">
          <i class="bi bi-inbox display-1 text-muted mb-3"></i>
          <h4 class="fw-bold mb-3">No Books Found</h4>
          <p class="text-muted mb-4">
            <?php if ($search): ?>
              No books match your search criteria. Try different keywords.
            <?php else: ?>
              Your library is empty. Start by adding your first book!
            <?php endif; ?>
          </p>
          <a href="add_book.php" class="btn btn-success btn-lg px-5">
            <i class="bi bi-plus-circle"></i> Add Your First Book
          </a>
        </div>
      </div>
    </div>
  <?php else : ?>

  <!-- Books Grid -->
  <div class="row g-4 mb-5">
    <?php foreach ($books as $b) : ?>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="book-card h-100">
          <!-- Book Cover/Header -->
          <div class="book-cover">
            <div class="book-price-tag">
              $<?= number_format($b['price'], 2) ?>
            </div>
            <div class="book-category-badge">
              <i class="bi bi-tag-fill"></i> <?= htmlspecialchars($b['category']) ?>
            </div>
          </div>
          
          <!-- Book Details -->
          <div class="book-details p-3">
            <h5 class="book-title mb-2">
              <?= htmlspecialchars($b['title']) ?>
            </h5>
            <p class="book-author mb-3">
              <i class="bi bi-person-circle"></i> 
              <?= htmlspecialchars($b['author']) ?>
            </p>
            
            <!-- Action Buttons -->
            <div class="book-actions d-flex gap-2">
              <a 
                href="update_book.php?id=<?= urlencode($b['id']) ?>" 
                class="btn btn-sm btn-outline-primary flex-fill"
                title="Edit Book"
              >
                <i class="bi bi-pencil"></i> Edit
              </a>
              <a 
                href="delete_book.php?id=<?= urlencode($b['id']) ?>" 
                onclick="return confirm('Are you sure you want to delete this book?');" 
                class="btn btn-sm btn-outline-danger flex-fill"
                title="Delete Book"
              >
                <i class="bi bi-trash"></i> Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
  <nav aria-label="Book pagination" class="mt-5">
    <ul class="pagination justify-content-center">
      <!-- Previous Button -->
      <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
        <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">
          <i class="bi bi-chevron-left"></i> Previous
        </a>
      </li>
      
      <!-- Page Numbers -->
      <?php 
      $start = max(1, $page - 2);
      $end = min($totalPages, $page + 2);
      
      if ($start > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?search=<?= urlencode($search) ?>&page=1">1</a>
        </li>
        <?php if ($start > 2): ?>
          <li class="page-item disabled"><span class="page-link">...</span></li>
        <?php endif; ?>
      <?php endif; ?>
      
      <?php for ($i = $start; $i <= $end; $i++) : ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
          <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
      
      <?php if ($end < $totalPages): ?>
        <?php if ($end < $totalPages - 1): ?>
          <li class="page-item disabled"><span class="page-link">...</span></li>
        <?php endif; ?>
        <li class="page-item">
          <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $totalPages ?>"><?= $totalPages ?></a>
        </li>
      <?php endif; ?>
      
      <!-- Next Button -->
      <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
        <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">
          Next <i class="bi bi-chevron-right"></i>
        </a>
      </li>
    </ul>
  </nav>
  <?php endif; ?>

  <?php endif; ?>
</div>

<!-- Custom Styles for Books Page -->
<style>
  .page-header-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(240, 248, 255, 0.9) 100%);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: none;
  }
  
  .search-bar-wrapper {
    background: white;
    padding: 15px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  }
  
  .search-input-group {
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    flex: 1;
  }
  
  .search-input-group .form-control:focus {
    box-shadow: none;
    background: #f8f9fa;
  }
  
  .book-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border: none;
  }
  
  .book-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
  }
  
  .book-cover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    height: 200px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }
  
  .book-cover::before {
    content: '\F4D3';
    font-family: 'bootstrap-icons';
    font-size: 5rem;
    color: rgba(255, 255, 255, 0.2);
    position: absolute;
  }
  
  .book-price-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: #667eea;
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
  
  .book-category-badge {
    position: absolute;
    bottom: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: #764ba2;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
  
  .book-details {
    background: white;
  }
  
  .book-title {
    color: #2c3e50;
    font-weight: 700;
    font-size: 1.1rem;
    line-height: 1.4;
    min-height: 2.8em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  
  .book-author {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
  }
  
  .book-actions .btn {
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 8px 12px;
  }
  
  .empty-state-alert {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(240, 248, 255, 0.9) 100%);
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  }
  
  /* Stagger animation for cards */
  .book-card {
    animation: fadeInUp 0.6s ease-out backwards;
  }
  
  <?php foreach ($books as $index => $b): ?>
    .book-card:nth-child(<?= $index + 1 ?>) {
      animation-delay: <?= $index * 0.05 ?>s;
    }
  <?php endforeach; ?>
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<?php include 'includes/footer.php'; ?>
