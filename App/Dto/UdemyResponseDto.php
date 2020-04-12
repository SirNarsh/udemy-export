<?php


namespace App\Dto;


class UdemyResponseDto
{
    /**
     * @var int
     */
    public $count = 0;

    /**
     * @var CourseDto[]
     */
    public $coursesDto = [];

    /**
     * @param array $response
     */
    public function append(array $response)
    {
        echo "Appending courses to list object..." . PHP_EOL;
        $this->count = $response['count'];
        foreach ($response['results'] as $course) {
            $this->coursesDto[] = new CourseDto($course);
        }
    }

    /**
     * @return bool
     */
    public function isFinished()
    {
        $done = count($this->coursesDto);
        echo "Got {$done} of {$this->count} courses" . PHP_EOL;
        return $this->count === count($this->coursesDto);
    }
}
