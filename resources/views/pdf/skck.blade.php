<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKCK - {{ $skck->user->name ?? 'Pemohon' }}</title>
    <style>
        @page {
            margin: 0.5cm 1cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            line-height: 1.1;
            color: #000;
        }
        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .header-left {
            text-align: left;
            font-weight: bold;
            line-height: 1.1;
            font-size: 9pt;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        .header-left span {
            text-decoration: none;
            display: block;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            width: 70px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .title .indo {
            text-decoration: underline;
            font-size: 11pt;
        }
        .title .eng {
            font-size: 10pt;
        }
        .title .nomor {
            font-weight: normal;
            font-size: 10pt;
            margin-top: 2px;
        }
        .section-title {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }
        .table-data td {
            vertical-align: top;
            padding: 1px 0;
        }
        .col-label {
            width: 35%;
        }
        .col-colon {
            width: 2%;
            text-align: center;
        }
        .col-value {
            width: 63%;
        }
        .eng-text {
            font-style: italic;
            font-size: 9pt;
        }
        .statement {
            margin-top: 5px;
            text-align: justify;
        }
        .statement-bold {
            font-weight: bold;
            text-align: center;
            margin: 5px 0;
        }
        .signature-box {
            width: 100%;
            margin-top: 15px;
        }
        .signature-left {
            width: 50%;
            float: left;
            text-align: center;
        }
        .signature-right {
            width: 50%;
            float: right;
        }
        .photo-box {
            width: 4cm;
            height: 6cm;
            border: 1px solid #000;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            line-height: 6cm;
            font-weight: bold;
        }
        .signature-details {
            margin-bottom: 50px;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
        .signature-nrp {
            font-weight: bold;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header-left">
        KEPOLISIAN NEGARA REPUBLIK INDONESIA<br>
        <span>DAERAH JAWA TENGAH</span>
        <span>RESOR WONOGIRI</span>
        <span>Jalan Jenderal Sudirman No. 12 Wonogiri 57612</span>
    </div>

    <div class="logo">
        <img src="{{ public_path('images/logo-polri.png') }}" alt="Logo Polri">
    </div>

    <div class="title">
        <div class="indo">SURAT KETERANGAN CATATAN KEPOLISIAN</div>
        <div class="eng">POLICE RECORD</div>
        <div class="nomor">Nomor : SKCK/YANMAS/{{ rand(10000, 99999) }}/{{ date('m/Y') }}/INTELKAM</div>
    </div>

    <div class="section-title">
        <u>Diterangkan bersama ini bahwa :</u><br>
        <span class="eng-text">This is to certify that :</span>
    </div>

    <table class="table-data">
        <tr>
            <td class="col-label">
                <u>Nama</u><br>
                <span class="eng-text">Name</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ strtoupper($skck->nama ?? '-') }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Jenis Kelamin</u><br>
                <span class="eng-text">Sex</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $skck->jenis_kelamin ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Kebangsaan</u><br>
                <span class="eng-text">Nationality</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $skck->kebangsaan ?? 'Indonesia' }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Agama</u><br>
                <span class="eng-text">Religion</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $skck->agama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Tempat dan tanggal lahir</u><br>
                <span class="eng-text">Place and date of birth</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">
                {{ $skck->tempat_lahir ?? '-' }}, 
                {{ $skck->tanggal_lahir ? \Carbon\Carbon::parse($skck->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Tempat tinggal sekarang</u><br>
                <span class="eng-text">Current address</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $skck->alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Pekerjaan</u><br>
                <span class="eng-text">Occupation</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">Pelajar / Mahasiswa / Karyawan</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Nomor kartu tanda penduduk</u><br>
                <span class="eng-text">Citizen card number</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $skck->nik ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Nomor Paspor/KITAS/KITAP*</u><br>
                <span class="eng-text">Passport/KITAS/KITAP number</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">-</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Rumus sidik jari</u><br>
                <span class="eng-text">Fingerprints formula</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">-</td>
        </tr>
    </table>

    <div class="statement">
        <u>Setelah diadakan penelitian hingga saat dikeluarkan keterangan ini yang didasarkan : <b>Catatan kepolisian yang ada</b></u><br>
        <span class="eng-text">As screening through the issue hereof by virtue of : <b>Existing Police Record</b></span>
    </div>

    <div class="statement-bold">
        bahwa nama tersebut diatas tidak memiliki catatan atau keterlibatan dalam kegiatan criminal apapun<br>
        <span class="eng-text">(the bearer hereof proves not to be involved in any criminal cases)</span>
    </div>

    @php
        $tgl_lahir = $skck->tanggal_lahir ? \Carbon\Carbon::parse($skck->tanggal_lahir)->translatedFormat('d F Y') : '-';
        $tgl_sekarang = \Carbon\Carbon::now()->translatedFormat('d F Y');
        $tgl_berakhir = \Carbon\Carbon::now()->addMonths(6)->translatedFormat('d F Y');
        $tgl_sekarang_eng = \Carbon\Carbon::now()->format('d F Y');
    @endphp

    <table class="table-data" style="margin-top: 10px;">
        <tr>
            <td class="col-label">
                <u>selama ia berada di Indonesia dari</u><br>
                <span class="eng-text">during his/her stay in Indonesia from</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $tgl_lahir }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>sampai dengan</u><br>
                <span class="eng-text">to</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $tgl_sekarang }}</td>
        </tr>
    </table>

    <div class="statement" style="text-align: center; margin-top: 15px;">
        <u>Keterangan ini diberikan berhubungan dengan permohonan</u><br>
        <span class="eng-text">This certificate is issued at the request to the applicant</span>
    </div>

    <table class="table-data" style="margin-top: 10px;">
        <tr>
            <td class="col-label">
                <u>Untuk keperluan/menuju*</u><br>
                <span class="eng-text">For the purpose</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $skck->keperluan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Berlaku dari tanggal</u><br>
                <span class="eng-text">Valid from</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $tgl_sekarang }}</td>
        </tr>
        <tr>
            <td class="col-label">
                <u>Sampai dengan</u><br>
                <span class="eng-text">To</span>
            </td>
            <td class="col-colon">:</td>
            <td class="col-value">{{ $tgl_berakhir }}</td>
        </tr>
    </table>

    <div class="signature-box">
        <div class="signature-left">
            <div class="photo-box" style="border: none; overflow: hidden; display: block; line-height: normal;">
                @if($skck->pas_foto && file_exists(storage_path('app/public/' . $skck->pas_foto)))
                    <img src="{{ storage_path('app/public/' . $skck->pas_foto) }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                @else
                    <div style="border: 1px solid #000; width: 100%; height: 100%; line-height: 6cm;">4X6</div>
                @endif
            </div>
        </div>
        <div class="signature-right">
            <table class="table-data" style="margin-bottom: 10px;">
                <tr>
                    <td style="width: 35%;">Dikeluarkan di<br><span class="eng-text">Issued in</span></td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 60%;">Wonogiri</td>
                </tr>
                <tr>
                    <td>Pada tanggal<br><span class="eng-text">On</span></td>
                    <td>:</td>
                    <td>{{ $tgl_sekarang_eng }}</td>
                </tr>
            </table>
            
            <div style="font-weight: bold; border-top: 1px solid #000; padding-top: 5px; text-align: center; font-size: 10pt;">
                an. KEPALA KEPOLISIAN RESOR WONOGIRI<br>
                KEPALA SATUAN INTELKAM
                
                <div class="signature-details">
                    <!-- Signature space -->
                </div>
                
                <div class="signature-name">SUNARDI, SH</div>
                <div class="signature-nrp">KOMISARIS POLISI NRP 76050123</div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>
