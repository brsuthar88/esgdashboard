<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('admin/partials/admincss'); ?>

</head>
<body>
    <!-- Sidebar -->
    <?php $dataview = ['admindata' => $admindata,];
    echo view('admin/partials/adminsidebar', $dataview);
    ?>
           
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Dashboard</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>-</li>
        <li class="fw-medium">Admin</li>
      </ul>
    </div>
    
    <!-- Trigger Button -->
    <div class="card h-100 p-0 radius-12">
      <div class="card-body">
        <h5>WELCOME ADMIN DASHBOARD</h5>
        </div>
    </div>
  </div>
  <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>

</body>
</html>