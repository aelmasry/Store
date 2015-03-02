<script src="<?=base_url('assets/js/jquery-2.1.1.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery-ui.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript">
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
$('.deleteConfirmCategory').on('click', function (e) {
    var id = $(this).attr('id');
    var url = <?php echo json_encode(base_url('admin/categories/delete/')); ?>;
    url += '/'+id;
    $( ".deleteItem" ).remove();
    $( ".modal-footer" ).append( '<a type="button" class="btn btn-primary deleteItem" href="'+url+'">Yes</a>' );
    $('#confirm')
        .modal({ backdrop: 'static', keyboard: false })
        .one('click', '[data-value]', function (e) {
           alert("1111");
        });
});
$('.deleteConfirmArea').on('click', function (e) {
    var id = $(this).attr('id');
    var url = <?php echo json_encode(base_url('admin/areas/delete/')); ?>;
    url += '/'+id;
    $( ".deleteItem" ).remove();
    $( ".modal-footer" ).append( '<a type="button" class="btn btn-primary deleteItem" href="'+url+'">Yes</a>' );
    $('#confirm')
        .modal({ backdrop: 'static', keyboard: false })
        .one('click', '[data-value]', function (e) {
           alert("1111");
        });
});
  $(document).ready(function(){ 
  $.ajax({
      type: "POST",
      url: "http://shop.loc/frontend/cart/get_cart_count",
      success: function(data){
        $('#nav-cart-num').html(data);
      }
  }); 
    $("#cart_button").click(function(){
    var count = parseInt( $('#nav-cart-num').html()) +1;   
      $.ajax({
        type: "POST",
        url: "http://shop.loc/frontend/cart/add_product", 
        data: { product_id: $("#cart_id_value").val()}, 
        success:function(data){

          $('#cart_icon').effect("shake");
          $('#nav-cart-num').html(count);
        }
      });
    });
  });
$('.delivery_type_select').on('change', function() {
  var total = 0;
  $(".amount").each(function() {
     total += parseFloat($(this).text());
    });
  total += parseFloat(this.value);
  $('.total').html(total+' $');
  $('.delivery_amount').html(this.value+' $');
 
});
$( ".count" ).change(function() {
  var html =   $('#nav-cart-num').html();
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
          $.ajax({
            type: "POST",
            url: "http://shop.loc/frontend/cart/get_cart_count",
            success: function(data){
              $('#nav-cart-num').html(data);
            }
          }); 
        }
      });
  }else{
    $('#next_id').removeAttr("href");
    alert("Not Number");
    //$('#nav-cart-num').html(html);

  }

});

$("#loged_out").click(function(){
  window.location.href = "<?php echo base_url('auth/log_out'); ?>";
});


    $(document).ready(function() {
        initFacebookConnect();
    });

    var fbTimer, fbChildWindow;
    function fbPolling() {
        if(fbChildWindow && fbChildWindow.closed) {
            // The popup has been closed, stop the timer and reload window.
            clearInterval(fbTimer);
            window.location.href = window.location.href;
        }
    }
    function initFacebookConnect() {
        $('a.facebook_connect').click(function(event) {
            event.preventDefault();

            var winTop = (screen.height / 2) - (520 / 2);
            var winLeft = (screen.width / 2) - (350 / 2);
            var url = "https://www.facebook.com/login.php?skip_api_login=1&api_key=1458169067798559&signed_next=1&next=https%3A%2F%2Fwww.facebook.com%2Fv2.1%2Fdialog%2Foauth%3Fredirect_uri%3Dhttp%253A%252F%252Fshop.loc%252Fauth%252Ffb_login%26display%3Dpopup%26state%3D5067e405c81a414b556b5f42d08a3e4e%26client_id%3D1458169067798559%26ret%3Dlogin%26sdk%3Dphp-sdk-3.2.3&cancel_uri=http%3A%2F%2Fshop.loc%2Fauth%2Ffb_login%3Ferror%3Daccess_denied%26error_code%3D200%26error_description%3DPermissions%2Berror%26error_reason%3Duser_denied%26state%3D5067e405c81a414b556b5f42d08a3e4e%23_%3D_&display=popup";
            fbChildWindow = window.open(url, 'Facebook', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + 520 + ',height=' + 350);
            fbTimer = setInterval('fbPolling()', 1000);
        });
         $('a.linkedin_connect').click(function(event) {
          var url;
          $.ajax({
             type: "POST",
             async: false,
              url: "http://shop.loc/auth/get_linkedin_url", 
              success: function(data){
                url = data;
              }
           });
           event.preventDefault();

            var winTop = (screen.height / 2) - (520 / 2);
            var winLeft = (screen.width / 2) - (350 / 2);
           // var url = "https://api.twitter.com/oauth/authorize?oauth_token=2YzoUrPP1mSr0yHlRWEGq7cvzlSZfEHQ";
            fbChildWindow = window.open(url, 'Linkedin', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + 520 + ',height=' + 350);
            fbTimer = setInterval('fbPolling()', 1000);
        });
        $('a.twitter_connect').click(function(event) {
          var url;
           $.ajax({
             type: "POST",
             async: false,
              url: "http://shop.loc/auth/get_twitter_url", 
              success: function(data){
                url = data;
              }
           });
            event.preventDefault();

            var winTop = (screen.height / 2) - (520 / 2);
            var winLeft = (screen.width / 2) - (350 / 2);
           // var url = "https://api.twitter.com/oauth/authorize?oauth_token=2YzoUrPP1mSr0yHlRWEGq7cvzlSZfEHQ";
            fbChildWindow = window.open(url, 'Twitter', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + 520 + ',height=' + 350);
            fbTimer = setInterval('fbPolling()', 1000);
        });


    }
/*var geocoder;
var map;
var marker;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  });
  
}

function placeMarker(location) {
  if(marker != null){
            marker.setMap(null);
  }
   marker = new google.maps.Marker({
    position: location,
    draggable: true,
    map: map,
  });
  google.maps.event.addListener(marker,'click', function(event){
    console.log(marker);
  });
  var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });

  infowindow.open(map,marker);
}
function codeAddress() {
  if(marker != null){
            marker.setMap(null);
  }

  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
       marker = new google.maps.Marker({
          map: map,
          draggable: true,
          position: results[0].geometry.location
      });
       google.maps.event.addListener(marker,'click', function(event){
        console.log(marker);
      });
      console.log(results[0].geometry);
       var infowindow = new google.maps.InfoWindow({
       content: 'Latitude: ' + results[0].geometry.location.k + '<br>Longitude: ' + results[0].geometry.location.D
  });

  infowindow.open(map,marker);
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });

}

google.maps.event.addDomListener(window, 'load', initialize);
*/
/**/
</script>