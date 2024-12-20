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
INSERT INTO exercises (id, name, status_id)
VALUES
    (8999, 'exer_0', 3),
    (8998, 'exer_1', 2),
    (8997, 'exer_2', 1);
INSERT INTO fields (id, name, type_id, exercise_id)
VALUES
    (8999, 'field_0', 3, 8999),
    (8998, 'field_1', 2, 8998),
    (8997, 'field_2', 1, 8997);
INSERT INTO fulfillments (id, timestamp_fulfillment, exercise_id)
VALUES
    (8999, '1111-11-12', 8999),
    (8998, '1111-11-11', 8998),
    (8997, '1111-11-10', 8997);
INSERT INTO fulfillments_answer_fields (id, answer, fulfillment_id, field_id)
VALUES
    (8999, 'answer_0', 8999, 8999),
    (8998, 'answer_1', 8998, 8998),
    (8997, 'answer_2', 8997, 8997);
