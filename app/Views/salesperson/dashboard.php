<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('salesperson/partials/Sellercss'); ?>

</head>
<body>
    <!-- Sidebar -->
    <?php $dataview = ['sellerdata' => $sellerdata,];
    echo view('salesperson/partials/Sellersidebar', $dataview);
    ?>
           
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Dashboard</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/supplier" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>-</li>
        <li class="fw-medium">Supplier</li>
      </ul>
    </div>
<div class="card basic-data-table scrollclass">
      <div class="card-body row">
      <b class="text-success">Successfully Accepted Account</b>
  </div>
     
</div>
</div>
  <!-- footer -->
  <?php echo view('salesperson/partials/Sellerfooter'); ?>

  <!-- JS -->
  <?php echo view('salesperson/partials/Sellerjs'); ?>


</body>
</html>