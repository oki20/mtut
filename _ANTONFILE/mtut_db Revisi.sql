USE mtut_db

DROP TABLE tb_user;
CREATE TABLE tb_user
(
id INT NOT NULL AUTO_INCREMENT,
usnm VARCHAR(255),
pasw VARCHAR(255),
levl VARCHAR(255), -- 1=Admin, 2=User
foto VARCHAR(255),
PRIMARY KEY(id)
);

INSERT INTO tb_user (usnm,pasw,levl,foto) VALUES ('admin','admin','1','fadmin.jpg');
INSERT INTO tb_user (usnm,pasw,levl,foto) VALUES ('uzer','uzer','2','fuzer.jpg');


DROP TABLE tb_docdata;
CREATE TABLE tb_docdata
(
kode INT NOT NULL AUTO_INCREMENT,
dvnm VARCHAR(255), -- division name
dscr VARCHAR(255), -- description
fpdf VARCHAR(255), -- file pdf
lgfo VARCHAR(255), -- text googleform
catgor VARCHAR(255), -- materi & test
docdt VARCHAR(255), -- tanggal input/update text documen pdf
dura INT,
PRIMARY KEY(kode)
);

INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Penjualan Dasar','Tutorial 1.pdf','','modul',10);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Penjualan Middle','Tutorial 2.pdf','','modul',10);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Penjualan Advanced','Tutorial 3.pdf','','modul',10);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Negoisasi','Tutorial 4.pdf','','modul',10);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Penjualan Dasar','','https://forms.gle/X7sQYFKg6mu43Gy4A','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Penjualan Middle','','https://forms.gle/ZB7mePSPb6dYX7nj8','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Penjualan Advanced','','https://forms.gle/M8gUSXu12pCADegn8','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('sales','Teknik Negoisasi','','https://forms.gle/t4iTEQYLtEqGf7Ah9','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Cutting','Tutorial 5.pdf','','modul',20);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Bending','Tutorial 6.pdf','','modul',20);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Welding','Tutorial 7.pdf','','modul',20);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Repaint','Tutorial 8.pdf','','modul',20);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Cutting','','Link Googleform 5','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Welding','','Link Googleform 6','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Bending','','Link Googleform 7','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('production','Cara Repaint','','Link Googleform 8','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin A','Tutorial 9.pdf','','modul',30);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin B','Tutorial 10.pdf','','modul',30);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin C','Tutorial 11.pdf','','modul',30);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin D','Tutorial 12.pdf','','modul',30);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin A','','https://forms.gle/X7sQYFKg6mu43Gy4A','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin B','','https://forms.gle/ZB7mePSPb6dYX7nj8','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin C','','https://forms.gle/M8gUSXu12pCADegn8','test',0);
INSERT INTO tb_docdata (dvnm,dscr,fpdf,lgfo,catgor,dura) VALUES ('maintenance','Service Mesin D','','https://forms.gle/t4iTEQYLtEqGf7Ah9','test',0);


SELECT * FROM tb_user;
SELECT * FROM tb_docdata ORDER BY kode DESC;
DELETE FROM tb_docdata WHERE dscr LIKE '%x%';


-- Tabel akan terisi usnm & kode setelah halamnan pdf auto close setelah n menit
DROP TABLE tb_pdflock;
CREATE TABLE tb_pdflock
(
id INT NOT NULL AUTO_INCREMENT,
usnm VARCHAR(255), -- usnm dari tb_user
kode VARCHAR(255), -- kode dari tb_docdata
PRIMARY KEY(id)
);


