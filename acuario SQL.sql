use acuario;

select*from prueba order by id desc;

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

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (60, 24.1, 21.9, 830, 0);

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (60, 24.1, 22.5, 1600, 1);

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (64, 23.1, 21.5, 3000, 0);

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (64, 23.1, 22.5, 3000, 0);

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (64, 23.1, 30, 2500, 1);

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (14, 13.1, 10, 500,0);

INSERT INTO prueba (humedad, temp_ambiente, temp_agua, tds, luz)
VALUES (64, 23.1, 30, 2500,0);