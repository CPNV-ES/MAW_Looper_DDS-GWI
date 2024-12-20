INSERT INTO status (id, title)
VALUES (9999, 'ph');
INSERT INTO types (id, title)
VALUES (9999, 'ph');
INSERT INTO exercises (id, name, status_id)
VALUES (9999, 'ph', 9999);
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (9999, 'ph', 9999, 9999);
INSERT INTO fulfillments (id, timestamp_fulfillment, exercise_id)
VALUES (9999, 0, 9999);
INSERT INTO fulfillments_answer_fields (id, answer, fulfillment_id, field_id)
VALUES (9999, 'ph', 9999, 9999);

SELECT *
FROM status;
SELECT *
FROM types;
SELECT *
FROM exercises;
SELECT *
FROM fields;
SELECT *
FROM fulfillments;
SELECT *
FROM fulfillments_answer_fields;

UPDATE status
SET title = 'ph_2';
UPDATE types
SET title = 'ph_2';
UPDATE exercises
SET name = 'ph_2';
UPDATE fields
SET name = 'ph_2';
UPDATE fulfillments
SET timestamp_fulfillment = '2222-12-22';
UPDATE fulfillments_answer_fields
SET answer = 'ph_2';

DELETE
FROM fulfillments_answer_fields;
DELETE
FROM fulfillments;
DELETE
FROM fields;
DELETE
FROM exercises;
DELETE
FROM types;
DELETE
FROM status;
