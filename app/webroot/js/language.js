function Language(){
	this.init();
	this.utilidades;

}

Language.prototype.init = function(first_argument) {
	this.get_language();
	var app = new App();
	this.utilidades = app.jqueryUtitlty;
	this.action_val 	= action;
	this.id_actual  =  action == "edit" ? $("#info_target_id").val() : "0";
	this.id_target  = $("#tatget_info").val();
	this.validate_action();
};

Language.prototype.get_language = function() {
	var _this = this;

	$("#tatget_info").change(function(event) {
		event.preventDefault();
		if($(this).val() != ""){
			_this.call_request($(this).val());			
		}else{
			$("#language_info").html("");
			$("#language_info").attr('disabled','disabled')
		}

	});
};

Language.prototype.call_request = function(target_ids) {
	var _this = this;
	var action_val = _this.action_val;
	var id_actual_val = _this.id_actual;
	_this.utilidades.callAjaxRequest(root+"app/get_languages",{action:action_val,model:MODEL,target_id:target_ids,id_actual:id_actual_val},function(data){
		if (data.trim()=="") {
			 _this.utilidades.utilidades.viewAlert("La información principal no permite asociar más lenguages");
			$("#language_info").html("");
			$("#language_info").attr('disabled','disabled')
		}else if(data == "1"){
			_this.utilidades.utilidades.viewAlert("Debes desvincular antes los idiomas asociados");
			$("#language_info").html("");
			$("#tatget_info").val(_this.id_target);
			_this.call_request(_this.id_target);
			$("#language_info").attr('disabled','disabled')
		} else{
			$("#language_info").html(data);
			$("#language_info").removeAttr('disabled')

		}
	})
};


Language.prototype.validate_action = function() { 
	console.log(error_val)
	if(action == "edit" || error_val != 0){
		this.call_request($("#tatget_info").val());
	}
};

var lang = new Language();