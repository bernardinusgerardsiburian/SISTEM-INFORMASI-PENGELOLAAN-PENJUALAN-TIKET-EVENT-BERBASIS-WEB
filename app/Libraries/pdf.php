<?php
namespace App\Libraries;

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';
class pdf{
    protected $pdf;

    function __construct(){
        $this->pdf = new Dompdf();
    }

    function generate($html,$filename,$size = 'A4',$orientation='portrait'){
        $this->pdf->setPaper($size,$orientation);
		$this->pdf->loadHtml($html);
		$this->pdf->render();
		return $this->pdf->stream($filename, array("Attachment" => false));
    }
}