<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\DepartmentRepository;
use App\Models\Department;

class DepartmentTest extends TestCase
{
	use WithFaker;
	private $departmentRepo;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function model()
    {
    	$departmentRepo = new DepartmentRepository(new Department);
    	return $departmentRepo;
    }

    public function getFakeData()
    {
		$data = [
    		'name' => $this->faker->word,
    		'description' => $this->faker->text
    	];

    	return $data;
    }

    public function testCreateDepartment()
    {
    	$data = $this->getFakeData();
    	$department = $this->model()->create($data);

    	$this->assertEquals($department->name, $data['name']);
    	$this->assertEquals($department->description, $data['description']);
    }

    public function testUpdateDepartment()
    {
    	$model = $this->model();

    	$data = $this->getFakeData();
    	$department = $model->create($data);    	

    	$new_data = $this->getFakeData();
    	$new_department = $model->update($new_data, $department->id);

    	$this->assertTrue($new_department);
    }

    public function testShowDepartment()
    {
    	$model = $this->model();
    	
    	$data = $this->getFakeData();
    	$department = $model->create($data);     	

    	$result = $model->find($department->id);

    	$this->assertEquals($result->name, $data['name']);
    	$this->assertEquals($result->description, $data['description']);    
    }

    public function testDeleteDepartment()
    {
    	$model = $this->model();
    	
    	$data = $this->getFakeData();

    	$department = $model->create($data);
    	$id = $department->id;
    	
    	$result = $model->delete($department->id);
    	
    	$this->assertTrue($result);
    }
}
