<?php
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i], 0, $a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

// $this->Image('../img/stamp.jpeg',0,0,15,20)
    // $this->Image('../img/stamp.jpeg',0,0,15,20);
    // $this->Cell(20, 7,,0,1,"C");
function before_footer(){
    
  
   
    $this->SetFont('Times', '', 10);
    $this->Cell(155, 8, "", 0, 1, 'L');
    $this->Cell(165, 2, " Yours faithfully,", 0,1, 'L');
    $this->Ln();
    $this->SetFont('Arial', 'B', 9);
    $this->Cell(2, 3, "", 0, 0, 'L');
    $this->Cell(155, 3, "For  RAIL UDYOG", 0, 1, 'L');
   
  
 
    // $this->Image('../img/stamp.jpeg', 8, 200, 0, 0, 'jpeg');
   
    $this->SetFont('Arial', '', 9);
    $this->Cell(2, 30, "", 0, 1, 'L');
    $this->Multicell(0,5,"\n Authorised Signatory \n Mobile No. + 9163448508"); 
    $this->Ln();
}



function Footer(){

    // Position at 1.5 cm from bottom
    $this->SetY(-12);
    $this->cell(198,0,'',1,'C');
    // Arial italic 8
    $this->SetFont('Arial','',9);
    // $this->SetXY(10, 44);
    // $this->SetLineWidth(0.4);


$this->Cell(20, 2, "", "", 1, 'C');

$this->Cell(180, 5, "ASK-FOR Solutions ; 1 , Indra Roy Road , Kolkata - 700025", "", 1, 'C');
// $this->Cell(80, 5, "Phone : +91-9163448508, +91-9830429500", "", 0, 'C');
// $this->Cell(20, 5, "", "", 0, 'C');
// $this->Cell(60, 5, "Email : info@trackcomponent.com", "", 1, 'C');
// $this->ln();


// $this->Cell(20, 5, "", "", 0, 'C');
// $this->Cell(70, 5, "Website : www.trackcomponent.com", "", 0, 'C');
// $this->Cell(35, 5, "", "", 0, 'C');
// $this->Cell(60, 5, "        : ruhowrah@gmail.com", "", 1, 'C');
}




var $angle=0;

// function Rotate($angle,$x=-1,$y=-1)
function Rotate($angle,$x=null,$y=null)
{
    if($x==null)
        $x=$this->x;
    if($y==null)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}




function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}


// function RotatedImage($imagePath,$x,$y,$w,$h,$angle)
// {
    function RotatedImage($imagePath,$x,$y,$angle)
{
    
    //Image rotated around its upper-left corner
    $this->Rotate($angle,10, null);
    // $this->Image($file,$x,$y,$w,$h);
    // $this->Image($imagePath, 10, $w, $h);
    $this->Image($imagePath, 10, null, 33.78);
    $this->Rotate(0);
}




function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}






}
