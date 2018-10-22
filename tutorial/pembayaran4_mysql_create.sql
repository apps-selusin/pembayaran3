CREATE TABLE `t00_tahunajaran` (
	`id` int NOT NULL,
	`awal_bulan` tinyint NOT NULL,
	`awal_tahun` smallint NOT NULL,
	`akhir_bulan` tinyint NOT NULL,
	`akhir_tahun` smallint NOT NULL,
	`tahun_ajaran` varchar(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t01_sekolah` (
	`id` int NOT NULL,
	`kode` varchar(10) NOT NULL,
	`nama` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t02_kelas` (
	`id` int NOT NULL,
	`sekolah_id`  NOT NULL,
	`nama` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t03_siswa` (
	`id` int NOT NULL,
	`tahunajaran_id`  NOT NULL,
	`kelas_id`  NOT NULL,
	`nism` varchar(50) NOT NULL,
	`nama` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t04_rutin` (
	`id` int NOT NULL AUTO_INCREMENT,
	`nama` varchar(50) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t05_siswarutin` (
	`id` int NOT NULL AUTO_INCREMENT,
	`siswa_id` int NOT NULL,
	`rutin_id` int NOT NULL,
	`nilai` FLOAT(14,2) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t06_siswarutinbayar` (
	`id` int NOT NULL AUTO_INCREMENT,
	`tahunajaran_id` int NOT NULL,
	`kelas_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `t02_kelas` ADD CONSTRAINT `t02_kelas_fk0` FOREIGN KEY (`sekolah_id`) REFERENCES `t01_sekolah`(`id`);

ALTER TABLE `t03_siswa` ADD CONSTRAINT `t03_siswa_fk0` FOREIGN KEY (`tahunajaran_id`) REFERENCES `t00_tahunajaran`(`id`);

ALTER TABLE `t03_siswa` ADD CONSTRAINT `t03_siswa_fk1` FOREIGN KEY (`kelas_id`) REFERENCES `t02_kelas`(`id`);

ALTER TABLE `t05_siswarutin` ADD CONSTRAINT `t05_siswarutin_fk0` FOREIGN KEY (`siswa_id`) REFERENCES `t03_siswa`(`id`);

ALTER TABLE `t05_siswarutin` ADD CONSTRAINT `t05_siswarutin_fk1` FOREIGN KEY (`rutin_id`) REFERENCES `t04_rutin`(`id`);

ALTER TABLE `t06_siswarutinbayar` ADD CONSTRAINT `t06_siswarutinbayar_fk0` FOREIGN KEY (`tahunajaran_id`) REFERENCES `t00_tahunajaran`(`id`);

ALTER TABLE `t06_siswarutinbayar` ADD CONSTRAINT `t06_siswarutinbayar_fk1` FOREIGN KEY (`kelas_id`) REFERENCES `t02_kelas`(`id`);

