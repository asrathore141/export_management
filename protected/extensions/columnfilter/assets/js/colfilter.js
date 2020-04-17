$('document').ready( function(){

	$('.col_filter label input').click( function(){
		var data_class  = $(this).attr('data-class');
		var data_column = $(this).attr('data-column');
		$('.'+data_class).toggle();
		names = Array();
		$('.col_filter input:checkbox:not(:checked)').each(function( i, e ) {
			names.push( $(e).attr("data-class") );
		});
	console.log( names.join(',') );
		setCookie( 'hiddenCols', names.join(',') );
	} );


	
});
