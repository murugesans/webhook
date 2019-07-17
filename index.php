<?php
    $post = file_get_contents('php://input');
    if($post) {
    	$array = json_decode($post);
		if($array->event_type == 'PAYMENT.SALE.COMPLETED' || $array->event_type == 'PAYMENT.SALE.DENIED'|| $array->event_type == 'PAYMENT.SALE.PENDING'|| $array->event_type == 'PAYMENT.SALE.REFUNDED'|| $array->event_type == 'PAYMENT.SALE.REVERSED') {
	 		file_put_contents('Sales_logs'.date("Y-m-d").'.txt', $post.PHP_EOL , FILE_APPEND | LOCK_EX);
	 		file_put_contents('Sales_headerlogs'.date("Y-m-d").'.txt', $_SERVER , FILE_APPEND | LOCK_EX);
		}elseif($array->event_type == 'PAYMENT.PAYOUTSBATCH.SUCCESS' || $array->event_type == 'PAYMENT.PAYOUTSBATCH.DENIED' || $array->event_type == 'PAYMENT.PAYOUTSBATCH.PROCESSING'){
		    file_put_contents('payouts_logs'.date("Y-m-d").'.txt', $post.PHP_EOL , FILE_APPEND | LOCK_EX);
		}elseif($array->event_type == 'CUSTOMER.DISPUTE.CREATED' || $array->event_type == 'CUSTOMER.DISPUTE.RESOLVED' || $array->event_type == 'CUSTOMER.DISPUTE.UPDATED'){
		    file_put_contents('disputes_logs'.date("Y-m-d").'.txt', $post.PHP_EOL , FILE_APPEND | LOCK_EX);
		}elseif($array->event_type == 'BILLING_AGREEMENTS.AGREEMENT.CREATED' || $array->event_type == 'BILLING_AGREEMENTS.AGREEMENT.CANCELLED' || $array->event_type == 'BILLING_AGREEMENTS.AGREEMENT.CANCEL_PENDING'){
		    file_put_contents('BA'.date("Y-m-d").'.txt', $post.PHP_EOL , FILE_APPEND | LOCK_EX);
		}
    } else {
    	echo 'Send POST.';
    }	
?>
