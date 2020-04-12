<?php

namespace App\Services;

use App\Dto\UdemyResponseDto;

class UdemyService {

    /**
     * @var string
     */
    private $token;
    /**
     * @var int
     */
    private $currentPage = 0;

    /**
     * UdemyService constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Loop of udemy requests to get all courses (setting the response dto, then appending courses each request)
     * @return UdemyResponseDto
     */
    public function getAllCourses() : UdemyResponseDto
    {
        $udemyResponse = new UdemyResponseDto();

        do {
            $response = $this->getNext();
            if (!$response) {
                echo "Failed getting response";
                break;
            }
            $udemyResponse->append(json_decode($response, true));
        } while (!$udemyResponse->isFinished());

        return $udemyResponse;
    }

    /**
     * Send request identical to udemy frontend request
     * @return bool|string
     */
    public function getNext() {
        echo "Sending request for page " . ++$this->currentPage . PHP_EOL;
        $url = 'https://www.udemy.com/api-2.0/users/me/subscribed-courses/' .
            '?ordering=-last_accessed&fields[course]=@min,visible_instructors,image_240x135,' .
            'favorite_time,archive_time,completion_ratio,last_accessed_time,enrollment_time,' .
            'is_practice_test_course,features,num_collections,published_title,is_private,buyable_object_type&fields[user]=@min,job_title'.
            '&page=' . $this->currentPage  .'&page_size=12';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['x-udemy-authorization: Bearer '. $this->token]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }
}