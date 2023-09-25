<?php declare(strict_types=1);

namespace Unit;

use AskNicely\Exceptions\FileNotFoundException;
use AskNicely\Services\EmployeeService;
use PHPUnit\Framework\TestCase;

final class EmployeeTest extends TestCase
{
  public function test_it_can_parse_csv(): void
  {
    $service = new EmployeeService();
    $data = $service->parseCsv(__DIR__ . '/fixtures/valid.csv');

    $this->assertIsArray($data);
    $this->assertCount(2, $data);
    $this->assertEquals([
      'company_name' => 'ACME Corporation',
      'employee_name' => 'John Doe',
      'email_address' => 'johndoe@acme.com',
      'salary' => '50000'], $data[0]);
  }

  public function test_it_should_throw_error_when_csv_is_missing(): void
  {
    $this->expectException(FileNotFoundException::class);
    $this->expectExceptionMessage('File not found.');

    $service = new EmployeeService();
    $service->parseCsv(__DIR__ . '/fixtures/notValid.csv');
  }
}
