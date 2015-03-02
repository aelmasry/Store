$('.deleteConfirm').on('click', function (e) {
  	var id = $(this).attr('id');
  	var url = <?php echo json_encode(base_url('admin/products/delete/')); ?>;
  	url += '/'+id;
  	$( ".deleteItem" ).remove();
  	$( ".modal-footer" ).append( '<a type="button" class="btn btn-primary deleteItem" href="'+url+'">Yes</a>' );
    $('#confirm')
        .modal({ backdrop: 'static', keyboard: false })
        .one('click', '[data-value]', function (e) {
           alert("1111");
        });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){   
    $("#cart_button").click(function(){       
      $.ajax({
        type: "POST",
        url: "http://shop.loc/frontend/cart/add_product", 
        data: { product_id: $("#cart_id_value").val()}, 
        success:  function(data){
          
        }
      });
    });
  });
$('.delivery_type_select').on('change', function() {
  var total = 0;
  $(".amount").each(function() {
     total += parseFloat($(this).text());
    });
  total *= this.value;
  $('.total').html(total+' $');
 
});
$( ".count" ).change(function() {
  var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
  var href = <?php echo json_encode(base_url("paypal/next/")); ?>;
  if(numberRegex.test(this.value)) {
    $.ajax({
      type: "POST",
      url: "http://shop.loc/paypal/count_change", 
      data: { 
        count: this.value,
        name: this.name}, 
        success: function(data){
          $('#next_id').attr( "href", href );
        }
      });
  }else{
    $('#next_id').removeAttr("href");
    alert("Not Number");

  }

});

$("#loged_out").click(function(){       
 window.location.href = "<?php echo site_url('auth/index'); ?>";
});
