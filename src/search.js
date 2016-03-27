function changed_query(){
    var query = $(".search-box").val();
    $.ajax({
	type: "GET",
	url: "catalog-api.php",
	data: {query: query},
	success: function(data) {
	    $(".results").html(process(data));
	}
    })
}

function process(data){
    result = "<table class=\"menu\">";
    result += "<tr class=\"accent-text\"><td>Product</td><td>Price</td></tr>";
    pairs = data.split(";");
    for(var i = 0; i < pairs.length - 1; i++) {
	pair = pairs[i].split(":");
    	name = pair[0];
    	price = pair[1];
    	result += "<tr><td>" + name + "</td><td>" + price + "€</td></tr>";
    }
    result += "</table>";
    return result;
}

$(document).ready(function(){
    $(".search-box")
	.focus()
	.on('input', changed_query);
    changed_query();
}
);
