<?php 
// Connect to database
$con = mysqli_connect("localhost", "root", "", "sendmoney");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$error = "";
$success = "";
$totalSent = 0;

if (isset($_POST["submit"])) {
    $phone = trim($_POST["phone"] ?? "");
    $amount = trim($_POST["amount"] ?? "");
    $password = isset($_POST["password"]) ? md5(trim($_POST["password"])) : "";

    if ($phone !== "" && $amount !== "" && $password !== "") {
        if (!is_numeric($amount) || $amount <= 0 || $amount > 25000) {
            $error = "Amount must be between 1 and 25,000.";
        } elseif (strlen($_POST["password"]) < 8) {
            $error = "Password must be at least 8 characters long.";
        } else {
            $sql = "INSERT INTO `transaction` (`amount`, `password`, `phone`) VALUES ('$amount', '$password', '$phone')";
            if (mysqli_query($con, $sql)) {
                $success = "Successfully sent ${amount} BDT to ${phone}";
            } else {
                $error = "Failed to save data: " . mysqli_error($con);
            }
        }
    } else {
        $error = "Please fill up all the required fields.";
    }

    // Get total amount sent by this phone number
    if ($phone) {
        $result = mysqli_query($con, "SELECT SUM(amount) AS total FROM transaction WHERE phone = '$phone'");
        $row = mysqli_fetch_assoc($result);
        $totalSent = $row['total'] ?? 0;
    }
}
?>
<!-- Html code start -->
<!doctype html>
<html lang="en">
<!-- Head section start -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- icon -->
    <link rel="icon" href="https://freelogopng.com/images/all_img/1656235223bkash-logo.png">
  <title>Send Money</title>
  <!-- BOOTSTRAP css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<!-- Head section end -->
<!-- body section start -->
<body>
<section class="py-4 py-lg-5">
  <section class="container">
    <div class="row align-items-center">
      <div class="col-12 text-center mb-4">
        <h2 class="text-uppercase">Send Money</h2>
        <!-- IN top show total send money -->
        <?php if ($totalSent > 0): ?>
          <h5 class="text-success">Total send money by me : <strong><?= number_format($totalSent, 2) ?> BDT</strong></h5>
        <?php endif; ?>
      </div>
    </div>
    <!-- php error & success parts -->
    <?php if ($error): ?>
      <div class="alert alert-danger"><strong><?= $error ?></strong></div>
    <?php elseif ($success): ?>
      <div class="alert alert-success"><strong><?= $success ?></strong></div>
    <?php endif; ?>
    <div class="col">
      <div class="card shadow">
        <form id="sendMoneyForm" action="sendmoney.php" method="post">
          <div class="form-floating mb-4 m-3">
            <input type="tel" name="phone" class="form-control" id="phone" placeholder="Enter your phone number" required>
            <label for="phone">Phone Number:</label>
          </div>
          <div class="form-floating mb-4 m-3">
            <input type="number" name="amount" class="form-control" id="amount" placeholder="Max: 25,000" required>
            <label for="amount">Amount:</label>
          </div>
          <div class="form-floating m-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password">Password:</label>
          </div>
          <div id="message" class="d-none"></div>
          <button name="submit" type="submit" class="btn btn-danger mt-4 float-end m-3">Send Money</button>
        </form>
      </div>
    </div>
  </section>
</section>
<!-- JavaScript Validation -->
<script>
  document.getElementById("sendMoneyForm").addEventListener("submit", function(e) {
    const phone = document.getElementById("phone").value.trim();
    const amount = parseFloat(document.getElementById("amount").value);
    const password = document.getElementById("password").value.trim();

    if (isNaN(amount) || amount <= 0 || amount > 25000) {
      e.preventDefault();
      showMessage("Amount must be between 1 and 25,000.", "danger");
      return;
    }

    if (password.length < 8) {
      e.preventDefault();
      showMessage("Password must be at least 8 characters long.", "danger");
      return;
    }
  });

  function showMessage(msg, type) {
    const messageBox = document.getElementById("message");
    messageBox.className = `alert alert-${type} mt-3 mx-3`;
    messageBox.textContent = msg;
    messageBox.classList.remove("d-none");
  }
</script>
<!-- Bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!-- body section end -->
</html>
<!-- HTML section end -->
