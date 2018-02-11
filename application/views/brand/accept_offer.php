<div id="page-content">
  <!-- Invoice Header -->
  <div class="content-header">
    <div class="header-section">
      <h1>
        <i class="gi gi-usd"></i>Invoice<br><small>Brand</small>
      </h1>
    </div>
  </div>
  <ul class="breadcrumb breadcrumb-top">
    <li>Pages</li>
    <li><a href="">Invoice</a></li>
  </ul>
  <!-- END Invoice Header -->

  <!-- Invoice Block -->
  <div class="block full">
    <!-- Invoice Title -->
    <div class="block-title">
      <div class="block-options pull-right">
        <a href="javascript:void(0)" class="btn btn-sm btn-alt btn-default" onclick="App.pagePrint();"><i class="fa fa-print"></i> Print</a>
      </div>
      <h2><strong>Invoice</strong> </h2>
    </div>
    <!-- END Invoice Title -->

    <!-- Invoice Content -->
    <!-- 2 Column grid -->
    <div class="row block-section">
    </div>
    <!-- END 2 Column grid -->

    <!-- Table -->
    <div class="table-responsive">
      <table class="table table-vcenter">
        <thead>
          <tr>
            <th></th>
            <th style="">Product</th>
            <th></th>
            <th></th>
            <th class="text-right">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center"><h2>1</h2></td>
            <td>
              <h2><?php echo $camp_data['camp_name'] ?></h2>
              <span class="label label-info"><?php echo $camp_data['camp_category'] ?></span>
            </td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-right"><span class="label label-primary"><?php echo $proposal_data['pro_price']; ?> INR</span></td>
          </tr>
          <tr class="active">
            <td colspan="4" class="text-right"><span class="h4">SUBTOTAL</span></td>
            <td class="text-right"><span class="h4"><?php echo $proposal_data['pro_price']; ?> INR</span></td>
          </tr>
          <tr class="active">
            <td colspan="4" class="text-right"><span class="h4">VAT RATE</span></td>
            <td class="text-right"><span class="h4"><?php echo $tax; ?>%</span></td>
          </tr>
          <tr class="active">
            <td colspan="4" class="text-right"><span class="h4">VAT DUE</span></td>
            <td class="text-right"><span class="h4"><?php echo $tax*$proposal_data['pro_price']/100; ?> INR</span></td>
          </tr>
          <tr class="active">
            <td colspan="4" class="text-right"><span class="h3"><strong>TOTAL DUE</strong></span></td>
            <td class="text-right"><span class="h3"><strong><?php echo $proposal_data['pro_price']+$tax*$proposal_data['pro_price']/100; ?> INR</strong></span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- END Table -->

    <div class="clearfix">
      <div class="btn-group pull-right">
        <form class="" action="<?php echo SITEURL.'brand/confirm_offer_accept' ?>" method="post">
          <input type="hidden" name="pro_id" value="<?php echo $proposal_data['pro_id'] ?>">
          <button class="btn btn-primary" type="submit" name="button"><i class="fa fa-angle-right"></i> CONFIRM</button>
        </form>

      </div>
    </div>
    <!-- END Invoice Content -->
  </div>
  <!-- END Invoice Block -->
</div>
<!-- END Page Content -->
