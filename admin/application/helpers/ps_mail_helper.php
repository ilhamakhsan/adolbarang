<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Send Booking Request Email to hotel
 * @param  [type] $booking_id [description]
 * @return [type]             [description]
 */
if ( !function_exists( 'send_transaction_order_emails' )) {

	function send_transaction_order_emails( $trans_header_id, $to_who = "", $subject = "" )
	{
		// get ci instance
		$CI =& get_instance();
		
		$shop_obj = $CI->Shop->get_all()->result();

		$shop_id = $shop_obj[0]->id;



		$trans_header_obj = $CI->Transactionheader->get_one($trans_header_id);

		$shop_name = $CI->Shop->get_one($shop_id)->name;

		$shop_email = $CI->Shop->get_one($shop_id)->email;

		$trans_currency = $CI->Shop->get_one($shop_id)->currency_symbol;

		$user_email =  $CI->User->get_one($trans_header_obj->added_user_id)->user_email;

		//bank info 
		$bank_account = $CI->Shop->get_one($shop_id)->bank_account;
		$bank_name = $CI->Shop->get_one($shop_id)->bank_name;
		$bank_code = $CI->Shop->get_one($shop_id)->bank_code;
		$branch_code = $CI->Shop->get_one($shop_id)->branch_code;
		$swift_code = $CI->Shop->get_one($shop_id)->swift_code;


		$bank_info  = "Bank Account : " . $bank_account . " <br> " .
					"Bank Name : " . $bank_name . " <br> " .
					"Bank Code : " . $bank_code . " <br> " .
					"Branch Code : " . $branch_code . " <br> " .
		            "Swift Code : " . $swift_code . " <br><br> " ;

		//For Payment Method 
		$payment_info = "";
		if($trans_header_obj->payment_method == "COD") {
			$payment_info = "Payment Method : Cash On Delivery";
		} else if($trans_header_obj->payment_method == "PAYPAL") {
			$payment_info = "Payment Method : Paypal";
		} else if($trans_header_obj->payment_method == "STRIPE") {
			$payment_info = "Payment Method : Stripe";
		} else if($trans_header_obj->payment_method == "BANK") {
			$payment_info = "Payment Method : Bank Transfer <br>" . $bank_info;
		}


		$conds['transactions_header_id'] = $trans_header_obj->id;

		$trans_details_obj = $CI->Transactiondetail->get_all_by($conds)->result();

		//For Transaction Detials
		for($i=0;$i<count($trans_details_obj);$i++) 
		{
				if($trans_details_obj[$i]->product_attribute_id != "") {
					

					$att_name_info  = explode("#", $trans_details_obj[$i]->product_attribute_name);
					
					$att_price_info = explode("#", $trans_details_obj[$i]->product_attribute_price);

					$att_info_str = "";
					$att_flag = 0;
					if( count($att_name_info[0]) > 0 ) {

						//loop attribute info
						for($k = 0; $k < count($att_name_info); $k++) {
							
							if($att_name_info[$k] != "") {
								$att_flag = 1;
								$att_info_str .= $att_name_info[$k] . " : " . $att_price_info[$k] . "(". $trans_currency ."),";

							}
						}


					} else {
						$att_info_str = "";
					}

					$att_info_str = rtrim($att_info_str, ","); 

					


					$order_items .= $i + 1 .". " . $trans_details_obj[$i]->product_name . 
					" (Price : " .   $trans_details_obj[$i]->original_price  . html_entity_decode($trans_currency) . 
					", QTY : " . $trans_details_obj[$i]->qty . ") {". $att_info_str ."}<br>";





				} else {
					
					$order_items .= $i + 1 .". " . $trans_details_obj[$i]->product_name . 
					" (Price : " .   $trans_details_obj[$i]->original_price  . html_entity_decode($trans_currency) . 
					", QTY : " . $trans_details_obj[$i]->qty . ") <br>";
					
				}
				
				$sub_total_amt += $trans_details_obj[$i]->original_price * $trans_details_obj[$i]->qty;
				
				
		}


		//Shop or User
		if($to_who == "shop") {
		
			$to = $shop_email;

		} else if ($to_who == "user") {

			$to = $user_email;

		}

		$trans_status = $CI->Transactionstatus->get_one($trans_header_obj->trans_status_id)->title;


		$billing_name = $trans_header_obj->billing_first_name . " " . $trans_header_obj->billing_last_name;
		$shipping_name = $trans_header_obj->shipping_first_name . " " . $trans_header_obj->shipping_last_name;

		$total_amt = $total_amount .' ' . html_entity_decode($trans_currency);

		$coupon_discount_amount = $trans_header_obj->coupon_discount_amount;
		$tax_amount = $trans_header_obj->tax_amount;
		$shipping_method_amount = $trans_header_obj->shipping_method_amount;
		$shipping_tax_amount = $trans_header_obj->shipping_method_amount * $trans_header_obj->shipping_tax_percent;

		$total_balance_amount = (($trans_header_obj->sub_total_amount - $trans_header_obj->coupon_discount_amount) + ($trans_header_obj->tax_amount + $trans_header_obj->shipping_method_amount + ($trans_header_obj->shipping_method_amount * $trans_header_obj->shipping_tax_percent)));  	

		$msg = <<<EOL
<p>Hi {$shop_name},</p>

<p>New Order is received with following information.</p>

<p>
Trans. Code : {$trans_header_obj->trans_code}<br/>
</p>

<p>
Trans. Status : {$trans_status}<br/>
</p>

<p>
{$payment_info}<br/>
</p>

<p>
Billing Customer Name : {$billing_name}<br/>
</p>

<p>
Billing Address 1 : {$trans_header_obj->billing_address_1}<br/>
</p>

<p>
Billing Address 2 : {$trans_header_obj->billing_address_2}<br/>
</p>

<p>
Billing Phone : {$trans_header_obj->billing_phone}<br/>
</p>

<p>
Billing Email : {$trans_header_obj->billing_email}<br/>
</p>

<p>
Billing Shipping Name : {$shipping_name}<br/>
</p>

<p>
Shipping Address 1 : {$trans_header_obj->shipping_address_1}<br/>
</p>

<p>
Shipping Address 2 : {$trans_header_obj->shipping_address_2}<br/>
</p>

<p>
Shipping Phone : {$trans_header_obj->shipping_phone}<br/>
</p>

<p>
Shipping Email : {$trans_header_obj->shipping_email}<br/>
</p>

<p>
Memo: {$trans_header_obj->memo}
</p>


<p>Product details information at below :</p>
{$order_items}


<p>
Sub Total : {$sub_total_amt} {$trans_currency}
</p>
<p>
Coupon Discount Amount(-) : {$coupon_discount_amount} {$trans_currency}
</p>
<p>
Overall Tax(+) : {$tax_amount} {$trans_currency}
</p>
<p>
Shipping Cost(+) : {$shipping_method_amount} {$trans_currency}
</p>
<p>
Shipping Tax(+) : {$shipping_tax_amount} {$trans_currency}
</p>
<p>
Total Balance Amount : {$total_balance_amount} {$trans_currency}
</p>


<p>
Best Regards,<br/>
{$sender_name}
</p>
EOL;
		
		// print_r($to); echo "<br><br>";
		// print_r($subject);   echo "<br><br>";
		// print_r($msg); echo "<br><br>";
		// echo "---------";

		
		

		// send email from admin
		return $CI->ps_mail->send_from_admin( $to, $subject, $msg );
	}
}

