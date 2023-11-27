<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    // Tampilkan daftar user
}

public function create()
{
    // Tampilkan formulir pembuatan user
}

public function store(Request $request)
{
    // Simpan data user baru
}

public function show($id)
{
    // Tampilkan detail user
}

public function edit($id)
{
    // Tampilkan formulir pengeditan user
}

public function update(Request $request, $id)
{
    // Perbarui data user
}

public function destroy($id)
{
    // Hapus user
}

}
