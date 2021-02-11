@extends('layouts.app')

@section('title', 'Raport')

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
                <div class="card">
                  <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                      <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title ">Simple Table</h4>
                  </div>
                  <div class="card-body" id="printMe">
                    <table class="table-borderless"  width="100%">
                      <tbody>
                        <tr>
                          <td width="20%">Nama Peserta Didik<br>Nomor Induk/NISN<br>Kelas<br>Semester</td>
                          <td width="80%">: Achmad Fadillah<br>: 11759<br>: X TSM 1<br>: 1/Gasal</td>
                        </tr>
                      </tbody>
                    </table><hr><br>
					<h4>A. Nilai Akademik</h4>
                    <div class="table-responsive">
                      <table class="table"  id="tabel">
                        <thead>
                          <th>No</th>
                          <th>Mata Pelajaran</th>
                          <th>Pengetahuan</th>
                          <th>Keterampilan</th>
                          <th>Nilai Akhir</th>
                          <th>Predikat</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan=6>
                              <strong>A. Muatan Nasional</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              1
                            </td>
                            <td>
                              Pendidikan Agama dan Budi Pekerti
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              2
                            </td>
                            <td>
                              Pendidikan Pancasila dan Kewarganegaraan
                            </td>
                            <td>
                              77
                            </td>
                            <td>
                              77
                            </td>
                            <td>
                              77
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              3
                            </td>
                            <td>
                              Bahasa Indonesia
                            </td>
                            <td>
                              79
                            </td>
                            <td>
                              83
                            </td>
                            <td>
                              80
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              4
                            </td>
                            <td>
                              Matematika
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              5
                            </td>
                            <td>
                              Sejarah Indonesia
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              6
                            </td>
                            <td>
                              Bahasa Inggris
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td colspan=6>
                              <strong>B. Muatan Kewilayahan</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              7
                            </td>
                            <td>
                              Seni Budaya
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              8
                            </td>
                            <td>
                              Pendidikan Jasmani, Olahraga dan Kesehatan
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td colspan=6>
                              <strong>C. Muatan Peminatan Kejuruan</strong>
                            </td>
                          </tr>
                          <tr>
                            <td colspan=6>
                              <strong>C1. Dasar Bidang Keahlian</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              9
                            </td>
                            <td>
                              Simulasi dan Komunikasi Digital
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              10
                            </td>
                            <td>
                              Fisika
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              11
                            </td>
                            <td>
                              Kimia
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td colspan=6>
                              <strong>C2. Dasar Program Keahlian</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              12
                            </td>
                            <td>
                              Gambar Teknik Otomotif
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              13
                            </td>
                            <td>
                              Teknologi Dasar Otomotif
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td>
                              14
                            </td>
                            <td>
                              Pekerjaan Dasar Teknik Otomotif
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                          <tr>
                            <td colspan=6>
                              <strong>D. Muatan Lokal</strong>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              15
                            </td>
                            <td>
                              Melakukan Pengerjaan Kerja Bangku
                            </td>
                            <td>
                              84
                            </td>
                            <td>
                              51
                            </td>
                            <td>
                              74
                            </td>
                            <td>
                              A
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
					<br>
					<h4>B. Catatan Akademik</h4>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Perlu meningkatkan kompetensi pengetahuan Pendidikan Agama dan Budi Pekerti, sebagai bekal pembelajaran kompetensi kejuruan di semester selanjutnya.</td>
                        </tr>
                      </tbody>
                    </table><br>
					<h4>C. Praktik Kerja Lapangan</h4>
                    <div class="table-responsive">
                      <table class="table"  id="tabel">
                        <thead>
                          <th>
                            No
                          </th>
                          <th>
                            Mitra / DUDI
                          </th>
                          <th>
                            Lokasi
                          </th>
                          <th>
                            Lamanya (Bulan)
                          </th>
                          <th>
                            Keterangan
                          </th>
                        </thead>
						<tbody>
                          <td>
                            1
                          </td>
                          <td>
                            Pratama Kurnia Kasih Sragen
                          </td>
                          <td>
                            Sragen
                          </td>
                          <td>
                            6 Bulan
                          </td>
                          <td>                           
                          </td>
                        </tbody>
                      </table><br>					  
					  <h4>D. Ekstrakurikuler</h4>
                    <div class="table-responsive">
                      <table class="table"  id="tabel">
                        <thead>
                          <th>
                            No
                          </th>
                          <th>
                            Kegiatan Ekstrakurikuler
                          </th>                
                          <th>
                            Keterangan
                          </th>
                        </thead>
						<tbody>
							<tr>
								<td>
								1
								</td>
								<td>
								Kepramukaan
								</td>
								<td>
								Sangat baik dalam mengikuti kepramukaan
								</td>
							</tr>
							<tr>
								<td>
								2
								</td>
								<td>
								Kursus Bahasa Asing
								</td>
								<td>
								Sangat baik dalam mengikuti kursus bahasa asing
								</td>
							</tr>						   
                        </tbody>
                      </table><br>					  
					  <h4>E. Ketidak Hadiran</h4>
                    <div class="table-responsive">
                      <table class="table"  id="tabel"  width="40%">					  
						<tbody>
							<tr>
								<td>
								Sakit
								</td>
								<td>
								:0
								</td>
								<td>
								Hari
								</td>
							</tr>
							</tr>
							<tr>
								<td>
								Izin
								</td>
								<td>
								:0
								</td>
								<td>
								Hari
								</td>
							</tr>
							<tr>
								<td>
								Tanpa Keterangan
								</td>
								<td>
								:0
								</td>
								<td>
								Hari
								</td>
							</tr>											   
                        </tbody>
                      </table><br>					  
					   <h4>F. Kenaikan Kelas</h4>
                    <div class="table-responsive">
                      <table class="table"  id="tabel">       
						<tbody>
							<td>
							Naik Ke Kelas Selanjutnya
							</td>
						</tbody>
					  </table><br>					  
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
			document.body.style.backgroundColor = "white";
			window.print();
			document.body.innerHTML = originalContents;
			document.body.style.backgroundColor = originalBackground;
			var element = document.getElementById("tabel");
			element.classList.remove("tabel");
		}
	</script>
@endsection
