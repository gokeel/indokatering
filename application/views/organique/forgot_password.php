<div class="woocommerce  push-down-30">
  <div class="container">
    <div class="row">
      <div class="col-xs-12  push-down-30">
        <form method="post" action="<?php echo base_url('users/request_reset_password');?>" class="form-horizontal" id="form-profile">
          <div class="row">
            <h3><span class="light">Reset</span> Password</h3>
              <div class="col-xs-12  col-sm-6">
                <p>
                  <label>
                    Email
                    <abbr class="required">
                      *
                    </abbr>
                  </label>
                  <input class="input-text" type="email" name="email" required>
                </p>
              </div> <!-- ./col-xs-12 -->
              <div class="col-xs-12">
                <div class="payment">
                  <div class="overlay pull-right" style="display:none" id="loading">
                    <i class="fa fa-refresh fa-spin fa-2x"></i>
                  </div>
                  <button type="submit" class="btn  btn-warning">Reset Password</button>
                  <p><?php echo $message; ?></p>
                </div> <!-- ./payment -->
              </div> <!-- ./col-xs-12 -->
          </div> <!-- ./row -->
          <hr class="divider">
        </form>
      </div>
    </div>
  </div>
</div>