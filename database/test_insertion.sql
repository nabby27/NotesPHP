use MyNotes;

INSERT INTO colors (id, color, bootstrap) VALUES
(1, 'red', 'danger'),
(2, 'blue', 'primary'),
(3, 'black', 'dark'),
(4, 'orange', 'warning'),
(5, 'green', 'success'),
(6, 'grey', 'secondary'),
(7, 'white', 'white'),
(8, 'grey blue', 'info');

INSERT INTO notes (id, title, description, color) VALUES
(1, 'Example 1', 'example of body note 1', 2),
(2, 'Example 2', 'example of body note 2', 1);
