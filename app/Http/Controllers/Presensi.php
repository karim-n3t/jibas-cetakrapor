<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Presensi extends Controller
{
    public function pengaturan()
    {
        $pengaturan = DB::connection('mysql2')->select('SELECT id, bulan, elt(bulan, "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember") AS nama_bulan, tahun, hari_kerja, hari_efektif, jam_pulang, tgl_ttd, DATE_FORMAT(tgl_ttd, "%d-%m-%Y") AS ttds FROM jibasrekap.harikerja ORDER BY id DESC');
        return view('PresensiPengaturan', ['pengaturan' => $pengaturan]);
    }

    public function rekap(Request $request)
    {

        if (null !== ($request->input('tahun')) || null !== ($request->input('bulan'))) {
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');
        } else {
            //Set Values
            $tahun = date("Y", strtotime("-1 months"));
            $bulan = date('m', strtotime('-1 months'));
        }


        $tanggal_awal = date("Y-m-d", strtotime($tahun . "-" . $bulan . "-01"));
        $tanggal_akhir = date("Y-m-t", strtotime($tahun . "-" . $bulan));

        // Pengaturan Presensi
        $pengaturan = DB::connection('mysql2')->select('SELECT id, bulan, ELT(bulan, "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember") AS nama_bulan, tahun, hari_kerja, hari_efektif, jam_pulang, tgl_ttd FROM jibasrekap.harikerja WHERE harikerja.bulan=' . $bulan . ' AND harikerja.tahun=' . $tahun);

        if (empty($pengaturan)) {
            $pengaturan = array("bulan" => "", "nama_bulan" => "??", "tahun" => "20??", "hari_kerja" => "26", "hari_efektif" => "22", "jam_pulang" => "15:30:00", "tgl_ttd" => "01-01-2020");
            $p = (object) $pengaturan;
        } else {
            foreach ($pengaturan as $p) {
                $p = $p;
            }
        }

        $rekapbulan = $p->bulan;
        $rekapnamabulan = $p->nama_bulan;
        $rekaptahun = $p->tahun;
        $hari_kerja = $p->hari_kerja;
        $hari_efektif = $p->hari_efektif;
        $jamkerjatarget = $hari_efektif * 8;
        $jampulangawal = $p->jam_pulang;
        $tanggal_ttd = $p->tgl_ttd;

        $rekap = DB::connection('mysql2')->select('SELECT pegawai.nip, pegawai.nama, IFNULL((SELECT COUNT(jammasuk) FROM jbssdm.presensi WHERE presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS datang, IFNULL((SELECT COUNT(jampulang) FROM jbssdm.presensi WHERE presensi.jampulang!="' . $jampulangawal . '" AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS pulang, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=2 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS ijin, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=3 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS cuti, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=4 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS sakit, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=5 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS alpha, IFNULL((SELECT ijin+cuti+sakit+alpha),0) AS tidakhadir, IFNULL((SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(jampulang, jammasuk)))) FROM jbssdm.presensi WHERE presensi.jampulang!="' . $jampulangawal . '" AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip AND jammasuk IS NOT NULL),0) AS totalwaktukerja, IFNULL ((SELECT TIME_FORMAT(totalwaktukerja, "%H")),0) AS jamkerja, IFNULL ((SELECT FORMAT ((TIME_FORMAT(totalwaktukerja, "%H")/' . $jamkerjatarget . '*100),2)),0) AS persen, IFNULL ((SELECT IF((persen>=100), "Terpenuhi", "Tidak")),0) AS capaian FROM jbssdm.pegawai WHERE pegawai.aktif=1 ORDER BY pegawai.noid;');

        setlocale(LC_TIME, 'IND');
        return view('PresensiRekap', [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'bulan' => $rekapbulan,
            'nama_bulan' => $rekapnamabulan,
            'tahun' => $rekaptahun,
            'hari_kerja' => $hari_kerja,
            'hari_efektif' => $hari_efektif,
            'jamkerjatarget' => $jamkerjatarget,
            'jampulangawal' => $jampulangawal,
            'tanggal_ttd' => $tanggal_ttd,
            'rekap' => $rekap
        ]);
    }

    public function harian(Request $request)
    {

        if (null !== ($request->input('tanggal'))) {
            $tanggal = $request->input('tanggal');
        } else {
            //Set Values
            $tanggal = date("Y-m-d");
        }

        // Pengaturan Presensi
        $harian = DB::connection('mysql2')->select('SELECT frp.nip, peg.nama, frp.date_in, frp.time_in, frp.time_out, peg.foto FROM jbssat.frpresence frp, jbssdm.pegawai peg WHERE frp.nip = peg.nip AND frp.nip IS NOT NULL AND frp.date_in = "'.$tanggal. '" ORDER BY time_in;');

        setlocale(LC_TIME, 'IND');
        return view('PresensiHarian', [
            'tanggal' => $tanggal,
            'harian' => $harian
        ]);
    }


    public function perorangan(Request $request, $nip, $tahun = null, $bulan = null)
    {

        if (!$nip) {
            $nip = '992002234';
        }
        if (!$tahun) {
            $tahun = date('Y', strtotime('-1 months'));
        }
        if (!$bulan) {
            $bulan = date('m', strtotime('-1 months'));
        }
        if (null !== ($request->input('nip')) || null !== ($request->input('tahun')) || null !== ($request->input('bulan'))) {
            $nip = ($request->input('nip'));
            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');
        }

        $tanggal_awal = date("Y-m-d", strtotime($tahun . "-" . $bulan . "-01"));
        $tanggal_akhir = date("Y-m-t", strtotime($tahun . "-" . $bulan));

        // Daftar Pegawai
        $pegawai = DB::connection('mysql2')->select('SELECT replid, nip, nama, noid FROM jbssdm.pegawai WHERE aktif="1" ORDER BY noid');
        // Pengaturan Presensi
        $pengaturan = DB::connection('mysql2')->select('SELECT id, bulan, ELT(bulan, "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember") AS nama_bulan, tahun, hari_kerja, hari_efektif, jam_pulang, tgl_ttd FROM jibasrekap.harikerja WHERE harikerja.bulan=' . $bulan . ' AND harikerja.tahun=' . $tahun);
        if (empty($pengaturan)) {
            $pengaturan = array("bulan" => "", "nama_bulan" => "??", "tahun" => "20??", "hari_kerja" => "26", "hari_efektif" => "22", "jam_pulang" => "15:30:00", "tgl_ttd" => "01-01-2020");
            $p = (object) $pengaturan;
        } else {
            foreach ($pengaturan as $p) {
                $p = $p;
            }
        }

        $rekapbulan = $p->bulan;
        $rekapnamabulan = $p->nama_bulan;
        $rekaptahun = $p->tahun;
        $hari_kerja = $p->hari_kerja;
        $hari_efektif = $p->hari_efektif;
        $jamkerjatarget = $hari_efektif * 8;
        $jampulangawal = $p->jam_pulang;
        $tanggal_ttd = $p->tgl_ttd;

        $rekap = DB::connection('mysql2')->select('SELECT pegawai.nip, pegawai.nama, IFNULL((SELECT COUNT(jammasuk) FROM jbssdm.presensi WHERE presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS datang, IFNULL((SELECT COUNT(jampulang) FROM jbssdm.presensi WHERE presensi.jampulang!="' . $jampulangawal . '" AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS pulang, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=2 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS ijin, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=3 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS cuti, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=4 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS sakit, IFNULL((SELECT COUNT(status) FROM jbssdm.presensi WHERE presensi.status=5 AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip),0) AS alpha, IFNULL((SELECT ijin+cuti+sakit+alpha),0) AS tidakhadir, IFNULL((SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(jampulang, jammasuk)))) FROM jbssdm.presensi WHERE presensi.jampulang!="' . $jampulangawal . '" AND presensi.tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" AND  pegawai.nip=presensi.nip AND jammasuk IS NOT NULL),0) AS totalwaktukerja, IFNULL ((SELECT TIME_FORMAT(totalwaktukerja, "%H jam %i menit")),0) AS jamkerja, IFNULL ((SELECT FORMAT ((TIME_FORMAT(totalwaktukerja, "%H")/' . $jamkerjatarget . '*100),2)),0) AS persen, IFNULL ((SELECT IF((persen>=100), "Terpenuhi", "Tidak")),0) AS capaian FROM jbssdm.pegawai WHERE pegawai.nip="' . $nip . '"');

        // Presensi Perorangan
        $perorangan = DB::connection('mysql2')->select('SELECT replid, nip, ELT((DAYOFWEEK(tanggal)), "Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu") AS hari,  tanggal, DATE_FORMAT(tanggal, "%d/%m/%Y") AS tanggals, jammasuk, jampulang, IF(jampulang!="' . $jampulangawal . '", jampulang, NULL) AS jampulangfix, SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(jampulang, jammasuk))) AS jumlahjam, IF(jampulang="15:30:00",NULL,(SELECT jumlahjam)) AS jumlahjamfix, (SELECT TIME_FORMAT(jumlahjamfix, "%H jam %i menit")) AS waktukerja, status, ELT(STATUS, "Hadir", "Izin", "Cuti", "Sakit", "Alpha") AS statuss,  keterangan, source FROM jbssdm.presensi WHERE nip="' . $nip . '" AND tanggal BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '" ORDER BY tanggal');
        $route = Route::currentRouteName();

        setlocale(LC_TIME, 'IND');
        return view('PresensiPerorangan', [
            'route' => $route,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'bulan' => $rekapbulan,
            'nama_bulan' => $rekapnamabulan,
            'tahun' => $rekaptahun,
            'hari_kerja' => $hari_kerja,
            'hari_efektif' => $hari_efektif,
            'jamkerjatarget' => $jamkerjatarget,
            'jampulangawal' => $jampulangawal,
            'tanggal_ttd' => $tanggal_ttd,
            'rekap' => $rekap,
            'pegawai' => $pegawai,
            'perorangan' => $perorangan
        ]);
    }

    public function personal(Request $request, $nip = null)
    {

        if (!$nip) {
            $nip = '992002234';
        }

        if (null !== ($request->input('nip'))) {
            $nip = ($request->input('nip'));
        }

        // Pengaturan Presensi
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y-m-d");
        $waktu = date("H:i:s");
        $hari = date("w")+1;

        // Daftar Pegawai
        $pegawai = DB::connection('mysql2')->select('SELECT replid, nip, nama, noid FROM jbssdm.pegawai WHERE aktif="1" ORDER BY noid');
        $jadwals = DB::connection('mysql2')->select('SELECT * FROM jbssat.frjadwalsekolah WHERE kelompok=1 AND hari='.$hari.';');
        $personal = DB::connection('mysql2')->select('SELECT * FROM jbssdm.pegawai WHERE nip='.$nip.' AND aktif="1";');



        // Presensi Perorangan
        $route = Route::currentRouteName();

        setlocale(LC_TIME, 'IND');
        return view('PresensiPersonal', [
            'route' => $route,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'pegawai' => $pegawai,
            'jadwals' => $jadwals,
            'personal' => $personal
        ]);
    }
}
