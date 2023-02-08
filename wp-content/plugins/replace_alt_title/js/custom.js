get_data_ajax = function (e) {

  var ajaxurl = localajax.ajaxurl;
  var action = jQuery(e.target).data('action');
  call_action = 1;
  if (action == 'update') {
    call_action = 2;
  }

  // alert(call_action);
  // var box_data = [];
  var box_data = new Array();
  jQuery('.data_class').find('.box_data_input').each(function (i) {
    var cTitle = jQuery(this).find('.cTitle').val();
    var cAlt = jQuery(this).find('.cAlt').val();
    var attid = jQuery(this).attr('data-attid');

    box_data.push({
      cTitle: cTitle,
      cAlt: cAlt,
      attid: attid,
    });

  });
  // var cus_title = [];
  // var main_arr = [];
  // jQuery("input[name='cTitle']:text").each(function () {
  //   main_arr.push({
  //     title: this.value
  //   });    
  // });  
  // jQuery("input[name='cAlt']:text").each(function () {
  //   main_arr.push({
  //     alt: this.value
  //   }); 
  // });

  jQuery.ajax({
    url: localajax.ajaxurl, // this will point to admin-ajax.php
    dataType: 'html',
    type: 'POST',
    data: {
      'action': 'data_fetch',
      'btn_action': call_action,
      'box_data': box_data,

    },
    success: function (response) {
      console.log(response);
      jQuery(".data_class").html(response);
    }
  });

}


