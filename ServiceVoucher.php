<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 21/02/2019
 * Time: 22:14
 */
class ServiceVoucher extends PdfWrite
{
	protected $mapData = array();

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
	 * @return mixed
	 */
	public function writeDataToPdf()
	{
		// TODO: Implement writeDataToPdf() method.
	}
}