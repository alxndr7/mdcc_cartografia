<?php

namespace App\Http\Controllers\catastro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Predios;

class PropietariosController extends Controller
{
    public function index()
    {
        return view('configuracion/vw_propietarios');
    }

    public function show($id)
    {
        $sector = DB::table('propietarios')->where('cod_prop',$id)->get();
        return $sector;
    }

    public function getPropietarios(){
        header('Content-type: application/json');
        $propietarios = DB::select('select * from propietarios');
        return response()->json($propietarios);
    }

    public function insert_new_propietario(Request $request){
        header('Content-type: application/json');
        $data = $request->all();

        $insert=DB::table('propietarios')->insert($data);

        if ($insert) return response()->json($data);
        else return false;
    }

    function update_propietario(Request $request) {
        $data = $request->all();
        unset($data['cod_prop']);
        $update=DB::table('propietarios')->where('cod_prop',$request['cod_prop'])->update($data);
        if ($update){
            return response()->json([
                'msg' => 'si',
            ]);
        }else return false;
    }

    function delete_propietario(Request $request){
//        $user = DB::table('adm_tri.contribuyentes')->select('usuario')->where('id_pers', '=', $request['id'])->get();
        $delete = DB::table('propietarios')->where('cod_prop', $request['cod_prop'])->delete();

        if ($delete) {
            return response()->json([
                'msg' => 'si',
            ]);
        }
    }


    
}
