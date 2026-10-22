CREATE TABLE IF NOT EXISTS practical13_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  details TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO practical13_items (title,details)
SELECT 'Welcome event','Orientation for new students'
WHERE NOT EXISTS (SELECT 1 FROM practical13_items);
