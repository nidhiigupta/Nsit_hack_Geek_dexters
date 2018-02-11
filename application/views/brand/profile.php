<script src="<?php echo ASSETS.'sweetalert/dist/sweetalert.min.js';?>"></script>
<?php
if($this->input->get('status') == 'success') {
  ?>
  <script type='text/javascript'>
  swal({
    title: "Success!",
    text: "The payment was successful.",
    type: "success",
    confirmButtonText: "Ok"
  },
  function(y){
    $.redirect(SITEURL+'brand/profile');
  });
  </script>
  <?php
}
else if($this->input->get('status') == 'failed_webassets') {
  ?>
  <script type='text/javascript'>
  swal({
    title: "Failed!",
    text: "If the money has been deducted and not added to the wallet, please contact us.",
    type: "error",
    confirmButtonText: "Ok"
  },
  function(y){
    $.redirect(SITEURL+'brand/profile');
  });
  </script>
  <?php
}
else if($this->input->get('status') == 'failed') {
  ?>
  <script type='text/javascript'>
  swal({
    title: "Failed!",
    text: "The payment was not successful.",
    type: "error",
    confirmButtonText: "Ok"
  },
  function(y){
    $.redirect(SITEURL+'brand/profile');
  });
  </script>
  <?php
}
else if($this->input->post('msg') != '') {
  ?>
  <script type='text/javascript'>
  swal({
    title: "<?php echo $this->input->post('title') ?>",
    text: "<?php echo $this->input->post('msg') ?>",
    type: "<?php echo $this->input->post('type') ?>",
    confirmButtonText: "Ok"
  },
  function(y){
    $.redirect(SITEURL+'brand/profile');
  });
  </script>
  <?php
}
?>
<div id="page-content">
  <!-- Customer Content -->
  <div class="row">
    <div class="col-lg-4">
      <!-- Customer Info Block -->
      <div class="block">
        <!-- Customer Info Title -->
        <div class="block-title">
          <h2><i class="fa fa-file-o"></i> <strong>Brand</strong> Info</h2>
        </div>
        <!-- END Customer Info Title -->

        <!-- Customer Info -->
        <div class="block-section text-center">
          <a href="javascript:void(0)">
            <img src="<?php echo $this->custom_functions->check_img($profile->image)?>" alt="avatar" style="width: 300px">
          </a>
          <h3>
            <strong><?php echo $profile->name;?></strong><br><small></small>
          </h3>
        </div>
        <table class="table table-borderless table-striped table-vcenter">
          <tbody>
            <tr>
              <td class="text-right" style="width: 50%;"><strong>Member since</strong></td>
              <td><?php echo date("d-m-Y", strtotime($profile->created)) ?></td>
            </tr>
            <tr>
              <td class="text-right"><strong>Status</strong></td>
              <td><span class="label label-success"><i class="fa fa-check"></i> Active</span></td>
            </tr>
          </tbody>
        </table>
        <!-- END Customer Info -->
      </div>
      <!-- END Customer Info Block -->

      <!-- END Quick Stats Block -->
    </div>
    <div class="col-lg-8">
      <div class="block">
        <!-- Forum Tabs Title -->
        <div class="block-title">
          <ul class="nav nav-tabs view_camp_category" data-toggle="tabs">
            <li class="active"><a href="#main-profile-data">Profile</a></li>
            <li class=""><a href="#bank-profile-data">Bank Details</a></li>
          </ul>
        </div>

        <div class="tab-content">
          <div class="tab-pane active" id="main-profile-data">
            <?php echo form_open_multipart(SITEURL.'brand/update_profile','id="update-profile-form"');?>
            <div class="input-group">
              <span class="input-group-addon">Image</span>
              <input type="file" class="form-control" name="userfile" id="userfile">
            </div>
            <div class="input-group">
              <span class="input-group-addon">Name</span>
              <input type="text" class="form-control" placeholder="Your name" value="<?php echo $profile->name?>" name="profile_name">
            </div>
            <div class="input-group">
              <span class="input-group-addon">Email</span>
              <input type="email" min="0" class="form-control" placeholder="Your email" disabled="disabled" value="<?php echo $profile->email?>" name="profile_email">
            </div>
            <div class="input-group">
              <span class="input-group-addon">Mobile</span>
              <input type="number" min="0" class="form-control" placeholder="Your contact no" value="<?php echo $profile->phone?>" name="profile_contact">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon1">Website</span>
              <input type="url" class="form-control" name="profile_website" value="<?php echo $profile->website?>">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
            <?php echo form_close();?>
          </div>

          <div class="tab-pane" id="bank-profile-data">
            <?php if($bank){?>
              <h2 class="text-center">Your Bank's Details</h2>
              <p>Account Holder's Name: <?php echo $bank->account_holder_name?></p>
              <p>Bank Name: <?php echo $bank->bank_name?></p>
              <p>Account No: <?php echo $bank->account_number?></p>
              <p>IFSC Code: <?php echo $bank->ifsc_code?></p>
              <p>Mobile number: <?php echo $bank->mobile_number?></p>

            <?php }else{ ?>
              <h2 class="text-center">Enter your bank details</h2>
              <br/>
              <?php echo form_open(SITEURL.'brand/add_bank_account','id="bank-details-form"');?>
              <div class="form-group">
                <label for="email">Account Holder's Name:</label>
                <input type="text" class="form-control" name="holder-name" placeholder="Account Holder's Name">
              </div>
              <div class="form-group">
                <label for="pwd">Bank Name:</label>
                <input type="text" class="form-control" name="bank-name" placeholder="Bank Name">
              </div>
              <div class="form-group">
                <label for="pwd">Account Number:</label>
                <input type="number" class="form-control" name="account-number" placeholder="Account Number">
              </div>
              <div class="form-group">
                <label for="pwd">IFSC Code:</label>
                <input type="text" class="form-control" name="ifsc-code" placeholder="IFSC Code">
              </div>
              <div class="form-group">
                <label for="pwd">Mobile Number:</label>
                <input type="text" class="form-control" maxlength="10" minlength="10" name="mobile-number" placeholder="Mobile Number">
              </div>
              <button type="submit" class="btn btn-default">Save</button>
              <?php echo form_close();?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <a href="javascript:void(0)" class="widget widget-hover-effect2">
        <div class="widget-extra themed-background-dark">
          <h4 class="widget-content-light"><strong>Wallet</strong></h4>
        </div>
        <div class="widget-extra-full">
          <span class="h2 themed-color-dark animation-expandOpen"><?php echo $wallet_amount ?> INR</span>
          <hr>
          <form class="" action="<?php echo SITEURL.'payu/' ?>create_payment_with_payu" method="post">
            <input id="amount" class="form-control" type="text" name="amount" value="1000.0" required>
            <button class="btn btn-success" type="submit" name="button">Add</button>
            <button id="withdrawINR" class="btn btn-success" type="button" name="button">Withdraw</button>
          </form>

        </div>
      </a>
    </div>

  </div>
  <!-- END Customer Content -->
</div>
<!-- END Page Content -->
<script type="text/javascript">
$(function() {

  $('#withdrawINR').on('click', function () {
    var currentBalance = <?php echo $wallet_amount ?>;
    var amount = $('#amount').val();
    var amountFloat = parseFloat(amount);

    if(amountFloat > currentBalance) {
      swal('Error', 'Not enough Balance!', 'error');
    }
    else if(amountFloat == 0) {
      swal('Error', 'Zero input', 'error');
    }
    else {
      swal({
        title: "Are you sure?",
        text: "Are you sure? You cannot undo this action",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        if(isConfirm) {
          $.ajax({
            url: SITEURL+'brand/withdraw_request',
            type: "POST",
            data: {'amount': amountFloat},
            success: function(data) {
              if(data.error == true) {
                swal("Error!", data.msg, 'error');
              }
              else {
                swal("Success!", data.msg, 'success');
              }
            }
          });
        }
      });
    }
  });

});
</script>
