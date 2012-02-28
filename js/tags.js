$(function(){
	$.getJSON("http://localhost/carbin/resources/?alltags", function(data){
		$.each(data, function(index, value){
			console.debug(value.name);
		});
	});
});