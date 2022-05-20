<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>Usuarios</b> | {{$selected_id > 0 ? 'Editar' : 'Crear'}}
                </h5>
                <h6 class="text-center text-warning" wire:loading>Por Favor Espere</h6>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-6 mt-3">
                        <p><b>Nombre</b></p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp fondoNegro text-white">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" wire:model.lazy="name" class="form-control"
                                placeholder="Ingrese Nombre del usuario">
                        </div>
                        @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-12 col-md-6 mt-3">
                        <p><b>Correo</b></p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp fondoNegro text-white">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" wire:model.lazy="email" class="form-control"
                                placeholder="Ingrese correo del usuario">
                        </div>
                        @error('email') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-12 col-md-6 mt-3">
                        <p><b>Contraseña</b></p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp fondoNegro text-white">
                                    <i class="fas fa-unlock-alt"></i>
                                </span>
                            </div>
                            <input type="password" wire:model.lazy="password" class="form-control">
                        </div>
                        @error('password') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-danger close-btn text-white"
                    data-dismiss="modal"><b>Cerrar</b></button>
                @if($selected_id < 1) <button type="button" wire:click.prevent="Store()"
                    class="btn btn-dark close-modal text-white"><b>Guardar</b></button>
                    @else
                    <button type="button" wire:click.prevent="Update()"
                        class="btn btn-dark close-modal text-white"><b>Actualizar</b></button>
                    @endif
            </div>
        </div>
    </div>
</div>
