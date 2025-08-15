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

<section class="auth forgot-password-page bg-base d-flex flex-wrap">  
   <!-- <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="/assets/images/auth/auth-img.png" alt="">
        </div>
    </div>-->
       <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center" style="margin: 0 auto;">
        <div class="max-w-500-px mx-auto w-100">
            <div>
                <a href="/admin" class="mb-40 max-w-290-px">
                    <img src="../../assets/images/logo.png" alt="" style="width: 270px;">
                </a>
                <h5>Admin</h5>
                <h4 class="mb-12">Reset Password</h4>
                <p class="mb-32 text-secondary-light text-lg">Enter the Password and Confirm Password.</p>
            </div>
            <form id="resetpass" action="<?= site_url('/admin/reset-poccess-password') ?>" method="post">
                 <input type="hidden" name="token" value="<?= esc($token) ?>">
                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span> 
                        <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Password" value="<?= isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : '' ?>"  data-rule-required="true" data-msg-required="Password is required.">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                </div>
                 <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span> 
                        <input type="password" name="cpassword" class="form-control h-56-px bg-neutral-50 radius-12" id="confirm-password" placeholder="ConfirmPassword" value="<?= isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : '' ?>" data-rule-required="true" data-msg-required="Please confirm your password." data-rule-equalto="#your-password"  data-msg-equalto="Passwords do not match.">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                </div>
                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32" >Continue</button>

                <div class="text-center">
                    <a href="/admin/login" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
                </div>
                
                <div class="mt-120 text-center text-sm">
                    <p class="mb-0">Already have an account? <a href="/admin/login" class="text-primary-600 fw-semibold">Sign In</a></p>
                </div>
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
<?php if (session()->getFlashdata('msg')): ?>
<script>
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "<?= session()->getFlashdata('msg'); ?>",
        timer: 2000,
    });
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
<script>
    Swal.fire({
      title: "Success",
      text: "<?= session()->getFlashdata('success'); ?>",
      icon: "success",
      timer: 2000,
      allowOutsideClick: false,
    });
</script>
<?php endif; ?>
<script>
     $(document).ready(function() {
            $("#resetpass").validate({
              focusInvalid: true, // Focus the invalid field
              invalidHandler: function (event, validator) {
                // Scroll to the first invalid element
                $('html, body').animate({
                  scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
                }, 500);
              }
            });
    });
</script>
</body>
</html>
