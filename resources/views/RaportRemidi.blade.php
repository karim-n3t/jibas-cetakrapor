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
                    <h4 class="card-title">Pengaturan Remidi</h4>
                </div>
                <div class="card-body ">
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                <td width="20%">Departemen<br>Tahun ajaran<br>Semester</td>
                                <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>:
                                    {{ $semester }}</td>
                                <td><button id="cetak" class="btn btn-fill btn-rose"
                                        onclick="printDiv('printMe')">Cetak</button></td>
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
                    <h4 class="card-title">Daftar Reimidi Kelas {{ $kelas }} Tahun Ajaran
                        {{ $tahunajaran ?? '' }} Semetser {{ $semester }}</h4>
                </div>
                <div class="card-body print" id="printMe">
                    <div class="d-none d-print-block">
                        <center>
                            <h4>Daftar Siswa Remidi</h4>
                            <h4>SMK Binawiyata Karangmalang Sragen</b></h4>
                            <hr style="border: 1px solid black;">
                        </center>
                    </div>
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                <td width="20%">Tahun ajaran<br>Semester<br>Kelas<br>Wali Kelas</td>
                                <td width="40%">
                                    : {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $kelas }}<br>: {{ $walikelas }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama Sisiwa</th>
                                <th class="text-center">Pelajaran</th>
                                <th class="text-center">Aspek</th>
                                <th class="text-center">Keterangan</td>
                                <th class="text-center">Guru Mapel</td>
                            </thead>
                            <tbody>
                                @foreach ($remidi as $r)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        {{ $r->nis }}
                                    </td>
                                    <td>
                                        {{ $r->nama }}
                                    </td>
                                    <td>
                                        {{ $r->mapel }}
                                    </td>
                                    <td class="text-center">
                                        @if ($r->aspek == "PNGT") P
                                        @elseif ($r->aspek == "PRAK") K
                                        @elseif ($r->aspek == "PSIK") S
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $r->nilaiangka }}
                                    </td>
                                    <td class="text-center">
                                        {!! collect(collect($pegawai)->where('nip', $r->nipguru)->first())->get('nama') !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <!-- Library for adding dinamically elements -->
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
        $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    </script>

    <script src="{{ asset('assets/js/plugins/jquery.rowspanizer.min.js')}}"></script>

    @endsection
