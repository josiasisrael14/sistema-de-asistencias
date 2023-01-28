                   
    function validar_item(){
        var campos = $('#valida input[type=text],textarea').serializeArray();                        
        var mensaje  = "";
        var contador = 0;
        var cmp = '';        
        
        // Campos Vacios                        
        $.each(campos,function(){
            if(this.value === ''){
                mensaje +=  "\n- " + this.name;
                contador++;
                cmp += this.name + '-';
            }                                                
        });  
        cmp = cmp.split('-');        
        $('#'+cmp[0]).focus();
        
        //console.log(contador);
        if (contador > 0){                                                
            alert('Campos Requeridos :'+ mensaje);            
            return contador;
        }                
    }
                
    
    function checkDecimals(fieldName, fieldValue) {
        decallowed = 2; // how many decimals are allowed?

        if (isNaN(fieldValue) || fieldValue == "") {            
            alert("El número no es válido. Prueba de nuevo.");        
            fieldName.select();
            fieldName.focus();        
            return 5;
        }
        else {
        if (fieldValue.indexOf('.') === -1) fieldValue += ".";
            dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

        if (dectext.length > decallowed)
        {           
            alert ("Por favor, entra un número con " + decallowed + " números decimales.");        
            fieldName.select();
            fieldName.focus();        
            return 5;        
              }
           }
    }

    function validDecimals(e,str){
        var decallowed = 2; // how many decimals are allowed?
        var valorNum = str.value;

        //alert(str.value);                          
        if (e.ctrlKey || e.altKey)           
                e.preventDefault();           
          //alert(event.keyCode);                              
          
           if (e.keyCode === 8 || e.keyCode === 9 || e.keyCode === 16 || e.keyCode === 46 || e.keyCode === 110 ||(e.keyCode > 34 && e.keyCode < 40)) {    
               
               if (e.keyCode === 110 && isNaN(valorNum+'.')) {            
                    e.preventDefault();
                }                                                
           }
           else {
                if (e.keyCode < 95) {
                  if (e.keyCode < 48 || e.keyCode > 57) {
                        e.preventDefault();
                  }
                  else {
                        if (valorNum.indexOf('.') === -1) valorNum += ".";
                            dectext = valorNum.substring(valorNum.indexOf('.')+1, valorNum.length);                            
                                if (dectext.length >= decallowed){                                                               
                                    e.preventDefault();
                                }                                                            
                  }
                } 
                else {
                      if (e.keyCode < 96 || e.keyCode > 105) {
                          e.preventDefault();
                      }                      
                      else{
                          if (valorNum.indexOf('.') === -1) valorNum += ".";
                            dectext = valorNum.substring(valorNum.indexOf('.')+1, valorNum.length);                            
                                if (dectext.length >= decallowed){                                                               
                                    e.preventDefault();
                                }                                                        
                      }
                }
              }                                                                                
    }    
    
    
    function validNumericos(e){      
        //alert(e.keyCode);
        
        if (e.ctrlKey || e.altKey)           
                e.preventDefault();                   
          
           if (e.keyCode === 8 || e.keyCode === 9 || e.keyCode === 16 || e.keyCode === 46 || (e.keyCode > 34 && e.keyCode < 40)){}
           else {
                if (e.keyCode < 95) {
                  if (e.keyCode < 48 || e.keyCode > 57) {
                        e.preventDefault();
                  }             
                }
                else {
                      if (e.keyCode < 96 || e.keyCode > 105) {
                          e.preventDefault();
                      }
                }
              }                                                                        
    }
    
    function validAlfaNumerico(e){
        console.log(e.keyCode);
        if (e.ctrlKey || e.altKey)
                e.preventDefault();
            
            if (e.keyCode === 8 || e.keyCode === 9 || e.keyCode === 16 || e.keyCode === 46 || (e.keyCode > 34 && e.keyCode < 40)){}
            else {
                if(e.keyCode < 95 ){
                    if(e.keyCode < 48 || e.keyCode > 90){e.preventDefault();}
                    else if(e.keyCode > 65 || e.keyCode > 90){}
                }
                else {
                      if (e.keyCode < 96 || e.keyCode > 105) {
                          e.preventDefault();
                      }                                            
                }
            }                                        
    }    