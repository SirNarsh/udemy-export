<?php

namespace App\Dto;

class CourseDto
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $url;

    /**
     * @var int
     */
    public $completionRatio;

    /**
     * @var string
     */
    public $lastAccessedTime;

    /**
     * @var string
     */
    public $enrollmentTime;

    /**
     * @var int
     */
    public $numberOfCollections;

    /**
     * CourseDto constructor.
     * Normalize course object reading selected props
     * @param array $course
     */
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