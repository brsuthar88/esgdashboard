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
</style>
</head>
<body>
    <!-- Sidebar -->
    <?php $dataview = ['admindata' => $admindata,];
    echo view('admin/partials/adminsidebar', $dataview);
?>

  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Edit Sales Person</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
            <li>></li>
         <li class="fw-medium"> <a href="/admin/list-person" class="d-flex align-items-center gap-1 hover-text-primary">List Sales Person</a></li>
         <li>></li>
        <li class="fw-medium">Edit Sales Person</li>
      </ul>
    </div>
    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
      <div class="card-header pt-16 pb-0 px-24 bg-base border border-end-0 border-start-0 border-top-0 d-flex align-items-center flex-wrap justify-content-between">
        <h6 class="text-lg mb-0"> Sales Person Details</h6>
      </div>
         <form id="myForm">
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
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2"> <a href="javascript:void(0)" id="submitdata" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
          Update </a>  <a href="#" onclick="resetpages('/admin/edit-person/<?= isset($seller['sales_person_id']) ? htmlspecialchars($seller['sales_person_id']) : '' ?>')"  class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:times-circle-filled" class="text-xl"></iconify-icon>
          Reset </a> </div>
      </div>
    </div>
  </div>
  <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>

<script>
  let table = new DataTable('#dataTable');
</script>
 <?php if($seller == "error"){ ?>
<script>
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Your salesperson has been removed. Please contact the administrator.",
        timer: 5000,
        allowOutsideClick: false,
        willClose: () => {
        window.location.href = '/admin/login';
     },
    });
</script>
<?php } ?>
<script>
$(document).ready(function () {
    $.validator.addMethod("phoneau", function (value, element) {
        return this.optional(element) ||/^(?:\+1\s?)?(?:\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/.test(value);
    }, "Please enter a valid phone number.");
  // Initialize validation
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
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            number: $('#number').val(),
            sellerid: $('#sellerid').val(),
            destatus: $('#destatus').val(),
            desc: $('#desc').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
         Swal.fire({
        title: "Are you sure?",
        text: "You want to update this sales person?",
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
            url: '<?= base_url('/admin/update-person') ?>',
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
                         window.location.href ='/admin/list-person';
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
     $("#sidebar-menu .seller").addClass('open');
     $("#sidebar-menu .sellersub").addClass('show');
     $("#sidebar-menu .sellerlist").addClass('active-page');
    });
</script>
<script>
function resetpages(url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to reset this sales person?",
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
</body>
</html>