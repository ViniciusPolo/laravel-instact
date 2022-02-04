<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class PostTest extends TestCase
{
    use DatabaseTransactions; //assim que o teste acaber ele já faz o rollback
    use WithFaker; 
    /**
     * A basic feature test example.
     *
     * @return void  //void é para saber que não retorna nada
     */
    public function testOpenIndexAndSeeInstact()
    {
        $response = $this->get('/');

        //$response->assertStatus(200);
        //$response->dd();  //testar debugando
        $response->assertSee('Instact');
    }

    /**
     * 
     */
    public function testIndexAndDontSeeDashboard(){
        $response = $this->get('/');

        $response->assertDontSee('Dashboard');

    }
    /**
     * Tentar acessar a rota dashboard sem autenticação e não retornar
     * @return void
     */
    public function testOpenDashboardShouldNotWithoutAuth(){
        $response = $this->get('/dashboard');

        //$response->assertStatus(403);
        $response->assertRedirect('/');
    }
    /**
     * Tentar acessar a rota dashboard sem autenticação e não retornar
     * @return void
     */
    public function testOpenDashboardShouldWithoutAuth(){
       $user = User::factory()->create();
       $this->actingAs($user);

       $response = $this->get('/dashboard');
       $response->assertOk();
       $response->assertSee('Dashboard');
    }

    /**
     * Acessar rota /posts/store e criar um novo post
     * @return void
     */
    public function testShouldStorePost(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $input = [
            'description' => $this->faker->sentence(4),
            'photo' => UploadedFile::fake()->image('img.png') //usar o illuminate
        ];

        $response = $this->post('/posts/store', $input);
        //$response->ddSession();

        $this->assertDatabaseHas('posts',[
            'description' => $input['description'],
            'user_id' => $user->id]);
        
     }

}
