# Pre-needed data
INSERT INTO status (id, title)
VALUES
    (1, 'Building'),
    (2, 'Answering'),
    (3, 'Closed');
INSERT INTO types (id, title)
VALUES
    (1, 'Single line text'),
    (2, 'List of single lines'),
    (3, 'Multi-line text');

# Exercise creation and directly returning result
INSERT INTO exercises (id, name, status_id)
VALUES (7999, 'exer_10', 1)
RETURNING id, name, status_id;

# Get possible field types
SELECT *
FROM types;

# Adding fields to the exercise one by one and each time fetch the added fields
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (7999, 'field_10', 3, 7999);
SELECT *
FROM fields
WHERE exercise_id = 7999;
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (7998, 'field_10', 2, 7999);
SELECT *
FROM fields
WHERE exercise_id = 7999;
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (7997, 'ph_12', 1, 7999);
SELECT *
FROM fields
WHERE exercise_id = 7999;

# Opening the possible exercises
SELECT *
FROM exercises;

# Update status of exercise to allow fulfillment (php code)
UPDATE exercises
SET status_id = 2
WHERE id = 7999;

# Refresh the possible exercises
SELECT *
FROM exercises;

# Opening the possible exercises to take a fulfillment
SELECT *
FROM exercises;

# Get the field to answer from selected exercises
SELECT *
FROM fields
WHERE exercise_id = 7999;
# Create the take for the exercise
INSERT INTO fulfillments (id, timestamp_fulfillment, exercise_id)
VALUES (7999, '1111-01-01', 7999)
RETURNING id, timestamp_fulfillment, exercise_id;

# Add an answer of the fulfillment
INSERT INTO fulfillments_answer_fields (id, answer, fulfillment_id, field_id)
VALUES (7999, 'ph_10', 7999, 7999);

# Get the changes of the fulfillment answers
SELECT *
FROM fulfillments_answer_fields
WHERE fulfillment_id = 7999;

INSERT INTO fulfillments_answer_fields (id, answer, fulfillment_id, field_id)
VALUES
    (7998, 'ph_11', 7999, 7998),
    (7997, 'ph_12', 7999, 7997);

# Get the changes of the fulfillment answers again
SELECT *
FROM fulfillments_answer_fields
WHERE fulfillment_id = 7999;

# Get exercises to see them all
SELECT *
FROM exercises;

# Get taken fulfillment with answers of fulfillment
SELECT answer, timestamp_fulfillment, e.name, f.name
FROM fulfillments_answer_fields
INNER JOIN maw11.fulfillments t ON fulfillments_answer_fields.fulfillment_id = t.id
INNER JOIN maw11.exercises e ON t.exercise_id = e.id
INNER JOIN maw11.fields f ON fulfillments_answer_fields.field_id = f.id
WHERE e.id = 7999;

# Deletion of an exercise
DELETE
FROM exercises
WHERE id = 7999;
