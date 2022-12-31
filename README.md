# Assessment REST API Overtime App

## Setup yang dibutuhkan untuk menjalankan Api

```bash
php artisan migrate
php artisan db:seed
```

## Untuk menjalankan testing

```bash
./vendor/bin/phpunit
atau
php artisan serve
atau
php artisan test
```

# REST API

The REST API to the example app is described below.

## Get list of Employees

### Request

`GET /api/employees`

### Response

    {
        "code": 200,
        "message": "Success",
        "data": [
            {
                "id": 1,
                "name": "Dimas reynaldi",
                "salary": 3000000
            },
            {
                "id": 2,
                "name": "Reynaldi akcerman",
                "salary": 3200000
            },
            {
                "id": 3,
                "name": "Jenniie",
                "salary": 2000000
            },
            {
                "id": 4,
                "name": "Rosee",
                "salary": 3000000
            },
            {
                "id": 5,
                "name": "Andika Kangen Band",
                "salary": 2500000
            }
        ]
    }

## Create a new Employee

### Request

`POST /api/employees`

### Rule

    name
    - String
    - Minimal 2 karakter
    - Harus unik
    salary
    - Integer
    - Minimal 2 juta
    - Maksimal 10 juta

<<<<<<< HEAD

### Body

    {
        "name": "Cranel Bell",
        "salary": 5000000
    }

=======

### Body

    {
        "name": "Sandhika",
        "salary": 6000000
    }

> > > > > > > 
### Response

    {
        "code": 200,
        "message": "Success",
        "data": [
            {
                "id": 6,
                "name": "Sandhika",
                "salary": 6000000
            }
        ]
    }

## Update Setting

### Request

`PATCH /api/settings`

### Rule

    key
    - Hanya bisa diisi `overtime_method`.
    value
    - Hanya bisa diisi oleh nilai dari `references`.`id` dengan kriteria `code` = `overtime_method`.

### Body

    {
        "key": "overtime_method",
        "value": 2
    }

<<<<<<< HEAD

### Response

    {
        "code": 200,
        "message": "Success",
        "data": [
            {
                "key": "overtime_method",
                "value": 2
            }
        ]
    }

## Create a new Overtime

### Request

`POST /api/overtimes`

### Rule

    employee_id
    - Integer
    - Sesuai dengan yang ada di `employees`.`id`
    date
    - Date
    - Tidak boleh ada `date` yang sama pada `employee_id` tersebut
    time_started
    - Format HH:mm
    - Tidak boleh lebih dari `time_ended`
    time_ended
    - Format HH:mm
    - Tidak boleh kurang dari `time_started`

### Body

    {
        "employee_id": 1,
        "date": "2022-09-14",
        "time_started": "10:08",
        "time_ended": "12:09"
    }

### Response

    {
        "code": 200,
        "message": "Success",
        "data": [
            {
                "id": 7,
                "employee_id": 1,
                "date": "2022-09-14",
                "time_started": "10:08:00",
                "time_ended": "12:09:00"
            }
        ]
    }

## Get list of Overtimes

### Request

`GET /api/overtime-pays/calculate/{month}`

Contohnya
http://127.0.0.1:8000/api/overtime-pays/calculate/2022-09

### Rule

=======

### Response

    {
        "code": 200,
        "message": "Success",
        "data": [
            {
                "key": "overtime_method",
                "value": 2
            }
        ]
    }

## Create a new Overtime

### Request

`POST /api/overtimes`

### Rule

    employee_id
    - Integer
    - Sesuai dengan yang ada di `employees`.`id`
    date
    - Date
    - Tidak boleh ada `date` yang sama pada `employee_id` tersebut
    time_started
    - Format HH:mm
    - Tidak boleh lebih dari `time_ended`
    time_ended
    - Format HH:mm
    - Tidak boleh kurang dari `time_started`

### Body

    {
        "employee_id": 1,
        "date": "2022-09-14",
        "time_started": "10:08",
        "time_ended": "12:09"
    }

### Response

    {
        "code": 200,
        "message": "Success",
        "data": [
            {
                "id": 7,
                "employee_id": 1,
                "date": "2022-09-14",
                "time_started": "10:08:00",
                "time_ended": "12:09:00"
            }
        ]
    }

## Get list of Overtimes

### Request

`GET /api/overtime-pays/calculate/{month}`

Contohnya
http://127.0.0.1:8000/api/overtime-pays/calculate/2022-09

### Rule

> > > > > > > d2f4966c0d1748e66eb24dc02857a69f3e199cbf
    month
    - Format YYYY-MM

### Response

    {
        "code": 200,
        "message": "Success",
        "data": [
            {
                "id": 1,
                "name": "Novaldi Sandi",
                "salary": 2000000,
                "overtimes": [
                    {
                        "id": 1,
                        "date": "2022-09-13",
                        "time_started": "10:00:00",
                        "time_ended": "12:00:00",
                        "overtime_duration": 2
                    },
                    {
                        "id": 3,
                        "date": "2022-09-13",
                        "time_started": "13:00:00",
                        "time_ended": "15:30:00",
                        "overtime_duration": 2
                    },
                    {
                        "id": 5,
                        "date": "2022-09-13",
                        "time_started": "10:08:00",
                        "time_ended": "12:09:00",
                        "overtime_duration": 2
                    },
                    {
                        "id": 6,
                        "date": "2022-09-13",
                        "time_started": "10:08:00",
                        "time_ended": "12:09:00",
                        "overtime_duration": 2
                    },
                    {
                        "id": 7,
                        "date": "2022-09-14",
                        "time_started": "10:08:00",
                        "time_ended": "12:09:00",
                        "overtime_duration": 2
                    }
                ],
                "overtime_duration_total": 10,
                "amount": 100000
            },
            {
                "id": 2,
                "name": "Kazuto Kirigaya",
                "salary": 2500000,
                "overtimes": [
                    {
                        "id": 4,
                        "date": "2022-09-13",
                        "time_started": "10:30:00",
                        "time_ended": "14:00:00",
                        "overtime_duration": 3
                    }
                ],
                "overtime_duration_total": 3,
                "amount": 30000
            },
            {
                "id": 3,
                "name": "Hikigaya Hachiman",
                "salary": 3000000,
                "overtimes": [
                    {
                        "id": 2,
                        "date": "2022-09-13",
                        "time_started": "07:00:00",
                        "time_ended": "09:45:00",
                        "overtime_duration": 2
                    }
                ],
                "overtime_duration_total": 2,
                "amount": 20000
            },
            {
                "id": 4,
                "name": "Sakuta Azusagawa",
                "salary": 4000000,
                "overtimes": [],
                "overtime_duration_total": 0,
                "amount": 0
            },
            {
                "id": 5,
                "name": "Novaldi Sandi Ago",
                "salary": 2500000,
                "overtimes": [],
                "overtime_duration_total": 0,
                "amount": 0
            },
            {
                "id": 6,
                "name": "Cranel Bell",
                "salary": 5000000,
                "overtimes": [],
                "overtime_duration_total": 0,
                "amount": 0
            }
        ]
    }

### Jika Request tidak memenuhi Rule, maka akan mengembalikan Bad Request/Not Found

## Terima Kasih
