# udemy-export
A tool to export list of all courses in your udemy (student) account


# Usage

## Step 1: Get Udemy token


1. Login to udemy, and open 'network' inspection tool
2. Read request headers from udemy until you find 'x-udemy-authorization: Bearer abcdefgh123123123123'
3. Copy the token bearer for example in above it's "abcdefgh123123123123"

## Step 2: Run export With docker (Recommended)

- Assuming you have docker installed
Run `docker run --rm -v ${PWD}/out sirnarsh/udemy-export TOKEN_HERE`
replacing TOKEN_HERE with token in step 1
Example `docker run --rm -v ${PWD}/out sirnarsh/udemy-export abcdefgh123123123123`
(Notice: $PWD will automatically be replaced with current directory which will be mounted to /out directory in image)


## Alternate Step 2: Run using php

- (Assuming you have php7 installed, gd library & composer)
1. `composer install`
2. `php main.php TOKEN_HERE` (Replace TOKEN_HERE with token from step 1
