$(function(){
	var searchForm = $('#searchForm');
	searchForm.submit(function(){
		var url = "resources/?/search";
		$.post(url, searchForm.serialize(), function(data){
			// console.debug('success');
			window.location = 'http://localhost/carbin/views/?recipe=3';
		},"json");
		return false;
	});
});