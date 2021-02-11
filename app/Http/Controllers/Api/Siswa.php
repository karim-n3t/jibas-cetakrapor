<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Routing\ResponseFactory;

class Siswa extends Controller
{
  public function index()
  {
    $result = DB::select("SELECT nis, nisn, nama, alamatsiswa FROM jbsakad.siswa LIMIT 100");
    
    return response()->json($result);
  }
  public function show($siswa = null)
  {
    $result = DB::select("SELECT nis, nisn, nama, alamatsiswa FROM jbsakad.siswa WHERE nis = '$siswa'");    
    return response()->json($result);
  }
}
