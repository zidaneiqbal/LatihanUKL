<?php

namespace App\Http\Controllers;

use App\Poin_Siswa;
use App\Pelanggaran;
use Illuminate\Http\Request;

class PoinSiswaController extends Controller
{
    public function index($limit = 10, $offset = 0)
    {
      $data["count"] = Poin_Siswa::count();
      $poin = array();

      foreach (Poin_Siswa::take($limit)->skip($offset)->get() as $p) {
          $item = [
              "id"              => $p->id,
              "id_siswa"        => $p->id_siswa,
              "id_pelanggaran"  => $p->id_pelanggaran,
              "tanggal"         => $p->tanggal,
              "keterangan"      => $p->keterangan,
              "poin_siswa"      => $p->pelanggarans->poin,
              "kategori"        => $p->pelanggarans->kategori,
          ];

          array_push($poin, $item);
      }
      $data["poin"] = $poin;
      $data["status"] = 1;
      return response($data);
    }

    public function store(Request $request)
    {
        $poin_siswa = new Poin_Siswa([
          'id_siswa' => $request->id_siswa,
          'id_pelanggaran' => $request->id_pelanggaran,
          'tanggal' => now(),
          'keterangan' => $request->keterangan,
        ]);

        $poin_siswa->save();
        return response($poin_siswa);

    }

    public function show($id)
    {
        $poin = Poin_Siswa::where('id', $id)->get();

        $poin_siswa = array();
        foreach ($poin as $p) {
            $item = [
                "id"              => $p->id,
                "id_siswa"        => $p->id_siswa,
                "id_pelanggaran"  => $p->id_pelanggaran,
                "tanggal"         => $p->tanggal,
                "keterangan"      => $p->keterangan,
                "poin_siswa"      => $p->pelanggarans->poin,
                "kategori"        => $p->pelanggarans->kategori,
            ];
            array_push($poin_siswa, $item);
        }

        $data["poinSiswa"] = $poin_siswa;
        $data["status"] = 1;
        return response($data);

    }

    public function detail($id)
    {
        $poin = Poin_Siswa::where('id_siswa', $id)->get();

        $poin_siswa = array();
        foreach ($poin as $p) {
            $item = [
                "id"              => $p->id,
                "id_siswa"        => $p->id_siswa,
                "id_pelanggaran"  => $p->id_pelanggaran,
                "tanggal"         => $p->tanggal,
                "keterangan"      => $p->keterangan,
                "poin_siswa"      => $p->pelanggarans->poin,
                "kategori"        => $p->pelanggarans->kategori,
            ];
            array_push($poin_siswa, $item);
        }

        $data["poinSiswa"] = $poin_siswa;
        $data["status"] = 1;
        return response($data);

    }


    public function update($id, Request $request)
    {
        $poin = Poin_Siswa::where('id', $id)->first();

        $poin->id_siswa = $request->id_siswa;
        $poin->id_pelanggaran = $request->id_pelanggaran;
        $poin->keterangan = $request->keterangan;
        $poin->updated_at = now()->timestamp;

        $poin->save();

        return response($poin);
    }

    public function destroy($id)
    {
        $poin = Poin_Siswa::where('id', $id)->first();

        $poin->delete();

        return response()->json([
          'status'  => '1',
          'message' => 'Delete Data Berhasil'
        ]);
    }
}
