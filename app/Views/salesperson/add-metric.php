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
.select2-container{width:96%;line-height: 0;}.input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback){margin-left:0px}
.select2 .selection{
  width: 100%;
  padding: 0;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--bs-body-color);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: var(--bs-body-bg);
  background-clip: padding-box;
  border: var(--bs-border-width) solid var(--bs-border-color);
  border-radius: var(--bs-border-radius);
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  border-radius: 0px 4px 4px 0px !important;
  border-left: none;}
  .select2-container--default .select2-selection--single{border:none !important;height: 44px !important;background:none !important;}
  .select2-container--default .select2-selection--single .select2-selection__arrow{height: 44px !important;}
  .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 44px !important;}
  .select2-results__option {padding: 15px !important;line-height:18px;}
  .select2-container{width:95% !important;}
.select2-results__option span {
  white-space: normal; /* Allow wrapping and line breaks */
  word-wrap: break-word; /* Prevent long words from breaking the layout */
  line-height:18px;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #da251d;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transform: -webkit-translate(-50%, -50%);
  transform: -moz-translate(-50%, -50%);
  transform: -ms-translate(-50%, -50%);
  position: fixed;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.coverloader
{
    position: fixed;
  z-index: 9999;
  height: 100%;
  width: 100%;
  background: #00000091;
}
@media print {
  body {
    visibility: hidden;
  }
  #section-to-print {
    visibility: visible;
    position: absolute;
    left: 0;
    top: 0;
  }
}
.errorborder{border:1px solid red;}
.btn.dropdown-toggle{
    border: 1px solid var(--input-form-light);
  color: var(--text-primary-light) !important;
  background-color: var(--white);
}
 .dashed-box {
      border: 2px dashed #ccc;
      padding: 2rem;
      text-align: center;
      border-radius: 0.5rem;
      background: #f9fafb;
    }
</style>
</head>
<body>
    <div class="coverloader">
        <div class="loader"></div>
    </div>
<!-- Sidebar -->
      <?php $dataview = ['sellerdata' => $sellerdata];
echo view('salesperson/partials/Sellersidebar', $dataview);
?>
 <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Add Metric Data</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/seller" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>></li>
        <li class="fw-medium">Metric</li>
      </ul>
    </div>
     <div class="card h-100 p-0 radius-12 mb-20">
      <div class="card-body">
        <div class="row">
    <div class="row gy-4">
     <form id="myForm">
      <div class="card-body p-24 pt-10">
            <div class="row gy-3">
              <div class="mb-20 col-sm-6">
                    <label for="destatjus" class="form-label fw-semibold text-primary-light text-sm mb-8">Topic Category <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" name="destatjus" id="destatjus" data-rule-required="true" data-msg-required="Status is required.">
                  <option value="">Select a topic</option><option value="climate">Climate &amp; Emissions</option><option value="water">Water Management</option><option value="diversity">Diversity &amp; Inclusion</option><option value="governance">Governance</option><option value="community">Community Impact</option><option value="supply-chain">Supply Chain</option>
                  </select>
              </div>
              <div class="mb-20 col-sm-6">
                  <label for="destatus" class="form-label fw-semibold text-primary-light text-sm mb-8">Metric <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" name="destatus" id="destatus" data-rule-required="true" data-msg-required="Status is required.">
                  <option value="1">Climate & Emissions </option>
                  <option value="0">Water Management </option>
                   <option value="2">Diversity & Inclusion </option>
                  <option value="3">Governance </option>
                </select>
              </div>
               <div class="mb-20 col-sm-6">
                <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">Value <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="Enter value"  data-rule-required="true" data-msg-required="First Name is required.">
              </div>
              <div class="mb-20 col-sm-6">
                  <label for="destastus" class="form-label fw-semibold text-primary-light text-sm mb-8">Unit <span class="text-danger-600">*</span> </label>
                <input type="text" class="form-control radius-8" id="destastus" name="destastus" placeholder="Unit of measurement"  data-rule-required="true" data-msg-required="Unit of measurement">
              </div>
              <div class="mb-20 col-sm-12">
                <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Report Period</label>
                  <input type="date" class="form-control radius-8" id="desc" name="desc" placeholder="dd/mm/yyyy"  data-rule-required="true" data-msg-required="Unit of measurement">
              </div>
            <div class="mb-20 col-sm-12">
            
                <label for="fname" class="form-label fw-semibold text-sm mb-8">Supporting Evidence <span class="text-danger-600">*</span></label>
                   <div class="dashed-box mb-4">
            <i class="bi bi-upload fs-1 text-muted"></i>
            <p class="mb-2">Upload your company logo</p>
            <button class="btn btn-outline-primary btn-sm">Choose File</button>
          </div>
              </div>
              <div class="mb-20 col-sm-12">
                <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Additional Notes (Optional)</label>
                <textarea name="#0" class="form-control radius-8" id="desc" placeholder="Add any additional context or notes about this metric..."></textarea>
              </div>
             
       
      </div>
      <div class="card-footer">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2"> <a href="javascript:void(0)" id="submitdata" class="btn btn-sm btn-info-600 radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:floppy-disk" class="text-xl"></iconify-icon>
         Submit Metric</a>  <a href="#" onclick="resetpages('/admin/add-customer')"  class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
          <iconify-icon icon="pepicons-pencil:times-circle-filled" class="text-xl"></iconify-icon>
          Cancle </a> </div>
      </div>
      </form>
    </div>
    </form>
    </div>
  </div>
  </div>
  </div>
  </div>
  <div id="section-to-print"></div>
  <input type="hidden" id="totalprice">
  <input type="hidden" id="totalprice1">
  <!-- footer -->
  <?php echo view('salesperson/partials/Sellerfooter'); ?>

  <!-- JS -->
  <?php echo view('salesperson/partials/Sellerjs'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/lib/bootstrap-select.min.css');?>">
<script src="<?= base_url('../assets/js/lib/bootstrap1.bundle.min.js'); ?>"></script>
<script src="<?= base_url('../assets/js/lib/bootstrap-select.min.js'); ?>"></script>
<script>
  let table = new DataTable('#dataTable');
</script>
<script>
   $(document).ready(function() {
       $('.coverloader').hide();
setTimeout(function() {
      $('#customerSelect').selectpicker();
    }, 500); // 1000ms = 1 second
});

</script>
<script>
    $('#order_product').on('change', function() {
        var datavalue = $(this).val();
        if (datavalue !== null && datavalue !== undefined) {
        var datavalue=$(this).val().split('BHAVIK');
        if(datavalue[5] <= 0)
        {
            Swal.fire({
                  title: "Quantity is zero or less.",
                  text: "You want to add this item?",
                  icon: "warning",
                 showCancelButton: true,
                           confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, cancel",
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        if ($('#dynamicTable tbody').find(".main"+datavalue[0]).length > 0) {
                
                            var oldval=$('#qty'+datavalue[0]).val();
                            var newvalue=Number(oldval)+1;
                            newvalue=newvalue.toFixed(2);
                            $('#qty'+datavalue[0]).val(newvalue);
                
                            var totalsingle=datavalue[4]*newvalue;
                             totalsingle=totalsingle.toFixed(2);
                            $('#total'+datavalue[0]).text("<?= $GLOBALS['currencysymbol'];?>"+totalsingle);
                            $('#totalpricerow'+datavalue[0]).val(totalsingle);
                            var total = 0;
                            $('.totalpricerow').each(function () {
                                var value = parseFloat($(this).val());
                                if (!isNaN(value)) {
                                    total += value;
                                }
                            });
                             total=total.toFixed(2);
                            $("#totalprice").text("<?= $GLOBALS['currencysymbol'];?>"+total);
                            $("#totalprice1").text("<?= $GLOBALS['currencysymbol'];?>"+total);
                        }
                        else
                        {
                            $("#nodata").remove();
                            $(".totaltr").remove();
                            var count = $('#dynamicTable tbody .countrow').length;
                            if(count == 0)
                            {
                                count=1;
                            }
                            else
                            {
                                count=count+1;
                            }
                
                
                            var totalrow=datavalue[4] * 1;
                            var newRow = '<tr class="trcal main'+datavalue[0]+'"><td class="text-start countrow" data-id="'+datavalue[0]+'">'+count+'</td><td width="30%" class="text-start">'+datavalue[1]+'<br><span style="font-size: 12px"><strong>SKU:</strong>'+datavalue[6]+'</span><br><span style="font-size: 12px">'+datavalue[3]+'</span></td><td class="text-center">'+datavalue[5]+'</td><td class="text-center">'+datavalue[2]+'</td><td class="text-end" id="singleprice'+datavalue[0]+'"><?= $GLOBALS['currencysymbol'];?>'+datavalue[4]+'</td><td class="text-center" ><input type="text" min="1" max="100" class="invoive-form-control qty" data-id="'+datavalue[5]+'" onchange="qtychangeafter(\''+datavalue[0]+'\',\''+datavalue[4]+'\')" oninput ="qtychange(\''+datavalue[0]+'\',\''+datavalue[4]+'\')"  id="qty'+datavalue[0]+'" value="1"></td><td class="text-end rowtotalprice" id="total'+datavalue[0]+'"><?= $GLOBALS['currencysymbol'];?>'+totalrow+'</td><td class="text-center"> <a onclick="deleterow(\''+datavalue[0]+'\')" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"><iconify-icon icon="mingcute:delete-2-line"></iconify-icon></a></td><input type="hidden" class="totalpricerow" id="totalpricerow'+datavalue[0]+'" value="'+datavalue[4]+'"><input type="hidden" class="ids"  value="'+datavalue[0]+'"></tr>';
                
                                // Append the new row to the table body
                
                                $('#dynamicTable tbody').append(newRow);
                
                            var total = 0;
                            $('.totalpricerow').each(function () {
                                var value = parseFloat($(this).val());
                                if (!isNaN(value)) {
                                    total += value;
                                }
                            });
                             total=total.toFixed(2);
                            var newRowtotal = '<tr class="totaltr"><td class="text-end" colspan="6"><strong>Subtotal</strong></td><td class="text-end" id="totalprice1"><?= $GLOBALS['currencysymbol'];?>'+total+'</td><td class="text-center"> </td></tr><tr class="totaltr"><td class="text-end" colspan="6"><strong>Out of state sale (0%)</strong></td><td class="text-end"><?= $GLOBALS['currencysymbol'];?>0.00</td><td class="text-center"> </td></tr><tr class="totaltr"><td class="text-end" colspan="6"><strong>Total</strong></td><td class="text-end" id="totalprice"><?= $GLOBALS['currencysymbol'];?>'+total+'</td><td class="text-center"> </td></tr>';
                            
                            $('#dynamicTable tbody').append(newRowtotal);
                        }
                    }
                });
        }
        else
        {
            if ($('#dynamicTable tbody').find(".main"+datavalue[0]).length > 0) {
                
                            var oldval=$('#qty'+datavalue[0]).val();
                            var newvalue=Number(oldval)+1;
                            newvalue=newvalue.toFixed(2);
                            $('#qty'+datavalue[0]).val(newvalue);
                
                            var totalsingle=datavalue[4]*newvalue;
                             totalsingle=totalsingle.toFixed(2);
                            $('#total'+datavalue[0]).text("<?= $GLOBALS['currencysymbol'];?>"+totalsingle);
                            $('#totalpricerow'+datavalue[0]).val(totalsingle);
                            var total = 0;
                            $('.totalpricerow').each(function () {
                                var value = parseFloat($(this).val());
                                if (!isNaN(value)) {
                                    total += value;
                                }
                            });
                             total=total.toFixed(2);
                            $("#totalprice").text("<?= $GLOBALS['currencysymbol'];?>"+total);
                             $("#totalprice1").text("<?= $GLOBALS['currencysymbol'];?>"+total);
                        }
                        else
                        {
                            $("#nodata").remove();
                            $(".totaltr").remove();
                            var count = $('#dynamicTable tbody .countrow').length;
                            if(count == 0)
                            {
                                count=1;
                            }
                            else
                            {
                                count=count+1;
                            }
                
                
                            var totalrow=datavalue[4] * 1;
                            var newRow = '<tr class="trcal main'+datavalue[0]+'"><td class="text-start countrow" data-id="'+datavalue[0]+'">'+count+'</td><td width="30%" class="text-start">'+datavalue[1]+'<br><span style="font-size: 12px"><strong>SKU:</strong>'+datavalue[6]+'</span><br><span style="font-size: 12px">'+datavalue[3]+'</span></td><td class="text-center">'+datavalue[5]+'</td><td class="text-center">'+datavalue[2]+'</td><td class="text-end" id="singleprice'+datavalue[0]+'"><?= $GLOBALS['currencysymbol'];?>'+datavalue[4]+'</td><td class="text-center" ><input type="text" min="1" max="100" class="invoive-form-control qty" data-id="'+datavalue[5]+'" onchange="qtychangeafter(\''+datavalue[0]+'\',\''+datavalue[4]+'\')" oninput ="qtychange(\''+datavalue[0]+'\',\''+datavalue[4]+'\')"  id="qty'+datavalue[0]+'" value="1"></td><td class="text-end rowtotalprice" id="total'+datavalue[0]+'"><?= $GLOBALS['currencysymbol'];?>'+totalrow+'</td><td class="text-center"> <a onclick="deleterow(\''+datavalue[0]+'\')" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"><iconify-icon icon="mingcute:delete-2-line"></iconify-icon></a></td><input type="hidden" class="totalpricerow" id="totalpricerow'+datavalue[0]+'" value="'+datavalue[4]+'"><input type="hidden" class="ids"  value="'+datavalue[0]+'"></tr>';
                
                                // Append the new row to the table body
                
                                $('#dynamicTable tbody').append(newRow);
                
                            var total = 0;
                            $('.totalpricerow').each(function () {
                                var value = parseFloat($(this).val());
                                if (!isNaN(value)) {
                                    total += value;
                                }
                            });
                             total=total.toFixed(2);
                            var newRowtotal = '<tr class="totaltr"><td class="text-end" colspan="6"><strong>Subtotal</strong></td><td class="text-end" id="totalprice1"><?= $GLOBALS['currencysymbol'];?>'+total+'</td><td class="text-center"> </td></tr><tr class="totaltr"><td class="text-end" colspan="6"><strong>Out of state sale (0%)</strong></td><td class="text-end"><?= $GLOBALS['currencysymbol'];?>0.00</td><td class="text-center"> </td></tr><tr class="totaltr"><td class="text-end" colspan="6"><strong>Total</strong></td><td class="text-end" id="totalprice"><?= $GLOBALS['currencysymbol'];?>'+total+'</td><td class="text-center"> </td></tr>';
                            $('#dynamicTable tbody').append(newRowtotal);
                        }
        }
        }
    });
</script>
<script>
    function qtychange(ids,prices){
        $('#qty'+ids).val($('#qty'+ids).val().replace(/[^0-9]/g, ''));
        var oldval=$('#qty'+ids).val();
        $('#qty'+ids).removeClass('errorborder');
            var newvalue=Number(oldval);
         
            $('#qty'+ids).val(newvalue);

            var totalsingle=prices*newvalue;
             totalsingle=totalsingle.toFixed(2);
            $('#total'+ids).text("<?= $GLOBALS['currencysymbol'];?>"+totalsingle);
            $('#totalpricerow'+ids).val(totalsingle);
            var total = 0;
            $('.totalpricerow').each(function () {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
             total=total.toFixed(2);
            $("#totalprice").text("<?= $GLOBALS['currencysymbol'];?>"+total);
             $("#totalprice1").text("<?= $GLOBALS['currencysymbol'];?>"+total);
}
</script>
<script>
    function qtychangeafter(ids,prices){
        $('#qty'+ids).val($('#qty'+ids).val().replace(/[^0-9]/g, ''));
        var oldval=$('#qty'+ids).val();
        $('#qty'+ids).removeClass('errorborder');
            var newvalue=Number(oldval);
                if (newvalue == 0) {
                newvalue = 1; // Enforce minimum quantity
            }
            $('#qty'+ids).val(newvalue);

            var totalsingle=prices*newvalue;
             totalsingle=totalsingle.toFixed(2);
            $('#total'+ids).text("<?= $GLOBALS['currencysymbol'];?>"+totalsingle);
            $('#totalpricerow'+ids).val(totalsingle);
            var total = 0;
            $('.totalpricerow').each(function () {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
             total=total.toFixed(2);
            $("#totalprice").text("<?= $GLOBALS['currencysymbol'];?>"+total);
            $("#totalprice1").text("<?= $GLOBALS['currencysymbol'];?>"+total);
}
</script>
<script>
    function savequotation(){
         Swal.fire({
              title: "Are you sure?",
              text: "You want to save this quotation?",
              icon: "warning",
              showCancelButton: true,
                           confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, cancel",
            }).then((result) => {
                if (result.isConfirmed) 
                {
         $('.coverloader').show();
        var customerid=$('#customerSelect').val();
        var datavalue=[];
         var checkqtyoverride=0;
        $('#dynamicTable tbody tr .qty').each(function() {
            if ($(this).data('id') < $(this).val()) {
                checkqtyoverride=1;
                $(this).addClass('errorborder');
            }
            
        });
        if(checkqtyoverride == 1)
        {
              $('.coverloader').hide();
            Swal.fire({
                  title: "Item qty is greater then inventory item qty.",
                  text: "You want to continue this quantity?",
                  icon: "warning",
                 showCancelButton: true,
                           confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, cancel",
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
        
                        var idsarray = $('#dynamicTable tbody tr .qty').map(function() { return this.value+'BHAVIK'+this.id;}).get();
                     if(idsarray == "")
                        {
                            
                               Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Please add minimum one item.",
                                           timer: 2000,
                                        });
                        }
                        else
                        {
                            $.ajax({
                            url: '<?=base_url('/seller/save-quotation')?>',
                            type: 'POST',
                            data:{"qtyvalue": idsarray,"customerid":customerid, <?=csrf_token()?>: '<?=csrf_hash()?>'},
                            success: function(response) {
                                 $('.coverloader').hide();
                
                                // Display success or error message
                                if (response.status === 'success') {
                                   Swal.fire({
                                      title: "Success",
                                      text: response.message,
                                      icon: "success",
                                      timer: 2000,
                                      allowOutsideClick: false,
                                       willClose: () => {
                                        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                                        $("#order_product").val("").selectpicker('refresh');
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
                                 $('.coverloader').hide();
                                 Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Error occurred while submitting the form.",
                                           timer: 2000,
                                        });
                            }
                        });
                        }
                    }
                });
        }
        else
        {
            var idsarray = $('#dynamicTable tbody tr .qty').map(function() { return this.value+'BHAVIK'+this.id;}).get();
                     if(idsarray == "")
                        {
                              $('.coverloader').hide();
                               Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Please add minimum one item.",
                                           timer: 2000,
                                        });
                        }
                        else
                        {
                            $.ajax({
                            url: '<?=base_url('/seller/save-quotation')?>',
                            type: 'POST',
                            data:{"qtyvalue": idsarray,"customerid":customerid, <?=csrf_token()?>: '<?=csrf_hash()?>'},
                            success: function(response) {
                                 $('.coverloader').hide();
                
                                // Display success or error message
                                if (response.status === 'success') {
                                   Swal.fire({
                                      title: "Success",
                                      text: response.message,
                                      icon: "success",
                                      timer: 2000,
                                      allowOutsideClick: false,
                                       willClose: () => {
                                        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                                        $("#order_product").val("").selectpicker('refresh');
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
                                 $('.coverloader').hide();
                                 Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Error occurred while submitting the form.",
                                           timer: 2000,
                                        });
                            }
                        });
                        }
        }
                }
            });
    }
</script>
<script>
    function savesendquotation(){
           Swal.fire({
               title: "Are you sure?",
              text: "You want to save and send this quotation?",
              icon: "warning",
              showCancelButton: true,
                           confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, cancel",
            }).then((result) => {
                if (result.isConfirmed) 
                {
        $('.coverloader').show();
        var customerid=$('#customerSelect').val();
        var datavalue=[];
        var checkqtyoverride=0;
        $('#dynamicTable tbody tr .qty').each(function() {
            if ($(this).data('id') < $(this).val()) {
                checkqtyoverride=1;
                $(this).addClass('errorborder');
            }
            
        });
        if(checkqtyoverride == 1)
        {
              $('.coverloader').hide();
            Swal.fire({
                  title: "Item qty is greater then inventory item qty.",
                  text: "You want to continue this quantity?",
                  icon: "warning",
                 showCancelButton: true,
                           confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, cancel",
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        var idsarray = $('#dynamicTable tbody tr .qty').map(function() { return this.value+'BHAVIK'+this.id;}).get();
                        if(idsarray == "")
                        {
                            
                               Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Please add minimum one item.",
                                           timer: 2000,
                                        });
                        }
                        else
                        {
                            $.ajax({
                            url: '<?=base_url('/seller/save-send-quotation')?>',
                            type: 'POST',
                            data:{"qtyvalue": idsarray,"customerid":customerid, <?=csrf_token()?>: '<?=csrf_hash()?>'},
                            success: function(response) {
                                 $('.coverloader').hide();
                
                                // Display success or error message
                                if (response.status === 'success') {
                                     Swal.fire({
                                      title: "Success",
                                      text: response.message,
                                      icon: "success",
                                      timer: 2000,
                                      allowOutsideClick: false,
                                       willClose: () => {
                                        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                                        $("#order_product").val("").selectpicker('refresh');
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
                                 $('.coverloader').hide();
                                 Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Error occurred while submitting the form.",
                                           timer: 2000,
                                        });
                            }
                        });
                        }
                    }
                });
        }
        else
        {
             var idsarray = $('#dynamicTable tbody tr .qty').map(function() { return this.value+'BHAVIK'+this.id;}).get();
                    if(idsarray == "")
                        {
                              $('.coverloader').hide();
                               Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Please add minimum one item.",
                                           timer: 2000,
                                        });
                        }
                        else
                        {
                            $.ajax({
                            url: '<?=base_url('/seller/save-send-quotation')?>',
                            type: 'POST',
                            data:{"qtyvalue": idsarray,"customerid":customerid, <?=csrf_token()?>: '<?=csrf_hash()?>'},
                            success: function(response) {
                                 $('.coverloader').hide();
                
                                // Display success or error message
                                if (response.status === 'success') {
                                     Swal.fire({
                                      title: "Success",
                                      text: response.message,
                                      icon: "success",
                                      timer: 2000,
                                      allowOutsideClick: false,
                                       willClose: () => {
                                        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                                        $("#order_product").val("").selectpicker('refresh');
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
                                 $('.coverloader').hide();
                                 Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Error occurred while submitting the form.",
                                           timer: 2000,
                                        });
                            }
                        });
                        }
        }
                }
            });

    }
</script>
<script>
    function savedownquotation(){
           Swal.fire({
               title: "Are you sure?",
              text: "You want to save and download this quotation?",
              icon: "warning",
             showCancelButton: true,
                           confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, cancel",
            }).then((result) => {
                if (result.isConfirmed) 
                {
        $('.coverloader').show();
        var customerid=$('#customerSelect').val();
        var datavalue=[];
        var checkqtyoverride=0;
        $('#dynamicTable tbody tr .qty').each(function() {
            if ($(this).data('id') < $(this).val()) {
                checkqtyoverride=1;
                $(this).addClass('errorborder');
            }
            
        });
        if(checkqtyoverride == 1)
        {
              $('.coverloader').hide();
            Swal.fire({
                  title: "Item qty is greater then inventory item qty.",
                  text: "You want to continue this quantity?",
                  icon: "warning",
                  showCancelButton: true,
                           confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, cancel",
                }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        var idsarray = $('#dynamicTable tbody tr .qty').map(function() { return this.value+'BHAVIK'+this.id;}).get();
                        if(idsarray == "")
                        {
                              
                               Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Please add minimum one item.",
                                           timer: 2000,
                                        });
                        }
                        else
                        {
                        $.ajax({
                            url: '<?=base_url('/seller/save-download-quotation')?>',
                            type: 'POST',
                            data:{"qtyvalue": idsarray,"customerid":customerid, <?=csrf_token()?>: '<?=csrf_hash()?>'},
                            success: function(response) {
                                 $('.coverloader').hide();
                
                                // Display success or error message
                                if (response.status === 'success') {
                                     const link = document.createElement('a');
                                    link.href = response.downloadUrl;
                                    link.download = response.downloadUrl.split('/').pop(); // Optional: Set a custom filename
                                    document.body.appendChild(link);
                                    link.click();
                                    document.body.removeChild(link);
                                   Swal.fire({
                                      title: "Success",
                                      text: response.message,
                                      icon: "success",
                                      timer: 2000,
                                      allowOutsideClick: false,
                                       willClose: () => {
                                        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                                        $("#order_product").val("").selectpicker('refresh');
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
                                 $('.coverloader').hide();
                                 Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Error occurred while submitting the form.",
                                           timer: 2000,
                                        });
                            }
                        });
                        }
                    }
                });
        }
        else
        {
            var idsarray = $('#dynamicTable tbody tr .qty').map(function() { return this.value+'BHAVIK'+this.id;}).get();
                    if(idsarray == "")
                        {
                              $('.coverloader').hide();
                               Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Please add minimum one item.",
                                           timer: 2000,
                                        });
                        }
                        else
                        {
                            $.ajax({
                            url: '<?=base_url('/seller/save-download-quotation')?>',
                            type: 'POST',
                            data:{"qtyvalue": idsarray,"customerid":customerid, <?=csrf_token()?>: '<?=csrf_hash()?>'},
                            success: function(response) {
                                 $('.coverloader').hide();
                
                                // Display success or error message
                                if (response.status === 'success') {
                                     const link = document.createElement('a');
                                    link.href = response.downloadUrl;
                                    link.download = response.downloadUrl.split('/').pop(); // Optional: Set a custom filename
                                    document.body.appendChild(link);
                                    link.click();
                                    document.body.removeChild(link);
                                   Swal.fire({
                                      title: "Success",
                                      text: response.message,
                                      icon: "success",
                                      timer: 2000,
                                      allowOutsideClick: false,
                                       willClose: () => {
                                        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                                        $("#order_product").val("").selectpicker('refresh');
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
                                 $('.coverloader').hide();
                                 Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text:"Error occurred while submitting the form.",
                                           timer: 2000,
                                        });
                            }
                        });
                        }
        }
                }
            });
    }
</script>
<script>
    function saveprintInvoice(){
         $('.coverloader').show();
        var customerid=$('#customerSelect').val();
        var datavalue=[];
        var idsarray = $('#dynamicTable tbody tr .qty').map(function() { return this.value+'BHAVIK'+this.id;}).get();
        $.ajax({
            url: '<?=base_url('/seller/save-print-quotation')?>',
            type: 'POST',
            data:{"qtyvalue": idsarray,"customerid":customerid, <?=csrf_token()?>: '<?=csrf_hash()?>'},
            success: function(response) {
                 $('.coverloader').hide();
                // Display success or error message
                if (response.status === 'success') {
                     $("#section-to-print").html(response.htmlcode);
                   Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                      allowOutsideClick: false,
                       willClose: () => {
                          setTimeout(() => {
                                      window.print();
                                      $("#section-to-print").html('');
                                    }, 1000);

                        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                        $("#order_product").val("").selectpicker('refresh');
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
               $('.coverloader').hide();
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
<script>
    function deleterow(ids){
       $('.main'+ids).remove();

         var total = 0;
            $('.totalpricerow').each(function () {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
             total=total.toFixed(2);
            $("#totalprice").text("<?= $GLOBALS['currencysymbol'];?>"+total);
            $("#totalprice1").text("<?= $GLOBALS['currencysymbol'];?>"+total);

    }
</script>
<script>
    function cancelall(){
         Swal.fire({
          title: "Are you sure?",
          text: "You want to Cancel this quotation?",
          icon: "warning",
          showCancelButton: true,
                  confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
        }).then((result) => {

          if (result.isConfirmed) {
        $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
        $("#order_product").val("").selectpicker('refresh');
          }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#customerSelect').on('change', function() {
            $('.coverloader').show();
            let selectedCustomerId = $(this).val();
            let count = $('#dynamicTable tbody .countrow').length;
            if (selectedCustomerId){
                if(count > 0){
                    Swal.fire({
                          title: "Are you sure?",
                          text: "You want change the customer?",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                            confirmButtonText: "Yes, Continue it!",
                            cancelButtonText: "No, cancel",
                        }).then((result) => {
                          if (result.isConfirmed) {
                              $('.coverloader').show();
                                $('#dynamicTable tbody').html('<tr id="nodata"><td colsplan="7">No data available.</td></tr>');
                              get_customer(selectedCustomerId);
                          }
                        });
                       $('.coverloader').hide();
                       $("#order_product").val("").selectpicker('refresh');
                }
                if(count <= 0){
                  get_customer(selectedCustomerId);
                }
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .quotation").addClass('open');
     $("#sidebar-menu .quotationsub").addClass('show');
     $("#sidebar-menu .quotationadd").addClass('active-page');
    });
</script>
<script>

      // Track maximum AJAX time
    let maxAjaxTime = 0;

    // Function to update maximum AJAX time display
    function updateMaxAjaxTime(time) {
        if (time > maxAjaxTime) {
            maxAjaxTime = time;
            $('#maxAjaxTime').text(maxAjaxTime.toFixed(2));
            // Optionally save to localStorage
            localStorage.setItem('maxAjaxTime', maxAjaxTime);
        }
    }

function get_customer(selectedCustomerId) {
      $('.coverloader').show();
    // AJAX request
    $.ajax({
        url: '/seller/get-customer',
        method: 'GET',
        data: {
            customerId: selectedCustomerId,
            '<?php echo csrf_token() ?>': '<?php echo csrf_hash() ?>'
        },
        dataType: 'json',
        beforeSend: function () {
            // Start timing
            this.startTime = performance.now();
            $('.coverloader').show();
        },
        success: function (response) {
            // Calculate AJAX request time
            const ajaxTime = performance.now() - this.startTime;
            updateMaxAjaxTime(ajaxTime);

            $('.coverloader').hide();
            if (response.itemlist === 'errorseller') {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Sales Person are Not allow.",
                });
            } else {
                $('.customerdetails').html(
                    '<strong>Customer:</strong> ' + response.customer.first_name + ' ' + response.customer.last_name +
                    '<br><strong>Customer Type:</strong> ' + response.categories.category_name
                );
                

                $('#order_product').empty();

                // Add default disabled option
                var optionNull = new Option('Select Items', '', false, false);
                optionNull.disabled = true;
                $('#order_product').append(optionNull);
                $('#order_product').val('').selectpicker('refresh');

                // Loop through items to create options
                $.each(response.itemlist, function (index, item) {
                    var rates = item.rate;

                    if (item.pricebook_rate !== null && item.pricebook_rate !== 0 && item.pricebook_rate !== '0') {
                        rates = item.pricebook_rate;
                    }

                    if (rates) {
                        var valuesNew = [
                            item.item_id,
                            item.item_name,
                            item.unit,
                            item.description,
                            rates,
                            item.stocks,
                            item.sku
                        ].join('BHAVIK');

                        var namesNew = item.item_name + '(' + item.sku + ',' + item.description + ')';
                        var option = new Option(namesNew, valuesNew, false, false);

                        $('#order_product').append(option);
                    }
                });

                // Refresh selectpicker once after all options are added
                $('#order_product').val('').selectpicker('refresh');
            }

            // Display AJAX time (optional, for debugging)
            console.log('AJAX Request Time: ' + ajaxTime.toFixed(2) + ' ms');
            if (response.server_execution_time) {
                console.log('Server Execution Time: ' + (response.server_execution_time * 1000).toFixed(2) + ' ms');
            }
        },
        error: function (xhr, status, error) {
            // Calculate AJAX request time
            const ajaxTime = performance.now() - this.startTime;
            updateMaxAjaxTime(ajaxTime);

            $('.coverloader').hide();
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: error,
                timer: 2000,
            });
        }
    });
}
  </script>
</body>
</html>