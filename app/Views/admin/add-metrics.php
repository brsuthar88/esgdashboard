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
      <h6 class="fw-semibold mb-0">Add Metrics</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard </a> </li>
        <li>></li>
        <li class="fw-medium">Metrics</li>
      </ul>
    </div>
    <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
      <div class="card-header">
        <h6 class="text-lg mb-0">Metrics Details</h6>
      </div>
      <form id="myForm">
      <div class="card-body p-24 pt-10">
            <div class="row gy-3">
              <div class="mb-20 col-sm-6">
                <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">Metric Name <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="e.g., Scope 3 Emissions"  data-rule-required="true" data-msg-required="First Name is required.">
              </div>
              <div class="mb-20 col-sm-6">
                  <label for="destatus" class="form-label fw-semibold text-primary-light text-sm mb-8">Category <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" name="destatus" id="destatus" data-rule-required="true" data-msg-required="Status is required.">
                  <option value="1">Climate & Emissions </option>
                  <option value="0">Water Management </option>
                   <option value="2">Diversity & Inclusion </option>
                  <option value="3">Governance </option>
                </select>
              </div>
               <div class="mb-20 col-sm-6">
                <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">Unit of Measurement <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="e.g., tCO2e, %, m³"  data-rule-required="true" data-msg-required="First Name is required.">
              </div>
              <div class="mb-20 col-sm-6">
                  <label for="destatus" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" name="destatus" id="destatus" data-rule-required="true" data-msg-required="Status is required.">
                  <option value="1">Active </option>
                  <option value="0">Inactive </option>
                </select>
              </div>
             
              <div class="mb-20 col-sm-12">
                <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                <textarea name="#0" class="form-control radius-8" id="desc" placeholder="Describe what this metric measures..."></textarea>
              </div>
              <div><b>Threshold Configuration</b><br></div>
               <div class="mb-20 col-sm-4">
                   
                <label for="fname" class="form-label fw-semibold text-success text-sm mb-8">Good Range <span class="text-danger-600">*</span></label>
                <input type="number" class="form-control radius-8" id="fname" name="fname" placeholder="Min"  data-rule-required="true" data-msg-required="First Name is required.">
              </div>
               <div class="mb-20 col-sm-4">
                <label for="fname" class="form-label fw-semibold text-warning text-sm mb-8">Warning Range <span class="text-danger-600">*</span></label>
                <input type="number" class="form-control radius-8" id="fname" name="fname" placeholder="Min"  data-rule-required="true" data-msg-required="First Name is required.">
              </div>
               <div class="mb-20 col-sm-4">
                <label for="fname" class="form-label fw-semibold text-danger text-sm mb-8">Critical Range <span class="text-danger-600">*</span></label>
                <input type="number" class="form-control radius-8" id="fname" name="fname" placeholder="Min"  data-rule-required="true" data-msg-required="First Name is required.">
              </div>
            </div>
       
      </div>
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2"> <a href="javascript:void(0)" id="submitdata" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
          Add Metric </a>  <a href="#" onclick="resetpages('/admin/add-customer')"  class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:times-circle-filled" class="text-xl"></iconify-icon>
          Cancle </a> </div>
      </div>
      </form>
    </div>
  </div>
 <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>

<script>
  let table = new DataTable('#dataTable');
</script>

<script>
$(document).ready(function () 
{
    $.validator.addMethod("phoneau", function (value, element) 
    {
        return this.optional(element) ||/^(?:\+1\s?)?(?:\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/.test(value);
    }, "Please enter a valid phone number.");
    // Initialize validation
    $("#myForm").validate(
    {
        focusInvalid: true, // Focus the invalid field
        invalidHandler: function (event, validator) 
        {
            // Scroll to the first invalid element
            $('html, body').animate(
            {
                scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
            }, 500);
        }
    });


    // Attach onclick handler to the button
    $("#submitdata").on("click", function () 
    {
        if ($("#myForm").valid()) 
        {
            Swal.fire(
            {
                title: "Are you sure ?",
                text: "You want to save this customer?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Continue it!",
                cancelButtonText: "No, cancel",
                }).then((result) => 
                {
                    if (result.isConfirmed) 
                    {
                        let formData = 
                        {
                            fname: $('#fname').val(),
                            lname: $('#lname').val(),
                            email: $('#email').val(),
                            number: $('#number').val(),
                            depart: $('#depart').val(),
                            sellerid: $('#sellerid').val(),
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
                        // AJAX request
                        $.ajax(
                        {
                            url: '<?= base_url('/admin/save-customer') ?>',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function(response) 
                            {
                                console.log(response);
                                // Display success or error message
                                if (response.status === 'success') 
                                {
                                    Swal.fire(
                                    {
                                        title: "Success",
                                        text: response.message,
                                        icon: "success",
                                        timer: 2000,
                                        allowOutsideClick: false,
                                        willClose: () => {
                                        window.location.href ='/admin/list-customer';
                                    },
                                });
                                
                            } 
                            else 
                            {
                                Swal.fire(
                                {
                                    icon: "error",
                                    title: "Oops...",
                                    text: response.message,
                                    timer: 2000,
                                });
                            }
                        },
                        error: function() 
                        {
                            Swal.fire(
                            {
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
$("#submitdatasend").on("click", function () 
{
    if ($("#myForm").valid()) 
    {
        Swal.fire(
        {
            title: "Are you sure?",
            text: "You want to save and send this customer?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, Continue it!",
            cancelButtonText: "No, cancel",
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                // Get form data
                let formData = 
                {
                    fname: $('#fname').val(),
                    lname: $('#lname').val(),
                    email: $('#email').val(),
                    number: $('#number').val(),
                    depart: $('#depart').val(),
                    destatus: $('#destatus').val(),
                    sellerid: $('#sellerid').val(),
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
                // AJAX request
                $.ajax(
                {
                    url: '<?= base_url('/admin/save-send-customer') ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) 
                    {
                        console.log(response);
                        // Display success or error message
                        if (response.status === 'success') 
                        {
                            Swal.fire(
                            {
                                title: "Success",
                                text: response.message,
                                icon: "success",
                                timer: 2000,
                                allowOutsideClick: false,
                                willClose: () => 
                                {
                                    window.location.href ='/admin/list-customer';
                                },
                            });
                        } 
                        else 
                        {
                            Swal.fire(
                            {
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                                timer: 2000,
                            });
                        }
                    },
                    error: function() 
                    {
                        Swal.fire(
                        {
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
    }).then((result) => 
    {
        if (result.isConfirmed) 
        {
            // window.location.href = url; // Redirect if confirmed
            const form = document.getElementById('myForm');
          
            if (form) 
            {
                form.reset(); // Reset the form fields
            }
        }
    });
}
</script>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .metrics").addClass('open');
     $("#sidebar-menu .metricssub").addClass('show');
     $("#sidebar-menu .metricsadd").addClass('active-page');
    });
</script>
</body>
</html>