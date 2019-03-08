function Language(){
	this.init();
}

Language.prototype.init = function(first_argument) {
	this.get_language();
};

Language.prototype.get_language = function() {
	console.log(MODEL)
};

var lang = new Language();