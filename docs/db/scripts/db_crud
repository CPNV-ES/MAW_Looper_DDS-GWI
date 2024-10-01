INSERT INTO status (id, title)
VALUES (999999, 'ph');
INSERT INTO types (id, title)
VALUES (999999, 'ph');
INSERT INTO exercises (id, name, status_id)
VALUES (999999, 'ph', 999999);
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (999999, 'ph', 999999, 999999);
INSERT INTO tests (id, timestamp_test, exercise_id)
VALUES (999999, 0, 999999);
INSERT INTO tests_answer_fields (id, answer, test_id, field_id)
VALUES (999999, 'ph', 999999, 999999);

SELECT *
FROM status;
SELECT *
FROM types;
SELECT *
FROM exercises;
SELECT *
FROM fields;
SELECT *
FROM tests;
SELECT *
FROM tests_answer_fields;

UPDATE status
SET title = 'ph_2';
UPDATE types
SET title = 'ph_2';
UPDATE exercises
SET name = 'ph_2';
UPDATE fields
SET name = 'ph_2';
UPDATE tests
SET timestamp_test = '2222-12-22';
UPDATE tests_answer_fields
SET answer = 'ph_2';

DELETE
FROM tests_answer_fields;
DELETE
FROM tests;
DELETE
FROM fields;
DELETE
FROM exercises;
DELETE
FROM types;
DELETE
FROM status;

