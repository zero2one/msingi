/**
 * Msingi Theme behaviours
 */
;(function($) {
  
  Drupal.behaviors.messageClose = {
    attach: function (context) {
      $('#messages .block-close a').click(function() {
        var toClose = $(this).parents('div.messages').get(0);
        $(toClose).fadeOut();
      });
    }
  };
  
})(jQuery);