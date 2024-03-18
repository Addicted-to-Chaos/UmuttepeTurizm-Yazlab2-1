
CREATE DATABASE umuttepe;
USE umuttepe;

CREATE TABLE Yolcular (
    Yolcu_id INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255) UNIQUE,
    Sifre VARCHAR(255),
    Ad VARCHAR(255),
    Soyad VARCHAR(255),
    Telefon VARCHAR(15),
    Tc VARCHAR(20),
    Yas INT CHECK (Yas >= 0),
    Cinsiyet ENUM('Erkek', 'Kadın'),
    Bakiye DECIMAL(10,2) CHECK (Bakiye >= 0)
);

INSERT INTO Yolcular (Email, Sifre, Ad, Soyad, Telefon, Tc, Yas, Cinsiyet, Bakiye)
VALUES ('ornek@email.com', '123', 'Ahmet', 'Yılmaz', '5551234567', '1234567890', 25, 'Erkek', 0.00);

INSERT INTO Yolcular (Email, Sifre, Ad, Soyad, Telefon, Tc, Yas, Cinsiyet, Bakiye)
VALUES ('ornekk@email.com', '123', 'Veli', 'Veli', '5551234568', '1234567898', 25, 'Erkek', 0.00);

-- Şehirler Tablosu
CREATE TABLE Sehirler (
    Plaka_kodu INT PRIMARY KEY,
    Sehir_adi VARCHAR(255)
);

INSERT INTO Sehirler VALUES (06, "Ankara");
INSERT INTO Sehirler VALUES (16, "Bursa");
INSERT INTO Sehirler VALUES (34, "Istanbul");
INSERT INTO Sehirler VALUES (41, "Kocaeli");


-- Seferler Tablosu
CREATE TABLE Seferler (
    Sefer_id INT AUTO_INCREMENT PRIMARY KEY,
    Kalkis_sehir INT,
    Varis_sehir INT,
    Tarih DATE,
    Kalkis_saat TIME,
    Varis_saat TIME,
    Peron_no INT,
    Plaka VARCHAR(15),
    Kapasite INT,
    Dolu_koltuk INT CHECK (Dolu_koltuk >= 0),
    Bos_koltuk INT CHECK (Bos_koltuk >= 0),
    Fiyat DECIMAL(10,2) CHECK (Fiyat >= 0),
    FOREIGN KEY (Kalkis_sehir) REFERENCES Sehirler(Plaka_kodu),
    FOREIGN KEY (Varis_sehir) REFERENCES Sehirler(Plaka_kodu)
);

CREATE TABLE Koltuklar (
    Koltuk_id INT AUTO_INCREMENT PRIMARY KEY,
    Koltuk_no INT,
	Sefer_id INT,
    Yolcu_id INT,
    Durum ENUM('Rezerve', 'Satin Alindi', 'Musait') NOT NULL,
    FOREIGN KEY (Sefer_id) REFERENCES Seferler(Sefer_id),
    FOREIGN KEY (Yolcu_id) REFERENCES Yolcular(Yolcu_id)
);


CREATE TABLE Biletler (
    Bilet_id INT AUTO_INCREMENT PRIMARY KEY,
    PNR_kodu VARCHAR(50),
    Yolcu_id INT,
	Sefer_id INT,
    Koltuk_id INT,
    FOREIGN KEY (Yolcu_id) REFERENCES Yolcular(Yolcu_id) ON DELETE CASCADE,
    FOREIGN KEY (Sefer_id) REFERENCES Seferler(Sefer_id),
    FOREIGN KEY (Koltuk_id) REFERENCES Koltuklar(Koltuk_id)
);


CREATE TABLE Bilet_Log (
    Log_id INT AUTO_INCREMENT PRIMARY KEY,
    Bilet_id INT,
    Durum VARCHAR(20),
    Islem_tarihi DATETIME,
    FOREIGN KEY (Bilet_id) REFERENCES Biletler(Bilet_id)
);


-- SEFERYENILE() CALISTIRILINCA BU DA CALISIYOR OTOMATIK HER SEFERE 25 KOLTUK EKLIYOR
DELIMITER $$

CREATE PROCEDURE KoltuklariSefereEkle(IN yeni_sefer_id BIGINT)
BEGIN
    DECLARE koltuk_no BIGINT DEFAULT 1;

    WHILE koltuk_no <= 25 DO
        INSERT INTO Koltuklar (Koltuk_no, Sefer_id, Durum) VALUES (koltuk_no, yeni_sefer_id, 'Musait');
        SET koltuk_no = koltuk_no + 1;
    END WHILE;
END$$

DELIMITER ;

-- VERDIGIMIZ GUN KADAR SONRASINA YENI SEFERLER VE KOLTUKLARINI EKLIYOR
-- CALL SeferYenile(2)

DELIMITER $$

CREATE PROCEDURE SeferYenile(gun_sayisi INT)
BEGIN
    DECLARE next_date DATE;
    DECLARE sefer_varmi INT;
    DECLARE yeni_sefer_id BIGINT;

    -- Yarının tarihini al (bugünkü tarihe bir gün ekle)
    SET next_date = DATE_ADD(CURDATE(), INTERVAL gun_sayisi DAY);
    -- Yarın için sefer var mı diye kontrol et
    SELECT COUNT(*) INTO sefer_varmi FROM Seferler WHERE Tarih = next_date;

    -- Eğer yarın için sefer yoksa ekle
    IF sefer_varmi = 0 THEN
        -- ANKARA - BURSA
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 16, next_date, '00:00', '08:00', 1, '06A123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 16, next_date, '08:00', '16:00', 1, '06B123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 16, next_date, '16:00', '00:00', 1, '06C123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- ANKARA - ISTANBUL
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 34, next_date, '00:00', '08:00', 1, '06D123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 34, next_date, '08:00', '16:00', 1, '06E123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 34, next_date, '16:00', '00:00', 1, '06F123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);
        
		-- ANKARA - KOCAELI
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 41, next_date, '00:00', '08:00', 1, '06G123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 41, next_date, '08:00', '16:00', 1, '06H123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (6, 41, next_date, '16:00', '00:00', 1, '06I123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- BURSA - ANKARA
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (16, 06, next_date, '00:00', '08:00', 1, '16A123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (16, 06, next_date, '08:00', '16:00', 1, '16B123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES  (16, 06, next_date, '16:00', '00:00', 1, '16C123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- BURSA - ISTANBUL
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (16, 34, next_date, '00:00', '08:00', 1, '16D123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (16, 34, next_date, '08:00', '16:00', 1, '16E123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES  (16, 34, next_date, '16:00', '00:00', 1, '16F123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- BURSA - KOCAELI
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (16, 41, next_date, '00:00', '08:00', 1, '16G123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (16, 41, next_date, '08:00', '16:00', 1, '16H123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (16, 41, next_date, '16:00', '00:00', 1, '16I123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);
        
		-- ISTANBUL - ANKARA
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 06, next_date, '00:00', '08:00', 1, '34A123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 06, next_date, '08:00', '16:00', 1, '34B123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES   (34, 06, next_date, '16:00', '00:00', 1, '34C123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- ISTANBUL - BURSA
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 16, next_date, '00:00', '08:00', 1, '34D123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 16, next_date, '08:00', '16:00', 1, '34E123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 16, next_date, '16:00', '00:00', 1, '34F123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- ISTANBUL - KOCAELI
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 41, next_date, '00:00', '08:00', 1, '34G123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 41, next_date, '08:00', '16:00', 1, '34H123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (34, 41, next_date, '16:00', '00:00', 1, '34I123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);
        
		-- KOCAELI - ANKARA
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 06, next_date, '00:00', '08:00', 1, '41A123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 06, next_date, '08:00', '16:00', 1, '41B123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 06, next_date, '16:00', '00:00', 1, '06C123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- KOCAELI - BURSA
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 16, next_date, '00:00', '08:00', 1, '41D123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 16, next_date, '08:00', '16:00', 1, '41E123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 16, next_date, '16:00', '00:00', 1, '41F123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

		-- KOCAELI - ISTANBUL
        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 34, next_date, '00:00', '08:00', 1, '41G123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 34, next_date, '08:00', '16:00', 1, '41H123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);

        INSERT INTO Seferler (Kalkis_sehir, Varis_sehir, Tarih, Kalkis_saat, Varis_saat, Peron_no, Plaka, Kapasite, Dolu_koltuk, Bos_koltuk, Fiyat)
        VALUES (41, 34, next_date, '16:00', '00:00', 1, '41I123', 25, 0, 25, 300);
        SET yeni_sefer_id = LAST_INSERT_ID();
        CALL KoltuklariSefereEkle(yeni_sefer_id);
        
        
    END IF;
END$$

DELIMITER ;

-- BİLET AL PROSEDÜR

DELIMITER //

CREATE PROCEDURE biletal(
    IN p_yolcu_id INT,
    IN p_sefer_id INT,
    IN p_koltuk_no INT
)
BEGIN
    DECLARE pnr_kodu VARCHAR(50);
    DECLARE koltuk_durumu_val VARCHAR(255);
    DECLARE bilet_id_val INT;
    DECLARE kalkis_saat TIME;
    DECLARE koltuk_id_val INT; 
    DECLARE error_message VARCHAR(255); 

    -- Seferin kalkış saatinin alınması
    SELECT Kalkis_saat INTO kalkis_saat
    FROM Seferler
    WHERE Sefer_id = p_sefer_id;

    -- Yolcunun bilgilerini al
    SELECT 
        CONCAT(
            Kalkis_sehir,
            CASE 
                WHEN kalkis_saat <= '12:00:00' THEN 'ÖÖ'
                ELSE 'ÖS'
            END,
            DATE_FORMAT(NOW(), '%d%m%Y%H%i%s'),
            Peron_no,
            Plaka
        ) INTO pnr_kodu
    FROM Seferler
    WHERE Sefer_id = p_sefer_id;

    -- Koltuğun durumunu kontrol et
    SELECT Durum, Koltuk_id INTO koltuk_durumu_val, koltuk_id_val
    FROM Koltuklar
    WHERE Sefer_id = p_sefer_id AND Koltuk_no = p_koltuk_no;

    -- Koltuğun durumuna göre işlem yap
    IF koltuk_durumu_val = 'Rezerve' THEN
        -- Rezerve durumu
        IF koltuk_id_val IS NOT NULL AND koltuk_id_val = p_yolcu_id THEN
            -- Rezervasyon yapan yolcu aynı, satın alabilir
            UPDATE Koltuklar
            SET Durum = 'Satin Alindi',
                Yolcu_id = p_yolcu_id
            WHERE Sefer_id = p_sefer_id AND Koltuk_no = p_koltuk_no;

            UPDATE Biletler 
            SET PNR_kodu = pnr_kodu 
            WHERE Yolcu_id = p_yolcu_id AND Sefer_id = p_sefer_id AND Koltuk_id = koltuk_id_val;

            SELECT Bilet_id FROM Biletler WHERE Yolcu_id = p_yolcu_id AND Sefer_id = p_sefer_id AND Koltuk_id = koltuk_id_val INTO bilet_id_val;

            -- Bilet Log'a kaydet
            INSERT INTO Bilet_Log (Bilet_id, Durum, Islem_tarihi)
            VALUES (bilet_id_val, 'Satin Alindi', NOW());
        ELSE
            -- Hatalı rezervasyon durumu
            SET error_message = 'Bu koltuk başka bir yolcu tarafından rezerve edilmiş.';
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error_message;
        END IF;
    ELSE
        IF koltuk_durumu_val = 'Musait' THEN
            -- Koltuk müsait durumu
            -- Koltuk_id değerini al
            SELECT Koltuk_id INTO koltuk_id_val
            FROM Koltuklar
            WHERE Sefer_id = p_sefer_id AND Koltuk_no = p_koltuk_no;

            -- Eğer Koltuk_id bulunduysa devam et
            IF koltuk_id_val IS NOT NULL THEN
                -- Biletler tablosuna ekle
                INSERT INTO Biletler (PNR_kodu, Yolcu_id, Sefer_id, Koltuk_id)
                VALUES (pnr_kodu, p_yolcu_id, p_sefer_id, koltuk_id_val);

                SELECT LAST_INSERT_ID() INTO bilet_id_val;

                -- Koltuk durumunu güncelle
                UPDATE Koltuklar
                SET Durum = 'Satin Alindi',
                    Yolcu_id = p_yolcu_id
                WHERE Sefer_id = p_sefer_id AND Koltuk_no = p_koltuk_no;

                -- Bilet Log'a kaydet
                INSERT INTO Bilet_Log (Bilet_id, Durum, Islem_tarihi)
                VALUES (bilet_id_val, 'Satin Alindi', NOW());

                -- Sefer durumunu güncelle
                UPDATE Seferler
                SET Dolu_koltuk = Dolu_koltuk + 1,
                    Bos_koltuk = Bos_koltuk - 1
                WHERE Sefer_id = p_sefer_id;
            ELSE
                -- Koltuk_id bulunamadı
                SET error_message = 'Belirtilen Sefer ve Koltuk kombinasyonu bulunamadı.';
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error_message;
            END IF;
        END IF;
    END IF;
    
END //

DELIMITER ;


-- REZERVASYON PROSEDÜR
DELIMITER //

CREATE PROCEDURE rezervasyon(
    IN p_yolcu_id INT,
    IN p_sefer_id INT,
    IN p_koltuk_no INT
)
BEGIN
    DECLARE koltuk_durumu_val VARCHAR(255);
    DECLARE bilet_id_val INT;
    DECLARE sefer_tarihi DATE;

    -- Koltuğun durumunu kontrol et
    SELECT Durum INTO koltuk_durumu_val
    FROM Koltuklar
    WHERE Sefer_id = p_sefer_id AND Koltuk_no = p_koltuk_no;

    -- Seferin tarihini kontrol et
    SELECT Tarih INTO sefer_tarihi
    FROM Seferler
    WHERE Sefer_id = p_sefer_id;

    -- Koltuğun durumuna ve sefer tarihine göre işlem yap
    IF koltuk_durumu_val = 'Musait' AND DATEDIFF(sefer_tarihi, CURDATE()) > 2 THEN
        -- Koltuk müsait ve sefere 2 günden fazla süre var

        INSERT INTO Biletler (PNR_kodu, Yolcu_id, Sefer_id, Koltuk_id)
        VALUES (NULL, p_yolcu_id, p_sefer_id, (SELECT Koltuk_id FROM Koltuklar WHERE Sefer_id = p_sefer_id AND Koltuk_no = p_koltuk_no));

        SELECT LAST_INSERT_ID() INTO bilet_id_val;

        UPDATE Koltuklar
        SET Durum = 'Rezerve', Yolcu_id = p_yolcu_id
        WHERE Sefer_id = p_sefer_id AND Koltuk_no = p_koltuk_no;

        -- Bilet Log'u kaydet
        INSERT INTO Bilet_Log (Bilet_id, Durum, Islem_tarihi)
        VALUES (bilet_id_val, 'Rezerve', NOW());

        UPDATE Seferler
        SET Dolu_koltuk = Dolu_koltuk + 1,
            Bos_koltuk = Bos_koltuk - 1
        WHERE Sefer_id = p_sefer_id;

    ELSE
        -- Hatalı rezervasyon durumu
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Bu koltuk başka bir yolcu tarafından rezerve edilmiş veya sefere 2 günden az süre kalmış.';
    END IF;
END //

DELIMITER ;

-- ASKIYA AL PROSEDÜR (SATIN ALINAN BILETIN IPTALI)
DELIMITER //

CREATE PROCEDURE Askiya_Al(
    IN p_bilet_id INT
)
BEGIN
    DECLARE sefer_tarih DATE;
    DECLARE bilet_fiyat DECIMAL(10, 2);
    DECLARE yolcu_bakiye DECIMAL(10, 2);
    DECLARE kalan_gun INT;
    DECLARE p_sefer_id INT;
    DECLARE p_yolcu_id INT;
    DECLARE p_koltuk_id INT;

    -- Seferin tarihini ve diğer bilgileri al
    SELECT S.Tarih, B.Sefer_id, B.Yolcu_id, B.Koltuk_id
    INTO sefer_tarih, p_sefer_id, p_yolcu_id, p_koltuk_id
    FROM Seferler S
    JOIN Biletler B ON S.Sefer_id = B.Sefer_id
    WHERE B.Bilet_id = p_bilet_id;

    -- Kalan günü hesapla
    SET kalan_gun = DATEDIFF(sefer_tarih, CURDATE());

    -- Kontrol: En geç 1 gün öncesine kadar iptal edilebilir
    IF kalan_gun >= 1 THEN
        -- Biletin fiyatını ve yolcunun bakiyesini al
        SELECT Fiyat INTO bilet_fiyat
        FROM Seferler
        WHERE Sefer_id = p_sefer_id;

        SELECT Bakiye INTO yolcu_bakiye
        FROM Yolcular
        WHERE Yolcu_id = p_yolcu_id;

        -- İptal edilen (askıya alınan) biletin ücretini müşteri bakiyesine ekle
        UPDATE Yolcular
        SET Bakiye = Bakiye + bilet_fiyat
        WHERE Yolcu_id = p_yolcu_id;

        -- Bilet durumunu askıya al
        UPDATE Biletler SET koltuk_id= NULL
        WHERE Bilet_id = p_bilet_id;

        -- Koltuk durumunu güncelle
        UPDATE Koltuklar
        SET Durum = 'Musait', Yolcu_id = NULL
        WHERE Koltuk_id = p_koltuk_id;

        -- Bilet Log'u kaydet
        INSERT INTO Bilet_Log (Bilet_id, Durum, Islem_tarihi)
        VALUES (p_bilet_id, 'Askıya Alındı', NOW());

        -- Sefer bilgilerini güncelle
        UPDATE Seferler
        SET Dolu_koltuk = Dolu_koltuk - 1,
            Bos_koltuk = Bos_koltuk + 1
        WHERE Sefer_id = p_sefer_id;

    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'İptal işlemi en fazla 1 gün kala olmalıdır.';
    END IF;
END //

DELIMITER ;



-- 2 GUNDEN AZ KALDIYSA REZERVASYON IPTAL
DELIMITER //

CREATE PROCEDURE RezervasyonIptal()
BEGIN
    DECLARE seferIdVar INT;
    DECLARE biletIdVar INT;
    DECLARE yolcuIdVar INT;
    DECLARE koltukIdVar INT;

    -- Rezervasyonun iptal edileceği tarihi bul
    SELECT S.Sefer_id, B.Bilet_id, K.Yolcu_id, K.Koltuk_id
    INTO seferIdVar, biletIdVar, yolcuIdVar, koltukIdVar
    FROM Biletler B
    JOIN Koltuklar K ON B.Koltuk_id = K.Koltuk_id
    JOIN Seferler S ON B.Sefer_id = S.Sefer_id
    WHERE K.Durum = 'Rezerve'
    AND S.Tarih - CURDATE() <= 2;

    -- Eğer bulunduysa rezervasyonu iptal et ve koltuğu müsait duruma getir
    IF seferIdVar IS NOT NULL THEN
        UPDATE Koltuklar
        SET Durum = 'Musait'
        WHERE Koltuk_id = koltukIdVar;

        DELETE FROM Biletler
        WHERE Bilet_id = biletIdVar;

        -- Log tablosuna işlemi kaydet
        INSERT INTO Bilet_Log (Bilet_id, Durum, Islem_tarihi)
        VALUES (biletIdVar, 'Rezervasyon İptal Edildi', NOW());

        SELECT 'Rezervasyon iptali başarıyla gerçekleştirildi.' AS Result;
    ELSE
        SELECT 'Rezervasyon iptali için uygun bilet bulunamadı.' AS Result;
    END IF;
END //

DELIMITER ;


-- HER GUN OTOMATİK ÇALIŞIP 2 GUNDEN AZ KALAN REZERVASYONLARI IPTAL EDECEK
DELIMITER //

CREATE EVENT IF NOT EXISTS RezervasyonIptalEvent
ON SCHEDULE
    EVERY 1 DAY
    STARTS CURRENT_DATE
    COMMENT 'Bu olay, rezervasyon iptallerini kontrol etmek için her gün çalışır.'
DO
BEGIN
    CALL RezervasyonIptal();
END //

DELIMITER ;


-- BILETLERIN VIEW'I

CREATE VIEW Bilet_Log_View AS
SELECT
    BL.Log_id,
    BL.Bilet_id,
    B.PNR_kodu,
    Y.Ad AS Yolcu_Ad,
    Y.Soyad AS Yolcu_Soyad,
    S.Sefer_id,
    SKalkisSehir.Sehir_adi AS Kalkis_Sehir,
    SVarisSehir.Sehir_adi AS Varis_Sehir,
    S.Tarih AS Sefer_Tarihi,
    S.Kalkis_saat AS Kalkis_Saat,
    S.Peron_no AS Peron_No,
    K.Koltuk_no,
    BL.Durum,
    BL.Islem_tarihi
FROM
    Bilet_Log BL
    JOIN Biletler B ON BL.Bilet_id = B.Bilet_id
    JOIN Yolcular Y ON B.Yolcu_id = Y.Yolcu_id
    JOIN Seferler S ON B.Sefer_id = S.Sefer_id
    JOIN Sehirler SKalkisSehir ON S.Kalkis_sehir = SKalkisSehir.Plaka_kodu
    JOIN Sehirler SVarisSehir ON S.Varis_sehir = SVarisSehir.Plaka_kodu
    JOIN Koltuklar K ON B.Koltuk_id = K.Koltuk_id;




