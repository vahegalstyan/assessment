# assessment
- composer install
- bin/console doctrine:schema:create

#Request examples

#Create User

- POST /api/user HTTP/1.1
Content-Type: application/json
User-Agent: PostmanRuntime/7.20.1
Accept: */*
Cache-Control: no-cache
Postman-Token: ba3c447e-dfa4-485c-ab2c-c63d8fed8c5a
Host: assessment.loc
Accept-Encoding: gzip, deflate
Content-Length: 48
Connection: keep-alive
{
"firstname": "test",
"lastname": "testyan"
}
HTTP/1.1 201 Created
Server: nginx/1.15.8
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
Date: Tue, 24 Dec 2019 07:59:18 GMT
X-Robots-Tag: noindex
{
"data": {
"user": {
"id": 10,
"firstname": "test",
"lastname": "testyan",
"creationdate": "2019-12-24T07:59:18+00:00"
}
}
}


Get Users

- GET /api/user HTTP/1.1
Content-Type: application/json
User-Agent: PostmanRuntime/7.20.1
Accept: */*
Cache-Control: no-cache
Postman-Token: fc73929a-218a-4f84-a833-ce2600258ffe
Host: assessment.loc
Accept-Encoding: gzip, deflate
Content-Length: 24
Connection: keep-alive
{
"firstname": "arax"
}
HTTP/1.1 200 OK
Server: nginx/1.15.8
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
Date: Tue, 24 Dec 2019 06:15:48 GMT
X-Robots-Tag: noindex
[
{
"id": 9,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T19:03:56+00:00"
},
{
"id": 7,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:36+00:00"
},
{
"id": 6,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:35+00:00"
},
{
"id": 5,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:34+00:00"
},
{
"id": 4,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:32+00:00"
},
{
"id": 3,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:31+00:00"
},
{
"id": 2,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:29+00:00"
},
{
"id": 1,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:21+00:00"
}
]

#Get user

- GET /api/user/2 HTTP/1.1
Content-Type: application/json
User-Agent: PostmanRuntime/7.20.1
Accept: */*
Cache-Control: no-cache
Postman-Token: 6186046b-a710-4256-9c37-53178f2c9dfe
Host: assessment.loc
Accept-Encoding: gzip, deflate
Content-Length: 24
Connection: keep-alive
{
"firstname": "arax"
}
HTTP/1.1 200 OK
Server: nginx/1.15.8
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
Date: Tue, 24 Dec 2019 07:57:45 GMT
X-Robots-Tag: noindex
{
"date": {
"user": {
"id": 2,
"firstname": "akjsdhsad",
"lastname": "asdljasldj",
"creationdate": "2019-12-23T18:06:29+00:00"
}
}
}

#Delete user

- DELETE /api/user/2 HTTP/1.1
Content-Type: application/json
User-Agent: PostmanRuntime/7.20.1
Accept: */*
Cache-Control: no-cache
Postman-Token: 7cdc79ab-3a38-479c-be0b-42b93e792ae8
Host: assessment.loc
Accept-Encoding: gzip, deflate
Content-Length: 24
Connection: keep-alive
{
"firstname": "arax"
}
HTTP/1.1 200 OK
Server: nginx/1.15.8
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
Date: Tue, 24 Dec 2019 07:58:17 GMT
X-Robots-Tag: noindex
[]


