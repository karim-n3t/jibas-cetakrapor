@extends('layouts.app', ['activePage' => 'PresensiHarian', 'titlePage' => __('Presensi Harian Pegawai')])

@section('css')
<!-- css yang digunakan ketika dalam mode screen -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

<!-- ss yang digunakan tampilkan ketika dalam mode print -->
<link href="{{ asset('assets/css/print.css') }}" rel="stylesheet">

<style type="text/css" media="print">
  @page {
    size: 210mm 297mm;
    /* auto is the initial value */
    margin: 10mm 10mm 10mm 20mm;
    /* this affects the margin in the printer settings t,r,b,l */
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-icon">
          <i class="material-icons">today</i>
        </div>
        <h4 class="card-title">Pilihan Rekap Presensi</h4>
      </div>
      <div class="card-body ">
        <form action="{{ action('Presensi@harian') }}" method="POST">
          <div class="row">
            {{ csrf_field() }}
            <div class="col">
              <div class="form-group">
                <input type="text" class="form-control datetimepicker" data-style="btn btn-link"
                  name="tanggal" required>
              </div>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-fill btn-rose">Tampilkan</button>
            </div>
            <div class="col">
              <button id="cetak" class="btn btn-fill btn-rose"
                onclick="printDiv('printMe')">Cetak</button>
            </div>
            <div class="col">
              <button class="btn btn-fill btn-rose" onclick="printDivLandscape('printMe')">Cetak
                Landscape</button>
            </div>
          </div>
        </form>
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
        <h4 class="card-title ">Presensi Harian Tanggal
          {{ Carbon\Carbon::parse($tanggal)->formatLocalized('%e %B %Y') }}</h4>
      </div>
      <div class="card-body" id="printMe">
        <!-- tampilkan ketika dalam mode print -->
        <div class="d-none d-print-block">
          <img src="{{asset('assets/img/logo/logo_binawiyata.png')}}" alt="" width="12%" class="float-left">
          <img src="{{asset('assets/img/logo/Quality-ISO-9001-PMS302.jpg')}}" alt="" width="7%" class="float-right">
          <center>
            <h5 style="margin-bottom: 1.2px;font-size: 1.1rem;font-weight: 400;">YAYASAN PENDIDIKAN
              BINAWIYATA SRAGEN</h5>
            <h5 style="margin-bottom: 1px;font-size: 1rem;">SEKOLAH MENENGAH KEJURUAN TEKNOLOGI INDUSTRI
            </h5>
            <h4 style="margin-bottom: 1px;font-size: 1.5rem;"><b>SMK BINAWIYATA KARANGMALANG SRAGEN</b>
            </h4>
            <h6 style="margin-bottom: 1px;font-size: 1rem;">TERAKREDITASI : A</h6>
            Alamat : Jl. Abimanyu No. 18 Taman Asri, Sragen 57221. Telp 0271-891818<br />
            Website : http://www.smkbinawiyatasragen.sch.id. email : smkbw_srg@yahoo.com<br />
            <hr style="border: 1px solid black;">
            <h4>Daftar Kehadiran Guru dan Karyawan</h4>
            <h4>Tanggal {{ Carbon\Carbon::parse($tanggal)->formatLocalized('%e %B %Y') }}</h4>
            <br />
          </center>
        </div>

        <div class="table-responsive">
          <table class="table" id="tabel">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Foto</th>
                <th>Nama</th>
                <th class="text-center">Jam Datang</th>
                <th class="text-center">Jam Pulang</th>
                <th class="text-center td-actions">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($harian as $h)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center"><img src="data:image/png;base64, {{ base64_encode($h->foto) }}" alt="Foto" style="width:45px;height:60px;"></td>
                <td>{{ $h->nama }}<br>{{ $h->nip }}</td>
                <td class="text-center">{{ $h->time_in }}</td>
                <td class="text-center">{{ $h->time_out }}</td>
                <td class="text-center td-actions"><a href="" class="btn btn-sm btn-success"><i
                      class="material-icons">search</i> Lihat</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <table class="d-none d-print-block" width="100%">
          <tbody>
            <tr>
              <td width="80%"> </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  $( document ).ready(function() {
    // Handler for .ready() called.
    $('select[name=tahun]').val("2020");
    $('select[name=bulan]').val("01");
    $('.selectpicker').selectpicker('refresh');
  });
</script>
<script>
  function printDiv(divName){
			var styledetailinfo = document.getElementById("detailinfo").style.color;
			document.getElementById("detailinfo").style.color = "black";
			var all = document.getElementsByClassName('taktercapai');
			for (var i = 0; i < all.length; i++) {
				all[i].setAttribute('style', 'background-color: #ff0000d0 !important');
				}
			var element = document.getElementById("tabel");
			element.classList.add("tabel");
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			var originalBackground = document.body.style.backgroundColor;
			document.body.innerHTML = printContents;
			var all = document.getElementsByClassName('td-actions');
			for (var i = 0; i < all.length; i++) {
				all[i].style.display = 'none';
				}
			document.body.style.backgroundColor = "white";
			window.print();
			document.body.innerHTML = originalContents;
			document.body.style.backgroundColor = originalBackground;
			document.getElementById("detailinfo").style.color = styledetailinfo;
			var element = document.getElementById("tabel");
			element.classList.remove("tabel");
			location.reload();

		}
</script>

<script type="text/javascript">
    $(function () {
         $('.datetimepicker').datetimepicker({
           format: 'YYYY-MM-DD',
           icons: {
          time: "fa fa-clock-o",
          date: "fa fa-calendar",
          up: "fa fa-chevron-up",
          down: "fa fa-chevron-down",
          previous: 'fa fa-chevron-left',
          next: 'fa fa-chevron-right',
          today: 'fa fa-screenshot',
          clear: 'fa fa-trash',
          close: 'fa fa-remove'
          }
         });
       });
  </script>
@endpush
