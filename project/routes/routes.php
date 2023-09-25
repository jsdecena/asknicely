<?php

require_once 'helper.php';

use AskNicely\Services\EmployeeService;
use Pecee\SimpleRouter\SimpleRouter;
use Rakit\Validation\Validator;

SimpleRouter::get('/', function() {
    $employeeService = new EmployeeService();
    $list = $employeeService->getList();

    return json_encode([
        'data' => $list
    ]);
});

SimpleRouter::post('/import', function() {

    $validator = new Validator;

    // Validate the data
    $validation = $validator->validate($_POST + $_FILES, [
        'csv' => 'required|uploaded_file:0,500K,csv',
    ]);

    if($validation->fails()) {
        return json_encode([
            'errors' => $validation->errors()->all()
        ]);
    }

    $filePath = $validation->getValidatedData()['csv']['tmp_name'];

    $employeeService = new EmployeeService();
    $list = $employeeService->parseCsv($filePath);

    // Save to database
    foreach ($list as $item) {
        $employeeService->save(
            $item['employee_name'],
            $item['company_name'],
            $item['email_address'],
            $item['salary'],
        );
    }

    return json_encode([
        'data' => $employeeService->getList()
    ]);

    // Return the response
});

SimpleRouter::put('/employees/{id}', function($employeeId) {

    $rawData = file_get_contents("php://input");
    $validator = new Validator;

    // Validate the data
    $validation = $validator->validate(json_decode($rawData, true), [
        'email' => 'required|email',
    ]);

    if($validation->fails()) {
        return json_encode([
            'errors' => $validation->errors()->all()
        ]);
    }

    $employeeService = new EmployeeService();
    $employeeService->updateEmail(
        $employeeId,
        $validation->getValidatedData()['email']
    );

    return json_encode([
        'data' => $employeeService->getList()
    ]);
});