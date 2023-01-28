<?PHP //if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once (APPPATH .'libraries/fpdf17/fpdf.php');
require_once (APPPATH .'libraries/Numletras.php');


class Pdf extends FPDF{    
    private $comprobante;        
    private $items;
    private $tnota;
    private $cadjunto;
    private $cuentas;
    private $comprobante1;
    
    public function qr($datos){
        require (APPPATH .'libraries/phpqrcode/qrlib.php');

	//Declaramos una carpeta temporal para guardar la imagenes generadas
        $nombre_file = 'test.png';
        $carpeta = 'temp/';
	$dir = APPPATH.$carpeta;	

        //Declaramos la ruta y nombre del archivo a generar
	$filename = $dir.$nombre_file;

        //Parametros de Condiguración	
	$tamanio = 8; //Tamaño de Pixel
	$level = 'Q'; //Precisión Baja
	$framSize = 3; //Tamaño en blanco
	$contenido = $datos; //Texto

        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamanio, $framSize); 

        //Mostramos la imagen generada
        return $filename;
    }

    public function __construct($cmp) {
            parent::__construct();
            $this->comprobante = $cmp;            
        }

   public function GenerarComprobante($items,$tnota,$cadjunto,$cuentas = '',$comprobante1) {                
        //var_dump($items);exit;
        $this->items = $items;
        $this->tnota = $tnota;
        $this->cadjunto = $cadjunto;
        $this->comprobante1 = $comprobante1;
       // print_r($this->comprobante1->notas);exit();
        
        $this->AddPage();
        $this->SetTitle("Facturacion Electronica");        
        $this->cabecera();
        
        //CUERPO        
        $this->SetX(10);
        $this->Cell(10, 10, 'N', 1, 0,'C');        
        $this->Cell(110,10,'DESCRIPCION',1,0,'C');
        $this->Cell(30,10,'PRECIO UNITARIO',1,0,'C');
        $this->Cell(20,10,'DESC',1,0,'C');
        $this->CellFitSpace(20, 10, 'IMPORTE', 1,1,'C');//$topCuerpo = 112;
        //print_r($this->items);exit();
        foreach ($this->items as $index => $value) {
            $cellWidth = 110;
            $cellHeight = 5;
            
            if($this->getStringWidth($value['descripcion']) < $cellWidth)
            {
                $line = 1;
            }else{
                $textLength = strlen($value['descripcion']);
                $errMargin = 10;
                $startChar = 0;
                $maxChar = 0;
                $textArray = array();
                $tmpString = "";
                while($startChar < $textLength)
                {
                    while($this->GetStringWidth($tmpString) < ($cellWidth-$errMargin) && ($startChar+$maxChar) < $textLength)
                    {
                        $maxChar++;
                        $tmpString = substr($value['descripcion'], $startChar, $maxChar);
                    }
                    $startChar = $startChar+$maxChar;
                    array_push($textArray, $tmpString);
                    $maxChar = 0;
                    $tmpString='';
                }
                $line = count($textArray);
            }
            $this->cell(10, ($line*$cellHeight),$value['cantidad'],1,0,'C');
            //$this->cell(140, ($line*$cellWidth),utf8_decode($value['descripcion']),1,0);
            //multicell
            $xPos = $this->GetX();
            $yPos = $this->GetY();
            $this->MultiCell($cellWidth, $cellHeight,$value['descripcion'],1,'C');
            $this->SetXY($xPos+$cellWidth, $yPos);
            $this->cell(30, ($line*$cellHeight),$this->comprobante['simbolo'].' '.$value['importe'],1,0,'R');
            $this->cell(20, ($line*$cellHeight),$this->comprobante['simbolo'].' '.$value['descuento'],1,0,'R');
            $this->cell(20, ($line*$cellHeight),$this->comprobante['simbolo'].' '.$value['subtotal'],1,1,'R');
        }                    
         //MONTO EN LETRAS
        $num = new Numletras();    
        $importe_letra = $num->num2letras(intval($this->comprobante['total_a_pagar']));       
        //PIE DE CUERPO                
        $this->SetX(10);
        //$this->CellFitSpace(10,10, ' ','LB',0,'C');
        $this->Cell(190, 8, 'SON: '.$importe_letra.' con ' .$dec_tot.'/100 '.utf8_decode($this->comprobante['moneda']), 1, 1, 'L');
        $this->Cell(190, 8, 'NOTA: '.$this->comprobante1->notas, 1, 1, 'L');
        $this->Ln(4);
        //$this->Cell(20, 10, '','LBR',1,'C');
        


        $cad = number_format($this->comprobante['total_a_pagar'], 2, ".", ",");
        $lon = strlen($cad);
        for ($i = $lon; $i > 0; $i--) {
            $let = substr($cad, $i, 1);
            if ($let == ".") {
                $dec_tot = substr($cad, ($i + 1), ($lon - $i - 1));
                $i = 0;
            }
        }
        //PIE DE CUERPO SUBTOTALES Y TOTALES 
        if(count($this->comprobante1->anticipos) > 0)
        {
            $anticipos = $this->comprobante1->anticipos;
            $totalAnticipos = 0;
            foreach ($anticipos as $value)
            {
                $totalAnticipos += $value->total_a_pagar;
            }
            $this->SetX(120);$this->Cell(40,6,'Anticipos',1,0);$this->formatoTotal($this->comprobante['simbolo'], $totalAnticipos);
        } 
        $this->SetX(120);$this->Cell(40,6,'Desc. Total',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante1->descuento_global);
             
        $this->SetX(120);$this->Cell(40,6,'Op.Gravada',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_gravada']);
        if($this->comprobante['total_exonerada'] > 0){            
            $this->SetX(120);$this->Cell(40,6,'Op.Exonerada',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_exonerada']);
        }
        if($this->comprobante['total_inafecta'] > 0){
            $this->SetX(120);$this->Cell(40,6,'Op.Inafecta',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_inafecta']);
        }                
        $this->SetX(120);$this->Cell(40,6,'I.G.V',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_igv']);
        
        if($this->comprobante['total_gratuita'] > 0){
            $this->SetX(120);$this->Cell(40,6,'Gratuita',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_gratuita']);
        }
        if($this->comprobante['total_otros_cargos'] > 0){
            $this->SetX(120);$this->Cell(40,6,'Otros Cargos',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_otros_cargos']);
        }
        if($this->comprobante1->total_descuentos > 0)
        {
            $this->SetX(120);$this->Cell(40,6,'Descuento Total',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante1->total_descuentos);
        }                    
        $this->SetX(120);$this->Cell(40,6,'Importe Total',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_a_pagar']);
        $this->Ln(4);
        if(count($this->comprobante1->anticipos) > 0)
        {
            $this->SetX(120);$this->Cell(80,6,'ANTICIPOS:',1,1,'C');
            foreach($this->comprobante1->anticipos as $anticipo)
            {
               $serieCorrelativo = $anticipo->serie.'-'.$anticipo->numero;
               $this->SetX(120);$this->Cell(40,6,$serieCorrelativo,1,0);$this->formatoTotal($this->comprobante['simbolo'], $anticipo->total_a_pagar); 
            }            
        }

        //DETRACCION
        $extra = '';        
        if(($this->comprobante['codigo'] == "3000") || ($this->comprobante['codigo'] == "3001")){            
            $extra = "': ".$cuentas[$this->comprobante['empresa_id']][3][1]['cuenta'];
        }
        
        $this->Ln(2);
//        if($this->comprobante['detraccion'] == 1){
//            $this->Cell(10,8, '', 0, 0, 'C');
//            $this->Cell(100,8, utf8_decode('Operación sujeta al sistema de Pago de Obligaciones Tributarias SPOT'),0, 1, 'C');
//            //$this->Cell(20,8, 'Tipo', 1, 0, 'C');
//            $this->Cell(120,8,  utf8_decode('Cuenta Banco Nacion: 00-021-081264   C.I.:018021 00002108126460'),1,0,'C');        
//            $this->Cell(15,8,'%'.$this->comprobante['porcentaje_de_detraccion'],1,0,'C');
//            $this->Cell(40,8, 'Total Detraccion:', 1, 0, 'C');
//            $this->Cell(20,8,  'S/ '.number_format($this->comprobante['total_detraccion'],2,'.',''),1,1,'C');
//        } 
        //NOTA DE CREDITO,DEBITO                
        if($this->comprobante['tipo_documento_id'] > 3){                       
            $this->Cell(100,8, 'Comprobante Adjunto',0, 1, 'C');        
            $this->Cell(20,8, 'Tipo N.', 1, 0, 'C');
            if($this->comprobante['tipo_documento_id'] == 7){
                $this->Cell(120,8, utf8_decode($this->tnota['tipo_ncredito']),1,0,'C');
            }
            if($this->comprobante['tipo_documento_id'] == 8){
                $this->Cell(120,8,  utf8_decode($this->tnota['tipo_ndebito']),1,0,'C');
            }
            $this->Cell(50,8,$this->cadjunto['abr'].' / '.  $this->cadjunto['serie'].' - '.  $this->cadjunto['numero'],1,1,'C');        
        }            
                        
        //CODIGO SUNAT        
        $this->Ln(2);
        if($this->comprobante['envValidacion'] > 0)
            $this->Cell(180,10, 'RSunat: '.$this->comprobante['desSunat'],0,1,'C');
        
        
        //OPERACION GRATUITA
        $this->Ln(2);
        if($this->comprobante['operacion_gratuita'] == 1)
            $this->Cell (180,10, 'TRANSFERENCIA GRATUITA DE UN BIEN Y/O SERVICIO PRESTADO GRATUITAMENTE',0,1,'C');                                
        /*cuentas*/
        $qr = $this->qr($this->comprobante['empresa_ruc']."|".$this->comprobante['tipo_documento_id']."|".$this->comprobante['serie']."|".$this->comprobante['numero']."|".$this->comprobante['total_igv']."|".$this->comprobante['total_a_pagar']."|".$this->comprobante['fecha_de_emision']."|".$this->comprobante['tipo_cliente_codigo']."|".$this->comprobante['rucCliente']);
        $this->Image($qr,12,265,22,22,'PNG');    


        
        ///////////////////////////////////////
        //$this->cuentaBancos($cuentas, $this->comprobante['empresa_id']);
        if($this->comprobante['vista'] == '0'){
             $this->Output();
        } else {
             if($this->comprobante['envValidacion'] > 0)
             //$this->cuentaBancos($cuentas, $this->comprobante['empresa_id']);
             $this->Output(APPPATH."files_pdf/comprobantes/".  $this->comprobante['cliente_id'].  $this->comprobante['comprobante_id'].".pdf");
        } 


        $this->footer();
                
    }  
    
    //ENCABEZADO PDF
    public function cabecera() {                
        
        $tipDoc = $this->comprobante['tipo_documento_id'];                
        switch ($tipDoc) {
            case 1 : $documento = 'FACTURA ELECTRONICA';break;
            case 3 : $documento = 'BOLETA ELECTRONICA';break;
            case 7 : $documento = 'NOTA CREDITO';break;
            case 8 : $documento = 'NOTA DEBITO';break;
            default:break;
        } 
                      
        //$this->SetTopMargin(20);
        //$this->SetMargins(20,40);
        //$y = $this->y;
        $titele = '';
        if($this->comprobante['empresa_id'] == '1'){
            //$this->Image(APPPATH."files_pdf/logo_empresa.png",10,22,50,32,'PNG');
            
            $this->Image("images/".$this->comprobante['foto'],10,22,50,32,'JPEG');                        
            $titele = 'ESTUDIO TORRES Y TORRES LARA & ASOCIADOS - ABOGADOS S.CIVIL DE R.L. JR. Cañon del Pato 103 - Surco - Lima - Perú Central Telefónica: (051) 6181515 www.tytl.com.pe';
        }

        //Header
        $this->SetFont('helvetica', 'B', 9);$wHeader = 60;
        $this->SetXY($wHeader,25);
        //Cabecera1

        $wHeaderEmpresa = ($this->comprobante['empresa_id'] == 2) ? 150 : 140;
        $altEmpresa = ($this->comprobante['empresa_id'] == 2) ? 50 : 60;
        
        $this->SetFont('helvetica','B',10);$wHeader = $wHeaderEmpresa;
        $this->RoundedRect($wHeader, 25, $altEmpresa, 10, 2, '12', '');
        $this->SetXY($wHeader,25);$this->CellFitSpace($altEmpresa, 10,  utf8_decode("R.U.C. N° ".$this->comprobante['empresa_ruc']),0, 1,'C');
        $this->SetX($wHeader);$this->Cell($altEmpresa,10,$documento,1,1,'C');
        $this->RoundedRect($wHeader, 45, $altEmpresa, 10, 3, '34', ''); 
        $this->SetX($wHeader);$this->CellFitSpace($altEmpresa, 10, utf8_decode('N° '.$this->comprobante['serNum']),0,1,"C");

        //Cabecera2
        $topCabecera = 55;$this->SetXY(10, $topCabecera);

        //$this->MultiCell(120,7,utf8_decode($titele),0,'C');
        
        $this->SetFont('helvetica', '', 9);
        $this->Cell(5,5,  utf8_decode($this->comprobante['empresa']),0,1);
        $this->Cell(5,5,  utf8_decode($this->comprobante['domicilio_fiscal']),0,1);
        $this->Cell(5,5,  utf8_decode("Teléfono: ".$this->comprobante['telefono_movil']),0,1);
        $this->Cell(40,10,  '',0,1);
        $altura_cliente = 5;
        $ancho_cliente = 28;
        $this->SetFont('helvetica', '', 8);
                        
        $this->Cell($ancho_cliente,$altura_cliente,  utf8_decode('Cliente'),0,0);        
        
        if($this->comprobante['tipo_cliente_id'] == 1){
            //$this->Cell(40,7,  utf8_decode(': '.$this->comprobante['cli_razon_social'].' '.$this->comprobante['cli_nombres']),0,1);    
            $this->MultiCell(160,$altura_cliente,': '.utf8_decode($this->comprobante['cli_razon_social'].' '.$this->comprobante['cli_nombres']),0,1);
        }else{
            //$this->Cell(40,7,  utf8_decode(': '.$this->comprobante['cli_razon_social_sunat']),0,1);    
            $this->MultiCell(160,$altura_cliente,': '.utf8_decode($this->comprobante['cli_razon_social_sunat']),0,1);
        }
        
        $this->Cell($ancho_cliente,$altura_cliente,'Direccion',0,0);
        $this->MultiCell(160,$altura_cliente,': '.utf8_decode($this->comprobante['cli_domicilio1']),0,1);
        $this->Cell($ancho_cliente,$altura_cliente,  utf8_decode('R.U.C'),0,0);
        $this->Cell(20,$altura_cliente,  ': '.  $this->comprobante['rucCliente'],0,1);
        $this->Cell($ancho_cliente,$altura_cliente,'Fecha de Emision',0,0);
        $this->Cell($ancho_cliente,$altura_cliente,': '.  $this->comprobante['fecha_de_emision'],0,1);
        //$this->Cell(40,7,'Fecha de Vencimiento',0,0);
        //$this->Cell(40,7,': '.$this->comprobante['fecha_de_vencimiento'],0,1);
        $this->Cell($ancho_cliente,$altura_cliente,'Moneda',0,0);
        $this->Cell(20,$altura_cliente,': '.strtoupper(utf8_decode($this->comprobante['moneda'])),0,1);

        $this->Cell($ancho_cliente,$altura_cliente,'Numero Pedido',0,0);
        $this->Cell(20,$altura_cliente,': '.strtoupper(utf8_decode($this->comprobante1->numero_pedido)),0,1);

        $this->Cell($ancho_cliente,$altura_cliente,'Orden de Compra',0,0);
        $this->Cell(20,$altura_cliente,': '.strtoupper(utf8_decode($this->comprobante1->orden_compra)),0,1);

        $this->Cell($ancho_cliente,$altura_cliente,'Numero de Guia',0,0);
        $this->Cell(20,$altura_cliente,': '.strtoupper(utf8_decode($this->comprobante1->numero_guia_remision)),0,1);

        $this->Cell($ancho_cliente,$altura_cliente,'Condicion de Venta',0,0);
        $this->Cell(20,$altura_cliente,': '.strtoupper(utf8_decode($this->comprobante1->condicion_venta)),0,1);                                                                
    }

    public function footer()
    {
        $y = $this->GetY();
        $text = "Sirvase abonar a alas siguientes cuentas:\n BCP Cta. Cte. M.e (USD) 194-01455675-1-83\n CCI BCP M.E (USD) 00219400015567518390\n BCP Cta. Cte. M.N (S/.) 194-0080741-0-64 a la orden de:\n IMPORTADORA SIHI CHILE LTDA SUCURSAL PERU";
        $this->SetFont('Arial', '', 6);
        $this->SetXY(10,$y);$this->MultiCell(60,6,$text,1,'C') ;

         $textNota = utf8_decode("NOTA: Los atrasos en los pagos devengarán el màximo interes legal.");
        $this->SetFont('Arial', '', 6);
        $this->SetXY(80,$y);$this->MultiCell(40,6,$textNota,1,'C') ;            
    }
    
    public function cuentaBancos($cuentas, $empresa_id) {        
        //$this->SetFont('Arial','B',9);
        $this->Cell(180,10,'Al realizar el abono agradeceremos escanear el voucher y remitirlo al correo: '.$this->comprobante['correo'],0,1,'C');
                
        $this->Cell(40,6,'BANCO', 'LT', 0,'C');        
        $this->Cell(40,6,'MONEDA','T',0,'C');
        $this->Cell(50,6,'CUENTA', 'T',0,'C');
        $this->Cell(60,6,'CODIGO INTERBANCARIO', 'RT',1,'C');
        
        $this->Cell(40,6,'INTERBANK','RB',0,'C');
        $this->Cell(40,6,'SOLES','RB',0,'C');
        $this->Cell(50,6,'047-3106086787','RB',0,'C');
        $this->Cell(60,6,'003-047-013106086787-89','RB',1,'C');
        
       
    }    
    
    public function formatoTotal($simboloMoneda, $monto){        
        $numero = number_format($monto,2);
        $cantidad = strlen($numero);
        
        $cadena = '';
        switch ($cantidad) {
            case 4:
                $cadena = $simboloMoneda.'                           '. $numero;
                break;            
            case 5:
                $cadena = $simboloMoneda.'                          '. $numero;
                break;            
            case 6:                                
                $cadena = $simboloMoneda.'                        '. $numero;
                break;                        
            case 7:
                $cadena = $simboloMoneda.'                      '. $numero;
                break;
            case 8:
                $cadena = $simboloMoneda.'                     '. $numero;
                break;
            case 9:
                $cadena = $simboloMoneda.'                    '. $numero;
                break;
            case 10:
                $cadena = $simboloMoneda.'                   '. $numero;
                break;
            case 11:
                $cadena = $simboloMoneda.'                  '. $numero;
                break;
            case 12:
                $cadena = $simboloMoneda.'                 '. $numero;
                break;
            case 13:
                $cadena = $simboloMoneda.'                '. $numero;
                break;
            case 14:
                $cadena = $simboloMoneda.'               '. $numero;
                break;
            case 15:
                $cadena = $simboloMoneda.'              '. $numero;
                break;

            default:
                $cadena = $simboloMoneda.'default      cantidad'.$cantidad.'---'. $numero;
                break;
        }
        
        $this->Cell(40, 6, $cadena, 1, 1,'R');
    }
}



