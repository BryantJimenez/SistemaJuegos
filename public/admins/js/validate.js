$(document).ready(function(){
	$("button[action='user']").on("click",function(){
		$("#formUser").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				},

				rol: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				rol: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	$("button[action='active']").on("click",function(){
		$("#formActive").validate({
			rules:
			{
				nombre: {
					required: true,
					minlength: 2,
					maxlength: 191
				}

				// codigo: {
				// 	required: true
				// },

				// tipo_de_activo: {
				// 	required: true
				// },

				// estado_fisico: {
				// 	required: true
				// },

				// descripcion: {
				// 	required: true,
				// 	minlength: 2
				// },

				// numero_serie: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 50
				// },

				// modelo: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 191
				// },

				// marca: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 191
				// },

				// cantidad: {
				// 	required: true,
				// 	min: 1
				// },

				// ubicacion: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 191
				// },

				// observaciones: {
				// 	minlength: 2
				// },

				// folio_o_numero_de_factura: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 30
				// },

				// nombre_del_proveedor: {
				// 	minlength: 2,
				// 	maxlength: 191
				// },

				// importe: {
				// 	required: true,
				// 	min: 1
				// },

				// tipo_de_moneda: {
				// 	required: true,
				// 	minlength: 1,
				// 	maxlength: 4
				// },

				// procedencia: {
				// 	required: true
				// },

				// pedimento_de_importacion: {
				// 	required: true,
				// 	minlength: 1,
				// 	maxlength: 40
				// },

				// fecha_de_pedimento: {
				// 	required: true
				// },

				// pais_de_origen: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 191
				// },

				// pais_de_procedencia: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 191
				// },

				// clave_pedimento: {
				// 	required: true,
				// 	minlength: 1,
				// 	maxlength: 20
				// },

				// linea_pedimento: {
				// 	min: 1
				// },

				// cuenta: {
				// 	required: true,
				// 	minlength: 2,
				// 	maxlength: 191
				// }
			},
			messages:
			{
				nombre: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}

				// codigo: {
				// 	required: 'Seleccione una opción.'
				// },

				// tipo_de_activo: {
				// 	required: 'Seleccione una opción.'
				// },

				// estado_fisico: {
				// 	required: 'Seleccione una opción.'
				// },

				// descripcion: {
				// 	minlength: 'Escribe mínimo {0} caracteres.'
				// },

				// numero_serie: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// modelo: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// marca: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// cantidad: {
				// 	min: 'Escribe un valor mayor o igual a {0}.'
				// },

				// ubicacion: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// observaciones: {
				// 	minlength: 'Escribe mínimo {0} caracteres.'
				// },

				// folio_o_numero_de_factura: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// nombre_del_proveedorm: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// importe: {
				// 	min: 'Escribe un valor mayor o igual a {0}.'
				// },

				// tipo_de_moneda: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// procedencia: {
				// 	required: 'Seleccione una opción.'
				// },

				// pedimento_de_importacion: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// fecha_de_pedimento: {
				// 	required: 'Seleccione una fecha.'
				// },

				// pais_de_origen: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// pais_de_procedencia: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// clave_pedimento: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// },

				// linea_pedimento: {
				// 	min: 'Escribe un valor mayor o igual a {0}.'
				// },

				// cuenta: {
				// 	minlength: 'Escribe mínimo {0} caracteres.',
				// 	maxlength: 'Escribe máximo {0} caracteres.'
				// }

			}
		});
	});
});