<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends AppBaseController
{
    /** @var $userRepository UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $users = User::SELECT('*')->get();
        }else{
            $users = User::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->get();
        }
    
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        
        $usuarioscon=DB::table('users')->whereRaw("id=id_user_master")->pluck('email', 'id');
        $usuarioscon->prepend('Cuenta Empresarial' , '0');
        return view('users.create')->with('usuarioscon',$usuarioscon)->with('editar',1);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==1){
            
        }else{
        $input['id_user_master']=auth()->user()->id_user_master;
        }

        $input['logo']='';
        $input['active']=1;
        if( $input['id_user_master']==0){
            $id=User::insertGetId([
                'password'=>$input['password'],
                'active'=>$input['active'],
                'role'=>$input['role'],
                'email'=>$input['email'],
                'name'=>$input['name'],
                'logo'=>''
            ]);
            $Users = User::find($id);
            $Users->id_user_master= $id;
            $Users->is_master= true;
            $Users->save();
        }else{
        $user = $this->userRepository->create($input);
        }
        Flash::success('Usuario Creado.');

        return redirect(route('users.index'));
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $encontrado=DB::table('users')->where('email',  $request->all()['email'])->first();
        if(empty($encontrado)){
            return back()->withErrors([
                'email' => 'No cuentas con este correo.',
            ])->onlyInput('email');  
        }else{
            if($encontrado->id_user_master===0 && $encontrado->is_master){

            }else{
                $datoBusquedaEmpresarial=DB::table('users')->where('id',  $encontrado->id_user_master)->where('active',1)->first(); 
                if(empty($datoBusquedaEmpresarial)){
                    return back()->withErrors([
                        'email' => 'La cuenta empresarial esta desactivada es necesario que hable con el administrador.',
                    ])->onlyInput('email');
                }else if($encontrado->active===0){
                    return back()->withErrors([
                        'email' => 'La cuenta esta desactivada.',
                    ])->onlyInput('email');
                }
            }
 
        }
       if (Auth::attempt(['email' => $request->all()['email'], 'password' => $request->all()['password'], 'active' => 1])) {
            $request->session()->regenerate();
            return redirect(route('home'));
        }
 
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
        
    }
    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $user = $this->userRepository->find($id);
        }else{
            $user = User::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }

        if (empty($user)) {
            Flash::error('User No encontrado');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $user = $this->userRepository->find($id);
                }else{
            $user = User::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
                 }
        
        if (empty($user)) {
            Flash::error('User No encontrado');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $user = $this->userRepository->find($id);
        }else{
            $user = User::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }

        if (empty($user)) {
            Flash::error('User No encontrado');

            return redirect(route('users.index'));
        }
        $input =  $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
        $input['id_user_master']=auth()->user()->id_user_master;
        }
        $user = $this->userRepository->update($input, $id);

        Flash::success('Usuario actualizado.');

        return redirect(route('users.index'));
    }
    public function forgetpassword(Request $request)
{
    $input = $request->all();
    $user = User::where('email', $input['email'])->get();

    if (count($user)<1) {
        $email['email']['message']='Este correo electronico no existe';
        return redirect()
        ->back()
        ->withErrors($email)
        ->withInput();
    }

    $passwordNueva=Str::random(8);
    $password['password'] = Hash::make($passwordNueva);	
    $dato['pass']=$passwordNueva;
    $dato['user']=$user[0]->name;
    Mail::send(['html' => 'users.mail'], ['dato'=>$dato], function($message)use ($input) {
        $message->to( $input['email'] ,'')->subject('FIXYBO - Contraseña Nueva');
        $message->from(env('MAIL_USERNAME') , env('MAIL_FROM_NAME'));
    });
    User::whereId( $user[0]->id)->update($password);
    return redirect()->back()->with('status',"Su nueva contraseña fue enviada");
}
    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $user = $this->userRepository->find($id);
        }else{
            $user = User::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($user)) {
            Flash::error('User No encontrado');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('Usuario eliminado.');

        return redirect(route('users.index'));
    }
}
