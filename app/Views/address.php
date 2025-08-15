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
    echo view('partials/Customersidebar', $dataview);
    
    ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Address</h6>
      
    </div>
	  
	  
    <div class="card h-100 p-0 radius-12 mb-20 ">
		
      <div class="card-body">
        <form id="addressform">
          <div class="row gy-3">
              <div class="col-md-6">
				   <span class="card-title mb-10">Billing Address </span>
                
                <div class="row gy-3">
                 
					   <div class="col-12">
                    <label class="form-label">Country</label>
                    <input type="text" name="#0" class="form-control" placeholder="country" value="USA" disabled>
                  </div>
					 <div class="col-12">
                    <label class="form-label">Address <span class="text-danger-600">*</span></label>
                   <textarea name="billing_address" class="form-control radius-8" id="billing_address" placeholder="Address"  data-rule-required="true" data-msg-required="Address is required."><?= $customerdata['billing_address']; ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">City <span class="text-danger-600">*</span></label>
                    <input type="text" id="billing_city" class="form-control" placeholder="City" value="<?= $customerdata['billing_city']; ?>"  data-rule-required="true" data-msg-required="City is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">State <span class="text-danger-600">*</span></label>
                    <input type="text" id="billing_state" name="billing_state" class="form-control" placeholder="State" value="<?= $customerdata['billing_state']; ?>"   data-rule-required="true" data-msg-required="State is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">Zip Code <span class="text-danger-600">*</span></label>
                    <input type="text" id="billing_pincode" name="billing_pincode" class="form-control" placeholder="Zip Code" value="<?= $customerdata['billing_pincode']; ?>" data-msg-rangelength="Please enter a valid 5-digit zip code." data-rule-rangelength="5,5" data-rule-digits="true"  data-rule-required="true" data-msg-required="Zip Code is required.">
                  </div>
                   
                  <div class="col-12">
                    <label class="form-label">Phone <span class="text-danger-600">*</span></label>
                   <input type="text" id="billing_phone_number"  name="billing_phone_number" class="form-control" placeholder="Phone" value="<?= $customerdata['billing_phone_number']; ?>" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)."  data-rule-required="true" data-msg-required="Phone is required.">
                   
                  </div>
                 
                 
                </div>
              </div>
              <div class="col-md-6">
                <span class="card-title mb-10">Shipping Address 
					(<a id="copyAddressBtn" style="cursor: pointer;" class="text-info-main text-sm">Copy Billing Address </a>)
					</span>
                <div class="row gy-3">
					 <div class="col-12">
                    <label class="form-label">Country</label>
                    <input type="text" name="#0" class="form-control" placeholder="country" value="USA" disabled>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Address <span class="text-danger-600">*</span></label>
                   <textarea name="shipping_address" class="form-control radius-8" id="shipping_address" placeholder="Address"  data-rule-required="true" data-msg-required="Address is required."><?= $customerdata['shipping_address']; ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">City <span class="text-danger-600">*</span></label>
                    <input type="text" id="shipping_city" name="shipping_city" class="form-control" placeholder="City" value="<?= $customerdata['shipping_city']; ?>"  data-rule-required="true" data-msg-required="City is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">State <span class="text-danger-600">*</span></label>
                    <input type="text" id="shipping_state" name="shipping_state" class="form-control" placeholder="State" value="<?= $customerdata['shipping_state']; ?>"  data-rule-required="true" data-msg-required="State is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">Zip Code <span class="text-danger-600">*</span></label>
                    <input type="text" id="shipping_pincode" name="shipping_pincode" class="form-control" placeholder="Zip Code" value="<?= $customerdata['shipping_pincode']; ?>" data-msg-rangelength="Please enter a valid 5-digit zip code." data-rule-rangelength="5,5" data-rule-digits="true"  data-rule-required="true" data-msg-required="Zip Code is required.">
                  </div>
                  
                  <div class="col-12">
                    <label class="form-label">Phone <span class="text-danger-600">*</span></label>
                   <input type="text" id="shipping_phone_number" name="shipping_phone_number" class="form-control" placeholder="Phone" value="<?= $customerdata['shipping_phone_number']; ?>" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)."  data-rule-required="true" data-msg-required="Phone is required.">
                   
                  </div>
                 
                 
                </div>
              </div>
            </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
			<a id="submitForm" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
            <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
            Update
          </a>
         
        </div>
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
$("#addressform").validate({
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
    Swal.fire({
          title: "Are you sure?",
          text: "You want to update your address?",
          icon: "warning",
          showCancelButton: true,
                  confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
        }).then((result) => {

          if (result.isConfirmed) {
    if ($("#addressform").valid()) {
        // Get form data
        let formData = {
            billing_address: $('#billing_address').val(),
            billing_city: $('#billing_city').val(),
            billing_state: $('#billing_state').val(),
            billing_pincode: $('#billing_pincode').val(),
            billing_phone_number: $('#billing_phone_number').val(),
            shipping_address: $('#shipping_address').val(),
            shipping_city: $('#shipping_city').val(),
            shipping_state: $('#shipping_state').val(),
            shipping_pincode: $('#shipping_pincode').val(),
            shipping_phone_number: $('#shipping_phone_number').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        

        // AJAX request
        $.ajax({
            url: '<?= base_url('/update-address') ?>',
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
          }
        });
  });
  });
    
    </script>
    <script>
    document.getElementById('copyAddressBtn').addEventListener('click', function() {
        document.getElementById('shipping_address').value = document.getElementById('billing_address').value;
        document.getElementById('shipping_city').value = document.getElementById('billing_city').value;
        document.getElementById('shipping_state').value = document.getElementById('billing_state').value;
        document.getElementById('shipping_pincode').value = document.getElementById('billing_pincode').value;
        document.getElementById('shipping_phone_number').value = document.getElementById('billing_phone_number').value;
    });
</script>
</body>
</html>