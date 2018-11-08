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
		'full_name' => array("65","61.5"),
		'number_of_reservations' => array("115","61.5"),
		'table' => array("145","61.5"),
		'date_of_reservation' => array("165","61.5"),
		'club_name' => array("143","73"),
		'club_address' => array("135","79"),
		'open_time' => array("140","85"),
		'price' => array("143","92"),
		'singers' => array("130","97")
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
	}
}