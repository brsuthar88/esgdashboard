<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VSME Dashboard - ESG Reporting Platform</title>
  <link rel="icon" type="image/png" href="../assets/images/favicon.png" sizes="16x16">
<!-- css -->
  <?php echo view('admin/partials/admincss'); ?>
</head>
  <body>

<section class="auth bg-base d-flex flex-wrap">
    <!--<div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="../assets/images/auth/auth-img.png" alt="">
        </div>
    </div>-->
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center" style="margin: 0 auto;">
        <div class="max-w-500-px mx-auto w-100">
            <div>
                <a href="/admin" class="mb-40 max-w-290-px">
                    <img src="../assets/images/logo.png" alt="" style="width: 270px;">
                </a>
                <h5>Admin Login</h5>
                <h4 class="mb-12">Sign In to your Account</h4> 
                <p class="mb-32 text-secondary-light text-lg">Welcome back! please enter your detail</p>
            </div>
             <form id="loginForm">
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" id="email" placeholder="Email" value="<?=isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''?>" data-rule-required="true" data-msg-required="Email is required."  data-rule-email="true" data-msg-email="Enter a valid email address.">
                </div>
                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Password" value="<?=isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : ''?>"  data-rule-required="true" data-msg-required="Password is required.">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                        </div>
                        <a href="/admin/forgot-password" class="text-primary-600 fw-medium">Forgot Password?</a>
                    </div>
                </div>
                <button id="btn_submit" type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button>
            </form>
        </div>
    </div>
</section>



  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>

<script>
      // ================== Password Show Hide Js Start ==========
      function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
  // ========================= Password Show Hide Js End ===========================
</script>
 <script>
    function submitForm() {
        // Get form data
        let formData = {
            email: $('#email').val(),
            password: $('#your-password').val(),
             <?=csrf_token()?>: '<?=csrf_hash()?>'
        };

        // AJAX request
        $.ajax({
            url: '<?=base_url('/admin/login')?>',
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
                               showConfirmButton: false,
                               willClose: () => {
                                    $('#loginForm')[0].reset();
                                    window.location.href = '/admin';
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

    $(document).ready(function() {
          $.validator.addMethod("phoneau", function (value, element) {
            return this.optional(element) || /^(\+61|0)?\s?\(?\d{1,2}\)?\s?\d{4}\s?\d{4}$/.test(value);
            }, "Please enter a valid Australian phone number.");
            // Initialize validation
            $("#loginForm").validate({
              focusInvalid: true, // Focus the invalid field
              invalidHandler: function (event, validator) {
                // Scroll to the first invalid element
                $('html, body').animate({
                  scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
                }, 500);
              }
            });
        
        
        
        $('#loginForm').submit(function(e) {
            e.preventDefault();
             if ($("#loginForm").valid()) {
                submitForm();
             }
        });
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
      showConfirmButton: false,
      allowOutsideClick: false,
    });
</script>
<?php endif;?>

</body>
</html>
