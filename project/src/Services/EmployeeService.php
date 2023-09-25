<?php

namespace AskNicely\Services;

use AskNicely\Exceptions\FileNotFoundException;
use Error;
use Exception;
use PDO;
use PDOException;

class EmployeeService
{
  private PDO $pdo;

  private string $table = 'employees';

  public function __construct()
  {
      $this->pdo = DatabaseService::createConnection();
  }

  // Get the list of employees
  public function getList(): array
  {
      $select = "SELECT id, name, email, company_name, salary FROM $this->table ORDER BY id";
      $stmt = $this->pdo->query($select);

      $employees = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $employees[] = [
              'id' => $row['id'],
              'name' => $row['name'],
              'email' => $row['email'],
              'company_name' => $row['company_name'],
              'salary' => $row['salary'],
          ];
      }
      return $employees;
  }

  /**
   * @throws FileNotFoundException
   */
  public function parseCsv(string $filePath): array
    {
      try {

        // Open the uploaded CSV
        $handle = fopen($filePath, 'r');

        $data = [];
        $headers = fgetcsv($handle, 1000, ",");

        $keys = [];
        foreach ($headers as $header) {
          $keys[] = Helper::toSnakeCase($header);
        }

        // Loop through each line of the file
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $data[] = array_combine($keys, $row);
        }

        // Close the file
        fclose($handle);

        return $data;
      } catch (Exception $e) {
        throw new FileNotFoundException('File not found.');
      }
    }

  public function updateEmail(int $id, string $email): void
  {
      try {
          $stmt = $this->pdo->prepare("UPDATE $this->table SET email = :email WHERE id = :id");
          $stmt->execute(['email' => $email, 'id' => $id]);
      }  catch (PDOException $e) {
          throw new Error($e->getMessage());
      }
  }

  public function save(
      string $name,
      string $company,
      string $email,
      string $salary
  ): void
  {
      try {

          $stmt = $this->pdo->prepare("INSERT INTO $this->table (name, company_name, email, salary) VALUES (:name, :company_name, :email, :salary)");

          // Bind parameters
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':company_name', $company);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':salary', $salary);

          $stmt->execute();

      } catch (PDOException $e) {
          throw new Error($e->getMessage());
      }
  }
}