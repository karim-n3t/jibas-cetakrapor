<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Raport extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function varRapor($setsemester = '202001')
    {
        $collect_semester = collect([
            // 2019 Gasal
            ['setsemester' => '201901', 'tahunajaran' => 28, 'semester' => 20, 'tanggalawal' => '2019-08-01', 'tanggalakhir' => '2019-11-22', 'tanggalraport' => '2019-12-18'],
            // 2019 Genap
            ['setsemester' => '201902', 'tahunajaran' => 28, 'semester' => 21, 'tanggalawal' => '2020-01-02', 'tanggalakhir' => '2020-02-28', 'tanggalraport' => '2020-06-12'],
            // 2020 Gasal
            ['setsemester' => '202001', 'tahunajaran' => 29, 'semester' => 20, 'tanggalawal' => '2020-07-13', 'tanggalakhir' => '2020-12-18', 'tanggalraport' => '2020-12-18'],
            // 2020 Genap
            ['setsemester' => '202002', 'tahunajaran' => 29, 'semester' => 21, 'tanggalawal' => '2020-01-02', 'tanggalakhir' => '2020-02-28', 'tanggalraport' => '2020-06-12'],
        ]);

        $array_semester = $collect_semester->where('setsemester', $setsemester)->first();
        $array = collect($array_semester)->values()->all();
        list($setsemester, $tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport) = $array;


        $departemenid = 11;

        $departemen = DB::connection('mysql2')->select("SELECT departemen, nipkepsek, p.nama, d.keterangan
                                FROM jbsakad.departemen d, jbssdm.pegawai p
                               WHERE d.replid = $departemenid
                                 AND d.nipkepsek = p.nip");

        foreach ($departemen as $dep) {
            $dep = $dep;
        }
        $departemen = $dep->departemen;
        $kepsek = $dep->nama;
        $nipkepsek = $dep->nipkepsek;

        $tahunajaran = DB::connection('mysql2')->select("SELECT replid, tahunajaran, aktif
                                 FROM jbsakad.tahunajaran
                                WHERE departemen = '$departemen'
                                  AND replid = $tahunajaranid
                             ORDER BY replid DESC");

        foreach ($tahunajaran as $ta) {
            $ta = $ta;
        }
        $tahunajaran = $ta->tahunajaran;
        $taAktif = $ta->aktif;

        $semester = DB::connection('mysql2')->select("SELECT replid, semester
                              FROM jbsakad.semester
                             WHERE departemen = '$departemen'
                               AND replid = $semesterid");

        foreach ($semester as $smt) {
            $smt = $smt;
        }
        $semester = $smt->semester;

        return array($tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport, $departemenid, $departemen, $kepsek, $nipkepsek, $tahunajaran, $semester, $taAktif);

    }

    public function daftarkelas()
    {
        setlocale(LC_TIME, 'IND');
        list($tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport, $departemenid, $departemen, $kepsek, $nipkepsek, $tahunajaran, $semester, $taAktif) = Raport::varRapor();

        $tingkat = DB::connection('mysql2')->select("SELECT *
                               FROM jbsakad.tingkat
                              WHERE departemen='$departemen'
                                AND aktif = 1
                           ORDER BY urutan");
        $kelas = DB::connection('mysql2')->select("SELECT *
                             FROM jbsakad.kelas
                            WHERE idtahunajaran='$tahunajaranid'
                              AND aktif = 1
                         ORDER BY kelas");
        $pegawai = DB::connection('mysql2')->select("SELECT *
                               FROM jbssdm.pegawai");
        $jmlsiswaremidi = DB::connection('mysql2')->select("SELECT nis, SUM(CASE WHEN nilaiangka < 70 THEN 1 ELSE 0 END) AS remidi, i.idkelas, k.kelas, k.idtahunajaran
                                      FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.kelas k
                                     WHERE i.replid = n.idinfo
                                       AND k.replid = i.idkelas
                                       AND k.idtahunajaran = $tahunajaranid
                                       AND i.idsemester = $semesterid
                                  GROUP BY nis");

        return view('RaportListRombel', [
            'departemen' => $departemen,
            'tahunajaran' => $tahunajaran,
            'semester' => $semester,
            'tingkat' => $tingkat,
            'kelas' => $kelas,
            'pegawai' => $pegawai,
            'kepsek' => $kepsek,
            'nipkepsek' => $nipkepsek,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'jmlsiswaremidi' => $jmlsiswaremidi
        ]);
    }


    public function listsiswa($kelas)
    {

        setlocale(LC_TIME, 'IND');
        list($tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport, $departemenid, $departemen, $kepsek, $nipkepsek, $tahunajaran, $semester, $taAktif) = Raport::varRapor();

        //Daftar siswa
        $kelasid = $kelas;
        $kelas = DB::connection('mysql2')->select("SELECT kelas, idtingkat, nama AS namawali, nip
                             FROM jbsakad.kelas k, jbssdm.pegawai p
                            WHERE k.replid = $kelasid
                              AND k.nipwali=p.nip");

        foreach ($kelas as $kls) {
            $kls = $kls;
        }
        $kelas = $kls->kelas;
        $walikelas = $kls->namawali;
        $nipwali = $kls->nip;
        $tingkatid = $kls->idtingkat;

        $tingkat = DB::connection('mysql2')->select("SELECT *
                               FROM jbsakad.tingkat
                              WHERE departemen='$departemen'
                                AND replid = $tingkatid");

        foreach ($tingkat as $tk) {
            $tk = $tk;
        }
        $tingkat = $tk->tingkat;

        if ($taAktif == 1) {
            $siswa = DB::connection('mysql2')->select("SELECT nis, nisn, nama, tgllahir
                               FROM jbsakad.siswa
                              WHERE idkelas = $kelasid
                                AND aktif = 1
                           ORDER BY nama");
        } else {
            $siswa = DB::connection('mysql2')->select("SELECT s.nis, s.nisn, s.nama, s.tgllahir
                               FROM jbsakad.siswa s, jbsakad.riwayatkelassiswa r
                              WHERE s.nis = r.nis
                                AND r.idkelas = $kelasid
                           ORDER BY nama");
        }

        if (count($siswa) == 0) {
            $siswa = 'kosong';
        }

        $nilaisiswamin = DB::connection('mysql2')->select("SELECT nis, min(nilaiangka) AS nilai, i.idkelas, i.idpelajaran, nama AS mapel, n.replid, dasarpenilaian
                                  FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.aturannhb a, jbsakad.pelajaran p
                                 WHERE i.replid = n.idinfo
                                   AND i.idsemester = $semesterid
                                   AND idkelas = $kelasid
                                   AND n.idaturan = a.replid
                                   AND i.idpelajaran = p.replid
                              GROUP BY nis");

        return view('RaportListSiswa', [
            'departemen' => $departemen,
            'tahunajaran' => $tahunajaran,
            'semester' => $semester,
            'tingkat' => $tingkat,
            'kelasid' => $kelasid,
            'kelas' => $kelas,
            'walikelas' => $walikelas,
            'nipwali' => $nipwali,
            'siswa' => $siswa,
            'kepsek' => $kepsek,
            'nipkepsek' => $nipkepsek,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'nilaisiswamin' => $nilaisiswamin
        ]);
    }

    public function tampilrapor($kelas, $nis)
    {
        list($tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport, $departemenid, $departemen, $kepsek, $nipkepsek, $tahunajaran, $semester, $taAktif) = Raport::varRapor();


        //Tampil rapor
        if (isset($kelas) and isset($nis)) {
            $kelasid = $kelas;
            $nis = $nis;
            $kelas = DB::connection('mysql2')->select("SELECT kelas, idtingkat, nama AS namawali, nip
                             FROM jbsakad.kelas k, jbssdm.pegawai p
                            WHERE k.replid = $kelasid
                              AND k.nipwali=p.nip");

            foreach ($kelas as $kls) {
                $kls = $kls;
            }
            $kelas = $kls->kelas;
            $walikelas = $kls->namawali;
            $nipwali = $kls->nip;
            $tingkatid = $kls->idtingkat;

            $pegawai = DB::connection('mysql2')->select("SELECT * FROM jbssdm.pegawai");
            $siswa = DB::connection('mysql2')->select("SELECT * FROM jbsakad.siswa WHERE nis = $nis");
            $foto = DB::connection('mysql2')->select("SELECT s.foto FROM jbsakad.siswa s WHERE nis = $nis");

            foreach ($foto as $ft) {
                $ft = $ft;
            }
            $foto = $ft->foto;
            $foto = base64_encode($foto);

            $aspek = DB::connection('mysql2')->select("SELECT DISTINCT a.dasarpenilaian, d.keterangan
                            FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.aturannhb a, jbsakad.dasarpenilaian d
                            WHERE i.replid = n.idinfo
                            AND d.replid < 5
                            AND n.nis = $nis
                            AND i.idsemester = $semesterid
                            AND i.idkelas = $kelasid
                            AND n.idaturan = a.replid
                            AND a.dasarpenilaian = d.dasarpenilaian ORDER BY dasarpenilaian");
            $kelompokpelajaran = DB::connection('mysql2')->select("SELECT pel.idkelompok, kpel.kode, kpel.kelompok
                                        FROM jbsakad.kelompokpelajaran kpel, jbsakad.ujian uji, jbsakad.nilaiujian niluji, jbsakad.siswa sis, jbsakad.pelajaran pel
                                        WHERE uji.replid = niluji.idujian
                                        AND niluji.nis = sis.nis
                                        AND uji.idpelajaran = pel.replid
                                        AND pel.idkelompok = kpel.replid
                                        AND kpel.urutan < 7
                                        AND uji.idsemester = $semesterid
                                        AND uji.idkelas = $kelasid
                                        AND sis.nis = $nis
                                        GROUP BY kpel.urutan");
            $pelajaran = DB::connection('mysql2')->select("SELECT pel.replid as idpelajaran, pel.nama, pel.idkelompok, kpel.kode, kpel.kelompok
                                FROM jbsakad.ujian uji, jbsakad.nilaiujian niluji, jbsakad.siswa sis, jbsakad.pelajaran pel, jbsakad.kelompokpelajaran kpel
                                WHERE uji.replid = niluji.idujian
                                AND niluji.nis = sis.nis
                                AND uji.idpelajaran = pel.replid
                                AND pel.idkelompok = kpel.replid
                                AND uji.idsemester = $semesterid
                                AND uji.idkelas = $kelasid
                                AND sis.nis = $nis
                            GROUP BY kpel.urutan, pel.nama
                            ORDER BY pel.kode");
            $kkm = DB::connection('mysql2')->select("SELECT idpelajaran, nilaimin
                        FROM jbsakad.infonap
                        WHERE idsemester = $semesterid
                            AND idkelas = $kelasid");
            $nilaisiswa = DB::connection('mysql2')->select("SELECT n.replid, i.idpelajaran, nama, dasarpenilaian, nipguru, nilaiangka, nilaihuruf, komentar
                                FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.aturannhb a, jbsakad.pelajaran p
                                WHERE i.replid = n.idinfo
                                AND n.nis = $nis
                                AND i.idsemester = $semesterid
                                AND i.idkelas = $kelasid
                                AND n.idaturan = a.replid
                                AND i.idpelajaran = p.replid
                            ORDER BY dasarpenilaian");
            $presensisiswa = DB::connection('mysql2')->select("SELECT SUM(ph.hadir) as hadir, SUM(ph.ijin) as ijin, SUM(ph.sakit) as sakit, SUM(ph.cuti) as cuti, SUM(ph.alpa) as alpa, SUM(ph.hadir+ph.sakit+ph.ijin+ph.alpa+ph.cuti) as tot
                                    FROM jbsakad.presensiharian p, jbsakad.phsiswa ph, jbsakad.siswa s
                                    WHERE ph.idpresensi = p.replid
                                    AND ph.nis = s.nis
                                    AND ph.nis = $nis
                                    AND ((p.tanggal1 BETWEEN '$tanggalawal' AND '$tanggalakhir') OR (p.tanggal2 BETWEEN '$tanggalawal' AND '$tanggalakhir'))
                                ORDER BY p.tanggal1");
            $grade = DB::connection('mysql2')->select("SELECT i.idpelajaran, nama, a.dasarpenilaian, a.idtingkat, ag.replid, ag.nipguru, ag.idpelajaran, ag.nmin, ag.nmax, ag.grade
                            FROM jbsakad.infonap i, jbsakad.aturannhb a, jbsakad.pelajaran p, jbsakad.aturangrading ag
                            WHERE i.idsemester = $semesterid
                            AND a.idtingkat = $tingkatid
                            AND i.idkelas = $kelasid
                            AND i.idpelajaran = p.replid
                            AND ag.idpelajaran = i.idpelajaran
                            AND ag.dasarpenilaian = a.dasarpenilaian
                            AND ag.idpelajaran = i.idpelajaran
                            AND ag.idtingkat = a.idtingkat
                            AND a.idpelajaran = ag.idpelajaran
                            AND a.nipguru = ag.nipguru
                            AND a.dasarpenilaian = 'PNGT'
                        GROUP BY replid
                        ORDER BY grade");
            $grades = DB::connection('mysql2')->select("SELECT i.idpelajaran, nama, a.dasarpenilaian, a.idtingkat, ag.replid, ag.nipguru, ag.idpelajaran, ag.nmin, ag.nmax, ag.grade
                            FROM jbsakad.infonap i, jbsakad.aturannhb a, jbsakad.pelajaran p, jbsakad.aturangrading ag
                            WHERE i.idsemester = $semesterid
                            AND a.idtingkat = $tingkatid
                            AND i.idkelas = $kelasid
                            AND i.idpelajaran = p.replid
                            AND ag.idpelajaran = i.idpelajaran
                            AND ag.dasarpenilaian = a.dasarpenilaian
                            AND ag.idpelajaran = i.idpelajaran
                            AND ag.idtingkat = a.idtingkat
                            AND a.idpelajaran = ag.idpelajaran
                            AND a.nipguru = ag.nipguru
                            AND a.dasarpenilaian = 'PRAK'
                        GROUP BY replid
                        ORDER BY grade");
            $nilaikarakter = DB::connection('mysql2')->select("SELECT n.nilaiAU as nilaiujian, n.nis, n.idjenis, n.idaturan, u.jenisujian, u.idpelajaran
                            FROM jbsakad.nau n, jbsakad.jenisujian u, jbsakad.pelajaran p
                            WHERE n.idjenis = u.replid
                            AND u.idpelajaran = p.replid
                            AND p.idkelompok = 9
                            AND n.idkelas = $kelasid
                            AND n.idsemester = $semesterid
                            AND n.nis = $nis");

            if (count($nilaisiswa) > 0) {
                return view('RaportCetak', [
                    'departemen' => $departemen,
                    'tahunajaran' => $tahunajaran,
                    'kepsek' => $kepsek,
                    'nipkepsek' => $nipkepsek,
                    'semester' => $semester,
                    'pegawai' => $pegawai,
                    'kelas' => $kelas,
                    'walikelas' => $walikelas,
                    'nipwali' => $nipwali,
                    'siswa' => $siswa,
                    'aspek' => $aspek,
                    'kelompokpelajaran' => $kelompokpelajaran,
                    'pelajaran' => $pelajaran,
                    'nilaisiswa' => $nilaisiswa,
                    'tanggalawal' => $tanggalawal,
                    'tanggalakhir' => $tanggalakhir,
                    'tanggalraport' => $tanggalraport,
                    'presensi' => $presensisiswa,
                    'grade' => $grade,
                    'grades' => $grades,
                    'nilaikarakter' => $nilaikarakter,
                    'foto' => $foto
                ]);
            } else {
                return view('RaportCetak', [
                    'departemen' => $departemen,
                    'tahunajaran' => $tahunajaran,
                    'kepsek' => $kepsek,
                    'nipkepsek' => $nipkepsek,
                    'semester' => $semester,
                    'pegawai' => $pegawai,
                    'kelas' => $kelas,
                    'walikelas' => $walikelas,
                    'nipwali' => $nipwali,
                    'siswa' => $siswa,
                    'kelompokpelajaran' => $kelompokpelajaran,
                    'pelajaran' => $pelajaran,
                    'tanggalawal' => $tanggalawal,
                    'tanggalakhir' => $tanggalakhir,
                    'tanggalraport' => $tanggalraport,
                    'presensi' => $presensisiswa,
                    'grade' => $grade,
                    'grades' => $grades
                ]);
            }
        }
    }

    public function cetakrapor($kelas)
    {
        list($tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport, $departemenid, $departemen, $kepsek, $nipkepsek, $tahunajaran, $semester, $taAktif) = Raport::varRapor();

        //Raport sementara
        $kelasid = $kelas;
        $kelas = DB::connection('mysql2')->select("SELECT kelas, idtingkat, nama AS namawali, nip
                            FROM jbsakad.kelas k, jbssdm.pegawai p
                        WHERE k.replid = $kelasid
                            AND k.nipwali=p.nip");

        foreach ($kelas as $kls) {
            $kls = $kls;
        }

        $kelas = $kls->kelas;
        $walikelas = $kls->namawali;
        $nipwali = $kls->nip;
        $tingkatid = $kls->idtingkat;

        $jmlsiswaremidi = DB::connection('mysql2')->select("SELECT n.nis, SUM(CASE WHEN nilaiangka < 70 THEN 1 ELSE 0 END) AS remidi, i.idkelas, k.kelas, k.idtahunajaran, s.nama, s.nisn, s.almayah, s.namaayah
                                      FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.kelas k, jbsakad.siswa s
                                     WHERE i.replid = n.idinfo
                                       AND k.replid = i.idkelas
                                       AND s.nis = n.nis
                                       AND i.idsemester = $semesterid
                                       AND k.replid = $kelasid
                                  GROUP BY nis
                                  ORDER BY kelas, remidi");
        $siswaremidi = collect($jmlsiswaremidi)->where('remidi', '!=', '0');

        if ($taAktif == 1) {
            $siswa = DB::connection('mysql2')->select("SELECT nis, nisn, nama, tgllahir
                               FROM jbsakad.siswa
                              WHERE idkelas = $kelasid
                                AND aktif = 1
                           ORDER BY nama");
        } else {
            $siswa = DB::connection('mysql2')->select("SELECT s.nis, s.nisn, s.nama, s.tgllahir
                               FROM jbsakad.siswa s, jbsakad.riwayatkelassiswa r
                              WHERE s.nis = r.nis
                                AND r.idkelas = $kelasid
                           ORDER BY nama");
        }

        $pegawai = DB::connection('mysql2')->select("SELECT * FROM jbssdm.pegawai");
        $aspek = DB::connection('mysql2')->select("SELECT DISTINCT a.dasarpenilaian, d.keterangan
                            FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.aturannhb a, jbsakad.dasarpenilaian d
                        WHERE i.replid = n.idinfo
                            AND d.replid < 5
                            AND i.idsemester = $semesterid
                            AND i.idkelas = $kelasid
                            AND n.idaturan = a.replid
                            AND a.dasarpenilaian = d.dasarpenilaian ORDER BY dasarpenilaian");
        $kelompokpelajaran = DB::connection('mysql2')->select("SELECT pel.idkelompok, kpel.kode, kpel.kelompok
                                        FROM jbsakad.kelompokpelajaran kpel, jbsakad.ujian uji, jbsakad.nilaiujian niluji, jbsakad.siswa sis, jbsakad.pelajaran pel
                                    WHERE uji.replid = niluji.idujian
                                        AND niluji.nis = sis.nis
                                        AND uji.idpelajaran = pel.replid
                                        AND pel.idkelompok = kpel.replid
                                        AND kpel.urutan < 7
                                        AND uji.idsemester = $semesterid
                                        AND uji.idkelas = $kelasid
                                    GROUP BY kpel.urutan");

        $pelajaran = DB::connection('mysql2')->select("SELECT pel.replid as idpelajaran, pel.nama, pel.idkelompok, kpel.kode, kpel.kelompok
                                FROM jbsakad.ujian uji, jbsakad.nilaiujian niluji, jbsakad.siswa sis, jbsakad.pelajaran pel, jbsakad.kelompokpelajaran kpel
                            WHERE uji.replid = niluji.idujian
                                AND niluji.nis = sis.nis
                                AND uji.idpelajaran = pel.replid
                                AND pel.idkelompok = kpel.replid
                                AND uji.idsemester = $semesterid
                                AND uji.idkelas = $kelasid
                            GROUP BY kpel.urutan, pel.nama
                            ORDER BY pel.kode");
        $kkm = DB::connection('mysql2')->select("SELECT idpelajaran, nilaimin
                        FROM jbsakad.infonap
                        WHERE idsemester = $semesterid
                        AND idkelas = $kelasid");
        $nilaisiswa = DB::connection('mysql2')->select("SELECT n.replid, i.idpelajaran, nama, dasarpenilaian, nipguru, nilaiangka, nilaihuruf, n.nis, komentar
                                FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.aturannhb a, jbsakad.pelajaran p
                                WHERE i.replid = n.idinfo
                                AND i.idsemester = $semesterid
                                AND i.idkelas = $kelasid
                                AND n.idaturan = a.replid
                                AND i.idpelajaran = p.replid
                            ORDER BY nilaiangka ASC");
        $presensisiswa = DB::connection('mysql2')->select("SELECT  ph.replid, ph.idpresensi, ph.nis, SUM(ph.hadir) AS hadir, sum(ph.ijin) AS ijin, sum(ph.sakit) AS sakit, SUM(ph.alpa) AS alpa, ph.keterangan, p.idkelas, p.idsemester, p.tanggal1, p.tanggal2
                                       FROM jbsakad.presensiharian p, jbsakad.phsiswa ph
                                      WHERE p.replid = ph.idpresensi
                                        AND p.idkelas = $kelasid
                                        AND ((p.tanggal1 BETWEEN '$tanggalawal' AND '$tanggalakhir') OR (p.tanggal2 BETWEEN '$tanggalawal' AND '$tanggalakhir'))
                                   GROUP BY ph.nis
                                   ORDER BY p.tanggal1;");
        $grade = DB::connection('mysql2')->select("SELECT i.idpelajaran, nama, a.dasarpenilaian, a.idtingkat, ag.replid, ag.nipguru, ag.idpelajaran, ag.nmin, ag.nmax, ag.grade
                            FROM jbsakad.infonap i, jbsakad.aturannhb a, jbsakad.pelajaran p, jbsakad.aturangrading ag
                        WHERE i.idsemester = $semesterid
                            AND a.idtingkat = $tingkatid
                            AND i.idkelas = $kelasid
                            AND i.idpelajaran = p.replid
                            AND ag.idpelajaran = i.idpelajaran
                            AND ag.dasarpenilaian = a.dasarpenilaian
                            AND ag.idpelajaran = i.idpelajaran
                            AND ag.idtingkat = a.idtingkat
                            AND a.idpelajaran = ag.idpelajaran
                            AND a.nipguru = ag.nipguru
                            AND a.dasarpenilaian = 'PNGT'
                        GROUP BY replid
                        ORDER BY grade");
        $nilaikarakter = DB::connection('mysql2')->select("SELECT n.nilaiAU as nilaiujian, n.nis, n.idjenis, n.idaturan, u.jenisujian, u.idpelajaran
                            FROM jbsakad.nau n, jbsakad.jenisujian u, jbsakad.pelajaran p
                        WHERE n.idjenis = u.replid
                            AND u.idpelajaran = p.replid
                            AND p.idkelompok = 9
                            AND n.idkelas = $kelasid
                            AND n.idsemester = $semesterid");

        if (count($nilaisiswa) > 0) {
            return view('RaportSelembar', [
                'departemen' => $departemen,
                'tahunajaran' => $tahunajaran,
                'kepsek' => $kepsek,
                'nipkepsek' => $nipkepsek,
                'semester' => $semester,
                'tanggalraport' => $tanggalraport,
                'pegawai' => $pegawai,
                'kelas' => $kelas,
                'walikelas' => $walikelas,
                'nipwali' => $nipwali,
                'siswaremidi' => $siswaremidi,
                'siswa' => $siswa,
                'aspek' => $aspek,
                'kelompokpelajaran' => $kelompokpelajaran,
                'pelajaran' => $pelajaran,
                'nilaisiswa' => $nilaisiswa,
                'tanggalawal' => $tanggalawal,
                'tanggalakhir' => $tanggalakhir,
                'presensi' => $presensisiswa,
                'grade' => $grade,
                'nilaikarakter' => $nilaikarakter
                //'foto' => $foto
            ]);
        }
        else {
            return view('Raport', [
                'departemen' => $departemen,
                'tahunajaran' => $tahunajaran,
                'kepsek' => $kepsek,
                'nipkepsek' => $nipkepsek,
                'semester' => $semester,
                'tanggalraport' => $tanggalraport,
                'pegawai' => $pegawai,
                'kelas' => $kelas,
                'walikelas' => $walikelas,
                'nipwali' => $nipwali,
                'siswa' => $siswa,
                'kelompokpelajaran' => $kelompokpelajaran,
                'pelajaran' => $pelajaran,
                'tanggalawal' => $tanggalawal,
                'tanggalakhir' => $tanggalakhir,
                'presensi' => $presensisiswa,
                'grade' => $grade
            ]);
        }
    }

    public function tampilremidi($kelas)
    //Remidi
    {
        list($tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport, $departemenid, $departemen, $kepsek, $nipkepsek, $tahunajaran, $semester, $taAktif) = Raport::varRapor();

        $kelasid = $kelas;
        $kelas = DB::connection('mysql2')->select("SELECT kelas, idtingkat, nama AS namawali, nip
                             FROM jbsakad.kelas k, jbssdm.pegawai p
                            WHERE k.replid = $kelasid
                              AND k.nipwali=p.nip");

        foreach ($kelas as $kls) {
            $kls = $kls;
        }
        $kelas = $kls->kelas;
        $walikelas = $kls->namawali;
        $nipwali = $kls->nip;
        $tingkatid = $kls->idtingkat;

        $tingkat = DB::connection('mysql2')->select("SELECT *
                               FROM jbsakad.tingkat
                              WHERE departemen='$departemen'
                                AND replid = $tingkatid");

        foreach ($tingkat as $tk) {
            $tk = $tk;
        }
        $tingkat = $tk->tingkat;

        $pegawai = DB::connection('mysql2')->select("SELECT nip, nama, handphone, status FROM jbssdm.pegawai");


        $remidi = DB::connection('mysql2')->select("SELECT n.replid, i.idpelajaran, p.nama as mapel, dasarpenilaian as aspek, nilaiangka, n.nis, s.nama, a.nipguru
                                  FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.aturannhb a, jbsakad.pelajaran p, jbsakad.siswa s
                                 WHERE i.replid = n.idinfo
                                   AND i.idsemester = $semesterid
                                   AND i.idkelas = $kelasid
                                   AND n.idaturan = a.replid
                                   AND i.idpelajaran = p.replid
                                   AND n.nis = s.nis
                                   AND nilaiangka < 70
                              ORDER BY nis, mapel");
        return view('RaportRemidi', [
            'departemen' => $departemen,
            'tahunajaran' => $tahunajaran,
            'kepsek' => $kepsek,
            'nipkepsek' => $nipkepsek,
            'semester' => $semester,
            'kelas' => $kelas,
            'walikelas' => $walikelas,
            'nipwali' => $nipwali,
            'remidi' => $remidi,
            'pegawai' => $pegawai,
            'tanggalraport' => $tanggalraport
        ]);
    }

    public function cetakcover($kelas)
    //Cetak cover kelas
    {
        list($tahunajaranid, $semesterid, $tanggalawal, $tanggalakhir, $tanggalraport, $departemenid, $departemen, $kepsek, $nipkepsek, $tahunajaran, $semester, $taAktif) = Raport::varRapor();

        $kelasid = $kelas;
        $kelas = DB::connection('mysql2')->select("SELECT kelas, idtingkat, nama AS namawali, nip
                        FROM jbsakad.kelas k, jbssdm.pegawai p
                        WHERE k.replid = $kelasid
                        AND k.nipwali=p.nip");

        foreach ($kelas as $kls) {
            $kls = $kls;
        }
        $kelas = $kls->kelas;
        $walikelas = $kls->namawali;
        $nipwali = $kls->nip;
        $tingkatid = $kls->idtingkat;

        $tingkat = DB::connection('mysql2')->select("SELECT *
            FROM jbsakad.tingkat
        WHERE departemen='$departemen'
            AND replid = $tingkatid");

        foreach ($tingkat as $tk) {
            $tk = $tk;
        }
        $tingkat = $tk->tingkat;

        if ($taAktif == 1) {
            $siswa = DB::connection('mysql2')->select("SELECT *
                                    FROM jbsakad.siswa
                                    WHERE idkelas = $kelasid
                                    AND aktif = 1
                                ORDER BY nama");
        }
        else {
            $siswa = DB::connection('mysql2')->select("SELECT s.*
                                    FROM jbsakad.siswa s, jbsakad.riwayatkelassiswa r
                                    WHERE s.nis = r.nis
                                    AND r.idkelas = $kelasid
                                ORDER BY nama");
        }

        return view('RaportCover', [
            'departemen' => $departemen,
            'tahunajaran' => $tahunajaran,
            'semester' => $semester,
            'tingkat' => $tingkat,
            'kelasid' => $kelasid,
            'kelas' => $kelas,
            'walikelas' => $walikelas,
            'nipwali' => $nipwali,
            'siswa' => $siswa,
            'kepsek' => $kepsek,
            'nipkepsek' => $nipkepsek,
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
            'tanggalraport' => $tanggalraport
        ]);
    }

}
