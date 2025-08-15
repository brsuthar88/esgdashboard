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
</style>
</head>
<body>
    <!-- Sidebar -->
    <?php $dataview = ['sellerdata' => $sellerdata,];
    echo view('salesperson/partials/Sellersidebar', $dataview);
    ?>

  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Edit Customer</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/seller" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard </a> </li>
            <li>></li>
         <li class="fw-medium"> <a href="/seller/list-customer" class="d-flex align-items-center gap-1 hover-text-primary">List Customers</a></li>
         <li>></li>
        <li class="fw-medium">Edit Customer</li>
      </ul>
    </div>
    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
      <div class="card-header pt-16 pb-0 px-24 bg-base border border-end-0 border-start-0 border-top-0 d-flex align-items-center flex-wrap justify-content-between">
        <h6 class="text-lg mb-0">Customer Details</h6>
      </div>
       <form id="myForm">
      <div class="card-body p-24 pt-10">
            <div class="row gy-3">
              <div class="mb-20 col-sm-6">
                <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="Enter First Name"  data-rule-required="true" data-msg-required="First Name is required." value="<?= isset($customerdata['first_name']) ? htmlspecialchars($customerdata['first_name']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="lname" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="lname" name="lname" placeholder="Enter Last Name" data-rule-required="true" data-msg-required="Last Name is required." value="<?= isset($customerdata['last_name']) ? htmlspecialchars($customerdata['last_name']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                <input type="email" class="form-control radius-8" id="email" placeholder="Enter Email" name="email" data-rule-required="true" data-msg-required="Email is required."  data-rule-email="true" data-msg-email="Enter a valid email address." value="<?= isset($customerdata['email']) ? htmlspecialchars($customerdata['email']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                <input type="text" class="form-control radius-8" id="number" name="number" placeholder="Enter phone number" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)." value="<?= isset($customerdata['phone_number']) ? htmlspecialchars($customerdata['phone_number']) : '' ?>">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="depart" class="form-label fw-semibold text-primary-light text-sm mb-8">Category <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" name="depart" id="depart" data-rule-required="true" data-msg-required="Category is required.">
                <?php
                foreach ($custocate as $catrow):?>
                <?php if($customerdata['customer_category_id'] == $catrow['customer_category_id']) { ?>
                  <option selected="selected" value="<?= $catrow['customer_category_id'];?>"><?= $catrow['category_name'];?> </option>
                <?php } else { ?>
                    <option value="<?= $catrow['customer_category_id'];?>"><?= $catrow['category_name'];?> </option>
                <?php } endforeach; ?>
                </select>
              </div>
              
              <div class="mb-20 col-sm-6">
                <label for="destatus" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" name="destatus" id="destatus" data-rule-required="true" data-msg-required="Status is required." >
                  <option value="1" <?= $customerdata['status'] == 1 ? 'selected' : '' ?>>Active </option>
                  <option value="0" <?= $customerdata['status'] == 0 ? 'selected' : '' ?>>Inactive </option>
                </select>
              </div>
              <div class="mb-20 col-sm-12">
                <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                <textarea name="#0" class="form-control radius-8" id="desc" placeholder="Write description..."><?= isset($customerdata['description']) ? htmlspecialchars($customerdata['description']) : '' ?></textarea>
              </div>
            </div>
            <div class="row gy-3">
              <div class="col-md-6">
				   <span class="card-title mb-10">Billing Address </span>
                
                <div class="row gy-3">
                 
					   <div class="col-12">
                    <label class="form-label">Country</label>
                    <input type="text" name="#0" class="form-control" id="bcountry" placeholder="country" value="USA" disabled>
                  </div>
					 <div class="col-12">
                    <label class="form-label">Address <span class="text-danger-600">*</span></label>
                   <textarea name="baddress" class="form-control radius-8" id="baddress" placeholder="Address"  data-rule-required="true" data-msg-required="Address is required."><?= isset($customerdata['billing_address']) ? htmlspecialchars($customerdata['billing_address']) : '' ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">City <span class="text-danger-600">*</span></label>
                    <input type="text" name="bcity" class="form-control" id="bcity"  placeholder="City" value="<?= isset($customerdata['billing_city']) ? htmlspecialchars($customerdata['billing_city']) : '' ?>" data-rule-required="true" data-msg-required="City is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">State <span class="text-danger-600">*</span></label>
                    <input type="text" name="bstate" class="form-control" id="bstate"  placeholder="State" value="<?= isset($customerdata['billing_state']) ? htmlspecialchars($customerdata['billing_state']) : '' ?>"  data-rule-required="true" data-msg-required="State is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">Zip Code <span class="text-danger-600">*</span></label>
                    <input type="text" name="bzip" class="form-control" id="bzip"  placeholder="Zip Code" value="<?= isset($customerdata['billing_pincode']) ? htmlspecialchars($customerdata['billing_pincode']) : '' ?>"  data-msg-rangelength="Please enter a valid 5-digit zip code." data-rule-rangelength="5,5" data-rule-digits="true" data-rule-required="true" data-msg-required="Zip Code is required.">
                  </div>
                   
                  <div class="col-12">
                    <label class="form-label">Phone <span class="text-danger-600">*</span></label>
                   <input type="text" class="form-control" name="bphone" id="bphone"  placeholder="Phone" value="<?= isset($customerdata['billing_phone_number']) ? htmlspecialchars($customerdata['billing_phone_number']) : '' ?>" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)." data-rule-required="true" data-msg-required="Phone is required.">
                   
                  </div>
                 
                 
                </div>
              </div>
              <div class="col-md-6">
                <span class="card-title mb-10">Shipping Address 
					(<a href="#" id="copyAddressBtn" class="text-info-main text-sm">
       
        Copy Billing Address </a>)
					
					
					</span>
                <div class="row gy-3">
					 <div class="col-12">
                    <label class="form-label">Country</label>
                    <input type="text" name="#0" class="form-control" id="scountry" Stateplaceholder="country" value="USA" disabled>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Address <span class="text-danger-600">*</span></label>
                   <textarea name="saddress" class="form-control radius-8" id="saddress" placeholder="Address" data-rule-required="true" data-msg-required="Address is required."><?= isset($customerdata['shipping_address']) ? htmlspecialchars($customerdata['shipping_address']) : '' ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">City <span class="text-danger-600">*</span></label>
                    <input type="text" name="scity" class="form-control" id="scity" placeholder="City" value="<?= isset($customerdata['shipping_city']) ? htmlspecialchars($customerdata['shipping_city']) : '' ?>" data-rule-required="true" data-msg-required="City is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">State <span class="text-danger-600">*</span></label>
                    <input type="text" name="sstate" class="form-control" id="sstate" placeholder="State" value="<?= isset($customerdata['shipping_state']) ? htmlspecialchars($customerdata['shipping_state']) : '' ?>" data-rule-required="true" data-msg-required="State is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">Zip Code <span class="text-danger-600">*</span></label>
                    <input type="text" name="szip" class="form-control" id="szip" placeholder="Zip Code" value="<?= isset($customerdata['shipping_pincode']) ? htmlspecialchars($customerdata['shipping_pincode']) : '' ?>" data-msg-rangelength="Please enter a valid 5-digit zip code." data-rule-rangelength="5,5" data-rule-digits="true" data-rule-required="true" data-msg-required="Zip Code is required.">
                  </div>
                  
                  <div class="col-12">
                    <label class="form-label">Phone <span class="text-danger-600">*</span></label>
                   <input type="text" class="form-control" name="sphone" id="sphone" placeholder="Phone" value="<?= isset($customerdata['shipping_phone_number']) ? htmlspecialchars($customerdata['shipping_phone_number']) : '' ?>" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)." data-rule-required="true" data-msg-required="Phone is required.">
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="customerid" value="<?= isset($customerdata['customer_id']) ? htmlspecialchars($customerdata['customer_id']) : '' ?>">
           
      </div>
      </form>
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2"> <a href="javascript:void(0)" id="submitdata" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
          Update </a>  <a href="#" onclick="resetpages('/seller/edit-customer/<?= isset($customerdata['customer_id']) ? htmlspecialchars($customerdata['customer_id']) : '' ?>')" class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:times-circle-filled" class="text-xl"></iconify-icon>
          Reset </a> </div>
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

    $("#submitdata").on("click", function () {

    if ($("#myForm").valid()) {
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
                         window.location.href ='/seller/list-customer';
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
     $("#sidebar-menu .customer").addClass('open');
     $("#sidebar-menu .customersub").addClass('show');
     $("#sidebar-menu .customerlist").addClass('active-page');
    });
</script>
<script>
function resetpages(url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to reset this customer?",
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