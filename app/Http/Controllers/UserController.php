<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;
use DB;
use Yajra\DataTables;
use Pacuna\Schemas\Facades\PGSchema;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function index(){
        $users = UserModel::all(); //mengambil list daftar user dari UserModel
        return view('user/user', compact('users'))->with('i');
    }

    public function create(){
        return view('user.create_user');
    }

    public function store(Request $request){

        $request->validate([
           'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

//        $search = UserModel::where(['email'=>$request->input('email')])->first();
        $search = UserModel::where(['username'=>$request->input('username')],['name'=>$request->input('name')])->first();

        //pengecekan user
        if ($search == null){   //jika data belum ada, jadi bisa ditambahkan";
            UserModel::create($request->all());
//            $this->createSchema($request->get('name'));
            $this->createSchema($request->get('username'));  // memanggil fungsi schema dengan mengirimkan variabel kode wilayah
            return redirect()->route('user.index')
                             ->with('success','new user created successfully');
        } else{
//            jika data sudah ada, tidak bisa ditambah lagi";
            return redirect()->route('user.create')
                             ->with('warning','Data elready exist !!');
        }

    }

    public function show($id){
        $user = UserModel::find($id);
        return view('user.detail_user', compact('user'));

    }

    public function edit($id){
        $user = UserModel::find($id);
        return view('user.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = UserModel::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        $user->save();
        return redirect()->route('user.index')
                         ->with('success', 'User updated successfully');
    }

    public function destroy($id){


        $user = UserModel::find($id);
        // $schemaName = $user->name;
        $schemaName = $user->username;
        // $schema = str_replace(" ", "_", $schemaName);
        $user->delete();
        PGSchema::drop($schemaName);

        return redirect()->route('user.index')
                         ->with('success', 'User deleted successfully');

    }

    public function createSchema($schemaName)
    {
        //create schema pada database berdasarkan kode wilayah

        $schema = str_replace(" ", "_", $schemaName);
        PGSchema::create($schema);
    }
}
