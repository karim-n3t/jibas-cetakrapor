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
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">
                        Daftar Kelas Tahun Ajaran {{ $tahunajaran ?? '' }} Semetser {{ $semester }}
                    </h4>
                </div>
                <div class="card-body d-none d-print-block print" id="printSekolah">
                    <div>
                        <br style="display: block;content: '';margin: 50px 0;">
                        <h3 class="text-uppercase font-weight-bold text-center">
                            Rapor Peserta Didik<br>Sekolah Menengah Kejuruan<br>(SMK)
                        </h3>
                        <br style="display: block;content: '';margin: 50px 0;">
                        <table class="table-borderless">
                            <tbody style="font-size:x-large !important; line-height:3 !important;">
                                <tr>
                                    <td class="pl-5"></td>
                                    <td class="pl-5">
                                        <h3 style="font-size:x-large !important; line-height:3 !important;">
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
                                        </h3>
                                    </td>
                                    <td class="pl-5">
                                        <h3 style="font-size:x-large !important; line-height:3 !important;">
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
                                        </h3>
                                    </td>
                                    <td class="pl-3">
                                        <h3 style="font-size:x-large !important; line-height:3 !important;">
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
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
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
                    <table class="table-borderless siswa" style="color:black" width="100%">
                        <tbody>
                            <tr>
                                <td width="20%">
                                    Departemen<br>Tahun ajaran<br>Semester<br>Tanggal presensi
                                </td>
                                <td width="40%">
                                    : {{ $departemen ?? '' }}<br>: {{ $tahunajaran ?? '' }}<br>: {{ $semester }}<br>: {{ $tanggalawal }} sampai {{ $tanggalakhir }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" onclick="printDiv('printSekolah')">
                                        <i class="material-icons">insert_drive_file</i> Sekolah
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="printDiv('printBiodata')">
                                        <i class="material-icons">person</i> Petunjuk Pengisian
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
                                    <th class="text-center">Tingkat</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Wali Kelas</th>
                                    <th class="text-center">Ketuntasan</th>
                                    <th class="action text-center d-none d-xl-block">Aksi</th>
                                    <th class="action text-center d-none d-md-block d-xl-none">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1) @endphp
                                @foreach ($kelas as $k)
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td class="text-center">
                                        @foreach (collect($tingkat)->where('replid', $k->idtingkat) as $t) {{ $t->tingkat }} @endforeach
                                    </td>
                                    <td class="text-center">{{ $k->kelas }}</td>
                                    <td>
                                        @foreach (collect($pegawai)->where('nip', $k->nipwali) as $p) {{ $p->nama }} <br /> {{ $p->nip }} @endforeach
                                    </td>
                                    <td class="text-center">
                                        Tuntas : {{ (collect($jmlsiswaremidi)->where('idkelas', $k->replid)->where('remidi','=','0')->count()) }},
                                        Remidi : {{ (collect($jmlsiswaremidi)->where('idkelas', $k->replid)->where('remidi','>','0')->count()) }}
                                    </td>
                                    <td class="text-center d-none d-xl-block">
                                        <a href="{{ route('Daftar Siswa Raport', ['kelas' => $k->replid]) }}" class="btn btn-sm btn-outline-success">
                                            <i class="material-icons">group</i> Siswa
                                        </a>
                                        <a href="{{ route('Daftar Siswa Remidi', ['kelas' => $k->replid]) }}" class="btn btn-sm btn-outline-danger">
                                            <i class="material-icons">cached</i> Remidi
                                        </a>
                                        <a href="{{ route('Cetak Rapor Sementara', ['kelas' => $k->replid]) }}" class="btn btn-sm btn-outline-info @if ((collect($jmlsiswaremidi)->where('idkelas', $k->replid)->where('remidi','>','0')->count()) == 0) {{'disabled'}} @endif">
                                            <i class="material-icons">print</i> Sementara
                                        </a>
                                    </td>
                                    <td class="text-center d-none d-md-block d-xl-none">
                                        <div class="dropdown show">
                                            <a class="btn btn-sm btn-outline-success dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('Daftar Siswa Raport', ['kelas' => $k->replid]) }}/{{ $k->replid }}">
                                                    <i class="material-icons" style="font-size: 1.1rem;">group</i>&nbsp; Siswa
                                                </a>
                                                <a class="dropdown-item" href="{{ route('Daftar Siswa Raport', ['kelas' => $k->replid]) }}/{{ $k->replid }}/cover">
                                                    <i class="material-icons" style="font-size: 1.1rem;">insert_drive_file</i>&nbsp; Cover
                                                </a>
                                                <a class="dropdown-item" href="{{ route('Daftar Siswa Raport', ['kelas' => $k->replid]) }}/{{ $k->replid }}/remidi">
                                                    <i class="material-icons" style="font-size: 1.1rem;">cached</i>&nbsp; Remidi
                                                </a>
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
