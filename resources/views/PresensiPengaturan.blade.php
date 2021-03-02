@extends('layouts.app', ['activePage' => 'PresensiPengaturan', 'titlePage' => __('Pengaturan Presensi Pegawai')])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">Pengaturan Presensi</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Hari Kerja</th>
                <th>Hari Efektif</th>
                <th>Jam Pulang</th>
                <th>Tanggal TTD</th>
                <th class="text-right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pengaturan as $p)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $p->nama_bulan }}</td>
                <td>{{ $p->tahun }}</td>
                <td>{{ $p->hari_kerja }} hari</td>
                <td>{{ $p->hari_efektif }} hari</td>
                <td>{{ $p->jam_pulang }}</td>
                <td>{{ $p->ttds }}</td>
                <td class="td-actions text-right">
                  <button type="button" rel="tooltip" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
                    <i class="material-icons">edit</i> Edit
                  </button>
                  <button type="button" rel="tooltip" class="btn btn-sm btn-danger">
                    <i class="material-icons">close</i> Hapus
                  </button>
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
