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

<section class="auth forgot-password-page bg-base d-flex flex-wrap">  
   <!-- <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="../assets/images/auth/auth-img.png" alt="">
        </div>
    </div>-->
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center" style="margin: 0 auto;">
        <div class="max-w-500-px mx-auto w-100">
            <div>
                 <a href="index.html" class="mb-40 max-w-290-px">
                    <img src="assets/images/logo.png" alt="" style="width: 270px;">
                </a>
                <h4 class="mb-12">Forgot Password</h4>
                <p class="mb-32 text-secondary-light text-lg">Enter the email address associated with your account and we will send you an updated password.</p>
            </div>
            <form id="forgot" action="<?= site_url('/send-password') ?>" method="post">
                <div class="icon-field">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Enter Email" data-rule-required="true" data-msg-required="Email is required."  data-rule-email="true" data-msg-email="Enter a valid email address.">
                </div>
                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32" >Continue</button>

                <div class="text-center">
                    <a href="/login" class="text-primary-600 fw-bold mt-24">Back to Sign In</a>
                </div>
                
                <div class="mt-120 text-center text-sm">
                    <p class="mb-0">Already have an account? <a href="/login" class="text-primary-600 fw-semibold">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
        <div class="modal-body p-40 text-center">
            <div class="mb-32">
                <img src="../assets/images/auth/auth-img.png" alt="">
            </div>
            <h6 class="mb-12">Verify your Email</h6>
            <p class="text-secondary-light text-sm mb-0">Thank you, check your email for instructions to reset your password</p>
            <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Skip</button>
            <div class="mt-32 text-sm">
                <p class="mb-0">Don’t receive an email? <a href="resend.html" class="text-primary-600 fw-semibold">Resend</a></p>
            </div>
        </div>
        </div>
    </div>
</div>


<!-- JS -->
  <?php echo view('partials/Customerjs'); ?>
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
        $("#forgot").validate({
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
