<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
<?php echo view('admin/partials/admincss'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple {
            height: auto !important;
            min-height: 38px;
        }
        .selection{display:block;}
        .select2-container .select2-search--inline .select2-search__field{height: 22px;}
        .select2-dropdown{margin-top: -28px;}

.form-check .form-check-input {
    margin: 5px 6px 0 0;
}
</style>
</head>
<body>
    <!-- Sidebar -->
    <?php 
    $dataview = ['admindata' => $admindata,'getcompany'=>$getcompany];
    echo view('admin/partials/adminsidebar', $dataview);

    ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Add Parent Company</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="/" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>></li>
            <li class="fw-medium">Parent Company</li>
        </ul>
    </div>

    <div class="card h-100 p-0 radius-12">
        <div class="card-body">
            <form id="myForm">
                <div class="row gy-3">
                    <div class="mb-20 col-sm-6">
                        <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Full Name <span class="text-danger-600">*</span>
                        </label>
                        <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="Enter Full name" 
                               data-rule-required="true" data-msg-required="Full Name is required.">
                    </div>

                    <div class="mb-20 col-sm-6">
                        <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Email Address <span class="text-danger-600">*</span>
                        </label>
                        <input type="email" class="form-control radius-8" id="email" name="email" placeholder="user@company.com" 
                               data-rule-required="true" data-msg-required="Email is required." 
                               data-rule-email="true" data-msg-email="Enter a valid email address.">
                    </div>

                    <div class="mb-20 col-sm-6">
                        <label for="desig" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Role <span class="text-danger-600">*</span> 
                        </label>
                        <select class="form-control radius-8 form-select" id="desig" name="desig" 
                                data-rule-required="true" data-msg-required="Role is required.">
                            <option value="0">Company Manager</option>
                        </select>
                    </div>

                    <div class="mb-20 col-sm-6">
                        <label for="cnames" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Company <span class="text-danger-600">*</span> 
                        </label>
                         <input type="text" class="form-control radius-8" id="cnames" name="cnames" placeholder="Enter Company name" 
                               data-rule-required="true" data-msg-required="Company is required.">
                    </div>
                     <div class="mb-20 col-sm-12">
                        <label for="cnames" class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Choose Suppliers<span class="text-danger-600">*</span> 
                        </label>
                            <select class="form-select multi-select1" id="suppliersselect" multiple>
                               <?php foreach($getcompany as $values) { ?>
                                <option value="<?php echo $values['company_id']; ?>">
                                    <?php echo $values['email']; ?>(<?php echo $values['cvr']; ?>)
                                </option>
                                <?php } ?>
                            </select>
                    </div>

                    <div class="mb-20 col-sm-6">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Permissions <span class="text-danger-600">*</span> 
                        </label>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input radius-4 border border-neutral-400" 
                                               type="checkbox" name="checkbox" value="dashboardView" id="dashboardView">
                                        <label class="form-check-label" for="dashboardView">Dashboard View</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input radius-4 border border-neutral-400" 
                                               type="checkbox" name="checkbox" value="dataEntry" id="dataEntry">
                                        <label class="form-check-label" for="dataEntry">Data Entry</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input radius-4 border border-neutral-400" 
                                               type="checkbox" name="checkbox" value="metricsView" id="metricsView">
                                        <label class="form-check-label" for="metricsView">Metrics View</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input radius-4 border border-neutral-400" 
                                               type="checkbox" name="checkbox" value="evidenceUpload" id="evidenceUpload">
                                        <label class="form-check-label" for="evidenceUpload">Evidence Upload</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input radius-4 border border-neutral-400" 
                                               type="checkbox" name="checkbox" value="reportsExport" id="reportsExport">
                                        <label class="form-check-label" for="reportsExport">Reports Export</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input radius-4 border border-neutral-400" 
                                               type="checkbox" name="checkbox" value="companySettings" id="companySettings">
                                        <label class="form-check-label" for="companySettings">Company Settings</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end permissions -->
                </div>
            </form>
        </div>

        <div class="card-footer">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                <a href="javascript:void(0)" id="submitdata"  
                   class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
                    <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
                    Add Parent Company
                </a>
                <a href="#" onclick="resetpages('/admin/add-user')" 
                   class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
                    <iconify-icon icon="pepicons-pencil:times-circle-filled" class="text-xl"></iconify-icon>
                    Cancel
                </a>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.multi-select1').select2({
            placeholder: "Choose Suppliers",
            width: '100%'
        });
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

    $("#submitdata").on("click", function () {
        if ($("#myForm").valid()) {

            // Collect checked permissions
            let permissions = [];
            $("input[name='checkbox']:checked").each(function () {
                permissions.push($(this).val());
            });

            let formData = {
                fname: $('#fname').val(),
                email: $('#email').val(),
                cnames: $('#cnames').val(),
                suppliers: $('#suppliersselect').val(),
                permissions: permissions,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            };

            Swal.fire({
                title: "Are you sure?",
                text: "You want to save this Parent Company?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Continue it!",
                cancelButtonText: "No, cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('/admin/save-user') ?>',
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
                                        window.location.href = '/admin/list-user';
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
    });
});
</script>

<script>
function resetpages(url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to reset this Parent Company?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('myForm');
            if (form) {
                form.reset();
            }
        }
    });
}
</script>

<script>
$(document).ready(function() {
    $("#sidebar-menu .user").addClass('open');
    $("#sidebar-menu .usersub").addClass('show');
    $("#sidebar-menu .useradd").addClass('active-page');
});
</script>

</body>
</html>
