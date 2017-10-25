<?php

namespace App\Http\Controllers\catastro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Predios;

class MemoriaDescController extends Controller
{
    public function index()
    {
        //$deptos = DB::select('select * from dpto');
        //$provs = DB::select('select * from prov');
        $propietarios = DB::select('select * from propietarios');
        $hab_urb = DB::select('select id_hab_urba,nomb_hab_urba from tf_hab_urbana');
        return view('catastro/vw_memoria_descriptiva', compact('propietarios','hab_urb'));
    }

    public function show($id)
    {
        $memo_desc = DB::select('SELECT md.id_men_desc, md.id_dep, md.id_prov, md.id_dist, md.id_hab_urba, md.mzna, md.lote,
       md.zona, md.f_inscrita, md.partida, md.cod_prop, md.area_terreno, md.area_libre,
       md.lindero_frente, md.lindero_derecha, md.lindero_izquierda, md.lindero_fondo,
       md.f_servicios, md.f_luz, md.f_agua, md.f_desague, md.mes, md.anio, md.fec_create,
       md.id_usu_create, md.fec_update, md.id_usu_update, md.estado, md.sector_cat,
       md.mzna_cat, md.lote_cat, hu.nomb_hab_urba, md.perimetro_total
        FROM memoria_descriptiva md
       join tf_hab_urbana hu
       on md.id_hab_urba = hu.id_hab_urba where id_men_desc = ' . $id );
    //$sector = DB::table('memoria_descriptiva')->where('id_men_desc',$id)->get();
        return $memo_desc;
    }

    public function getSectores(){
        header('Content-type: application/json');
        $sectores = DB::select('select * from catastro.sectores order by id_sec');
        return response()->json($sectores);
    }

    public function insert_new_memo_desc(Request $request){
        header('Content-type: application/json');
        $data = $request->all();

        $insert=DB::table('memoria_descriptiva')->insert($data);

        if ($insert) return response()->json($data);
        else return false;
    }

    function update_memo_desc(Request $request) {
        $data = $request->all();
        unset($data['id_men_desc']);
        $update=DB::table('memoria_descriptiva')->where('id_men_desc',$request['id_men_desc'])->update($data);
        if ($update){
            return response()->json([
                'msg' => 'si',
            ]);
        }else return false;
    }

    function delete_memo_desc(Request $request){
//        $user = DB::table('adm_tri.contribuyentes')->select('usuario')->where('id_pers', '=', $request['id'])->get();
        $delete = DB::table('memoria_descriptiva')->where('id_men_desc', $request['id_men_desc'])->delete();

        if ($delete) {
            return response()->json([
                'msg' => 'si',
            ]);
        }
    }

    function provincias_por_dep(Request $req){

        $provs=DB::table('prov')->where('cod',$req['cod'])->get();
        return view('catastro/part_catastro/vw_part_provs', compact('provs'));

    }

    function  distritos_por_prov(Request $req){
        $dists=DB::table('dist')->where('cod_prov',$req['cod_prov'])->get();
        return view('catastro/part_catastro/vw_part_dists', compact('dists'));
    }

    function dlg_new_mem_desc(){
        $deptos = DB::select('select * from dpto');
        return view('catastro/part_catastro/vw_part_dlg_new_memoria_descriptiva', compact('deptos'));
    }

    public function edit(Request $request,$id)
    {
        $predio=new Predios;
        $val=  $predio::where("id_pred","=",$id )->first();
        if(count($val)>=1)
        {
            $val->id_cond_prop = $request['condpre'];
            $val->nro_condominios = $request['condos'];
            $val->id_via = $request['cvia'];
            $val->nro_mun = $request['n'];
            $val->mzna_dist = $request['mz'];
            $val->lote_dist = $request['lt'];
            $val->zona = $request['zn'];
            $val->secc = $request['secc'];
            $val->piso = $request['piso'];
            $val->dpto = $request['dpto'];
            $val->nro_int = $request['int'];
            $val->referencia = $request['ref'];
            $val->id_est_const = $request['ecc'];
            $val->id_tip_pred = $request['tpre'];
            $val->id_uso_predio = $request['tipuso'];
            $val->id_uso_pred_arbitrio = $request['uprearb'];
            $val->id_form_adq = $request['ifor'];
            $val->fech_adquis = $request['ffor'];
            $val->luz_nro_sum = $request['luz'];
            $val->agua_nro_sum = $request['agua'];
            $val->licen_const = $request['liccon'];
            $val->conform_obra = $request['confobr'];
            $val->declar_fabrica = $request['defra'];
            $val->are_terr = $request['areterr'];
            $val->are_com_terr = $request['arecomter'];
            $val->arancel = $request['aranc'];
            $val->val_ter = ($request['areterr']+$request['arecomter'])*$request['aranc'];
            $val->save();
   
        }
        return "edit".$id;
    }




    public function list_memo_desc(Request $request){
        header('Content-type: application/json');
        //dd($request['id_sect']);

        //$sql = DB::table('catastro.vw_arancel_pred_rust')->where('anio',$request->anio)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $totalg = DB::select("select count(id_men_desc) as total from memoria_descriptiva ");
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $total_pages = 0;
        if (!$sidx) {
            $sidx = 1;
        }
        $count = $totalg[0]->total;
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)
        if ($start < 0) {
            $start = 0;
        }

        // $sql = DB::select("select * from catastro.vw_arancel_pred_rust where anio = '". $request->anio ."' orderby");
        $memo_desc = DB::select("SELECT md.id_men_desc,md.partida, hu.nomb_hab_urba, prop.prop_desc,md.mzna,md,lote,md,zona fROM memoria_descriptiva md
join tf_hab_urbana hu
on md.id_hab_urba = hu.id_hab_urba
join propietarios prop
on md.cod_prop = prop.cod_prop order by " . $sidx . " " .$sord . " limit ".$limit." offset ". $start);
        //$sql = DB::table('catastro.vw_arancel_pred_rust')->where('anio',$request->anio)->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        //$sql = DB::table('adm_tri.vw_uit')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;

        foreach ($memo_desc as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_men_desc;
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_men_desc),
                trim($Datos->nomb_hab_urba),
                trim($Datos->prop_desc),
                trim($Datos->mzna),
                trim($Datos->lote),
                trim($Datos->zona),
                trim($Datos->partida)
            );
        }


        return response()->json($Lista);
    }


    public function imprimir_formatos()
    {
        $anio_tra = DB::select('select anio from adm_tri.uit order by anio desc');
        return view('adm_tributaria/imp_formatos', compact('anio_tra'));
    }

    public function reporte_ficha($id)
    {
        $memo_desc = DB::select('select md.id_men_desc, dep.dpto,pro.provinc, dis.distrit, hu.nomb_hab_urba, md.mzna, md.lote, md.zona, md.f_inscrita, md.partida,
            propi.prop_desc, md.area_terreno, md.area_libre, md.lindero_frente, md.lindero_derecha, md.lindero_izquierda, md.lindero_fondo,
            md.f_servicios, md.f_agua, md.f_luz, md.f_desague, md.mes, md.anio, md.perimetro_total
            from memoria_descriptiva md
            join dpto dep
            on dep.cod = md.id_dep
            join prov pro
            on pro.cod_prov = md.id_prov
            join dist dis
            on dis.cod_dist = md.id_dist
            join tf_hab_urbana hu
            on hu.id_hab_urba = md.id_hab_urba
            join propietarios propi
            on propi.cod_prop = md.cod_prop
            where id_men_desc = ' . $id );
           // $sql=DB::table('adm_tri.vw_contrib_hr')->where('id_pers',$contri)->get()->first();
            //$sql_pre=DB::table('adm_tri.vw_predi_urba')->where('id_pers',$contri)->where('anio',$an)->get();
        $servicios="";
        $f_3 = 0;
        if($memo_desc[0]->f_agua){
            $servicios = $servicios."agua, ";
            $f_1 = 1;
        }
        if($memo_desc[0]->f_desague){
            $servicios = $servicios."desague, ";
            $f_1 = 1;
        }
        if($memo_desc[0]->f_luz){
            $f_3 = 1;
            $servicios = $servicios."luz.";
        }
        if($f_3 != 1){
            $servicios = substr($servicios, 0, -2);
            $servicios = $servicios.".";
        }




        $view =  \View::make('catastro.reportes.memoria_descriptiva', compact('memo_desc','servicios'))->render();


        if(count($memo_desc)>=1)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4');
            return $pdf->stream($id.".pdf");
        }
        else
        {   return 'No hay datos';}
    }

    
}
