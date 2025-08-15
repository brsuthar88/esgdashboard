<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('partials/Customercss'); ?>
<style>
    .icon-box {
      background: #eae8fd;
      color: #6558d3;
      font-weight: bold;
      border-radius: 12px;
      width: 40px;
      height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
    }
    .status-badge {
      font-size: 0.8rem;
      border-radius: 12px;
      padding: 0.25em 0.75em;
      font-weight: 500;
      text-transform: lowercase;
    }
    .status-pending {
      background-color: #fff7d1;
      color: #b38300;
    }
    .status-accepted {
      background-color: #d9f8e7;
      color: #1e9e5f;
    }
    .status-issue {
      background-color: #ffd1d1;
      color: #b30000;
    }
    .action-link {
      font-size: 0.9rem;
      cursor: pointer;
    }

    .modal-content {
      border-radius: 1rem;
      padding: 1.5rem;
    }
    .info-box {
      background-color: #eef2ff;
      border: 1px solid #dbeafe;
      color: #1d4ed8;
      border-radius: 0.5rem;
      padding: 1rem;
      font-size: 0.875rem;
    }
    .btn-outline-secondary {
      border-radius: 0.5rem;
    }
    .btn-primary {
      background-color: #4f46e5;
      border-color: #4f46e5;
      border-radius: 0.5rem;
    }
    .btn-primary:hover {
      background-color: #4338ca;
      border-color: #4338ca;
    }
  </style>
</head>
<body>
      <!-- Sidebar -->
 <?php $dataview = ['customerdata' => $customerdata,'getcompany'=>$getcompany,'getsupplier'=>$getsupplier];
    echo view('partials/Customersidebar', $dataview);
    ?>

  <div class="dashboard-main-body scrollclass">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0"> Suppliers</h6>
       <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>></li>
        <li class="fw-medium">Suppliers</li>
      </ul>
    </div>
     <div class="row gy-4">
      
      
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header ">
              <div class="row">
            <div class="col-xxl-6 col-lg-6">
            <h5 class="card-title mb-0">Supplier</h5>
           </div>
             <div class="col-xxl-6 col-lg-6 text-end">
              <a data-bs-toggle="modal" data-bs-target="#inviteModal" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-right gap-1">
            <iconify-icon icon="pepicons-pencil:paper-plane" class="text-xl"></iconify-icon>
            Send Invitation
          </a>
          </div></div>
          </div>
          <div class="card-body">
			  <div class="col-12 mb-20">
                 
              </div>
		
            <div class="table-responsive">
              <table id="dynamicTable" class="table bordered-table mb-0">
               <tbody>
                   <?php foreach($getsupplier as $dats) { ?>
      <tr>
       
        <td>
          <div class="fw-bold"><?php echo $dats['email'];?></div>
          <small>CVR Code: <?php echo $dats['cvr'];?></small><br>
        </td>
        <td>
          <small><i class="bi bi-calendar3"></i> Create <?php echo $dats['created_at'];?></small>
        </td>
        <td>
          <small>Company Name:<?php echo $dats['company_name'];?></small>
        </td>
        <td>
          <span class="status-badge status-<?php echo $dats['status'];?>"><i class="bi bi-clock"></i> <?php echo $dats['status'];?></span>
        </td>
      </tr>
      <?php print_r($getsupplier);} ?>
    </tbody>
              </table>
            </div>
          </div>
		
      </div>
    </div>
  </div>
         
      </div>
    </div>
  </div>
  </div>

<!-- Bulk Supplier Invitation Modal -->
<div class="modal fade" id="bulkInviteModal" tabindex="-1" aria-labelledby="bulkInviteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" >
    <div class="modal-content rounded-4 shadow-sm" style="padding:2%">
      
    <div class="custom-modal">
    <div class="d-flex justify-content-between align-items-start p-4 border-bottom">
      <div class="d-flex align-items-start gap-3">
        <i class="fa fa-users text-primary fs-4 mt-1"></i>
        <div>
          <h6 class="fw-bold text-dark mb-1">Bulk Supplier Invitation</h6>
          <p class="text-muted small mb-0">Upload CSV file with supplier information</p>
        </div>
      </div>
      <button class="btn-close"></button>
    </div>

    <div class="p-4">
      <div class="mb-4 p-3 border rounded template-box">
        <div class="d-flex align-items-start gap-3">
          <i class="fa fa-file-alt mt-1"></i>
          <div>
            <b class="fw-semibold mb-1">CSV Template Required</b>
            <p class="small mb-2 text-black">Download our template to ensure your CSV file has the correct format with all required fields.</p>
            <button class="btn btn-link text-decoration-none p-0">
              <i class="fa fa-download me-1"></i> Download CSV Template
            </button>
          </div>
        </div>
      </div>

      <div class="upload-zone mb-4">
        <i class="fa fa-upload fs-1 text-secondary mb-3"></i>
        <p class="text-muted fw-semibold">Drag and drop your CSV file here, or click to browse</p>
        <small class="text-secondary d-block mb-3">Supports CSV files up to 10MB</small>
        <label for="csv-upload" class="btn btn-indigo px-4 py-2 fw-semibold rounded">
          Choose CSV File
        </label>
        <input type="file" accept=".csv" id="csv-upload" class="d-none">
      </div>

      <div class="requirements-box p-3 rounded border">
        <p class="fw-semibold text-dark mb-2">Required CSV Columns:</p>
        <div class="row g-2 small text-muted">
          <div class="col-sm-6">• Email (required)</div>
          <div class="col-sm-6">• Company Name (required)</div>
          <div class="col-sm-6">• CVR Number (optional)</div>
          <div class="col-sm-6">• Geography (optional)</div>
          <div class="col-sm-6">• Size (SME/Large/Micro)</div>
        </div>
      </div>
    </div>
  </div>
  </div>
    </div>
  </div>
</div>


    <!-- footer -->
  <?php echo view('partials/Customerfooter'); ?>

  <!-- JS -->
  <?php echo view('partials/Customerjs'); ?>
  
<script>
    $(document).ready(function () {
         var isMobile = $(window).width() <= 1024; // Detect mobile (adjust as needed)
        var currencySymbol ='<?= $GLOBALS["currencysymbol"] ?>';
        $('#dataTable').DataTable({
           
                 responsive: true,
            autoWidth: isMobile,
            searching: true,  // Disable searching on mobile
            columnDefs: [
                { targets: -1, orderable: false }
            ],
            scrollX: isMobile // Enable scrolling on mobile
        });
    });
</script>


<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Boxed Tooltip
    $(document).ready(function() {
        $('.tooltip-button').each(function () {
            var tooltipButton = $(this);
            var tooltipContent = $(this).siblings('.my-tooltip').html();

            // Initialize the tooltip
            tooltipButton.tooltip({
                title: tooltipContent,
                trigger: 'hover',
                html: true
            });

            // Optionally, reinitialize the tooltip if the content might change dynamically
            tooltipButton.on('mouseenter', function() {
                tooltipButton.tooltip('dispose').tooltip({
                    title: tooltipContent,
                    trigger: 'hover',
                    html: true
                }).tooltip('show');
            });
        });
    });
</script>
<script>
    // Add event listener for when the modal is shown
document.getElementById('statuschangeModal').addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    // Extract value from data-* attribute
    var value = button.getAttribute('data-value');
    var Statusname = $('.status'+value).val();
    $('#Status').val(Statusname).trigger('change');
    // Update modal content
    var modalValue = document.getElementById('modalValue');
    modalValue.value=value;
});

</script>
<script>
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const statusname = urlParams.get('s');
        if(statusname != null)
        {
             if(statusname=='Rejected')
            {
               window.myDataTable = $('#dataTable').DataTable();
            window.myDataTable.search('Reject').draw();
            }
            else
            {
                window.myDataTable = $('#dataTable').DataTable();
                window.myDataTable.search(statusname).draw();
            }
        }

        const namecustomer = urlParams.get('name');
        if(namecustomer != null){
            //$("#dt-search-0").val(statusname);
             window.myDataTable = $('#dataTable').DataTable();
            window.myDataTable.search(namecustomer).draw();
        }
    });

</script>
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
function confirmMailSend(url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to send an email?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url; // Redirect if confirmed
        }
    });
}
</script>
<script>
// function confirmDownload(url) 
// {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You want to download this quotation?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#3085d6",
//         confirmButtonText: "Yes, Continue it!",
//         cancelButtonText: "No, cancel",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = url; // Redirect if confirmed
//         }
//     });
// }
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
     $("#sidebar-menu .suppliers").addClass('open');
     $("#sidebar-menu .supplierssub").addClass('show');
     $("#sidebar-menu .supplierslist").addClass('active-page');
    });
</script>
</body>
</html>