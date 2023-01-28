 $(document).ready(function(){        
    //VALIDACION DE CAMPOS VACIOS
     $('#guardar').on('click',function(e){                                     
        var cam = '';
        var cab = 0;
        var item = 0;     
        if($('#cliente_id').val() === ''){ cam += '\n- cliente'; cab++;}
        //if($('#serie').val() === '')     { cam += '\n- serie ';  cab++;}
        //if($('#numero').val() === '')    { cam += '\n- numero '; cab++;}
        
        // ARRAY DE CAMPOS                  
        var descripcion = $('.descripcion');                
        $.each(descripcion,function(indice,value){
            console.log($(this).val());
                      if($(this).val() === '') {
                          cam += '\n- descripcion'+'|'+indice;
                          item++;
                      }
        });        
        var importe = $('.importe');
        $.each(importe,function(indice,value){        
            console.log($(this).val());
                      if($(this).val() === '') {
                          cam += '\n- importe'+'|'+indice;  
                          item++;
                      }
        });        
        var cantidad = $('.cantidad');                
        $.each(cantidad,function(indice,value){        
            console.log($(this).val());
                      if($(this).val() === '') {
                          cam += '\n- cantidad'+'|'+indice;  
                          item++;
                      }                                            
        });                        
        if($('#operacion_gratuita').is(':checked')){                                                                                   
            //var total = 0;
            var tabla = $('tbody tr');                
            $.each(tabla , function(indice,value){
                //total += parseFloat($(this).find('#total').val());
                var tipoIgv = $(this).find('#tipo_igv').val();
                if(tipoIgv < 8){
                   cam += '\n- tipo_igv'+'|'+indice;                   
                   item++;
               }
            });
        }                                
        if(cab > 0){
        var foco = cam.split('- ');                
        $('#'+foco[1]).focus();
        } 
            else if(item > 0){                   
            var foco = cam.split('- ');  
            console.log(foco[1]);
            var foc  = foco[1].split('|');                            
            $('tbody tr:eq('+foc[1]+')'+' .'+foc[0]).focus();   
        }
            
        if(cam !== ''){
            alert('Campos Requeridos '+cam);
            return false;
        }          
        if ($('#tabla >tbody >tr').length === 0){
            alert( "Debe Ingresar por los menos un Item!" );
            return false;
        }                
    });
    
    
    
     // EVENTO COMBOBOX NOTA DE CREDITO , DEBITO    
    $('#tipo_documento').on('change',function(){        
        var selec = $('#tipo_documento option:selected').val();                        
            if(selec <= 3){                
                $('#mostrarCompNota').css('display','none');
                if(selec == 1){                    
                    $('#mostrarDetraccion').css('display','block');
                    $('#serie').attr({title:'Serie FF.. ó F...',placeholder:'F001',pattern:'^[fF]{1}[fF|'+'\\d]{1}('+'\\d){2}'});                    
                }
                if(selec == 3){
                    $('#mostrarDetraccion').css('display','none');
                    $('#serie').attr({title :'Serie BB.. ó B...',placeholder:'B001',pattern:'^[bB]{1}[bB|'+'\\d]{1}('+'\\d){2}',});
                }                
            } else {                  
                $('#mostrarDetraccion').css('display','none');$('#mostrarCompNota').css('display','block');                
                $('#serie').attr({title:'Serie FF.. ó F...',placeholder:'F001',pattern:'^[fF]{1}[fF|'+'\\d]{1}('+'\\d){2}'});
                if(selec == 7){
                    $('#tipo_ncredito').prop('disabled',false);$('#tipo_ndebito').prop('disabled',true);
                } 
                if(selec == 8){
                    $('#tipo_ncredito').prop('disabled',true);$('#tipo_ndebito').prop('disabled',false);
                }               
            }
    });   


     
  });                         