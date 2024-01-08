<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\AdminIndexResource;
use App\Http\Resources\AdminShowResource;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        if ($admins->isEmpty()) {
            throw new HttpResponseException(response()->json(
                ['message' => __('No hi ha administradors a la base de dades')],
                404
            ));
        }

        return response()->json(
            ['data' => AdminIndexResource::collection($admins)],
            200
        );
    }

    public function store(UserRequest $request)
    {
        $transaction = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => Str::lower($request->name),
                'surname' => Str::lower($request->surname),
                'dni' => Str::lower($request->dni),
                'email' => Str::lower($request->email),
                'password' => bcrypt($request->password),
                'active' => true,
            ]);
            $user->admin()->create();
            $user->assignRole('admin');

            return $user;
        });
        if (!$transaction) {
            throw new HttpResponseException(response()->json(
                ['message' => __('Registre no efectuat. Si-us-plau, torna-ho a provar.')],
                404
            ));
        }

        return response()->json(
            ['message' => __('Registre realitzat amb èxit.')],
            201
        );
    }

    public function show($id)
    {
        $loggeuser = Auth::user();
        $admin = $this->findAdmin($id);

        if (!$admin) {
            throw new HttpResponseException(response()->json(
                ['message' => __('No hi ha administradors a la base de dades')],
                404
            ));
        }
        if ($admin->id !== $loggeuser->admin->id) {
            return response()->json(
                ['message' => __('No tens permisos per veure aquest usuari.')],
                401
            );
        }

        return response()->json(
            ['data' => new AdminShowResource($admin)],
            200
        );
    }

    private function findAdmin($id)
    {
        return Admin::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $loggeuser = Auth::user();

        $admin = $this->findAdmin($id);
        if ($admin->id !== $loggeuser->admin->id) {
            throw new HttpResponseException(response()->json(
                ['message' => __('No tens permís per modificar aquest usuari')],
                401
            ));
        }

        if (!$admin) {
            throw new HttpResponseException(response()->json(
                ['message' => __('No hi ha administradors a la base de dades')],
                404
            ));
        }

        if ($request->surname) {
            $admin->user->surname = $request->surname;
        }
        if ($request->name) {
            $admin->user->name = $request->name;
        }
        if ($request->email) {
            $admin->user->email = $request->email;
        }
        $admin->save();

        return response()->json(
            ['message' => 'Usuari actualitzat amb èxit', 'data' => new AdminshowResource($admin)],
            200
        );
    }

    public function destroy($id)
    {

        $admin = $this->findAdmin($id);
        $loggeuser = Auth::user();
        $id = $this->findAdmin($id);
        if ($admin->id !== $loggeuser->admin->id) {
            throw new HttpResponseException(response()->json(
                ['message' => __('No tens permís per eliminar aquest usuari')],
                401
            ));
        }
        $admin->user->delete();

        return response()->json(
            ['message' => __('La seva compte ha estat eliminada amb èxit')],
            200
        );
    }
}
