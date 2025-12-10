use acuario;

select*from prueba order by id desc;

-- DELETE FROM prueba WHERE id BETWEEN 502 AND 511;


CREATE TABLE prueba (
  id INT AUTO_INCREMENT PRIMARY KEY,
  humedad FLOAT,
  temp_ambiente FLOAT,
  temp_agua FLOAT,
  tds INT,
  luz TINYINT,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



select*from commands;
select*from schedules;
select*from settings;
select*from feeder_logs ORDER BY id asc;

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (64, 23.1, 30, 1000, 1);

INSERT INTO prueba2 (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (19, 13.1, 10, 500,0);
INSERT INTO prueba2 (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (22, 15.1, 15, 700,0);
