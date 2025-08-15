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
    <?php $dataview = ['customerdata' => $customerdata,'categories' => $categories,'sellerdata' =>$sellerdata,];
    echo view('partials/Customersidebar', $dataview); ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">View Profile</h6>
    </div>
    
    <div class="card h-100 p-0 radius-12 mb-20">
      <div class="card-header">
        <h6 class="card-title mb-0">Edit Profile</h6>
      </div>
      <div class="card-body">
        <form id="updateProfile">
          <div class="row gy-3">
            <div class="mb-20 col-sm-6">
              <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name <span class="text-danger-600">*</span></label>
              <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="Enter First Name" Value="<?=$customerdata['first_name'];?>" data-rule-required="true" data-msg-required="First Name is required.">
            </div>
            <div class="mb-20 col-sm-6">
              <label for="lname" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name <span class="text-danger-600">*</span></label>
              <input type="text" class="form-control radius-8" name="lname" id="lname" placeholder="Enter Last Name" Value="<?= $customerdata['last_name'];?>" data-rule-required="true" data-msg-required="Last Name is required.">
            </div>
            <div class="mb-20 col-sm-6">
              <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
              <input type="email" name="email" class="form-control radius-8" id="email" placeholder="Enter Email" Value="<?= $customerdata['email'];?>"  data-rule-required="true" data-msg-required="Email is required."  data-rule-email="true" data-msg-email="Enter a valid email address.">
            </div>
            <div class="mb-20 col-sm-6">
              <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
              <input type="text" class="form-control radius-8" name="number" id="number" placeholder="Enter phone number" Value="<?= $customerdata['phone_number'];?>"  data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890).">
            </div>
            <div class="mb-20">
              <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
              <textarea name="#0" class="form-control radius-8" id="desc" placeholder="Write description..."><?= $customerdata['description'];?></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2"> 
        <button id="submitForm" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
          Update </button> </div>
      </div>
    </div>
    <div class="card h-100 p-0 radius-12 scrollclass">
      <div class="card-header">
        <h6 class="card-title mb-0">Change Password</h6>
      </div>
      <div class="card-body">
        <form id="updatePassword">
          <div class="row gy-3">
            <div class="mb-20">
              <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger-600">*</span></label>
              <div class="position-relative">
                <input type="password" class="form-control radius-8" id="your-password" placeholder="Enter New Password*" name="your-password"  data-rule-required="true" data-msg-required="Password is required.">
                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span> </div>
            </div>
            <div class="mb-20">
              <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
              <div class="position-relative">
                <input type="password" class="form-control radius-8" id="confirm-password" name="confirm-password" placeholder="Confirm Password*"  data-rule-required="true" data-msg-required="Please confirm your password." data-rule-equalto="#your-password"  data-msg-equalto="Passwords do not match.">
                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span> </div>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2"> <a id="submitFormpassword" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
          Change Password </a> </div>
      </div>
    </div>
  </div>
  <!-- footer -->
  <?php echo view('partials/Customerfooter'); ?>

  <!-- JS -->
  <?php echo view('partials/Customerjs'); ?>
<script>
  let table = new DataTable('#dataTable');
</script>
<script>
$(document).ready(function () {
    $.validator.addMethod("phoneau", function (value, element) {
        return this.optional(element) ||/^(?:\+1\s?)?(?:\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/.test(value);
    }, "Please enter a valid phone number.");
    // Initialize validation
    $("#updateProfile").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#submitForm").on("click", function () {

    if ($("#updateProfile").valid()) {
      
        // Get form data
        let formData = {
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            number: $('#number').val(),
            desc: $('#desc').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
    Swal.fire({
        title: "Are you sure?",
        text: "You want to update your profile?",
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
            url: '<?= base_url('/profile-update') ?>',
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
    $("#updatePassword").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#submitFormpassword").on("click", function () {

    if ($("#updatePassword").valid()) {
        // Get form data
        let formData = {
            yourpassword: $('#your-password').val(),
            confirmpassword: $('#confirm-password').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
Swal.fire({
        title: "Are you sure?",
         text: "You want to update your password?",
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
            url: '<?= base_url('/profile-update-password') ?>',
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

</body>
</html>