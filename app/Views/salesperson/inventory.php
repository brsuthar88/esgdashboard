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
    <?php $dataview = ['sellerdata' => $sellerdata,];
    echo view('salesperson/partials/Sellersidebar', $dataview);
    ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Inventory List</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/seller" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>></li>
        <li class="fw-medium">Inventory</li>
      </ul>
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
               <?php foreach($categories as $values){ ?>
                        <th scope="col"><?php echo $values['category_name'];?></th>
                        <?php } ?>
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
  <?php echo view('salesperson/partials/Sellerfooter'); ?>


<div class="modal fade" id="statuschangeModal" tabindex="-1" aria-labelledby="statuschangeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuschangeModalLabel">Quotation Status Change</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
        <form action="#">
          <div class="row">
            <div class="col-12 mb-20">
              <select class="form-control radius-8 form-select" id="country">
                <option selected disabled>Select Status</option>
                <option>Pending</option>
                <option>Accept</option>
                <option>Invoice</option>
                <option>Reject</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
        <button type="submit" class="btn btn-primary text-sm px-24 py-12 radius-8"> Update Status </button>
      </div>
    </div>
  </div>
</div>
  <!-- JS -->
  <?php echo view('salesperson/partials/Sellerjs'); ?>
<script>
      $(document).ready(function () {
            var isMobile = $(window).width() <= 1024; // Detect mobile (adjust as needed)
            
        var categoryColumns = [
    <?php foreach ($categories as $cat): ?>
    {
        data: "rate_cate.<?= $cat['pricebook_id'] ?>",
        orderable: false, // Important: disable sorting
        searchable: false, // (optional) if not needed
        render: function(data, type, row) {
            return data ? parseFloat(data).toFixed(2) : "-";
        }
    },
    <?php endforeach; ?>
];
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('/seller/datatable-inventory') ?>',
                type: "POST"
            },
            columns: [

                { data: 'item_name' },
                { data: 'sku' },
                { data: 'description' },
                { data: 'stocks' },
                { data: 'unit' },
                { data: 'rate' },
                ...categoryColumns,
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
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
            order: [],
            responsive: true,
            autoWidth: isMobile,
            searching: true,
            columnDefs: [
                { orderable: false, targets: [0, -1] }
            ],
            scrollX: isMobile,
              scrollY: '300px'
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

</body>
</html>