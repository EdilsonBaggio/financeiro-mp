<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ConfigurarAlertas AS Alertas;
use Illuminate\Support\Facades\Vite;
use Carbon\Carbon;

class ConfigurarAlertas extends Component
{
    public $placa, $tempo, $ativo, $alertaId, $deleteAlertaId;

    protected $rules = [
        'placa' => 'required',
        'tempo' => 'required',
        'ativo' => 'required|boolean'
    ];

    public function save()
    {
        $this->validate();

        if (is_null($this->ativo)) {
            $this->ativo = true;
        }

        if ($this->alertaId) {
            $alerta = Alertas::find($this->alertaId);
            if ($alerta) {
                $alerta->update([
                    'placa' => $this->placa,
                    'tempo' => $this->tempo,
                    'ativo' => $this->ativo,
                ]);
            }
        } else {
            Alertas::create([
                'placa' => $this->placa,
                'tempo' => $this->tempo,
                'ativo' => $this->ativo,
            ]);
        }

        $this->reset(['placa', 'tempo', 'ativo', 'alertaId']);
        $this->dispatch('reloadPage');
    }

    // public function deleteAlerta($id)
    // {
    //     $alerta = Alertas::find($id);
    //     if ($alerta) {
    //         $alerta->deleted_at = Carbon::now();
    //         $alerta->save();
    //         $this->dispatch('reloadPage');
    //     }
    // }

    public function confirmDelete($id)
    {
        $this->deleteAlertaId = $id;
        $this->dispatch('openModal');
    }

    public function deleteVeiculo()
    {
        $alerta = Alertas::find($this->deleteAlertaId);
        if ($alerta) {
            $alerta->deleted_at = Carbon::now();
            $alerta->save();
            $this->dispatch('reloadPage');
        }
    }

    public function cancelar() {
        $this->dispatch('reloadPage');
    }

    public function editarAlerta($id)
    {
        $this->dispatch('editar');

        $alerta = Alertas::find($id);
        if ($alerta) {
            $this->alertaId = $alerta->id;
            $this->placa = $alerta->placa;
            $this->tempo = $alerta->tempo;
            $this->ativo = $alerta->ativo;
        }
    }

    public function render()
    {
        if (is_null($this->ativo)) {
            $this->ativo = true;
        }

        $alertas = Alertas::whereNull('deleted_at')->get();

        $dados = [];
        foreach ($alertas as $alerta) {
            $deleteUrl = Vite::asset('resources/images/lixeira.svg');
            $editarUrl = Vite::asset('resources/images/edit.svg');
            $dados[] = [
                'id' => $alerta->id,
                'placa' => $alerta->placa,
                'tempo' => $alerta->tempo,
                'ativo' => $alerta->ativo,
                // 'acoes' => '<button class="border-zero" wire:click="deleteAlerta(' . $alerta->id . ')"><img class="img-fluid apagar" src="' . $deleteUrl . '" alt=""></button><button class="border-zero editar" wire:click="editarAlerta(' . $alerta->id . ')"><img class="img-fluid apagar" src="' . $editarUrl . '" alt=""></button>'
                'acoes' => '<button class="border-zero" data-toggle="modal" data-target="#confirmModal" wire:click="confirmDelete(' . $alerta->id . ')"><img class="img-fluid apagar" src="' . $deleteUrl . '" alt=""></button><button class="border-zero editar" wire:click="editarAlerta(' . $alerta->id . ')"><img class="img-fluid apagar" src="' . $editarUrl . '" alt=""></button>'
            ];
        }

        $this->dispatch('alertasCarregados', json_encode($dados));
        return view('livewire.configurar-alertas', compact('alertas'));
    }
}
