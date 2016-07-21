jQuery(document).ready(function($) {
	//Animation and show the msg

	//<ul class="custom-type-list">
	//without var, it's lookalike a global var =====>sortList = $( 'ul.custom-type-list' );
	var sortList = $( 'ul.custom-type-list' );
	 //$( "ul.custom-type-list" ).sortable();
	var animation = $('.loading-animation');
	var pageTitle = $('div h2'); //  target oon title balaye safhas

	sortList.sortable({
		/*
	//"/cal/wp-admin/admin-ajax.php" = $1
		update: function( event, ui ) {
			animation.show();

			$.ajax({
				url: ajaxurl,
				//	url: 'ajaxurl',     ====> it show an error
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'save_sort',//used in wp_mortgage_listing
					order: sortList.sortable( 'toArray' ),
					security: WP_MORTGAGE_LISTING.security
				},
				success: function( response ) {
				//console.log("success");
				$('div#msg').remove();
				animation.hide();
				//console.log(sortList.sortable( 'toArray' ));
					if( true === response.success ) {
				pageTitle.after( '<div id="msg" class="updated"><p>'+ WP_MORTGAGE_LISTING.success +'</p></div>');
			}
			else
			{
				pageTitle.after( '<div id="msg" class="error"><p>' + WP_MORTGAGE_LISTING.fail + '</p></div>');

			}
			},
			error: function( error ) {
				//console.log("error");
				$('div#msg').remove();
				animation.hide();
				pageTitle.after( '<div id="msg" class="error"><p>' + WP_MORTGAGE_LISTING.fail + '</p></div>');

			}
		 });
		}
	});

});
*/

update: function( event, ui ) {
			animation.show();

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'save_sort',
					order: sortList.sortable( 'toArray' ),
					security: WP_MORTGAGE_LISTING.security
				},
				success: function( response ) {
					$( 'div#message' ).remove();
					animation.hide();
					if( true === response.success ) {
						pageTitle.after( '<div id="message" class="updated"><p>' + WP_MORTGAGE_LISTING.success + '</p></div>' );
					} else {
						pageTitle.after( '<div id="message" class="error"><p>' + WP_MORTGAGE_LISTING.failure + '</p></div>' );
					}
					
					
				},
				error: function( error ) {
					$( 'div#message' ).remove();
					animation.hide();
					pageTitle.after( '<div id="message" class="error"><p>' + WP_MORTGAGE_LISTING.failure + '</p></div>' );
				}
			});
		}
	});

});


		