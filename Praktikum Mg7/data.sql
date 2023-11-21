CREATE TABLE mahasiswa (
    nomer INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    nim VARCHAR(25) UNIQUE,
    program_studi VARCHAR(50)
);

INSERT INTO mahasiswa (nama, nim, program_studi) VALUES
('Asep', '121140666', 'Teknik Informatika'),
('Adit', '121130777', 'Teknik Elektro'),
('Amin', '121120888', 'Teknik Sipil');