(function($){
	var $field_group_datas, $field_group_tabs;

	$(document).ready(function(){
		$field_group_datas = $('.db-field-group');
		$field_group_tabs = $('.db-tab');
		refreshTabStatus();

		window.onhashchange = refreshTabStatus;
	});

	refreshTabStatus = function() {
		$field_group_datas.hide();
		$field_group_tabs.removeClass('current-db-tab');

		// Strip leading hash.
		var currentHash = document.location.hash;
		var currentHashName = currentHash.substr( 1 );

		if ( ! currentHashName.length ) {
			currentHashName = 'overview';
		}

		$('#db-tab-' + currentHashName).addClass('current-db-tab');
		$('#db-field-group-' + currentHashName).show();
	}
}(jQuery))
