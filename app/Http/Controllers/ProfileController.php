<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Flash;
use Response;
use Hash;
use App\Models\companies;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepo;
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $companies = companies::pluck('socialname', 'id');
            }else{
            $companies = companies::where('id_user_master', auth()->user()->id_user_master)->pluck('socialname', 'id');
        }
    
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('home'));
        }

        return view('profile.showprofile')->with('user', $user)->with('user2', $user)->with('companies',$companies);
    }
    public function ChangeProfile(Request $request){
        
        $user = $this->userRepository->find(auth()->user()->id);
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('public/profile');
            $bodytag = str_replace("public/", "storage/",  $path );
            $input['logo']=$bodytag;
        }
        if(isset($user->logo)){
            $bodytag2 = str_replace("storage/", "public/",  $user->logo );
            Storage::delete($bodytag2);
        }
        $user->logo=$input['logo'];
        $user->save();
        return redirect(route('profile.show',auth()->user()->id));
    }
    public function cahnge_empresa($id,Request $request){
        $input=$request->all();
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect()->back()->with('error',"Su nueva contraseña fue enviada");
        }
        if(isset($input['empresa'])){
            $user->empresa=$input['empresa'];
            $user->save();
        }
       
        return redirect(route('profile.show',auth()->user()->id));

    }
    public function changepassw($id,Request $request){
        $data=$request->all();
        $validator = Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return redirect(route('profile.show',auth()->user()->id))
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = $this->userRepository->find($id);
        $user->password=Hash::make($data['password']);
        $user->save();
        return redirect(route('profile.show',auth()->user()->id));

    }

    
}
