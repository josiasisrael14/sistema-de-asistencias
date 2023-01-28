<?PHP
require_once (APPPATH .'libraries/fpdf17/fpdf.php');
require_once (APPPATH .'libraries/Numletras.php');
Class Comprobante{
   
    private $comprobante;        
    private $items;
    public function __construct($cmp){
        $this->comprobante = $cmp;        
    }
            
    public function PDF($items){                          
        $this->items = $items; 
        $tipDoc = $this->comprobante['tipo_documento_id'];        
        switch ($tipDoc) {
            case 1 : $documento = 'FACTURA ELECTRONICA';break;
            case 3 : $documento = 'BOLETA ELECTRONICA';break;
            case 7 : $documento = 'NOTA CREDITO';break;
            case 8 : $documento = 'NOTA DEBITO';break;
            default:break;
        }        
        
        $pdf = new FPDF();
        $pdf->AddPage();   
        
        //CABECERA LOGO + DATOS DE EMPRESA
        if($this->comprobante['empresa_id'] == '1')
        $pdf->Image(APPPATH."files_pdf/tytl.png",10,21,40,30,'PNG');
        if($this->comprobante['empresa_id'] == '2')
        $pdf->Image(APPPATH."files_pdf/asesorandina.png",10,23,70,25,'PNG');
        
        $pdf->SetFont('Arial','B',8);$leftCabecera = 50;
        $pdf->SetXY($leftCabecera,25);
        $pdf->MultiCell(90,7,utf8_decode('ESTUDIO TORRES Y TORRES LARA & ASOCIADOS - ABOGADOS S.CIVIL DE R.L. JR. Cañon del Pato 103 - Surco - Lima - Perú Central Telefónica: (051) 6181515 www.tytl.com.pe'),0,'C');
                
        //CABECERA1
        $pdf->SetFont('Arial','B',10);$leftCabecera = 140;
        $pdf->RoundedRect($leftCabecera, 25, 60, 10, 2, '12', '');
        $pdf->SetXY($leftCabecera,25);$pdf->CellFitSpace(60, 10,  utf8_decode("R.U.C. N° ".$this->comprobante['ruc']),0, 1,'C');
        $pdf->SetX($leftCabecera);$pdf->Cell(60,10,$documento,1,1,'C');
        $pdf->RoundedRect($leftCabecera, 45, 60, 10, 3, '34', ''); 
        $pdf->SetX($leftCabecera);$pdf->CellFitSpace(60, 10, utf8_decode('N° '.$this->comprobante['serNum']),0,1,"C");
        
        //CABECERA2
        $topCabecera = 55;$pdf->SetXY(10, $topCabecera);        
        $pdf->Cell(40,7,  utf8_decode('Señor(es)'),0,0);
        $pdf->Cell(40,7,  utf8_decode(': '.$this->comprobante['razon_social']),0,1);
        $pdf->Cell(40,7,'Direccion: ',0,0);
        $pdf->MultiCell(170,7,': '.utf8_decode($this->comprobante['cli_domicilio1']),0,1);
        $pdf->Cell(40,7,  utf8_decode('R.U.C'),0,0);
        $pdf->Cell(20,7,  ': '.  $this->comprobante['rucCliente'],0,1);
        $pdf->Cell(40,7,'Fecha de Emision :',0,0);
        $pdf->Cell(40,7,': '.  $this->comprobante['fecha_de_emision'],0,1);
        $pdf->Cell(40,7,'Fecha de Vencimiento',0,0);
        $pdf->Cell(40,7,': '.$this->comprobante['fecha_de_vencimiento'],0,1);
        $pdf->Cell(40,7,'Moneda: ',0,0);
        $pdf->Cell(20,7,': '.strtoupper(utf8_decode($this->comprobante['moneda'])),0,1);
        
        //CUERPO
        $topCuerpo = 72;$pdf->Ln(2);$topCuerpo = 102;        
        $pdf->SetXY(10, $topCuerpo);
        $pdf->Cell(10, 10, '-', 1, 0,'C');        
        $pdf->Cell(140,10,'DESCRIPCION',1,0,'C');        
        $pdf->CellFitSpace(40, 10, 'IMPORTE', 1,1,'C');$topCuerpo = 112;
                                
        foreach ($this->items as $value) {            
            $pdf->SetXY(10, $topCuerpo);$pdf->Cell(10, 50, '-', 'LR', 0, 'C');
            $pdf->SetXY(20,$topCuerpo+8);
            $pdf->MultiCell(140, 7, utf8_decode($value['descripcion']), 0, 'C', false);
            $pdf->SetXY(160, $topCuerpo);$pdf->Cell(40,50,$value['subtotal'],'LR',1,'C');
            $topCuerpo += 20;
        }                       
        //PIE DE CUERPO        
        $topPie = $topCuerpo+30;        
        $pdf->SetXY(10, $topPie);//$pdf->RoundedRect(10, $topPie, 10, 10, 2, '4','');        
        $pdf->CellFitSpace(10,10, ' ','LB',0,'C');
        $pdf->Cell(140, 10, '', 'LB', 0, 'C');
        $pdf->Cell(40, 10, '','LBR',1,'C');
        
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
        $pdf->Cell(150,10,'SON: '.$importe_letra.' CON ' .$dec_tot.'/100 '.strtoupper(utf8_decode($this->comprobante['moneda'])),0,1,'L');                
        //PIE DE CUERPO SUBTOTALES Y TOTALES                                                
        $pdf->SetX(120);$pdf->Cell(40,6,'Op.Gravada',1,0);$pdf->Cell(40, 6,$this->comprobante['total_gravada'], 1,1);
        $pdf->SetX(120);$pdf->Cell(40,6,'Op.Exonerada',1,0);$pdf->Cell(40, 6,$this->comprobante['total_exonerada'], 1,1);
        $pdf->SetX(120);$pdf->Cell(40,6,'Op.Inafecta',1,0);$pdf->Cell(40, 6, $this->comprobante['total_inafecta'], 1,1);
        $pdf->SetX(120);$pdf->Cell(40,6,'I.G.V',1,0);$pdf->Cell(40, 6,$this->comprobante['total_igv'], 1,1);
        $pdf->SetX(120);$pdf->Cell(40,6,'Otros Cargos',1,0);$pdf->Cell(40, 6,$this->comprobante['total_otros_cargos'], 1,1);
        $pdf->SetX(120);$pdf->Cell(40,6,'Importe Total',1,0);$pdf->Cell(40, 6, $this->comprobante['total_a_pagar'], 1,1);        
        //CODIGO SUNAT
        $pdf->Ln(2);
        $pdf->Cell(180,10,  $this->comprobante['desSunat'],0,1,'C');
        //FINAL VISTA PDF                      
        if($this->comprobante['desSunat'] !== 0){
        
        $pdf->SetFont('Arial','B',9);        
        $pdf->Cell(180,10,'Al realizar el abono agradeceremos escanear el voucher y remitirlo al correo cobranzas@tytl.com.pe. ',0,1,'C');                
                
        $pdf->Cell(40,7,'BANCO', 'LT', 0,'C');        
        $pdf->Cell(40,7,'MONEDA','T',0,'C');
        $pdf->Cell(50,7,'CUENTA', 'T',0,'C');
        $pdf->Cell(60,7,'CODIGO INTERBANCARIO', 'RT',1,'C');
        
        $pdf->Cell(40,7,'BBVA','L',0,'C');
        $pdf->Cell(40,7,'SOLES',0,0,'C');
        $pdf->Cell(50,7,'0011-0160-0200315236',0,0,'C');
        $pdf->Cell(60,7,'011-160-000200315236-96','R',1,'C');
        
        $pdf->Cell(40,7,'BCP','L',0,'C');
        $pdf->Cell(40,7,'SOLES',0,0,'C');
        $pdf->Cell(50,7,'194-1983239-0-15',0,0,'C');
        $pdf->Cell(60,7,'002-194-001983239015-97','R',1,'C'); 
                
        $pdf->Cell(40,7,'BBVA ','L',0,'C');
        $pdf->Cell(40,7,'DOLARES',0,0,'C');
        $pdf->Cell(50,7,'0011-0160-0200315244',0,0,'C');
        $pdf->Cell(60,7,'011-160-000200315244-90','R',1,'C');
        
        $pdf->Cell(40,7,'BCP ','LB',0,'C');
        $pdf->Cell(40,7,'DOLARES','B',0,'C');
        $pdf->Cell(50,7,'194-1967757-1-41','B',0,'C');
        $pdf->Cell(60,7,'002-194-001967757141-96','RB',1,'C');            
            if($this->comprobante['vista'] == '0'){
                $pdf->Output();
            } else {
                $pdf->Output(APPPATH."files_pdf/comprobantes/".  $this->comprobante['cliente_id'].  $this->comprobante['comprobante_id'].".pdf");            
            }
        } else{
            $pdf->Output(APPPATH."files_pdf/comprobantes/".  $this->comprobante['cliente_id'].  $this->comprobante['comprobante_id'].".pdf");
        }        
    }   
}

