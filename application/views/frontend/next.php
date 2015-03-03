<form role="form" method="POST" action="<?=base_url('paypal/index')?>">
  <div class="col-lg-6">
    <div class="form-group has-success">
      <label class="control-label" for="inputSuccess1">Addrees</label>
      <div class="input-group">
        <input type="text" class="form-control" id="inputSuccess1" name="address" placeholder="Enter Address" value="<?php echo set_value('last_name'); ?>" >
        <span class="input-group-addon" id="inputSuccess1"><span class="glyphicon glyphicon-asterisk"></span></span>
      </div>
      <div class="error"><?php echo form_error('address'); ?></div>
      <div class="form-group">
        <label  class="control-label" for="inputSuccess1">Type of delivery</label>
        <select class="delivery_type_select form-control" name="delivery_type">
          <option value="2">By Post</option>
          <option value="4">By Plane</option>
          <option value="5">By Sea</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
  <table class="table table-condensed">
  <thead>
      <th class="success">Name</th>
      <th class="info">Description</th>
      <th class="danger">Price</th>
      <th class="warning">Count</th>
      <th class="success">Total Price</th>
  </thead>
  <tbody>
    
    <?php foreach ($products as $value): ?>
      <tr>
      <td class="success "><p class="text-info"><?=$value['name']?></p></td>
      <td class="info "><p class="text-danger"><?=$value['desc']?></p></td>
      <td class="danger " style="text-align: center;"><p class="text-primary"><?=$value['amount']/$value['quantity']?> $</p></td>
      <td class="warning " style="text-align: center;"><p class="text-success"><?=$value['quantity']?></p></td>
      <td class="success amount" style="text-align: center;"><p class="text-info"><?=$value['amount']?> $</p></td>
      </tr>
    <?php endforeach ?>
    
  </tbody><p class="text-danger">
  </table>
   <div class="row"></div>
    <div class="col-md-6">
        <label>Delivery Amount</label>
        <p class="delivery_amount">2 $</p>
    </div>
    <div class="col-md-6">
      <label>Total Amount</label>
      <p class="total"><?=$total?> $</p>
    </div>
    <button type="submit" class="btn-info submit_button" ><img class="paypal" id="paypal_img"  src="<?=base_url("assets/images/paypal.gif")?>"></button>
  </div>
  </div>
</form>