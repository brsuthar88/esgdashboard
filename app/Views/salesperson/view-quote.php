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
@media print {
  body {
    visibility: hidden;
  }
  #invoice {
    visibility: visible;
    position: absolute;
    left: 0;
    top: 0;
  }
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
$customerdata = $itemdata['customer'][0];
?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
  <h6 class="fw-semibold mb-0">Quotation View</h6>
  <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/seller" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
         <li class="fw-medium">></li>
         <li class="fw-medium"> <a href="/seller/list-quotation" class="d-flex align-items-center gap-1 hover-text-primary">List Quotation</a></li>
          <li>></li>
        <li class="fw-medium">Quotation View</li>
      </ul>
</div>

    <div class="card">
      <div class="card-header">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
          <a  href="#" onclick="confirmMailSend('/seller/send-detail-mail/<?=esc($itemdata['mainquot'][0]['quotation_id']);?>')" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
            <iconify-icon icon="pepicons-pencil:paper-plane" class="text-xl"></iconify-icon>
            Send Quotation
          </a>
          <a href="/seller/generate-pdf/<?=esc($itemdata['mainquot'][0]['quotation_id']);?>" class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
            <iconify-icon icon="solar:download-linear" class="text-xl"></iconify-icon>
            Download
          </a>
          <!-- <button type="button" class="btn btn-sm btn-danger radius-8 d-inline-flex align-items-center gap-1" onclick="printInvoice()">
            <iconify-icon icon="basil:printer-outline" class="text-xl"></iconify-icon>
            Print
          </button> -->
        </div>
      </div>
      <div class="card-body py-40">
        <div class="row justify-content-center" id="invoice">
          <div class="col-lg-8">
            <div class="shadow-4 border radius-8">
              <div class="p-20 d-flex flex-wrap justify-content-between gap-3 border-bottom">
                 <div>
                  <img src="<?=base_url('assets/images/logo.png');?>" alt="image" class="mb-8">
					<p class="mb-1 text-sm"> <strong>Havells Lighting LLC</strong></p>
                    <p class="mb-1 text-sm">111 Preamble CT</p>
                    <p class="mb-1 text-sm">Anderson South Carolina 29621</p>
                    <p class="mb-1 text-sm">8554283557</p>
                    <p class="mb-1 text-sm">www.havellslighting.com</p>
                </div>
				  <div style="text-align: right;">
					  <h3>Quote</h3>
                  <h3 class="text-xl">Quote#&nbsp;<?=$itemdata['mainquot'][0]['quotation_number'];?></h3>
                  <h4 style="text-transform: capitalize;font-size:0.875rem !important;margin-bottom: .25rem !important;margin-top: 0;font-family: 'Inter', sans-serif;color:#4B5563;">Status:<?=$itemdata['mainquot'][0]['status'];?></h4>
                </div>

              </div>
              <div class="py-28 px-20">
                <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
                  <div>
                    <h6 class="text-md">Bill To:</h6>
                    <table class="text-sm text-secondary-light">
                      <tbody>
                        <tr>
                          <td><strong><?=$customerdata['first_name'];?> <?=$customerdata['last_name'];?></strong></td>
                        </tr>
                        <tr>
                          <td><?=$customerdata['billing_address'];?></td>
                        </tr>
                        <tr>
                          <td><?=$customerdata['billing_city'];?>,<?=$customerdata['billing_state'];?>,<?=$customerdata['billing_pincode'];?></td>
                        </tr>
                        <tr>
                          <td><?=$customerdata['billing_phone_number'];?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
				  <div>
                    <h6 class="text-md">Ship To:</h6>
                    <table class="text-sm text-secondary-light">
                      <tbody>
                        <tr>
                          <td><strong><?=$customerdata['first_name'];?> <?=$customerdata['last_name'];?></strong></td>
                        </tr>
                        <tr>
                          <td><?=$customerdata['shipping_address'];?></td>
                        </tr>
                        <tr>
                          <td><?=$customerdata['shipping_city'];?>,<?=$customerdata['shipping_state'];?>,<?=$customerdata['shipping_pincode'];?></td>
                        </tr>
                        <tr>
                          <td><?=$customerdata['shipping_phone_number'];?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div>
                    <table class="text-sm text-secondary-light">
                      <tbody>
                        <tr>
                          <td>Quote Date</td>
                          <td class="ps-8">:<?php echo date($GLOBALS['defaultdateformat'],strtotime($itemdata['mainquot'][0]['created_at']));?></td>
                        </tr>
                        <tr>
                          <td>Sales person</td>
                          <td class="ps-8">:<?=$sellerdata['first_name'];?> <?=$sellerdata['last_name'];?></td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="mt-24">
                  <div class="table-responsive scroll-sm">
                    <table class="table bordered-table text-sm" width="100%" style="min-width: 100%;">
                      <thead>
                        <tr>
                             <th scope="col" class="text-start">#</th>
                    <th scope="col" class="text-start">Item & Description</th>

                    <th scope="col" class="text-center">Unit</th>
                    <th scope="col" class="text-end">Rate</th>
					<th scope="col" class="text-center">Qty</th>
					<th scope="col" class="text-end">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$i = 01;
foreach ($itemdata['quotitem'] as $itemdatas) {?>

                        <tr>
                          <td><?=$i;?></td>
                          <td width="30%"><?=$itemdatas['item_name'];?><br><span style="font-size: 12px"><strong>SKU:</strong><?=$itemdatas['item_sku'];?></span><br><span style="font-size: 12px"><?=$itemdatas['item_description'];?></span></td>
                          <td><?=$itemdatas['item_unit'];?></td>
                          <td><?= $GLOBALS['currencysymbol'];?><?=$itemdatas['amount'];?></td>
                          <td><?=$itemdatas['quantity'];?></td>
                          <td class="text-end"><?= $GLOBALS['currencysymbol'];?><?=$itemdatas['total'];?></td>
                        </tr>
                        <?php $i++;}?>

                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div>
                      <p class="text-sm mb-0"><span class="text-primary-light fw-semibold">Notes:</span></p>
                      <p class="text-sm mb-0">Looking forward for your business</p>
                    </div>
                    <div>
                      <table class="text-sm">
                        <tbody>
                          <tr>
                            <td class="pe-64 border-bottom pb-4">Subtotal</td>
                            <td class="pe-16 border-bottom pb-4">
                              <span class="text-primary-light fw-semibold"><?= $GLOBALS['currencysymbol'];?><?=$itemdata['mainquot'][0]['sub_total'];?></span>
                            </td>
                          </tr>
                           <tr>
                            <td class="pe-64 border-bottom pb-4">Out of state sale (0%)</td>
                            <td class="pe-16 border-bottom pb-4">
                              <span class="text-primary-light fw-semibold"><?= $GLOBALS['currencysymbol'];?>0.00</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="pe-64 pt-4">
                              <span class="text-primary-light fw-semibold">Total:</span>
                            </td>
                            <td class="pe-16 pt-4">
                              <span class="text-primary-light fw-semibold"><?= $GLOBALS['currencysymbol'];?><?=$itemdata['mainquot'][0]['grand_total'];?></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="mt-64">
                  <p class="text-left text-secondary-light" style="font-size: 12px">Terms &amp; Conditions<br>
                    1. Product Certification: HAVELLS exclusively stock/sell UL/ETL certified products.<br>
                    2. Sales Tax: We collect sales tax only for the state of South Carolina (SC). Customers in all other states are responsible for their own sales<br>
                    and use tax filings and payments. Havells Lighting is not responsible or liable for any sales taxes collected or paid in states other than SC.<br>
                    3. Additional Certification: All our products are Energy Star or DLC certified (available for certification with ES/DLC) and are eligible for<br>
                    Energy Company Rebate programs.<br>
                    4. Warranty: Our lights are guaranteed for 2-5 years, subject to inspection prior to replacement. &quot;HAVELLS&quot; is not responsible for replacing<br>
                    lights that fail due to abnormal use or misuse of the products. In cases where the product is discontinued, &quot;HAVELLS&quot; will replace it with<br>
                  the current equivalent product.</p>
                </div>


              </div>
            </div>
          </div>
         <?php if($itemdata['mainquot'][0]['comment']) { ?>
               <div class="col-lg-4" style="font-size:14px;">
                   <?php
                    $data = json_decode($itemdata['mainquot'][0]['comment'], true);

                    // Define status labels with proper HTML formatting
                    $status_labels = [
                        "invoice"  => '<span class="text-xs bg-success-100 text-success-600 radius-4 px-10 py-2 fw-semibold">Invoice</span>',
                        "pending"  => '<span class="text-xs bg-warning-100 text-warning-600 radius-4 px-10 py-2 fw-semibold">Pending</span>',
                        "rejected" => '<span class="text-xs bg-danger-100 text-danger-600 radius-4 px-10 py-2 fw-semibold">Reject</span>',
                        "accept"   => '<span class="text-xs bg-info-100 text-info-600 radius-4 px-10 py-2 fw-semibold">Accept</span>',
                    ];
                    
                    $status_class= [
                        "invoice"  => 'alert-success',
                        "pending"  => 'alert-warning',
                        "rejected" => 'alert-danger',
                        "accept"   => 'alert-info',
                    ];
                    
                    // Check if $data is valid and contains comments
                    if (!empty($data) && is_array($data)) {
                        foreach ($data as $status => $commentsArray) {
                            // Check if the status exists in the label array, otherwise default to plain text
                            $status_display = $status_labels[$status] ?? ucfirst($status);
                            $status_class_dispaly = $status_class[$status] ?? ucfirst($status);
                            // Loop through each comment for this status
                            foreach ($commentsArray as $details) {
                                // Assign default values to avoid undefined index errors
                                $date = $details['date'] ?? 'Unknown Date';
                                $username = $details['username'] ?? 'Unknown User';
                                $role = $details['role'] ?? 'Unknown Role';
                                $comment = htmlspecialchars($details['comment'] ?? 'No comment', ENT_QUOTES, 'UTF-8');
                    
                                // Display comment block
                                echo "<div class='alert $status_class_dispaly shadow-4' role='alert' style='background: transparent;'>";
                                echo "{$status_display}  {$date}   ";
                                echo "<span ><b>- {$username} ({$role})</b></span> <br> <br>{$comment}";
                                echo "</div>";
                            }
                        }
                    } else {
                        echo "<p>No comments available.</p>";
                    }  ?>

                </div>

            <?php } ?>
        </div>
      </div>
    </div>

  </div>
   </div>
  <!-- footer -->
  <?php echo view('salesperson/partials/Sellerfooter'); ?>

  <!-- JS -->
  <?php echo view('salesperson/partials/Sellerjs'); ?>
<script>
  let table = new DataTable('#dataTable');
</script>
	<script>
    function printInvoice() {
      window.print();
    }
</script>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .quotation").addClass('open');
     $("#sidebar-menu .quotationsub").addClass('show');
     $("#sidebar-menu .quotationlist").addClass('active-page');
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
      showConfirmButton: false,
      timer: 2000,
      allowOutsideClick: false,
    });
</script>
<?php endif;?>
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
// function confirmDownload(url) 
// {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You want to download this quotation?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#3085d6",
//       confirmButtonText: "Yes, Continue it!",
//         cancelButtonText: "No, cancel",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = url; // Redirect if confirmed
//         }
//     });
// }
</script>
</body>
</html>