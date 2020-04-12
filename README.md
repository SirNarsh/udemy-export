# udemy-export
A tool to export list of all courses in your Udemy© (student) account.
This tool is not affilated or managed by Udemy©


# Usage
Simple 2 steps to get an EXCEL file with list of courses you have subscribed to in your account, including progress, number of collections course is in, last accessed & date purchased.

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

To cleanup the image downloaded you can always run `docker image rm sirnarsh/udemy-export`


## Alternate Step 2: Run using php

- (Assuming you have php7 installed, gd library & composer)
1. `composer install`
2. `php main.php TOKEN_HERE` (Replace TOKEN_HERE with token from step 1


# License

This script is open-sourced software licensed under the [MIT license](LICENSE.md).
This tool is in no way sponsored, endorsed or administered by, or associated with, Udemy.
Udemy is registered trademark by Udemy, Inc.
