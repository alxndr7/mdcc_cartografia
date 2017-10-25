<?php

namespace App\Http\Controllers\map;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
//       if (Auth::check())
//        {
//            return view('home');
//        }
//        else return view('auth/login');

        //$lotes = DB::select('SELECT ST_AsGeoJSON(geometria) from catastro.lotes;');
        $sectores = DB::select('SELECT  id_sec, sector FROM catastro.sectores order by sector asc;');
        $aprobado = DB::select('SELECT DISTINCT grup_tab, desc_tab FROM cartografia."mTabTab" order by grup_tab;');

        return view('principal/home', compact('sectores','aprobado'));
    }

    function get_manzanas(){
        //$lotes = DB::select('select ST_AsGeoJSON(geom) geometry from espacial.manzanas');
/*
        $manzanas = DB::select(" SELECT json_build_object(
                'type',       'Feature',
                'id',         gid,
                'properties', json_build_object(
                   'gid', gid,
                    'cod_sect', cod_sect,
                    'cod_mza', cod_mza,
                    'mza_urb', mza_urb
                 ),
                 'geometry',   ST_AsGeoJSON(geom)::json
                  ) features
                  FROM espacial.manzanas limit 10;");*/


        $mznas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         gid,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid,
                                'mz_cat', mz_cat,
                                'mz_urb', mz_urb,
                                'sector_cat', sector_cat,
                                'aprobacion', aprobacion,
                                'cod_hab',cod_hab,
                                'nombre', nombre,
                                'jurisdicci', jurisdicci
                             )
                          ) AS feature
                          FROM (SELECT * FROM espacial.manzanas) row) features;");

        return response()->json($mznas);
    }
    function get_limites(){
        $limites = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         id,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid
                             )
                          ) AS feature
                          FROM (SELECT * FROM cartografia.limites) row) features;");

        return response()->json($limites);
    }
    function get_sectores(){

        $sectores = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id_sec',         id_sec,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                                'sector', sector
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.sectores) row) features;");

        return response()->json($sectores);
    }

    function get_hab_urb(){
        $sectores = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         gid,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                              'cod_hab',cod_hab,
                              'nom_hab_urb',nom_hab_urb,
                               'gid', gid
                             )
                          ) AS feature
                          FROM (SELECT * FROM cartografia.hab_urba) row) features;");

        return response()->json($sectores);
    }

    function get_lotes_x_sector(Request $req){

        $lotes = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id_lote',         id_lote,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'id_lote', id_lote,
                                'id_mzna', id_mzna,
                                'codi_lote', codi_lote,
                                'id_hab_urb', id_hab_urb,
                                'id_sect',id_sect
                             )
                          ) AS feature
                          FROM (select l.id_lote, l.id_mzna, l.codi_lote, l.id_hab_urb, l.geom, m.id_sect from  catastro.lotes l
join catastro.manzanas m on
m.id_mzna = l.id_mzna) row) features;");

        return response()->json($lotes);
    }


    function get_centro_sector(Request $reques){
        //dd($reques->codigo);
        $centro_sector = DB::select("SELECT ST_X(ST_Centroid(ST_Transform (geom, 4326))) lat,ST_Y(ST_Centroid(ST_Transform (geom, 4326))) lon  from catastro.sectores where id_sec = '" . $reques->codigo . "'");
        return response()->json($centro_sector);
    }

    function mznas_x_sector(Request $req){
        $mznas=DB::select("SELECT id_mzna, codi_mzna FROM catastro.manzanas where id_sect = '". $req->codigo."';");

        return view("principal/fpart/vw_select_mznas", compact('mznas'));
        //return view('catastro/vw_part_dlg_new_memoria_descriptiva', compact('mznas'));
    }

    function geogetmznas_x_sector(Request $req){
        $mznas = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id_mzna',         id_mzna,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'id_mzna', id_mzna,
                                'id_sect', id_sect,
                                'codi_mzna', codi_mzna
                             )
                          ) AS feature
                          FROM (SELECT * FROM catastro.manzanas where id_sect = '".$req->codigo."') row) features;");

        return response()->json($mznas);
    }

    function get_predios_rentas(Request $req){
        $predios = DB::select("SELECT json_build_object(
                            'type',     'FeatureCollection',
                            'features', json_agg(feature)
                        )
                        FROM (
                          SELECT json_build_object(
                            'type',       'Feature',
                            'id',         gid,
                            'geometry',   ST_AsGeoJSON(ST_Transform (geom, 4326))::json,
                            'properties', json_build_object(
                               'gid', gid,
                                'cod_mza', cod_mza,
                                'mz_urb', mz_urb,
                                'cod_sect', cod_sect,
                                'nom_lote',nom_lote,
                                'cod_habi',cod_habi,
                                'habilit',habilit,
                                'sec_mzna',sec_mzna,
                                'cod_lote',cod_lote
                             )
                          ) AS feature
                          FROM (SELECT lotes.gid, lotes.layer, lotes.cod_mza, lotes.mz_urb, lotes.cod_sect, lotes.nom_lote, lotes.cod_habi, lotes.habilit,
                                   lotes.sec_mzna, lotes.cod_lote, lotes.geom FROM espacial.lotes lotes
                                    join (SELECT * FROM public.dblink ('demodbrnd','SELECT sec, mzna, lote FROM adm_tri.predios')
                                    AS tb1(sec1 CHARACTER VARYING,mzna1 CHARACTER VARYING,lote1 CHARACTER VARYING)) as tb1
                                    on tb1.sec1 = lotes.cod_sect and tb1.mzna1 = lotes.cod_mza and tb1.lote1 = lotes.cod_lote where cod_sect ='".$req->codigo ."' ) row) features;");
        return response()->json($predios);
    }
    
    public function nuevoUsuario(){
        return view('fnewUsuario');
    }

    function guardar_documentos(Request $request){
        /*
        $file = $request->file('');
        $file2 = \File::get($file);
        $foto = base64_encode($file2);

        $file_memo_desc = $request->file('');
        $file2_memo_desc = \File::get($file_memo_desc);
        $doc_memo_desc = base64_encode($file2_memo_desc);

                $file_ind_aprob = $request->file('');
                $file2_ind_aprob = \File::get($file_ind_aprob);
                $doc_ind_aproba = base64_encode($file2_ind_aprob);

                $file_ind_cop_literal = $request->file('');
                $file2_ind_cop_literal = \File::get($file_ind_cop_literal);
                $doc_ind_cop_literal = base64_encode($file2_ind_cop_literal);

                $file_ind_zonificacion = $request->file('');
                $file2_ind_zonificacion = \File::get($file_ind_zonificacion);
                $doc_ind_zonificacion = base64_encode($file2_ind_zonificacion);

                $file_ind_resolucion= $request->file('');
                $file2_ind_resolucion= \File::get($file_ind_resolucion);
                $doc_ind_resolucion = base64_encode($file2_ind_resolucion);
*/
        if($request->file('ind_planos')) {
            $ind_planos = base64_encode(\File::get($request->file('ind_planos')));
        }else{$ind_planos ='';}

        if($request->file('ind_memo_desc')){
            $ind_memo_desc= base64_encode(\File::get($request->file('ind_memo_desc')));
        }else{$ind_memo_desc= '';}

        if($request->file('ind_aprobacion')){
            $ind_aprobacion = base64_encode(\File::get($request->file('ind_aprobacion')));
        }
        else{ $ind_aprobacion= '';}

        if($request->file('ind_cop_literal')){
            $ind_cop_literal = base64_encode(\File::get($request->file('ind_cop_literal')));
        } else{$ind_cop_literal = '';}

        if($request->file('ind_zonificacion')){
            $ind_zonificacion =  base64_encode(\File::get($request->file('ind_zonificacion')));
        }
        else{$ind_zonificacion = '';}

        if($request->file('ind_resolucion')){
            $ind_resolucion = base64_encode(\File::get($request->file('ind_resolucion')));
        }
        else{$ind_resolucion = '';}


        if($request->file('hu_planos')) {
            $hu_planos = base64_encode(\File::get($request->file('hu_planos')));
        }else{$hu_planos ='';}

        if($request->file('hu_memo_desc')){
            $hu_memo_desc = base64_encode(\File::get($request->file('hu_memo_desc')));
        }else{$hu_memo_desc = '';}

        if($request->file('hu_aprobacion')){
            $hu_aprobacion = base64_encode(\File::get($request->file('hu_aprobacion')));
        }
        else{ $hu_aprobacion= '';}

        if($request->file('hu_cop_literal')){
            $hu_cop_literal = base64_encode(\File::get($request->file('hu_cop_literal')));
        } else{$hu_cop_literal = '';}

        if($request->file('hu_zonificacion')){
            $hu_zonificacion =  base64_encode(\File::get($request->file('hu_zonificacion')));
        }
        else{$hu_zonificacion = '';}

        if($request->file('hu_resolucion')){
            $hu_resolucion = base64_encode(\File::get($request->file('hu_resolucion')));
        }
        else{$hu_resolucion = '';}


        if($request->file('ro_planos')) {
            $ro_planos = base64_encode(\File::get($request->file('ro_planos')));
        }else{$ro_planos ='';}

        if($request->file('ro_memo_desc')){
            $ro_memo_desc = base64_encode(\File::get($request->file('ro_memo_desc')));
        }else{$ro_memo_desc = '';}

        if($request->file('ro_aprobacion')){
            $ro_aprobacion = base64_encode(\File::get($request->file('ro_aprobacion')));
        }
        else{ $ro_aprobacion= '';}

        if($request->file('ro_cop_literal')){
            $ro_cop_literal = base64_encode(\File::get($request->file('ro_cop_literal')));
        } else{$ro_cop_literal = '';}

        if($request->file('ro_zonificacion')){
            $ro_zonificacion =  base64_encode(\File::get($request->file('ro_zonificacion')));
        }
        else{$ro_zonificacion = '';}

        if($request->file('ro_resolucion')){
            $ro_resolucion = base64_encode(\File::get($request->file('ro_resolucion')));
        }
        else{$ro_resolucion = '';}


        if($request->file('pi_planos')) {
            $pi_planos = base64_encode(\File::get($request->file('pi_planos')));
        }else{$pi_planos ='';}

        if($request->file('pi_memo_desc')){
            $pi_memo_desc= base64_encode(\File::get($request->file('pi_memo_desc')));
        }else{$pi_memo_desc = '';}

        if($request->file('pi_aprobacion')){
            $pi_aprobacion = base64_encode(\File::get($request->file('pi_aprobacion')));
        }
        else{ $pi_aprobacion= '';}

        if($request->file('pi_cop_literal')){
            $pi_cop_literal = base64_encode(\File::get($request->file('pi_cop_literal')));
        } else{$pi_cop_literal = '';}

        if($request->file('pi_zonificacion')){
            $pi_zonificacion =  base64_encode(\File::get($request->file('pi_zonificacion')));
        }
        else{$pi_zonificacion = '';}

        if($request->file('pi_resolucion')){
            $pi_resolucion = base64_encode(\File::get($request->file('pi_resolucion')));
        }
        else{$pi_resolucion = '';}

        $id_hab_urb = $request['id_hab_urb_dist'];

        $insert = DB::table('cartografia.p_hab_tab')->insert([
            ['gid_hab_urb'=> $id_hab_urb  ,
                'cod_tab'=> '004001',
                'doc_planos' => $ind_planos,
                'doc_memo_desc' => $ind_memo_desc,
                'doc_aprobacion'=>$ind_aprobacion,
                'doc_cop_literal'=>$ind_cop_literal,
                'doc_cert_zoni' =>$ind_zonificacion,
                'doc_resolucion' =>$ind_resolucion],
            [   'gid_hab_urb'=> $id_hab_urb ,
                'cod_tab'=> '004002',
                'doc_planos' => $hu_planos,
                'doc_memo_desc' => $hu_memo_desc,
                'doc_aprobacion'=>$hu_aprobacion,
                'doc_cop_literal'=>$hu_cop_literal,
                'doc_cert_zoni' =>$hu_zonificacion,
                'doc_resolucion' =>$hu_resolucion],
            [   'gid_hab_urb'=> $id_hab_urb ,
                'cod_tab'=> '004003',
                'doc_planos' => $ro_planos,
                'doc_memo_desc' => $ro_memo_desc,
                'doc_aprobacion'=>$ro_aprobacion,
                'doc_cop_literal'=>$ro_cop_literal,
                'doc_cert_zoni' =>$ro_zonificacion,
                'doc_resolucion' =>$ro_resolucion],
            [   'gid_hab_urb'=> $id_hab_urb ,
                'cod_tab'=> '004004',
                'doc_planos' => $pi_planos,
                'doc_memo_desc' => $pi_memo_desc,
                'doc_aprobacion'=>$pi_aprobacion,
                'doc_cop_literal'=>$pi_cop_literal,
                'doc_cert_zoni' =>$pi_zonificacion,
                'doc_resolucion' =>$pi_resolucion]]);
        //$update = DB::table('usuarios')->where('id',$id)->update(['foto'=>$foto]);
        if ($insert) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }

    function guardar_docs_cofopri(Request $request){

        //dd($request['id_hab_urb_cofo']);
        $file = $request->file('cofo_doc1');
        $file2 = \File::get($file);
        $doc_1 = base64_encode($file2);

        $insert = DB::table('cartografia.p_hab_tab')->insert([
            ['gid_hab_urb'=> $request['id_hab_urb_cofo'],
                'cod_tab'=> '002001',
                'doc_planos' => $doc_1]
        ]);
        //$update = DB::table('usuarios')->where('id',$id)->update(['foto'=>$foto]);
        if ($insert) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }

    function guardar_docs_sin_datos(Request $request){

        //dd($request['id_hab_urb_cofo']);
        $file = $request->file('sin_datos_doc1');
        $file2 = \File::get($file);
        $doc_1 = base64_encode($file2);

        $insert = DB::table('cartografia.p_hab_tab')->insert([
            ['gid_hab_urb'=> $request['id_hab_urb_sin_datos'],
                'cod_tab'=> '003001',
                'doc_planos' => $doc_1]
        ]);
        //$update = DB::table('usuarios')->where('id',$id)->update(['foto'=>$foto]);
        if ($insert) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
        }
    }


    function guardar_docs_prov(Request $request){

        if($request->file('prov_doc1'))
        {
            $file = $request->file('prov_doc1');
            $file2 = \File::get($file);
            $doc_1 = base64_encode($file2);
        }else{
            $doc_1 ='';
        }

        if($request->file('prov_doc2')){
            $file_memo_desc = $request->file('prov_doc2');
            $file2_memo_desc = \File::get($file_memo_desc);
            $doc_2 = base64_encode($file2_memo_desc);
        }else{
            $doc_2 = '';
        }

        if($request->file('prov_doc3')){
            $file_ind_aprob = $request->file('prov_doc3');
            $file2_ind_aprob = \File::get($file_ind_aprob);
            $doc_3 = base64_encode($file2_ind_aprob);
        }
        else{
            $doc_3 = '';
        }

        $insert = DB::table('cartografia.p_hab_tab')->insert([
            ['gid_hab_urb'=> $request['id_hab_urb_prov'] ,
                'cod_tab'=> '001001',
                'doc_planos' => $doc_1,
                'doc_memo_desc' => $doc_2,
                'doc_aprobacion'=>$doc_3]
        ]);
        //$update = DB::table('usuarios')->where('id',$id)->update(['foto'=>$foto]);
        if ($insert) {
            return response()->json(['msg' => 'si']);
        } else {
            return response()->json(['msg' => 'no']);
    }
    }


}
