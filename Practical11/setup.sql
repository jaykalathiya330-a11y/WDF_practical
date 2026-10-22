CREATE TABLE IF NOT EXISTS practical11_students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  course VARCHAR(100) NOT NULL,
  semester INT NOT NULL DEFAULT 3,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_email (email)
);

INSERT IGNORE INTO practical11_students (name,email,course,semester) VALUES
('Aarav Patel','aarav.patel@example.com','Computer Engineering',3),
('Diya Shah','diya.shah@example.com','Computer Engineering',3),
('Rohan Mehta','rohan.mehta@example.com','Information Technology',3),
('Anaya Desai','anaya.desai@example.com','Computer Engineering',3),
('Vivaan Joshi','vivaan.joshi@example.com','Information Technology',3),
('Sara Trivedi','sara.trivedi@example.com','Computer Engineering',3),
('Arjun Dave','arjun.dave@example.com','Computer Engineering',3),
('Isha Parmar','isha.parmar@example.com','Information Technology',3),
('Kabir Bhatt','kabir.bhatt@example.com','Computer Engineering',3),
('Mira Shah','mira.shah@example.com','Information Technology',3),
('Krish Vyas','krish.vyas@example.com','Computer Engineering',3),
('Kiara Modi','kiara.modi@example.com','Computer Engineering',3),
('Dev Solanki','dev.solanki@example.com','Information Technology',3),
('Nisha Rana','nisha.rana@example.com','Computer Engineering',3),
('Aditya Thakkar','aditya.thakkar@example.com','Information Technology',3),
('Riya Pandya','riya.pandya@example.com','Computer Engineering',3),
('Yash Gohil','yash.gohil@example.com','Computer Engineering',3),
('Myra Shah','myra.shah@example.com','Information Technology',3),
('Neel Panchal','neel.panchal@example.com','Computer Engineering',3),
('Tara Soni','tara.soni@example.com','Information Technology',3);
