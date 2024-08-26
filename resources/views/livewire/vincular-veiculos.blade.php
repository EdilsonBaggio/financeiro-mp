<div>
    <div class="row content-tabelas">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                  Vincular veículos
                </div>
                <div class="card-body">
                  <div class="content-table-menus">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <span>Placa</span>
                            <input type="text" class="form-control placa" id="placa" placeholder="Placa" wire:model="placa" required>
                            @error('placa') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <span>Grupo de Cliente</span>
                            <input type="text" class="form-control" id="cliente" placeholder="Grupo de Cliente" wire:model="grupo_cliente" required>
                            @error('grupo_cliente') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <span>Celular com Whatsapp</span>
                            <input type="text" class="form-control celular" id="celular" placeholder="Celular com Whatsapp" wire:model="whatsapp" required>
                            @error('whatsapp') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn button-adicionar table-responsive-sm">Adicionar</button>
                    </form>                              
                  </div>
                  <div class="content-table">
                      <table id="tabela-veiculos" class="display mt-4" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="td_placa">Placa</th>
                                <th class="td_grupo_cliente">Grupo de Cliente</th>
                                <th class="td_celular">Celular com Whatsapp</th>
                                <th class="td_acao">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>          
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Confirmação de Exclusão</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Tem certeza de que deseja excluir este veículo?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="cancelar">Cancelar</button>
            <button type="button" class="btn btn-primary" wire:click="deleteVeiculo">Excluir</button>
            </div>
        </div>
        </div>
    </div>

    @push('script')

        <!-- JS do Bootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- JS do DataTables -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

        <!-- JS do DataTables para Bootstrap -->
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

        <!-- JS do DataTables Responsive -->
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

        <!-- Alpine.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            document.addEventListener('livewire:init', () => {
                var tabela = $('#tabela-veiculos').DataTable({
                    "lengthChange": false,
                    "dom": 'lrtip',
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nada encontrado - desculpe",
                        "info": "Mostrando página _PAGE_ de _PAGES_",
                        "infoEmpty": "Nenhum registro disponível",
                        "infoFiltered": "(filtrado de _MAX_ registros no total)",
                        "responsive": true,
                        "sSearch": "Pesquisar:",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "sProcessing": "Processando...",
                        "sLoadingRecords": "Carregando...",
                        "sZeroRecords": "Nenhum registro encontrado"
                    },
                    "columnDefs": [
                        {
                            "targets": "td_placa",
                            "data": "placa"
                        },
                        {
                            "targets": "td_grupo_cliente",
                            "data": "grupo_cliente"
                        },
                        {
                            "targets": "td_celular",
                            "data": "whatsapp"
                        },
                        {
                            "targets": "td_acao",
                            "className": "td-acao",
                            "data": "acoes",
                            "render": function (data, type, row, meta) {
                                return data;
                            },
                            "width": 150,
                            "orderable": false
                        }
                    ],
                    "pageLength": 5
                });
        
                Livewire.on('veiculosCarregados', (veiculos) => {
                    try {
                        const dados = JSON.parse(veiculos);
                        tabela.clear().rows.add(dados).draw();
        
                        // Aplicar máscara de celular após renderização
                        $(".celular").mask('(00) 00000-0000');
                    } catch (error) {
                        console.error('Erro ao processar veículos:', error);
                    }
                });

                Livewire.on('reloadPage', function () {
                    location.reload();
                });
                $(".celular").mask('(00) 00000-0000');

                var MercoSulMaskBehavior = function (val) {
                    var myMask = 'SSS-0A00';
                    var mercosul = /([A-Za-z]{3}[0-9]{1}[A-Za-z]{1})/;
                    var normal = /([A-Za-z]{3}[0-9]{2})/;
                    var replaced = val.replace(/[^\\w]/g, '');
                    if (normal.exec(replaced)) {
                        myMask = 'SSS-0000';
                    } else if (mercosul.exec(replaced)) {
                        myMask = 'SSS-0A00';
                    }
                    return myMask;
                }, mercoSulOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(MercoSulMaskBehavior.apply({}, arguments), options);
                    }
                };

                $("body").delegate('.placa','input', function(e) {
                    $('input.placa').mask(MercoSulMaskBehavior, mercoSulOptions);
                });
            });

            window.addEventListener('openModal', event => {
                $('#confirmModal').modal('show');
            })
        </script>
        
    @endpush
</div>
