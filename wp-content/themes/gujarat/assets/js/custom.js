jQuery(document).ready(function () {
  var page_height = jQuery(window).height() - jQuery("footer").outerHeight();
  jQuery(".main-content-wrapper").css("min-height", page_height + "px");

  //MatchHeight
  if (jQuery(".eq-height").length > 0) {
    jQuery(".eq-height").matchHeight();
  }

  //Toggler-Menu-Button
  jQuery(".navbar-toggler").on("click", function (e) {
    e.stopPropagation();
    jQuery(this).toggleClass("open");
    jQuery(".navbar").toggleClass("mobile-menu-open");
    jQuery(".navbar-nav-items").slideToggle();
  });

  let currentPage = 1;
  jQuery('#load-more').on('click', function() {
    alert(my_ajax_object.ajax_url);
    currentPage++; // Do currentPage + 1, because we want to load the next page
    jQuery.ajax({
      type: 'POST',
      url: my_ajax_object.ajax_url,
      dataType: 'html',
      data: {
        action: 'weichie_load_more',
        paged: currentPage,
      },
      success: function (res) {
        jQuery('.publication-list').append(res);
      }
    });
  });

});

jQuery(window).resize(function () {
  var page_height = jQuery(window).height() - jQuery("footer").outerHeight();
  jQuery(".main-content-wrapper").css("min-height", page_height + "px");
});

jQuery(".icon").click(function () {
  jQuery(this).parent(".notation-box").toggleClass("active");
});

