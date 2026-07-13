<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')->latest()->paginate(10);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::all();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'isi' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $slug = Str::slug($request->judul);
        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('berita', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'kategori_berita_id' => $request->kategori_berita_id,
            'user_id' => auth()->id(),
            'ringkasan' => Str::limit(strip_tags($request->isi), 150),
            'isi' => $request->isi,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $beritum)
    {
        $kategori = KategoriBerita::all();
        $berita = $beritum; // Route Model Binding uses $beritum
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'isi' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $thumbnailPath = $beritum->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($beritum->thumbnail) {
                Storage::disk('public')->delete($beritum->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('berita', 'public');
        }

        $beritum->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori_berita_id' => $request->kategori_berita_id,
            'ringkasan' => Str::limit(strip_tags($request->isi), 150),
            'isi' => $request->isi,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->thumbnail) {
            Storage::disk('public')->delete($beritum->thumbnail);
        }
        $beritum->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
