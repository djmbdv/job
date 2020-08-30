<?php 

/* 
	Valores de atributos de la tabla
		campo => {ordenable, comparable, filtrable}
*/

class model_user{
	function constructor(){
		$this->table = "tbl_users";
		$this->columns = [
			'first_name' =>[true,true, true],
			'last_name'=>[false, false, false],
			'gender'   =>[false, false, false],
			'bdate'    =>[false, false, false],
			'bmonth'   =>[false, false, false],
			'byear'    =>[false, false, false],
			'email'    => [true,true,false],
			'education'=> [false, false, false],
			'title'    => [false, false, false],
			'city'     => [false, false, false],
			'street'   => [true, false, false],
			'zip'      => [false, false, false],
			'country'  => [true, true, true],
			'phone'    => [true, false, false],
			'about'    => [false, false, false],
			'avatar'   => [false,false, false],
			'services' => [false, false, false],
			'expertise'=> [false, false, false],
			'people'   => [false, false, false],
			'role'     => [false, false, false],
			'website'  => [true ,true, false], 
			'login'     => [true ,false, false],
			'member_no' => [true ,true , false],
			'verified'  => [true ,false, true ],
			'created_at'=>[true, false, false]
		];
	}


}