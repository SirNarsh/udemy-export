<?php

namespace App\Dto;

class CourseDto
{
    public $id;
    public $title;
    public $url;
    public $completionRatio;
    public $lastAccessedTime;
    public $enrollmentTime;
    public $numberOfCollections;

    public function __construct(array $course)
    {
        $this->id = $course['id'];
        $this->title = $course['title'];
        $this->url = 'https://udemy.com' . $course['url'];
        $this->completionRatio = $course['completion_ratio'];
        $this->lastAccessedTime = $course['last_accessed_time'];
        $this->enrollmentTime = $course['enrollment_time'];
        $this->numberOfCollections = $course['num_collections'];
    }
}