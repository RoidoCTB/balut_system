<?php
require_once 'includes/auth.php';
requireLogin();
require_once 'includes/navbar.php';
$user = getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Balut Business Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header class="bg-light p-4 text-center">
    <h1 class="display-6">Balut Business System</h1>
    <p class="lead">Streamlined dashboard for Duck Farmers, Incubator Staff, and Vendors</p>
    <p class="text-muted">Welcome, <?php echo htmlspecialchars($user['username']); ?>!</p>
  </header>

  <main class="container my-5">
    <div class="row g-4">

      <?php if ($user['role'] === 'farmer'): ?>
        <div class="col-md-3">
          <div class="card border-success">
            <div class="card-header bg-success text-white">Manage Ducks</div>
            <div class="card-body">
              <p>View, update, and organize duck batches (layering & future).</p>
              <a href="manage-ducks.php" class="btn btn-outline-success w-100">Open Management</a>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card border-success">
            <div class="card-header bg-success text-white">Feed Calculator</div>
            <div class="card-body">
              <p>Estimate feed and vitamin needs based on duck count.</p>
              <a href="feed-calculator.php" class="btn btn-outline-success w-100">Launch Calculator</a>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card border-success">
            <div class="card-header bg-success text-white">Incubator</div>
            <div class="card-body">
              <p>Track egg batches and incubation progress.</p>
              <a href="incubator.php" class="btn btn-outline-success w-100">View Incubator</a>
            </div>
          </div>
        </div>
      <?php endif; ?>

     <?php if (in_array($user['role'], ['farmer', 'staff'])): ?>
  <div class="col-md-3">
    <div class="card border-success">
      <div class="card-header bg-success text-white">Incubator</div>
      <div class="card-body">
        <p>Track egg batches and incubation progress.</p>
        <a href="incubator.php" class="btn btn-outline-success w-100">View Incubator</a>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if (in_array($user['role'], ['farmer', 'vendor', 'staff'])): ?>
  <div class="col-md-3">
    <div class="card border-success">
      <div class="card-header bg-success text-white">Record Sales</div>
      <div class="card-body">
        <p>Log sales transactions from vendors and staff.</p>
        <a href="record-sales.php" class="btn btn-outline-success w-100">Record Sale</a>
      </div>
    </div>
  </div>
<?php endif; ?>


    </div>
  </main>

  <footer class="bg-dark text-white text-center p-3">
    <small>&copy; 2025 Balut Business System</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
