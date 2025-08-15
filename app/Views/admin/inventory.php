<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?= base_url('assets/css/lib/font-awesome.min.css');?>">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('admin/partials/admincss'); ?>
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
    <?php $dataview = ['admindata' => $admindata,];
    echo view('admin/partials/adminsidebar', $dataview);

    ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Inventory List</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>></li>
        <li class="fw-medium">Inventory</li>
      </ul>
    </div>
    <div class="card basic-data-table">
      <div class="card-body">
          <?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-info">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>
        
              <form method="post" action="/admin/sync-inventory" style="text-align: right; padding: 10px 0;" onsubmit="showLoader(this)">
    <button type="submit" class="btn btn-primary" id="syncBtn">
        <span id="btnText">Sync Inventory</span>
        <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    </button>
      <a href="/admin/setting#cronjob" class="btn btn-dark">Sync Setting</a>
</form>


          <form>
        <table class="table bordered-table mb-0 responsive" style="min-width: 100%;" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="text-center" >Stocks</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Rate</th>
                        <?php foreach($categories as $values){ ?>
                        <th scope="col"><?php echo $values['category_name'];?></th>
                        <?php } ?>
                        <th scope="col">Stock</th>
                        <?php
                         /*  foreach ($warehouses['warehouses'] as $warehouse) { ?>
                         <th scope="col" ><?php echo $warehouse['warehouse_name'];?></th><?php
                            }*/
                        ?>
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
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>

<script>
    $(document).ready(function () {
        var isMobile = $(window).width() <= 2000;

        var categoryColumns = [
    <?php foreach ($categories as $cat): ?>
    {
        data: "rate_cate.<?= $cat['pricebook_id'] ?>",
        orderable: false, // Important: disable sorting
        searchable: false, // (optional) if not needed
        render: function(data, type, row) {
            console.log("data",data);
         console.log("type",type);
          console.log("row",row);
            return data ? parseFloat(data).toFixed(2) : "-";
        }
    },
    <?php endforeach; ?>
];

//var warehouseColumns = [
<?php // foreach ($warehouses['warehouses'] as $wh):  ?>
//{
    //data: "warehouse_detail.<//? //= //$wh['warehouse_id'] ?//>",
    //orderable: false,
    //searchable: false,
    //className: "text-center",
   // render: function(data, type, row) {
     //   console.log("data",data);
     //    console.log("type",type);
      //    console.log("row",row);
      //   return data  ? data : 0;
   // }
//},
<?php //endforeach; ?>
//];
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('/admin/datatable-inventory') ?>',
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
                  { data: 'stock' },
                 //...warehouseColumns,
                {
                    data: 'cf_sheet',
                    render: function (data, type, row) {
                        if (!data || data === 'null') {
                            return `
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="#" style="cursor: no-drop;" class="text-danger">
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                    </a>
                                </div>`;
                        } else {
                            return `
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="${data}" target="_blank" class="text-danger">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                </div>`;
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
<style>

</style>

<!-- Optional: Bootstrap 4 or 5 CSS must be included for spinner styles -->
<script>
    function showLoader(form) {
        const btn = form.querySelector("#syncBtn");
        const text = btn.querySelector("#btnText");
        const loader = btn.querySelector("#btnLoader");

        // Disable button
        btn.disabled = true;

        // Show loader
        loader.classList.remove("d-none");
        text.textContent = "Syncing...";
    }
</script>
</body>
</html>