import { Utilidades } from "./clases/Utilidades.class.js"
import { JqueryEvents } from "./clases/jquery.class.js"
import { Zoho } from "./clases/zoho.class.js"
import { Maps } from "./clases/maps.class.js"

export class StatLat {
	Utilidades;
	UtilidadesJquery;
	Zoho;
	constructor($,qw,google?,swal?) {
		this.Utilidades 		= new Utilidades($,swal);
		this.UtilidadesJquery 	= new JqueryEvents(google,swal);
		this.Zoho				= new Zoho();
	}
}



