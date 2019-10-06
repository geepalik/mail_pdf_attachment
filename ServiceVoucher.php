<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 21/02/2019
 * Time: 22:14
 */
class ServiceVoucher extends PdfWrite
{
	protected $mapData = array(
		'full_name' => array("170","44"),
		'number_of_reservations' => array("25","44"),
		'service_start_date' => array("110","44"),
		'service_return_date' => array("60","44"),
		'driver_name_pickup_1' => array("151","55"),
		'pickup_location_1' => array("96","55"),
		'dropoff_location_1' => array("47","55"),
		'vehicle_type' => array("13","55"),
		'driver_name_pickup_2' => array("151","66"),
		'pickup_location_2' => array("96","66"),
		'dropoff_location_2' => array("47","66"),
		'price' => array("20","66"),
	);

	public function __construct( array $data, $export )
	{
		try{
			$this->templateFileName = "service_voucher_template.pdf";
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
			$this->writeData($this->mapDataLocation('service_start_date'),$this->data['bookingData']['service_start_date']);
			$this->writeData($this->mapDataLocation('service_return_date'),$this->data['bookingData']['service_return_date']);
			$this->writeData($this->mapDataLocation('driver_name_pickup_1'),$this->data['bookingData']['driver_name_pickup_1']);
			$this->writeData($this->mapDataLocation('pickup_location_1'),$this->data['bookingData']['pickup_location_1']);
			$this->writeData($this->mapDataLocation('dropoff_location_1'),$this->data['bookingData']['dropoff_location_1']);
			$this->writeData($this->mapDataLocation('vehicle_type'),$this->data['bookingData']['vehicle_type']);
			$this->writeData($this->mapDataLocation('driver_name_pickup_2'),$this->data['bookingData']['driver_name_pickup_2']);
			$this->writeData($this->mapDataLocation('pickup_location_2'),$this->data['bookingData']['pickup_location_2']);
			$this->writeData($this->mapDataLocation('dropoff_location_2'),$this->data['bookingData']['dropoff_location_2']);
			$this->writeData($this->mapDataLocation('price'),$this->data['bookingData']['price']);

			$this->pdfClass->Output($this->exportFileName, "F");

			return $this->checkIfFileExists();

		}catch (Exception $exception){
			throw new Exception($exception->getMessage());
		}
	}
}