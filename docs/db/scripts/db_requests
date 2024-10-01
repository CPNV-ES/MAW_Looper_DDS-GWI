# Id are all static for now
# ToDo make see if make inner joins and how to best remove static id
# Pre-needed data
INSERT INTO status (id, title)
VALUES
    (799999, 'ph_10'),
    (799998, 'ph_11'),
    (799997, 'ph_12');
INSERT INTO types (id, title)
VALUES
    (799999, 'ph_10'),
    (799998, 'ph_11'),
    (799997, 'ph_12');

# Exercise creation and directly returning result
INSERT INTO exercises (id, name, status_id)
VALUES (799999, 'ph_10', 799999)
RETURNING id, name, status_id;

# Get possible field types
SELECT *
FROM types;

# Adding fields to the exercise one by one and each time fetch the added fields
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (799999, 'ph_10', 799999, 799999);
SELECT *
FROM fields
WHERE exercise_id = 799999;
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (799998, 'ph_11', 799998, 799999);
SELECT *
FROM fields
WHERE exercise_id = 799999;
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES (799997, 'ph_12', 799997, 799999);
SELECT *
FROM fields
WHERE exercise_id = 799999;

# Opening the possible exercises
SELECT *
FROM exercises;

# Update status of exercise to allow test (php code)
UPDATE exercises
SET status_id = 799998
WHERE id = 799999;

# Refresh the possible exercises
SELECT *
FROM exercises;

# Opening the possible exercises to take a test
SELECT *
FROM exercises;

# Get the field to answer from selected exercises
SELECT *
FROM fields
WHERE exercise_id = 799999;

# Create the take for the exercise
INSERT INTO tests (id, timestamp_test, exercise_id)
VALUES (799999, '1111-01-01', 799999)
RETURNING id, timestamp_test, exercise_id;

# Add an answer of the test
INSERT INTO tests_answer_fields (id, answer, test_id, field_id)
VALUES (799999, 'ph_10', 799999, 799999);

# Get the changes of the test answers
SELECT *
FROM tests_answer_fields
WHERE test_id = 799999;

INSERT INTO tests_answer_fields (id, answer, test_id, field_id)
VALUES
    (799998, 'ph_11', 799999, 799998),
    (799997, 'ph_12', 799999, 799997);

# Get the changes of the test answers again
SELECT *
FROM tests_answer_fields
WHERE test_id = 799999;

# Get exercises to see them all
SELECT *
FROM exercises;

# Get taken test with answers of test
SELECT answer, timestamp_test, e.name, f.name
FROM tests_answer_fields
INNER JOIN maw11.tests t ON tests_answer_fields.test_id = t.id
INNER JOIN maw11.exercises e ON t.exercise_id = e.id
INNER JOIN maw11.fields f ON tests_answer_fields.field_id = f.id
WHERE e.id = 799999;

# Deletion of an exercise
DELETE
FROM exercises
WHERE id = 799999;
