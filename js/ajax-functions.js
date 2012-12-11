function htmlEncode(value){
  return $('<div/>').text(value).html();
}

function htmlDecode(value){
  return $('<div/>').html(value).text();
}
$(document).ready(function(){
	$(".vendor-link").click(function(){
//		alert("clicked!");
		var itemid = $(this).attr("vendorid");
		var source = $(this).attr("source");
		var ip = $(this).attr("ip");
		$.post("ajax-functions.php?action="+source+"_url&itemid="+itemid+"&ip="+htmlEncode(ip), function(data)
				{
			$(this).html(data);
					alert("return "+data);
				});
	});
});