<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function ubahpassword()
    {
        return view ('user.ubahpassword');
    }


    public function simpanpassword(Request $request)
    {

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|different:password_lama|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'konfirmasi_password' =>'required',
        ], [
            'password_lama.required' => 'Password saat ini wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'konfirmasi_password.required' => 'Konfirmasi password wajib diisi.',
            'password_baru.min' => 'Panjang kata sandi baru minimal 8 karakter.',
            'password_baru.different' => 'Kata sandi baru harus berbeda dengan kata sandi saat ini.',
            'password_baru.regex' => 'Password harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka.',
            8
        ]);

        $password= Auth()->user()->password;
        if (Hash::check($request->password_lama, $password)){
        }else{
        return redirect('ubahpassword')->with("password_lama","Password lama tidak cocok!");}  
        if ($request->password_baru == $request->konfirmasi_password){
        
        User::where('password', $password)->update([
                'password' => Hash::make($request['password_baru']),
                'must_change_password'  => $request->must_change_password
            ]);
        
            Alert::success('Selesai', 'Password berhasil diubah');
            return redirect('dashboard');
            
        }else{
           
            return redirect('ubahpassword')->with("konfirmasi_password","Password baru tidak cocok!");
        }
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
    public function user()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahUser()
    {
        return view('user.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpanUser(Request $request)
    {

       // return $request;

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level'     => 'required|string',
            'unit'     => 'required|string',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'unit' => $request->unit,
            'must_change_password' => $request->gantipwd,
        ]);

        return redirect('user');
        
    }



    public function resetPassword()
    {

       // $nama = DB::table('users')->get('username');
        $nama = DB::table('users')->orderBy('username', 'asc')->get();

        return view('user.resetPassword', ['nama'=> $nama]);

    }


    public function resetPasswordSimpan(Request $request)
    {

        $user = User::where('username', $request->username)
        ->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'must_change_password' => $request->must_change_password,
        ]);

        Alert::success('Selesai', 'Password berhasil direset!');
        return redirect('dashboard');

    }
    
    
}
