<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('callerservice');
		$this->load->model('email_sending');
		$this->load->library('form_validation');
		$this->load->library('paypal_recurring_express');
		$this->load->library('pagination');

	}


public function getPayment()
{
	
	$transaction = $this->master_model->getRecords('tble_transaction',array('payment_method'=>'recurring','status'=>'active'));

	//$transaction = $this->master_model->getRecords('tble_transaction',array('login_id'=>171));

	require_once('PayPal.class.php');
	$username=API_USERNAME;
	$password=API_PASSWORD;
	$signature=API_SIGNATURE;
	$paypal = new PayPal('SANDBOX', $username, $password, $signature);
	
    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));

    foreach ($transaction as $trans)
     {
 			$user_id = $trans['login_id'];
		    $user = $this->master_model->getRecords('users',array('id'=>$user_id));
      
			$profileID=$trans['profile_id'];
			$profile = $paypal->getRecurringPaymentsProfileDetails($profileID);
			
			if(count($user)<=0)
			  continue;
			
			if(strtolower($profile['STATUS']) == "active")
			{
				if($profile['NUMCYCLESCOMPLETED'] == 0 || $profile['NUMCYCLESCOMPLETED'] == 1)
					continue;
				else
				{
					if($trans['no_of_cycle'] < $profile['NUMCYCLESCOMPLETED'])
					{
						$up_arr = array('next_pay_date' => date('y-m-d',strtotime($profile['NEXTBILLINGDATE'])),
										'no_of_cycle'	=> $profile['NUMCYCLESCOMPLETED']
										);
						$this->master_model->updateRecord('tble_transaction',$up_arr,array('id'=>$trans['id']));

						$up_arr_user =array('balance_amount'=>$user[0]['balance_amount']+$profile['AMT']);
						$this->master_model->updateRecord('users',$up_arr_user,array('id'=>$user_id));
						 
									     $this->db->select_sum('budget_amount');
						                 $this->db->select('tbl_ads_users.id,examination_id,budget_amount as amt,remianing_amount');
						                 $this->db->join('tblexamination','tblexamination.id = tbl_ads_users.examination_id');
						$getExamAmount = $this->master_model->getRecords('tbl_ads_users',array('login_id'=>$user_id,'tblexamination.status'=>1));
						$budget_amount = $getExamAmount[0]['budget_amount'];
						$user_message = "";
						$admin_message = "";
						$insert_arr = array('id_trans' => $trans['id'],
							 				'pay_date' => date('y-m-d',strtotime($profile['LASTPAYMENTDATE'])),
							 				'amount'   => $profile['AMT']
							 			   );
						$this->master_model->insertRecord('tbl_recurring_payments',$insert_arr);
						if($budget_amount <= $profile['AMT'])
						{
							$bill_amount = $profile['AMT'];
							foreach ($getExamAmount as $exam) 
							{
								$budget = $exam['amt'] + $exam['amt'];
								$up_arr_budget = array('budget_amount'    => $budget,
													   'remianing_amount' => $exam['remianing_amount']+$exam['amt']
									                   );
								$this->master_model->updateRecord('tbl_ads_users',$up_arr_budget,array('id'=>$exam['id']));
							}
							$user_message  = "Your automatic payment is done and it splited successfully for your examination.";
							$admin_message = "Automatic payment get and it splited successfully.";
							
						}
						else
						{
							$user_message  = "Your automatic payment is done but it less than your splited amount due to  we cant split amount. Please split your amount.";
							$admin_message = "Get automatic payment but can't it split because its splited amount is more than automatic payment.";
						}

						$info_arr  = array('from'    => $info_email[0]['info_email'],
		                	               'to'      => $user[0]['email'],
		                	               'subject' => 'Automatic payment done successfully.',
		                	               'view'    => 'payment_get_user'
		                	               );
		                $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
		                				   'pay_type'   => $trans['type'],
		                				   'amount'     => $trans['amount'],
		                				   'message'	=> $user_message
		                				   );

		               
		                $info_arr1  = array('from'      => $info_email[0]['info_email'],
		                	                'to'        => $admin_email[0]['email'],
		                	                'subject'   => 'Automatic payment done successfully',
		                	                'view'      => 'payment_get_admin'
		                	                );
		                $other_arr1 = array('user_name' => $user[0]['firstname']." ".$user[0]['lastname'],
		                					'pay_type'  => $trans['type'],
		                					'amount'    => $trans['amount'],
		                					'email'     => $user[0]['email'],
		                					'message'	=> $admin_message
		                					);
		           
		            	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
		            	{

		            	}
					}
				}

			}
			else
			{
			    $this->master_model->updateRecord('tble_transaction',array('status'=>'cancelled'),array('id'=>$trans['id']));
                $info_arr  = array('from'    => $info_email[0]['info_email'],
                	               'to'      => $getSess['email'],
                	               'subject' => 'Automatic payment cancelled.',
                	               'view'    => 'payment_status_user'
                	               );
                $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
                				   'pay_type'   => $trans['type'],
                				   'amount'     => $trans['amount']
                				   );

               
                $info_arr1  = array('from'      => $info_email[0]['info_email'],
                	                'to'        => $admin_email[0]['email'],
                	                'subject'   => 'Automatic payment cancelled',
                	                'view'      => 'payment_status_admin'
                	                );
                $other_arr1 = array('user_name' => $user[0]['firstname']." ".$user[0]['lastname'],
                					'pay_type'  => $trans['type'],
                					'amount'    => $trans['amount'],
                					'email'     => $user[0]['email']
                					);
           
            	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
            	{

            	}

			}

	}

	

}







public function chk_recprofile_status()
	{
		// Include API credentials
		//require_once('credentials.php');
		// Include and instantiate the API
		require_once('PayPal.class.php');
		$username='khanimran16-developer_api1.gmail.com';
		$password='1400761491';
		$signature='AFcWxV21C7fd0v3bYYYRCpSSRl31A2QZBqJUvrat4aBQxuBJhkmya.sL';
		$paypal = new PayPal('SANDBOX', $username, $password, $signature);
		$this->db->group_by('profileId');
		$bookingArr = $this->master_model->getRecords('tbl_booking_master','','profileId');
		$rec=count($bookingArr);
		for($i=0;$i<$rec;$i++)
		{
			if($bookingArr[$i]['profileId']!="")
			{
				$profileID=$bookingArr[$i]['profileId'];
				$profile = $paypal->getRecurringPaymentsProfileDetails($profileID);
				$upProfileId=$profile['PROFILEID'];
				$upProfileSts=$profile['STATUS'];
				$editArray = array('profileStatus'=>$upProfileSts);
				//$condArray=array('profileId'=>$upProfileId);
				$qry="UPDATE `tbl_booking_master` SET `profileStatus` = '".$upProfileSts."' WHERE `profileId`='".$upProfileId."'";
				$this->db->query($qry);
				//$this->master_model->updateRecord('tbl_booking_master',$editArray,array('profileId'=>htmlentities($profile['PROFILEID'])));
				//echo $this->db->last_query();
			}
		}
		echo 'done';
		
	}



















public function cancel_profile($profile_id,$trans_id)
{
	require_once('PayPal.class.php');
	$username=API_USERNAME;
	$password=API_PASSWORD;
	$signature=API_SIGNATURE;
	$paypal = new PayPal('SANDBOX', $username, $password, $signature);
	//$this->db->group_by('profileId');
	
    $profileID= $profile_id;
    //$profileID = "I-1UW3UWA7N4PL";
	$action='Cancel';
	$nvpStr="&PROFILEID=$profileID&ACTION=$action";
	/* Make the API call to PayPal, using API signature.
	The API response is stored in an associative array called $resArray */
	$resArray=$this->callerservice->hash_call("ManageRecurringPaymentsProfileStatus",$nvpStr);

	if($resArray == TRUE)
	{
		$this->master_model->updateRecord('tble_transaction',array('status'=>'cancelled'),array('id'=>$trans_id));
		//$this->session->set_flashdata('success',"Your automatic payment cancelled successfully.");
		return true;
	}
	else
		return false;


}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>
