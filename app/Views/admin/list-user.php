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
.bordered-table thead tr th,.bordered-table tbody tr td{font-size:14px;}
 .col .fw-bold
    {
        border: 1px solid;
        padding: 5%;
        border-radius: 10px;
    }
</style>
</head>
<body>
     <!-- Sidebar -->
    <?php $dataview = ['admindata' => $admindata,];
    echo view('admin/partials/adminsidebar', $dataview);
    ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Parent Company List</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>-</li>
        <li class="fw-medium">Parent Company</li>
      </ul>
    </div>
     <div class="row g-2 mb-3">
      <div class="col-md-9">
      </div>
      
      <div class="col-md-3">
        <a href="/admin/add-user" class="btn btn-outline-primary w-100">Add New Parent Company</a>
      </div>
    </div>

    <div class="card basic-data-table scrollclass">
      <div class="card-body"> 
      <form>
        <table class="table bordered-table mb-0 responsive nowrap" style="width:100%" id="dataTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Company</th>
              <th style="width:25%">Permissions</th>
              <th>Joined</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        </form>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>
<script>
$(document).ready(function () {
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('/admin/datatable-company_manager') ?>',
            type: "POST"
        },
        columns: [
            { data: 'serial_no' },
            { data: 'name' },
            { data: 'email' },
            { data: 'company' },
            { data: 'permission' },
            { data: 'created_at' }
        ],
        drawCallback: function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
        order: [[5, 'desc']],
        responsive: true,
        searching: true,
        columnDefs: [
            { orderable: false, targets: [0] }
        ],
        scrollY: '300px'
    });
});
</script>

<style>
    #dataTable {
    width: 100% !important;
    table-layout: auto;
}

#dataTable td, #dataTable th {
    white-space: normal; /* Allows text to wrap */
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 100px; /* Adjust column width as needed */
}
#dataTable td:last-child, 
#dataTable th:last-child {
    white-space: normal !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    max-width: 150px !important; /* Adjust width as needed */
}

</style>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .user").addClass('open');
     $("#sidebar-menu .usersub").addClass('show');
     $("#sidebar-menu .userlist").addClass('active-page');
    });
</script>
</body>
</html>