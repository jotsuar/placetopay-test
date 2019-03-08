;(function() {
	var App;

	App = (function() {

		function App() {
			this.initialize();
		}

		App.prototype.initialize = function() {
			this.initData();
			this.changeVisualization();
			this.getInfoZoho();
			this.showMap();
			this.viewIframe();
			this.remove_required();
		}

		App.prototype.showMap = function(){
			var _this = this;
			$("body").on('click', '#genMap', function(event) {
				event.preventDefault();
				_this.getUrlCountry();
			});
		};	

		App.prototype.initData = function(){
			var _this = this;
			if(action == "edit"){
				$(".radio-inline").each(function() {
					if($(this).is(':checked')){
						_this.hidenShowElements($(this).val())
					}
				});
			}
			$("#tablaDatos").hide()
			$(".modal-content,#iframeZoho").height($( window ).height());
		};

		App.prototype.changeVisualization = function() {
			var _this = this;
			$(".radio-inline").click(function(event) {
				_this.hidenShowElements($(this).val())
			});    	
		}

		App.prototype.hidenShowElements = function(val){
			if(parseInt(val) == 1){
				$("#countryHidden").show();
				$("#StatisticZohoUrl,#StatisticZohoUrl2,#GuardarDatos,#genMap,#containermap,.text-loading,#tablaDatos,#countryMapList,#StatisticZohoUrlEng,#StatisticZohoUrlEng2").hide();
				this.removeCheck();
				$("#StatisticZohoUrl,#StatisticZohoUrlEng").val('')
				$("#StatisticZohoUrl,#StatisticZohoUrlEng").removeAttr('required')
			}else{
				$("#countryHidden,#tablaDatos,.text-loading,#genMap,#containermap").hide();
				$("#StatisticZohoUrl,#StatisticZohoUrl2,#StatisticZohoUrlEng,#GuardarDatos,#countryMapList,#StatisticZohoUrlEng2").show();
				$("#tablaDatos").empty()
				this.addRequired();
				$("#StatisticLabels,#StatisticDbZoho,#StatisticReportZoho,#StatisticData,#StatisticExportData,#StatisticCountryId").val('');
				$("#StatisticZohoUrl,#StatisticZohoUrlEng").attr('required',true)
			}
		};

		App.prototype.getInfoZoho = function () {
			var _this = this;
			$(".valdiateForm").click(function(event) {
				event.preventDefault();
				var dbZoho = $("#StatisticDbZoho").val();
				var ReportZoho = $("#StatisticReportZoho").val();
				$("#geochart-colors").html("");
				if (dbZoho == "" || ReportZoho == "") {
					_this.showAlert("Para cargar la información los campos Db Zoho y Report Zoho, son requeridos.");
				}
				else {
					_this.callInfo(root + controller + "/getdata", { "DB_NAME": dbZoho, "TABLE_NAME": ReportZoho, "controller": this.controller }, function (data, controller) {
						data = $.parseJSON(data);
						if (data.response.hasOwnProperty("error")) {
							$(".text-loading").hide();
							_this.showAlert(data.response.error.message)
						}
						else {
							this.dataZoho = data;
							_this.callInfo(root + "statistics/show", {}, function (html) {
								$(".text-loading").hide();
								$("#tablaDatos").html(html)
								$("#genMap,#tablaDatos").show();
				            }, function () {
				            	$(".text-loading").show();
				            });
						}
					}, function () {
						$(".text-loading").show();
					});
				}
			});

		};

		App.prototype.showAlert = function(mensaje,error){
			if (error === void 0) { error = 1; }
			var type = error == 1 ? "danger" : "success";
			$.notify({
				message: mensaje
			}, {
				type: type,
				delay: 5000,
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				newest_on_top: true,
			});
		};

		App.prototype.callInfo = function (url, data, response, before) {
			var _this = this;
			if (_this.IsJsonString(data)) {
				if (!data.hasOwnProperty("controller")) {
					data.controller = null;
				}
			}
			$.ajax({
				async: true,
				url: url,
				type: 'POST',
				data: data,
				beforeSend: before,
				success: function (datos) {
					response(datos, data.controller);
				},
				error: function (jqXHR, textStatus, error) {
					response(0);
				}
			});
		};
		App.prototype.IsJsonString = function (str) {
			try {
				JSON.parse(str);
			}
			catch (e) {
				return false;
			}
			return true;
		};

		App.prototype.getUrlCountry = function(){
			var id = $("#StatisticCountryId").val();
			var _this = this;
			if(id == ""){
				_this.showAlert("Selecciona un país");
			}else{
				$("#containermap").html("");
				_this.getUrl(id)
				var labels = _this.getDataCountry();
				var datos  = _this.getDataEspecific();
				if (labels.length == 0 || labels.length > 1) {
					_this.showAlert("Debes seleccionar un tipo de información key.");
				}
				else if (datos.length == 0) {
					_this.showAlert("Se debe seleccionar mínimo un dato para mostrar.");
				}else{
					_this.callInfo(root + controller + "/getSessionData", {}, function (data) {
						data = $.parseJSON(data);
						var dataInitial = data.response.result.rows;
						_this.createEstructure(dataInitial,datos,labels,data.response.result.column_order)
					}, function () {
						console.log("Cargando");
					});
				}

			}
		};

		App.prototype.createEstructure = function(json,labels, datos,titulos){
			var dataInfo = [];  	
			var dataSave = [];  
			for (var i = 0; i < labels.length; i++) {
				var dataProv = [];
				dataProv.push(json[labels[i]][1]);
				dataProv.push(parseFloat(json[labels[i]][datos[0]]));
				dataInfo.push(dataProv)
				var dataSaveProv = [];
				dataSaveProv.push(json[labels[i]][0]);
				dataSaveProv.push(json[labels[i]][1]);
				dataSaveProv.push(parseFloat(json[labels[i]][datos[0]]));
				dataSave.push(dataSaveProv)
			}
			var data = dataInfo;
			var TitulosGuardados = [ titulos[0],titulos[1],titulos[datos[0]] ];
			setTimeout(function() {
				$("#StatisticLabels").val(JSON.stringify(TitulosGuardados));
				$("#StatisticData").val(JSON.stringify(data));
				$("#StatisticExportData").val(JSON.stringify(dataSave));
			}, 1000);

			this.ShowDataAndMap(data,titulos,datos);
			$(".text-loading").hide();
			$("#containermap").show();
			$("#GuardarDatos").hide();

		};

		App.prototype.ShowDataAndMap = function(data,titulos,datos){
			setTimeout(function() {
				var country = localStorage.getItem("country_data");
				country = JSON.parse(country);
				Highcharts.mapChart('containermap', {
					chart: {
						map: country.Country.source
					},
					title: {
						text: country.Country.name+" "+titulos[datos[0]]
					},
					subtitle: {
						text: ''
					},
					mapNavigation: {
						enabled: true,
						buttonOptions: {
							verticalAlign: 'bottom'
						}
					},
					colorAxis: {
						min: 0
					},
					series: [{
						data: data,
						name: titulos[datos[0]],
						states: {
							hover: {
								color: '#BADA55'
							}
						},
						dataLabels: {
							enabled: true,
							format: '{point.name}'
						}
					}, {
			            name: 'Separators',
			            type: 'mapline',
			            data: Highcharts.geojson(Highcharts.maps[country.Country.source], 'mapline'),
			            color: 'silver',
			            showInLegend: false,
			            enableMouseTracking: false
			        }]
				});
				$("#GuardarDatos").show();
			}, 1000);
		};

		App.prototype.getFiles = function(url){
			setTimeout(function() {		
				var country = document.createElement('script');
				country.type = 'text/javascript';
				country.src = root+url;
				document.body.appendChild(country);	
			}, 300);
		};

		App.prototype.getUrl = function(id){
			var _this = this;
			_this.callInfo(root + "statistics/url", {id:id}, function (datos) {
				data = $.parseJSON(datos);
				_this.getFiles(data.Country.url);
				localStorage.setItem("country_data", JSON.stringify(data));
			}, function () {
				$(".text-loading").show();
			});
		};

		App.prototype.getDataCountry = function () {
			var paises = [];
			$(".data_selection").map(function (index, elemento) {
				if ($(this).is(":checked")) {
					paises.push($(this).data("index"));
				}
			});
			return paises;
		};
		App.prototype.getDataEspecific = function () {
			var datos = [];
			$(".row_selection").map(function (index, elemento) {
				if ($(this).is(":checked")) {
					datos.push($(this).data("index"));
				}
			});
			return datos;
		};

		App.prototype.removeCheck = function(argument){

			$(".countryChekBox").each(function(index, el) {
				$(this).removeAttr('checked');
				$(this).removeAttr('required');
			});
		};

		App.prototype.remove_required = function(first_argument) {
			$(".countryChekBox").each(function(index, el) {
				$(this).removeAttr('required');
			});
		};

		App.prototype.addRequired = function(argument){
			$(".countryChekBox").each(function(index, el) {
				$(this).attr('required','required');
			});
		};

		App.prototype.viewIframe = function(argument){
			$(".viewContent").click(function(event) {
				$(".overlay2").css("display","table");
				var language = $(this).data("lang")
				setTimeout(function() {
					$(".overlay2").fadeOut('slow/400/fast', function() {
						if(language == "esp")
							$("#myModal").modal("show");
						else
							$("#myModalEng").modal("show");
					});
				}, 5000);

			});
		};	

		return App;

	})();

	$(function() {
		return App = new App();
	});

}).call(this);