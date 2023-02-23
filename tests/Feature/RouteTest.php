<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RouteTest extends TestCase
{
   
    //RUTAS tasks

/**@test */
    public function test_task()
    {
        $user = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($user)
            ->get('/tasks');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
    }

    // //tasks CREATE-> DEVUELVE LA VISTA CREATE DE TAREAS Y LAS VARIABLES User (CON TODOS LOS users) Y CLIENTS (CON TODOS LOS CLIENTS), Y NOS CARGA EL FORMULARIO PARA INSERTAR UNA tasks 
    public function test_task_create()
    {
        $user = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($user)
            ->get('/tasks/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('tasks.create');
        $response->assertViewHas('users');
        $response->assertViewHas('clients');
        $response->assertViewHas('provincias');
    }
    
    // //tasks (ID) -> DEVUELVE LA VISTA SHOW DE TAREAS Y LA VARIABLE tasks CON LA ID PASADA POR PARAMETRO DE LA BD
    // public function test_show_task()
    // {
    //     $user = User::factory()->state([
    //         'tipo' => 'admin',
    //     ])->create();

    //     $response = $this->actingAs($user)
    //         ->get('/tasks/1');
    
    //     if ($response->status() == 302) {
    //         $response = $this->followRedirects($response);
    //     }
    
    //     $response->assertViewIs('tasks.show');
    //     // $response->assertViewHas('url');
        
    // }

    // //RUTAS USER

    // //User BASE -> DEVUELVE LA VISTA INDEX DE User Y LA VARIABLE users CON TODOS LOS users (NO ELIMINADAS) DE LA BD
    public function test_user()
    {
        $user = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($user)
            ->get('/users');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');

    }

    // //User CREATE-> DEVUELVE LA VISTA CREATE DE User QUE NOS CARGA EL FORMULARIO PARA INSERTAR UN User 
    public function test_user_create()
    {
        $user = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($user)
            ->get('/users/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('users.create');
    }

    // //RUTAS CLIENTS

    // //CLIENTE BASE -> DEVUELVE LA VISTA INDEX DE CLIENTE Y LA VARIABLE CLIENTS CON TODOS LOS CLIENTS (NO ELIMINADAS) DE LA BD
    public function test_client()
    {
        $User = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($User)
            ->get('/clients');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('clients.index');
        $response->assertViewHas('clients');
    }

    
    // //CLIENTE CREATE -> DEVUELVE LA VISTA CREATE DE CLIENTE Y NOS MUESTRA EL FORMULARIO PARA INSERTAR 
    public function test_cliente_create()
    {
        $User = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($User)
            ->get('/clients/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('clients.create');
    }

    // //CLIENTE (ID) -> DEVUELVE LA VISTA SHOW Y LAS VARIABLE CLIENTE (CON EL CLIENTE SELECCIONADO MEDIANTE LA ID), 
    // //TAREAS_CLIENTE (CON TODAS LAS TAREAS RELACIONADAS AL CLIENTE) 
    // //Y CUOTAS_CLIENTE (CON TODAS LAS CUOTAS RELACIONADAS AL CLIENTE)
    // public function test_show_client()
    // {
    //     $User = User::factory()->state([
    //         'tipo' => 'admin',
    //     ])->create();

    //     $response = $this->actingAs($User)
    //         ->get('/clients/1');
    
    //     if ($response->status() == 302) {
    //         $response = $this->followRedirects($response);
    //     }
    
    //     $response->assertViewIs('clients.show');
    //     $response->assertViewHas('client');
    // }
    
    // //RUTAS CUOTAS

    // //CUOTA BASE -> DEVUELVE LA VISTA INDEX DE CUOTA Y LA VARIABLE CUOTAS CON TODAS LAS CUOTAS (NO ELIMINADAS) DE LA BD
    public function test_cuote()
    {
        $User = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($User)
            ->get('/cuotes');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('cuotes.index');
        $response->assertViewHas('cuotes');
    }
   
    // //CUOTA CREATE ->DEVUELVE LA VISTA CREATE DE CUOTA
    public function test_cuota_create()
    {
        $User = User::factory()->state([
            'tipo' => 'admin',
        ])->create();

        $response = $this->actingAs($User)
            ->get('/cuotes/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('cuotes.create');

    }

    // //CUOTA (ID) -> DEVUELVE LA VISTA SHOW DE CUOTA Y LA VARIABLE CUOTA CON LA CUOTA SELECCIONADA EN LA BD MEDIANTE LA ID
    // public function test_show_cuota()
    // {
    //     $user = User::factory()->state([
    //         'tipo' => 'admin',
    //     ])->create();

    //     $response = $this->actingAs($user)
    //         ->get('/cuotes/1');
    
    //     if ($response->status() == 302) {
    //         $response = $this->followRedirects($response);
    //     }
    
    //     $response->assertViewIs('cuotes.show');
    //     // $response->assertViewHas('cuotes');
    // }

    /**tareas del empleado segun login */
    public function test_taskOper()
    {
        $user = User::factory()->state([
            'tipo' => 'operario',
        ])->create();

        $response = $this->actingAs($user)
            ->get('/tasksOper');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('tasksOper.index');
        $response->assertViewHas('tasksOper');
    }

    /**tareas pendientes de completar del empleado que haga login */
    // public function test_taskOper_pendientes()
    // {
    //     $user = User::factory()->state([
    //         'tipo' => 'operario',
    //     ])->create();

    //     $response = $this->actingAs($user)
    //         ->get('/tasksOper/pendientes');
    
    //     if ($response->status() == 302) {
    //         $response = $this->followRedirects($response);
    //     }
    
    //     $response->assertViewIs('tasksOper.pendientes');
    //     $response->assertViewHas('tasksOper');
    // }
    // //CLIENTE REGISTRA TAREA -> DEVUELVE LA VISTA PARA REGISTRAR UNA TAREA POR CLIENTE Y NOS MUESTRA UN FORMULARIO PARA INSERTAR
    //soycliente
    public function test_soycliente()
    {
        $response = $this->get('/soycliente');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('soycliente.index');
        $response->assertViewHas('provincias');
        $response->assertViewHas('clients');
    }
}