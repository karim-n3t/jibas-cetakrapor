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

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Daftar Siswa Kelas {{ $kelas }} Tahun Ajaran {{ $tahunajaran ?? '' }} Semetser {{ $semester }} ({{ $kelasid }})</h4>
                </div>
                <div class="card-body d-none d-print-block print" id="printCover">
                    @foreach ($siswa as $s)
                    <div class="text-center" style="page-break-before:always;">
                        <br style="display: block;content: '';margin: 100px 0;">
                        <h3 class="text-uppercase font-weight-bold">
                            Raport Peserta Didik<br> Sekolah Menengah Kejuruan<br>(SMK)
                        </h3>
                        <br style="display: block;content: '';margin: 125px 0;">
                        <img src="{{ asset('assets/img/logo/logo_tut_wuri.svg') }}" alt="" height="250">
                        <br style="display: block;content: '';margin: 125px 0;">
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
                    </div>
                    @endforeach
                </div>
                <div class="card-body d-none d-print-block print" id="printBiodata">
                    @foreach ($siswa as $sis)
                    <div style="page-break-before:always;">
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
                    @endforeach
                </div>
                <div class="card-body print" id="printMe">
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                <td width="20%">Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi</td>
                                <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>:
                                    {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" onclick="printDiv('printCover')">
                                        <i class="material-icons">insert_drive_file</i> Cover
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="printDiv('printBiodata')">
                                        <i class="material-icons">person</i> Biodata
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" onclick="printDiv('printMe')">
                                        <i class="material-icons">print</i> Raport
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr style="border: 1px solid black">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">NISN</th>
                                <th class="text-center">Nama Siswa</th>
                            </thead>
                            <tbody>
                                @if (is_array($siswa))
                                @foreach ($siswa as $sis)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{$sis->nama}}</td>
                                    <td>{{$sis->nis}} / {{$sis->nisn}}</td>
                                    <td>{{$sis->tmplahir}},
                                    {{ Carbon\Carbon::parse($sis->tgllahir)->formatLocalized('%e %B %Y') }}</td>
                                    <td>@if ($sis->kelamin == 'l')
                                    Laki-laki
                                    @elseif ($sis->kelamin == 'p')
                                    Perempuan
                                    @endif</td>
                                    <td>{{$sis->agama}}</td>
                                    <td>{{$sis->statusayah}}</td>
                                    <td>{{$sis->anakke}}</td>
                                    <td>{{$sis->alamatsiswa}}</td>
                                    <td>{{$sis->telponsiswa}}</td>
                                    <td>{{$sis->asalsekolah}}</td>
                                    <td>@if ($sis->tahunmasuk == '2018') 16 Juli 2018 @elseif ($sis->tahunmasuk == '2019') 15 Juli 2019 @endif
                                    </td>
                                    <td>{{$sis->namaayah}}</td>
                                    <td>{{$sis->namaibu}}</td>
                                    <td>{{$sis->alamatortu}}</td>
                                    <td>{{$sis->hportu}}</td>
                                    <td>{{$sis->pekerjaanayah}}</td>
                                    <td>{{$sis->pekerjaanibu}}</td>
                                    <td>{{$sis->wali}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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
@endsection
