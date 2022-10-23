**Get all shifts**
----
  Returns all shifts for a given date

* **URL**

  /api/shifts

* **Method:**
  
  `GET` 
  
*  **URL Params**

   **Required:**
 
   `date=[string] format: YYYY-MM-DD, e.g. 2019-12-31`


* **Success Response:**

  * **Code:** 200 <br />
    **Content:**
    ```
    {
    "2019-12-31": {
        "10:00": {
            "user_ids": [
                "85",
                "86"
            ],
            "admin_id": "41"
        },
        "11:00": {
            "user_ids": [
                "86",
                "87"
            ]
        }
      }
    }
    ```
 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `NONE`

  * **Code:** 422 UNPROCESSABLE ENTRY <br />
    **Content:** 
    ```
    {
    "errors": {
        "date": [
            "Date must be a valid date. Sample format: \"2005-12-30\""
        ]
      }
    }
    ```

* **Postman Call:**

  ```
  GET /api/shifts?date=2019-12-31 HTTP/1.1
  Host: localhost:8888
  X-Token: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpZCI6IjQxIiwidHlwZSI6ImFkbWluIiwiZXhwIjoxNTY4NDE2ODI3fQ.DA2bpkWIHRvnDMJp7OqqIHBV2ZqS798jRsgcqKBVpCfqp4x16qCM_9FGwEpZz9WExWJlJWAH3fSe8MxAnesEdLrWzrG5JsKzJUEWzzRhHO1dy2qeOa8oPAzD5LWhUsxAzMThnOgkNeTRVcnrK6i_na6xlyXjqm2jSd3RA1FWt2zJwlfzzoNOMh45TLaxrUU15BUkRU2vw-UgBNePG2ccOotEPT3LVgM5pqlTl62Cm0OcLrzzTz9bJfK77DFE3bzqXsPZGme065ISo1eUs5-9-vV5UdFqcrtJyJNxeU8BFd-A5h_DH9zyw6wYNDmXAHT8VvevJdSWeNGfaRG4L4iklQ
  Authorization: Basic YWxleDpkYXNpc3RtZWlucGFzc3dvcnQ=
  User-Agent: PostmanRuntime/7.16.3
  Accept: */*
  Cache-Control: no-cache
  Postman-Token: 3f23e690-2bb5-415d-aad6-1a772a6c2e0c,4524414f-9297-41be-a681-0becc15eab1a
  Host: localhost:8888
  Accept-Encoding: gzip, deflate
  Connection: keep-alive
  cache-control: no-cache
  ```