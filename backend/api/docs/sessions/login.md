**Login**

----

* **URL**

  /api/sessions

* **Method:**
  
    `POST`

* **Data Params**

  **Required:**

  `email=[string]`

  `pw=[string]`

* **Success Response:**
  


  * **Code:** 200 <br />
    **Content:**
    ```
    {
        "X-Token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NDEsInR5cGUiOiJhZG1pbiIsImV4cCI6MTU1OTY3NzQ3MX0.HX91D-au-VV0TtFpKkqnWHYtjvTfzafWqjX99puskzk"
    }
    ```
 
* **Error Response:**

  * **Code:** 422 UNPROCESSABLE ENTRY <br />
    **Content:** 
    ```
    {
        "errors": {
            "credentials": "Invalid credentials provided"
        }
    }
    ```

* **Postman Call:**
  ```
    POST /api/sessions HTTP/1.1
    Host: localhost:8888
    Content-Type: application/json
    Authorization: Basic YWxleDpkYXNpc3RtZWlucGFzc3dvcnQ=
    User-Agent: PostmanRuntime/7.13.0
    Accept: */*
    Cache-Control: no-cache
    Postman-Token: 2c550ec3-3330-4655-b794-09579efe9be3,c70c627a-dd92-4d13-9800-3162b4425488
    Host: localhost:8888
    accept-encoding: gzip, deflate
    content-length: 57
    Connection: keep-alive
    cache-control: no-cache

    {
        "email":"admin@test.der5ee34436g54f463",
        "pw":"123"
    }
  ```