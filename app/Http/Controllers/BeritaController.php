<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Display a list of berita
    public function index()
    {
        $beritas = Berita::all();
        return view('beritas.index', compact('beritas'));
    }

    // Show the form for creating a new berita
    public function create()
    {
        return view('beritas.create');
    }

    // Store a newly created berita
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Berita::create($request->all());

        return redirect()->route('beritas.index')
            ->with('success', 'Berita created successfully.');
    }
}
