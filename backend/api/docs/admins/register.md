**Register**
----

* **URL**

  /api/admins

* **Method:**
  
  `POST` 

* **Data Params**

     **Required:**
 
    `email=[string]`

    `first_name=[string]`

    `last_name=[string]`

    `pw=[string]`

    `room=[string]`

   **Optional:**
 
   `nickname=[string]`

   `telnr=[string]`

* **Success Response:**

  * **Code:** 201 <br />
    **Content:** 
    ```
    {
      "idadmin": "47",
      "first_name": "der",
      "last_name": "Müller",
      "nickname": "oshi",
      "email": "admin@test.de",
      "telnr": "",
      "room": "235"
    }
    ```
 
* **Error Response:**

  * **Code:** 422 UNPROCESSABLE ENTRY <br />
    **Content:** 

    ```
    {
      "errors": {
        "email": [
            "Email is already taken."
        ],
        "room": [
          "Room must not be empty"
        ]
      }
    }
    ```
* **Postman Call:**
  ```
    POST /api/admins? HTTP/1.1
    Host: www.zeitfrucht.de
    Content-Type: application/json
    Authorization: Basic YWxleDpkYXNpc3RtZWlucGFzc3dvcnQ=
    User-Agent: PostmanRuntime/7.13.0
    Accept: */*
    Cache-Control: no-cache
    Postman-Token: 6ab3f3a3-d19b-4717-ac3c-cbb55c3f9f0a,7774299f-8d5a-4332-9223-f49291ce3114
    Host: www.zeitfrucht.de
    cookie: PHPSESSID=75e71b26905bbae3e7fe0393f1c09139
    accept-encoding: gzip, deflate
    content-length: 4
    Connection: keep-alive
    cache-control: no-cache

    {
      "email":"admin@tes6g54fd4.de",
      "first_name":"der",
      "last_name":"Müller",
      "nickname":"oshi",
      "pw":"123",
      "room": "235"
    }
  ```