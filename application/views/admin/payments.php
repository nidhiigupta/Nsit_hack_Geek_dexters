<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Payment <small>section</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              List of all payments
            </p>
            <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row"><div class="col-sm-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
              <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 241px;">Payment from</th>
                  <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 373px;">Payment to</th>
                  <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 186px;">Transaction Id</th>
                  <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 65px;">Purpos</th>
                  <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Purpose: activate to sort column ascending" style="width: 65px;">Amount</th>
                  <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 146px;">Currency</th>
                  <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 147px;">Start date</th>
                  <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 147px;">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if(isset($payments)|| 1):
                  $n=1;
                  foreach($payments as $payment):
              ?>
              <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo$payment->brand_name;?></td>
                  <td><?php echo$payment->inf_name;?></td>
                  <td><?php echo$payment->payment_transaction_id;?></td>
                  <td><?php echo$payment->payment_for;?></td>
                  <td><?php echo$payment->payment_amount;?></td>
                  <td><?php echo$payment->payment_currency;?></td>
                  <td><?php echo$payment->payment_date;?></td>
                  <td>
                  <?php if($payment->payment_status==0){ ?>
                    <button class="fa-ban btn-danger fa btn"  onclick="suspend(<?php echo$payment->payment_id;?>,this)"></button>
                  <?php } else{ ?>
                    <button class="fa-check btn-success fa btn" disabled="disabled"></button>
                  <?php }?>
                  </td>
              </tr>
              <?php endforeach; endif;?>
              </tbody>
            </table></div></div>
            <!--  -->
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script type="text/javascript">
  function suspend(id,obj){
    swal({
        title: "Are you sure?",
        text: "You are goning to Approve the payment",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Approve it!",
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.post("<?php echo SITEURL.'admin/update_payment';?>",{id:id},function(d,s){
            if(d.status == true){
                swal(d.title, d.msg, "success");
                $(obj).removeClass('fa-ban btn-danger');
                $(obj).addClass('fa-check btn-success');
            }
            else{
              swal(d.title, d.msg, "error");
            }
        });
      }
      else{
        swal('Cool!','Canceled!','success');
      }
    });
  }
  /*function delete_influencer(id,obj){
     swal({
        title: "Are you sure?",
        text: "You can not recover influencer later",
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Delete it!",
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.post("<?php #echo SITEURL.'admin/delete_influencr';?>",{id:id,},function(d){
            if(d.status == true){
              $('#' + $(obj).attr('id')).parent().parent().remove();
              swal("Deleted!", d.msg, 'success');
            }else{
              swal("Failed!", d.msg, 'error');
            }

          });

        }else{
          swal("Cancelled",'Data is safe', "error");
        }
      });

  }*/
</script>
