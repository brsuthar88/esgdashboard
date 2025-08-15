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
.bordered-table thead tr th,.bordered-table tbody tr td{font-size:14px;}

.select2-container--default .select2-selection--single{
    height: 2.75rem !important;
  border: 1px solid var(--input-form-light);
  color: var(--text-primary-light) !important;
  background-color: var(--white);
  padding: 0.5625rem 1.25rem;
  display: block;
  width: 100%;
  padding: .375rem .75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5 !important;
  color: var(--bs-body-color);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: var(--bs-body-bg);
  background-clip: padding-box;
  border: var(--bs-border-width) solid var(--bs-border-color) !important;
  border-radius: var(--bs-border-radius) !important;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.select2-container--default .selection{
     width:100%;
 }
 .select2-container--default .select2-selection--single .select2-selection__arrow{
     height: 2.75rem !important;
       line-height: 1.5 !important;
 }
.disabled {
    cursor: not-allowed;
    opacity: 0.5; /* Makes it look disabled */
    pointer-events: none; /* Prevents clicks */
}
 .card-box {
      background: white;
      border-radius: 10px;
      padding: 24px;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
      margin-bottom: 24px;
    }
    .dashed-box {
      border: 2px dashed #ccc;
      padding: 2rem;
      text-align: center;
      border-radius: 0.5rem;
      background: #f9fafb;
    }
    .tile-box {
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      padding: 0.75rem 1rem;
      background-color: #f8f9fa;
      margin-bottom: 0.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .preview-tile {
      height: 56px;
      background-color: #f1f5f9;
      border-radius: 0.5rem;
      margin-bottom: 0.5rem;
    }
</style>
<style>
    .insight-card {
      border-radius: 12px;
      padding: 20px;
      height: 100%;
    }
    .insight-icon {
      font-size: 1.5rem;
      margin-right: 8px;
    }
    .text-green { color: #15803d; }
    .text-orange { color: #92400e; }
    .text-blue { color: #1d4ed8; }
    .text-purple { color: #7e22ce; }
    .bg-light-green { background-color: #ecfdf5; }
    .bg-light-orange { background-color: #fffbeb; }
    .bg-light-blue { background-color: #eff6ff; }
    .bg-light-purple { background-color: #f5f3ff; }
  </style>
   <style>
    .entry-card {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 16px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
    }
    .entry-icon {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      background-color: #eef2ff;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1.2rem;
      color: #4f46e5;
      margin-right: 12px;
    }
    .entry-meta {
      font-size: 0.875rem;
      color: #6c757d;
    }
    .entry-status {
      font-size: 0.75rem;
      padding: 4px 8px;
      border-radius: 12px;
      text-transform: capitalize;
    }
    .status-submitted {
      background-color: #d1e7dd;
      color: #0f5132;
    }
    .status-draft {
      background-color: #fff3cd;
      color: #664d03;
    }
    .next-steps-box {
      background-color: #f6f9ff;
      padding: 20px;
      border-radius: 8px;
      margin-top: 24px;
    }
    .next-steps-box ul {
      padding-left: 20px;
      margin: 0;
    }
    .next-steps-box li {
      margin-bottom: 8px;
    }
  </style>
</head>
<body>
    <!-- Sidebar -->
    <?php $dataview = ['sellerdata' => $sellerdata,];
    echo view('salesperson/partials/Sellersidebar', $dataview);
    ?>
           
  <div class="dashboard-main-body scrollclass">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Data Entry</h6>
       <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/seller" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>></li>
        <li class="fw-medium">Data Entry</li>
      </ul>
    </div>
    <div class="card basic-data-table">
      <div class="card-body">
          
 <div class="container my-4">
  <!-- Recent Entries Title -->
  <h5 class="fw-semibold mb-3">Recent Entries</h5>

  <!-- Entries -->
  <div class="d-flex flex-column gap-3">
    <!-- Entry 1 -->
    <div class="entry-card">
      <div class="d-flex align-items-center">
        <div class="entry-icon">
          <i class="bi bi-graph-up"></i>
        </div>
        <div>
          <div class="fw-semibold">Scope 1 Emissions</div>
          <div class="entry-meta">Climate & Emissions</div>
        </div>
      </div>
      <div class="text-end">
        <div class="fw-semibold">245 tCO₂e</div>
        <div class="entry-meta mb-1">2024-01-15</div>
        <span class="entry-status status-submitted">submitted</span>
        <a href="#" class="ms-2 text-decoration-none text-primary">Edit</a>
      </div>
    </div>

    <!-- Entry 2 -->
    <div class="entry-card">
      <div class="d-flex align-items-center">
        <div class="entry-icon">
          <i class="bi bi-graph-up"></i>
        </div>
        <div>
          <div class="fw-semibold">Water Consumption</div>
          <div class="entry-meta">Water Management</div>
        </div>
      </div>
      <div class="text-end">
        <div class="fw-semibold">1,340 m³</div>
        <div class="entry-meta mb-1">2024-01-12</div>
        <span class="entry-status status-submitted">submitted</span>
        <a href="#" class="ms-2 text-decoration-none text-primary">Edit</a>
      </div>
    </div>

    <!-- Entry 3 -->
    <div class="entry-card">
      <div class="d-flex align-items-center">
        <div class="entry-icon">
          <i class="bi bi-graph-up"></i>
        </div>
        <div>
          <div class="fw-semibold">Gender Diversity</div>
          <div class="entry-meta">Diversity & Inclusion</div>
        </div>
      </div>
      <div class="text-end">
        <div class="fw-semibold">45%</div>
        <div class="entry-meta mb-1">2024-01-10</div>
        <span class="entry-status status-draft">draft</span>
        <a href="#" class="ms-2 text-decoration-none text-primary">Edit</a>
      </div>
    </div>
  </div>

  <!-- Next Steps Section -->
  <div class="next-steps-box mt-4">
    <h6 class="fw-bold mb-3">Next Steps</h6>
    <ul>
      <li>Complete Scope 2 emissions data for Q4 2024</li>
      <li>Upload energy audit report by January 31st</li>
      <li>Review and finalize diversity metrics</li>
      <li>Schedule governance assessment meeting</li>
    </ul>
  </div>
</div>

      </div>
    </div>
  </div>
  
   </div>
<div class="modal fade" id="statuschangeModal" tabindex="-1" aria-labelledby="statuschangeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="statuschangeModalLabel">Quotation Status Change</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="row">
                    <div class="col-12 mb-20">
                        <select class="form-control radius-8 form-select" id="Status" onchange="getStatusValue(this)">
                            <option selected disabled>Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="accept">Accept</option>
                            <option value="invoice">Invoice</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea class="form-control radius-8" id="commentnew" placeholder="Add comment..."></textarea>
                        <p id="statusmessages"></p>
                    </div>
                </div>
                <input type="hidden" id="modalValue">
            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8">Close</button>
                <button type="button" onclick="chnageStatus()" class="btn btn-primary text-sm px-24 py-12 radius-8">Update Status</button>
            </div>
        </div>
    </div>
</div>
    <!-- footer -->
  <?php echo view('salesperson/partials/Sellerfooter'); ?>

  <!-- JS -->
  <?php echo view('salesperson/partials/Sellerjs'); ?>

<script>
    $(document).ready(function () {
            var isMobile = $(window).width() <= 1024; // Detect mobile (adjust as needed)
        var currencySymbol ='<?= $GLOBALS["currencysymbol"] ?>';
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('/seller/datatable-list-quotation') ?>',
                type: "POST"
            },
            columns: [
                { 
                    data: 'quotation_number',
                    render: function (data, type, row) {
                        // Customize the data by wrapping it with an anchor tag
                        return '<a href="/seller/view-quote/'+row['quotation_id']+'" class="text-primary-600">'+row['quotation_number']+'</a>';
                    }
                },
                { data: 'quotation_created_at' },
                { data: 'customer_name' },
                { data: 'category_name' },
                { 
                    data: 'grand_total',
                    render: function (data, type, row) {
                        return currencySymbol + ' ' + parseFloat(data).toFixed(2);
                    }
                },
                {
                    data: 'status',
                    render: function (data, type, row) {
                    
                    if (data == "invoice") {
                       return'<span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Invoice</span>';
                    } else if (data == "pending") {
                        return'<span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm" >Pending</span>';
                    } else if (data == "rejected") {
                        return '<span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Reject</span>';
                    } else if (data == "accept") {
                        return '<span class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Accept</span>';
                    }

                    },
                },
                {
                    data: 'quotation_id',
                    render: function (data, type, row) {
                        return '<input type="hidden" class="status' + row['quotation_id'] + '" value="' + row['status'] + '"><div class="d-flex align-items-center gap-10 justify-content-center"><a href="/seller/view-quote/' + row['quotation_id'] + '" type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View"><i class="fas fa-eye" aria-hidden="true"></i></a><a type="button" href="/seller/generate-pdf/' + row['quotation_id'] + '" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Download"><i class="fas fa-download" aria-hidden="true"></i></a><a type="button" href="javascript:void(0);" onclick="confirmMailSend(\'/seller/send-mail/' + row['quotation_id'] + '\')" class="bg-warning-focus text-warning-600 bg-hover-warning-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-warning" data-bs-title="Mail Send"><i class="fas fa-envelope" aria-hidden="true"></i></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-purple" data-bs-title="Change Status" ><button type="button" class="bg-purple-focus text-purple-600 bg-hover-purple-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#statuschangeModal"  data-value="' + row['quotation_id'] + '" ><i class="fas fa-refresh" aria-hidden="true"></i></button></a></div><input type="hidden" class="comments' + row['quotation_id'] + '" value="' + row['comment'] + '">';
                        
                    }
                }
            ],
            drawCallback: function () {
                // Initialize tooltips after DataTable has finished rendering
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
              responsive: true,
            autoWidth: isMobile,
            searching: true,  // Disable searching on mobile
            columnDefs: [
                { targets: -1, orderable: false }
            ],
            scrollX: isMobile // Enable scrolling on mobile
        });
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
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const statusname = urlParams.get('s');
        if(statusname != null)
        {
             if(statusname=='Rejected')
            {
               window.myDataTable = $('#dataTable').DataTable();
            window.myDataTable.search('Reject').draw();
            }
            else
            {
                window.myDataTable = $('#dataTable').DataTable();
                window.myDataTable.search(statusname).draw();
            }
            
        }
        
        const namecustomer = urlParams.get('name');
        if(namecustomer != null)
        {
            //$("#dt-search-0").val(statusname);
             window.myDataTable = $('#dataTable').DataTable();
            window.myDataTable.search(namecustomer).draw();
        }
    });
    
</script>
<script>
    function chnageStatus(){
        var quoteID = $('#modalValue').val();
        var Status = $('#Status').val();
         var comment = $('#commentnew').val();
        $.ajax({
            url: '<?= base_url('/seller/change-status') ?>',
            type: 'POST',
            data:{"quoteID": quoteID,'Status':Status,'comment':comment, <?= csrf_token() ?>: '<?= csrf_hash() ?>'},
            success: function(response) {
                 $('#statuschangeModal').modal('hide');
                // Display success or error message\
                if (response.status === 'success') {
                    Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                    });
                    
                     /*$('.status'+quoteID).val(Status);
                    if(Status=='invoice')
                    {
                        $(".changejsstatus"+quoteID).html('<span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm ">Invoice</span>');
                    }
                    if(Status=='pending')
                    {
                        $(".changejsstatus"+quoteID).html('<span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>');
                    }
                    if(Status=='rejected')
                    {
                        $(".changejsstatus"+quoteID).html('<span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Reject</span>');
                    }
                    if(Status=='accept')
                    {
                        $(".changejsstatus"+quoteID).html('<span class="bg-info-focus text-info-main px-24 py-4 rounded-pill fw-medium text-sm">Accept</span>');
                    } */
                      $('#dataTable').DataTable().ajax.reload(null, false);
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
                 $('#statuschangeModal').modal('hide');
                 Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text:"Error occurred while submitting the form.",
                           timer: 2000,
                        });
            }  
                 
        });

    }
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
document.getElementById('statuschangeModal').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    if (!button) return; // Ensure button exists

    var value = button.getAttribute('data-value');
    var modalValue = document.getElementById('modalValue');
    modalValue.value = value;

    var Statusname = $('.status' + value).val();
    var comemntval = $('.comments' + value).val();

    $('#commentnew').val(''); // Clear previous comment input
    $('#statusmessages').html(''); // Clear previous messages

    // Ensure comemntval is not empty before parsing
    if (comemntval) {
        try {
            const dataObject = JSON.parse(comemntval);
            if (dataObject && dataObject[Statusname]) {
                let commentsHtml = '';
                
                // Check if multiple comments exist
                if (Array.isArray(dataObject[Statusname])) {
                    dataObject[Statusname].forEach(commentObj => {
                        commentsHtml += `<p><strong>${commentObj.date}</strong> - <span class="text-primary">${commentObj.username} (${commentObj.role})</span>: ${commentObj.comment}</p>`;
                    });
                } else {
                    // Fallback if stored as a single object instead of an array
                    let commentObj = dataObject[Statusname];
                    commentsHtml = `<p><strong>${commentObj.date}</strong> - <span class="text-primary">${commentObj.username} (${commentObj.role})</span>: ${commentObj.comment}</p>`;
                }

                //$('#statusmessages').html(commentsHtml);
            }
        } catch (error) {
            console.error("Invalid JSON format in comments:", error);
        }
    }

    $('#Status').val(Statusname).trigger('change');
});

// Function to get status value and update fields dynamically
function getStatusValue(selectElement) {
    let selectedValue = selectElement.value;
    var quoteID = $('#modalValue').val();
    var comemntall = $('.comments' + quoteID).val();

    $('#commentnew').val(''); // Clear previous comment input
    $('#statusmessages').html(''); // Clear previous messages

    // Ensure comemntall is not empty before parsing
    if (comemntall) {
        try {
            const dataObject = JSON.parse(comemntall);
            if (dataObject && dataObject[selectedValue]) {
                let commentsHtml = '';

                // Loop through multiple comments
                if (Array.isArray(dataObject[selectedValue])) {
                    dataObject[selectedValue].forEach(commentObj => {
                        commentsHtml += `<p><strong>${commentObj.date}</strong> - <span class="text-primary">${commentObj.username} (${commentObj.role})</span>: ${commentObj.comment}</p>`;
                    });
                } else {
                    let commentObj = dataObject[selectedValue];
                    commentsHtml = `<p><strong>${commentObj.date}</strong> - <span class="text-primary">${commentObj.username} (${commentObj.role})</span>: ${commentObj.comment}</p>`;
                }

                //$('#statusmessages').html(commentsHtml);
            }
        } catch (error) {
            console.error("Invalid JSON format in comments:", error);
        }
    }
}

</script>
<script>
function confirmMailSend(url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to send an email?",
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
<script>
function confirmDownload(url) 
// {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You want to download this quotation?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#3085d6",
//         confirmButtonText: "Yes, Continue it!",
//         cancelButtonText: "No, cancel",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = url; // Redirect if confirmed
//         }
//     });
// }
</script>
<script>
function confirmDownload(url) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to download this quotation?",
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
     $("#sidebar-menu .quotation").addClass('open');
     $("#sidebar-menu .quotationsub").addClass('show');
     $("#sidebar-menu .quotationlist").addClass('active-page');
    });
</script>
</body>
</html>