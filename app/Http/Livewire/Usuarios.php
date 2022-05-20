<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
use App\Models\User;

class Usuarios extends Component
{
    use withPagination;

    public $selected_id, $name, $email, $buscar, $password; 
    private $pagination = 10;

    //Montado del componente aqui se definen los valores iniciales de las variables
    //al momento de que se renderee
    public function mount(){
       
    }

    //Paginacion css Boosttrap
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->buscar) > 0)
            $data = User::where('name', 'like', '%'.$this->buscar.'%')
        ->select('*')->orderBy('id','desc')->paginate($this->pagination);
        else 
            $data = User::select('*')->orderBy('id','desc')->paginate($this->pagination);


        return view('livewire.usuarios.usuarios',[
            'data'=> $data,
        ])->extends('layouts.theme.app')->section('content');
    }

    public function Store(){
        $rules=[
       'name'=>'required|min:3',
       'email' => 'required|email|unique:users',
       'password'=>'required|min:3',
     

   ];

   $messages =[
       'name.required' =>'El nombre es requerido',
       'name.min'=>'El nombre debe tener al menos tres caracteres',
       'email.required'=>'El Correo es requerido',
       'email.email'=>'Ingresa un correo Valido',
       'email.unique'=>'El Correo ya esta asociado a otra cuenta',
       'password.required' =>'La contraseña es requerida',
       'password.min'=>'La contraseña debe tener al menos 3 caracteres',
   ];

   $this->validate($rules, $messages);

   $user = User::create([
       'name' => $this->name,
       'email' => $this->email,
       'password' => bcrypt($this->password),
   ]);

   $this->resetUI();
   $this->emit('user-add','Usuario Creado con exito');
}

    public function resetUI(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->selected_id = 0;
        $this->buscar='';
        $this->resetValidation();
        $this->resetPage();

    }

    public function Edit(User $user){
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';

        $this->emit('show-modal', 'show modal!'); 
    }

    public function Update(){
        $rules=[
        'email' => "required|email|unique:users,email,{$this->selected_id}",
        'name'=>'required|min:3',
        'password'=>'required|min:3',
    ];

    $messages =[
        'name.required' =>'El nombre es requerido',
        'name.min'=>'El nombre debe tener al menos tres caracteres',
        'email.required'=>'El Correo es requerido',
        'email.email'=>'Ingresa un correo Valido',
        'email.unique'=>'El Correo ya esta asociado a otra cuenta',
        'password.required' =>'La contraseña es requerida',
        'password.min'=>'La contraseña debe tener al menos 3 caracteres',
    ];

    $this->validate($rules, $messages);

    $user = User::find($this->selected_id);
    $user->update([
        'name' => $this->name,
        'email' => $this->email,
        'password' => bcrypt($this->password),
    ]);

    $this->resetUI();
    $this->emit('user-update','Usuario editado con exito');

}

public function Destroy(User $user){
    $user->delete();
    $this->resetUI();
    $this->emit('user-deleted','Usuario eliminado con exito');
}

public $listeners =[
    'deleteRows' => 'Destroy',
    'resetUI' => 'resetUI'
];

}
