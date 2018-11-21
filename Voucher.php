<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 03/11/2018
 * Time: 7:33
 */
require_once 'PdfWrite.php';
class Voucher extends PdfWrite
{

	private $mapData = array(
		'full_name' => array("20","73.5"),
		'number_of_reservations' => array("85","73.5"),
		'table' => array("120","73.5"),
		'date_of_reservation' => array("165","73.5"),
		'club_name' => array("20","85"),
		'club_address' => array("20","90"),
		'open_time' => array("20","96.5"),
		'price' => array("20","103"),
		'singers' => array("20","108.5")
	);

	public function __construct( array $data, $filename, $export ) {
		parent::__construct( $data, $filename, $export );
	}

	private function mapDataLocation($key)
	{
		return $this->mapData[$key];
	}

	public function writeDataToPdf()
	{
		try{
			$fullNameCoords = $this->mapDataLocation('full_name');
			$reservesCoords = $this->mapDataLocation('number_of_reservations');
			$tableCoords = $this->mapDataLocation('table');
			$dateCoords = $this->mapDataLocation('date_of_reservation');
			$clubNameCoords = $this->mapDataLocation('club_name');
			$clubAddressCoords = $this->mapDataLocation('club_address');
			$clubOpenTimeCoords = $this->mapDataLocation('open_time');
			$clubPriceCoords = $this->mapDataLocation('price');
			$clubSingersCoords = $this->mapDataLocation('singers');

			$this->writeData($fullNameCoords,$this->data['client']['full_name']);
			$this->writeData($reservesCoords,$this->data['client']['number_of_reservations']);
			$this->writeData($tableCoords,$this->data['client']['table']);
			$this->writeData($dateCoords,$this->data['client']['date_of_reservation']);
			$this->writeData($clubNameCoords,$this->data['club']['club_name']);
			$this->writeData($clubAddressCoords,$this->data['club']['club_address']);
			$this->writeData($clubOpenTimeCoords,$this->data['club']['open_time']);
			$this->writeData($clubPriceCoords,$this->data['club']['price']);
			$this->writeData($clubSingersCoords,$this->data['club']['singers']);

			$this->pdfClass->Output($this->exportFileName, "F");

			return $this->checkIfFileExists();

		}catch (Exception $exception){
			return $exception->getMessage();
		}
	}
}