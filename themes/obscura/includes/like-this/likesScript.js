/* This javascript goes with the likeThis plugin written by Rosemarie Pritchard.
http://lifeasrose.ca
*/



jQuery(document).ready(function($){ 


function reloadLikes(who) {
	var text = $("#" + who).text();
	var patt= /(\d)+/;
	
	var num = patt.exec(text);
	num[0]++;
	text = text.replace(patt,num[0]);
	if(num[0] == 1) {
		text = text.replace('people like','person likes');
	} else if(num[0] == 2) {
		text = text.replace('person likes','people like');
	} //elseif
	$("#" + who).text(text);
} //reloadLikes


$(".likeThis").click(function() {
	var classes = $(this).attr("class");
	classes = classes.split(" ");
	
	if(classes[1] == "done") {
		return false;
	}
	var classes = $(this).addClass("done");
	var id = $(this).attr("id");
	id = id.split("like-");
	$.ajax({
	  type: "POST",
	  url: "index.php",
	  data: "likepost=" + id[1],
	  success: reloadLikes("like-" + id[1])
	}); 
	
	
	return false;
});

});