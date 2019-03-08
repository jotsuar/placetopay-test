function App()
{
	this.init();
}

App.prototype.init = function(first_argument) {
	$("#UserProducto").change(function(event) {
		event.preventDefault();
		$("#UserProductoValor").val($(this).val())
	});
};

var app = new App();