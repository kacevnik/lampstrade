(function ( $ ) {
    $( document ).ready(function(){
        $(window).scroll(function() {
            var windowTop,
                link = $('.elements__item');

            windowTop = window.pageYOffset;

            link.each(function( i,elem ) {
                var target_top,
                    link_top,
                    current_button = $( '.elements__item_active'  );

                link_top = $(this).offset().top;
                target = $(this).attr( 'href' );
                target_top = $( target ).offset().top;

                if ( link_top > target_top) {
                    current_button.removeClass( 'elements__item_active' );
                    $(this).addClass( 'elements__item_active' );
                }

                if ( link_top > 1557 && link_top < 2783 || link_top > 4645 && link_top < 5885 || link_top > 6402) {
                    $(this).addClass( 'elements__item_black' );

                } else {
                    $(this).removeClass( 'elements__item_black' );
                }
            });
        });
    })
}( jQuery, jQuery( window ) ));
