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
    <div class="coverloader">
        <div class="loader"></div>
    </div>
<!-- Sidebar -->
    <?php $dataview = ['customerdata' => $customerdata,'getcompany'=>$getcompany,'getsupplier'=>$getsupplier];
    echo view('partials/Customersidebar', $dataview);
    ?>
    
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Supplier</h6>
     
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
            Save Supplier
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
          <small>Company Name:<?php echo $dats['company'];?></small>
        </td>
        <td>
          <span class="status-badge status-<?php echo $dats['status'];?>" style="text-transform: capitalize;"><i class="bi bi-clock"></i> <?php echo $dats['status'];?></span>
        </td>
      </tr>
      <?php } ?>
    </tbody>
              </table>
            </div>
          </div>
		
      </div>
    </div>
  </div>
 <div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow">
        <div class="modal-header border-0">
          <h5 class="modal-title fw-semibold" id="inviteModalLabel">Save Supplier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
   <form id="myForm">
        <div class="modal-body pt-0">
          <div class="mb-3">
           <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Email Address <span class="text-danger-600">*</span>
                        </label>
                        <input type="email" class="form-control radius-8" id="email" name="email" placeholder="user@company.com" 
                               data-rule-required="true" data-msg-required="Email is required." 
                               data-rule-email="true" data-msg-email="Enter a valid email address.">
          </div>
         <div class="mb-3">
            <label for="cvr" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            CVR <span class="text-danger-600">*</span>
                        </label>
                        <input type="text" class="form-control radius-8" id="cvr" name="cvr" placeholder="Enter CVR" 
                               data-rule-required="true" data-msg-required="CVR is required.">
          </div>
          
          <div class="mb-3">
            <label for="personalMessage" class="form-label fw-medium">Personal Message (Optional)</label>
            <textarea class="form-control" name="personalMessage" id="personalMessage" rows="3" placeholder="Add a personal message to your invitation..."></textarea>
          </div>

          <div class="info-box mb-3">
            <p class="mb-1"><strong>What happens next?</strong></p>
            <ul class="ps-3 mb-0">
              <li>Supplier receives an email with invitation link</li>
              <li>They can sign up using the secure invitation code</li>
              <li>Once registered, they can start submitting ESG data</li>
              <li>You'll be notified when they accept the invitation</li>
            </ul>
          </div>
        </div>
   </form>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" id="submitdata" class="btn btn-primary">
            <i class="bi bi-send me-1"></i> Save Supplier
          </button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="totalprice">
    <input type="hidden" id="totalprice1">
  <!-- footer -->
  <?php echo view('partials/Customerfooter'); ?>

 <div id="section-to-print"></div>

  <!-- JS -->
  <?php echo view('partials/Customerjs'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/lib/bootstrap-select.min.css');?>">
<script src="<?= base_url('../assets/js/lib/bootstrap1.bundle.min.js'); ?>"></script>
<script src="<?= base_url('../assets/js/lib/bootstrap-select.min.js'); ?>"></script>
<script>
  let table = new DataTable('#dataTable');
</script>
<script>
   $(document).ready(function() {
       $('.coverloader').hide();
       setTimeout(function() {
      $('#order_product').selectpicker();
    }, 500); // 1000ms = 1 second
});

</script>
<script>
$(document).ready(function () {
    $.validator.addMethod("phoneau", function (value, element) {
         return this.optional(element) || /^(?:\+1\s?)?(?:\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/.test(value);
    }, "Please enter a valid phone number.");

    $("#myForm").validate({
        focusInvalid: true,
        invalidHandler: function (event, validator) {
            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top - 100
            }, 500);
        }
    });

    $("#submitdata").on("click", function(event) {
        event.preventDefault();

        // Read values properly without var keyword multiple times
        var email = $('#email').val(),
            cvr = $('#cvr').val();

        // Helper function to send supplier data after validation and confirmation
        function sendSupplierData() {
            if ($("#myForm").valid()) {
                let formData = {
                    email: $('#email').val(),
                    cvr: $('#cvr').val(),
                    cnames: $('#cnames').val(),
                    personalMessage: $('#personalMessage').val(),
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                };

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to send mail this Supplier?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, Continue it!",
                    cancelButtonText: "No, cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url('/save-suppliers') ?>',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Success",
                                        text: response.message,
                                        icon: "success",
                                        timer: 2000,
                                        allowOutsideClick: false,
                                        willClose: () => {
                                            window.location.href = '/add-suppliers';
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
                                    text: "Error occurred while submitting the form.",
                                    timer: 2000,
                                });
                            }
                        });
                    }
                });
            }
        }

        // If email is provided, check email and then send data
        if (email) {
            $.ajax({
                url: '<?= base_url('/check-email-cvr') ?>',
                type: 'POST',
                data: {'email': email, <?= csrf_token() ?>: '<?= csrf_hash() ?>'},
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Assuming response contains CVR value
                        $('#cvr').val(response.cvr || '');
                        sendSupplierData();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: 'This email did not find related CVR.',
                            timer: 2000,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Error occurred while submitting the form.",
                        timer: 2000,
                    });
                }
            });
        }
        // Else if CVR is provided, check CVR and then send data
        else if (cvr) {
            $.ajax({
                url: '<?= base_url('/check-cvr-email') ?>',
                type: 'POST',
                data: {'cvr': cvr, <?= csrf_token() ?>: '<?= csrf_hash() ?>'},
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Assuming response contains email value
                        $('#email').val(response.email || '');
                        sendSupplierData();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: 'This CVR not found.',
                            timer: 2000,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Error occurred while submitting the form.",
                        timer: 2000,
                    });
                }
            });
        } else {
            // Neither email nor cvr provided
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please enter Email or CVR.",
                timer: 2000,
            });
        }
    });
});
</script>

<script>
    function cancelall(){
            Swal.fire({
          title: "Are you sure?",
          text: "You want to Cancel this quotation?",
          icon: "warning",
          showCancelButton: true,
                  confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
        }).then((result) => {

          if (result.isConfirmed) {
        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
        $("#order_product").val("").selectpicker('refresh');
          }
        });
    }
</script>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .suppliers").addClass('open');
     $("#sidebar-menu .supplierssub").addClass('show');
     $("#sidebar-menu .suppliersadd").addClass('active-page');
    });
</script>
</body>
</html>