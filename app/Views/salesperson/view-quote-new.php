<?php
$customerdata = $itemdata['customer'][0];
?>


<style type="text/css">
* {
    margin: 0;
    padding: 0;
    text-indent: 0;
    font-family: Arial, sans-serif;
}
h1, h2, h3, h4, h5, h6 {
    font-family: Arial, sans-serif;
}
.s1 {
    color: #333;
    font-family: "Arial Black", sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 10pt;
}
.s2 {
    color: #333;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 9pt;
}
.s3 {
    color: #333;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 10pt;
}
.s9 {
    color: #333;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 8pt;
}
table {
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}
th, td {
    padding: 10px;
    padding-bottom: 20px;
    font-weight: normal;
    font-size: 10pt;
}
</style>
<div class="card-body py-40" style="padding:50px">
  <div class="row justify-content-center" id="invoice">
    <table width="100%" border="0">
      <tbody>
        <tr>
          <td><img src="https://partner.havellslighting.com/assets/images/havells-logo.svg" alt="image" style="margin-block-end:0.5rem !important;vertical-align: bottom;margin-bottom:5px" height="40px">
            <p class="s1"><strong>Havells Lighting LLC</strong></p>
            <p class="s2">111 Preamble CT</p>
            <p class="s2">Anderson South Carolina 29621</p>
            <p class="s2">8554283557</p>
            <p class="s2">www.havellslighting.com</p></td>
          <td style="text-align: right;vertical-align: top"><h1 >Quote</h1>
            <h3 style="margin-top: 10px">Quote#&nbsp;<?=$itemdata['mainquot'][0]['quotation_number'];?>
            </h3>
            <h4 style="margin-top: 10px">Status:
              <?=$itemdata['mainquot'][0]['status'];?>
            </h4></td>
        </tr>
      </tbody>
    </table>
    <table width="100%" border="0" >
      <tbody>
        <tr >
          <td colspan="2" align="left" style=" padding-top: 10px; "><h5>Bill To:</h5>
            <p class="s1"><strong>
              <?=$customerdata['first_name'];?>
              <?=$customerdata['last_name'];?>
              </strong></p>
            <p class="s2">
              <?=$customerdata['billing_address'];?>
            </p>
            <p class="s2">
              <?=$customerdata['billing_city'];?>
              ,
              <?=$customerdata['billing_state'];?>
              ,
              <?=$customerdata['billing_pincode'];?>
            </p>
            <p class="s2">
              <?=$customerdata['billing_phone_number'];?>
            </p></td>
        </tr>
        <tr>
          <td align="left" style=" padding-top: 10px; "><h5>Ship To:</h5>
            <p class="s1"><strong>
              <?=$customerdata['first_name'];?>
              <?=$customerdata['last_name'];?>
              </strong></p>
            <p class="s2">
              <?=$customerdata['shipping_address'];?>
            </p>
            <p class="s2">
              <?=$customerdata['shipping_city'];?>
              ,
              <?=$customerdata['shipping_state'];?>
              ,
              <?=$customerdata['shipping_pincode'];?>
            </p>
            <p class="s2">
              <?=$customerdata['shipping_phone_number'];?>
            </p></td>
          <td align="right" style="vertical-align: bottom"><p class="s1"><strong>Quote Date</strong>:<?php echo date($GLOBALS['defaultdateformat'],strtotime($itemdata['mainquot'][0]['created_at']));?>
            </p>
            <p class="s1"><strong>Sales Person</strong>:
              <?=$sellerdata['first_name'];?>
              <?=$sellerdata['last_name'];?>
            </p></td>
        </tr>
      </tbody>
    </table>
    <table style="border-collapse:collapse" cellspacing="0" width="100%">
      <thead style="vertical-align: bottom;">
        <tr style="border-color: inherit;border-style: solid;border-width: 0;">
          <th scope="col" bgcolor="#3B3D39" style="padding: 5px;padding-left: 10pt;color: #ffffff;text-align: left" width="5%">#</th>
          <th scope="col" bgcolor="#3B3D39" style="padding: 5px;padding-left: 10pt;color: #ffffff;text-align: left" width="55%">Item &amp; Description</th>
          <th scope="col" bgcolor="#3B3D39" style="padding: 5px;color: #ffffff;text-align: left" width="10%" >Qty</th>
          <th scope="col" bgcolor="#3B3D39" style="padding: 5px;color: #ffffff;text-align: right" width="10%">Rate</th>
          <th scope="col"bgcolor="#3B3D39" style="padding: 5px;color: #ffffff;text-align: right" width="20%"  >Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
$i = 01;
foreach ($itemdata['quotitem'] as $itemdatas) {?>
        <tr style=" border-bottom: 1pt solid #cccccc;padding-bottom:10px;border-spacing:10px">
          <td width="5%" style="padding-top: 5pt;padding-left: 10pt;text-align: left;vertical-align: top" class="s3" ><?=$i;?></td>
          <td width="55%" style="padding-top: 5pt;padding-left: 10pt;text-align: left;vertical-align: top;" class="s3">
            <?=$itemdatas['item_name'];?>
            <br>
            <strong>SKU:</strong>
            <?=$itemdatas['item_sku'];?>
            <br>

            <?=$itemdatas['item_description'];?>
            </td>
          <td width="10%" style="text-align: left;vertical-align: top; font-family: Arial, sans-serif;" class="s3"><?=$itemdatas['quantity'];?>
            <p class="s9" style="text-align: left;">
              <?=$itemdatas['item_unit'];?>
            </p></td>
          <td class="s3" width="10%" style="text-align: right;vertical-align: top;"><?= $GLOBALS['currencysymbol'];?><?=$itemdatas['amount'];?></td>
          <td class="s3" width="20%" style="text-align: right;vertical-align: top; "><?= $GLOBALS['currencysymbol'];?><?=$itemdatas['total'];?></td>
        </tr>
        <?php $i++;}?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" ></td>
          <td align="right" style="padding:10px !important;" class="s3">Subtotal</td>
          <td align="right" style="padding:10px !important;" class="s3"><?= $GLOBALS['currencysymbol'];?>
            <?=$itemdata['mainquot'][0]['sub_total'];?></td>
        </tr>
          <tr>
          <td colspan="4"  align="right" style="padding:10px !important;" class="s3">Out of state sale (0%)</td>
          <td align="right" style="padding:10px !important;" class="s3"><?= $GLOBALS['currencysymbol'];?>0.00</td>
        </tr>
        <tr>
          <td colspan="3"  ></td>
          <td align="right" style="padding:10px !important;" class="s3">Total</td>
          <td align="right" style="padding:10px !important;" class="s3"><?= $GLOBALS['currencysymbol'];?>
            <?=$itemdata['mainquot'][0]['grand_total'];?></td>
        </tr>
      </tfoot>
    </table>
    <table width="100%" border="0">
      <tbody>
        <tr>
          <td style="padding:10px !important;"><p class="s3"><strong>Notes:</strong></p>
            <p class="s3">Looking forward for your business</p></td>
        </tr>
        <tr>
          <td style="padding:10px !important;"><p class="s3"><strong>Terms &amp; Conditions</strong></p>
            <p class="s3"> <strong>1.</strong> Product Certification: HAVELLS exclusively stock/sell UL/ETL certified products.<br>
              <strong>2.</strong> Sales Tax: We collect sales tax only for the state of South Carolina (SC). Customers in all other states are responsible for their own sales and use tax filings and payments. Havells Lighting is not responsible or liable for any sales taxes collected or paid in states other than SC.<br>
              <strong>3.</strong> Additional Certification: All our products are Energy Star or DLC certified (available for certification with ES/DLC) and are eligible for Energy Company Rebate programs.<br>
              <strong>4.</strong> Warranty: Our lights are guaranteed for 2-5 years, subject to inspection prior to replacement. "HAVELLS" is not responsible for replacing lights that fail due to abnormal use or misuse of the products. In cases where the product is discontinued, "HAVELLS" will replace it with the current equivalent product.</p></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
