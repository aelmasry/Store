    <div class="col-md-9">
      <div class="pull-right">
      </div>
      <table class="table table-bordered table-responsive product_table">
        <thead>
          <th>ID</th>
          <th>User</th>
          <th>Product</th>
          <th>Address</th>
          <th>Count</th>
          <th>Delivery Type</th>
          <th>Date Time</th>
        </thead>
        <tbody>
          <?php foreach($records as $record): ?>
            <tr>
              <td><?=$record->id?></td>
              <td><?=$record->user_data?></td>
              <td><?=$record->product_data?></td>
              <td><?=$record->address?></td>
              <td><?=$record->count?></td>
              <td><?=$record->type?></td>
              <td><?=$record->datetime?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
  </div>
</div>
