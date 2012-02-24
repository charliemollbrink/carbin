$(function(){
	var searchForm = $('#searchForm');
	searchForm.submit(function(){
		var url = "../api/index.php?search";
		console.debug(searchForm.serialize());
		// $.post(url, searchForm.serialize(), function(data){

			// console.debug('success');
			// window.location = 'http://localhost/carbin/views/?recipe=3';
		// },"json");
		return false;
	});
});