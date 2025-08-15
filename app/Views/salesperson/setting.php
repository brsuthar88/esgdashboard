<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('salesperson/partials/Sellercss'); ?>
<style type="text/css">
.bordered-table thead tr th,.bordered-table tbody tr td{font-size:14px;}

.select2-container--default .select2-selection--single{
    height: 2.75rem !important;
  border: 1px solid var(--input-form-light);
  color: var(--text-primary-light) !important;
  background-color: var(--white);
  padding: 0.5625rem 1.25rem;
  display: block;
  width: 100%;
  padding: .375rem .75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5 !important;
  color: var(--bs-body-color);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: var(--bs-body-bg);
  background-clip: padding-box;
  border: var(--bs-border-width) solid var(--bs-border-color) !important;
  border-radius: var(--bs-border-radius) !important;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.select2-container--default .selection{
     width:100%;
 }
 .select2-container--default .select2-selection--single .select2-selection__arrow{
     height: 2.75rem !important;
       line-height: 1.5 !important;
 }
.disabled {
    cursor: not-allowed;
    opacity: 0.5; /* Makes it look disabled */
    pointer-events: none; /* Prevents clicks */
}
 .card-box {
      background: white;
      border-radius: 10px;
      padding: 24px;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
      margin-bottom: 24px;
    }
    .dashed-box {
      border: 2px dashed #ccc;
      padding: 2rem;
      text-align: center;
      border-radius: 0.5rem;
      background: #f9fafb;
    }
    .tile-box {
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      padding: 0.75rem 1rem;
      background-color: #f8f9fa;
      margin-bottom: 0.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .preview-tile {
      height: 56px;
      background-color: #f1f5f9;
      border-radius: 0.5rem;
      margin-bottom: 0.5rem;
    }
    .toggle-btn, .toggle-btn1 {
      background-color: gray;
      color: white;
      border: none;
      cursor: pointer;
    }
</style>
</head>
<body>
<!-- Sidebar -->
    <?php $dataview = ['sellerdata' => $sellerdata];
    echo view('salesperson/partials/Sellersidebar', $dataview);

?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Company Settings</h6>
       <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard </a> </li>
        <li>-</li>
        <li class="fw-medium">Setting</li>
      </ul>
    </div>
    
    <div class="card h-100 p-0 radius-12 mb-20">
      <div class="card-body">
        <div class="row">
      <div class="col-lg-8">
        <div class="card-box">
          <p class="text-muted">Customize your dashboard branding and preferences</p>
          <h6 class="fw-semibold">Branding</h6>
          <div class="dashed-box mb-4">
            <i class="bi bi-upload fs-1 text-muted"></i>
            <p class="mb-2">Upload your company logo</p>
            <button class="btn btn-outline-primary btn-sm">Choose File</button>
          </div>

          <h6 class="fw-semibold">Color Palette</h6>
          <div class="row g-3 mb-4">
            <div class="col">
              <input type="color" class="form-control form-control-color" value="#4f4e65">
              <small class="text-muted">Primary Color</small>
            </div>
            <div class="col">
              <input type="color" class="form-control form-control-color" value="#10b981">
              <small class="text-muted">Secondary Color</small>
            </div>
            <div class="col">
              <input type="color" class="form-control form-control-color" value="#f59e0b">
              <small class="text-muted">Accent Color</small>
            </div>
          </div>

          <h6 class="fw-semibold">Dashboard Layout</h6>
          <p class="text-muted">Drag and drop to reorder dashboard tiles</p>
          <div class="tile-box">Carbon Emissions <span>#1</span></div>
          <div class="tile-box">Energy Intensity <span>#2</span></div>
          <div class="tile-box">Water Consumption <span>#3</span></div>
          <div class="tile-box">Gender Diversity <span>#4</span></div>
          <div class="tile-box">Training Hours <span>#5</span></div>
          <div class="tile-box">Governance Score <span>#6</span></div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card-box">
              <button class="btn btn-outline-primary">Preview</button>
          <button  class="btn btn-primary text-end">Save Settings</button>
          <h6 class="fw-semibold" style="margin-top:12px;">Preview</h6>  
        
          <div class="preview-tile d-flex align-items-center justify-content-center text-muted fw-semibold mb-2" >Your logo will appear here</div>
          <div class="row g-2">
            <div class="col-6"><div class="preview-tile"></div></div>
            <div class="col-6"><div class="preview-tile"></div></div>
            <div class="col-6"><div class="preview-tile"></div></div>
            <div class="col-6"><div class="preview-tile"></div></div>
          </div>
        </div>

        <div class="card-box">
          <h6 class="fw-semibold">Export Options</h6>
          <button class="btn btn-outline-dark w-100 mb-2">
            <i class="bi bi-download me-2"></i>Download PDF Template
          </button>
          <button class="btn btn-outline-dark w-100">
            <i class="bi bi-download me-2"></i>Export Brand Guidelines
          </button>
        </div>

        <div class="card-box">
          <h6 class="fw-semibold">Additional Settings</h6>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="logoExport" style="margin: 6px 6px 0 0;">
            <label class="form-check-label" for="logoExport">Include company logo in PDF exports</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="customColors" style="margin: 5px 6px 0 0;" >
            <label class="form-check-label" for="customColors">Use custom colors in dashboard tiles</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="showCompanyName" style="margin: 5px 6px 0 0;">
            <label class="form-check-label" for="showCompanyName">Show company name in header</label>
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
  let table = new DataTable('#dataTable');
</script>

<script>
$(document).ready(function () {
    $("#zohoform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#zohoformbtn").on("click", function () {

    if ($("#zohoform").valid()) {
        // Get form data
        let formData = {
            zoho_client_id: $('#zoho_client_id').val(),
            zoho_client_secret: $('#zoho_client_secret').val(),
            zoho_refresh_token: $('#zoho_refresh_token').val(),
            zoho_refresh_token_book: $('#zoho_refresh_token_book').val(),
            zoho_organization_id: $('#zoho_organization_id').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your Zoho setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-zoho') ?>',
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
$(document).ready(function () {
    $("#smtp2goform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#smtp2goformbtn").on("click", function () {

    if ($("#smtp2goform").valid()) {
        // Get form data
        let formData = {
            smtp2go_email: $('#smtp2go_email').val(),
            smtp2go_key: $('#smtp2go_key').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your smtp2go setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-smtp2go') ?>',
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
$(document).ready(function () {
    $("#generalsettingform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#generalsettingformbtn").on("click", function () {

    if ($("#generalsettingform").valid()) {
        // Get form data
        let formData = {
            quot_prefix: $('#quot_prefix').val(),
            quote_number_length: $('#quote_number_length').val(),
            dateformat: $('#dateformat').val(),
            default_timezone: $('#default_timezone').val(),
            currency: $('#currency').val(),
            currencysymbol: $('#currency-symbol').val(),
            adminhelpemail: $('#admin-help-email').val(),
            crontime: $('#cron_time').val(),
            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your general setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-general') ?>',
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
$(document).ready(function () {
    $("#generalsettingformcron").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#generalsettingformbtncron").on("click", function () {

    if ($("#generalsettingformcron").valid()) {
        // Get form data
        let formData = {
            crontime: $('#cron_time').val(),
            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your cron job setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-general-cron') ?>',
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
$(document).ready(function () {
    $("#databaseform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#databaseformbtn").on("click", function () {

    if ($("#databaseform").valid()) {
        // Get form data
        let formData = {
            database_clear_username: $('#database_clear_username').val(),
            database_clear_password: $('#database_clear_password').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your Clear Database(Except Admin) setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-cleardatabase') ?>',
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

<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.default_timezone').select2();
    });
</script>
 <script>
        const currencyDropdown = document.getElementById("currency");
        const currencySymbol = document.getElementById("currency-symbol");

        currencyDropdown.addEventListener("change", function () {
            const selectedOption = currencyDropdown.options[currencyDropdown.selectedIndex];
            currencySymbol.value = selectedOption.getAttribute("data-symbol");
        });
    </script>
    <script>
     function select_common_option() {
    const common = document.getElementById('common_options').value;

    if (common && common !== '--') {
        const parts = common.trim().split(/\s+/); // Trim + handle extra spaces

       
            const [min, hr, day, month, wkday] = parts;

            document.getElementById('minute').value = min;
            document.getElementById('hour').value = hr;
            document.getElementById('day').value = day;
            document.getElementById('month').value = month;
            document.getElementById('weekday').value = wkday;

            document.getElementById('cron_time').value = parts.join(' ');
        
    }
}

function select_single_option(field) {
    const select = document.getElementById(field + '_options');
    const input = document.getElementById(field);
    const value = select.value;

    if (value && value !== '--') {
        input.value = value;

        // Rebuild full cron time from all 5 inputs
        const cron = [
            document.getElementById('minute').value,
            document.getElementById('hour').value,
            document.getElementById('day').value,
            document.getElementById('month').value,
            document.getElementById('weekday').value
        ].join(' ');

        document.getElementById('cron_time').value = cron;
    }
}


    </script>
    <script>
    $(document).ready(function() {
     $("#sidebar-menu .setting").addClass('open');
     $("#sidebar-menu .setting").addClass('show');
     $("#sidebar-menu .setting").addClass('active-page');
    });
</script>
</body>
</html>