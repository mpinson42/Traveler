var j = []

$("#btn_e1").click(function(){
	$("#E1").show()
	$("#E2").hide()
	$("#E3").hide()
})

$("#btn_e2").click(function(){
	$("#E1").hide()
	$("#E2").show()
	$("#E3").hide()
})

$("#btn_e3").click(function(){
	$("#E1").hide()
	$("#E2").hide()
	$("#E3").show()
})


function color_map(json) {

	var i = 0;
	console.log(json)
	
		$.each(json, function(i, obj) {
		 $.each(obj, function (j, line) {
		 	console.log(line.host)
		 	$("#" + line.host).css("background-color", "green")
		 });
		});
	
	
}
$("#btn_login").click(function() {
	console.log("42")
	$(".post").css("background-color", "#FFFFFF")
	$.ajax({
	    url : "./test.php?login=" + $("#in_login").val(), // La ressource ciblée
		type : 'GET',
		dataType : 'json',
		crossDomain: true,
		success: function(code_html, status){
			//j = $.parseJSON(code_html.responseText)

			color_map(code_html);
		},
		error: function(code) {
			//console.log($.parseJSON(code.responseText))
			//j = $.parseJSON(code.responseText)

			color_map(j);
		}
	})
})
