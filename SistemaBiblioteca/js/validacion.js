$(document).ready(function(){

    jQuery.validator.addMethod("rut", function(value, element) {
        return $.validateRut(element.value) ;
    }, "El rut ingresado no es correcto");

    $("#formNuevaCategoria").validate({
        rules:{
            txtCodigoN:{
                required: true,
                maxlength: 5
            },
            txtDescripcionN:{
                required: true,
                maxlength: 45
            }
        },
        messages:{
            txtCodigoN:{
                required: "El código es requerido.",
                maxlength: "El código tiene que tener un máximo de 5 dígitos."
            },
            txtDescripcionN:{
                required: "La descripción es requerida.",
                maxlength: "La descripción tiene que tener un máximo de 45 dígitos"
            }
        }
    });
    
    $("#formModificarCategoria").validate({
        rules:{
            txtCodigoM:{
                required: true,
                maxlength: 5
            },
            txtDescripcionM:{
                required: true,
                maxlength: 45
            }
        },
        messages:{
            txtCodigoM:{
                required: "El código es requerido.",
                maxlength: "El codigo tiene que tener un máximo de 5 dígitos."
            },
            txtDescripcionM:{
                required: "La descripción es requerida.",
                maxlength: "La descripción tiene que tener un máximo de 45 dígitos"
            }
        }
    });

    $("#formNuevaReserva").validate({
        rules :{
            mnrUsuario:{
                required: true
            },
            mnrLibro:{
                required: true
            }  
        },
        messages:{
            mnrUsuario:{
                required: "El usuario es requerido."
            },
            mnrLibro:{
                required: "El Libro es requerido."
            }
        }
    })
    
    $("#formNuevoPrestamo").validate({
        rules :{
            mnpUsuario:{
                required: true
            },
            mnpLibro:{
                required: true
            }  
        },
        messages:{
            mnpUsuario:{
                required: "El usuario es requerido."
            },
            mnpLibro:{
                required: "El Libro es requerido."
            }
        }
    });
    
    $("#formLibroUsuario").validate({
        rules :{
            isbn: {
                required: true
            },
            titulo:{
                required: true
            },
            autor: {
                required: true
            },
            editorial: {
                required: true
            },
            anno: {
                required: true,
                number: true,
                minlength: 4,
                maxlength: 4
            },
            categoria: {
                required: true
            },
            cantidad: {
                required: true,
                number: true,
                min:1
            }
        },
        messages:{
            isbn: {
                required: "El isdn es requerido."
            },
            titulo:{
                required: "El titulo es requerido."
            },
            autor: {
                required: "El autor es requerido."
            },
            editorial: {
                required: "La editorial es requerida."
            },
            anno: {
                required: "El año es requerido.",
                number: "Ingrese solo números.",
                minlength: "El año tiene que tener 4 dígitos",
                maxlength: "El año tiene que tener 4 dígitos"
            },
            categoria: {
                required: "La categoría es requerida."
                
            },
            cantidad: {
                required: "La cantidad es requerida.",
                number: "Ingrese solo números.",
                min: "La cantidad minima debe ser 1."
            }
        }
    });
    
    
    $("#formUsuarioNuevo").validate({
        rules: {
            rut: {
                required: true,
                rut: true
            },
            nombres: {
                required: true
            },
            apellidos: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            telefono: {
                required: true
            },
            clave1: {
                required: true
            },
            clave2: {
                required: true
              
            },
            tipoperfil: {
                required: true
            }
        },
        messages: {
            rut: {
                required: "El rut es requerido.",
                rut: "Rut no válido."
            },
            nombres: {
                required: "El nombre es requerido."
            },
            apellidos: {
                required: "El apellido es requerido."
            },
            email: {
                required: "El email es requerido.",
                email: "Email no válido."
            },
            telefono: {
                required: "El teléfono es requerido."
            },
            clave1: {
                required: "La clave es requerida."
            },
            clave2: {
                required: "La clave es requerida.",
            },
            tipoperfil: {
                required: "El perfil es requerido."
            }
        }
    });
    
    // formulario usuario modificar
    $("#formUsuario").validate({
        rules: {
            rut: {
                required: true,
                rut: true
            },
            nombres: {
                required: true
            },
            apellidos: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            telefono: {
                required: true
            },
            clave1: {
                required: true
            },
            clave2: {
                required: true
                
            },
            tipoperfil: {
                required: true
            }
        },
        messages: {
            rut: {
                required: "El rut es requerido.",
                rut: "Rut no válido."
            },
            nombres: {
                required: "El nombre es requerido."
            },
            apellidos: {
                required: "El apellido es requerido."
            },
            email: {
                required: "El email es requerido.",
                email: "Email no válido."
            },
            telefono: {
                required: "El teléfono es requerido."
            },
            clave1: {
                required: "La clave es requerida."
            },
            clave2: {
                required: "La clave es requerida."
                
            },
            tipoperfil: {
                required: "El perfil es requerido."
            }
        }
    })
    
});