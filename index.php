<?php
require_once('Mpesa.php');
$hasQr = false;

if ($_GET['getqr']) {
  Mpesa::send(
    '10',
    1
  );

  $resp = json_decode(Mpesa::$response);

  if (isset($resp->QRCode)) {
    $hasQr = true;
    $qrImage = "data:image/jpeg;base64, {$resp->QRCode}";
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>M-pesa QR Checkout example · SYURVTECH</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">

  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-1" src="../assets/brand/mpesa.png" alt="" width="172">
      <h2>QR Checkout</h2>
      <p class="lead">Below is an M-PESA QR Checkout example.</p>
    </div>

    <div class="row">
      <div class="col-md-5 order-md-2 mb-2 mx-auto">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Product name</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">KES 25</span>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">-KES 5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (KES)</span>
            <strong>KES 20</strong>
          </li>
        </ul>

        <?php if ($hasQr) : ?>
          <form class="card p-2">
            <img src="<?= $qrImage ?>" alt="" srcset="">
          </form>
        <?php endif; ?>

        <form class="p-2">
          <div class="input-group">
            <input type="number" hidden class="form-control" value="1">
            <input type="text" name="getqr" hidden class="form-control" value="1">
            <?php if ($hasQr) : ?>
              <button type="submit" class="btn btn-success btn-block">Refresh QR Code</button>
            <?php else : ?>
              <button type="submit" class="btn btn-success btn-block">Get QR Code</button>
            <?php endif ?>
          </div>
        </form>
      </div>

    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2017-2022 Surv Technologies</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>