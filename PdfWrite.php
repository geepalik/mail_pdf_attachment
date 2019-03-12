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
	const EXPORT_FOLDER = 'pdfs/';

	protected $data = array();
	protected $templateFileName;
	protected $exportFileName;
	protected $pdfClass;
	protected $mapData = array();

	/**
	 * PdfWrite constructor.
	 *
	 * @param array $data
	 * @param $export
	 *
	 * @throws Exception
	 */
	public function __construct(array $data, $export)
	{
		$this->data = $data;
		$this->exportFileName = $export;
		$this->pdfClass = new Fpdi();
		$this->initPdf();
	}

	/**
	 * @throws Exception
	 */
	private function initPdf()
	{
		$this->pdfClass->AddPage();
		try{
			$this->pdfClass->setSourceFile($this->templateFileName);
		}catch ( PdfParserException $pdfException){
			throw new Exception($pdfException->getMessage());
		}
		try{
			$template = $this->pdfClass->importPage(1);
			$this->pdfClass->useTemplate($template, 0, 0, 210, 297);
			$this->pdfClass->SetFont('Helvetica','',14); // Font Name, Font Style (eg. 'B' for Bold), Font Size
			$this->pdfClass->SetTextColor(0,0,0); // RGB
		}catch (Exception $exception){
			throw new Exception($exception->getMessage());
		}
	}

	/**
	 * @param array $coords
	 * @param $string
	 */
	protected function writeData(array $coords, $string)
	{
		$string = iconv('utf-8','cp1252',$string);
		$this->pdfClass->SetXY($coords[0],$coords[1]);
		$this->pdfClass->Write(0,$string);
	}

	
	/**
	 * @return mixed
	 */
	abstract public function writeDataToPdf();

	/**
	 * @return bool
	 */
	public function checkIfFileExists()
	{
		return file_exists($this->exportFileName);
	}

	/**
	 * @param $key
	 *
	 * @return mixed
	 */
	protected function mapDataLocation($key)
	{
		return $this->mapData[$key];
	}
}