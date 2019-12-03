<?php
/**
 * Created by PhpStorm.
 * User: Gil
 * Date: 09/02/2019
 * Time: 14:02
 */
class VoucherFactory
{
	/**
	 * @param $bookingType
	 * @param array $data
	 * @param $export
	 *
	 * @return ServiceVoucher|ShowVoucher|TransferVoucher
	 * @throws Exception
	 */
	public static function generateVoucher($bookingType, array $data, $export)
	{
		switch ($bookingType){
			case 'show':
				return new ShowVoucher($data, $export);
				break;
			case 'service':
				return new ServiceVoucher($data, $export);
				break;
			case 'transfer':
				return new TransferVoucher($data, $export);
				break;
			default:
				throw new Exception("Unknown booking type data passed: ".$bookingType);
				break;
		}
	}
}