<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for Users
 */
class Users extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'User' );
	}	

	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{
		// call parent convert object
		parent::convert_object( $obj );

		// convert customize category object
		$this->ps_adapter->convert_user( $obj );
	}
	
	/**
	 * Users Registration
	 */
	function add_post()
	{
		// validation rules for user register
		$rules = array(
			array(
	        	'field' => 'user_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'user_email',
	        	'rules' => 'required|valid_email|callback_email_check'
	        ),
	        array(
	        	'field' => 'user_password',
	        	'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $user_data = array(
        	"user_name" => $this->post('user_name'), 
        	"user_email" => $this->post('user_email'), 
        	'user_password' => md5($this->post('user_password')),
        	"device_token" => $this->post('device_token')
        );

        if ( !$this->User->save($user_data)) {

        	$this->error_response( get_msg( 'err_user_register' ));
        }

        $this->custom_response($this->User->get_one($user_data["user_id"]));

	}

	/**
	 * Users Registration with Facebook
	 */
	function register_post()
	{
		$rules = array(
			array(
	        	'field' => 'user_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'facebook_id',
	        	'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        //Need to check facebook_id is aleady exist or not?
        if ( !$this->User->exists( 
        	array( 
        		'facebook_id' => $this->post( 'facebook_id' ) 
        		))) {
        
            //User not yet exist 
        	$fb_id = $this->post( 'facebook_id' ) ;
			$url = "https://graph.facebook.com/$fb_id/picture?width=350&height=500";
		  	$data = file_get_contents($url);
		  	
		  	
		  	$dir = "uploads/";
			$img = md5(time()).'.jpg';
		  	$ch = curl_init($url);
			$fp = fopen( 'uploads/'. $img, 'wb' );
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);


			////

			$user_data = array(
	        	"user_name" 	=> $this->post('user_name'), 
	        	'user_email'    => $this->post('user_email'), 
	        	"facebook_id" 	=> $this->post('facebook_id'),
	        	"user_profile_photo" => $img
        	);

        	if ( !$this->User->save($user_data)) {
        		$this->error_response( get_msg( 'err_user_register' ));
        	}

        	$this->custom_response($this->User->get_one($user_data["user_id"]));

        } else {

        	//User already exist in DB
        	$conds['facebook_id'] = $this->post( 'facebook_id' );
        	$user_profile_photo = $this->User->get_one_by($conds['facebook_id'])->user_profile_photo;

        	//Delete existing image 
        	@unlink('./uploads/'.$user_profile_photo);
			
			//Download again
			$fb_id = $this->post( 'facebook_id' ) ;
			$url = "https://graph.facebook.com/$fb_id/picture?width=350&height=500";
		  	$data = file_get_contents($url);
		  	
		  	
		  	$dir = "uploads/";
			$img = md5(time()).'.jpg';
		  	$ch = curl_init($url);
			$fp = fopen( 'uploads/'. $img, 'wb' );
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);

			$user_data = array(
				'user_name'    	=> $this->post('user_name'), 
				'user_email'    => $this->post('user_email'), 
				'profile_photo' => $img,	
			);

			if ( !$this->User->save($user_data,$this->post( 'facebook_id' ))) {
        		$this->error_response( get_msg( 'err_user_register' ));
        	}

        	$this->custom_response($this->User->get_one($user_data["user_id"]));

        }


	}

	/**
	 * Users Registration with Google
	*/
	function google_register_post()
	{
		$rules = array(
			array(
	        	'field' => 'user_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'google_id',
	        	'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        //Need to check google_id is aleady exist or not?
        if ( !$this->User->exists( 
        	array( 
        		'google_id' => $this->post( 'google_id' ) 
        		))) {
        
            //User not yet exist 
        	$gg_id = $this->post( 'google_id' ) ;
			$url = $this->post('profile_photo_url');
		  	$data = file_get_contents($url);
		  	
		  	
		  	$dir = "uploads/";
			$img = md5(time()).'.jpg';
		  	$ch = curl_init($url);
			$fp = fopen( 'uploads/'. $img, 'wb' );
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);

			$user_data = array(
	        	"user_name" 	=> $this->post('user_name'), 
	        	'user_email'    => $this->post('user_email'), 
	        	"google_id" 	=> $this->post('google_id'),
	        	"user_profile_photo" => $img
        	);

        	if ( !$this->User->save($user_data)) {
        		$this->error_response( get_msg( 'err_user_register' ));
        	}

        	$this->custom_response($this->User->get_one($user_data["user_id"]));

        } else {

        	//User already exist in DB
        	$conds['google_id'] = $this->post( 'google_id' );
        	$user_profile_photo = $this->User->get_one_by($conds['google_id'])->user_profile_photo;

        	//Delete existing image 
        	@unlink('./uploads/'.$user_profile_photo);
			
			//Download again
			$fb_id = $this->post( 'google_id' ) ;
			$url = $this->post('profile_photo_url');
		  	$data = file_get_contents($url);
		  	
		  	
		  	$dir = "uploads/";
			$img = md5(time()).'.jpg';
		  	$ch = curl_init($url);
			$fp = fopen( 'uploads/'. $img, 'wb' );
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);

			$user_data = array(
				'user_name'    	=> $this->post('user_name'), 
				'user_email'    => $this->post('user_email'), 
				'user_profile_photo' => $img,	
			);

			if ( !$this->User->save($user_data,$this->post( 'google_id' ))) {
        		$this->error_response( get_msg( 'err_user_register' ));
        	}

        	$this->custom_response($this->User->get_one($user_data["user_id"]));

        }


	}


	/**
	 * Email Checking
	 *
	 * @param      <type>  $email     The identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	function email_check( $email )
    {

        if ( $this->User->exists( array( 'user_email' => $email ))) {
        
            $this->form_validation->set_message('email_check', 'Email Exist');
            return false;
        }

        return true;
    }

    /**
	 * Users Login
	 */
	function login_post()
	{
		// validation rules for user register
		$rules = array(
			
	        array(
	        	'field' => 'user_email',
	        	'rules' => 'required|valid_email'
	        ),
	        array(
	        	'field' => 'user_password',
	        	'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        if ( !$this->User->exists( array( 'user_email' => $this->post( 'user_email' ), 'user_password' => $this->post( 'user_password' )))) {
        
            $this->error_response( get_msg( 'err_user_not_exist' ));
        }
        $user_info = $this->User->get_one_by( array( "user_email" => $this->post( 'user_email' )));
        $user_id = $user_info->user_id;
        $data = array(
			
			'device_token' => $this->post('device_token')
		);
		$this->User->save($data,$user_id);

        $this->custom_response($this->User->get_one_by(array("user_email" => $this->post('user_email'))));
	}

	/**
	* User Reset Password
	*/
	function reset_post()
	{
		// validation rules for user register
		$rules = array(
	        array(
	        	'field' => 'user_email',
	        	'rules' => 'required|valid_email'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $user_info = $this->User->get_one_by( array( "user_email" => $this->post( 'user_email' )));

        if ( isset( $user_info->is_empty_object )) {
        // if user info is empty,
        	
        	$this->error_response( get_msg( 'err_user_not_exist' ));
        }

        // generate code
        $code = md5(time().'teamps');

        // insert to reset
        $data = array(
			'user_id' => $user_info->user_id,
			'code' => $code
		);

		if ( !$this->ResetCode->save( $data )) {
		// if error in inserting,

			$this->error_response( get_msg( 'err_model' ));
		}

		// Send email with reset code
		$to = $user_info->user_email;
	    $subject = 'Password Reset';
		$msg = "<p>Hi,". $user_info->user_name ."</p>".
					"<p>Please click the following link to reset your password<br/>".
					"<a href='". site_url( $this->config->item( 'reset_url') .'/'. $code ) ."'>Reset Password</a></p>".
					"<p>Best Regards,<br/>". $this->config->item('sender_name') ."</p>";

		// send email from admin
		if ( ! $this->ps_mail->send_from_admin( $to, $subject, $msg ) ) {

			$this->error_response( get_msg( 'err_email_not_send' ));
		}
		
		$this->success_response( get_msg( 'success_email_sent' ));
	}

	/**
	* User Profile Update
	*/

	function profile_update_post()
	{

		// validation rules for user register
		$rules = array(
			array(
	        	'field' => 'user_id',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'user_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'user_email',
	        	'rules' => 'required|valid_email'
	        ),
	        array(
	        	'field' => 'user_phone',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'user_about_me',
	        	'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        
        $user_data = array(
        	"user_name"     		=> $this->post('user_name'), 
        	"user_email"    		=> $this->post('user_email'), 
        	"user_phone"    		=> $this->post('user_phone'),
        	"user_about_me" 		=> $this->post('user_about_me'),
        	"billing_first_name" 	=> $this->post('billing_first_name'),
        	"billing_last_name"		=> $this->post('billing_last_name'),
        	"billing_company"		=> $this->post('billing_company'),
        	"billing_address_1"		=> $this->post('billing_address_1'),
        	"billing_address_2"		=> $this->post('billing_address_2'),
        	"billing_country"		=> $this->post('billing_country'),
        	"billing_state"			=> $this->post('billing_state'),
        	"billing_city"			=> $this->post('billing_city'),
        	"billing_postal_code"	=> $this->post('billing_postal_code'),
        	"billing_email"			=> $this->post('billing_email'),
        	"billing_phone"			=> $this->post('billing_phone'),
        	"shipping_first_name"	=> $this->post('shipping_first_name'),
        	"shipping_last_name"	=> $this->post('shipping_last_name'),
        	"shipping_company"		=> $this->post('shipping_company'),
        	"shipping_address_1"	=> $this->post('shipping_address_1'),
        	"shipping_address_2"	=> $this->post('shipping_address_2'),
        	"shipping_country"		=> $this->post('shipping_country'),
        	"shipping_state"		=> $this->post('shipping_state'),
        	"shipping_city"			=> $this->post('shipping_city'),
        	"shipping_postal_code"	=> $this->post('shipping_postal_code'),
        	"shipping_email"		=> $this->post('shipping_email'),
        	"shipping_phone"		=> $this->post('shipping_phone')

            );

        if ( !$this->User->save($user_data, $this->post('user_id'))) {

        	$this->error_response( get_msg( 'err_user_update' ));
        }

        $this->success_response( get_msg( 'success_profile_update' ));

	}

	/**
	* User Profile Update
	*/
	function password_update_post()
	{

		// validation rules for user register
		$rules = array(
			array(
	        	'field' => 'user_id',
	        	'rules' => 'required|callback_id_check[User]'
	        ),
	        array(
	        	'field' => 'user_password',
	        	'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $user_data = array(
        	"user_password"     => md5($this->post('user_password'))
        );

        if ( !$this->User->save($user_data, $this->post('user_id'))) {
        	$this->error_response( get_msg( 'err_user_password_update' )); 
        }

        $this->success_response( get_msg( 'success_profile_update' ));

	}
}