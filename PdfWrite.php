<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 03/11/2018
 * Time: 7:23
 */

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParserException;

require __DIR__ . '/vendor/autoload.php';

abstract class PdfWrite
{
	protected $data = array();
	protected $filename;
	protected $exportFileName;
	protected $pdfClass;

	public function __construct(array $data, $filename, $export)
	{
		$this->data = $data;
		$this->filename = $filename;
		$this->exportFileName = $export;
		$this->pdfClass = new Fpdi();
		$this->initPdf();
	}

	private function initPdf()
	{
		$this->pdfClass->AddPage();
		try{
			$this->pdfClass->setSourceFile($this->filename);
		}catch ( PdfParserException $pdfException){
			echo "Pdf Error: ".$pdfException;
		}
		try{
			$template = $this->pdfClass->importPage(1);
			$this->pdfClass->useTemplate($template, 0, 0, 210, 297);
			$this->pdfClass->SetFont('Helvetica','',14); // Font Name, Font Style (eg. 'B' for Bold), Font Size
			$this->pdfClass->SetTextColor(0,0,0); // RGB
		}catch (Exception $exception){
			echo "Error: ".$exception;
		}
	}

	protected function writeData(array $coords, $string)
	{
		$this->pdfClass->SetXY($coords[0],$coords[1]);
		$this->pdfClass->Write(0,$string);
	}

	abstract public function writeDataToPdf();

	public function checkIfFileExists()
	{
		return file_exists($this->exportFileName);
	}
}