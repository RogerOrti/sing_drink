<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariController extends Controller
{

    public function showLogin(){
        return view("auth.login");
    }

    public function SobreNosotros(){
        return view("quiSom.quisom");
    }
    public function Home(){
        return view("proves.index");
    }

    public function login(Request $request){

        $nomUsuari = $request->input('username');
        $contrasenya = $request->input('password');

        $usuari = Usuari::where('username',$nomUsuari)->first();

        if($usuari != null && Hash::check($contrasenya, $usuari->contrasenya)){
            Auth::login($usuari);
            $response = redirect('/');
        }
        else{
            $request->session()->flash('error','Usuari o contrasenya incorrectes');
            $response = redirect('/');
        }

        return $response;
    }

    public function logout(){

        Auth::logout();
        return redirect('/');
    }
    public function showRegister(){

        return view("auth.register");
    }

    public function register(Request $request){

        $usuari = new Usuari();

        $usuari = $request->input("username");
        $usuari = $request->input("username");
        $usuari = $request->input("username");
        $usuari = $request->input("username");

        $usuari->save();

        Auth::login($usuari);
        return redirect("/");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = usari::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuari $usuari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuari $usuari)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuari $usuari)
    {
        //
    }
}
