<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('admin/partials/admincss'); ?>
<style type="text/css"> 
 .col .fw-bold
    {
        border: 1px solid;
        padding: 5%;
        border-radius: 10px;
    }
.bordered-table thead tr th,.bordered-table tbody tr td{font-size:14px;}
</style>
</head>
<body>

<!-- Sidebar -->
<?php echo view('admin/partials/adminsidebar', ['admindata' => $admindata]); ?>
<div class="dashboard-main-body scrollclass">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Supplier Company</h6>
       <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>></li>
        <li class="fw-medium">Supplier Company</li>
      </ul>
    </div>
     <div class="row g-2 mb-3">
      <div class="col-md-10">
      </div>
      <!--<div class="col-md-2">
        <a href="/admin/add-companies" class="btn btn-outline-primary w-100">Add New Company</a>
      </div>-->
    </div>

 
    <div class="card basic-data-table">
      <div class="card-body">
        <table class="table bordered-table mb-0 responsive nowrap" style="width:100%" id="dataTable">
          <thead>
            <tr>  <th>#</th>
                  <th>Company Name</th>
                  <th>CVR</th>
                  <th>Email</th>
                  <th>Location</th>
                  <th>Date</th>
            </tr>
          </thead>
          <tbody>
 <tr>
      <td>
      
    <tr>
     
    </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>


   <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>




<?php if (session()->getFlashdata('msg')): ?>
<script>
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "<?=session()->getFlashdata('msg');?>",
        timer: 2000,
    });
</script>
<?php endif;?>

<?php if (session()->getFlashdata('success')): ?>
<script>
    Swal.fire({
      title: "Success",
      text: "<?=session()->getFlashdata('success');?>",
      icon: "success",
      timer: 2000,
      allowOutsideClick: false,
    });
</script>
<?php endif;?>

<script>
     $(document).ready(function () {
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('/admin/datatable-company') ?>',
            type: "POST"
        },
        columns: [
            { data: 'serial_no', orderable: false },
            { data: 'company_name' },
            { data: 'cvr' },
            { data: 'email' },
            { data: 'address' },
            { data: 'created_at' }
        ],
        drawCallback: function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
    order: [[5, 'desc']], // column index 1 = company_name, but you probably want company_id
    responsive: true,
    searching: true,
    columnDefs: [
        { orderable: false, targets: [0] }
    ],
    scrollY: '300px'
    });
});
</script>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .companies").addClass('open');
     $("#sidebar-menu .companiessub").addClass('show');
     $("#sidebar-menu .companieslist").addClass('active-page');
    });
</script>
</body>
</html>