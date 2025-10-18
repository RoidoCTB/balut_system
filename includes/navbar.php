<?php
$user = getCurrentUser();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="index.php">Balut Business</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>

        <?php if ($user['role'] === 'farmer'): ?>
          <li class="nav-item"><a class="nav-link" href="manage-ducks.php">Manage Ducks</a></li>
          <li class="nav-item"><a class="nav-link" href="feed-calculator.php">Feed Calculator</a></li>
          <li class="nav-item"><a class="nav-link" href="incubator.php">Incubator</a></li>
        <?php endif; ?>

        <?php if ($user['role'] === 'staff'): ?>
          <li class="nav-item"><a class="nav-link" href="incubator.php">Incubator</a></li>
        <?php endif; ?>

        <?php if (in_array($user['role'], ['farmer', 'vendor', 'staff'])): ?>
          <li class="nav-item"><a class="nav-link" href="record-sales.php">Record Sales</a></li>
        <?php endif; ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <?php echo htmlspecialchars($user['username']); ?> (<?php echo ucfirst($user['role']); ?>)
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
