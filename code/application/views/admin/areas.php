<div class="col-md-9">
  <div class="pull-right">
    <a class="btn btn-primary" href="<?=base_url('admin/areas/add_edit')?>">Add Area</a>
  </div>
  <table class="table table-bordered table-responsive product_table">
    <thead>
      <th>ID</th>
      <th>Name</th>
    </thead>
    <tbody>
      <?php foreach($records as $record): ?>
        <tr>
          <td><?=$record->id?></td>
          <td><?=$record->name?></td>
          <td>
            <div class="btn-group">
              <a class="btn" href="<?=base_url('admin/areas/add_edit/'.$record->id)?>">Edit</a>
              <a class="btn deleteConfirmArea" id="<?=$record->id?>">Delete</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
 <?php echo $this->pagination->create_links(); ?>
</div>
</div>
<div id="confirm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure that you want to permanently delete the selected item?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>