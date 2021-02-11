@extends('layouts.app')

@section('title', 'Rekap Presensi')

@section('head')
  <!-- css yang digunakan ketika dalam mode screen -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- ss yang digunakan tampilkan ketika dalam mode print -->
  <link href="{{ asset('assets/css/print.css') }}" rel="stylesheet">

  <style type="text/css" media="print">
    @page
    {
      size:  210mm 297mm;   /* auto is the initial value */
      margin: 10mm 10mm 10mm 20mm;  /* this affects the margin in the printer settings t,r,b,l */
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
            <h4 class="card-title">Pilihan Rekap Presensi</h4>
          </div>
          <div class="card-body ">
            <form action="{{ action('Presensi@rekap') }}" method="POST">
              <div class="row">
              {{ csrf_field() }}
                <div class="col">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="bulan" required>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8" >Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
                <div class="col">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="tahun" required>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                  </select>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-fill btn-rose">Tampilkan</button>
                </div>
                <div class="col">
                  <button id="cetak" class="btn btn-fill btn-rose" onclick="printDiv('printMe')">Cetak</button>
                </div>
                <div class="col">
                  <button class="btn btn-fill btn-rose" onclick="printDivLandscape('printMe')">Cetak Landscape</button>
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
            <h4 class="card-title ">Rekap Presensi Bulan {{ $nama_bulan }} {{ $tahun }}</h4>
          </div>
          <div class="card-body" id="printMe">
            <!-- tampilkan ketika dalam mode print -->
            <div  class="d-none d-print-block">
              <img src="assets/img/logo/logo_binawiyata.png" alt="" width="12%" class="float-left">
              <img src="assets/img/logo/Quality-ISO-9001-PMS302.jpg" alt="" width="7%" class="float-right">
              <center>
                  <h5 style="margin-bottom: 1.2px;font-size: 1.1rem;font-weight: 400;">YAYASAN PENDIDIKAN BINAWIYATA SRAGEN</h5>
                  <h5 style="margin-bottom: 1px;font-size: 1rem;">SEKOLAH MENENGAH KEJURUAN TEKNOLOGI INDUSTRI</h5>
                  <h4 style="margin-bottom: 1px;font-size: 1.5rem;"><b>SMK BINAWIYATA KARANGMALANG SRAGEN</b></h4>
                  <h6 style="margin-bottom: 1px;font-size: 1rem;">TERAKREDITASI : A</h6>
                  Alamat : Jl. Abimanyu No. 18 Taman Asri, Sragen 57221. Telp 0271-891818<br/>
                  Website : http://www.smkbinawiyatasragen.sch.id. email : smkbw_srg@yahoo.com<br/>
                  <hr style="border: 1px solid black;">
                  <h4>Rekapitulasi Kehadiran Guru dan Karyawan</h4>
                  <h4>Tanggal {{ Carbon\Carbon::parse($tanggal_awal)->formatLocalized('%e %B %Y') }}
                  sampai {{ Carbon\Carbon::parse($tanggal_akhir)->formatLocalized('%e %B %Y') }}</h4>
                  <br/>
              </center>
            </div>
            <table class="table-borderless"  width="100%" id="detailinfo">
              <tbody>
                <tr>
                  <td width="20%">Hari Kerja <br>Hari Efektif <br>Target Jam Kehadiran</td>
                  <td width="80%">: {{ $hari_kerja }} hari<br>: {{ $hari_efektif }} hari<br>: {{ $jamkerjatarget }} jam</td>
                </tr>
              </tbody>
            </table><br>
            <div class="table-responsive">
              <table class="table" id="tabel">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Nama</th>
                    <th class="text-center">Jumlah Datang</th>
                    <th class="text-center">Jumlah Pulang</th>
                    <th class="text-center">Tidak Hadir</th>
                    <th class="text-center">Jumlah Jam</th>
                    <th class="text-center">Prosentase</th>
                    <th class="text-center">Pencapaian</th>
                    <th class="text-center td-actions">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rekap as $r)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $r->nama }}<br>{{ $r->nip }}</td>
                    <td class="text-center">{{ $r->datang }} hari</td>
                    <td class="text-center">{{ $r->pulang }} hari</td>
                    <td class="text-center">{{ $r->tidakhadir }} hari</td>
                    <td class="text-center">{{ $r->jamkerja }} jam</td>
                    <td class="text-center">{{ $r->persen }} %</td>
                    <td class="text-center @if ($r->capaian === 'Tidak') taktercapai @endif">{{ $r->capaian }}</td>
                    <td class="text-center td-actions"><a href="{{ route('PresensiPerorangan') }}/{{ $r->nip }}/{{ $tahun }}-{{ $bulan }}" class="btn btn-sm btn-success"><i class="material-icons">search</i> Lihat</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <table class="d-none d-print-block" width="100%">
              <tbody>
                <tr>
                  <td width="80%">  </td>
                  <td style="color:black" width="20%"><br><br><br>Sragen, {{ Carbon\Carbon::parse($tanggal_ttd)->formatLocalized('%e %B %Y') }}<br>Kepala Sekolah<br><br><br><br>Drs. Saimin, M.M.,M.H.<br>NIP.-</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $( document ).ready(function() {
      // Handler for .ready() called.
      $('select[name=tahun]').val("{{ $tahun }}");
      $('select[name=bulan]').val("{{ $bulan }}");
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
@endsection
