<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin')->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users=User::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.users.index', compact('users', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request) {
        $count=User::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug.$count;
        }

        $num=0;
        while (true) {
            $count2=User::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=$slug.$num;
                $num++;
            } else {
                break;
            }
        }

        $user=User::create([
            'name' => request('name'),
            'slug' => $slug,
            'email' => request('email'),
            'rol' => request('rol'),
            'password' => Hash::make(request('password')),
        ])->save();

        if ($user) {
            return redirect()->route('usuarios.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El usuario ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('usuarios.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        echo json_encode([
            'nombre' => $user->name,
            'correo' => $user->email,
            'permisos' => $user->rol
        ]);
        // return view('admin.users.show', compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        return view('admin.users.edit', compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $user->fill($request->all())->save();

        if ($user) {
            return redirect()->route('usuarios.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El usuario ha sido editado exitosamente.']);
        } else {
            return redirect()->route('usuarios.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $user->delete();

        if ($user) {
            return redirect()->route('usuarios.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El usuario ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('usuarios.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function profile($slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        return view('admin.users.profile', compact('user'));
    }
}
