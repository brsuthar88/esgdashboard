<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('partials/Customercss'); ?>
<style type="text/css">
</style>
</head>
<body>
      <!-- Sidebar -->
    <?php $dataview = ['sellerdata' => $sellerdata];
echo view('partials/Customersidebar', $dataview);
    ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Recent Reports</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>-</li>
        <li class="fw-medium">Reports</li>
      </ul>
    </div>
    <div class="card basic-data-table scrollclass">
      <div class="card-body row">
          <div class="col-sm-8 col-lg-8 col-md-8">
        <form>
        <table class="table bordered-table mb-0 responsive nowrap" style="width:100%" id="dataTable">
          <thead>
            <tr>
               <th style="width:20%;">Report Name</th>
              <th>Date</th>
              <th>File</th>
              <th>Tags</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
             <tr>
          <td>
            <strong>Supplier Performance Analysis</strong><br>
            <small class="text-muted">Detailed analysis of supplier ESG performance</small>
          </td>
          <td>10/1/2024</td>
          <td>PDF(1.8 MB) 8 download</td>
          <td><span class="badge bg-secondary">All Metrics</span></td>
          <td><span class="badge bg-success text-white">Completed</span></td>
          <td>
            <button class="btn btn-sm btn-outline-primary">Download</button>
          </td>
        </tr>

        <!-- Row 2 -->
        <tr>
          <td>
            <strong>Carbon Footprint Deep Dive</strong><br>
            <small class="text-muted">In-depth analysis of carbon emissions across all suppliers</small>
          </td>
          <td>20/1/2024</td>
         <td>PDF(3.1 MB) 0 download</td>
          <td>
            <span class="badge bg-info text-dark">Scope 1 Emissions</span>
            <span class="badge bg-info text-dark">Scope 2 Emissions</span>
            <span class="badge bg-info text-dark">Energy Intensity</span>
          </td>
          <td><span class="badge bg-warning text-dark">Generating</span></td>
          <td>
            <button class="btn btn-sm btn-outline-secondary" disabled>Pending</button>
          </td>
        </tr>

        <!-- Row 3 -->
        <tr>
          <td>
            <strong>Diversity & Inclusion Report</strong><br>
            <small class="text-muted">Comprehensive diversity and inclusion metrics analysis</small>
          </td>
          <td>8/1/2024</td>
          <td>PDF(1.5 MB) 15 download</td>
          <td>
            <span class="badge bg-info text-dark">Gender Diversity</span>
            <span class="badge bg-info text-dark">Pay Gap</span>
            <span class="badge bg-info text-dark">Training Hours</span>
          </td>
          <td><span class="badge bg-success text-white">Completed</span></td>
          <td>
            <button class="btn btn-sm btn-outline-primary">Download</button>
          </td>
        </tr>

        <!-- Row 4 -->
        <tr>
          <td>
            <strong>Regulatory Compliance Report</strong><br>
            <small class="text-muted">Report formatted for regulatory submission</small>
          </td>
          <td>25/1/2024</td>
          <td>PDF(2.7 MB) 3 download</td>
          <td><span class="badge bg-secondary">All Metrics</span></td>
          <td><span class="badge bg-primary text-white">Scheduled</span></td>
          <td>
            <button class="btn btn-sm btn-outline-secondary" disabled>Scheduled</button>
          </td>
        </tr>
          </tbody>
        </table>
        </form>
        </div>
         <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="container mt-4">
          <h5 class="fw-semibold mb-3">Quick Generate</h5>
        
          <div class="d-flex flex-column gap-3">
        
            <!-- Card 1 -->
            <div class="border rounded p-3 d-flex justify-content-between align-items-start">
              <div>
                <div class="fw-semibold">ESG Summary Report</div>
                <div class="text-muted small">High-level overview of all ESG metrics</div>
                <div class="text-muted small mt-1">5–10 minutes</div>
              </div>
              <a href="#" class="text-primary fw-semibold">Generate</a>
            </div>
        
            <!-- Card 2 -->
            <div class="border rounded p-3 d-flex justify-content-between align-items-start">
              <div>
                <div class="fw-semibold">Supplier Detailed Analysis</div>
                <div class="text-muted small">Comprehensive supplier-by-supplier breakdown</div>
                <div class="text-muted small mt-1">10–15 minutes</div>
              </div>
              <a href="#" class="text-primary fw-semibold">Generate</a>
            </div>
        
            <!-- Card 3 -->
            <div class="border rounded p-3 d-flex justify-content-between align-items-start">
              <div>
                <div class="fw-semibold">Carbon Emissions Focus</div>
                <div class="text-muted small">Deep dive into carbon-related metrics</div>
                <div class="text-muted small mt-1">8–12 minutes</div>
              </div>
              <a href="#" class="text-primary fw-semibold">Generate</a>
            </div>
        
          </div>
        </div>
        <div class="container mt-4" style="max-width: 420px;">

  <!-- Scheduled Reports Card -->
  <div class="card mb-4">
    <div class="card-body">
      <h6 class="card-title fw-bold mb-3">Scheduled Reports</h6>

      <!-- Monthly ESG Summary -->
      <div class="border rounded p-3 mb-2 bg-primary-subtle d-flex justify-content-between align-items-start">
        <div>
          <div class="fw-semibold text-primary-emphasis">Monthly ESG Summary</div>
          <small class="text-muted">Next: Feb 1, 2024</small>
        </div>
        <a href="#" class="text-primary fw-semibold">Edit</a>
      </div>

      <!-- Quarterly Compliance -->
      <div class="border rounded p-3 mb-3 bg-success-subtle d-flex justify-content-between align-items-start">
        <div>
          <div class="fw-semibold text-success-emphasis">Quarterly Compliance</div>
          <small class="text-muted">Next: Mar 31, 2024</small>
        </div>
        <a href="#" class="text-success fw-semibold">Edit</a>
      </div>

      <!-- Schedule New Report Button -->
      <button class="btn btn-outline-secondary w-100">+ Schedule New Report</button>
    </div>
  </div>

  <!-- Export Options Card -->
  <div class="card">
    <div class="card-body">
      <h6 class="card-title fw-bold mb-3">Export Options</h6>

      <div class="d-grid gap-2">
        <button class="btn btn-light" type="button">
          <i class="bi bi-download me-2"></i>Bulk Download
        </button>
        <button class="btn btn-light" type="button">
          <i class="bi bi-share me-2"></i>Share via Email
        </button>
      </div>
    </div>
  </div>
</div>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="passwordchangeModal" tabindex="-1" aria-labelledby="passwordchangeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuschangeModalLabel">Sales Person Password Change</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
            <form id="myForm">
          <div class="row">
            <div class="col-12 mb-20">
               <div class="mb-20">
              <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger-600">*</span></label>
              <div class="position-relative">
                <input type="password" class="form-control radius-8" id="your-password" placeholder="Enter New Password*" name="your-password" data-rule-required="true" data-msg-required="Password is required.">
                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span> </div>
            </div>
            <div class="mb-20">
              <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
              <div class="position-relative">
                <input type="password" class="form-control radius-8" id="confirm-password" name="confirm-password" placeholder="Confirm Password*" data-rule-required="true" data-msg-required="Please confirm your password." data-rule-equalto="#your-password"  data-msg-equalto="Passwords do not match.">
                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span> </div>
            </div>
            </div>
          </div>
          <input type="hidden" id="modalValue">
          </form>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
        <button type="button" id="changepassword" class="btn btn-primary text-sm px-24 py-12 radius-8"> Update Password </button>
      </div>
    </div>
  </div>
</div>
  
<div class="modal fade" id="editpersonmodal" tabindex="-1" aria-labelledby="editpersonmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuseditpersonmodalLabel">Edit Person</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
        <form id="myFormedit">
            <div class="card-body p-24 pt-10">
            <div class="row gy-3">
              <div class="mb-20 col-sm-6">
                <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="Enter First Name"  data-rule-required="true" data-msg-required="First Name is required." value="<?= isset($seller['first_name']) ? htmlspecialchars($seller['first_name']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="lname" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="lname" name="lname" placeholder="Enter Last Name" data-rule-required="true" data-msg-required="Last Name is required." value="<?= isset($seller['last_name']) ? htmlspecialchars($seller['last_name']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                <input type="email" class="form-control radius-8" id="email" name="email" placeholder="Enter Email" data-rule-required="true" data-msg-required="Email is required."  data-rule-email="true" data-msg-email="Enter a valid email address." value="<?= isset($seller['email']) ? htmlspecialchars($seller['email']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                <input type="text" class="form-control radius-8" id="number"  name="number" placeholder="Enter phone number" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)." value="<?= isset($seller['phone_number']) ? htmlspecialchars($seller['phone_number']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="destatus" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" name=
                "destatus" id="destatus" data-rule-required="true" data-msg-required="Status is required.">
                    <option value="1" <?= isset($seller['status']) && $seller['status'] == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= isset($seller['status']) && $seller['status'] == 0 ? 'selected' : '' ?>>Inactive</option>

                </select>
              </div>
              <div class="mb-20 col-sm-6">
                <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                <textarea name="#0" class="form-control radius-8" id="desc" placeholder="Write description..."><?= isset($seller['description']) ? htmlspecialchars($seller['description']) : '' ?></textarea>
              </div>
            </div>
            <input type="hidden" id="sellerid" value="<?= isset($seller['sales_person_id']) ? htmlspecialchars($seller['sales_person_id']) : '' ?>">
           
      </div>
      </form>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
        <button type="button" id="submitdata" class="btn btn-primary text-sm px-24 py-12 radius-8"> Update</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="viewcustchangeModal" tabindex="-1" aria-labelledby="passwordchangeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuschangeModalLabel">Sales Person Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
          <div class="row" id="sellerdata">
          </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
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
     $("#sidebar-menu .report").addClass('open');
     $("#sidebar-menu .reportsub").addClass('show');
     $("#sidebar-menu .reportlist").addClass('active-page');
    });
</script>
</body>
</html>