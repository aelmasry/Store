<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">
<div class="container" >
    <div class="row">
        <form role="form" method="POST" >
            <div class="col-lg-6">
                <div class="well well-sm"><strong>Registration</strong></div>
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="InputEmail">First Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="<?php echo set_value('first_name'); ?>" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                    <div class="error"><?php echo form_error('first_name'); ?></div>  
                </div>
                <div class="form-group">
                    <label for="InputEmail">Last Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="InputEmailFirst" name="last_name" placeholder="Enter Last Name" value="<?php echo set_value('last_name'); ?>" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                     <div class="error"><?php echo form_error('last_name'); ?></div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Enter Email</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="InputEmailFirst" name="email" placeholder="Enter Email" value="<?php echo set_value('email'); ?>" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                     <div class="error"><?php echo form_error('email'); ?></div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Enter Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="InputEmailSecond" name="password" placeholder="Enter Password" value="<?php echo set_value('password'); ?>" >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                     <div class="error"><?php echo form_error('first_name'); ?></div>
                </div>
                   <div class="form-group">
                    <label for="InputEmail">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="InputEmailSecond" name="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                     <div class="error"><?php echo form_error('confirm_password'); ?></div>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
    </div>
</div>