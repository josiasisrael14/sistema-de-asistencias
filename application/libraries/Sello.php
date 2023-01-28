<?PHP //if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once (APPPATH .'libraries/fpdf17/rotation/rotation.php');
require_once (APPPATH .'libraries/Numletras.php');


class Sello extends PDF_Rotate{    
    private $comprobante;        
    private $items;
    private $tnota;
    private $cadjunto;
    private $cuentas;

    public function __construct($cmp){
            parent::__construct();
            $this->comprobante = $cmp;            
    }
    
    function Header(){
        //Put the watermark
        $this->SetFont('Arial','B',50);
        $this->SetTextColor(255,192,203);
        $this->RotatedText(35,190,'DOCUMENTO ANULADO',45);
    }

    function RotatedText($x, $y, $txt, $angle){
        //Text rotated around its origin
        $this->Rotate($angle,$x,$y);
        $this->Text($x,$y,$txt);
        $this->Rotate(0);
    }
    
    public function GenerarComprobante($items,$tnota,$cadjunto,$cuentas = '') {
        $this->items = $items;
        $this->tnota = $tnota;
        $this->cadjunto = $cadjunto;
        
        $this->AddPage();
        $this->SetTitle("Facturacion Electronica");        
        $this->cabecera();
        
        //CUERPO        
        $this->SetX(10);
        $this->Cell(10, 10, 'N', 1, 0,'C');        
        $this->Cell(140,10,'DESCRIPCION',1,0,'C');        
        $this->CellFitSpace(40, 10, 'IMPORTE', 1,1,'C');//$topCuerpo = 112;
        //        
        //                
        foreach ($this->items as $value) {
            $hCuerpo = $this->y;            
            $string = strlen($value['descripcion']); 
            //echo $string;
            
            if($string < 30){
                $h = 15;
                $hTextoValing = $hCuerpo + $h/2;
            } else if ($string < 250){
                $h = 20;                                    
                $hTextoValing = $hCuerpo + $h/3;
            } else{
                $h = 32;                                    
                $hTextoValing = $hCuerpo;
            }            
            $this->SetX(10);
            $this->Cell(10, $h, $value['cantidad'], 'LR', 0, 'C');
                        
            $this->SetXY(20,$hTextoValing);
            $this->MultiCell(140,7, utf8_decode($value['descripcion']),0,'C');            
            $this->SetXY(160,$hCuerpo);
            $this->Cell(40,$h,  $this->comprobante['simbolo'].' '.number_format($value['subtotal'],2),'LR',1,'C');
        }                       
        
        //PIE DE CUERPO                
        $this->SetX(10);
        $this->CellFitSpace(10,10, ' ','LB',0,'C');
        $this->Cell(140, 10, '', 'LB', 0, 'C');
        $this->Cell(40, 10, '','LBR',1,'C');
        
        //MONTO EN LETRAS
        $num = new Numletras();    
        $importe_letra = $num->num2letras(intval($this->comprobante['total_a_pagar']));

        $cad = number_format($this->comprobante['total_a_pagar'], 2, ".", ",");
        $lon = strlen($cad);
        for ($i = $lon; $i > 0; $i--) {
            $let = substr($cad, $i, 1);
            if ($let == ".") {
                $dec_tot = substr($cad, ($i + 1), ($lon - $i - 1));
                $i = 0;
            }
        }
        $this->Cell(150,10,'SON: '.$importe_letra.' con ' .$dec_tot.'/100 '.utf8_decode($this->comprobante['moneda']),0,1,'L');
        //PIE DE CUERPO SUBTOTALES Y TOTALES        
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
        $this->SetX(120);$this->Cell(40,6,'Importe Total',1,0);$this->formatoTotal($this->comprobante['simbolo'], $this->comprobante['total_a_pagar']);
                
        //DETRACCION
        $extra = '';        
        if(($this->comprobante['codigo'] == "3000") || ($this->comprobante['codigo'] == "3001")){            
            $extra = "': ".$cuentas[$this->comprobante['empresa_id']][3][1]['cuenta'];
        }
        
        $this->Ln(2);
        if($this->comprobante['detraccion'] == 1){
            $this->Cell(10,8, '', 0, 0, 'C');
            $this->Cell(100,8, utf8_decode('Operación sujeta al sistema de Pago de Obligaciones Tributarias SPOT'),0, 1, 'C');
            //$this->Cell(20,8, 'Tipo', 1, 0, 'C');
            $this->Cell(110,8,  utf8_decode($this->comprobante['elemento_adicional_descripcion']).$extra,1,0,'C');        
            $this->Cell(20,8,'%'.$this->comprobante['porcentaje_de_detraccion'],1,0,'C');
            $this->Cell(40,8, 'Total Detraccion:', 1, 0, 'C');
            $this->Cell(20,8,  'S/ '.number_format($this->comprobante['total_detraccion'],2,'.',''),1,1,'C');
        } 
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
            $this->Cell(180,10, 'RSunat - '.$this->comprobante['desSunat'],0,1,'C');
        
        
        //OPERACION GRATUITA
        $this->Ln(2);
        if($this->comprobante['operacion_gratuita'] == 1)
            $this->Cell (180,10, 'TRANSFERENCIA GRATUITA DE UN BIEN Y/O SERVICIO PRESTADO GRATUITAMENTE',0,1,'C');
                        
                
        ///////////////////////////////////////
        //$this->cuentaBancos($cuentas, $this->comprobante['empresa_id']);
        if($this->comprobante['vista'] == '0'){
             $this->Output();
        } else {
             if($this->comprobante['envValidacion'] > 0)
             //$this->cuentaBancos($cuentas, $this->comprobante['empresa_id']);
             $this->Output(APPPATH."files_pdf/comprobantes/".  $this->comprobante['cliente_id'].  $this->comprobante['comprobante_id'].".pdf");
        }                 
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
            $this->Image(APPPATH."files_pdf/logo_empresa.png",10,22,50,32,'PNG');    
            $titele = 'ESTUDIO TORRES Y TORRES LARA & ASOCIADOS - ABOGADOS S.CIVIL DE R.L. JR. Cañon del Pato 103 - Surco - Lima - Perú Central Telefónica: (051) 6181515 www.tytl.com.pe';
        }
        
        if($this->comprobante['empresa_id'] == '2'){
            //$this->Image(APPPATH."files_pdf/logoFacturaElectronioAsesorandina450.png",10,23,90,38,'PNG');
            //$titele = 'ASESORANDINA SRL                                                                        CAÑON DEL PATO 103 - SURCO - LIMA - PERU';
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
//        
        //Cabecera2
        $topCabecera = 55;$this->SetXY(10, $topCabecera);        
        
        //$this->MultiCell(120,7,utf8_decode($titele),0,'C');
        
        $this->Cell(40,10,  '',0,1);
        $this->Cell(40,7,  utf8_decode('Señor(es)'),0,0);
        
        
        if($this->comprobante['tipo_cliente_id'] == 1){
            //$this->Cell(40,7,  utf8_decode(': '.$this->comprobante['cli_razon_social'].' '.$this->comprobante['cli_nombres']),0,1);    
            $this->MultiCell(160,7,': '.utf8_decode($this->comprobante['cli_razon_social'].' '.$this->comprobante['cli_nombres']),0,1);
        }else{
            //$this->Cell(40,7,  utf8_decode(': '.$this->comprobante['cli_razon_social_sunat']),0,1);    
            $this->MultiCell(160,7,': '.utf8_decode($this->comprobante['cli_razon_social_sunat']),0,1);
        }
        
        $this->Cell(40,7,'Direccion',0,0);
        $this->MultiCell(160,7,': '.utf8_decode($this->comprobante['cli_domicilio1']),0,1);
        $this->Cell(40,7,  utf8_decode('R.U.C'),0,0);
        $this->Cell(20,7,  ': '.  $this->comprobante['rucCliente'],0,1);
        $this->Cell(40,7,'Fecha de Emision',0,0);
        $this->Cell(40,7,': '.  $this->comprobante['fecha_de_emision'],0,1);
        //$this->Cell(40,7,'Fecha de Vencimiento',0,0);
        //$this->Cell(40,7,': '.$this->comprobante['fecha_de_vencimiento'],0,1);
        $this->Cell(40,7,'Moneda',0,0);
        $this->Cell(20,7,': '.strtoupper(utf8_decode($this->comprobante['moneda'])),0,1);                                
    }
    
    public function cuentaBancos($cuentas, $empresa_id) {        
        //$this->SetFont('Arial','B',9);
        $this->Cell(180,10,'Al realizar el abono agradeceremos escanear el voucher y remitirlo al correo cobranzas@tytl.com.pe. ',0,1,'C');                
                
        $this->Cell(40,6,'BANCO', 'LT', 0,'C');        
        $this->Cell(40,6,'MONEDA','T',0,'C');
        $this->Cell(50,6,'CUENTA', 'T',0,'C');
        $this->Cell(60,6,'CODIGO INTERBANCARIO', 'RT',1,'C');
        
        $this->Cell(40,6,'BBVA','L',0,'C');
        $this->Cell(40,6,'SOLES',0,0,'C');
        $this->Cell(50,6,$cuentas[$empresa_id][2][1]['cuenta'],0,0,'C');
        $this->Cell(60,6,$cuentas[$empresa_id][2][1]['interbancario'],'R',1,'C');
        
        $this->Cell(40,6,'BCP','L',0,'C');
        $this->Cell(40,6,'SOLES',0,0,'C');
        $this->Cell(50,6,$cuentas[$empresa_id][1][1]['cuenta'],0,0,'C');
        $this->Cell(60,6,$cuentas[$empresa_id][1][1]['interbancario'],'R',1,'C');
        
        
        if(isset($cuentas[$empresa_id][1][2]['cuenta'])){
            $i = "L";
            $ii = 0;
            $iii = 0;
            $iiii = "R";
        }else{
            $i = "LB";
            $ii = "B";
            $iii = "B";
            $iiii = "RB";
        }
                
        $this->Cell(40,6,'BBVA ',$i,0,'C');
        $this->Cell(40,6,'DOLARES',$ii,0,'C');
        $this->Cell(50,6,$cuentas[$empresa_id][2][2]['cuenta'],$iii,0,'C');
        $this->Cell(60,6,$cuentas[$empresa_id][2][2]['interbancario'],$iiii,1,'C');
        
        if(isset($cuentas[$empresa_id][1][2]['cuenta'])){
            $this->Cell(40,6,'BCP ','LB',0,'C');
            $this->Cell(40,6,'DOLARES','B',0,'C');
            $this->Cell(50,6,$cuentas[$empresa_id][1][2]['cuenta'],'B',0,'C');
            $this->Cell(60,6,$cuentas[$empresa_id][1][2]['interbancario'],'RB',1,'C');
        }        
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



