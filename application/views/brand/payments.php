<div id="page-content">
  <div class="content-header">
    <div class="header-section">
      <h1>
        <i class="fa fa-inr"></i>Payments<br><small>Your Trust Our Responsibiliy &#x263A;!!</small>
      </h1>
    </div>
  </div>

  <!-- END Datatables Header -->

  <!-- Datatables Content -->
  <div class="block full">
    <div class="block-title">
      <h2><strong>Payments</strong> List</h2>
    </div>

    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Payment From</th>
            <th class="text-center">Payment To</th>
            <th class="text-center">Brand Email</th>
            <th class="text-center">Transaction Id</th>
            <th class="text-center">Purpose</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Currency</th>
            <th class="text-center">Start date</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($payments):
            foreach($payments as $payment):
              ?>
              <tr role="row" class="odd">
                <td tabindex="0" class="sorting_1"><?php echo $payment['payment_id'];?></td>
                <td><?php echo $_SESSION['name']?></td>
                <td>WebAssets</td>
                <td><?php echo $payment['payer_email'];?></td>
                <td><?php echo $payment['sale_id'];?></td>
                <td></td>
                <td><?php echo $payment['subtotal'];?></td>
                <?php if ($payment['payment_method'] == 'payumoney'): ?>
                  <td>INR</td>
                <?php else: ?>
                  <td>INR</td>
                <?php endif; ?>
                <td><?php echo $payment['time'];?></td>
                <td><?php echo (1==0)? 'Pending':'Approved'; ?></td>
              </tr>
            <?php endforeach; endif;?>

          </tbody>
        </table>
      </div>
    </div>
    <!-- END Datatables Content -->
  </div>
  <script src="<?php echo ASSETS;?>proui/js/pages/tablesDatatables.js"></script>
  <script>$(function(){ TablesDatatables.init(); });</script>
