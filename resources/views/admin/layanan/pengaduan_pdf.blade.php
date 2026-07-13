<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan Masyarakat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header h3 {
            margin: 5px 0 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            display: inline-block;
            text-align: center;
            margin-right: 50px;
        }
        .signature p {
            margin: 0;
        }
        .signature-space {
            height: 80px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h2>
        <h2>DAERAH JAWA TENGAH</h2>
        <h3>RESOR WONOGIRI</h3>
        <p>Jl. Jenderal Sudirman No. 12, Wonogiri, Jawa Tengah</p>
    </div>

    <div class="text-center" style="margin-bottom: 20px;">
        <h3 style="margin:0; text-decoration: underline;">REKAPITULASI LAPORAN PENGADUAN MASYARAKAT</h3>
        @if(request('start_date') && request('end_date'))
            <p style="margin:5px 0 0;">Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} s/d {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}</p>
        @endif
        @if(request('status') && request('status') !== 'semua')
            <p style="margin:5px 0 0;">Status: {{ ucfirst(request('status')) }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="12%">Tgl Kejadian</th>
                <th width="15%">Pelapor</th>
                <th width="12%">Kategori</th>
                <th width="20%">Judul/Isi Laporan</th>
                <th width="18%">Lokasi</th>
                <th width="10%">Status</th>
                <th width="10%">Tanggapan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d-m-Y') }}</td>
                <td>{{ $item->user->name ?? 'Anonim' }}</td>
                <td>{{ $item->kategori }}</td>
                <td>
                    <strong>{{ $item->judul }}</strong><br>
                    {{ Str::limit($item->isi, 100) }}
                </td>
                <td>
                    {{ $item->lokasi }}
                    @if($item->latitude && $item->longitude)
                    <br><small>(Lat: {{ $item->latitude }}, Lng: {{ $item->longitude }})</small>
                    @endif
                </td>
                <td class="text-center">{{ ucfirst($item->status) }}</td>
                <td>{{ $item->catatan_admin ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data pengaduan pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Wonogiri, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Kepala SPKT Polres Wonogiri</p>
            <div class="signature-space"></div>
            <p style="text-decoration: underline; font-weight: bold;">......................................</p>
            <p>PANGKAT / NRP</p>
        </div>
    </div>

</body>
</html>
