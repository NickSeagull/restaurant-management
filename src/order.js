var table_names = [];
var table_ids = [];
var orders = [];
var items = [];
var waiters = [];
var catalog = [];
var logged_user = "";

$('document').ready(function(){
    load_orders();
    load_items();
    load_catalog();
    load_waiters();
    load_logged_user();
    setTimeout(greet_user(), 1000);
    get_table_names();
    get_table_ids();
    setTimeout(process_tables, 1000);
});

function load_orders(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_orders"},
	success: function(data){
	    orders = JSON.parse(data);
	}
    });
}

function load_items(){
 $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_order_items"},
	success: function(data){
	    items = JSON.parse(data);
	}
    });
}

function load_catalog(){
  $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_catalog"},
	success: function(data){
	    catalog = JSON.parse(data);
	}
  });
}

function load_waiters(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_waiters"},
	success: function(data){
	    waiters = JSON.parse(data);
	}
    });
}

function load_logged_user(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_logged_id"},
	success: function(data){
	    //logged_user = waiters[parseInt(data)]["nombre"];
	}
    });
}

function greet_user(){
    $('.header').append("<h1>Welcome " + logged_user + "!</h1>");
}

function get_table_names(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_tables"},
	success: function(data){
	    table_names = JSON.parse(data);
	}
    });
}

function get_table_ids(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_table_ids"},
	success: function(data){
	    table_ids = JSON.parse(data);
	}
    });
}

function zip_table_names_and_ids(){
    return table_names.map(function(e,i){
	return [e, table_ids[i]];
    });
}


function process_tables(){
    zip_table_names_and_ids().forEach(function(name_id_pair){
	$('.tables').append(build_table_link(name_id_pair[0],name_id_pair[1]));
    });
}

function build_table_link(table, table_id){
    return $('<li></li>')
	.append($('<a></a>', {
	    href: '#',
	    class: 'accent-text',
	    onclick: 'show_order_menu_for("'+table+'", '+table_id+');',
	    text: table
	}), $('<div></div>', {
	    class: 'container',
	    id: 'order-table-'+table_id
	}));
}

function show_order_menu_for(table, id){
    var table_id = "#order-table-" + id;
    if ($(table_id).is(':empty')) {
	$(table_id).html(build_table_order_menu(table, id));
    } else {
	$(table_id).html("");
    }
}

function build_table_order_menu(table, table_id){
    if (!order_exists_for(table_id)){
	return $('<a></a>', {
	    href: '#',
	    onclick: 'new_order('+table_id+');',
	    text: "New order"
	});
    } else {
	return process_order(get_order_for(table_id));
    }
}

function order_exists_for(id){
    return orders.filter(function(e){
	return e["id"] == id;
    }).length != 0;
}

function new_order(table_id){
    orders[table_id] = {"ayy": "lmao"};
}

function process_order(order){
    var table = order["mesa"];
    var waiter = waiters[parseInt(order["camareroapertura"])-1]["nombre"];
    var date = new Date(parseInt(order["horaapertura"]));
    var time = date.getHours() + ":" + date.getMinutes();
    return "<h4>Waiter:</h4>" +
	waiter +
	"<h4>Time:</h4>" +
	time+
	"<h4>Orders:</h4>"+
	add_item_button(order)+
	load_local_items(order);
}

function add_item_button(order){
    return $('<a></a>', {
	href: '#',
	class: 'accent-text',
	onclick: 'add_item_to_order('+order["id"]+');',
	text: "Add item"
    }).prop('outerHTML');
}

function add_item_to_order(order){
    var item = "";
    do{
	item = prompt('Write an aproximation of the items name');
    }while(!item ||
	   !confirm(get_approximation(item)["nombre"] + " will be added, is this ok?"));
    commit_item_to_order(get_approximation(item), order);
}

function get_approximation(name){
    return catalog.filter(function(e){
	return e["nombre"].toUpperCase().includes(name.toUpperCase());
    })[0];
}

function commit_item_to_order(item, order){
    $.ajax({
	type: "POST",
	url: "orders-api.php",
	data: {method: "commit_item", args: JSON.stringify([item["id"], order])},
	success: function(data){
	    console.log(data);
	}
    });
    location.reload();
}

function load_local_items(order){
    var local_items = items.filter(function(e){return e["comanda"] == order["id"];});
    var items_list = "<ul>";
    local_items.forEach(function(e){
	items_list += "<li>" +
	    get_name_from_catalog(e["articulo"])["nombre"] +
	    "</li>";
    });
    return items_list + "</ul>";
}

function get_name_from_catalog(id){
    return catalog.filter(function(e){
	return e["id"] == id;
    })[0];
}

function get_order_for(id){
    return orders.filter(function(e){
	return e["id"] == id;
    })[0];
}
