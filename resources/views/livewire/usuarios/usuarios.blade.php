<div>
    <div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h4 class="card-title">
                        <b>USUARIOS | LISTADO</b>
                    </h4>
                    <ul class="tabs tab-pills">
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                                data-target="#theModal">Agregar</a>
                        </li>
                    </ul>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp" style="background: #060609">
                                    <i class="fas fa-search text-white"></i>
                                </span>
                            </div>
                            <input id="buscarProducto" type="text" wire:model="buscar" placeholder="Buscar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="table-th text-white">ID</th>
                                    <th class="table-th text-white">NOMBRE</th>
                                    <th class="table-th text-white">CORREO</th>
                                    <th class="table-th text-white">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $r)
                                <tr>
                                    <td>
                                        <h6 class="text-center">{{$r->id}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{$r->name}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">{{$r->email}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-dark text-white mtmobile btn-sm"
                                            wire:click="Edit({{$r->id}})" title="Edit">
                                            Editar
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                            onclick="Confirm('{{$r->id}}')" title="Delete">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.usuarios.form')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('user-add', msg => {
                $('#theModal').modal('hide');
                swal({
                    title: 'Exito',
                    text: msg,
                    type: 'success',
                })

            });

            window.livewire.on('user-update', msg => {
                $('#theModal').modal('hide');
            });

            window.livewire.on('show-modal', msg => {
                $('#theModal').modal('show');
            });
        });

        function Confirm(id) {
            swal({
                title: 'Confirmar',
                text: '¿Confirmas eliminar el rubro?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'

            }).then(function (result) {
                if (result.value) {
                    window.livewire.emit('deleteRows', id)
                    swal("usuario Eliminado!", "usuario Eliminado Exitosamente", "success");
                }
            })
        }


    </script>
</div>
