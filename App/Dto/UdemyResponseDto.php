<?php


namespace App\Dto;


class UdemyResponseDto
{
    /**
     * @var int
     */
    public $count = 0;

    /**
     * @var bool
     */
    public $lastResponseFailed = false;

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

        if (isset($response['results'])) {
            foreach ($response['results'] as $course) {
                $this->coursesDto[] = new CourseDto($course);
            }
        } else {
            echo "Response didn't contain courses list " . PHP_EOL;
            $this->lastResponseFailed = true;
        }
    }

    /**
     * isFinished bool by comparing done vs total courses count
     * @return bool
     */
    public function isFinished()
    {
        if ($this->lastResponseFailed) {
            return true;
        }

        $done = count($this->coursesDto);
        echo "Got {$done} of {$this->count} courses" . PHP_EOL;
        return $this->count === count($this->coursesDto);
    }
}
