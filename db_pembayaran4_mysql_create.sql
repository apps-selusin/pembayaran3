CREATE TABLE `t00_tahunajaran` (
	`id` int NOT NULL AUTO_INCREMENT,
	`awal_bulan` tinyint NOT NULL,
	`awal_tahun` smallint NOT NULL,
	`akhir_bulan` tinyint NOT NULL,
	`akhir_tahun` smallint NOT NULL,
	`tahun_ajaran` varchar(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t01_sekolah` (
	`id` int NOT NULL AUTO_INCREMENT,
	`kode` varchar(10) NOT NULL,
	`nama` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t02_kelas` (
	`id` int NOT NULL AUTO_INCREMENT,
	`sekolah_id` int NOT NULL,
	`nama` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `t04_siswa` (
	`id` int NOT NULL AUTO_INCREMENT,
	`tahunajaran_id` int NOT NULL,
	`kelas_id` int NOT NULL,
	`nism` varchar(50) NOT NULL,
	`nama` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `t02_kelas` ADD CONSTRAINT `t02_kelas_fk0` FOREIGN KEY (`sekolah_id`) REFERENCES `t01_sekolah`(`id`);

ALTER TABLE `t04_siswa` ADD CONSTRAINT `t04_siswa_fk0` FOREIGN KEY (`tahunajaran_id`) REFERENCES `t00_tahunajaran`(`id`);

ALTER TABLE `t04_siswa` ADD CONSTRAINT `t04_siswa_fk1` FOREIGN KEY (`kelas_id`) REFERENCES `t02_kelas`(`id`);

