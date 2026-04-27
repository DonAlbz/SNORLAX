CREATE DATABASE IF NOT EXISTS snorlax CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

USE snorlax;

CREATE TABLE
    IF NOT EXISTS utente (
        id_utente INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        cognome VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        data_nascita DATE DEFAULT NULL,
        ruolo ENUM ('utente', 'admin') DEFAULT 'utente',
        data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS salute (
        id_salute INT AUTO_INCREMENT PRIMARY KEY,
        id_utente INT NOT NULL,
        freq_cardiaca INT DEFAULT NULL,
        temp_corporea DECIMAL(4, 1) DEFAULT NULL,
        qualita_sonno TINYINT DEFAULT NULL,
        data_rilevazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_utente) REFERENCES utente (id_utente) ON DELETE CASCADE,
        CHECK (qualita_sonno BETWEEN 1 AND 10)
    );

CREATE TABLE
    IF NOT EXISTS sonno (
        id_sonno INT AUTO_INCREMENT PRIMARY KEY,
        id_utente INT NOT NULL,
        ora_inizio DATETIME NOT NULL,
        ora_fine DATETIME DEFAULT NULL,
        fase_rem INT DEFAULT 0,
        fase_deep INT DEFAULT 0,
        score_notte TINYINT DEFAULT NULL,
        FOREIGN KEY (id_utente) REFERENCES utente (id_utente) ON DELETE CASCADE,
        CHECK (score_notte BETWEEN 1 AND 100)
    );

CREATE TABLE
    IF NOT EXISTS servizi_media (
        id_servizio INT AUTO_INCREMENT PRIMARY KEY,
        id_utente INT NOT NULL,
        tipo ENUM ('film', 'serie', 'musica', 'altro') NOT NULL,
        titolo VARCHAR(150) NOT NULL,
        url_stream VARCHAR(255) DEFAULT NULL,
        durata_minuti INT DEFAULT NULL,
        data_riproduzione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_utente) REFERENCES utente (id_utente) ON DELETE CASCADE
    );

CREATE TABLE
    IF NOT EXISTS sogni (
        id_sogno INT AUTO_INCREMENT PRIMARY KEY,
        id_sonno INT NOT NULL,
        descrizione_ai TEXT,
        emozione_rilevata VARCHAR(50) DEFAULT NULL,
        intensita TINYINT DEFAULT NULL,
        immagine_generata VARCHAR(255) DEFAULT NULL,
        data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_sonno) REFERENCES sonno (id_sonno) ON DELETE CASCADE,
        CHECK (intensita BETWEEN 1 AND 10)
    );

CREATE TABLE
    IF NOT EXISTS supporto_tech (
        id_ticket INT AUTO_INCREMENT PRIMARY KEY,
        id_utente INT NOT NULL,
        descrizione_problema TEXT NOT NULL,
        stato ENUM ('aperto', 'in_lavorazione', 'chiuso') DEFAULT 'aperto',
        priorita ENUM ('bassa', 'media', 'alta') DEFAULT 'media',
        data_apertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        data_chiusura TIMESTAMP NULL DEFAULT NULL,
        FOREIGN KEY (id_utente) REFERENCES utente (id_utente) ON DELETE CASCADE
    );

CREATE TABLE
    IF NOT EXISTS server (
        id_server INT AUTO_INCREMENT PRIMARY KEY,
        nome_server VARCHAR(100) NOT NULL,
        ip_address VARCHAR(45) NOT NULL,
        stato ENUM ('online', 'offline', 'manutenzione') DEFAULT 'online',
        carico_cpu DECIMAL(5, 2) DEFAULT NULL,
        ultimo_ping TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS ai_sessioni (
        id_sessione_ai INT AUTO_INCREMENT PRIMARY KEY,
        id_utente INT NOT NULL,
        tipo_analisi ENUM ('sogno', 'salute', 'sonno', 'consiglio') NOT NULL,
        risultato_json TEXT,
        tokens_usati INT DEFAULT 0,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_utente) REFERENCES utente (id_utente) ON DELETE CASCADE
    );

CREATE TABLE
    IF NOT EXISTS contatti_messaggi (
        id_messaggio INT AUTO_INCREMENT PRIMARY KEY,
        id_utente INT NULL,
        nome VARCHAR(50) NOT NULL,
        cognome VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        argomento VARCHAR(120) NOT NULL,
        messaggio TEXT NOT NULL,
        data_invio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_utente) REFERENCES utente (id_utente) ON DELETE SET NULL
    );

INSERT INTO
    utente (
        nome,
        cognome,
        email,
        password_hash,
        data_nascita,
        ruolo
    )
VALUES
    (
        'Elisa',
        'Rossi',
        'elisa@snorlax.it',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        '2005-03-15',
        'admin'
    ),
    (
        'Warna',
        'Bianchi',
        'warna@snorlax.it',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        '2005-07-22',
        'utente'
    ),
    (
        'Arman',
        'Ferrari',
        'arman@snorlax.it',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        '2005-11-08',
        'utente'
    ),
    (
        'Marco',
        'Verdi',
        'marco@test.it',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        '1990-05-12',
        'utente'
    ) ON DUPLICATE KEY
UPDATE nome =
VALUES
    (nome);

INSERT INTO
    sonno (
        id_utente,
        ora_inizio,
        ora_fine,
        fase_rem,
        fase_deep,
        score_notte
    )
VALUES
    (
        1,
        '2026-03-01 23:00:00',
        '2026-03-02 07:00:00',
        90,
        120,
        85
    ),
    (
        1,
        '2026-03-02 22:30:00',
        '2026-03-03 06:30:00',
        75,
        110,
        78
    ),
    (
        1,
        '2026-03-03 23:15:00',
        '2026-03-04 07:15:00',
        100,
        130,
        92
    ),
    (
        1,
        '2026-03-04 22:00:00',
        '2026-03-05 06:00:00',
        60,
        90,
        70
    ),
    (
        1,
        '2026-03-05 23:30:00',
        '2026-03-06 07:30:00',
        95,
        125,
        88
    ),
    (
        2,
        '2026-03-05 22:00:00',
        '2026-03-06 06:30:00',
        80,
        100,
        82
    ),
    (
        3,
        '2026-03-05 23:00:00',
        '2026-03-06 07:00:00',
        85,
        115,
        87
    );

INSERT INTO
    salute (
        id_utente,
        freq_cardiaca,
        temp_corporea,
        qualita_sonno
    )
VALUES
    (1, 62, 36.5, 9),
    (1, 65, 36.6, 8),
    (1, 60, 36.4, 9),
    (2, 70, 36.7, 7),
    (3, 68, 36.5, 8);

INSERT INTO
    sogni (
        id_sonno,
        descrizione_ai,
        emozione_rilevata,
        intensita
    )
VALUES
    (
        1,
        'Hai sognato di volare sopra una città futuristica illuminata da luci blu e viola. Edifici altissimi con giardini pensili. Sensazione di libertà assoluta.',
        'gioia',
        8
    ),
    (
        2,
        'Un labirinto infinito di specchi in cui ogni riflessione mostrava una versione diversa di te. Musica lontana guidava i tuoi passi verso una luce dorata.',
        'curiosità',
        6
    ),
    (
        3,
        'Oceano cristallino con creature bioluminescenti. Respiravi sott acqua senza difficoltà. Il fondale era fatto di cristalli viola che cantavano.',
        'serenità',
        9
    ),
    (
        4,
        'Una foresta antica dove gli alberi parlavano in una lingua sconosciuta ma comprensibile. Un cervo bianco ti guidava verso una radura illuminata dalla luna.',
        'meraviglia',
        7
    ),
    (
        5,
        'Sei su una stazione spaziale che orbita attorno a un pianeta viola. Vedi la Terra da lontano e senti nostalgia mista ad eccitazione per l esplorazione.',
        'nostalgia',
        8
    );

INSERT INTO
    servizi_media (id_utente, tipo, titolo, durata_minuti)
VALUES
    (1, 'film', 'Inception', 148),
    (1, 'serie', 'Dark - S01E01', 53),
    (1, 'musica', 'Lofi Sleep Mix', 120),
    (2, 'film', 'Interstellar', 169),
    (3, 'serie', 'Stranger Things - S04E01', 78);

INSERT INTO
    server (nome_server, ip_address, stato, carico_cpu)
VALUES
    ('Snorlax-Main', '192.168.1.1', 'online', 23.5),
    ('Snorlax-AI', '192.168.1.2', 'online', 67.2),
    ('Snorlax-Media', '192.168.1.3', 'online', 41.8),
    (
        'Snorlax-Backup',
        '192.168.1.4',
        'manutenzione',
        0.0
    );

INSERT INTO
    supporto_tech (id_utente, descrizione_problema, stato, priorita)
VALUES
    (
        2,
        'Il braccio meccanico non risponde al comando vocale',
        'aperto',
        'alta'
    ),
    (
        3,
        'La registrazione dei sogni si interrompe dopo 2 ore',
        'in_lavorazione',
        'media'
    ),
    (
        4,
        'Problemi di connessione al servizio streaming',
        'chiuso',
        'bassa'
    );

INSERT INTO
    ai_sessioni (
        id_utente,
        tipo_analisi,
        risultato_json,
        tokens_usati
    )
VALUES
    (
        1,
        'sogno',
        '{"sentiment":"positivo","keywords":["volo","liberta","futuro"],"suggerimento":"Il tuo subconscio esprime desiderio di liberta e crescita."}',
        245
    ),
    (
        1,
        'salute',
        '{"stato":"ottimo","freq_media":62,"consiglio":"Mantieni l orario di sonno attuale, stai dormendo benissimo."}',
        180
    ),
    (
        2,
        'consiglio',
        '{"tipo":"routine","suggerimento":"Prova a spegnere i dispositivi 30 minuti prima di dormire."}',
        120
    );