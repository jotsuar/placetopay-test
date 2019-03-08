<?php
date_default_timezone_set('America/Bogota');
date_default_timezone_set('America/Bogota');
ini_set('max_execution_time', 180);
ini_set("default_socket_timeout", 180);

App::uses('AppModel', 'Model');
/**
 * Payment Model
 *
 */
class Payment extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	
	public $belongsTo = array(
		'Transaction' => array(
			'className' => 'Transaction',
			'foreignKey' => 'transaction_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public $validate = array(
		'id_reference' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'transaction_date' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);


    public function create_transaction($request){
    	$placetopay = new Dnetix\Redirection\PlacetoPay(Configure::read("PLACETOPAY"));
    	return $placetopay->request($request);
    }

    public function get_transaction_information($id){
    	$placetopay = new Dnetix\Redirection\PlacetoPay(Configure::read("PLACETOPAY"));
    	return $response = $placetopay->query($id);
    	
    }

    


}
