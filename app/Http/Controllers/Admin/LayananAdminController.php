<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegistrasiSim;
use App\Models\RegistrasiStnk;
use App\Models\RegistrasiSkck;
use App\Models\Pengaduan;
use Barryvdh\DomPDF\Facade\Pdf;

class LayananAdminController extends Controller
{
    public function indexSim()
    {
        $data = RegistrasiSim::with('user')->latest()->get();
        return view('admin.layanan.sim', compact('data'));
    }

    public function updateSim(Request $request, $id)
    {
        $sim = RegistrasiSim::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:menunggu,diverifikasi,ditolak,dijadwalkan,selesai',
            'catatan_admin' => 'nullable|string',
            'jadwal_pelayanan' => 'nullable|date',
        ]);

        $sim->update($request->only('status', 'catatan_admin', 'jadwal_pelayanan'));
        return back()->with('success', 'Status pengajuan SIM berhasil diperbarui.');
    }

    public function indexStnk()
    {
        $data = RegistrasiStnk::with('user')->latest()->get();
        return view('admin.layanan.stnk', compact('data'));
    }

    public function updateStnk(Request $request, $id)
    {
        $stnk = RegistrasiStnk::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:menunggu,diverifikasi,ditolak,dijadwalkan,selesai',
            'catatan_admin' => 'nullable|string',
            'jadwal_pelayanan' => 'nullable|date',
        ]);

        $stnk->update($request->only('status', 'catatan_admin', 'jadwal_pelayanan'));
        return back()->with('success', 'Status pengajuan STNK berhasil diperbarui.');
    }

    public function indexSkck()
    {
        $data = RegistrasiSkck::with('user')->latest()->get();
        return view('admin.layanan.skck', compact('data'));
    }

    public function updateSkck(Request $request, $id)
    {
        $skck = RegistrasiSkck::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
            'jadwal_pengambilan' => 'nullable|date',
        ]);

        $skck->update($request->only('status', 'catatan_admin', 'jadwal_pengambilan'));
        return back()->with('success', 'Status pengajuan SKCK berhasil diperbarui.');
    }

    public function exportPdfSkck($id)
    {
        $skck = RegistrasiSkck::with('user')->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.skck', compact('skck'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('SKCK_' . ($skck->user->name ?? 'Pemohon') . '.pdf');
    }

    public function indexPengaduan(Request $request)
    {
        $query = Pengaduan::with('user')->latest();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_kejadian', [
                $request->start_date, 
                $request->end_date
            ]);
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $data = $query->get();
        return view('admin.layanan.pengaduan', compact('data'));
    }

    public function updatePengaduan(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:menunggu,diproses,ditindaklanjuti,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pengaduan->update($request->only('status', 'catatan_admin'));
        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function exportPdfPengaduan(Request $request)
    {
        $query = Pengaduan::with('user')->latest();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_kejadian', [
                $request->start_date, 
                $request->end_date
            ]);
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $pengaduans = $query->get();

        $pdf = Pdf::loadView('admin.layanan.pengaduan_pdf', compact('pengaduans', 'request'));
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('laporan-pengaduan-' . date('Y-m-d') . '.pdf');
    }
}
