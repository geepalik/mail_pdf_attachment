<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 03/11/2018
 * Time: 7:33
 */
require_once 'PdfWrite.php';
class ShowVoucher extends PdfWrite
{

	/**
	 * @var array
	 */
	protected $mapData = array(
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

	/**
	 * ShowVoucher constructor.
	 *
	 * @param array $data
	 * @param $export
	 *
	 * @throws Exception
	 */
	public function __construct( array $data, $export )
	{
		try{
			$this->templateFileName = "voucher_template.pdf";
			parent::__construct( $data, $export );
		}catch (Exception $exception){
			throw new Exception($exception->getMessage());
		}
	}

	/**
	 * @return bool|mixed
	 * @throws Exception
	 */
	public function writeDataToPdf()
	{
		try{
			$this->writeData($this->mapDataLocation('full_name'),$this->data['client']['full_name']);
			$this->writeData($this->mapDataLocation('number_of_reservations'),$this->data['bookingData']['number_of_reservations']);
			$this->writeData($this->mapDataLocation('table'),$this->data['bookingData']['table']);
			$this->writeData($this->mapDataLocation('date_of_reservation'),$this->data['bookingData']['date_of_reservation']);
			$this->writeData($this->mapDataLocation('club_name'),$this->data['bookingData']['club_name']);
			$this->writeData($this->mapDataLocation('club_address'),$this->data['bookingData']['club_address']);
			$this->writeData($this->mapDataLocation('open_time'),$this->data['bookingData']['open_time']);
			$this->writeData($this->mapDataLocation('price'),$this->data['bookingData']['price']);
			$this->writeData($this->mapDataLocation('singers'),$this->data['bookingData']['singers']);

			$this->pdfClass->Output($this->exportFileName, "F");

			return $this->checkIfFileExists();

		}catch (Exception $exception){
			throw new Exception($exception->getMessage());
		}
	}
}