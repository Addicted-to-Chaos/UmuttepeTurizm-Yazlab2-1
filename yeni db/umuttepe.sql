-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 19 Mar 2024, 13:20:42
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `umuttepe`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Askiya_Al` (IN `p_bilet_id` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `biletal` (IN `p_yolcu_id` INT, IN `p_sefer_id` INT, IN `p_koltuk_no` INT)   BEGIN
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
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `KoltuklariSefereEkle` (IN `yeni_sefer_id` BIGINT)   BEGIN
    DECLARE koltuk_no BIGINT DEFAULT 1;

    WHILE koltuk_no <= 25 DO
        INSERT INTO Koltuklar (Koltuk_no, Sefer_id, Durum) VALUES (koltuk_no, yeni_sefer_id, 'Musait');
        SET koltuk_no = koltuk_no + 1;
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rezervasyon` (IN `p_yolcu_id` INT, IN `p_sefer_id` INT, IN `p_koltuk_no` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RezervasyonIptal` ()   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SeferYenile` (`gun_sayisi` INT)   BEGIN
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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `biletler`
--

CREATE TABLE `biletler` (
  `Bilet_id` int(11) NOT NULL,
  `PNR_kodu` varchar(50) DEFAULT NULL,
  `Yolcu_id` int(11) DEFAULT NULL,
  `Sefer_id` int(11) DEFAULT NULL,
  `Koltuk_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `biletler`
--

INSERT INTO `biletler` (`Bilet_id`, `PNR_kodu`, `Yolcu_id`, `Sefer_id`, `Koltuk_id`) VALUES
(7, 'VC7RP5', 3, 1, 11),
(8, 'PPT2MZ', 3, 1, 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bilet_log`
--

CREATE TABLE `bilet_log` (
  `Log_id` int(11) NOT NULL,
  `Bilet_id` int(11) DEFAULT NULL,
  `Durum` varchar(20) DEFAULT NULL,
  `Islem_tarihi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `bilet_log`
--

INSERT INTO `bilet_log` (`Log_id`, `Bilet_id`, `Durum`, `Islem_tarihi`) VALUES
(1, 7, 'Satin Alindi', '2024-03-18 22:33:23'),
(2, 8, 'Rezerve', '2024-03-18 23:17:10');

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `bilet_log_view`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `bilet_log_view` (
`Log_id` int(11)
,`Bilet_id` int(11)
,`PNR_kodu` varchar(50)
,`Yolcu_Ad` varchar(255)
,`Yolcu_Soyad` varchar(255)
,`Sefer_id` int(11)
,`Kalkis_Sehir` varchar(255)
,`Varis_Sehir` varchar(255)
,`Sefer_Tarihi` date
,`Kalkis_Saat` time
,`Peron_No` int(11)
,`Koltuk_no` int(11)
,`Durum` varchar(20)
,`Islem_tarihi` datetime
);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `koltuklar`
--

CREATE TABLE `koltuklar` (
  `Koltuk_id` int(11) NOT NULL,
  `Koltuk_no` int(11) DEFAULT NULL,
  `Sefer_id` int(11) DEFAULT NULL,
  `Yolcu_id` int(11) DEFAULT NULL,
  `Durum` enum('Rezerve','Satin Alindi','Musait') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `koltuklar`
--

INSERT INTO `koltuklar` (`Koltuk_id`, `Koltuk_no`, `Sefer_id`, `Yolcu_id`, `Durum`) VALUES
(1, 1, 1, NULL, 'Musait'),
(2, 2, 1, NULL, 'Musait'),
(3, 3, 1, NULL, 'Musait'),
(4, 4, 1, NULL, 'Musait'),
(5, 5, 1, NULL, 'Musait'),
(6, 6, 1, NULL, 'Musait'),
(7, 7, 1, NULL, 'Musait'),
(8, 8, 1, NULL, 'Musait'),
(9, 9, 1, NULL, 'Musait'),
(10, 10, 1, NULL, 'Musait'),
(11, 11, 1, 3, 'Satin Alindi'),
(12, 12, 1, NULL, 'Musait'),
(13, 13, 1, NULL, 'Musait'),
(14, 14, 1, NULL, 'Musait'),
(15, 15, 1, 3, 'Rezerve'),
(16, 16, 1, NULL, 'Musait'),
(17, 17, 1, NULL, 'Musait'),
(18, 18, 1, NULL, 'Musait'),
(19, 19, 1, NULL, 'Musait'),
(20, 20, 1, NULL, 'Musait'),
(21, 21, 1, NULL, 'Musait'),
(22, 22, 1, NULL, 'Musait'),
(23, 23, 1, NULL, 'Musait'),
(24, 24, 1, NULL, 'Musait'),
(25, 25, 1, NULL, 'Musait');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seferler`
--

CREATE TABLE `seferler` (
  `Sefer_id` int(11) NOT NULL,
  `Kalkis_sehir` int(11) DEFAULT NULL,
  `Varis_sehir` int(11) DEFAULT NULL,
  `Tarih` date DEFAULT NULL,
  `Kalkis_saat` time DEFAULT NULL,
  `Varis_saat` time DEFAULT NULL,
  `Peron_no` int(11) DEFAULT NULL,
  `Plaka` varchar(15) DEFAULT NULL,
  `Kapasite` int(11) DEFAULT NULL,
  `Dolu_koltuk` int(11) DEFAULT NULL CHECK (`Dolu_koltuk` >= 0),
  `Bos_koltuk` int(11) DEFAULT NULL CHECK (`Bos_koltuk` >= 0),
  `Fiyat` decimal(10,2) DEFAULT NULL CHECK (`Fiyat` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `seferler`
--

INSERT INTO `seferler` (`Sefer_id`, `Kalkis_sehir`, `Varis_sehir`, `Tarih`, `Kalkis_saat`, `Varis_saat`, `Peron_no`, `Plaka`, `Kapasite`, `Dolu_koltuk`, `Bos_koltuk`, `Fiyat`) VALUES
(1, 34, 6, '2024-03-29', '03:43:00', '19:30:00', 5, '12321534', NULL, 0, NULL, 350.00),
(2, 6, 34, '2024-03-12', '12:00:00', '18:00:00', 5, '41APK123', 5, 0, NULL, 370.00),
(3, 6, 34, '2024-03-12', '12:00:00', '18:00:00', 5, '41APK123', 5, 0, NULL, 370.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sehirler`
--

CREATE TABLE `sehirler` (
  `Plaka_kodu` int(11) NOT NULL,
  `Sehir_adi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sehirler`
--

INSERT INTO `sehirler` (`Plaka_kodu`, `Sehir_adi`) VALUES
(6, 'Ankara'),
(16, 'Bursa'),
(34, 'Istanbul'),
(41, 'Kocaeli');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yolcular`
--

CREATE TABLE `yolcular` (
  `Yolcu_id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Sifre` varchar(255) DEFAULT NULL,
  `Ad` varchar(255) DEFAULT NULL,
  `Soyad` varchar(255) DEFAULT NULL,
  `Telefon` varchar(15) DEFAULT NULL,
  `Tc` varchar(20) DEFAULT NULL,
  `Yas` int(11) DEFAULT NULL CHECK (`Yas` >= 0),
  `Cinsiyet` enum('Erkek','Kadın') DEFAULT NULL,
  `Bakiye` decimal(10,2) DEFAULT NULL CHECK (`Bakiye` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yolcular`
--

INSERT INTO `yolcular` (`Yolcu_id`, `Email`, `Sifre`, `Ad`, `Soyad`, `Telefon`, `Tc`, `Yas`, `Cinsiyet`, `Bakiye`) VALUES
(1, 'ornek@email.com', '123', 'Ahmet', 'Yılmaz', '5551234567', '1234567890', 25, 'Erkek', 0.00),
(2, 'ornekk@email.com', '123', 'Veli', 'Veli', '5551234568', '1234567898', 25, 'Erkek', 0.00),
(3, 'admin@gmail.com', '123', 'admin', 'admin', '0500000000', '11111111111', 550, 'Erkek', 8750.00),
(4, 'edaobuzz@gmail.com', '123', 'Eda', 'Obuz', '0545555555', '11111111111', 0, 'Kadın', NULL);

-- --------------------------------------------------------

--
-- Görünüm yapısı `bilet_log_view`
--
DROP TABLE IF EXISTS `bilet_log_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bilet_log_view`  AS SELECT `bl`.`Log_id` AS `Log_id`, `bl`.`Bilet_id` AS `Bilet_id`, `b`.`PNR_kodu` AS `PNR_kodu`, `y`.`Ad` AS `Yolcu_Ad`, `y`.`Soyad` AS `Yolcu_Soyad`, `s`.`Sefer_id` AS `Sefer_id`, `skalkissehir`.`Sehir_adi` AS `Kalkis_Sehir`, `svarissehir`.`Sehir_adi` AS `Varis_Sehir`, `s`.`Tarih` AS `Sefer_Tarihi`, `s`.`Kalkis_saat` AS `Kalkis_Saat`, `s`.`Peron_no` AS `Peron_No`, `k`.`Koltuk_no` AS `Koltuk_no`, `bl`.`Durum` AS `Durum`, `bl`.`Islem_tarihi` AS `Islem_tarihi` FROM ((((((`bilet_log` `bl` join `biletler` `b` on(`bl`.`Bilet_id` = `b`.`Bilet_id`)) join `yolcular` `y` on(`b`.`Yolcu_id` = `y`.`Yolcu_id`)) join `seferler` `s` on(`b`.`Sefer_id` = `s`.`Sefer_id`)) join `sehirler` `skalkissehir` on(`s`.`Kalkis_sehir` = `skalkissehir`.`Plaka_kodu`)) join `sehirler` `svarissehir` on(`s`.`Varis_sehir` = `svarissehir`.`Plaka_kodu`)) join `koltuklar` `k` on(`b`.`Koltuk_id` = `k`.`Koltuk_id`)) ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `biletler`
--
ALTER TABLE `biletler`
  ADD PRIMARY KEY (`Bilet_id`),
  ADD KEY `Yolcu_id` (`Yolcu_id`),
  ADD KEY `Sefer_id` (`Sefer_id`),
  ADD KEY `Koltuk_id` (`Koltuk_id`);

--
-- Tablo için indeksler `bilet_log`
--
ALTER TABLE `bilet_log`
  ADD PRIMARY KEY (`Log_id`),
  ADD KEY `Bilet_id` (`Bilet_id`);

--
-- Tablo için indeksler `koltuklar`
--
ALTER TABLE `koltuklar`
  ADD PRIMARY KEY (`Koltuk_id`),
  ADD KEY `Sefer_id` (`Sefer_id`),
  ADD KEY `Yolcu_id` (`Yolcu_id`);

--
-- Tablo için indeksler `seferler`
--
ALTER TABLE `seferler`
  ADD PRIMARY KEY (`Sefer_id`),
  ADD KEY `Kalkis_sehir` (`Kalkis_sehir`),
  ADD KEY `Varis_sehir` (`Varis_sehir`);

--
-- Tablo için indeksler `sehirler`
--
ALTER TABLE `sehirler`
  ADD PRIMARY KEY (`Plaka_kodu`);

--
-- Tablo için indeksler `yolcular`
--
ALTER TABLE `yolcular`
  ADD PRIMARY KEY (`Yolcu_id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `biletler`
--
ALTER TABLE `biletler`
  MODIFY `Bilet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `bilet_log`
--
ALTER TABLE `bilet_log`
  MODIFY `Log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `koltuklar`
--
ALTER TABLE `koltuklar`
  MODIFY `Koltuk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `seferler`
--
ALTER TABLE `seferler`
  MODIFY `Sefer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `yolcular`
--
ALTER TABLE `yolcular`
  MODIFY `Yolcu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `biletler`
--
ALTER TABLE `biletler`
  ADD CONSTRAINT `biletler_ibfk_1` FOREIGN KEY (`Yolcu_id`) REFERENCES `yolcular` (`Yolcu_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `biletler_ibfk_2` FOREIGN KEY (`Sefer_id`) REFERENCES `seferler` (`Sefer_id`),
  ADD CONSTRAINT `biletler_ibfk_3` FOREIGN KEY (`Koltuk_id`) REFERENCES `koltuklar` (`Koltuk_id`);

--
-- Tablo kısıtlamaları `bilet_log`
--
ALTER TABLE `bilet_log`
  ADD CONSTRAINT `bilet_log_ibfk_1` FOREIGN KEY (`Bilet_id`) REFERENCES `biletler` (`Bilet_id`);

--
-- Tablo kısıtlamaları `koltuklar`
--
ALTER TABLE `koltuklar`
  ADD CONSTRAINT `koltuklar_ibfk_1` FOREIGN KEY (`Sefer_id`) REFERENCES `seferler` (`Sefer_id`),
  ADD CONSTRAINT `koltuklar_ibfk_2` FOREIGN KEY (`Yolcu_id`) REFERENCES `yolcular` (`Yolcu_id`);

--
-- Tablo kısıtlamaları `seferler`
--
ALTER TABLE `seferler`
  ADD CONSTRAINT `seferler_ibfk_1` FOREIGN KEY (`Kalkis_sehir`) REFERENCES `sehirler` (`Plaka_kodu`),
  ADD CONSTRAINT `seferler_ibfk_2` FOREIGN KEY (`Varis_sehir`) REFERENCES `sehirler` (`Plaka_kodu`);

DELIMITER $$
--
-- Olaylar
--
CREATE DEFINER=`root`@`localhost` EVENT `RezervasyonIptalEvent` ON SCHEDULE EVERY 1 DAY STARTS '2024-03-19 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Bu olay, rezervasyon iptallerini kontrol etmek için her gün çalı' DO BEGIN
    CALL RezervasyonIptal();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
