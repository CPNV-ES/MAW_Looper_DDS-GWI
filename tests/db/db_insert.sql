INSERT INTO status (id, title)
VALUES
    (899999, 'ph_00'),
    (899998, 'ph_01'),
    (899997, 'ph_02');
INSERT INTO types (id, title)
VALUES
    (899999, 'ph_00'),
    (899998, 'ph_01'),
    (899997, 'ph_02');
INSERT INTO exercises (id, name, status_id)
VALUES
    (899999, 'ph_00', 899999),
    (899998, 'ph_01', 899998),
    (899997, 'ph_02', 899997);
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES
    (899999, 'ph_00', 899999, 899999),
    (899998, 'ph_01', 899998, 899998),
    (899997, 'ph_02', 899997, 899997);
INSERT INTO tests (id, timestamp_test, exercise_id)
VALUES
    (899999, '1111-11-12', 899999),
    (899998, '1111-11-11', 899998),
    (899997, '1111-11-10', 899997);
INSERT INTO tests_answer_fields (id, answer, test_id, field_id)
VALUES
    (899999, 'ph_00', 899999, 899999),
    (899998, 'ph_01', 899998, 899998),
    (899997, 'ph_02', 899997, 899997);
