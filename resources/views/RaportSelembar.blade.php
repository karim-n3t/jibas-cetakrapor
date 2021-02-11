@extends('layouts.app')

@section('title', 'Raport')

@section('head')
<!-- css yang digunakan ketika dalam mode screen -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

<!-- ss yang digunakan tampilkan ketika dalam mode print -->
<link href="{{ asset('assets/css/cetakraport.css') }}" rel="stylesheet">

<style type="text/css" media="print">
    @page {
        size: 210mm 297mm;
        /* auto is the initial value */
        margin: 10mm 15mm 8mm 15mm;
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
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Pengaturan Cetak Raport</h4>
                </div>
                <div class="card-body ">
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                <td width="20%">
                                    Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi
                                </td>
                                <td width="40%">
                                    : {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
                                <td>
                                    <button id="cetak" class="btn btn-fill btn-rose" onclick="printDiv('printMe')">Cetak</button>
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
                    <h4 class="card-title">Draft RaportCetak</h4>
                </div>
                <div class="card-body print" id="printMe">
                    @if ((collect($siswaremidi)->count()) == 0)
                        <h2> Mohon maaf, rapor sementara untuk kelas ini tidak bisa dicetak </h2>
                    @else
                    @foreach ($siswaremidi as $s)
                    <!-- tampilkan ketika dalam mode print -->
                    <div class="d-none d-print-block" style="page-break-before:always;">
                        <img src="{{ asset('assets/img/logo/logo_binawiyata.png') }}" alt="" width="12%" class="float-left">
                        <img src="{{ asset('assets/img/logo/Quality-ISO-9001-PMS302.jpg') }}" alt="" width="7%" class="float-right">
                        <center>
                            <h5 style="margin-bottom: 1.2px;font-size: 1.1rem;font-weight: 400;">YAYASAN PENDIDIKAN BINAWIYATA SRAGEN</h5>
                            <h5 style="margin-bottom: 1px;font-size: 1rem;">SEKOLAH MENENGAH KEJURUAN TEKNOLOGI INDUSTRI</h5>
                            <h4 style="margin-bottom: 1px;font-size: 1.5rem;"><b>SMK BINAWIYATA KARANGMALANG SRAGEN</b></h4>
                            <h6 style="margin-bottom: 1px;font-size: 1rem;">TERAKREDITASI : A</h6>
                            Alamat : Jl. Abimanyu No. 18 Taman Asri, Sragen 57221. Telp 0271-891818<br />
                            Website : www.smkbinawiyatasragen.sch.id | Email : smkbw_srg@yahoo.com<br />
                            <hr style="border: 1px solid black;">
                        </center>
                    </div>
                    <div class="d-none d-print-block">
                        <h5>
                            <strong>
                                <center>SALINAN CAPAIAN HASIL BELAJAR PESERTA DIDIK<br />TAHUN PELAJARAN {{ $tahunajaran }}</center>
                            </strong>
                        </h5>
                    </div>
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                @php ($nis = $s->nis) @endphp
                                <td width="20%" data-toggle="popover-hover" data-img="data:image/png;base64,{{ $foto ?? '' }}">
                                    Nama Peserta Didik<br>Nomor Induk/NISN<br>Kelas/Semester
                                </td>
                                <td width="40%">
                                    : {{ $s->nama }}<br>: {{ $s->nis }} / {{ $s->nisn }}<br>: {{ $kelas }} / {{ $semester }}
                                </td>
                                <td width="40%" class="text-right align-top">
                                    <div class="d-none d-sm-none d-md-block d-print-block"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th class="text-center"><strong>No</strong></th>
                                <th class="text-center"><strong>Mata Pelajaran</strong></th>
                                @if (isset($aspek))
                                @foreach ($aspek as $a)
                                <th class="text-center" data-toggle="tooltip" title="{{ $a->keterangan }} ({{ $a->dasarpenilaian }})">
                                    <strong>{{ $a->keterangan }}</strong>
                                </th>
                                @endforeach
                                @php ($naspek = count($aspek)) @endphp
                                @else
                                @php ($naspek = 0) @endphp
                                @endif
                                <th class="text-center"><strong>Nilai Akhir</strong></th>
                                <th class="text-center"><strong>Predikat</strong></th>
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
                                    @php ($colspan = 0) @endphp
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
                                    <td class="text-center" data-toggle="tooltip" title="Belum ada penilaian">
                                    </td>
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
                                    <td class="text-center" data-toggle="tooltip" data-html="true" title="
                                    @foreach (collect($pegawai)->where('nip', $nipguru) as $p) {{ $p->nama }} <br/> {{ $p->nip }} @endforeach
                                    <br/>
                                    @foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru) as $g) <b>{{ $g->grade }}</b> : {{ $g->nmin }} - {{ $g->nmax }} <br/> @endforeach">
                                        @foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru)->where('nmin', '<=', number_format($ratanilai) ?? '' )->where('nmax', '>=', number_format($ratanilai) ?? '') as $g)
                                        {{ $g->grade }}
                                        @endforeach
                                    </td>
                                    @endif
                                </tr>@php ($i++) @endphp
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4><strong>Ekstrakurikuler Wajib</strong></h4>
                    <div class="table-responsive">
                        <table width="100%" class="table-borderless cetak">
                            <tbody>
                                @foreach ((collect($pelajaran)->where('idkelompok', '8')) as $p)
                                <tr>
                                    <td width="30%" data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">
                                        - {{ $p->nama }}
                                    </td>
                                    @php ($nilai = (collect($nilaisiswa)->where('idpelajaran', $p->idpelajaran)->take(1))) @endphp
                                    @if ($nilai->count() > 0)
                                    @foreach ($nilai as $n)
                                    @php ($idpelajaran = $n->idpelajaran) @endphp
                                    @php ($nipguru = $n->nipguru) @endphp
                                    <td width="70%" data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">
                                        : Melaksanakan kegiatan {{ $p->nama }} dengan @if ($n->nilaihuruf == 'A') Sangat baik @elseif ($n->nilaihuruf == 'B') Baik @elseif ($n->nilaihuruf == 'C') Cukup baik @elseif ($n->nilaihuruf == 'D') Kurang baik @else Tidak aktif @endif
                                    </td>
                                    @endforeach
                                    @else
                                    <td data-toggle="tooltip" title="Belum ada penilaian"></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><br />
                    <h4><strong>Ketidak Hadiran</strong></h4>
                    <div class="table-responsive">
                        <table class="table-borderless cetak" style="width: 50%" data-toggle="tooltip" data-html="true" title="Presensi siswa dari tanggal<br/>{{ $tanggalawal }} <br/>sampai<br/> {{ $tanggalakhir }}" style="color:black">
                            <tbody>
                                @foreach ((collect($presensi)->firstWhere('nis', $s->nis)) as $p)
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
                    </div><br />
                    <h4><strong>Catatan Akademik</strong></h4>
                    @if (isset($nilaisiswa))
                    <p>Ananda perlu meningkatkan kompetensi pengetahuan
                        @foreach (collect($nilaisiswa)->where('dasarpenilaian', 'PNGT')->sortBy('nilaiangka')->take(3) as $n)
                          {{ $n->nama }},
                        @endforeach
                        sebagai bekal pembelajaran kompetensi kejuruan di semester selanjutnya.</p>
                    @endif <br />
                    <div class="d-none d-print-block">
                        <table class="table-borderless cetak" width="100%" style="color:black">
                            <tbody>
                                <tr>
                                    <td width="5%"> </td>
                                    <td width="70%">
                                        <br>Orang Tua/Wali<br><br><br><br><strong>@if ($s->almayah == 0) {{ $s->namaayah }} @else {{ $s->namaibu }} @endif</strong><br><br>
                                    </td>
                                    <td width="25%">
                                        Sragen, {{ Carbon\Carbon::parse($tanggalraport)->formatLocalized('%e %B %Y') }}<br>
                                        Wali kelas {{ $kelas }}<br><br><br><br>
                                        <strong>{{ $walikelas }}</strong><br>
                                        NIP. -
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @endif
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
        for (var i = 0; i < all.length; i++) {
          all[i].classList.add("tabel");
        }
        var all = document.getElementsByClassName("siswa");
        for (var i = 0; i < all.length; i++) {
          all[i].classList.add("cetak");
        }
        document.body.style.backgroundColor = "white";
        document.body.style.color = "black";
        window.print();
        document.body.innerHTML = originalContents;
        document.body.style.backgroundColor = originalBackground;
        location.reload();

      }
</script>

<script>
    JsBarcode("#barcode", "201901-{{ $nis ?? '' }}", {
        format: "CODE128",
        lineColor: "#000",
        width: 1.6,
        height: 45,
        fontSize: 14,
        displayValue: true
      });
</script>
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>

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
