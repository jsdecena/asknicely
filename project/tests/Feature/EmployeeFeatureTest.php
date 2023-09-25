<?php declare(strict_types=1);

namespace Feature;

use AskNicely\Services\DatabaseService;
use AskNicely\Services\EmployeeService;
use PDO;
use PHPUnit\Framework\TestCase;

final class EmployeeFeatureTest extends TestCase
{
  // protected EmployeeService $employeeService;

  protected function setUp(): void
  {
    parent::setUp();

    // Run your custom setup script or SQL commands
    $this->initDatabase();
  }

  protected function initDatabase()
  {
    $pdo = DatabaseService::createConnection();

    $sql = file_get_contents(__DIR__ . '/migration/employees.sql');
    $pdo->exec($sql);
  }

  public function test_it_can_save_and_return_data_from_database(): void
  {
    $employeeService = new EmployeeService();
    $employeeService->save('John Doe', 'John Doe Company', 'john@doe.com', '123223');

    $list = $employeeService->getList();

    foreach ($list as $user) {
      $this->assertEquals('John Doe', $user['name']);
      $this->assertEquals('John Doe Company', $user['company_name']);
      $this->assertEquals('john@doe.com', $user['email']);
      $this->assertEquals('123223', $user['salary']);
    }
  }

  public function test_it_can_edit_email_of_the_employee(): void
  {
    $employeeService = new EmployeeService();
    $employeeService->save('John Doe', 'John Doe Company', 'john@doe.com', '123223');

    $list = $employeeService->getList();

    $id = $list[0]['id'];
    $employeeService->updateEmail($id, 'changed@email.com');

    // Get new list
    $list = $employeeService->getList();

    $this->assertEquals('changed@email.com', $list[0]['email']);
  }
}
