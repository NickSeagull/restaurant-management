var table_names = [];
var table_ids = [];

function get_table_names(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_tables"},
	success: function(data){
	    table_names = data.split(";");
	    table_names.pop();
	}
    });
}

function get_table_ids(){
    $.ajax({
	type: "GET",
	url: "orders-api.php",
	data: {method: "get_table_ids"},
	success: function(data){
	    table_ids = data.split(";");
	    table_ids.pop();
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
	$(table_id).append(build_table_order_menu(table, id));
    } else {
	$(table_id).html("");
    }
}

function build_table_order_menu(table, id){
    return "HELLO, ITS ME " + table + " WITH ID " + id;
}

$('document').ready(function(){
    get_table_names();
    get_table_ids();
    setTimeout(process_tables, 1000);
});
