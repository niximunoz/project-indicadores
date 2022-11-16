<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use GuzzleHttp\Psr7\Request as RequestGuzz;
use GuzzleHttp\Client;

class IndicadoresController extends Controller
{
    public function mostrar() //
    {
        $client = new Client(); //solicitar token api
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $body = '{
                "userName": "niximunozrk9p5u_pm4@indeedemail.com",
             "flagJson": true
            }';
        $requests = new RequestGuzz('POST', 'https://postulaciones.solutoria.cl/api/acceso/', $headers, $body);
        $res = $client->sendAsync($requests)->wait();
        $res->getBody();

        $body = json_decode($res->getBody());

        $token = $body->{'token'};
        //se guarda token en variable
        $client2 = new Client(); //Solicitar datos API indicadores
        $headers2 = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];
        $body2 = '';
        $request2 = new RequestGuzz('GET', 'https://postulaciones.solutoria.cl/api/indicadores/', $headers2, $body2);
        $res2 = $client2->sendAsync($request2)->wait();
        $datos = json_decode($res2->getBody()->getContents(), true);

        $query = '';
        $table_data = '';

        foreach ($datos as $row) {
            $query .=
                DB::UPDATE(
                    "REPLACE INTO  indicadores VALUES 
                          ('" . $row["id"] . "', '" . $row["nombreIndicador"] . "', 
                          '" . $row["codigoIndicador"] . "','" . $row["unidadMedidaIndicador"] . "',
                          '" . $row["valorIndicador"] . "','" . $row["fechaIndicador"] . "',
                          '" . $row["tiempoIndicador"] . "','" . $row["origenIndicador"] . "'
                        ); "
                );

            $table_data .= '
                          <tr>
                              <td>' . $row["id"] . '</td>
                              <td>' . $row["nombreIndicador"] . '</td>
                              <td>' . $row["codigoIndicador"] . '</td>
                              <td>' . $row["unidadMedidaIndicador"] . '</td>
                              <td>' . $row["valorIndicador"] . '</td>
                              <td>' . $row["fechaIndicador"] . '</td>
                              <td>' . $row["tiempoIndicador"] . '</td>
                              <td>' . $row["origenIndicador"] . '</td>
                          </tr>
                          ';
        }
        return view('indicadores.index');
    }

    public function index(Request $request) //Mostrar datos tabla indicadores
    {
        if ($request->ajax()) {
            $indicadores = DB::select('select ID,nombreIndicador,codigoIndicador, unidadMedidaIndicador,
            valorIndicador,fechaIndicador,origenIndicador from indicadores where codigoIndicador = "UF"');
            return DataTables::of($indicadores)
                ->addColumn('action', function ($indicadores) {
                    $acciones = '<a href="javascript:void(0)" onclick="editarIndicadores(' . $indicadores->ID . ')" class="btn btn-info btn-sm">Editar<a/>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="' . $indicadores->ID . '" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('indicadores.index');
    }

    public function registrar(Request $request) //Registrar nuevo indicador
    {
        $indicadores = DB::insert(
            'insert into indicadores (nombreIndicador,codigoIndicador,
        unidadMedidaIndicador,valorIndicador, tiempoIndicador, fechaIndicador,origenIndicador) values (?,?,?,?,null,?,?)',
            [
                $request->nombreIndicador,
                $request->codigoIndicador,
                $request->unidadMedidaIndicador,
                $request->valorIndicador,
                $request->fechaIndicador,
                $request->origenIndicador
            ]
        );
        return back();
    }
    public function eliminar($id)
    {
        $indicadores = DB::delete('delete from indicadores where ID = ? ', [$id]);
        return back();
    }

    public function editar($id)
    {
        $indicadores = DB::select('select ID,nombreIndicador,codigoIndicador, unidadMedidaIndicador,
        valorIndicador,fechaIndicador,origenIndicador from indicadores where ID = ?', [$id]);
        return response()->json($indicadores);
    }

    public function actualizar(Request $request)
    {
        $indicadores = DB::update(
            'update indicadores set nombreIndicador = ?,codigoIndicador = ?,
        unidadMedidaIndicador = ?,valorIndicador = ?,fechaIndicador=?,
        origenIndicador = ? WHERE ID = ?',
            [
                $request->nombreIndicador,
                $request->codigoIndicador,
                $request->unidadMedidaIndicador,
                $request->valorIndicador,
                $request->fechaIndicador,
                $request->origenIndicador,
                $request->id
            ]
        );
        return back();
        
    }
}
