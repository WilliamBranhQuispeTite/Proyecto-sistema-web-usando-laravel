<?php

namespace App\Http\Requests;

use App\Administrador;
use App\Detalle;
use App\Pedido;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente' => 'required',
            'direccion' => 'required',
            'entrada' => 'required',
            "detalle"    => [
                'required',
                'array', //input must be an array
                'min:1' //there must be three members in the array
            ],
            "referencia" => 'nullable'


        ];
    }
    public function messages()
    {
        return [
            'cliente.required' => 'Verifique que el cliente exista',
            'direccion.required' => 'La direccoin es obligatoria',
            'entrada.required' => 'Verifique la via de entrda',
        ];
    }
    public function crearPed()
    {

        //return $data['detalle'];

        DB::transaction(function () {

            $data = $this->validated();
            $user = Auth::user();

            $adm = Administrador::select('administradors.*')
                ->join('usuarios', 'usuarios.id', '=', 'administradors.usu_id')
                ->where('usuarios.id', $user->id)
                ->get()
                ->first();

            $ped = Pedido::create([
                'ped_entrada' => $data['entrada'],
                'ped_direccion' => $data['direccion'],
                'ped_referencia' => $data['referencia'],
                'cli_id' => $data['cliente'],
                'adm_id' => $adm->adm_id,
            ]);

          
            foreach ($data['detalle'] as $pro) {
                Detalle::create([
                    'det_precio' => $pro['precio'],
                    'det_total' => $pro['total'],
                    'det_cantidad' => $pro['cantida'],
                    'pro_id' => $pro['pro'],
                    'ped_id' => $ped->id,
                ]);
            }
            DB::commit();
        });
    }
}
