@extends('layouts.app')

@section('title', 'Raport')



@if ($mode === 'daftarkelas')
  @section('head')
    <!-- css yang digunakan ketika dalam mode screen -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- ss yang digunakan tampilkan ketika dalam mode print -->
    <link href="{{ asset('assets/css/cetakraport.css') }}" rel="stylesheet">

    <style type="text/css" media="print">
      @page
      {
        size:  210mm 297mm;   /* auto is the initial value */
        margin: 10mm 15mm 8mm 15mm;  /* this affects the margin in the printer settings t,r,b,l */
      }
      @media print {
        footer {page-break-after: always;}
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
              <h4 class="card-title">Daftar Kelas Tahun Ajaran {{ $tahunajaran ?? '' }} Semetser {{ $semester }}</h4>
            </div>
            <div class="card-body d-none d-print-block print" id="printSekolah">
              <div>
                <br style="display: block;content: '';margin: 50px 0;">
                <h3 class="text-uppercase font-weight-bold text-center">Rapor Peserta Didik<br>Sekolah Menengah Kejuruan<br>(SMK)</h3>
                <br style="display: block;content: '';margin: 50px 0;">
                <table class="table-borderless">
                <h3>
                  <tbody style="font-size:x-large !important; line-height:3 !important;">
                    <tr>
                      <td class="pl-5"></td>
                      <td class="pl-5">
                        Sekolah<br>
                        NPSN / NSS<br>
                        Alamat<br>
                        <br>
                        Kelurahan<br>
                        Kecamatan<br>
                        Kota/Kabupaten<br>
                        Provinsi<br>
                        Website<br>
                        Email<br>
                      </td>
                      <td class="pl-5">
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
                        SMK Binawiyata Karangmalang Sragen<br>
                        20313038 / 322031409002<br>
                        Jl. Abimanyu No. 18 Taman Asri<br>
                        Kode Pos 57221 Telp. 0271-891818<br>
                        Kroyo<br>
                        Karangmalang<br>
                        Kab. Sragen<br>
                        Jawa Tengah<br>
                        www.smkbinawiyatasragen.sch.id<br>
                        smkbw_srg@yahoo.com
                      </td>
                    </tr>
                  </tbody>
                </h3>
                </table>
              </div>
            </div>
            <div class="card-body d-none d-print-block print" id="printBiodata">
              <div>
                <h3 class="text-uppercase font-weight-bold text-center">Petunjuk Pengisian</h3>
                <br style="display: block;content: '';margin: 50px 0;">
                <table class="table-borderless" style="font-size:large; font-weight:normal; line-height:2;">
                  <tbody>
                    <tr>
                      <td class="pl-5">
                        1.<br><br>
                        2.<br><br>
                        3.<br>
                        4.<br>
                        5.<br><br>
                        6.<br><br>
                        7.<br>
                        8.<br>
                        9.<br>
                        10.<br><br>
                        11.<br>
                        12.<br><br>
                        13.<br><br>
                        14.<br><br><br>
                        15.<br><br><br>
                        16.<br><br>
                        17.<br><br><br><br><br><br><br><br>
                      </td>
                      <td class="pl-4 pr-5">
                        Rapor merupakan ringkasan hasil penilaian terhadap seluruh aktivitas pembelajaran yang dilakukan peserta didik dalam kurun waktu tertentu;<br>
                        Rapor dipergunakan selama peserta didik yang bersangkutan mengikuti seluruh program pembelajaran di Sekolah Menengah Kejuruan tersebut;<br>
                        Identitas Sekolah diisi dengan data yang sesuai dengan keberadaan Sekolah Menengah Kejuruan;<br>
                        Keterangan tentang diri Peserta didik diisi lengkap sesuai ijazah sebelumnya atau akta kelahiran;<br>
                        Rapor harus dilengkapi dengan pas foto berwarna dengan latar belakang merah (3 x 4) serta menggunakan baju putih seragam dan pengisiannya dilakukan oleh Wali Kelas;<br>
                        Capaian peserta didik dalam kompetensi pengetahuan dan kompetensi keterampilan ditulis dalam bentuk angka dan predikat untuk masing-masing mata pelajaran;<br>
                        Predikat ditulis dalam bentuk huruf sesuai kriteria;<br>
                        Catatan akademik ditulis dengan kalimat positif sesuai capaian yang diperoleh peserta didik;<br>
                        Penjelasan lebihh detail mengenai capaian kompetensi peserta didik dapat dilihat pada leger;<br>
                        Laporan Praktik Kerja Lapangan diisi berdasarkan kegiatan praktik kerja yang diikuti oleh peserta didik di industri/perusahaan mitra;<br>
                        Laporan Ekstrakurikuler diisi berdasarkan kegiatan ekstrakurikuler yang diikuti oleh peserta didik;<br>
                        Ketidakhadiran diisi dengan data akumulasi ketidakhadiran peserta didik karena sakit, izin, atau tanpa keterangan selama satu semester;<br>
                        Keterangan kenaikan kelas diisi dengan putusan apakah peserta didik naik kelas yang ditentukan melalui rapat dewan guru;<br>
                        Deskripsi perkembangan karakter diisi dengan simpulan perkembangan peserta didik terkait penumbuhan karakter baik yang dilakukan secara terprogram oleh sekolah maupun yang muncul secara spontan dari peserta didik;<br>
                        Catatan perkembangan karakter diisikan hal-hal yang tidak tercantum pada deskripsi perkembangan karakter termasuk prestasi yang diraih peserta didik pada semester berjalan dari perkembangan karakter peserta didik pada semester berjalan jika dikomparasi dengan semester sebelumnya;<br>
                        Keterangan pindah keluar sekolah diisi dengan alasan kepindahan. Sedangkan pindah masuk diisi dengan sekolah asal;<br>
                        Predikat capaian kompetensi :<br>
                        <table class="tabel text-center" style="line-height:22px;">
                          <tr class="pl-5 pr-5 font-weight-bold" style="line-height:30px;">
                            <td>Predikat/Kategori</td>
                            <td>Mapel Adaptif dan Normatif</td>
                            <td>Mapel Produktif</td>
                          </tr>
                          <tr>
                            <td>A+</td>
                            <td>&ge; 95</td>
                            <td>&ge; 95</td>
                          </tr>
                          <tr>
                            <td>A</td>
                            <td>90 - 94</td>
                            <td>90 - 94</td>
                          </tr>
                          <tr>
                            <td>A-</td>
                            <td>85 - 89</td>
                            <td>85 - 89</td>
                          </tr>
                          <tr>
                            <td>B+</td>
                            <td>80 - 84</td>
                            <td>80 - 84</td>
                          </tr>
                          <tr>
                            <td>B</td>
                            <td>75 - 79</td>
                            <td>75 - 79</td>
                          </tr>
                          <tr>
                            <td>B-</td>
                            <td>70 - 74</td>
                            <td>70 - 74</td>
                          </tr>
                          <tr>
                            <td>C</td>
                            <td>60 - 69</td>
                            <td>65 - 69</td>
                          </tr>
                          <tr>
                            <td>D</td>
                            <td>&lt; 60</td>
                            <td>&lt; 65</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div>
                </div>
              </div>
            </div>
            <div class="card-body print" id="printMe">
            <table class="table-borderless siswa"  style="color:black" width="100%">
              <tbody>
                <tr>
                  <td width="20%">Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi</td>
                  <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
                  <td>
                    <button id="cetak" class="btn btn-sm btn-outline-info" onclick="printDiv('printSekolah')"><i class="material-icons">insert_drive_file</i> Sekolah</button>
                    <button id="cetak" class="btn btn-sm btn-outline-success" onclick="printDiv('printBiodata')"><i class="material-icons">person</i> Biodata</button>
                    <button id="cetak" class="btn btn-sm btn-outline-warning" onclick="printDiv('printRaport')"><i class="material-icons">print</i> Raport</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr style="border: 1px solid black">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <th class="text-center">No</th>
                  <th class="text-center">Tingkat</th>
                  <th class="text-center">Kelas</th>
                  <th class="text-center">Wali Kelas</th>
                  <th class="text-center">Keterangan</td>
                  <th class="action text-center d-none d-md-block">Aksi</th>
                </thead>
                <tbody>
                  @php ($i = 1) @endphp
                  @foreach ($kelas as $k)
                  <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td class="text-center">@foreach (collect($tingkat)->where('replid', $k->idtingkat) as $t) {{ $t->tingkat }} @endforeach</td>
                    <td class="text-center">{{ $k->kelas }}</td>
                    <td>@foreach (collect($pegawai)->where('nip', $k->nipwali) as $p) {{ $p->nama }} <br/> {{ $p->nip }} @endforeach</td>
                    <td class="text-center">Tuntas : {{ (collect($jmlsiswaremidi)->where('idkelas', $k->replid)->where('remidi','=','0')->count()) }}, Remidi : {{ (collect($jmlsiswaremidi)->where('idkelas', $k->replid)->where('remidi','>','0')->count()) }}</td>
                    <td class="text-center d-none d-xl-block">
                      <a href="{{ route('Raport') }}/{{ $k->replid }}" class="btn btn-sm btn-outline-success"><i class="material-icons">group</i> Daftar Siswa</a>
                      <a href="{{ route('Raport') }}/{{ $k->replid }}/remidi" class="btn btn-sm btn-outline-danger"><i class="material-icons">cached</i> Daftar Remidi</a>
                    </td>
                    <td class="text-center d-none d-md-block d-xl-none">
                      <div class="dropdown show">
                        <a class="btn btn-sm btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Aksi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="{{ route('Raport') }}/{{ $k->replid }}"><i class="material-icons" style="font-size: 1.1rem;">group</i>&nbsp; Siswa</a>
                          <a class="dropdown-item" href="{{ route('Raport') }}/{{ $k->replid }}/cover"><i class="material-icons" style="font-size: 1.1rem;">insert_drive_file</i>&nbsp; Cover</a>
                          <a class="dropdown-item" href="{{ route('Raport') }}/{{ $k->replid }}/remidi"><i class="material-icons" style="font-size: 1.1rem;">cached</i>&nbsp; Remidi</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @php ($i++) @endphp
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
  @endsection



@elseif ($mode === 'daftarsiswa')
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
            <div class="card-body print" id="printMe">
            <table class="table-borderless siswa"  style="color:black" width="100%">
              <tbody>
                <tr>
                  <td width="20%">Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi</td>
                  <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
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
                  <th class="text-center">Tgl Lahir</th>
                  <th class="text-center">Keterangan</td>
                  <th class="action text-center d-none d-md-block">Aksi</td>
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
                    <td class="text-center">@foreach ($nilaimin as $nm) @if ($nm->nilai >= 70) <a href="{{ route('Raport') }}/{{ $kelasid }}/{{ $s->nis }}">Tuntas</a> @else <a href="{{ route('Raport') }}/{{ $kelasid }}/{{ $s->nis }}">Belum Tuntas</a> @endif @endforeach</td>
                    <td class="text-center d-none d-xl-block">
                      <!-- <a href="{{ route('Raport') }}/{{ $kelasid }}/{{ $s->nis }}/biodata" class="btn btn-sm btn-outline-success"><i class="material-icons">person</i> Biodata</a> -->
                      <a href="{{ route('Raport') }}/{{ $kelasid }}/{{ $s->nis }}" class="btn btn-sm btn-outline-info"><i class="material-icons">file_copy</i> Raport</a>
                      <a href="{{ route('Raport') }}/{{ $kelasid }}/{{ $s->nis }}/cetak" class="btn btn-sm btn-outline-secondary"><i class="material-icons">print</i> Cetak</a>
                    </td>
                    <td class="text-center d-none d-md-block d-xl-none">
                      <div class="dropdown show">
                        <a class="btn btn-sm btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Aksi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="{{ route('Raport') }}/{{ $kelasid }}/{{ $s->nis }}"><i class="material-icons" style="font-size: 1.1rem;">file_copy</i>&nbsp; Raport</a>
                          <a class="dropdown-item" href="{{ route('Raport') }}/{{ $kelasid }}/{{ $s->nis }}/cetak"><i class="material-icons" style="font-size: 1.1rem;">print</i>&nbsp; Cetak</a>
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
  @endsection



  @elseif ($mode === 'cetakcover')
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
            <div class="card-body print" id="printMe">
            <table class="table-borderless siswa"  style="color:black" width="100%">
              <tbody>
                <tr>
                  <td width="20%">Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi</td>
                  <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
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
                  @php ($i = 1) @endphp
                  @foreach ($siswa as $s)
                  <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td class="text-center">{{ $s->nis }}</td>
                    <td class="text-center">{{ $s->nisn }}</td>
                    <td>{{ $s->nama }}</td>
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
  @endsection



@elseif ($mode === 'tampilraport')
  @section('head')
    <!-- css yang digunakan ketika dalam mode screen -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- ss yang digunakan tampilkan ketika dalam mode print -->
    <link href="{{ asset('assets/css/raport.css') }}" rel="stylesheet">

    <style type="text/css" media="print">
      @page
      {
        size:  210mm 297mm;   /* auto is the initial value */
        margin: 10mm 10mm 10mm 10mm;  /* this affects the margin in the printer settings t,r,b,l */
      }
      @media print {
        footer {page-break-after: always;}
      }
    </style>
  @endsection

  @section('headersiswa')
    <table class="table-borderless siswa"  style="color:black" width="100%">
      <tbody>
        <tr>
          @foreach ($siswa as $s) @php ($nis = $s->nis) @endphp
          <td width="20%" data-toggle="popover-hover" data-img="data:image/png;base64,{{ $foto ?? '' }}">Nama Peserta Didik<br>Nomor Induk/NISN<br>Kelas<br>Semester</td>
          <td width="40%">: {{ $s->nama }}<br>: {{ $s->nis }} / {{ $s->nisn }}<br>: {{ $kelas }}<br>: {{ $semester }}</td>
          <td width="40%" class="text-right align-top"><div class="d-none d-sm-none d-md-block d-print-block"><svg id="barcode"></svg></div></td>
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
          <td width="70%"><br>Orang Tua/Wali<br><br><br><br><b>@if ($s->almayah == 0) {{ $s->namaayah }} @else {{ $s->namaibu }} @endif</b><br><br></td>
          @endforeach
          <td width="25%">Sragen, {{ Carbon\Carbon::parse($tanggalraport)->formatLocalized('%e %B %Y') }}<br>Wali kelas {{ $kelas }}<br><br><br><br><b>{{ $walikelas }}</b><br>NIP. -</td>
        </tr>
      </tbody>
    </table><br>
    <table class="table-borderless cetak d-flex justify-content-center" style="color:black">
      <tbody>
        <tr >
          <td class="text-center"><br>Mengetahui,<br>Kepala Sekolah<br><br><br><br><b>{{ $kepsek }}</b></td>
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
            <table class="table-borderless siswa"  style="color:black" width="100%">
              <tbody>
                <tr>
                  <td width="20%">Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi</td>
                  <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
                  <td>
                    <button id="cetak" class="btn btn-sm btn-outline-info" onclick="printDiv('printCover')"><i class="material-icons">insert_drive_file</i> Cover</button>
                    <button id="cetak" class="btn btn-sm btn-outline-success" onclick="printDiv('printBiodata')"><i class="material-icons">person</i> Biodata</button>
                    <button id="cetak" class="btn btn-sm btn-outline-warning" onclick="printDiv('printRaport')"><i class="material-icons">print</i> Raport</button>
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
                <h3 class="text-uppercase font-weight-bold">Raport Peserta Didik<br> Sekolah Menengah Kejuruan<br>(SMK)</h3>
                <br style="display: block;content: '';margin: 125px 0;">
                <img src="{{ asset('assets/img/logo/logo_tut_wuri.svg') }}" alt="" height="250px">
                <br style="display: block;content: '';margin: 125px 0;">
                @foreach ($siswa as $s)
                <p style="font-size:x-large;">Nama Peserta Didik :</p>
                <h2 class="font-weight-bold text-lowercase text-capitalize">{{ $s->nama }}</h2><br style="display: block;content: '';margin: 100px 0;">
                <p style="font-size:x-large;">NIS / NISN :</p>
                <h2 class="font-weight-bold">{{$s->nis}} / {{$s->nisn}}</h2><br style="display: block;content: '';margin: 250px 0;">
                <h3 class="text-uppercase font-weight-bold">Kementrian Pendidikan dan Kebudayaan <br>Republik Indonesia</h3>
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
                        {{$sis->tmplahir}}, {{ Carbon\Carbon::parse($sis->tgllahir)->formatLocalized('%e %B %Y') }}<br>
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
                        @if ($sis->tahunmasuk == '2018') 16 Juli 2018 @elseif ($sis->tahunmasuk == '2019') 15 Juli 2019 @endif<br>
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
                      <td class="pl-5 font-height"><h4>Sragen, @if ($sis->tahunmasuk == '2018') 16 Juli 2018 @elseif ($sis->tahunmasuk == '2019') 15 Juli 2019 @endif<br> Kepala Sekolah <br><br><br><br><br><strong>{{ $kepsek }}</strong><br>NIP. -</h4></td>
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
                  <th class="text-center">No</th>
                  <th class="text-center">Mata Pelajaran</th>
                  @if (isset($aspek))
                  @foreach ($aspek as $a)
                  <th class="text-center" data-toggle="tooltip" title="{{ $a->keterangan }} ({{ $a->dasarpenilaian }})">{{ $a->keterangan }}</th>
                  @endforeach
                  @php ($naspek = count($aspek)) @endphp
                  @else
                  @php ($naspek = 0) @endphp
                  @endif
                  <th class="text-center">Nilai Akhir</th>
                  <th class="text-center">Predikat</th>
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
                    <td colspan="{{ $colspan }}" data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">{{ $p->nama }}</td>
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
                    <td class="text-center" data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">{{ number_format($n->nilaiangka) ?? '-' }}</td>
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
                    <td class="text-center" data-toggle="tooltip" title="@foreach ($nilaiakhir as $na) {{ $na }}, @endforeach {{ $ratanilai ?? '' }}">{{ number_format($ratanilai) ?? '' }}</td>
                    <td class="text-center" data-toggle="tooltip" data-html="true" title="
                    @foreach (collect($pegawai)->where('nip', $nipguru) as $p) {{ $p->nama }} <br/> {{ $p->nip }} @endforeach
                    <br/>
                    @foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru) as $g) <b>{{ $g->grade }}</b> : {{ $g->nmin }} - {{ $g->nmax }} <br/> @endforeach">@foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru)->where('nmin', '<=', number_format($ratanilai) ?? '')->where('nmax', '>=', number_format($ratanilai) ?? '') as $g) {{ $g->grade }} @endforeach</td>
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
                  <th class="text-center">No</th>
                  <th class="text-center">Mitra / DUDI</th>
                  <th class="text-center">Lokasi</th>
                  <th class="text-center">Lamanya (Bulan)</th>
                  <th class="text-center">Keterangan</th>
                </thead>
                <tbody>
                  <tr>
                    @php
                        $nkomentar = collect($nilaisiswa)->where('idpelajaran', '226');
                    @endphp
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
                    @foreach (collect($pegawai)->where('nip', $nippkl) as $p) {{ $p->nama }} <br/> {{ $p->nip }} @endforeach
                    <br/>
                    @foreach (collect($grades)->where('idpelajaran', $idpelajaran)->where('nipguru', $nippkl) as $g) <b>{{ $g->grade }}</b> : {{ $g->nmin }} - {{ $g->nmax }} <br/> @endforeach">@foreach (collect($grades)->where('idpelajaran', $idpelajaran)->where('nipguru', $nippkl)->where('nmin', '<=', number_format($ratanilai) ?? '')->where('nmax', '>=', number_format($ratanilai) ?? '') as $g) {{ $g->grade }} @endforeach</td>
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
                  <th class="text-center">No</th>
                  <th class="text-center">Kegiatan Ekstrakurikuler</th>
                  <th class="text-center">Keterangan</th>
                </thead>
                <tbody>
                @php ($i = 1) @endphp
                @foreach ((collect($pelajaran)->where('idkelompok', '8')) as $p)
                  <tr>
                    <td class="text-center">{{ $i++ }}</td>
                    <td data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">{{ $p->nama }}</td>
                    @php ($nilai = (collect($nilaisiswa)->where('idpelajaran', $p->idpelajaran)->take(1))) @endphp
                    @if ($nilai->count() > 0)
                    @foreach ($nilai as $n)
                    @php ($idpelajaran = $n->idpelajaran) @endphp
                    @php ($nipguru = $n->nipguru) @endphp
                    <td data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">Melaksanakan kegiatan {{ $p->nama }} dengan @if ($n->nilaihuruf == 'A') Sangat baik @elseif ($n->nilaihuruf == 'B') Baik @elseif ($n->nilaihuruf == 'C') Cukup baik @elseif ($n->nilaihuruf == 'D') Kurang baik @else Baik @endif </td>
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
                    <td width="60%">: {{ $p->sakit }}  hari</td>
                  </tr>
                  <tr>
                    <td>Izin</td>
                    <td>: {{ $p->ijin }}  hari</td>
                  </tr>
                  <tr>
                    <td>Tanpa Keterangan</td>
                    <td>: {{ $p->alpa }}    hari</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <h3>F. Kenaikan Kelas</h3>
            <div class="table-responsive">
              <table class="table">
                <tbody>
                 <td>Naik / <del>Tidak naik</del> ke kelas <b>{{ str_replace("X", "XI", $kelas) }}</b></td>
                  <!-- <td><td><del>Naik</del> / Tidak naik</del> ke kelas <b>{{ str_replace("X", "XI", $kelas) }}</b></td>-->
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
                  <th class="text-center" width="20%">Karakter yang dibangun</th>
                  <th class="text-center" width="80%">Deskripsi</th>
                </thead>
                <tbody>
                  @foreach ((collect($pelajaran)->where('idkelompok', '9')) as $p)
                  <tr>
                    <td class="text-center" data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">{{ $p->nama }}</td>
                    @foreach (collect($nilaisiswa)->where('idpelajaran', $p->idpelajaran) as $n)
                    <td data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan ?? '' }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">
                    @if (($p->nama == 'Integritas') AND ($n->nilaihuruf == 'A')) Ananda selalu menjunjung tinggi nilai kesetiaan, keteladanan, anti korupsi, tidak menyalahgunakan pembayaran sekolah, membayar tepat waktu serta selalu  menghargai harkat martabat manusia
                    @elseif (($p->nama == 'Integritas') AND ($n->nilaihuruf == 'B')) Ananda sangat menghargai dan setia pada teman, selalu memberi contoh perilaku yang baik pada teman  dan tidak menyalahgunakan keuangan sekolah
                    @elseif (($p->nama == 'Integritas') AND ($n->nilaihuruf == 'C')) Ananda selalu setia dan memberikan keteladanan perilaku yang baik pada teman sekelas
                    @elseif (($p->nama == 'Religius') AND ($n->nilaihuruf == 'A')) Ananda menunjukkan ketagwaan yang tinggi  selalu taat dan tertib menjalankan ibadah dengan sholat berjamaah di masjid,menjauhi larangan agama serta toleran pada penganut agama yang berbeda
                    @elseif (($p->nama == 'Religius') AND ($n->nilaihuruf == 'B')) Ananda selalu taat dan tertib menjalankan ibadah setiap hari serta selalu menjaga diri dari perbuatan yang di larang agama
                    @elseif (($p->nama == 'Religius') AND ($n->nilaihuruf == 'C')) Ananda menunjukan perilaku  taat dan tertib  beribadah setiap hari
                    @elseif (($p->nama == 'Nasionalis') AND ($n->nilaihuruf == 'A')) Ananda selalu menunjukkan sikap disiplin yang tinggi, cinta damai, taat pada peratauran hukum dan tidak pernah melakukan pelanggaran ringan, sedang berat atau berat sesuai tata tertib yang menjadi aturan sekolah
                    @elseif (($p->nama == 'Nasionalis') AND ($n->nilaihuruf == 'B')) Ananda selalu menunjukkan sikap disiplin yang tinggi, mentaati peraturan lalu lintas dan tata tertib sekolah serta mempunyai rasa cinta damai yang tinggi
                    @elseif (($p->nama == 'Nasionalis') AND ($n->nilaihuruf == 'C')) Ananda selalu berdisiplin dan taat pada tata tertib sekolah serta aktif mengikuti kegiatan upacara
                    @elseif (($p->nama == 'Mandiri') AND ($n->nilaihuruf == 'A')) Ananda selalu menunjukkan sikap kerja keras yang tinggi, tidak gampang mengeluh selalu bersemangat, kreatif, memiliki daya juang serta berwawasan dan teknologi dalam setiap kegiatan pembelajaran di sekolah
                    @elseif (($p->nama == 'Mandiri') AND ($n->nilaihuruf == 'B')) Ananda selalu menunjukkan sikap kerja keras yang tinggi, kreatif, memiliki daya juang yang kuat dalam setiap kegiatan
                    @elseif (($p->nama == 'Mandiri') AND ($n->nilaihuruf == 'C')) Ananda selalu menunjukkan sikap kerja keras yang tinggi, kreatif dalam setiap kegiatan serta suka membantu teman di sekolah.
                    @elseif (($p->nama == 'Gotong Royong') AND ($n->nilaihuruf == 'A')) Ananda selalu menunjukkan sikap kerelawanan, saling tolong menolong, tidak membeda bedakan teman, serta selalu bermusyawarah dalam menyelesaiakan permasalahan
                    @elseif (($p->nama == 'Gotong Royong') AND ($n->nilaihuruf == 'B')) Ananda selalu menunjukkan sikap suka  tolong menolong, tidak membeda bedakan teman, serta selalu bermusyawarah dalam menyelesaikan permasalahan
                    @elseif (($p->nama == 'Gotong Royong') AND ($n->nilaihuruf == 'C')) Ananda selalu menunjukkan sikap suka  tolong menolong,  serta selalu bermusyawarah dalam menyelesaikan permasalahan
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
                    <td>Ananda perlu meningkatkan kompetensi pengetahuan sebagai bekal pembelajaran kompetensi kejuruan di semester selanjutnya.</td>
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
      JsBarcode("#barcode", "201902-{{ $nis ?? '' }}", {
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



@elseif ($mode === 'cetakraport')
  @section('head')
    <!-- css yang digunakan ketika dalam mode screen -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- ss yang digunakan tampilkan ketika dalam mode print -->
    <link href="{{ asset('assets/css/cetakraport.css') }}" rel="stylesheet">

    <style type="text/css" media="print">
      @page
      {
        size:  210mm 297mm;   /* auto is the initial value */
        margin: 10mm 15mm 8mm 15mm;  /* this affects the margin in the printer settings t,r,b,l */
      }
      @media print {
        footer {page-break-after: always;}
      }
    </style>
  @endsection

  @section('headersiswa')
    <table class="table-borderless siswa"  style="color:black" width="100%">
      <tbody>
        <tr>
          @foreach ($siswa as $s) @php ($nis = $s->nis) @endphp
          <td width="20%" data-toggle="popover-hover" data-img="data:image/png;base64,{{ $foto ?? '' }}">Nama Peserta Didik<br>Nomor Induk/NISN<br>Kelas/Semester</td>
          <td width="40%">: {{ $s->nama }}<br>: {{ $s->nis }} / {{ $s->nisn }}<br>: {{ $kelas }} / {{ $semester }}</td>
          <td width="40%" class="text-right align-top"><div class="d-none d-sm-none d-md-block d-print-block"></div></td>
          @endforeach
        </tr>
      </tbody>
    </table>
  @endsection

  @section('tandatangan')
    <div class="d-none d-print-block">
      <table class="table-borderless cetak" width="100%" style="color:black">
        <tbody>
          <tr>
            <td width="5%"> </td>
            @foreach ($siswa as $s)
            <td width="70%"><br>Orang Tua/Wali<br><br><br><br><strong>@if ($s->almayah == 0) {{ $s->namaayah }} @else {{ $s->namaibu }} @endif</strong><br><br></td>
            @endforeach
            <td width="25%">Sragen, {{ Carbon\Carbon::parse($tanggalraport)->formatLocalized('%e %B %Y') }}<br>Wali kelas {{ $kelas }}<br><br><br><br><strong>{{ $walikelas }}</strong><br>NIP. -</td>
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
            <div class="card-body ">
            <table class="table-borderless siswa"  style="color:black" width="100%">
              <tbody>
                <tr>
                  <td width="20%">Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi</td>
                  <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}</td>
                  <td><button id="cetak" class="btn btn-fill btn-rose" onclick="printDiv('printMe')">Cetak</button></td>
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
              <!-- tampilkan ketika dalam mode print -->
              <div  class="d-none d-print-block">
                <img src="{{ asset('assets/img/logo/logo_binawiyata.png') }}" alt="" width="12%" class="float-left">
                <img src="{{ asset('assets/img/logo/Quality-ISO-9001-PMS302.jpg') }}" alt="" width="7%" class="float-right">
                  <center>
                    <h5 style="margin-bottom: 1.2px;font-size: 1.1rem;font-weight: 400;">YAYASAN PENDIDIKAN BINAWIYATA SRAGEN</h5>
                    <h5 style="margin-bottom: 1px;font-size: 1rem;">SEKOLAH MENENGAH KEJURUAN TEKNOLOGI INDUSTRI</h5>
                    <h4 style="margin-bottom: 1px;font-size: 1.5rem;"><b>SMK BINAWIYATA KARANGMALANG SRAGEN</b></h4>
                    <h6 style="margin-bottom: 1px;font-size: 1rem;">TERAKREDITASI : A</h6>
                    Alamat : Jl. Abimanyu No. 18 Taman Asri, Sragen 57221. Telp 0271-891818<br/>
                    Website : www.smkbinawiyatasragen.sch.id | Email : smkbw_srg@yahoo.com<br/>
                    <hr style="border: 1px solid black;">
                  </center>
              </div>
              <div  class="d-none d-print-block">
                <h5><strong><center>SALINAN CAPAIAN HASIL BELAJAR PESERTA DIDIK<br/>TAHUN PELAJARAN {{ $tahunajaran }}</center></strong></h5>
              </div>
            @yield('headersiswa')
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <th class="text-center"><strong>No</strong></th>
                  <th class="text-center"><strong>Mata Pelajaran</strong></th>
                  @if (isset($aspek))
                  @foreach ($aspek as $a)
                  <th class="text-center" data-toggle="tooltip" title="{{ $a->keterangan }} ({{ $a->dasarpenilaian }})"><strong>{{ $a->keterangan }}</strong></th>
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
                    <td colspan="{{ $colspan }}" data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">{{ $p->nama }}</td>
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
                    <td class="text-center" data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">{{ number_format($n->nilaiangka) ?? '-' }}</td>
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
                    <td class="text-center" data-toggle="tooltip" title="@foreach ($nilaiakhir as $na) {{ $na }}, @endforeach {{ $ratanilai ?? '' }}">{{ number_format($ratanilai) ?? '' }}</td>
                    <td class="text-center" data-toggle="tooltip" data-html="true" title="
                    @foreach (collect($pegawai)->where('nip', $nipguru) as $p) {{ $p->nama }} <br/> {{ $p->nip }} @endforeach
                    <br/>
                    @foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru) as $g) <b>{{ $g->grade }}</b> : {{ $g->nmin }} - {{ $g->nmax }} <br/> @endforeach">@foreach (collect($grade)->where('idpelajaran', $idpelajaran)->where('nipguru', $nipguru)->where('nmin', '<=', number_format($ratanilai) ?? '')->where('nmax', '>=', number_format($ratanilai) ?? '') as $g) {{ $g->grade }} @endforeach</td>
                    @endif
                  </tr>@php ($i++) @endphp
                  @endforeach
                @endforeach
                </tbody>
              </table>
            </div>
            <h4><strong>Ekstrakurikuler Wajib</strong></h4>
            <div class="table-responsive">
              <table  width="100%" class="table-borderless cetak">
                <tbody>
                @foreach ((collect($pelajaran)->where('idkelompok', '8')) as $p)
                  <tr>
                    <td width="30%" data-toggle="tooltip" title="{{ $p->idpelajaran }} - {{ $p->nama }}">- {{ $p->nama }}</td>
                    @php ($nilai = (collect($nilaisiswa)->where('idpelajaran', $p->idpelajaran)->take(1))) @endphp
                    @if ($nilai->count() > 0)
                    @foreach ($nilai as $n)
                    @php ($idpelajaran = $n->idpelajaran) @endphp
                    @php ($nipguru = $n->nipguru) @endphp
                    {{-- <td width="70%" data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">: Melaksanakan kegiatan {{ $p->nama }} dengan @if ($n->nilaihuruf == 'A') Sangat baik @elseif ($n->nilaihuruf == 'B') Baik @elseif ($n->nilaihuruf == 'C') Cukup baik @elseif ($n->nilaihuruf == 'D') Kurang baik @else Tidak aktif @endif </td> --}}
                    <td width="70%" data-toggle="tooltip" title="{{ $n->replid ?? '' }} - {{ $p->nama }} ({{ $a->keterangan }}) : {{ $n->nilaiangka ?? '' }} ({{ $n->nilaihuruf ?? '' }})">: Melaksanakan kegiatan {{ $p->nama }} dengan @if ($n->nilaihuruf == 'A') Sangat baik @elseif ($n->nilaihuruf == 'B') Baik @elseif ($n->nilaihuruf == 'C') Cukup baik @elseif ($n->nilaihuruf == 'D') Kurang baik @else Baik @endif </td>
                    @endforeach
                    @else
                    <td data-toggle="tooltip" title="Belum ada penilaian"></td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><br/>
            <h4><strong>Ketidak Hadiran</strong></h4>
            <div class="table-responsive">
              <table class="table-borderless cetak" style="width: 50%" data-toggle="tooltip" data-html="true" title="Presensi siswa dari tanggal<br/>{{ $tanggalawal }} <br/>sampai<br/> {{ $tanggalakhir }}" style="color:black">
                <tbody>
                  @foreach ($presensi as $p)
                  <tr>
                    <td width="40%">Sakit</td>
                    <td width="60%">: {{ $p->sakit }}  hari</td>
                  </tr>
                  <tr>
                    <td>Izin</td>
                    <td>: {{ $p->ijin }}  hari</td>
                  </tr>
                  <tr>
                    <td>Tanpa Keterangan</td>
                    <td>: {{ $p->alpa }}  hari</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><br/>
            <h4><strong>Catatan Akademik</strong></h4>
            @if (isset($nilaisiswa))
              <p>Ananda perlu meningkatkan kompetensi pengetahuan @foreach (collect($nilaisiswa)->where('dasarpenilaian', 'PNGT')->sortBy('nilaiangka')->take(3) as $n) {{ $n->nama }}, @endforeach sebagai bekal pembelajaran kompetensi kejuruan di semester selanjutnya.</p>
            @endif <br/>
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



@elseif ($mode === 'daftarremidi')
  @section('head')
    <!-- css yang digunakan ketika dalam mode screen -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- ss yang digunakan tampilkan ketika dalam mode print -->
    <link href="{{ asset('assets/css/cetakraport.css') }}" rel="stylesheet">

    <style type="text/css" media="print">
      @page
      {
        size:  210mm 297mm;   /* auto is the initial value */
        margin: 10mm 15mm 8mm 15mm;  /* this affects the margin in the printer settings t,r,b,l */
      }
      @media print {
        footer {page-break-after: always;}
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
            <table class="table-borderless siswa"  style="color:black" width="100%">
              <tbody>
                <tr>
                  <td width="20%">Departemen<br>Tahun ajaran<br>Semester</td>
                  <td width="40%">: {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}</td>
                  <td><button id="cetak" class="btn btn-fill btn-rose" onclick="printDiv('printMe')">Cetak</button></td>
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
              <h4 class="card-title">Daftar Reimidi Kelas {{ $kelas }} Tahun Ajaran {{ $tahunajaran ?? '' }} Semetser {{ $semester }}</h4>
            </div>
            <div class="card-body print" id="printMe">
              <div  class="d-none d-print-block">
                  <center>
                    <h4>Daftar Siswa Remidi</h4>
                    <h4>SMK Binawiyata Karangmalang Sragen</b></h4>
                    <hr style="border: 1px solid black;">
                  </center>
              </div>
            <table class="table-borderless siswa"  style="color:black" width="100%">
              <tbody>
                <tr>
                  <td width="20%">Tahun ajaran<br>Semester<br>Kelas</td>
                  <td width="40%">: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $kelas }}</td>
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
                </thead>
                <tbody>
                  @foreach ($remidi as $r)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $r->nis }}</td>
                    <td>{{ $r->nama }}</td>
                    <td>{{ $r->mapel }}</td>
                    <td class="text-center">@if ($r->aspek == "PNGT") P @elseif ($r->aspek == "PRAK") K @endif</td>
                    <td class="text-center">{{ $r->nilaiangka }}</td>
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
@endif
