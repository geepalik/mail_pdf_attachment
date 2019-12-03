<?php
class TransferVoucher extends PdfWrite
{
	protected $mapData = array(
		'full_name' => array("139","47"),
		'date_time_arrival' => array("95","47"),
		'date_time_departure' => array("52","47"),
		'hotel_reservation' => array("12","47"),
		'flight_number_arrival' => array("139","68"),
		'arrival_pickup_location' => array("95","68"),
		'arrival_dropoff_location' => array("52","68"),
		'arrival_passengers_number' => array("12","68"),
		'flight_number_departure' => array("139","88"),
		'departure_pickup_location' => array("95","88"),
		'departure_dropoff_location' => array("52","88"),
		'departure_passengers_number' => array("12","88"),
		'price' => array("12","112"),
	);

	public function __construct( array $data, $export )
	{
		try{
			$this->templateFileName = "transfer_voucher_template.pdf";
			parent::__construct( $data, $export );
		}catch (Exception $exception){
			throw new Exception($exception->getMessage());
		}
	}

	/**
	 * @return bool|mixed
	 * @throws Exception
	 */
	public function writeDataToPdf() {
		try{
			$this->writeData($this->mapDataLocation('full_name'),$this->data['client']['full_name']);
			$this->writeData($this->mapDataLocation('hotel_reservation'),$this->data['bookingData']['hotel_reservation']);
			$this->writeData($this->mapDataLocation('flight_number_arrival'),$this->data['bookingData']['flight_number_arrival']);
			$this->writeData($this->mapDataLocation('date_time_arrival'),$this->data['bookingData']['date_time_arrival']);
			$this->writeData($this->mapDataLocation('date_time_departure'),$this->data['bookingData']['date_time_departure']);
			$this->writeData($this->mapDataLocation('arrival_pickup_location'),$this->data['bookingData']['arrival_pickup_location']);
			$this->writeData($this->mapDataLocation('arrival_dropoff_location'),$this->data['bookingData']['arrival_dropoff_location']);
			$this->writeData($this->mapDataLocation('arrival_passengers_number'),$this->data['bookingData']['arrival_passengers_number']);

			$this->writeData($this->mapDataLocation('flight_number_departure'),$this->data['bookingData']['flight_number_departure']);
			$this->writeData($this->mapDataLocation('departure_pickup_location'),$this->data['bookingData']['departure_pickup_location']);
			$this->writeData($this->mapDataLocation('departure_dropoff_location'),$this->data['bookingData']['departure_dropoff_location']);
			$this->writeData($this->mapDataLocation('departure_passengers_number'),$this->data['bookingData']['departure_passengers_number']);
			$this->writeData($this->mapDataLocation('price'),$this->data['bookingData']['price']);

			$this->pdfClass->Output($this->exportFileName, "F");

			return $this->checkIfFileExists();

		}catch (Exception $exception){
			throw new Exception($exception->getMessage());
		}
	}
}