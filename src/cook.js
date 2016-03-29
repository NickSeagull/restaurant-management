var waiting_items = [];
var cooking_items = [];
var catalog = [];

$('document').ready(function(){
    load_catalog();
    load_waiting_items();
    setTimeout(render_waiting_items, 1000);
    load_cooking_items();
    setTimeout(render_cooking_items, 1000);
});

function load_catalog(){
    $.ajax({
	type: "GET",
	url: "cooking-api.php",
	data: {method: "get_catalog"},
	success: function(data){
	    console.log(data);
	    catalog = JSON.parse(data);
	}
    });
}

function load_waiting_items(){
    $.ajax({
	type: "GET",
	url: "cooking-api.php",
	data: {method: "get_waiting"},
	success: function(data){
	    console.log(data);
	    waiting_items = JSON.parse(data);
	}
    });
}

function load_cooking_items(){
    $.ajax({
	type: "GET",
	url: "cooking-api.php",
	data: {method: "get_cooking"},
	success: function(data){
	    console.log(data);
	    cooking_items = JSON.parse(data);
	}
    });
}

function render_waiting_items(){
    $('.waiting').append("<h2>Pending to cook</h2>");
    waiting_items.forEach(function(e){
	$('.waiting').append(
	    $('<h4></h4>', {
		text: get_from_catalog(e["articulo"])["nombre"]
	    })
	    ,
	    $('<a></a>', {
		href: '#',
		text: 'Start cooking ',
		onclick: "start_cooking('"+JSON.stringify(e)+"');"
	    })
	);
    });
}

function render_cooking_items(){
    $('.cooking').append("<h2>Cooking</h2>");
    cooking_items.forEach(function(e){
	$('.cooking').append(
	    $('<h4></h4>', {
		text: get_from_catalog(e["articulo"])["nombre"]
	    })
	    ,
	    $('<a></a>', {
		href: '#',
		text: 'Finish cooking ',
		onclick: "finish_cooking('"+JSON.stringify(e)+"');"
	    })
	);
    });
}



function get_from_catalog(id){
    return catalog.filter(function(item){
	return item["id"] == id;
    })[0];
}

function start_cooking(waiting_item){
    waiting_item = JSON.parse(waiting_item);
    alert("ayy, imma cook "+get_from_catalog(waiting_item["articulo"])["nombre"]);
}

function finish_cooking(cooking_item){
    cooking_item = JSON.parse(cooking_item);
    alert("ayy, imma stop cooking "+get_from_catalog(cooking_item["articulo"])["nombre"]);
}
