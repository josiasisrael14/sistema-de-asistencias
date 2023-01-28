
function eliminar(base_url, controlador, funcion, parametro1, parametro2, parametro3,parametro4) {
    if (confirm("Realmente desea eliminar este registro ?")) {
        
        if(typeof parametro4 == "undefined"){
            if(typeof parametro3 == "undefined"){
                if(typeof parametro2 == "undefined"){
                    var ruta = base_url + "index.php/" + controlador + "/" + funcion + "/" + parametro1;
                }
                else{
                    var ruta = base_url + "index.php/" + controlador + "/" + funcion + "/" + parametro1 + "/" + parametro2;
                }
            }    
            else{                
                var ruta = base_url + "index.php/" + controlador + "/" + funcion + "/" + parametro1 + "/" + parametro2 + "/" + parametro3;                
            }   
        }    
        else{        
                var ruta = base_url + "index.php/" + controlador + "/" + funcion + "/" + parametro1 + "/" + parametro2 + "/" + parametro3+ "/" + parametro4;
        }    
        window.location = ruta;
    }
}



function enviar_correo(base_url, controlador, funcion, parametro1, parametro2, parametro3) {
    if (confirm("Realmente desea enviar factura ?")) {
        if (typeof parametro3 == "undefined") {
            if (typeof parametro2 == "undefined") {
                var ruta = base_url + "index.php/" + controlador + "/" + funcion + "/" + parametro1;
            } else {
                var ruta = base_url + "index.php/" + controlador + "/" + funcion + "/" + parametro1 + "/" + parametro2;
            }
        } else {
            var ruta = base_url + "index.php/" + controlador + "/" + funcion + "/" + parametro1 + "/" + parametro2 + "/" + parametro3;
        }
        window.location = ruta;
    }
}

