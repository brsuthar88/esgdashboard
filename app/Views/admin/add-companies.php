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
.select2-container{width:96%;line-height: 0;}.input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback){margin-left:0px}
.select2 .selection{
  width: 100%;
  padding: 0;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--bs-body-color);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: var(--bs-body-bg);
  background-clip: padding-box;
  border: var(--bs-border-width) solid var(--bs-border-color);
  border-radius: var(--bs-border-radius);
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  border-radius: 0px 4px 4px 0px !important;
  border-left: none;}
  .select2-container--default .select2-selection--single{border:none !important;height: 44px !important;background:none !important;}
  .select2-container--default .select2-selection--single .select2-selection__arrow{height: 44px !important;}
  .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 44px !important;}
  .select2-results__option {padding: 15px !important;line-height:18px;}
  .select2-container{width:95% !important;}
.select2-results__option span {
  white-space: normal; /* Allow wrapping and line breaks */
  word-wrap: break-word; /* Prevent long words from breaking the layout */
  line-height:18px;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #da251d;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transform: -webkit-translate(-50%, -50%);
  transform: -moz-translate(-50%, -50%);
  transform: -ms-translate(-50%, -50%);
  position: fixed;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.coverloader
{
    position: fixed;
  z-index: 9999;
  height: 100%;
  width: 100%;
  background: #00000091;
}
@media print {
  body {
    visibility: hidden;
  }
  #section-to-print {
    visibility: visible;
    position: absolute;
    left: 0;
    top: 0;
  }
}
.errorborder{border:1px solid red;}
.btn.dropdown-toggle{
    border: 1px solid var(--input-form-light);
  color: var(--text-primary-light) !important;
  background-color: var(--white);
}
</style>
</head>
<body>

 <!-- Sidebar -->
    <?php $dataview = ['admindata' => $admindata];
        echo view('admin/partials/adminsidebar', $dataview);
    ?>
 <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Add Company</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="dashboard.html" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard </a> </li>
        <li>></li>
        <li class="fw-medium">Company</li>
      </ul>
    </div>
    <div class="row gy-4">
      <div class="card h-100 p-0 radius-12">
      <div class="card-body">
          <form id="myForm">
          <div class="row gy-3">
            <div class="mb-20 col-sm-6">
              <label for="cname" class="form-label fw-semibold text-primary-light text-sm mb-8">Company Name <span class="text-danger-600">*</span></label>
              <input type="text" class="form-control radius-8" id="cname" name="cname" placeholder="Enter company name"  data-rule-required="true" data-msg-required="Company name is required.">
            </div>
            <div class="mb-20 col-sm-6">
             <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Contact Email<span class="text-danger-600">*</span></label>
              <input type="email" class="form-control radius-8" id="email" name="email" placeholder="Enter Contact Email" data-rule-email="true"  data-rule-required="true" data-msg-required="Contact Email is required.">
            </div>
            <div class="mb-20 col-sm-12">
              <label for="location" class="form-label fw-semibold text-primary-light text-sm mb-8">Location</label>
              <input type="text" class="form-control radius-8" id="location" name="location" placeholder="City, State/Country" >
            </div>
           
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
			<a href="javascript:void(0)" id="submitdata"  class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
            <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
            Add Company
          </a>
        
          
			<a  href="/admin/add-companies" class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
            <iconify-icon icon="pepicons-pencil:times-circle-filled" class="text-xl"></iconify-icon>
           Cancel
          </a>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div id="section-to-print"></div>
  <input type="hidden" id="totalprice">
  <input type="hidden" id="totalprice1">
  <!-- footer -->
 <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>
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
  $("#submitdata").on("click", function () {

    if ($("#myForm").valid()) {
        // Get form data
        let formData = {
            cname: $('#cname').val(),
            email: $('#email').val(),
            location: $('#location').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
  Swal.fire({
        title: "Are you sure?",
        text: "You want to save this Company?",
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
            url: '<?= base_url('/admin/save-companies') ?>',
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
                         window.location.href ='/admin/list-companies';
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
    $(document).ready(function() {
     $("#sidebar-menu .companies").addClass('open');
     $("#sidebar-menu .companiessub").addClass('show');
     $("#sidebar-menu .companiesadd").addClass('active-page');
    });
</script>

</body>
</html>