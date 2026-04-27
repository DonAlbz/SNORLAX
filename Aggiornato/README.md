Manuale di installazione – Applicativo Snorlax

Questo manuale guida passo passo all’installazione del sito Snorlax (PHP + MySQL) in modo semplice e chiaro.

Prima di iniziare, è necessario installare XAMPP, un programma che permette di far funzionare il sito in locale. XAMPP include tutto il necessario: Apache (server web), MySQL (database) e phpMyAdmin (gestione database).

1. Installazione di XAMPP
Scaricare XAMPP dal sito ufficiale e completare l’installazione.
Una volta installato, aprire il programma “XAMPP Control Panel”.

2. Copia del progetto
Scaricare il progetto da GitHub (tramite download o comando “git pull origin”).
Copiare la cartella del progetto “Snorlax” dentro questa cartella:
xampp/htdocs

3. Avvio dei servizi
Aprire XAMPP Control Panel e cliccare su “Start” per:
Apache
MySQL

Entrambi devono risultare attivi (in verde).

4. Creazione del database
Metodo semplice (consigliato):
Aprire il browser
Andare su: http://localhost/phpmyadmin
Creare un nuovo database (nome a scelta, se non specificato)
Cliccare su “Importa”
Selezionare il file “database.sql” presente nel progetto
Avviare l’importazione

Metodo alternativo (terminale):

Aprire il terminale
Digitare: mysql -u root
Eseguire: source percorso/del/file/database.sql;

5. Configurazione
Aprire il file “config.php” presente nel progetto e controllare che i dati del database (nome, utente, password) siano corretti.

6. Avvio del sito
Aprire il browser e digitare:
http://localhost/snorlax

Se tutto è corretto, il sito si aprirà.

Accesso demo
Email: warna@snorlax.it

Password: password123

Riepilogo veloce

Copia la cartella in htdocs
Avvia Apache e MySQL
Importa database.sql
Controlla config.php
Apri http://localhost/snorlax

Il sito è ora pronto per essere utilizzato.