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

Password: password

Riepilogo veloce

Copia la cartella in htdocs
Avvia Apache e MySQL
Importa database.sql
Controlla config.php
Apri http://localhost/snorlax

Il sito è ora pronto per essere utilizzato.

ENGLISH

Snorlax Installation Guide

This guide will walk you through installing the Snorlax website on your computer, step by step.
Before you begin, you need to install XAMPP — a free program that lets you run a website on your own computer (without needing the internet). It comes with everything you need built in.


Step 1 – Install XAMPP

Download XAMPP from the official website and follow the installation steps.
Once installed, open the program called "XAMPP Control Panel".

Step 2 – Copy the project files

Download the Snorlax project from GitHub (either by clicking "Download ZIP" or using the command `git pull origin`).
Then copy the **"Snorlax" folder** into this location on your computer:
`xampp/htdocs`
Think of `htdocs` as the folder where XAMPP looks for websites to run.

Step 3 – Start the services

Open the XAMPP Control Panel and click "Start" next to both:
- Apache – this is the web server (it "serves" the website to your browser)
- MySQL – this is the database (it stores all the website's data)

Both should turn green when running correctly.

Step 4 – Set up the database

The database is like a filing cabinet that holds all the website's information. You need to fill it with the right data first.
Easy method (recommended):
1. Open your browser (Chrome, Firefox, etc.)
2. Go to: `http://localhost/phpmyadmin`
3. Create a new database — you can choose any name you like
4. Click "Import"
5. Select the file called **"database.sql"** from the Snorlax project folder
6. Click the button to start the import

Alternative method (using the terminal):
1. Open a terminal (Command Prompt on Windows)
2. Type: `mysql -u root`
3. Then type: `source path/to/database.sql;` (replace with the actual location of the file)

Step 5 – Check the configuration file

Open the file called "config.php" inside the Snorlax project folder.
Make sure the database details listed there (database name, username, and password) match what you set up in the previous step.

If you didn't set a password in XAMPP, the password field is usually left blank.

Step 6 – Open the website

Open your browser and go to:
`http://localhost/snorlax`
If everything is set up correctly, the Snorlax website will load.

Demo login credentials

Use these to log in and try the website:
- **Email:** warna@snorlax.it
- **Password:** password

Quick checklist
- [ ] Copy the Snorlax folder into `htdocs`
- [ ] Start Apache and MySQL in XAMPP
- [ ] Import `database.sql` into your database
- [ ] Check `config.php` is correct
- [ ] Open `http://localhost/snorlax` in your browser

You're all set — the website is ready to use!