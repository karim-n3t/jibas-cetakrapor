<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JibasAkademik extends Controller
{
    public function departemen($departemenid)
    {
        $departemen = DB::select("SELECT departemen, nipkepsek, p.nama, d.keterangan
                                FROM jbsakad.departemen d, jbssdm.pegawai p
                               WHERE d.replid = $departemenid
                                 AND d.nipkepsek = p.nip");
        return $departemen;
    }

    public function daftartahunajaran($departemen)
    {
        $tahunajaran = DB::select("SELECT replid, tahunajaran, aktif
                                 FROM jbsakad.tahunajaran
                                WHERE departemen = '$departemen'
                             ORDER BY replid DESC");
        retur
    }

    public function tahunajaran($idtahunajaran)
    {
        $tahunajaran = DB::select("SELECT replid, tahunajaran, aktif
                                 FROM jbsakad.tahunajaran
                                WHERE replid = $idtahunajaran
                             ORDER BY replid DESC");
    }

    public function daftarsemester($departemen)
    {
        $semester = DB::select("SELECT replid, semester
                              FROM jbsakad.semester
                             WHERE departemen = '$departemen'");
    }

    public function semester($departemen, $semesterid)
    {
        $semester = DB::select("SELECT replid, semester
                              FROM jbsakad.semester
                             WHERE departemen = '$departemen'
                               AND replid = $semesterid");
    }

    public function tingkat($departemen)
    {
        $tingkat = DB::select("SELECT *
                               FROM jbsakad.tingkat
                              WHERE departemen='$departemen'
                           ORDER BY urutan");
    }

    public function daftarkelas($tahunajaranid)
    {
        $kelas = DB::select("SELECT kelas, idtingkat, nama AS namawali, nip
                             FROM jbsakad.kelas k, jbssdm.pegawai p
                            WHERE k.nipwali = p.nip
                              AND idtahunajaran = $tahunajaranid");
    }

    public function kelas($idkelas)
    {
        $kelas = DB::select("SELECT kelas, idtingkat, nama AS namawali, nip
                             FROM jbsakad.kelas k, jbssdm.pegawai p
                            WHERE k.nipwali = p.nip
                              AND k.replid = $idkelas");
    }

    public function daftarpegawai()
    {
        $pegawai = DB::select("SELECT * FROM jbssdm.pegawai");

    }

    public function pegawai($nip)
    {
        $pegawai = DB::select("SELECT * FROM jbssdm.pegawai where nip = $nip");

    }

    public function jumlahsiswaremidi($tahunajaranid, $semesterid)
    {
        $jmlsiswaremidi = DB::select("SELECT nis, SUM(CASE WHEN nilaiangka < 70 THEN 1 ELSE 0 END) AS remidi, i.idkelas, k.kelas, k.idtahunajaran
                                      FROM jbsakad.infonap i, jbsakad.nap n, jbsakad.kelas k
                                     WHERE i.replid = n.idinfo
                                       AND k.replid = i.idkelas
                                       AND k.idtahunajaran = $tahunajaranid
                                       AND i.idsemester = $semesterid
                                  GROUP BY nis");
    }

    public function daftarsiswarombel($idkelas)
    {
        $kelas = kelas($idkelas);

        $tahunajaran = tahunajaran($idtahunajaran)

        foreach ($tahunajaran as $ta) {
            $ta = $ta;
        }
        $tahunajaran = $ta->tahunajaran;
        $taAktif = $ta->aktif;

        if ($taAktif == 1) {
            $siswa = DB::select("SELECT *
                                    FROM jbsakad.siswa
                                    WHERE idkelas = $kelasid
                                    AND aktif = 1
                                ORDER BY nama");
        } else {
            $siswa = DB::select("SELECT s.*
                                    FROM jbsakad.siswa s, jbsakad.riwayatkelassiswa r
                                    WHERE s.nis = r.nis
                                    AND r.idkelas = $kelasid
                                ORDER BY nama");
        }

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

    public function
    {

    }

}
