<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\UserDocument;
use App\Libraries\Textlocal; // Import library
use CodeIgniter\HTTP\Request;

class UserController extends BaseController
{
    private $user;
    private $userdocument;
	private $session;
	private $textlocal;
	/**
	 * constructor
	 */
	public function __construct()
	{
		helper(['form', 'url', 'session','number']);
        $this->session = \Config\Services::session();
        
		$this->user = new User();
		$this->userdocument = new UserDocument();
		// $this->textlocal = new Textlocal();
		$this->session = session();
	}

    public function login()
    {
        if(!empty(session()->get('loggedIn'))){
			return redirect()->to('home'); 
		}
        return view('cms/login');
    }

    public function sendotp($seg = false){
        $response = [];
        $inputs = $this->validate([
			'mobile_number' => 'required|min_length[10]|max_length[10]'
		]);

		if (!$inputs) {
            $response = ['status'=> false, 'data' => '<h5>Please enter Valid Mobile Number</h5>'];
            $response_json = json_encode($response); 
			return $response_json;
		}
        $mobile_number = $this->request->getVar('mobile_number');

        // $apiKey = urlencode('YOUR_API_KEY');
        // $Textlocal = new Textlocal(false, false, $apiKey);
        $sender = 'PHPPOT';
        $otp = rand(100000, 999999);
        $message = "Your One Time Password is " . $otp;
        $user = $this->user->where(['mobile'=> $mobile_number,'access'=> 0])->first();
        
        if(!empty($user) && $user['mobile'] == $mobile_number){
            $user_update = $this->user->where('mobile', $mobile_number)//->first()
                    ->set('mobile_otp',$otp)
                    ->update();
            // $response = $Textlocal->sendSms($numbers, $message, $sender);
            $response = ['status'=> true, 'data' => view("cms/otp_view.php")];
        }  else {
            $response = ['status'=> false, 'data' => '<h5>Please enter Valid Mobile Number</h5>'];
        }
        $response_json = json_encode($response); 
        return  $response_json;         
    }

    public function verifyotp($seg = false){
        $inputs = $this->validate([
			'otp' => 'required|min_length[6]|max_length[6]',
			'action' => 'required',
		]);

		if (!$inputs) {
			$response = ['status'=> false, 'data' => '<h5>OTP not match</h5>'];
            $response_json = json_encode($response); 
			return $response_json;
		}
        $otp = $this->request->getVar('otp');
        $user = $this->user->where(['mobile_otp'=> $otp,'access'=> 0])->first();
        $response = [];
        if(!empty($user) && $user['mobile_otp'] === $otp){
            $sessionData = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'mobile' => $user['mobile'],
                'role' => $user['role'],
                'access' => $user['access'],
                'loggedIn' => true,
            ];

            $this->session->set($sessionData);
            $response = ['status'=> true, 'data' => '/home'];
        }  else {
            $response = ['status'=> false, 'data' => '<h5>OTP Not Match</h5>'];
           
        }
        $response_json = json_encode($response); 
        return $response_json;
    }

    public function home()
    {
        // print_r(session()->get('role'));die;
        if(empty(session()->get('loggedIn'))){
			return redirect()->to('login'); 
		}
        if(session()->get('role') == 'admin'){
            $data['users_data']  = $this->user->get_user_list();
            // $data['q'] = $this->user->reunquery();
        }else{
            $data['users_data']  = $this->user->get_user_doc_list();
        }
        // print_r($data);die;
        return view('cms/home_view',$data);
    }

    public function adduser()
    {
        // print_r(session()->get('role'));die;
        if(empty(session()->get('loggedIn'))){
			return redirect()->to('login'); 
		}
        return view('cms/adduser_view');
    }

    public function adduserstore()
    {
        // print_r(session()->get('role'));die;
        if(empty(session()->get('loggedIn'))){
			return redirect()->to('login'); 
		}

        $inputs = $this->validate([
			'name' => 'required|min_length[4]|max_length[40]',
			'mobile' => 'required|min_length[10]|max_length[10]'
		]);

		if (!$inputs) {
            return view('cms/adduser_view', [
				'validation' => $this->validator
			]);
		}
        $name = $this->request->getVar('name');
        $mobile = $this->request->getVar('mobile');

        $this->user->save([
			'name' => $name,
			'mobile'  => $mobile,
			'role'  => 'user',
			'access'  => 0,
		]);
		session()->setFlashdata('success', $name.'User Added successfully!');
		return redirect()->to(site_url('home'));
        
    }

    public function documentstore()
    {
        // print_r(session()->get('role'));die;
        if(empty(session()->get('loggedIn'))){
			return redirect()->to('login'); 
		}
        $file_document = $this->request->getFile('file_document');
        // $inputs = $this->validate([
		// 	'file_document' => 'required'
		// ]);

		// if (!$inputs) {
        //     return view('cms/adduser_view', [
		// 		'validation' => $this->validator
		// 	]);
		// }

        $file_document = $this->request->getFile('file_document');
        $file_content = file_get_contents($file_document->getTempName());
        // print_r($file_content);die;
        $this->userdocument->save([
			'uid' => session()->get('id'),
			'file_name'  => $file_document->getName(),
			'file_type'  => $file_document->getClientMimeType(),
			'file_content'  => $file_content,
			'access'  => 0,
		]);
		session()->setFlashdata('success', 'Document Added successfully!');
		return redirect()->to(site_url('home'));
    }

    /**
	 * User logout
	 * @param NA
	 */
	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('login');
	}
}
