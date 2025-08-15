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
.dt-column-title {
  padding-right: 15px;
}
</style>
<?php
helper('zoho_helper');
?>
</head>
<body>
<!-- Sidebar -->
    <?php $dataview = ['customerdata' => $customerdata,'categories' => $categories,'sellerdata' =>$sellerdata,'itemlist'=>$itemlist];
    echo view('partials/Customersidebar', $dataview);
    ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Inventory List</h6>
    </div>
    <div class="card basic-data-table">
      <div class="card-body">
           <form>
        <table class="table bordered-table mb-0 responsive" style="min-width: 100%;" id="dataTable" data-page-length='10'>
          <thead>
            <tr>
              <th scope="col">Item</th>
              <th scope="col">SKU</th>
              <th scope="col">Description</th>
              <th scope="col"  class="text-center">Stocks</th>
              <th scope="col">Unit</th>
              <th scope="col">Rate</th>
              <th scope="col" class="text-center">Specification</th>
            </tr>
          </thead>
          <tbody>
          
          </tbody>
        </table>
         </form>
      </div>
    </div>
  </div>
    <!-- footer -->
  <?php echo view('partials/Customerfooter'); ?>

  <!-- JS -->
  <?php echo view('partials/Customerjs'); ?>
<script>
      $(document).ready(function () {
            var isMobile = $(window).width() <= 1024; // Detect mobile (adjust as needed)
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('/datatable-inventory') ?>',
                type: "POST"
            },
            columns: [

                { data: 'item_name' },
                { data: 'sku' },
                { data: 'description' },
                { data: 'stocks' },
                { data: 'unit' },
                {
                    data: 'pricebook_rate',
                    render: function (data, type, row) {
                        // If pricebook_rate is null or empty, fallback to rate
                        var displayRate = (data !== null && data !== '' && data !== 'null') ? data : row.rate;
                        return `${displayRate}`;
                    }
                },
                {
                   data: 'cf_sheet',
                    render: function(data, type, row) {
                        if (data === 'null' || data === null || data === '') {
                            return `
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="#" style="cursor: no-drop;" class="text-danger-600 d-flex justify-content-center align-items-center">
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                    </a>
                                </div>
                            `;
                        } else {
                            return `
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="${data}" target="_blank" class="text-danger-600 d-flex justify-content-center align-items-center">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                </div>
                            `;
                        }
                    }
                },
             
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
    max-width: 120px !important; /* Adjust width as needed */
}

</style>
</body>
</html>