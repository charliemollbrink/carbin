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
			var recipeId = $('#recipeid').val();

			if(query !=="" && recipeId !=""){
				if(typeof(tags[query]) !== "undefined"){
					var tagId = tags[query];
					addToRecipeTags(recipeId, tagId);
				} else {
					$.post("http://localhost/carbin/resources/?alltags", {name: query}, function(data){
						var tagId = data[0].id;
						addToRecipeTags(recipeId, tagId);
					},"json");
				}
			} else {
				input.addClass('error');
			}
			input.focus(function(){
				if(input.hasClass('error')){
					input.removeClass('error');
				}
			});
			return false;
		});
	});
	function addToRecipeTags(recipeId, tagId){
		$.post("http://localhost/carbin/resources/?tags", {recipe_id: recipeId, tag_id: tagId}, function(data){
			window.location.reload();
		});
	}
});