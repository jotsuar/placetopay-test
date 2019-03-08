<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {


	public function add() {
		if ($this->request->is('post')) {
			$this->Session->write("productoUSer",$this->request->data["User"]);
			$person = $this->User->create_person($this->request->data["User"]);
			$this->Session->write("Person",$person);
			$this->redirect(array("controller" => "payments","action"=>"add"));
		}
	}


}
