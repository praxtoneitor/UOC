<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ClientTest extends TestCase
{
    // Esto elimina todos los registros de la base de datos después de cada test
    // use RefreshDatabase;

    /**
     * Comprobar si un usuario puede iniciar sesión con credenciales correctas
     */
    public function test_login_con_credenciales_correctas()
    {
        // Consulta si existe un usuario con el email y contraseña especificados
        $user = $this->crearLoginSoporte();

        // Autenticar al usuario
        $this->actingAs($user);

        // Seguir la redirección a la página de inicio
        $response = $this->get('/home');

        // Comprobar si el texto esperado está presente en la página de inicio
        $response->assertSeeText('Estas logueado en el sistema como técnico de soporte');
    }

    /**
     * Crear un cliente
     */
    public function test_crear_cliente()
    {
        // Consulta si existe un usuario con el email y contraseña especificados
        $user = $this->crearLoginSoporte();

        // Autenticar al usuario
        $this->actingAs($user);

        // Ir a la página de añadir cliente
        $response = $this->get('/add_client');
        $csrfToken = csrf_token();

        $servicio = \App\Models\Servicio::first();
        $estado = \App\Models\Estado::first();

        // Rellenar campos del formulario
        $response = $this->post('/store_client', [
            '_token' => $csrfToken,
            'nombre' => 'Javier',
            'apellidos' => 'García',
            'telefono' => '123456789',
            'movil' => '987654321',
            'dni' => '12345678A',
            'email' => 'javier@test.com',
            'direccion' => 'Calle Falsa 123',
            'ciudad' => 'Springfield',
            'codigo_postal' => '12345',
            'provincia' => 'Springfield',
            'disponibilidad' => 'Tarde',
            'servicio' => ''.$servicio->nombre,
            'estado' => ''.$estado->nombre
        ]);
        
        // Comprobar registro en la base de datos y si existe, test superado
        $this->assertDatabaseHas('clientes', [
            'nombre' => 'Javier',
            'apellidos' => 'García',
            'telefono' => '123456789',
            'movil' => '987654321',
            'dni' => '12345678A',
            'email' => 'javier@test.com',
            'direccion' => 'Calle Falsa 123',
            'ciudad' => 'Springfield',
            'codigo_postal' => '12345',
            'provincia' => 'Springfield',
            'disponibilidad' => 'Tarde',
            'servicio_id' => $servicio->id,
            'estado_id' => $estado->id
        ]);

    }

    /**
     * Crear incidencia
    */
    public function test_crear_incidencia()
    {
        // Consulta si existe un usuario con el email y contraseña especificados
        $user = $this->crearLoginSoporte();

        // Autenticar al usuario
        $this->actingAs($user);

        // Buscar cliente creado anteriormente
        $cliente = \App\Models\Client::where('email', 'javier@test.com')->first();

        // Ir a la página detalle cliente
        $response = $this->get('/cliente/'.$cliente->id);

        // Crear incidencia
        $response = $this->post('/guardar_incidencia', [
            '_token' => csrf_token(),
            'via_comunicacion' => 'Teléfono',
            'tipo_incidencia' => 'sinInternet',
            'descripcion' => 'No tiene internet',
            'necesita_visita' => true,
            'fechaHoraVisita' => '2024-05-31',
            'estado' => 'abierto',
            'id_cliente' => $cliente->id
        ]);

        // Comprobar registro en la base de datos y si existe, test superado
        $this->assertDatabaseHas('incidencias', [
            'via_comunicacion' => 'Teléfono',
            'tipo_incidencia' => 'sinInternet',
            'descripcion' => 'No tiene internet',
            'necesita_visita' => true,
            'fecha_visita' => '2024-05-31',
            'estado' => 'abierto',
            'id_cliente' => $cliente->id
        ]);

        $this->eliminar();
    }

    // Eliminar registros generados por todos los test
    public function eliminar()
    {
        // Buscar cliente creado anteriormente
        $cliente = \App\Models\Client::where('email', 'javier@test.com')->first();

        // Buscar usuario con el mismo email
        $user = \App\Models\User::where('email', 'javier@test.com')->first();

        // Buscar incidencia creada anteriormente
        $incidencia = \App\Models\Incidencia::where('id_cliente', $cliente->id)->first();
        
        $incidencia->delete();
        $cliente->delete();
        $user->delete();
    }

    // Función para obtener login de soporte
    public function crearLoginSoporte()
    {
        $user = \App\Models\User::where('email', 'soporte@test.com')->first();
        if (!$user) {
            $user = \App\Models\User::factory()->create([
                'email' => 'soporte@test.com',
                'password' => Hash::make('1234'),
                'rol' => 'soporte'
            ]);
            
            $user = \App\Models\User::where('email', 'soporte@test.com')->first();
        }
        return $user;
    }
}
