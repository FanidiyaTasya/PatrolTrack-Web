<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guard;
use Illuminate\Http\Request;

class GuardController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $title = 'Delete!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $guards = Guard::paginate(5);
        return view('pages.guard.guard', compact('guards'), [
            'title' => 'Data Satpam'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.guard.create', [
            'title' => 'Data Satpam'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'birth_date' => 'required',
            'email' => 'required|email|unique:guards,email',
            'password' => 'required|min:6',
            'phone_number' => 'required',
            'address' => 'required',
        ],
        [
            'name.required' => 'Kolom Nama harus diisi',
            'birth_date.required' => 'Tanggal Lahir harus diisi',
            'email.required' => 'Kolom Email harus diisi',
            'email.email' => 'Format Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Kolom Password harus diisi',
            'password.min' => 'Password harus memiliki minimal 6 karakter',
            'phone_number.required' => 'Kolom Nomor Telepon harus diisi',
            'address.required' => 'Kolom Alamat harus diisi',
        ]
        );
        
        Guard::create($validatedData);
        // return redirect('/guard')->with('toast_success','Data has been added!');
        session()->flash('toast_message', 'Data has been added!');
        return redirect('/guard');
        }

    /**
     * Display the specified resource.
     */
    public function show(Guard $guard) {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guard $guard) {
        return view('pages.guard.edit', [
            'title' => 'Data Satpam',
            'guard' => $guard
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guard $guard) {
        $rules = [
            'name' => 'required',
            'birth_date' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ];
        if ($request->email != $guard->email) {
            $rules['email'] = 'required|email|unique:guards,email';
        }
        $validate = $request->validate($rules);

        Guard::where('id', $guard->id)->update($validate);
        // return redirect('/guard')->with('toast_success','Data has been updated!');
        session()->flash('toast_message', 'Data has been updated!');
        return redirect('/guard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guard $guard) {
        Guard::destroy($guard->id);
        // return redirect('/guard')->with('toast_success','Data has been deleted!');
        session()->flash('toast_message', 'Data has been deleted!');
        return redirect('/guard');
    }
}
