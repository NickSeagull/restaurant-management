function get_tables(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_tables"},
	success: function(data){
	    process_tables(data);
	}
    });
}

function process_tables(data){
    $(".tables").append("<ul>");
    data.split(";").forEach(function(table){
	$(".tables").append("<li>"+table+"</li>");
    });
    $(".tables").append("</ul>");
}

$('document').ready(function(){
    get_tables();
});
