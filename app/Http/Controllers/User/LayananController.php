<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegistrasiSim;
use App\Models\RegistrasiStnk;
use App\Models\RegistrasiSkck;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function sim()
    {
        return view('user.layanan.sim');
    }

    public function storeSim(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jenis_sim' => 'required|in:A,C,B1,B2,D',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'surat_kesehatan' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'surat_psikologi' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['ktp'] = $request->file('ktp')->store('uploads/sim', 'public');
        $validated['pas_foto'] = $request->file('pas_foto')->store('uploads/sim', 'public');
        $validated['surat_kesehatan'] = $request->file('surat_kesehatan')->store('uploads/sim', 'public');
        $validated['surat_psikologi'] = $request->file('surat_psikologi')->store('uploads/sim', 'public');
        $validated['status'] = 'menunggu';

        RegistrasiSim::create($validated);

        return redirect()->route('home')->with('success', 'Pengajuan SIM berhasil dikirim! Silakan tunggu konfirmasi dari petugas.');
    }

    public function stnk()
    {
        return view('user.layanan.stnk');
    }

    public function storeStnk(Request $request)
    {
        $validated = $request->validate([
            'no_polisi' => 'required|string|max:20',
            'no_stnk' => 'required|string|max:50',
            'no_mesin' => 'required|string|max:50',
            'no_rangka' => 'required|string|max:50',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'stnk_lama' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bpkb' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'dokumen_pendukung' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['ktp'] = $request->file('ktp')->store('uploads/stnk', 'public');
        $validated['stnk_lama'] = $request->file('stnk_lama')->store('uploads/stnk', 'public');
        if ($request->hasFile('bpkb')) {
            $validated['bpkb'] = $request->file('bpkb')->store('uploads/stnk', 'public');
        }
        if ($request->hasFile('dokumen_pendukung')) {
            $validated['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('uploads/stnk', 'public');
        }
        $validated['status'] = 'menunggu';

        RegistrasiStnk::create($validated);

        return redirect()->route('home')->with('success', 'Pengajuan Perpanjangan STNK berhasil dikirim! Silakan tunggu konfirmasi dari petugas.');
    }

    public function skck()
    {
        return view('user.layanan.skck');
    }

    public function storeSkck(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:100',
            'kebangsaan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'keperluan' => 'required|string|max:255',
            'riwayat_kriminal' => 'required|in:Tidak Ada,Ada',
            'keterangan_kriminal' => 'nullable|string',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kk' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
            'akta_kelahiran' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'sidik_jari' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['ktp'] = $request->file('ktp')->store('uploads/skck', 'public');
        $validated['kk'] = $request->file('kk')->store('uploads/skck', 'public');
        $validated['akta_kelahiran'] = $request->file('akta_kelahiran')->store('uploads/skck', 'public');
        $validated['pas_foto'] = $request->file('pas_foto')->store('uploads/skck', 'public');
        
        if ($request->hasFile('sidik_jari')) {
            $validated['sidik_jari'] = $request->file('sidik_jari')->store('uploads/skck', 'public');
        }

        $validated['status'] = 'menunggu';

        RegistrasiSkck::create($validated);

        return redirect()->route('home')->with('success', 'Pengajuan SKCK berhasil dikirim! Silakan tunggu konfirmasi dari petugas.');
    }

    public function pengaduan()
    {
        return view('user.layanan.pengaduan');
    }

    public function storePengaduan(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'tanggal_kejadian' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'video' => 'nullable|mimes:mp4,mov,avi|max:20480',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $validated['user_id'] = auth()->id();
        
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('uploads/pengaduan', 'public');
        }
        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('uploads/pengaduan', 'public');
        }
        if ($request->hasFile('dokumen')) {
            $validated['dokumen'] = $request->file('dokumen')->store('uploads/pengaduan', 'public');
        }
        $validated['status'] = 'menunggu';

        Pengaduan::create($validated);

        return redirect()->route('home')->with('success', 'Laporan Pengaduan berhasil dikirim! Laporan Anda akan segera ditindaklanjuti oleh petugas kami.');
    }

    public function exportPdfSkck($id)
    {
        $skck = \App\Models\RegistrasiSkck::where('user_id', auth()->id())->findOrFail($id);
        
        if ($skck->status !== 'selesai') {
            return back()->with('error', 'SKCK belum selesai diproses, tidak dapat mengunduh dokumen.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.skck', compact('skck'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('SKCK_' . ($skck->user->name ?? 'Pemohon') . '.pdf');
    }

    public function riwayat(Request $request)
    {
        $userId = auth()->id();
        
        $simQuery = RegistrasiSim::where('user_id', $userId);
        $stnkQuery = RegistrasiStnk::where('user_id', $userId);
        $skckQuery = RegistrasiSkck::where('user_id', $userId);
        $pengaduanQuery = Pengaduan::where('user_id', $userId);
        
        if ($request->filled('tanggal_awal')) {
            $simQuery->whereDate('created_at', '>=', $request->tanggal_awal);
            $stnkQuery->whereDate('created_at', '>=', $request->tanggal_awal);
            $skckQuery->whereDate('created_at', '>=', $request->tanggal_awal);
            $pengaduanQuery->whereDate('created_at', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $simQuery->whereDate('created_at', '<=', $request->tanggal_akhir);
            $stnkQuery->whereDate('created_at', '<=', $request->tanggal_akhir);
            $skckQuery->whereDate('created_at', '<=', $request->tanggal_akhir);
            $pengaduanQuery->whereDate('created_at', '<=', $request->tanggal_akhir);
        }
        
        $sim = $simQuery->latest()->get();
        $stnk = $stnkQuery->latest()->get();
        $skck = $skckQuery->latest()->get();
        $pengaduan = $pengaduanQuery->latest()->get();

        return view('user.layanan.riwayat', compact('sim', 'stnk', 'skck', 'pengaduan'));
    }
}
