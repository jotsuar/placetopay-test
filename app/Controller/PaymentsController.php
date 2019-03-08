<?php
App::uses('AppController', 'Controller');
/**
 * Payments Controller
 *
 * @property Payment $Payment
 * @property PaginatorComponent $Paginator
 */
class PaymentsController extends AppController {


	public function add() {
	
	    $person_info 	= $this->Session->read("Person");

	    if (is_null($person_info)) {
	    	$this->redirect(array("controller"=>"users","action"=>"add"));
	    }

		$reference = md5(uniqid());

		$data = $this->Session->read("productoUSer");

		$producto = Configure::read("Productos.{$data['producto']}");

		
		$request = [
			'payer' => $this->Payment->Transaction->User->create_person($data),
			'buyer' => $this->Payment->Transaction->User->create_person($data),
		    'payment' => [
		        'reference' => $reference,
		        'description' => "Pago de productos electrónicos - {$producto}",
		        'amount' => [
		            'currency' => 'COP',
		            'total' => $data['producto'],
		        ],
		    ],
		    'expiration' => date('c', strtotime('+2 days')),
		    'returnUrl' => Router::url("/",true)."payments/terminate/" . $reference,
		    'ipAddress' => $this->getUserIp(),
		    'userAgent' => $_SERVER['HTTP_USER_AGENT'],
		];

		$user_id = $this->Payment->Transaction->User->createUser($data);

		$transaction = array(
			"Transaction" => array(
				"reference" => $reference,
				"value" => $data['producto'],
				"state" => "PENDING",
				"user_id" => $user_id,
				"request_initial" => json_encode($request)
			)
		);

		$result 	= $this->Payment->create_transaction($request);

		$transaction["Transaction"]["request_id"] = $result->requestId;

		$this->Payment->Transaction->create();
		$this->Payment->Transaction->save($transaction);
		$this->redirect($result->processUrl);

	}


	private function getUserIp(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	public function terminate($reference){

		$requestUrl = "https://test.placetopay.com/redirection/";

		$refer = strpos($this->request->referer(), $requestUrl);

		if ($refer === false) {
			$this->redirect("/");
		}

		$this->Payment->Transaction->recursive = -1;

		$paymentInfo = array();

		$transaction = $this->Payment->Transaction->findByReference($reference);

		$response =  $this->Payment->get_transaction_information($transaction["Transaction"]["request_id"]);

		$this->Payment->deleteAll(array('Payment.transaction_id' => $transaction["Transaction"]["id"]), false);

		$paymentInfo = end($response->payment);

		foreach ($response->payment as $key => $payment) {

			$paymentData =  array(
				"Payment" => array(
					"transaction_id" 	=> $transaction["Transaction"]["id"],
					"state"			 	=> $payment->status()->status(),
					"internalReference" => $payment->internalReference(),
					"paymentMethod"		=> $payment->paymentMethod(),
					"paymentMethodName"	=> $payment->paymentMethodName(),
					"issuerName"		=> $payment->issuerName(),
					"receipt"			=> $payment->receipt(),
					"reference"	        => $payment->internalReference(),
					"franchise"			=> $payment->franchise(),
					"authorization"		=> $payment->authorization(),
					"amount_from"		=> $payment->amount()->from()->total(),
					"amount_to"			=> $payment->amount()->to()->total(),
					"date_payment"		=> date("Y-m-d H:i:s",strtotime($payment->status()->date())),
					"response" 		    => json_encode($payment)
				)
			);
			$this->Payment->create();
			$this->Payment->save($paymentData);

			if ( $payment->status()->status() == "APPROVED") {
				$paymentInfo = $payment;
			}
		}

		$transaction["Transaction"]["state"] 		= $response->status()->status();
		$transaction["Transaction"]["modified"] 	= date("Y-m-d H:i:s",strtotime($response->status()->date()));

		$this->Payment->Transaction->id = $transaction["Transaction"]["id"];
		$this->Payment->Transaction->save($transaction);

		$this->set(compact("response","paymentInfo"));

	}


	public function getRealIP()
    { 
      if (isset($_SERVER["HTTP_CLIENT_IP"])){
         return $_SERVER["HTTP_CLIENT_IP"];
      }
      elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
         return $_SERVER["HTTP_X_FORWARDED_FOR"];
      }
      elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
         return $_SERVER["HTTP_X_FORWARDED"];
      }
      elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
         return $_SERVER["HTTP_FORWARDED_FOR"];
      }
      elseif (isset($_SERVER["HTTP_FORWARDED"])){
         return $_SERVER["HTTP_FORWARDED"];
      }
      else{
         return $_SERVER["REMOTE_ADDR"];
      }
    }

}
