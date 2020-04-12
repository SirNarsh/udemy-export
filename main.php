<?php

echo "Udemy export script is starting up" . PHP_EOL;

include "./vendor/autoload.php";
include "./psr4-autoload.php";

$token = $argv[1];

echo "Read token: '{$token}'" . PHP_EOL;
echo "All udemy requests will use header 'x-udemy-authorization: Bearer {$token}'" . PHP_EOL;

echo "Step 1: Get all courses" . PHP_EOL;
$udemyService = new \App\Services\UdemyService($token);
$udemyResponseDto = $udemyService->getAllCourses();

echo "Step 2: Write to excel file" . PHP_EOL;
$excel = new \App\Services\ExcelService();
foreach($udemyResponseDto->coursesDto as $course) {
    $excel->addCourse($course);
}

$fileName = __DIR__ . 'output/output_' . time() . '.xlsx';
echo "Step 3: Write excel file: {$fileName}";
$excel->save(__DIR__ . '/output/output_' . time() . '.xlsx');

echo "===================" .PHP_EOL;
echo "FINISHED, Study well!";