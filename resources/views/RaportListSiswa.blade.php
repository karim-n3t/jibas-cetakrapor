@extends('layouts.app')

@section('title', 'Raport')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">
                        Daftar Siswa Kelas {{ $kelas }} Tahun Ajaran {{ $tahunajaran ?? '' }} Semetser {{ $semester }} ({{ $kelasid }})
                    </h4>
                </div>
                <div class="card-body print" id="printMe">
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                <td width="20%">Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi</td>
                                <td width="40%">
                                    : {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}
                                </td>
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
                    <hr style="border: 1px solid black">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">NISN</th>
                                    <th class="text-center">Nama Siswa</th>
                                    <th class="text-center">Tgl Lahir</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="action text-center d-none d-xl-block">Aksi</th>
                                    <th class="action text-center d-none d-md-block d-xl-none">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_array($siswa))
                                @php ($i = 1) @endphp
                                @foreach ($siswa as $s)
                                @php ($nilaimin = (collect($nilaisiswamin)->where('nis', $s->nis)->take(1))) @endphp
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td class="text-center">{{ $s->nis }}</td>
                                    <td class="text-center">{{ $s->nisn }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->tgllahir }}</td>
                                    <td class="text-center">
                                        @foreach ($nilaimin as $nm)
                                        @if ($nm->nilai >= 70)
                                        <a href="{{ route('Cetak Raport', ['kelas' => $kelasid, 'nis' => $s->nis]) }}">Tuntas</a>
                                        @else
                                        <a href="{{ route('Cetak Raport', ['kelas' => $kelasid, 'nis' => $s->nis]) }}">Belum Tuntas</a>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center d-none d-xl-block">
                                        <a href="{{ route('Cetak Raport', ['kelas' => $kelasid, 'nis' => $s->nis]) }}" class="btn btn-sm btn-outline-info">
                                            <i class="material-icons">file_copy</i> Raport
                                        </a>
                                        <a href="{{ route('Cetak Raport', ['kelas' => $kelasid, 'nis' => $s->nis]) }}/cetak" class="btn btn-sm btn-outline-secondary">
                                            <i class="material-icons">print</i> Cetak
                                        </a>
                                    </td>
                                    <td class="text-center d-none d-md-block d-xl-none">
                                        <div class="dropdown show">
                                            <a class="btn btn-sm btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('Cetak Raport', ['kelas' => $kelasid, 'nis' => $s->nis]) }}">
                                                    <i class="material-icons" style="font-size: 1.1rem;">file_copy</i>&nbsp; Raport
                                                </a>
                                                <a class="dropdown-item" href="{{ route('Cetak Raport', ['kelas' => $kelasid, 'nis' => $s->nis]) }}/cetak">
                                                    <i class="material-icons" style="font-size: 1.1rem;">print</i>&nbsp; Cetak
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php ($i++) @endphp
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
