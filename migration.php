<?php

require 'vendor/autoload.php';

$pdo = new PDO('pgsql:host=measurement-service-postgres-1;port=5432;dbname=measurement;', 'postgres', 'postgres', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS sensors (
                    id varchar(100) PRIMARY KEY,
                    action_count INT DEFAULT 0
                    );'
);

$pdo->exec(
    'INSERT INTO sensors(id, action_count) 
                VALUES (gen_random_uuid(), 0),
                        (gen_random_uuid(), 0),
                         (gen_random_uuid(), 0),
                          (gen_random_uuid(), 0),
                           (gen_random_uuid(), 0);'
);

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS temperature (
                        id serial PRIMARY KEY,
                        sensor_uuid varchar(100) NOT NULL,
                        data_value DECIMAL,
                        created_at timestamp DEFAULT NOW()
                     );'
);


