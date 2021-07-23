<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_admin_can_access_company_index()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/admin/companies');
        $response->assertOk();
    }

    /** @test*/

    public function test_company_index_when_accessed_should_return_company_index()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('admin/companies');
        $response->assertViewIs('company.index');
    }

    /** @test */
    public function company_index_view_should_have_variable_companies()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('admin/companies');
        $response->assertViewHas('companies');
    }

    /** @test */
    public function admin_can_create_a_company()
    {
         $this->withoutExceptionHandling();
        $response = $this->post('admin/companies', Company::factory()->make()->toArray());
        $this->assertCount(1, Company::all());
        $response->assertSessionHas('message');
    }


    /** @test */
    public function admin_can_update_a_comapny()
    {
        $this->withoutExceptionHandling();
        $country = Company::factory()->create();
        $data = Company::factory()->make()->toArray();
        $this->patch("admin/company/" . $country->id, $data);
        $this->assertDatabaseHas("companies", ["name" => $data["name"]]);
    }

    /** @test */
    public function admin_can_delete_company()
    {
        $this->withoutExceptionHandling();
        $response = $this->delete("admin/companies/" . Company::factory()->create()->id);
        $this->assertDatabaseCount("companies", 0);
    }




}
