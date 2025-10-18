<?php
require_once 'includes/auth.php';
requireLogin();
require_once 'includes/navbar.php';

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $duckCount = intval($_POST['duckCount'] ?? 0);
    $feedType = $_POST['feedType'] ?? 'starter';
    
    if ($duckCount > 0) {
        $feedRates = [
            'starter' => 150,
            'layer' => 120,
            'booster' => 180
        ];
        
        $dailyFeedGrams = $duckCount * $feedRates[$feedType];
        $dailyFeedKg = $dailyFeedGrams / 1000;
        $weeklyFeedKg = $dailyFeedKg * 7;
        $monthlyFeedKg = $dailyFeedKg * 30;
        
        $dailyVitaminGrams = $duckCount * 2;
        $weeklyVitaminGrams = $dailyVitaminGrams * 7;
        $monthlyVitaminGrams = $dailyVitaminGrams * 30;
        
        $result = [
            'duckCount' => $duckCount,
            'feedType' => $feedType,
            'dailyFeedKg' => $dailyFeedKg,
            'weeklyFeedKg' => $weeklyFeedKg,
            'monthlyFeedKg' => $monthlyFeedKg,
            'dailyVitaminGrams' => $dailyVitaminGrams,
            'weeklyVitaminGrams' => $weeklyVitaminGrams,
            'monthlyVitaminGrams' => $monthlyVitaminGrams
        ];
    } else {
        $error = "Please enter a valid number of ducks.";
    }
}

$user = getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Feed Calculator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header class="bg-light p-4 text-center">
    <h2>Feed & Vitamin Calculator</h2>
    <p class="lead">Estimate daily feed requirements based on duck count</p>
  </header>

  <main class="container my-5">
    <div class="card shadow">
      <div class="card-header bg-success text-white text-center">
        <h4>Calculator</h4>
      </div>
      <div class="card-body">
        <?php if ($error): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
          <div class="row g-4 align-items-end">
            <div class="col-md-6">
              <label for="duckCount" class="form-label">Number of Ducks</label>
              <input type="number" class="form-control" id="duckCount" name="duckCount"
                     placeholder="Enter count" value="<?php echo $_POST['duckCount'] ?? ''; ?>" required>
            </div>
            <div class="col-md-6">
              <label for="feedType" class="form-label">Feed Type</label>
              <select class="form-select" id="feedType" name="feedType" required>
                <option value="starter" <?php echo ($_POST['feedType'] ?? '') === 'starter' ? 'selected' : ''; ?>>Starter (150g/duck/day)</option>
                <option value="layer" <?php echo ($_POST['feedType'] ?? '') === 'layer' ? 'selected' : ''; ?>>Layer (120g/duck/day)</option>
                <option value="booster" <?php echo ($_POST['feedType'] ?? '') === 'booster' ? 'selected' : ''; ?>>Booster (180g/duck/day)</option>
              </select>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-success px-5">Calculate</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <?php if ($result): ?>
    <div class="card mt-5 shadow">
      <div class="card-header bg-info text-white text-center">
        <h4>Calculation Results</h4>
      </div>
      <div class="card-body">
        <h5 class="text-center">Feed Requirements for <?php echo $result['duckCount']; ?> Ducks (<?php echo ucfirst($result['feedType']); ?>)</h5>
        <div class="table-responsive mt-4">
          <table class="table table-bordered text-center">
            <thead class="table-success">
              <tr>
                <th>Period</th>
                <th>Feed (kg)</th>
                <th>Vitamins</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Daily</td>
                <td><?php echo number_format($result['dailyFeedKg'], 2); ?> kg</td>
                <td><?php echo number_format($result['dailyVitaminGrams'], 0); ?> g</td>
              </tr>
              <tr>
                <td>Weekly</td>
                <td><?php echo number_format($result['weeklyFeedKg'], 2); ?> kg</td>
                <td><?php echo number_format($result['weeklyVitaminGrams'], 0); ?> g</td>
              </tr>
              <tr>
                <td>Monthly</td>
                <td><?php echo number_format($result['monthlyFeedKg'], 2); ?> kg</td>
                <td><?php echo number_format($result['monthlyVitaminGrams'] / 1000, 2); ?> kg</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-3 p-3 bg-warning bg-opacity-10 border border-warning rounded">
          <small><strong>Note:</strong> These are estimated requirements. Actual consumption may vary based on duck age, weather conditions, and activity level.</small>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
