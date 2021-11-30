<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{

    public function index()
    {
        // return auth()->user();
        // $users = User::all();
        $users = User::select('id', 'name', 'last_name', 'identification', 'phone', 'email')
            ->role('doctor')
            ->latest('id')
            ->get();
        return $users;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'phone' => 'required|string|max:20',
            'eps' => 'required|string|max:40',
            'identification' => 'required|unique:users|string|max:15',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'eps' => $request->get('eps'),
            'identification' => $request->get('identification'),
            'birthdate' => $request->get('birthdate'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ])->assignRole('doctor');


        $newUser = [
            'name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'eps' => $user->eps,
            'identification' => $user->identification,
            'birthdate' => $user->birthdate,
            'phone' => $user->phone,
            'role' => $user->roles[0]['name']
        ];

        return response()->json(compact('newUser'), 201);

    }

    public function show(User $doctor)
    {
        $doctor = [
            'id' => $doctor->id,
            'name' => $doctor->name,
            'last_name' => $doctor->last_name,
            'email' => $doctor->email,
            'eps' => $doctor->eps,
            'identification' => $doctor->identification,
            'birthdate' => $doctor->birthdate,
            'phone' => $doctor->phone,
            'role' => $doctor->roles[0]['name']
        ];

        return response()->json(['user' => $doctor], 200);
    }

    public function update(Request $request, User $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'phone' => 'required|string|max:20',
            'eps' => 'required|string|max:40',
            'identification' => "required|string|max:15|unique:users,identification,$doctor->id",
            'birthdate' => 'required|date',
            'email' => "required|string|email|max:255|unique:users,email,$doctor->id",
        ]);

        $doctor->update($request->only('name', 'last_name', 'phone', 'eps', 'identification', 'birthdate', 'email'));

        $updatedUser = $doctor->name." ".$doctor->last_name;

        return response()->json(['message' => "La información del doctor $updatedUser, ha sido actualizadá con exito"], 200);
    
    }

    public function destroy(User $user)
    {
        $userName = $user->name." ".$user->last_name;
        $user->delete();
        return response()->json(['message' => "El doctor $userName se ha eleminado con exito"]);
    }
}
