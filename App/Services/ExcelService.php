<?php
namespace App\Services;


use App\Dto\CourseDto;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelService
{
    /**
     * @var Spreadsheet
     */
    private $spreadsheet;

    /**
     * @var Worksheet
     */
    private $sheet;

    /**
     * @var int
     */
    private $row = 1;

    /**
     * ExcelService constructor.
     * Prepare excel instance and print first header row
     * @throws Exception
     */
    public function __construct()
    {
        $this->spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $this->sheet = $this->spreadsheet->getActiveSheet();
        $this->sheet->setCellValue('A1', 'Id');
        $this->sheet->setCellValue('B1', 'Title');
        $this->sheet->setCellValue('C1', 'Url');
        $this->sheet->setCellValue('D1', 'Completion ratio');
        $this->sheet->setCellValue('E1', 'Last accessed time');
        $this->sheet->setCellValue('F1', 'Enrollment time');
        $this->sheet->setCellValue('G1', 'Number of collections');
        foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G'] as $column) {
            $this->sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    /**
     * Append course in a new row
     * @param CourseDto $course
     */
    public function addCourse(CourseDto $course) {
        $this->row++;
        $this->sheet->setCellValue('A' . $this->row, $course->id);
        $this->sheet->setCellValue('B' . $this->row, $course->title);
        $this->sheet->setCellValue('C' . $this->row, $course->url);
        $this->sheet->setCellValue('D' . $this->row, $course->completionRatio);
        $this->sheet->setCellValue('E' . $this->row, $course->lastAccessedTime);
        $this->sheet->setCellValue('F' . $this->row, $course->enrollmentTime);
        $this->sheet->setCellValue('G' . $this->row, $course->numberOfCollections);
    }

    /**
     * @param string $fileName
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function save($fileName = 'output.xlsx')
    {
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($fileName);
    }
}