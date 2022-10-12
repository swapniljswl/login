<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	public function __construct($rules = array())
	{
	    parent::__construct($rules);
	    date_default_timezone_set('Asia/Kolkata');
	}


	public function valid_date($date,$format='d-m-Y')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) === $date;
	}	
	public function is_dt_greater_than($dt1,$dt2)
	{
		if($dt2=='current_date')
			$dt2=date('Y-m-d');
		else if($dt2=='current_date_time')
			$dt2=date('Y-m-d H:i');
		else
			$dt2=$this->_field_data[$dt2]['postdata'];
		
		return (date_create($dt1)>date_create($dt2))?true:false;
	}
	public function is_dt_greater_than_or_equal_to($dt1,$dt2)
	{
		if($dt2=='current_date')
			$dt2=date('Y-m-d');
		else if($dt2=='current_date_time')
			$dt2=date('Y-m-d H:i');
		else
			$dt2=$this->_field_data[$dt2]['postdata'];

		return (date_create($dt1)>=date_create($dt2))?true:false;
	}
	public function is_dt_less_than($dt1,$dt2)
	{
		if($dt2=='current_date')
			$dt2=date('Y-m-d');
		else if($dt2=='current_date_time')
			$dt2=date('Y-m-d H:i');
		else
			$dt2=$this->_field_data[$dt2]['postdata'];
		return (date_create($dt1)<date_create($dt2))?true:false;
	}

	public function validate_data($data,$rule)
	{
		$this->reset_validation();
		$this->set_data($data);
		// $this->set_rules($rules);
		if($this->run($rule)==FALSE)
			return false;
		else
			return true;
	}
}