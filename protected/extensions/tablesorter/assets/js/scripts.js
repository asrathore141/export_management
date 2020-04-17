$(document).ready(function() {
	var table = $("table.dataTable").DataTable( {
		"scrollY": "100%",
		"paging": false
	} );

	$('a.toggle-vis').on( 'click', function (e) {
		e.preventDefault();

		// Get the column API object
		var column = table.column( $(this).attr('data-column') );

		// Toggle the visibility
		column.visible( ! column.visible() );
	} );
} );

