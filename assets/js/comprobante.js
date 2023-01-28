//CALCULOS TOTALES Y SUBTOTALES (Metodos Prototipos)        
    function comprobante(){
        this.subtotal = 0;
        this.total = 0;
        this.igv = 0;
        this.incluyeIgv = true;
    }
    
   comprobante.prototype.calcular = function(parent){
            var producto  = $(parent).children().children().children('#item_id').val();
            var importe  = $(parent).children().children('#importe').val();
            var cantidad = $(parent).children().children('#cantidad').val();
            var tipoIgv  = $(parent).children().children('#tipo_igv').val();
            var desc = ($(parent).children().children('#desc_uni').val() != '')?parseFloat($(parent).children().children('#desc_uni').val()):0.00;
            
            /*if(desc != '')
            {
                importe = parseFloat(importe)-parseFloat(desc);
            }*/
            if(tipoIgv < 8){
                if($("#anticipo").val() == '0')
                {
                    if (cmp.incluyeIgv==true ) {
                        this.subtotal = parseFloat( (importe/1.18 )*cantidad-desc).toFixed(2);
                        this.total = parseFloat(importe*cantidad).toFixed(2);
                     
                    } else {
                        //this.subtotal = parseFloat(importe*cantidad-desc).toFixed(2);
                        //this.total = parseFloat(this.subtotal*1.18).toFixed(2);
                        this.subtotal = parseFloat( (importe/1.18 )*cantidad-desc).toFixed(2);
                        this.total = parseFloat(importe*cantidad).toFixed(2);
                        
                    }
                    this.igv = parseFloat(this.total-this.subtotal).toFixed(2);                
                } else 
                {
                    this.subtotal = parseFloat(importe*cantidad).toFixed(2);
                    this.total = parseFloat(this.subtotal).toFixed(2);
                    var baseImponible = this.total / 1.18;
                    this.igv = parseFloat(this.total-baseImponible).toFixed(2);                     
                }

                                
           }else if(tipoIgv < 9){
                this.subtotal = parseFloat(importe*cantidad).toFixed(2);
                this.total = this.subtotal;
                this.igv = '0.00';                                  
            }else if (tipoIgv < 40){
                this.subtotal = parseFloat(importe*cantidad).toFixed(2);
                this.total = this.subtotal;
                this.igv = '0.00';                                 
                       
            }else{
                this.subtotal = parseFloat(importe*cantidad).toFixed(2);
                this.total = this.subtotal;
                this.igv = '0.00';                                                             
             }                                                          
                        
           // $(parent).children().children('#subtotal').val(this.subtotal);
            $(parent).children().children('#total').val(this.total);
           $(parent).children().children('#igv').val(this.igv);        
            calcular();
        };
        
    comprobante.prototype.detraccion = function(total_a_pagar){
        
        var moneda = $('#moneda_id option:selected').val();
        var monto_conversion = total_a_pagar;
        if(moneda>1){
             tipo_de_cambio = $('#tipo_de_cambio').val();
             monto_conversion = total_a_pagar*tipo_de_cambio;
        }            
        if(monto_conversion > 700){
            $('#detraccion').prop('checked',true);
            $('#detraccion').prop('value',1);
            $('#tipo_de_detraccion').prop('disabled',false);
            $('#porcentaje_de_detraccion').val(12);
            $('#total_detraccion').val(((total_a_pagar)*(12/100)).toFixed(2));
        } else {
            $('#detraccion').prop('checked',false);
            $('#detraccion').prop('value',0);
            $('#tipo_de_detraccion').prop('disabled',true);
            $('#porcentaje_de_detraccion').val('');                                                            
            $('#total_detraccion').val('');                
            }                                                                       
        };     
        
    
 //INSTANCIANDO OBJETO    
    var cmp = new comprobante(); 
 
 //METODOS IMPLEMENTADOS    
    function calcular(){        
        var total_igv = 0;
        var total_icbper = 0;
        var total_a_pagar = 0;        
        var total_gravada = 0;
        var total_exonerada = 0;
        var total_inafecta  = 0; 
        var total_descuento = 0;

        var total_anticipos = ($("#total_anticipos").val() != '')?parseFloat($("#total_anticipos").val()):0.00;       
        //console.log(total_anticipos);
        var tabla = $('#tabla > tbody > tr');
        //alert(tabla.length);
        try{
        if(typeof(tabla.length) !== 'undefined'){
            $.each(tabla,function(indice,value){             

                var cantidadIcbper = parseFloat(($(this).find('#cantidad').val()=='')?0:$(this).find('#cantidad').val());
                var item = ($(this).find('#item_id').val()!=undefined)?$(this).find('#item_id').val():$(this).find('#prod_id').val();
               
                var valorIcbper = parseFloat($('#valorIcbper').val());

                var tipoIgv = $(this).find('#tipo_igv').val();
                total_descuento += ($.isNumeric($(this).find("#desc_uni").val()))?parseFloat($(this).find("#desc_uni").val()):0;
                var itemTotal = $(this).find('#total').val();
                var itemTotalConIgv = 0;
                var itemIgv = 0; 
                //var itemIcbper = 0; 
                
                var baseImponible=0;
                if(tipoIgv < 8){
                    if($("#anticipo").val() == '0')
                    {
                        if(cmp.incluyeIgv==false)
                        {
                            //baseImponible = itemTotal/1.18;
                            //itemTotalConIgv = baseImponible* 1.18;
                            baseImponible = itemTotal;
                            itemTotalConIgv = baseImponible* 1.18;
                            console.log("primero 1 true");
                        }else
                        {
                            //baseImponible = itemTotal;
                            //itemTotalConIgv = baseImponible* 1.18;
                            baseImponible = itemTotal/1.18;
                            itemTotalConIgv = baseImponible* 1.18;
                            console.log("primero 1 false");
                        }
                        /*baseImponible = itemTotal/1.18;
                        itemTotalConIgv = itemTotal;*/

                        itemTotalConIgv = baseImponible* 1.18;
                        itemIgv = itemTotalConIgv-baseImponible;
                        total_gravada   += parseFloat(baseImponible);
                        total_igv += parseFloat(itemIgv) ; 

                        
                    }else
                    {

                        itemTotalConIgv = itemTotal;
                        baseImponible = itemTotalConIgv/1.18;
                        itemIgv =  itemTotalConIgv-baseImponible;
                        total_gravada += baseImponible;
                        total_igv += parseFloat(itemIgv) ;

                        console.log("primero 2");
                    }

                   
                  
                }
                else if(tipoIgv < 9){
                    itemTotalConIgv = itemTotal;//no incluyde igv
                    itemIgv = 0;
                    total_exonerada += parseFloat($(this).find('#total').val());
                    //total_igv += parseFloat($(this).find('#igv').val());
                    total_igv += 0;
                    console.log("segundo");
                }
                    else{
                    itemTotalConIgv = itemTotal;//no incluyde igv
                    itemIgv = 0;                        
                    total_inafecta  += parseFloat($(this).find('#total').val());
                    //total_igv += parseFloat($(this).find('#igv').val());
                    total_igv += 0;
                    console.log("tercero");
                }            
                
                total_a_pagar  +=  parseFloat(itemTotalConIgv);
              
                if(item == 1){
                    total_icbper +=  cantidadIcbper*valorIcbper
                    total_a_pagar += cantidadIcbper*valorIcbper;
                }

            });   

            //verificamos si tiene descuento global
            if($.isNumeric($('#descuento_global').val()))
            {
                var _descuentoTotal = parseFloat($('#descuento_global').val());
                if (_descuentoTotal>0) {
                    total_a_pagar = total_a_pagar - _descuentoTotal;

                    total_gravada = total_a_pagar / 1.18;
                    total_igv = total_a_pagar - total_gravada;
                    total_descuento+=_descuentoTotal;
                }
                  console.log("descuento");        
            }
            //verificamos si tiene otros cargos
            if($.isNumeric($('#total_otros_cargos').val()))
            {
                var _otros_cargos = parseFloat($('#total_otros_cargos').val());
                if (_otros_cargos>0) {
                    total_a_pagar = total_a_pagar + _otros_cargos;

                    /*total_gravada = total_a_pagar / 1.18;
                    total_igv = total_a_pagar - total_gravada;
                    total_descuento+=_descuentoTotal;*/
                }
                      console.log("oros cargos");    
            }
            //verificamos si tiene anticipos
            if(total_anticipos>0)
            {
                total_a_pagar -=total_anticipos;
                total_gravada = total_a_pagar/1.18;
                total_igv = total_a_pagar-total_gravada;
            }                                 
        }  


            $('#total_igv').val(total_igv.toFixed(2));
            $('#total_icbper').val(total_icbper.toFixed(2));
            $('#total_a_pagar').val(total_a_pagar.toFixed(2));
            $('#total_gravada').val(total_gravada.toFixed(2));
            $('#total_inafecta').val(total_inafecta.toFixed(2));
            $('#total_exonerada').val(total_exonerada.toFixed(2));                                                             
            $('#total_anticipos').val(total_anticipos.toFixed(2));                                                             
            $('#total_descuentos').val(total_descuento.toFixed(2));                                                             
            
            
            if($('#operacion_gratuita').is(':checked')) {
            operacion_gratuita();
            total_a_pagar = 0;                   
        }                
            cmp.detraccion(total_a_pagar);
            return total_a_pagar;
        }
        catch(err){console.log(err.message)};
    }
 
    function operacion_gratuita(){        
        if($('#operacion_gratuita').is(':checked')){
            var total = $('#total_a_pagar').val();
            $('.input-group input:text').each(function(){ $($(this)).val(''); });            
            $('#total_gratuita').val(total); 
            cmp.detraccion(0);
        } else {
          $('#total_gratuita').val('');
            cmp.calcular();          
        }                        
    }
    
    function tipoVenta(parent){          
       var tipoVenta = $(parent).find('#tipo_venta option:selected').val();        
            if(tipoVenta === '2'){        
               $(parent).find('#cantidad').prop('readonly',false);                    
            } else {
               $(parent).find('#cantidad').val('1');
               $(parent).find('#cantidad').prop('readonly',true);
               cmp.calcular(parent);               
           }                   
    }                                     
    
    //EVENTOS CALCULO - ITEMS                  
    $(document).on('keyup',"#importe,#cantidad,#desc_uni,#descuento_global,#total_otros_cargos,#descripcion",function(e){
        var parent = $(this).parents().parents().get(0);        
        console.log(parent);    
        cmp.calcular(parent);
    });
        
    $(document).on('change',"#tipo_igv",function(){
        var parent = $(this).parents().parents().get(0);
        cmp.calcular(parent);
    });
    
    $(document).on('change',"#tipo_venta",function(){
        var parent = $(this).parents().parents().get(0);
        tipoVenta(parent);
    });
    $(document).on('change',"#categoria",function(){
        var parent = $(this).parents().parents().get(0);
        tipoVenta(parent);
    });
    
    // EVENTO TEXTBOX TIPO DE CAMBIO
    $(document).on('keyup','#tipo_de_cambio',function(){
        cmp.calcular();
    });             