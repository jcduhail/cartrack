<?php

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use App\Services\UsersService;


class UsersServiceTest extends \PHPUnit_Framework_TestCase
{

    private $userService;

    public function setUp()
    {
        $app = new Application();
        $app->register(new DoctrineServiceProvider(), array(
            "db.options" => array(
                "driver" => "pdo_sqlite",
                "memory" => true
            ),
        ));
        $this->userService = new UsersService($app["db"]);

        $stmt = $app["db"]->prepare("CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT,user VARCHAR NOT NULL)");
        $stmt->execute();

        $stmt = $app["db"]->prepare("INSERT INTO users (user) VALUES ('dummyuser')");
        $stmt->execute();
    }

    public function testGetOne()
    {
        $data = $this->userService->getOne(1);
        $this->assertEquals('dummyuser', $data['user']);
    }

    public function testGetAll()
    {
        $data = $this->userService->getAll();
        $this->assertNotNull($data);
    }

    function testSave()
    {
        $user = array("user" => "arny");
        $data = $this->userService->save($user);
        $data = $this->userService->getAll();
        $this->assertEquals(2, count($data));
    }

    function testUpdate()
    {
        $user = array("user" => "arny1");
        $this->userService->save($user);
        $user = array("user" => "arny2");
        $this->userService->update(1, $user);
        $data = $this->userService->getAll();
        $this->assertEquals("arny2", $data[0]["user"]);

    }

    function testDelete()
    {
        $user = array("user" => "arny1");
        $this->userService->save($user);
        $this->userService->delete(1);
        $data = $this->userService->getAll();
        $this->assertEquals(1, count($data));
    }

}
