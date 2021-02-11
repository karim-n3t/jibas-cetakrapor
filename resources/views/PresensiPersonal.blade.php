@extends('layouts.app')

@section('title', 'Rekap Presensi')

@section('head')
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">perm_identity</i>
                    </div>
                    <h4 class="card-title">Presensi Harian Tanggal
                        {{ Carbon\Carbon::parse($tanggal)->formatLocalized('%e %B %Y') }}</h4>
                </div>
                <div class="card-body ">
                    <form action="{{ action('Presensi@personal') }}" method="POST">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col">
                                <select class="form-control selectpicker" data-style="btn btn-link" name="nip" required>
                                    @foreach ($pegawai as $p)
                                    <option value="{{ $p->nip }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select> </div>
                            <div class="col">
                                <button type="submit" class="btn btn-fill btn-rose">Tampilkan</button>
                                <button type="reset" class="btn btn-fill btn-rose">Reset</button>
                            </div>
                        </div>
                    </form><br><br>
                    @foreach ($jadwals as $j)
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Hari, Tanggal</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ Carbon\Carbon::parse($tanggal)->formatLocalized('%A, %e %B %Y') }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Pendataan Presensi</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" value="@if ($waktu >= $j->masukaw && $waktu < $j->masukak) Masuk @else Pulang @endif" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Jadwal Presensi</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" value="@if ($waktu >= $j->masukaw && $waktu < $j->masukak) {{ $j->masukaw }} - {{ $j->masukak }} @else {{ $j->pulangaw }} - {{ $j->pulangak }} @endif" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Waktu Saat ini</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $waktu }}" disabled>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @foreach ($personal as $pers)
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img src="data:image/png;base64, {{ base64_encode($pers->foto) }}" alt="Foto"
                            style="width:120px;height:150px;">
                    </a>
                </div>
                <div class="card-body">

                    <h6 class="card-category text-gray">{{ $pers->bagian }}</h6>
                    <h4 class="card-title">{{ $pers->nama }}</h4>
                    <p class="card-description">
                        Don't be scared of the truth because we need to restart the human foundation in truth And I love
                        you
                        like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                    </p>
                    <a href="#pablo" class="btn btn-rose btn-round">Follow</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $( document ).ready(function() {
      // Handler for .ready() called.
      $('select[name=tahun]').val("2020");
      $('select[name=bulan]').val("01");
      $('.selectpicker').selectpicker('refresh');
    });
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
    @endsection
