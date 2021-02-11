@extends('layouts.app')

@section('title', 'Raport')

@section('head')
<!-- css yang digunakan ketika dalam mode screen -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

<!-- ss yang digunakan tampilkan ketika dalam mode print -->
<link href="{{ asset('assets/css/raport.css') }}" rel="stylesheet">

<style type="text/css" media="print">
    @page {
        size: 210mm 297mm;
        /* auto is the initial value */
        margin: 10mm 10mm 10mm 10mm;
        /* this affects the margin in the printer settings t,r,b,l */
    }

    @media print {
        footer {
            page-break-after: always;
        }
    }
</style>
@endsection

@section('headersiswa')
<table class="table-borderless siswa" style="color:black" width="100%">
    <tbody>
        <tr>
            @foreach ($siswa as $s) @php ($nis = $s->nis) @endphp
            <td width="20%" data-toggle="popover-hover" data-img="data:image/png;base64,{{ $foto ?? '' }}">
                Nama Peserta Didik<br>Nomor Induk/NISN<br>Kelas<br>Semester</td>
            <td width="40%">: {{ $s->nama }}<br>: {{ $s->nis }} / {{ $s->nisn }}<br>: {{ $kelas }}<br>:
                {{ $semester }}</td>
            <td width="40%" class="text-right align-top">
                <div class="d-none d-sm-none d-md-block d-print-block"><svg id="barcode"></svg></div>
            </td>
            @endforeach
        </tr>
    </tbody>
</table>
<hr style="border: 1px solid black">
@endsection

@section('tandatangan')
<div class="d-none d-print-block">
    <table class="table-borderless cetak" width="100%" style="color:black">
        <tbody>
            <tr>
                <td width="5%"> </td>
                @foreach ($siswa as $s)
                <td width="70%"><br>Orang Tua/Wali<br><br><br><br><b>@if ($s->almayah == 0)
                        {{ $s->namaayah }} @else {{ $s->namaibu }} @endif</b><br><br></td>
                @endforeach
                <td width="25%">Sragen,
                    {{ Carbon\Carbon::parse($tanggalraport)->formatLocalized('%e %B %Y') }}<br>Wali kelas
                    {{ $kelas }}<br><br><br><br><b>{{ $walikelas }}</b><br>NIP. {{ $nipwali }}</td>
            </tr>
        </tbody>
    </table><br>
    <table class="table-borderless cetak d-flex justify-content-center" style="color:black">
        <tbody>
            <tr>
                <td class="text-center"><br>Mengetahui,<br>Kepala
                    Sekolah<br><br><br><br><b>{{ $kepsek }}</b></td>
            </tr>
            <tr>
                <td>NIP. -</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Pengaturan Cetak Raport</h4>
                </div>
                <div class="card-body">
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                <td width="20%">
                                    Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi
                                </td>
                                <td width="40%">
                                    : {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" onclick="printDiv('printCover')">
                                        <i class="material-icons">insert_drive_file</i> Cover
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="printDiv('printBiodata')">
                                        <i class="material-icons">person</i> Biodata
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" onclick="printDiv('printRaport')">
                                        <i class="material-icons">print</i> Raport
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Cetak Raport</h4>
                </div>
                <div class="card-body d-none d-print-block print" id="printCover">
                    <div class="text-center">
                        <br style="display: block;content: '';margin: 100px 0;">
                        <h3 class="text-uppercase font-weight-bold">
                            Raport Peserta Didik<br> Sekolah Menengah Kejuruan<br>(SMK)
                        </h3>
                        <br style="display: block;content: '';margin: 125px 0;">
                        <img src="{{ asset('assets/img/logo/logo_tut_wuri.svg') }}" alt="" height="250">
                        <br style="display: block;content: '';margin: 125px 0;">
                        @foreach ($siswa as $s)
                        <p style="font-size:x-large;">Nama Peserta Didik :</p>
                        <h2 class="font-weight-bold text-lowercase text-capitalize">
                            {{ $s->nama }}
                        </h2>
                        <br style="display: block;content: '';margin: 100px 0;">
                        <p style="font-size:x-large;">NIS / NISN :</p>
                        <h2 class="font-weight-bold">
                            {{$s->nis}} / {{$s->nisn}}
                        </h2>
                        <br style="display: block;content: '';margin: 250px 0;">
                        <h3 class="text-uppercase font-weight-bold">
                            Kementrian Pendidikan dan Kebudayaan <br>Republik Indonesia</h3>
                        @endforeach
                    </div>
                </div>
                <div class="card-body d-none d-print-block print" id="printBiodata">
                    <div>
                        <h3 class="text-uppercase font-weight-bold text-center">Keterangan Tentang Diri Peserta Didik</h3>
                        <br style="display: block;content: '';margin: 100px 0;">
                        <table class="table-borderless">
                            <tbody style="font-size:large; line-height:2;">
                                <tr>
                                    <td class="pl-5">
                                        1.<br>
                                        2.<br>
                                        3.<br>
                                        4.<br>
                                        5.<br>
                                        6.<br>
                                        7.<br>
                                        8.<br>
                                        9.<br>
                                        10.<br>
                                        11. <br>
                                        <br>
                                        <br>
                                        12.<br>
                                        <br>
                                        <br>
                                        13. <br>
                                        <br>
                                        14. <br>
                                        <br>
                                        <br>
                                        15. <br>
                                        16. <br>
                                        <br>
                                        17. <br>
                                    </td>
                                    <td class="pl-3">
                                        Nama Peserta Didik (Lengkap)<br>
                                        Nomor Induk/NISN<br>
                                        Tempat, Tanggal Lahir<br>
                                        Jenis Kelamin<br>
                                        Agama<br>
                                        Status dalam Keluarga<br>
                                        Anak ke<br>
                                        Alamat Peserta Didik<br>
                                        Nomor Telepon Rumah<br>
                                        Sekolah Asal<br>
                                        Diterima di sekolah ini<br>
                                        Di kelas<br>
                                        Pada tanggal<br>
                                        Nama Orang Tua<br>
                                        a. Ayah<br>
                                        b. Ibu<br>
                                        Alamat Orang Tua<br>
                                        Nomor Telepon Rumah<br>
                                        Pekerjaan Orang Tua<br>
                                        a. Ayah<br>
                                        b. Ibu<br>
                                        Nama Wali Peserta Didik<br>
                                        Alamat Wali Peserta Didik<br>
                                        Nomor Telepon Rumah<br>
                                        Pekerjaan Wali Peserta Didik<br>
                                    </td>
                                    <td class="pl-5">
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        <br>
                                        :<br>
                                        :<br>
                                        <br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        <br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                        :<br>
                                    </td>
                                    @foreach ($siswa as $sis)
                                    <td class="pl-3">
                                        {{$sis->nama}}<br>
                                        {{$sis->nis}} / {{$sis->nisn}}<br>
                                        {{$sis->tmplahir}},
                                        {{ Carbon\Carbon::parse($sis->tgllahir)->formatLocalized('%e %B %Y') }}<br>
                                        @if ($sis->kelamin == 'l')
                                        Laki-laki
                                        @elseif ($sis->kelamin == 'p')
                                        Perempuan
                                        @endif<br>
                                        {{$sis->agama}}<br>
                                        {{$sis->statusayah}}<br>
                                        {{$sis->anakke}}<br>
                                        {{$sis->alamatsiswa}}<br>
                                        {{$sis->telponsiswa}}<br>
                                        {{$sis->asalsekolah}}<br>
                                        <br>
                                        X<br>
                                        @if ($sis->tahunmasuk == '2018') 16 Juli 2018 @elseif ($sis->tahunmasuk == '2019') 15 Juli 2019 @endif
                                        <br>
                                        <br>
                                        {{$sis->namaayah}}<br>
                                        {{$sis->namaibu}}<br>
                                        {{$sis->alamatortu}}<br>
                                        {{$sis->hportu}}<br>
                                        <br>
                                        {{$sis->pekerjaanayah}}<br>
                                        {{$sis->pekerjaanibu}}<br>
                                        {{$sis->wali}}<br>
                                        <br>
                                        <br>
                                        <br>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table><br><br><br><br>
                        <table class="table-borderless">
                            <tbody>
                                <tr>
                                    <td class="pl-5 pr-5 text-light">aaaaaaaaaaaaaaa</td>
                                    <td class="pl-5 pr-5 text-center border border-dark">Pas Foto <br> 3 x 4</td>
                                    <td class="pl-5 pr-5"></td>
                                    <td class="pl-5 font-height">
                                        <h4>
                                            Sragen, @if ($sis->tahunmasuk == '2018') 16 Juli 2018 @elseif ($sis->tahunmasuk == '2019') 15 Juli 2019 @endif<br> Kepala Sekolah
                                            <br><br><br><br><br><strong>{{ $kepsek }}</strong><br>NIP. -
                                        </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body print" id="printRaport">
                    @yield('headersiswa')
                    <h3>A. Nilai Akademik</h3>
                    @section('akademik')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Mata Pelajaran</th>
                                    @if (isset($aspek))
                                    @foreach ($aspek as $a)
                                    <th class="text-center" data-toggle="tooltip" title="{{ $a->keterangan }} ({{ $a->dasarpenilaian }})">
                                        {{ $a->keterangan }}
                                    </th>
                                    @endforeach
                                    @php ($naspek = count($aspek)) @endphp
                                    @else
                                    @php ($naspek = 0) @endphp
                                    @endif
                                    <th class="text-center">Nilai Akhir</th>
                                    <th class="text-center">Predikat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1) @endphp
                                @foreach ($kelompokpelajaran as $k)
                                @php ($colspan = $naspek + 4) @endphp
                                <tr>
                                    <td colspan="{{ $colspan }}" data-toggle="tooltip" title="{{ $k->idkelompok }} - {{ $k->kode }}. {{ $k->kelompok }}">
                                        <strong>{{ $k->kode }}. {{ $k->kelompok }}</strong>
                                    </td>
                                </tr>
                                @foreach (collect($pelajaran)->where('idkelompok', $k->idkelompok) as $p)
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    @if (isset($nilaisiswa))
                                    @php ($colspan = 1) @endphp
                                    @else
                                    @php ($colspan = 3) @endphp
                                    @endif
                                    <td colspan="{{ $colspan }}" data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">
                                        {{ $p->nama }}
                                    </td>
                                    @if (isset($aspek))
                                    @php ($nilaiakhir = array()) @endphp
                                    @foreach ($aspek as $a)
                                    @php ($nilai = (collect($nilaisiswa)->where('idpelajaran', $p->idpelajaran)->where('dasarpenilaian', $a->dasarpenilaian)->take(1))) @endphp
                                    @if ($nilai->count() > 0)
                                    @foreach ($nilai as $n)
                                    @php ($nilaiakhir[] = $n->nilaiangka) @endphp
                                    @php ($idpelajaran = $n->idpelajaran) @endphp
                                    @if ($n->dasarpenilaian == 'PNGT')
                                    @php ($nipguru = $n->nipguru) @endphp
                                    @endif
                                    <td class="text-center" data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">
                                        {{ number_format($n->nilaiangka) ?? '-' }}
                                    </td>
                                    @endforeach
                                    @else
                                    <td class="text-center" data-toggle="tooltip" title="Belum ada penilaian"></td>
                                    @endif
                                    @endforeach
                                    @if ( (array_sum($nilaiakhir)) != 0 AND count($nilaiakhir) != 0)
                                    @php ($ratanilai = array_sum($nilaiakhir)/count($nilaiakhir)) @endphp
                                    @else
                                    @php ($ratanilai = null) @endphp
                                    @endif
                                    @endif
                                    @if (isset($nipguru))
                                    <td class="text-center" data-toggle="tooltip" title="@foreach ($nilaiakhir as $na) {{ $na }}, @endforeach {{ $ratanilai ?? '' }}">
                                        {{ number_format($ratanilai) ?? '' }}
                                    </td>
                                    <td class="text-center" data-toggle="tooltip" data-html="true" title=" @foreach (collect($pegawai)->where('nip', $nipguru) as $p) {{ $p->nama }} <br/> {{ $p->nip }} @endforeach <br/> @foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru) as $g) <b>{{ $g->grade }}</b> : {{ $g->nmin }} - {{ $g->nmax }} <br/> @endforeach">
                                        @foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru)->where('nmin', '<=', number_format($ratanilai) ?? '' )->where('nmax', '>=', number_format($ratanilai) ?? '') as $g) {{ $g->grade }}
                                        @endforeach
                                    </td>
                                    @endif
                                </tr>@php ($i++) @endphp
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endsection
                    @yield('akademik')
                    <h3>B. Catatan Akademik</h3>
                    <div class="table-responsive">
                        <table class="table" height="120px">
                            <tbody>
                                <tr>
                                    <td>
                                        @if (isset($nilaisiswa))
                                        Ananda perlu meningkatkan kompetensi pengetahuan @foreach (collect($nilaisiswa)->where('dasarpenilaian', 'PNGT')->sortBy('nilaiangka')->take(3) as $n) {{ $n->nama }}, @endforeach sebagai bekal pembelajaran kompetensi kejuruan di semester selanjutnya.
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-none d-print-block" style="page-break-before:always;">
                        @yield('headersiswa')
                    </div>
                    <h3>C. Praktik Kerja Lapangan</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Mitra / DUDI</th>
                                    <th class="text-center">Lokasi</th>
                                    <th class="text-center">Lamanya (Bulan)</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php ($nkomentar = collect($nilaisiswa)->where('idpelajaran', '226')) @endphp
                                    @if (empty($nkomentar) || !isset($nkomentar) || $nkomentar == '' || collect($nkomentar)->isEmpty())
                                    <td class="text-center">1</td>
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td></td>
                                    @else
                                    @foreach ($nkomentar as $komentar)
                                    <td class="text-center">1</td>
                                    @if ($komentar->komentar == '')
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    @else
                                    {!! str_replace("<ol>", "", (str_replace("</ol>", "", (str_replace("li>", "td>", $komentar->komentar))))) !!}
                                    @endif

                                    @php ($idpelajaran = '226') @endphp
                                    @php ($nippkl = $komentar->nipguru) @endphp
                                    @if (isset($nippkl))
                                    <td class="text-center" data-toggle="tooltip" data-html="true" title="
                                        @foreach (collect($pegawai)->where('nip', $nippkl) as $p)
                                            {{ $p->nama }} <br/> {{ $p->nip }}
                                        @endforeach
                                        <br/>
                                        @foreach (collect($grades)->where('idpelajaran', $idpelajaran)->where('nipguru', $nippkl) as $g)
                                            <b>{{ $g->grade }}</b> : {{ $g->nmin }} - {{ $g->nmax }} <br/> @endforeach">
                                        @foreach (collect($grades)->where('idpelajaran', $idpelajaran)->where('nipguru', $nippkl)->where('nmin', '<=', number_format($ratanilai) ?? '' )->where('nmax', '>=', number_format($ratanilai) ?? '') as $g)
                                        {{ $g->grade }}
                                        @endforeach
                                    </td>
                                    @endif
                                    @endforeach
                                    @endif
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3>D. Ekstrakurikuler</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kegiatan Ekstrakurikuler</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1) @endphp
                                @foreach ((collect($pelajaran)->where('idkelompok', '8')) as $p)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">
                                        {{ $p->nama }}
                                    </td>
                                    @php ($nilai = (collect($nilaisiswa)->where('idpelajaran', $p->idpelajaran)->take(1))) @endphp
                                    @if ($nilai->count() > 0)
                                    @foreach ($nilai as $n)
                                    @php ($idpelajaran = $n->idpelajaran) @endphp
                                    @php ($nipguru = $n->nipguru) @endphp
                                    <td data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">
                                        Melaksanakan kegiatan {{ $p->nama }} dengan @if ($n->nilaihuruf == 'A') Sangat baik @elseif ($n->nilaihuruf == 'B') Baik @elseif ($n->nilaihuruf == 'C') Cukup baik @elseif ($n->nilaihuruf == 'D') Kurang baik @else Baik @endif </td>
                                    @endforeach
                                    @else
                                    <td data-toggle="tooltip" title="Belum ada penilaian"></td>
                                    @endif
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3>E. Ketidak Hadiran</h3>
                    <div class="table-sm">
                        <table class="table" style="width: 50%" data-toggle="tooltip" data-html="true" title="Presensi siswa dari tanggal<br/>{{ $tanggalawal }} <br/>sampai<br/> {{ $tanggalakhir }}">
                            <tbody>
                                @foreach ($presensi as $p)
                                <tr>
                                    <td width="40%">Sakit</td>
                                    <td width="60%">: {{ $p->sakit }} hari</td>
                                </tr>
                                <tr>
                                    <td>Izin</td>
                                    <td>: {{ $p->ijin }} hari</td>
                                </tr>
                                <tr>
                                    <td>Tanpa Keterangan</td>
                                    <td>: {{ $p->alpa }} hari</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h3>F. Kenaikan Kelas</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @if ($semester == 'Ganjil')
                                <td>-</td>
                                @else
                                <td>Naik / <del>Tidak naik</del> ke kelas <b>{{ str_replace("X", "XI", $kelas) }}</b></td>
                                @endif
                            </tbody>
                        </table>
                    </div><br>
                    @yield('tandatangan')
                    <div class="d-none d-print-block" style="page-break-before:always;">
                        @yield('headersiswa')
                    </div>
                    @if (null !== (collect($pelajaran)->where('idkelompok', '9')))
                    <h3>G. Deskripsi Perkembangan Karakter</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="20%">Karakter yang dibangun</th>
                                    <th class="text-center" width="80%">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ((collect($pelajaran)->where('idkelompok', '9')) as $p)
                                <tr>
                                    <td class="text-center" data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">
                                        {{ $p->nama }}
                                    </td>
                                    @foreach (collect($nilaisiswa)->where('idpelajaran', $p->idpelajaran) as $n)
                                    <td data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan ?? '' }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">
                                        @if (($p->nama == 'Integritas') AND ($n->nilaihuruf == 'A'))
                                        Ananda selalu menjunjung tinggi nilai kesetiaan, keteladanan, anti korupsi, tidak menyalahgunakan pembayaran sekolah, membayar tepat waktu serta selalu menghargai harkat martabat manusia
                                        @elseif (($p->nama == 'Integritas') AND ($n->nilaihuruf == 'B'))
                                        Ananda sangat menghargai dan setia pada teman, selalu memberi contoh perilaku yang baik pada teman dan tidak menyalahgunakan keuangan sekolah
                                        @elseif (($p->nama == 'Integritas') AND ($n->nilaihuruf == 'C'))
                                        Ananda selalu setia dan memberikan keteladanan perilaku yang baik pada teman sekelas
                                        @elseif (($p->nama == 'Religius') AND ($n->nilaihuruf == 'A'))
                                        Ananda menunjukkan ketagwaan yang tinggi selalu taat dan tertib menjalankan ibadah dengan sholat berjamaah di masjid,menjauhi larangan agama serta toleran pada penganut agama yang berbeda
                                        @elseif (($p->nama == 'Religius') AND ($n->nilaihuruf == 'B'))
                                        Ananda selalu taat dan tertib menjalankan ibadah setiap hari serta selalu menjaga diri dari perbuatan yang di larang agama
                                        @elseif (($p->nama == 'Religius') AND ($n->nilaihuruf == 'C'))
                                        Ananda menunjukan perilaku taat dan tertib beribadah setiap hari
                                        @elseif (($p->nama == 'Nasionalis') AND ($n->nilaihuruf == 'A'))
                                        Ananda selalu menunjukkan sikap disiplin yang tinggi, cinta damai, taat pada peratauran hukum dan tidak pernah melakukan pelanggaran ringan, sedang berat atau berat sesuai tata tertib yang menjadi aturan sekolah
                                        @elseif (($p->nama == 'Nasionalis') AND ($n->nilaihuruf == 'B'))
                                        Ananda selalu menunjukkan sikap disiplin yang tinggi, mentaati peraturan lalu lintas dan tata tertib sekolah serta mempunyai rasa cinta damai yang tinggi
                                        @elseif (($p->nama == 'Nasionalis') AND ($n->nilaihuruf == 'C'))
                                        Ananda selalu berdisiplin dan taat pada tata tertib sekolah serta aktif mengikuti kegiatan upacara
                                        @elseif (($p->nama == 'Mandiri') AND ($n->nilaihuruf == 'A'))
                                        Ananda selalu menunjukkan sikap kerja keras yang tinggi, tidak gampang mengeluh selalu bersemangat, kreatif, memiliki daya juang serta berwawasan dan teknologi dalam setiap kegiatan pembelajaran di sekolah
                                        @elseif (($p->nama == 'Mandiri') AND ($n->nilaihuruf == 'B'))
                                        Ananda selalu menunjukkan sikap kerja keras yang tinggi, kreatif, memiliki daya juang yang kuat dalam setiap kegiatan
                                        @elseif (($p->nama == 'Mandiri') AND ($n->nilaihuruf == 'C'))
                                        Ananda selalu menunjukkan sikap kerja keras yang tinggi, kreatif dalam setiap kegiatan serta suka membantu teman di sekolah.
                                        @elseif (($p->nama == 'Gotong Royong') AND ($n->nilaihuruf == 'A'))
                                        Ananda selalu menunjukkan sikap kerelawanan, saling tolong menolong, tidak membeda bedakan teman, serta selalu bermusyawarah dalam menyelesaiakan permasalahan
                                        @elseif (($p->nama == 'Gotong Royong') AND ($n->nilaihuruf == 'B'))
                                        Ananda selalu menunjukkan sikap suka tolong menolong, tidak membeda bedakan teman, serta selalu bermusyawarah dalam menyelesaikan permasalahan
                                        @elseif (($p->nama == 'Gotong Royong') AND ($n->nilaihuruf == 'C'))
                                        Ananda selalu menunjukkan sikap suka tolong menolong, serta selalu bermusyawarah dalam menyelesaikan permasalahan
                                        @else Kurang baik
                                        @endif</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <h3>H. Catatan Perkembangan Karakter</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        Ananda perlu meningkatkan kompetensi pengetahuan sebagai bekal pembelajaran kompetensi kejuruan di semester selanjutnya.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br><br><br>
                    @yield('tandatangan')
                </div> <!-- akhir printme -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Library for adding dinamically elements -->
<script src="{{ asset('assets/js/JsBarcode.all.min.js') }}"></script>
<script>
function printDiv(divName){
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    var originalBackground = document.body.style.backgroundColor;
    document.body.innerHTML = printContents;
    var all = document.getElementsByClassName("table");
    for (var i = 0; i < all.length; i++) { all[i].classList.add("tabel"); } var
        all=document.getElementsByClassName("siswa"); for (var i=0; i < all.length; i++) { all[i].classList.add("cetak"); }
        document.body.style.backgroundColor="white" ; document.body.style.color="black" ; window.print();
        document.body.innerHTML=originalContents; document.body.style.backgroundColor=originalBackground; location.reload();
        }
</script>
<script>
JsBarcode("#barcode", "201902-{{ $nis ?? '' }}", {
    format: "CODE128",
    lineColor: "#000",
    width: 1.6,
    height: 45,
    fontSize: 14,
    displayValue: true
    });</script>
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })</script>

<script>
// popovers initialization - on hover
$('[data-toggle="popover-hover"]').popover({
    html: true,
    trigger: 'hover',
    placement: 'bottom',
    content: function () { return '<img src="' + $(this).data('img') + '" />'; }
    });
// popovers initialization - on click
$('[data-toggle="popover-click"]').popover({
    html: true,
    trigger: 'click',
    placement: 'bottom',
    content: function () { return '<img src="' + $(this).data('img') + '" />'; }
    });
</script>
@endsection
