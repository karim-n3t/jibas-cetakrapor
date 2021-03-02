@extends('layouts.app', ['activePage' => 'PresensiPerorangan', 'titlePage' => __('Presensi Perorangan Pegawai')])

@section('css')
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
        <form action="{{ route('PresensiPerorangan') }}" method="POST">
          <div class="row">
          {{ csrf_field() }}
            <div class="col">
              <select class="form-control selectpicker" data-style="btn btn-link" name="nip" required>
                @foreach ($pegawai as $p)
                <option value="{{ $p->nip }}">{{ $p->nama }}</option>
                @endforeach
              </select>
            </div>
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
        <h4 class="card-title ">Presensi Perorangan Bulan {{ $nama_bulan }} {{ $tahun }}</h4>
      </div>
      <div class="card-body" id="printMe">
        <!-- tampilkan ketika dalam mode print -->
        <div class="d-none d-print-block">
          <center>
            <h4>Data Kehadiran Guru dan Karyawan</h4>
            <h4>Tanggal {{ Carbon\Carbon::parse($tanggal_awal)->formatLocalized('%e %B %Y') }} sampai {{ Carbon\Carbon::parse($tanggal_akhir)->formatLocalized('%e %B %Y') }}</h4>
            <br/>
          </center>
        </div>
        <table class="table-borderless"  width="100%" id="detailinfo">
          <tbody>
            <tr>
              @foreach ($rekap as $r)
              <td width="20%">NIP/NIK <br>Nama <br>Tanggal Presensi <br>Hari Efektif</td>
              <td width="50%">: {{ $r->nip }} <br>: {{ $r->nama }}<br>: {{ Carbon\Carbon::parse($tanggal_awal)->formatLocalized('%e') }} sampai {{ Carbon\Carbon::parse($tanggal_akhir)->formatLocalized('%e %B %Y') }}<br>: {{ $hari_efektif }} hari</td>
              <td width="20%">Presensi Datang <br>Presensi Pulang <br>Tidak hadir <br>Hari kerja</td>
              <td width="10%">: {{ $r->datang }} kali<br>: {{ $r->pulang }} kali<br>: {{ $r->tidakhadir }} hari<br>: {{ $hari_kerja }} hari</td>
              @endforeach
            </tr>
          </tbody>
        </table><br>
        <div class="table-responsive">
          <table class="table" id="tabel">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Hari</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Status</th>
                <th class="text-center">Waktu Masuk</th>
                <th class="text-center">Waktu Pulang</th>
                <th class="text-center">Waktu Kerja</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Sumber</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($perorangan))
              @foreach ($perorangan as $p)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $p->hari }}</td>
                <td class="text-center">{{ $p->tanggals }}</td>
                <td class="text-center @if(($p->status === 5)) red @endif">{{ $p->statuss }}</td>
                <td class="text-center">@if(empty($p->jammasuk)) - @else {{ $p->jammasuk }} @endif</td>
                <td class="text-center @if(empty($p->jampulangfix)&&!empty($p->jammasuk))yellow @endif">@if(empty($p->jampulangfix)&&!empty($p->jammasuk))Tidak presensi @elseif(empty($p->jampulangfix)&&empty($p->jammasuk)) - @else {{ $p->jampulangfix }} @endif</td>
                <td class="text-center">@if(empty($p->waktukerja)) 00 jam 00 menit @else {{ $p->waktukerja }} @endif</td>
                <td class="text-center">{{ $p->keterangan }}</td>
                <td class="text-center">{{ $p->source }}</td>
              </tr>
              @endforeach
              @endif
              @if (isset($presensi))
              @foreach ($presensi as $p)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $p->hari }}</td>
                <td class="text-center">{{ $p->tanggals }}</td>
                <td class="text-center">@if(($p->reportsisfo)=== 1) Dilaporkan @else @endif</td>
                <td class="text-center">@if(empty($p->time_in)) - @else {{ $p->time_in }} @endif</td>
                <td class="text-center">@if(empty($p->time_out)) Tidak presensi @else {{ $p->time_out }} @endif</td>
                <td class="text-center">@if(empty($p->waktukerja)) 00 jam 00 menit @else {{ $p->waktukerja }} @endif</td>
                <td class="text-center">@if(($p->active === 1)) Aktif @endif </td>
                <td class="text-center">@if(($p->source)=== 'F') Finger @elseif(($p->source)=== 'M') Manual @endif</td>
              </tr>
              @endforeach
              @endif
              <tr>
                @foreach ($rekap as $r)
                <td colspan="6"><strong>Total jam kerja</strong><br>Target jam kehadiran adalah {{ $hari_efektif }} X 8 jam ({{ $jamkerjatarget }} jam)</td>
                <td class="text-center">{{ $r->jamkerja }}</td>
                <td colspan="2" class="@if(($r->capaian !== 'Terpenuhi')) red @else green @endif">Persentase waktu kerja {{ $r->persen }}%<br>({{ $r->capaian }})</td>
                @endforeach
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script>
$( document ).ready(function() {
  // Handler for .ready() called.
  @foreach ($rekap as $r)
    $('select[name=nip]').val("{{ $r->nip }}");
    $('select[name=tahun]').val("{{ $tahun }}");
    $('select[name=bulan]').val("{{ $bulan }}");
    $('.selectpicker').selectpicker('refresh');
  @endforeach
});
  </script>

<script>
    function printDiv(divName){
        var styledetailinfo = document.getElementById("detailinfo").style.color;
        document.getElementById("detailinfo").style.color = "black";
        var all = document.getElementsByClassName('red');
        for (var i = 0; i < all.length; i++) {
            all[i].setAttribute('style', 'background-color: #ff0000d0 !important');
            }
        var all = document.getElementsByClassName('green');
        for (var i = 0; i < all.length; i++) {
            all[i].setAttribute('style', 'background-color: #00ff00d0 !important');
            }
        var all = document.getElementsByClassName('yellow');
        for (var i = 0; i < all.length; i++) {
            all[i].setAttribute('style', 'background-color: #ffff00d0 !important');
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
@endpush
