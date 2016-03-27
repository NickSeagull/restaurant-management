function changed_query(){
    var query = $(".search-box").val();
    $(".results").html("Searching for:" + query);
}

$(document).ready(function(){
    $(".search-box").on('input', changed_query);
}
);
