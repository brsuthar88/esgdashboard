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
    <?php $dataview = ['admindata' => $admindata]; 
echo view('admin/partials/adminsidebar', $dataview);
?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Category</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard </a> </li>
        <li>-</li>
        <li class="fw-medium">Customers</li>
      </ul>
    </div>
	  <div class="row gy-4">
      <div class="col-md-12">
        <div class="card scrollclass">
          <div class="card-header">
            <h6 class="card-title mb-0">Add Category</h6>
          </div>
          <div class="card-body">
            <form id="myForm">
				<div class="row gy-3">
                <div class="col-sm-6">
                    <label for="cname" class="form-label fw-semibold text-primary-light text-sm mb-8">Category Name <span class="text-danger-600">* (Same Name As Zoho)</span></label>
                     <select class="form-control radius-8 form-select" id="cname" name="cname" data-rule-required="true" data-msg-required="Category Name is required."> 
                        <option value="" selected disabled>Select Category</option>
                        <?php
                        foreach ($apiselectcat as $apicate) { 
                        ?>
                            <option value="<?=$apicate['pricebook_id'];?>" ><?=$apicate['name'];?></option>
                        <?php }?>
                    </select>
                </div>


					<div class="col-sm-6">
                    <label for="desig" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                    <select class="form-control radius-8 form-select" name="desig" id="desig" data-rule-required="true" data-msg-required="Status is required.">
                        <option value="1">Active </option>
                        <option value="0">Inactive </option>

                    </select>
                </div>
                <div>
                    <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                    <textarea name="#0" class="form-control radius-8" id="desc" placeholder="Write description..."></textarea>
                </div>

				</div>
            </form>
          </div>

			<div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
			<a href="javascript:void(0)" id="submitdata" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
            <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
            Save
          </a>


			<a  href="javascript:void(0);" onclick="resetpages('/admin/list-categories')" class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
            <iconify-icon icon="pepicons-pencil:times-circle-filled" class="text-xl"></iconify-icon>
           Reset
          </a>
        </div>
      </div>
        </div><!-- card end -->

      </div>
		  <div class="col-lg-12">
    <div class="card basic-data-table">
      <div class="card-body">
        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
          <thead>
            <tr>
             <th scope="col">#</th>
              <th scope="col">Category</th>
              <th scope="col" class="text-center">Status</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
          
          </tbody>
        </table>
      </div>
    </div>
  </div>
		    </div>
		    </div>
<div class="modal fade" id="viewcatechangeModal" tabindex="-1" aria-labelledby="catechangeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuschangeModalLabel">Categories Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
          <div class="row" id="catedata">
          </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="editchangeModal" tabindex="-1" aria-labelledby="editchangeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuschangeModalLabel">Edit Categorie</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
            <form id="myForm1">
          <div class="row">
                 <form action="#">
				<div class="row gy-3">
                <div class="col-sm-6">
                    <label for="cname1" class="form-label fw-semibold text-primary-light text-sm mb-8">Category Name <span class="text-danger-600">* (Same Name As Zoho)</span></label>
                    <input type="text" class="form-control radius-8" id="cname1" placeholder="Enter Category" data-rule-required="true" data-msg-required="Category Name is required.">
                </div>


					<div class="col-sm-6">
                    <label for="desig1" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                    <select class="form-control radius-8 form-select" id="desig1" data-rule-required="true" data-msg-required="Status is required.">
                        <option value="1">Active </option>
                        <option value="0">Inactive </option>

                    </select>
                </div>
                <div>
                    <label for="desc1" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                    <textarea name="#0" class="form-control radius-8" id="desc1" placeholder="Write description..."></textarea>
                </div>

				</div>
            </form>
          <input type="hidden" id="modalValue">
      </div>
       </form>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
        <button type="button" id="changecate" class="btn btn-primary text-sm px-24 py-12 radius-8"> Update Categories </button>
      </div>
    </div>
  </div>
</div>
</div>
  <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>

<script>
      $(document).ready(function () {
           var isMobile = $(window).width() <= 1024; // Detect mobile (adjust as needed)
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('/admin/datatable-list-categories') ?>',
                type: "POST"
            },
            columns: [
                { 
                    data: '',  // The row number from the server
                    orderable: false,    // Disable sorting for the row number column
                    searchable: false 

                },
                { data: 'category_name' },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        if (type === 'display') {
                   
                            if (data == 1) {
                                return '<span class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">Active</span> <input type="hidden" value="Active" id="status'+row['customer_category_id']+'"/>';
                            } else {
                                return '<span class="bg-neutral-200 text-neutral-600 border border-neutral-400 px-24 py-4 radius-4 fw-medium text-sm">Inactive</span><input type="hidden" value="Inactive" id="status'+row['customer_category_id']+'"/>';
                            }
                        }
                        return data == 1 ? 'Active' : 'Inactive';
                    }
                },
                {
                    data: 'customer_category_id',
                    render: function (data, type, row) {
                        return '<div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View" ><button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewcatechangeModal"  data-value="'+row['customer_category_id']+'"  > <i class="fas fa-eye" aria-hidden="true"></i></button></a></div><input type="hidden" value="'+row['pricebook_id']+'" id="cids'+row['customer_category_id']+'"><input type="hidden" value="'+row['category_name']+'" id="name'+row['customer_category_id']+'"><input type="hidden" value="'+row['desc']+'" id="deccription'+row['customer_category_id']+'"><input type="hidden" value="'+row['status']+'" id="status1'+row['customer_category_id']+'">';
                        
                        //<a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit" ><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editchangeModal" data-value="'+row['customer_category_id']+'"  ><i class="fa fa-pencil" aria-hidden="true"></i></button> </a><a  onclick="deletecate('+row['customer_category_id']+')" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-title="Delete" style="cursor: pointer;"><i class="fas fa-trash" aria-hidden="true"></i></a>
                    }
                }
            ],
            drawCallback: function () {
                // Initialize tooltips after DataTable has finished rendering
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
               "order": [],
            responsive: true,
            autoWidth: isMobile,
            searching: true,  // Disable searching on mobile
            columnDefs: [
                { "orderable": false, "targets": [0, -1] } 
            ],
            scrollX: isMobile // Enable scrolling on mobile

        });
    });
</script>

<script>
    // Add event listener for when the modal is shown
document.getElementById('editchangeModal').addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    // Extract value from data-* attribute
    var value = button.getAttribute('data-value');
    $('#cname1').val($("#name"+value).val());
    $('#desc1').val($("#deccription"+value).val());
    var Statusname = $('#status1'+value).val();
    $('#desig1').val(Statusname).trigger('change');
    var modalValue = document.getElementById('modalValue');
    modalValue.value=value;
});

</script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Boxed Tooltip
    $(document).ready(function() {
        $('.tooltip-button').each(function () {
            var tooltipButton = $(this);
            var tooltipContent = $(this).siblings('.my-tooltip').html();

            // Initialize the tooltip
            tooltipButton.tooltip({
                title: tooltipContent,
                trigger: 'hover',
                html: true
            });

            // Optionally, reinitialize the tooltip if the content might change dynamically
            tooltipButton.on('mouseenter', function() {
                tooltipButton.tooltip('dispose').tooltip({
                    title: tooltipContent,
                    trigger: 'hover',
                    html: true
                }).tooltip('show');
            });
        });
    });
</script>
<script>
$(document).ready(function () {
    $.validator.addMethod("phoneau", function (value, element) {
        return this.optional(element) || /^(\+61|0)?\s?\(?\d{1,2}\)?\s?\d{4}\s?\d{4}$/.test(value);
    }, "Please enter a valid Australian phone number.");
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
            cid: $('#cname').val(),
            cname:$("#cname option:selected").text(),
            desig: $('#desig').val(),
            desc: $('#desc').val(),
             <?=csrf_token()?>: '<?=csrf_hash()?>'
        };
 Swal.fire({
        title: "Are you sure?",
        text: "You want to save this categories?",
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
            url: '<?=base_url('/admin/save-categories')?>',
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
                           $('#dataTable').DataTable().ajax.reload(null, false);
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
    // Add event listener for when the modal is shown
document.getElementById('viewcatechangeModal').addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    // Extract value from data-* attribute
    var value = button.getAttribute('data-value');
    var name=$('#name'+value).val();
    var status=$('#status'+value).val();
    var deccription=$('#deccription'+value).val();
    var htmls='<div class="row"><form action="#"><div class="row gy-3"><div class="col-sm-6"><label for="b12" class="form-label fw-semibold text-primary-light text-sm mb-8">Category Name <span class="text-danger-600">* (Same Name As Zoho)</span></label><input type="text" class="form-control radius-8" id="b12" value="'+name+'" disabled></div><div class="col-sm-6"><label for="b21" class="form-label fw-semibold text-primary-light text-sm mb-8">Status </label><input type="text" class="form-control radius-8" id="b21" value="'+status+'" disabled></div><div> <label for="b22" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label><textarea name="#0" class="form-control radius-8" id="b22" disabled>'+deccription+'</textarea></div></div></form> <input type="hidden" id="modalValue"></div>';
    document.getElementById('catedata').innerHTML=htmls;
});

</script>
<script>
$("#myForm1").validate();
$("#changecate").on("click", function () {

    if ($("#myForm1").valid()) {
    // Get form data
    let formData = {
        cname1: $('#cname1').val(),
        desig1: $('#desig1').val(),
        desc1: $('#desc1').val(),
        modalValue: $('#modalValue').val(),
        <?=csrf_token()?>: '<?=csrf_hash()?>'
    };
 Swal.fire({
        title: "Are you sure?",
        text: "You want to change this categories?",
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
                url: '<?=base_url('/admin/edit-categories')?>',
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
                            });
          $('#dataTable').DataTable().ajax.reload(null, false);
        
                        // Hide modal after success
                        $('#editchangeModal').modal('hide');
        
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
</script>
<script>
    function deletecate(cateID) {
    Swal.fire({
                  title: "Are you sure?",
                  text: "You want to delete this category?",
                  icon: "warning",
                  showCancelButton: true,
                     confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                   confirmButtonText: "Yes, delete it!"
                    cancelButtonText: "No, cancel",
               
                }).then((result) => {
                    if (result.isConfirmed)
                    {
                        $.ajax({
                            url: '<?=base_url('/admin/delete-categories')?>',
                            type: 'POST',
                            data: {
                                "cateID": cateID,
                                <?=csrf_token()?>: '<?=csrf_hash()?>'
                            },
                            success: function(response) {
                             if (response.status === 'success') {
                                Swal.fire({
                                  title: "Success",
                                  text: response.message,
                                  icon: "success",
                                  timer: 2000,
                                  allowOutsideClick: false,
                                   willClose: () => {
                                         $('#dataTable').DataTable().ajax.reload(null, false);
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
</script>
<script>
function resetpages(url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to reset this categories?",
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
<style>
    #dataTable {
    width: 100% !important;
    table-layout: auto;
}

#dataTable td, #dataTable th {
    white-space: normal; /* Allows text to wrap */
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 100px; /* Adjust column width as needed */
}
#dataTable td:last-child, 
#dataTable th:last-child {
    white-space: normal !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    max-width: 150px !important; /* Adjust width as needed */
}

</style>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .customer").addClass('open');
     $("#sidebar-menu .customersub").addClass('show');
     $("#sidebar-menu .customercate").addClass('active-page');
    });
</script>
</body>
</html>