<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}


namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Empleado;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     //RUTA RAIZ
    public function test_home()
    {
        $response = $this->get('/');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('auth.login');        
    }
    //RUTA LOGIN
    public function test_login()
    {
        $response = $this->get('/login');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('auth.login');
    }


    //RUTAS TAREA

    //TAREA BASE -> DEVUELVE LA VISTA INDEX DE TAREAS Y LA VARIABLE TAREAS CON TODAS LAS TAREAS (NO ELIMINADAS) DE LA BD
    public function test_tarea()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/tarea');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Tarea.index');
        $response->assertViewHas('tareas');
    }

    //TAREA PENDIENTES -> DEVUELVE LA VISTA INDEX DE TAREAS Y LA VARIABLE TAREAS CON TODAS LAS TAREAS (NO ELIMINADAS) CON EL ESTADO PENDIENTE
    public function test_tarea_pendiente()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/pendiente');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Tarea.index');
        $response->assertViewHas('tareas');

    }
    //TAREA ELIMINADA -> DEVUELVE LA VISTA ELIMINADAS DE TAREAS Y LA VARIABLE TAREAS CON TODAS LAS TAREAS ELIMINADAS EN LA BD
    public function test_tarea_eliminada()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/eliminada');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Tarea.eliminada');
        $response->assertViewHas('tareas');
    }
    //TAREA CREATE-> DEVUELVE LA VISTA CREATE DE TAREAS Y LAS VARIABLES EMPLEADO (CON TODOS LOS EMPLEADOS) Y CLIENTES (CON TODOS LOS CLIENTES), Y NOS CARGA EL FORMULARIO PARA INSERTAR UNA TAREA 
    public function test_tarea_create()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/tarea/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Tarea.create');
        $response->assertViewHas('empleados');
        $response->assertViewHas('clientes');
    }
    //TAREA (ID) -> DEVUELVE LA VISTA SHOW DE TAREAS Y LA VARIABLE TAREA CON LA ID PASADA POR PARAMETRO DE LA BD
    public function test_tarea_id()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/tarea/1');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Tarea.show');
        $response->assertViewHas('tareas');
        
    }

    //RUTAS EMPLEADO

    //EMPLEADO BASE -> DEVUELVE LA VISTA INDEX DE EMPLEADO Y LA VARIABLE EMPLEADOS CON TODOS LOS EMPLEADOS (NO ELIMINADAS) DE LA BD
    public function test_empleado()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/empleado');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Empleado.index');
        $response->assertViewHas('empleados');

    }
    //EMPLEADO ELIMINADO -> DEVUELVE LA VISTA ELIMINADA DE EMPLEADO Y LA VARIABLE EMPLEADOS CON TODOS LOS EMPLEADOS ELIMINADOS DE LA BD
    public function test_empleado_eliminado()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/empleados/eliminado');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Empleado.eliminada');
        $response->assertViewHas('empleados');
    }
    //EMPLEADO CREATE-> DEVUELVE LA VISTA CREATE DE EMPLEADO QUE NOS CARGA EL FORMULARIO PARA INSERTAR UN EMPLEADO 
    public function test_empleado_create()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/empleado/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Empleado.create');
    }
    //EMPLEADO (ID) -> DEVUELVE LA VISTA SHOW DE EMPLEADO, LA VARIABLE EMPLEADO CON LA ID PASADA POR PARAMETRO DE LA BD 
    //JUNTO CON LA VARIABLE TAREAS_EMPLEADO CON LAS TAREAS ASOCIADAS A ESE EMPLEADO
    public function test_empleado_id()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/empleado/1');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Empleado.show');
        $response->assertViewHas('empleado');
        $response->assertViewHas('tareas_empleado');
    }

    //RUTAS CLIENTES

    //CLIENTE BASE -> DEVUELVE LA VISTA INDEX DE CLIENTE Y LA VARIABLE CLIENTES CON TODOS LOS CLIENTES (NO ELIMINADAS) DE LA BD
    public function test_cliente()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/cliente');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cliente.index');
        $response->assertViewHas('clientes');
    }
    //CLIENTE ELIMINADO -> DEVUELVE LA VISTA ELIMINADA DE CLIENTE Y LA VARIABLE CLIENTES CON TODOS LOS CLIENTES ELIMINADOS EN LA BD
    public function test_cliente_eliminado()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('clientes/eliminado');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cliente.eliminada');
        $response->assertViewHas('clientes');
    }
    //CLIENTE CREATE -> DEVUELVE LA VISTA CREATE DE CLIENTE Y NOS MUESTRA EL FORMULARIO PARA INSERTAR 
    public function test_cliente_create()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/cliente/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cliente.create');
    }
    //CLIENTE (ID) -> DEVUELVE LA VISTA SHOW Y LAS VARIABLE CLIENTE (CON EL CLIENTE SELECCIONADO MEDIANTE LA ID), 
    //TAREAS_CLIENTE (CON TODAS LAS TAREAS RELACIONADAS AL CLIENTE) 
    //Y CUOTAS_CLIENTE (CON TODAS LAS CUOTAS RELACIONADAS AL CLIENTE)
    public function test_cliente_id()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/cliente/1');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cliente.show');
        $response->assertViewHas('cliente');
        $response->assertViewHas('tareas_cliente');
        $response->assertViewHas('cuotas_cliente');
    }
    
    //RUTAS CUOTAS

    //CUOTA BASE -> DEVUELVE LA VISTA INDEX DE CUOTA Y LA VARIABLE CUOTAS CON TODAS LAS CUOTAS (NO ELIMINADAS) DE LA BD
    public function test_cuota()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/cuota');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cuota.index');
        $response->assertViewHas('cuotas');
    }
    //CUOTA ELIMINADA -> DEVUELVE LA VISTA ELIMINADA DE CUOTA Y LA VARIABLE CUOTAS CON TODAS LAS CUOTAS ELIMINADA EN LA BD
    public function test_cuota_eliminado()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('cuotas/eliminado');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cuota.eliminada');
        $response->assertViewHas('cuotas');
    }
    //CUOTA CREATE ->DEVUELVE LA VISTA CREATE DE CUOTA Y NO CARGA EL FORMULARIO PARA INSERTAR
    public function test_cuota_create()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/cuota/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cuota.create');

    }
    //CUOTA (ID) -> DEVUELVE LA VISTA SHOW DE CUOTA Y LA VARIABLE CUOTA CON LA CUOTA SELECCIONADA EN LA BD MEDIANTE LA ID
    public function test_cuota_id()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('/cuota/1');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cuota.show');
        $response->assertViewHas('cuota');
    }
    //CUOTA REMESA MENSUAL -> DEVUELVE LA VISTA MONTHLY_CREATE DE CUOTA Y NOS MUESTRA EL FORMULARIO PARA INSERTAR
    public function test_cuota_remesa_mensual()
    {
        $empleado = Empleado::factory()->state([
            'tipo' => 'Administrador',
        ])->create();

        $response = $this->actingAs($empleado)
            ->get('cuotas/monthly_create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cuota.monthly_create');
    }
    //CLIENTE REGISTRA TAREA -> DEVUELVE LA VISTA REGISTRATAREA DE CLIENTE Y NOS MUESTRA UN FORMULARIO PARA INSERTAR
    public function test_registrarTarea_cliente()
    {

        $response = $this->get('/registrarTarea/create');
    
        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }
    
        $response->assertViewIs('Cliente.registrarTarea');
    }

}