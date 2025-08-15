<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('salesperson/partials/Sellercss'); ?>
<style>
    body {
      background-color: #f8f9fc;
      font-family: 'Segoe UI', sans-serif;
    }
    .file-box {
      border-bottom: 1px solid #e4e9f2;
      padding: 20px 0;
    }
    .file-title {
      font-weight: 500;
      font-size: 16px;
    }
    .file-meta {
      font-size: 14px;
      color: #6c757d;
    }
    .badge-pill {
      border-radius: 20px;
      padding: 5px 10px;
      font-size: 12px;
      text-transform: capitalize;
    }
    .badge-verified { background-color: #d1f3d4; color: #0b7f1c; }
    .badge-pending { background-color: #fff5cc; color: #b58900; }
    .badge-rejected { background-color: #fddede; color: #c70000; }
    .badge-review { background-color: #e3ebff; color: #004fc1; }
    .rejection-box {
      background-color: #fff5f5;
      border-left: 4px solid #f44336;
      padding: 10px;
      font-size: 14px;
      color: #c70000;
      margin-top: 10px;
    }
    .icon-eye, .icon-download, .icon-trash {
      cursor: pointer;
      margin-right: 10px;
      color: #888;
    }
    .icon-eye:hover, .icon-download:hover, .icon-trash:hover {
      color: #000;
    }
    .col .fw-bold
    {
        border: 1px solid;
        padding: 10%;
        border-radius: 10px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
    <?php $dataview = ['sellerdata' => $sellerdata,];
    echo view('salesperson/partials/Sellersidebar', $dataview);
    ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Customers List</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/seller" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>-</li>
        <li class="fw-medium">Customers</li>
      </ul>
    </div>
    <div class="card basic-data-table">

      <div class="card-body">
 <div class="container bg-white p-4 rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h4 class="mb-0">Evidence Files</h4>
        <small class="text-muted">Manage and review supporting documentation for ESG metrics</small>
      </div>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">⬆ Upload Evidence</button>
    </div>

    <div class="row g-2 mb-3">
      <div class="col-md-6">
        <input class="form-control" placeholder="Search files, suppliers, or metrics...">
      </div>
      <div class="col-md-2">
        <select class="form-select">
          <option>All Categories (5)</option>
        </select>
      </div>
      <div class="col-md-2">
        <select class="form-select">
          <option>All Status</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">More Filters</button>
      </div>
    </div>

    <div class="row text-center mb-5 mt-5">
      <div class="col">
        <div class="text-primary fw-bold">Total Files<br><span class="fs-5">5</span></div>
      </div>
      <div class="col">
        <div class="text-success fw-bold">Verified<br><span class="fs-5">2</span></div>
      </div>
      <div class="col">
        <div class="text-warning fw-bold">Pending<br><span class="fs-5">1</span></div>
      </div>
      <div class="col">
        <div class="text-info fw-bold">Under Review<br><span class="fs-5">1</span></div>
      </div>
      <div class="col">
        <div class="text-danger fw-bold">Rejected<br><span class="fs-5">1</span></div>
      </div>
    </div>

    <h6 class="fw-bold mb-3">Evidence Files (5)</h6>

    <!-- File Item -->
    <div class="file-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="file-title">📄 CO2_Emissions_Report_Q4_2024.pdf <span class="text-muted small">v1.0</span>
            <span class="badge badge-pill badge-verified">✔ verified</span>
          </div>
          <div class="file-meta">Quarterly carbon emissions report • Climate • Scope 1 • EcoSupply Co. • 15/1/2024 • 2.3 MB<br><small>Uploaded by John Smith</small></div>
        </div>
        <div>
          <span class="icon-eye">👁</span>
          <span class="icon-download">⬇</span>
          <span class="icon-trash">🗑</span>
        </div>
      </div>
    </div>

    <!-- Pending File -->
    <div class="file-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="file-title">📊 Water_Usage_Data_2024.xlsx <span class="text-muted small">v2.1</span>
            <span class="badge badge-pill badge-pending">⏳ pending</span>
          </div>
          <div class="file-meta">Monthly water consumption • Water • Sustainable Materials Ltd. • 12/1/2024 • 1.8 MB<br><small>Uploaded by Sarah Johnson</small></div>
        </div>
        <div>
          <span class="icon-eye">👁</span>
          <span class="icon-download">⬇</span>
          <span class="icon-trash">🗑</span>
        </div>
      </div>
    </div>

    <!-- Verified File -->
    <div class="file-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="file-title">📄 Diversity_Training_Certificate.pdf <span class="text-muted small">v1.0</span>
            <span class="badge badge-pill badge-verified">✔ verified</span>
          </div>
          <div class="file-meta">Diversity training completion • Diversity • Clean Energy Partners • 10/1/2024 • 0.9 MB<br><small>Uploaded by Mike Chen</small></div>
        </div>
        <div>
          <span class="icon-eye">👁</span>
          <span class="icon-download">⬇</span>
          <span class="icon-trash">🗑</span>
        </div>
      </div>
    </div>

    <!-- Rejected File -->
    <div class="file-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="file-title">📄 Energy_Audit_Report_2024.pdf <span class="text-muted small">v1.0</span>
            <span class="badge badge-pill badge-rejected">❌ rejected</span>
          </div>
          <div class="file-meta">Annual audit report • Climate • Recycled Components Inc. • 8/1/2024 • 3.2 MB<br><small>Uploaded by Lisa Wang</small></div>
          <div class="rejection-box">
            Rejection Reason: File format not supported. Please upload in PDF format with proper verification stamps.
          </div>
        </div>
        <div>
          <span class="icon-eye">👁</span>
          <span class="icon-download">⬇</span>
          <span class="icon-trash">🗑</span>
        </div>
      </div>
    </div>

    <!-- Under Review -->
    <div class="file-box">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="file-title">📄 Governance_Policy_Document.docx <span class="text-muted small">v3.0</span>
            <span class="badge badge-pill badge-review">🔍 under review</span>
          </div>
          <div class="file-meta">Governance procedures • Governance • Carbon Neutral Logistics • 5/1/2024 • 1.1 MB<br><small>Uploaded by David Brown</small></div>
        </div>
        <div>
          <span class="icon-eye">👁</span>
          <span class="icon-download">⬇</span>
          <span class="icon-trash">🗑</span>
        </div>
      </div>
    </div>

  </div>
      </div>
    </div>
  </div>

<!-- Modal Structure -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="uploadEvidenceModalLabel">Upload Evidence Files</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- Upload Area -->
        <div class="border rounded-3 p-5 text-center bg-light mb-4" style="border-style: dashed;">
          <div class="mb-3">
            <i class="bi bi-upload fs-1 text-secondary"></i>
          </div>
          <p class="text-muted mb-1">Drag and drop files here, or click to browse</p>
          <p class="text-muted small">Supports PDF, Excel, Word, and image files up to 20MB</p>
          <button class="btn btn-primary mt-2">Choose Files</button>
        </div>

        <!-- Category Dropdown -->
        <div class="mb-3">
          <label for="category" class="form-label fw-semibold">Category</label>
          <select class="form-select" id="category">
            <option>Climate & Emissions</option>
            <option>Water</option>
            <option>Waste</option>
            <!-- Add more as needed -->
          </select>
        </div>

        <!-- Metric Dropdown -->
        <div class="mb-3">
          <label for="metric" class="form-label fw-semibold">Related Metric</label>
          <select class="form-select" id="metric">
            <option>Scope 1 Emissions</option>
            <option>Scope 2 Emissions</option>
            <option>Water Consumption</option>
            <!-- Add more as needed -->
          </select>
        </div>

        <!-- Description Textarea -->
        <div class="mb-4">
          <label for="description" class="form-label fw-semibold">Description</label>
          <textarea class="form-control" id="description" rows="3" placeholder="Describe the evidence file and its relevance to the metric..."></textarea>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Upload Files</button>
        </div>

      </div>

      </div>
    </div>
  </div>
</div>
</div>
</div>
   <!-- footer -->
  <?php echo view('salesperson/partials/Sellerfooter'); ?>

  <!-- JS -->
  <?php echo view('salesperson/partials/Sellerjs'); ?>
<script>
 $(document).ready(function () {
    /*$('#dataTable').DataTable({
        scrollX: true,
        createdRow: function (row, data, dataIndex) {
            $(row).find('[data-toggle="tooltip"]').tooltip();
        }
    });*/
});
</script> 
<script>
      $(document).ready(function () {
              var isMobile = $(window).width() <= 1024; // Detect mobile (adjust as needed)
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('/seller/datatable-list-customer') ?>',
                type: "POST"
            },
            columns: [
                { 
                    data: '',  // The row number from the server
                    orderable: false,    // Disable sorting for the row number column
                    searchable: false 

                },
                { data: 'customer_name' },
                { data: 'email' },
                { data: 'category_name' },
                {
                    data: 'status',
                    render: function (data, type, row) {
                    
                    if (data == 1) {
                       return'<span class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">Active</span><input type="hidden" value="Active" id="status'+row['customer_id']+'"/>';
                    } else {
                        return'<span class="bg-neutral-200 text-neutral-600 border border-neutral-400 px-24 py-4 radius-4 fw-medium text-sm">Inactive</span><input type="hidden" value="Inactive" id="status'+row['customer_id']+'">';
                    }
                    },
                },
                {
                    data: 'customer_id',
                    render: function (data, type, row) {
                        return '<div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View" ><button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewcustchangeModal"  data-value="'+row['customer_id']+'" ><i class="fas fa-eye" aria-hidden="true"></i></button></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit" ><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editcustomermodal"  data-value="'+row['customer_id']+'" ><i class="fas fa-pencil" aria-hidden="true"></i></button></a><a href="/seller/list-quotation?name='+row['customer_name']+'" class="bg-warning-focus text-warning-600 bg-hover-warning-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-warning" data-bs-title="Quotations"> <i class="fa fa-file-text" aria-hidden="true"></i></a></div> <input type="hidden" value="'+row['cfname']+'" id="fname'+row['customer_id']+'"><input type="hidden" value="'+row['clname']+'" id="lname'+row['customer_id']+'"><input type="hidden" value="'+row['email']+'" id="email'+row['customer_id']+'"><input type="hidden" value="'+row['phone_number']+'" id="phone'+row['customer_id']+'"><input type="hidden" value="'+row['category_name']+'" id="cate'+row['customer_id']+'"><input type="hidden" value="'+row['sales_person_name']+'" id="seller'+row['customer_id']+'"><input type="hidden" value="'+row['description']+'" id="desc'+row['customer_id']+'"><input type="hidden" value="'+row['shipping_address']+'" id="saddress'+row['customer_id']+'"><input type="hidden" value="'+row['shipping_city']+'" id="scity'+row['customer_id']+'"><input type="hidden" value="'+row['shipping_state']+'" id="sstate'+row['customer_id']+'"><input type="hidden" value="'+row['shipping_pincode']+'" id="spincode'+row['customer_id']+'"><input type="hidden" value="'+row['shipping_phone_number']+'" id="sphone'+row['customer_id']+'"><input type="hidden" value="'+row['billing_address']+'" id="baddress'+row['customer_id']+'"><input type="hidden" value="'+row['billing_city']+'" id="bcity'+row['customer_id']+'"><input type="hidden" value="'+row['billing_state']+'" id="bstate'+row['customer_id']+'"><input type="hidden" value="'+row['billing_pincode']+'" id="bpincode'+row['customer_id']+'"><input type="hidden" value="'+row['billing_phone_number']+'" id="bphone'+row['customer_id']+'">';
                    }
                }
            ],
            drawCallback: function () {
                // Initialize tooltips after DataTable has finished rendering
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
               "order": [],
            responsive: true,
            autoWidth: isMobile,
            searching: true,  // Disable searching on mobile
            columnDefs: [
                { "orderable": false, "targets": [0, -1] } 
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
$(document).ready(function () {
$("#myForm").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#changepassword").on("click", function () {

    if ($("#myForm").valid()) {
         
        // Get form data
        let formData = {
            cpassword: $('#confirm-password').val(),
            password: $('#your-password').val(),
            customerid: $('#modalValue').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
        // AJAX request
        $.ajax({
            url: '<?= base_url('/seller/save-customer-password') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Display success or error message
                if (response.status === 'success') {
                   Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                      allowOutsideClick: false,
                       willClose: () => {
                           $('#passwordchangeModal').modal('hide');
                      },
                    });
                } else {
                     Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: response.message,
                           timer: 2000,
                        });
       
                }
            },
            error: function() {
                 $('.coverloader').hide();
                 Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text:"Error occurred while submitting the form.",
                           timer: 2000,
                        });
            }
        });
    }
  });
});
</script>
<script>
    // Add event listener for when the modal is shown
document.getElementById('passwordchangeModal').addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    
    // Extract value from data-* attribute
    var value = button.getAttribute('data-value');

    var modalValue = document.getElementById('modalValue');
    modalValue.value=value;
});

</script>

<script>
    // Add event listener for when the modal is shown
document.getElementById('viewcustchangeModal').addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    
    // Extract value from data-* attribute
    var value = button.getAttribute('data-value');
    var fname=$('#fname'+value).val();
    var lname=$('#lname'+value).val();
    var email=$('#email'+value).val();
    var phone=$('#phone'+value).val();
    var cate=$('#cate'+value).val();
    var seller=$('#seller'+value).val();
    var status=$('#status'+value).val();
    var desc=$('#desc'+value).val();

    var saddress=$('#saddress'+value).val();
    var scity=$('#scity'+value).val();
    var sstate=$('#sstate'+value).val();
    var spincode=$('#spincode'+value).val();
    var sphone=$('#sphone'+value).val();
    
    var baddress=$('#baddress'+value).val();
    var bcity=$('#bcity'+value).val();
    var bstate=$('#bstate'+value).val();
    var bpincode=$('#bpincode'+value).val();
    var bphone=$('#bphone'+value).val();

    
     var htmls='<div class="card-body p-24 pt-10"><div class="row gy-3"><div class="mb-20 col-sm-6"><label for="fname5" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name</label><input type="text" disabled class="form-control radius-8" id="fname5" value="'+fname+'"></div><div class="mb-20 col-sm-6"><label for="lname5" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name </label><input type="text" disabled class="form-control radius-8" id="lname5" value="'+lname+'"></div><div class="mb-20 col-sm-6"> <label for="email5" class="form-label fw-semibold text-primary-light text-sm mb-8">Email</label><input type="email" class="form-control radius-8" value="'+email+'" disabled id="email5"></div><div class="mb-20 col-sm-6"><label for="number5" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label><input type="text" class="form-control radius-8" id="number5" disabled value="'+phone+'"></div><div class="mb-20 col-sm-6"><label for="depart5" class="form-label fw-semibold text-primary-light text-sm mb-8">Category</label><input type="text" class="form-control radius-8" id="depart5" disabled value="'+cate+'" disabled></div><div class="mb-20 col-sm-6"><label for="seller5" class="form-label fw-semibold text-primary-light text-sm mb-8">Sales Person</label><input type="text" class="form-control radius-8" id="seller5" value="'+seller+'" disabled></div><div class="mb-20 col-sm-6"> <label for="desig5" class="form-label fw-semibold text-primary-light text-sm mb-8">Status</label><input type="text" class="form-control radius-8" id="desig5" value="'+status+'" disabled></div><div class="mb-20 col-sm-6"><label for="desc5" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label><textarea name="#0" class="form-control radius-8" id="desc5" disabled>'+desc+'</textarea></div></div><div class="row gy-3"><div class="col-md-6"><span class="card-title mb-10">Billing Address </span><div class="row gy-3"><div class="col-12"><label class="form-label">Country</label> <input type="text" name="#0" class="form-control" id="bcountry"  value="USA" disabled></div><div class="col-12"><label class="form-label">Address</label><textarea name="#0" class="form-control radius-8" id="baddress" disabled>'+baddress+'</textarea></div><div class="col-12"><label class="form-label">City</label><input type="text" name="#0" class="form-control" id="bcity"disabled  value="'+bcity+'" ></div><div class="col-12"><label class="form-label">State</label><input type="text" name="#0" class="form-control" id="bstate"  disabled value="'+bstate+'"></div><div class="col-12"><label class="form-label">Zip Code</label><input type="text" name="#0" class="form-control" id="bzip"  value="'+bpincode+'" disabled></div><div class="col-12"><label class="form-label">Phone</label><input type="text" name="#0" class="form-control" id="bphone" value="'+bphone+'" disabled></div></div></div><div class="col-md-6"><span class="card-title mb-10">Shipping Address</span><div class="row gy-3"><div class="col-12"><label class="form-label">Country</label> <input type="text" name="#0" class="form-control" id="bcountry"  value="USA" disabled></div><div class="col-12"><label class="form-label">Address </label><textarea name="#0" class="form-control radius-8" id="baddress" disabled>'+saddress+'</textarea></div><div class="col-12"><label class="form-label">City</label><input type="text" name="#0" class="form-control" id="bcity" disabled value="'+scity+'" ></div><div class="col-12"><label class="form-label">State</label><input type="text" name="#0" class="form-control" id="bstate"  value="'+sstate+'" disabled></div><div class="col-12"><label class="form-label">Zip Code</label><input type="text" name="#0" class="form-control" id="bzip"  value="'+spincode+'" disabled></div><div class="col-12"><label class="form-label">Phone</label><input type="text" name="#0" class="form-control" id="bphone" disabled value="'+sphone+'"></div></div></div>';
        document.getElementById('custdata').innerHTML=htmls;
});

</script>
<script>
    document.getElementById('copyAddressBtn').addEventListener('click', function() {
        document.getElementById('saddress').value = document.getElementById('baddress').value;
        document.getElementById('scity').value = document.getElementById('bcity').value;
        document.getElementById('sstate').value = document.getElementById('bstate').value;
        document.getElementById('szip').value = document.getElementById('bzip').value;
        document.getElementById('sphone').value = document.getElementById('bphone').value;
    });
</script>
<script>
$(document).ready(function() {
    // When modal is about to be shown
    $('#editcustomermodal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var customerId = button.data('value'); // Get customer ID

        // AJAX request to fetch customer details
        $.ajax({
            url: "<?= base_url('/seller/getCustomerData') ?>", // Corrected backend route
            type: "POST",
            data: { customer_id: customerId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Populate modal fields with customer data
                    $('#customerid').val(response.data.customer_id);
                    $('#fname').val(response.data.first_name);
                    $('#lname').val(response.data.last_name);
                    $('#email').val(response.data.email);
                    $('#number').val(response.data.phone_number);
                    $('#desc').val(response.data.description);
                    $('#destatus').val(response.data.status);

                    // Populate category dropdown
                    $('#depart').val(response.data.customer_category_id);
                    
                    // Populate sales person dropdown
                    $('#sellerid').val(response.data.sales_person_id);

                    // Populate billing address fields
                    $('#baddress').val(response.data.billing_address);
                    $('#bcity').val(response.data.billing_city);
                    $('#bstate').val(response.data.billing_state);
                    $('#bzip').val(response.data.billing_pincode);
                    $('#bphone').val(response.data.billing_phone_number);

                    // Populate shipping address fields
                    $('#saddress').val(response.data.shipping_address);
                    $('#scity').val(response.data.shipping_city);
                    $('#sstate').val(response.data.shipping_state);
                    $('#szip').val(response.data.shipping_pincode);
                    $('#sphone').val(response.data.shipping_phone_number);
                } else {
                    alert("Customer data not found!");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", error);
            }
        });
    });
});
</script>
<script>
$(document).ready(function () {
    $.validator.addMethod("phoneau", function (value, element) {
         return this.optional(element) ||/^(?:\+1\s?)?(?:\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/.test(value);
    }, "Please enter a valid phone number.");
  // Initialize validation
$("#myFormedit").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});

    $("#submitdata").on("click", function () {

    if ($("#myFormedit").valid()) {
        // Get form data
        let formData = {
            customerid: $('#customerid').val(),
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            number: $('#number').val(),
            depart: $('#depart').val(),
            destatus: $('#destatus').val(),
            desc: $('#desc').val(),
            bcountry: $('#bcountry').val(),
            baddress: $('#baddress').val(),
            bcity: $('#bcity').val(),
            bstate: $('#bstate').val(),
            bzip: $('#bzip').val(),
            bphone: $('#bphone').val(),
            scountry: $('#scountry').val(),
            saddress: $('#saddress').val(),
            scity: $('#scity').val(),
            sstate: $('#sstate').val(),
            szip: $('#szip').val(),
            sphone: $('#sphone').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
              title: "Are you sure?",
              text: "You want to update this customer?",
              icon: "warning",
               showCancelButton: true,
                  confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
            }).then((result) => {
                if (result.isConfirmed) 
                {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/seller/update-customer') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Display success or error message
                if (response.status === 'success') {
                  Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                      allowOutsideClick: false,
                       willClose: () => {
                          $('#dataTable').DataTable().ajax.reload(null, false);
                          $('#editcustomermodal').modal('hide');
                      },
                    });
                    
                } else {
                     Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: response.message,
                           timer: 2000,
                        });
                }
            },
            error: function() {
                 Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text:"Error occurred while submitting the form.",
                           timer: 2000,
                        });
            }
        });
                }
            });
    }
    });
});

</script>
<script>
    function logincust(custID) {
      Swal.fire({
          title: "Are you sure?",
          text: "You want to auto login this customer?",
          icon: "warning",
          showCancelButton: true,
             confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
           confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
        }).then((result) => {
            if (result.isConfirmed)
            {
                $.ajax({
                url: '<?=base_url('/seller/auto-login-customer')?>',
                type: 'POST',
                data: {
                    "custID": custID,
                    <?=csrf_token()?>: '<?=csrf_hash()?>'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                      allowOutsideClick: false,
                       willClose: () => {
                         window.open('/', '_blank');
                      },
                    });

                    } else {
                     Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: response.message,
                           timer: 2000,
                        });
                }
            },
            error: function() {
                 Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text:"Error occurred while submitting the form.",
                           timer: 2000,
                        });
            }
            });
            }
        });
    }
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
     $("#sidebar-menu .customer").addClass('open');
     $("#sidebar-menu .customersub").addClass('show');
     $("#sidebar-menu .customerlist").addClass('active-page');
    });
</script>
</body>
</html>