# Measurement Service

Storage for sensor measurements (temperature)

## Installation

Docker installed required. Execute Makefile commands to build and run the environment in the project root.

```bash
make build
make up
```
Final step – install dependencies and initialise database state.

```bash
make init
```
Application runs on localhost:80 by default.

## View generated sensor id (for requests) by CMD
```bash
make bash-db -> psql measurement postgres -> select * from sensors;
```

## Usage (cURL examples)
API #1 – read from a sensor
```
curl --location 'http://localhost/api/push' \
--header 'Content-Type: application/json' \
--data '{
    "sensorId": "6c0b6237-e6f6-4344-bc5a-be0960cde5cc",
    "temperature": 23
}'
```

API #2 – read from a sensor
```
curl http://localhost/sensor/read/6c0b6237-e6f6-4344-bc5a-be0960cde5cc

Response:
165;60.79
```

Average temperature for a particular sensor reading, in one-hour range.

```
curl http://localhost/api/stats/sensor-per-hour/6c0b6237-e6f6-4344-bc5a-be0960cde5cc

Response:
[{"per_hour":"2023-06-08 05:00:00","avrg_temp":"33.89"},{"per_hour":"2023-06-08 06:00:00","avrg_temp":"19.03"}]

```
Average temperature from all sensors, during last X days.

```
curl --location 'http://localhost/api/stats/all-sensors' \
--header 'Content-Type: application/json' \
--data '{
    "days": 10
}'

Response:
[{"avg":"36.58"}]

```



## License

[MIT](https://choosealicense.com/licenses/mit/)