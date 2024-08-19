<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Admin;
use Firebase\JWT\JWT;
use App\Utils\HttpResponse;
use Illuminate\Http\Request;
use App\Utils\HttpResponseCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BaseController;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    use HttpResponse;
    private $googleClient;

    public function __construct(){
        $this->googleClient = new \Google_Client();
        $this->googleClient->setRedirectUri(env('GOOGLE_REDIRECT'));
        $this->googleClient->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->googleClient->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");

    }


    public function adminLoginView(){
        $data['auth_url'] = $this->googleClient->createAuthUrl();
        $data['title'] = 'Login Page';
        $data['error'] = session('error');
        return view('admin.login',$data); //ubah jadi admin.login, $auth_url link e
    }

    public function adminLogin(Request $request){
        if(!$request->has('code')){
            return redirect()->route('admin.login')->with('error', 'Login Authentication Failed');
            }
            
            \Firebase\JWT\JWT::$leeway = 60;
            do{
                $attempt = 0;
            try{
                $token = $this->googleClient->fetchAccessTokenWithAuthCode($request->code);
                $payload = $this->googleClient->verifyIdToken($token['id_token']);
                
                if($token){
                    // check email mahasiswa petra
                    if(isset($payload['hd']) && str_ends_with($payload['hd'], 'john.petra.ac.id')){
                        $request->session()->put('email', $payload['email']);
                        $request->session()->put('nrp',substr($payload['email'],0,9));

                        //check apakah admin
                        $admin = Admin::where('email', $payload['email'])->get(); //->with('division')
                        if($admin->count() > 0){
                            if($admin->first()->status == 1 || $admin->first()->status == 0) {
                                $request->session()->put('admin_id', $admin->first()->id);
                                $request->session()->put('division_name',$admin->first()->division_name);
                                $request->session()->put('name', $admin->first()->name);
                                $request->session()->put('isAdmin',true);
                                return redirect()->route('admin.main');
                            } else {
                                return redirect()->route('admin.login')->with('error', 'You are not an admin');
                            }
                        }else{
                            // not admin
                            return redirect()->route('admin.login')->with('error', 'You are not an admin');
                        }

                    }else{
                        // error jika email bukan petra
                        return redirect()->route('admin.login')->with('error', 'Please Use Your @john.petra.ac.id email');
                    }
                }else{
                    // error kalau token tidak valid
                    return redirect()->route('admin.login')->with('error', 'Token is not valid');
                }
                $retry = false;

            }catch(\Firebase\JWT\BeforeValidException $e){
                $retry = $attempt < 2;
                $attempt++;
            }
        }while($retry);
    }
 
    public function logout(Request $request){
        $request->session()->flush();
        // return redirect()->to("/admin");
    }

    function getNameFromNRP(){
        $nrp = strtolower(session('nrp'));
        $res = Http::get('http://john.petra.ac.id/~justin/finger.php?s=' . $nrp);

        try {
            return $res->json()['hasil'][0]['nama'];
        }catch(\Exception $e){
            Log::warning('NRP {nrp} not found in john API.', ['nrp' => $nrp]);
            return "";
        }
        // tambahhkan pengecekan error
    }


    //login for team
    public function login(Request $request)
    {
        // dd($request->all());
        $creds = $request->only('team_name', 'password');
        $validate = Validator::make(
            $creds,
            [
                'team_name' => 'required',
                'password' => 'required',
            ],
            [
                'team_name.required' => 'team_name is required',
                'password.required' => 'Password is required',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        $team = Team::where('nama', $creds['team_name'])->first();
        // dd($team);
        if (!$team) {
            return $this->error('You are not a participant of IRGL 2024!', HttpResponseCode::HTTP_UNAUTHORIZED);
        }
        if (!Hash::check($creds['password'], $team->password)) {
            return $this->error('Invalid credentials', HttpResponseCode::HTTP_UNAUTHORIZED);
        }
        $team->tokens()->delete();
        $applicantToken = $team->createToken('hydra-api-token', ['applicant'])->plainTextToken;
        
        return $this->success([
            'token' => $applicantToken,
            'id' => $team->id,
            'team_name' => $team->nama,
        ]);
    }
}
