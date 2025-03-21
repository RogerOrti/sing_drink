<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view("myhome.home");
    }

    public function login(Request $request){

        $nomUsuari = $request->input('nom');
        $contrasenya = $request->input('contrasenya');

        $usuari = Usuari::where('nom',$nomUsuari)->first();

        if($usuari != null && Hash::check($contrasenya, $usuari->contrasenya)){
            Auth::login($usuari);
            $request->session()->flash('usuari', $usuari);
            $response = redirect('/');
        }
        else{
            $request->session()->flash('error','Usuari o contrasenya incorrectes');
            $response = redirect('/');
        }

        return $response;
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function showRegister(){

        return view("auth.register");
    }

    public function register(Request $request)
    {

        $usuari = new Usuari();
        $usuari->nom = $request->input("nom");
        $usuari->cognom = $request->input("cognom");
        $usuari->mail = $request->input("email");
        $usuari->contrasenya = Hash::make($request->input("contrasenya"));

        if ($usuari->save()) {
            Auth::login($usuari);
            session()->flash('success', 'Usuari registrat correctament!');
            return redirect('/');
        } else {
            session()->flash('error', "No s'ha pogut registrar l'usuari.");
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = usuari::all();
        return $usuaris;
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
