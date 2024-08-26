<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VincularVeiculos AS Veiculos;
use Illuminate\Support\Facades\Vite;
use Carbon\Carbon;

class VincularVeiculos extends Component
{
    public $placa, $grupo_cliente, $whatsapp;

    protected $rules = [
        'placa' => 'required',
        'grupo_cliente' => 'required',
        'whatsapp' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Veiculos::create([
            'placa' => $this->placa,
            'grupo_cliente' => $this->grupo_cliente,
            'whatsapp' => $this->whatsapp,
        ]);
        $this->dispatch('reloadPage');
    }

    // public function deleteVeiculo($id)
    // {
    //     $veiculo = Veiculos::find($id);
    //     if ($veiculo) {
    //         $veiculo->deleted_at = Carbon::now();
    //         $veiculo->save();
    //         $this->dispatch('reloadPage');
    //     }
    // }

    public $veiculoId;

    public function confirmDelete($id)
    {
        $this->veiculoId = $id;
        $this->dispatch('openModal');
    }

    public function deleteVeiculo()
    {
        $veiculo = Veiculos::find($this->veiculoId);
        if ($veiculo) {
            $veiculo->deleted_at = Carbon::now();
            $veiculo->save();
            $this->dispatch('reloadPage');
        }
    }

    public function cancelar() {
        $this->dispatch('reloadPage');
    }

    public function render()
    {
        $veiculos = Veiculos::whereNull('deleted_at')->get();

        // Preparar os dados dos veículos para o DataTables
        $dados = [];
        foreach ($veiculos as $veiculo) {
            $deleteUrl = Vite::asset('resources/images/lixeira.svg');
            $dados[] = [
                'id' => $veiculo->id,
                'placa' => $veiculo->placa,
                'grupo_cliente' => $veiculo->grupo_cliente,
                'whatsapp' => $veiculo->whatsapp,
                // 'acoes' => '<button class="border-zero" wire:click="deleteVeiculo(' . $veiculo->id . ')"><img class="img-fluid apagar" src="' . $deleteUrl . '" alt=""></button>'
                'acoes' => '<button class="border-zero" data-toggle="modal" data-target="#confirmModal" wire:click="confirmDelete(' . $veiculo->id . ')"><img class="img-fluid apagar" src="' . $deleteUrl . '" alt=""></button>'
            ];
        }

        // Emitir o evento com os dados dos veículos
        $this->dispatch('veiculosCarregados', json_encode($dados));

        // Retornar a view com os veículos para o Livewire
        return view('livewire.vincular-veiculos', compact('veiculos'));
    }

}
