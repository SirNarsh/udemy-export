<?php

echo "Udemy export script is starting up" . PHP_EOL;

include "./vendor/autoload.php";
include "./psr4-autoload.php";

$token = $argv[1];
$fileName = isset($argv[2]) ? $argv[2] : 'courses-list_' . time() . '.xlsx';


echo "Read token: '{$token}'" . PHP_EOL;

if (strlen($token) < 3) {
    echo "Token should be passed as argument to main.php" . PHP_EOL;
    exit(1);
}

echo "All udemy requests will use header 'x-udemy-authorization: Bearer {$token}'" . PHP_EOL;

echo "Step 1: Get all courses" . PHP_EOL;
$udemyService = new \App\Services\UdemyService($token);
$udemyResponseDto = $udemyService->getAllCourses();

if ($udemyResponseDto->lastResponseFailed) {
    echo "===================" . PHP_EOL;
    echo "Failed, check errors above!" . PHP_EOL;
    exit(1);
}

echo "Step 2: Prepare excel file" . PHP_EOL;
$excel = new \App\Services\ExcelService();
foreach($udemyResponseDto->coursesDto as $course) {
    $excel->addCourse($course);
}

$fullPath = '/out/' . $fileName;
echo "Step 3: Write excel file: {$fullPath}" . PHP_EOL;
$excel->save($fullPath);

echo "===================" . PHP_EOL;
echo "FINISHED, Study well!" . PHP_EOL;
