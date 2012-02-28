$(function(){
	$.getJSON("http://localhost/carbin/resources/?alltags", function(data){
		
		var tags = {};
		var tagsArray = []; 
		$.each(data, function(index, value){
			tags[value.name] = value.id;
			tagsArray.push(value.name);
		});

		var input = $('#tags');
		input.autocomplete({
			source: tagsArray
		});
		var form = $('#addTags');
		form.submit(function(){
			var query = input.val();

			if(typeof(tags[query]) !== "undefined"){
				alert("exist");
			} else {
				$.post("http://localhost/carbin/resources/?alltags", {name: query}, function(data){
					var tagId = data[0].id;
				},"json");
			}
			return false;
		});

	});
});