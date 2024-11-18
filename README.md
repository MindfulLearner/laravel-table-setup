# Mini Documentazione per lavoreare con API Laravel

## Introduzione
Prima di procedeere alle cose complicate, è importante capire MVP (Minimum Viable Product), andremo prima a fare una base di front end che sia collegato a backend che sia funzionale al minimo necessario per il nostro sito.


# MVP Frontend

### Mandare i dati al backend
- **Login**: Effettua un POST al backend per il login, inviando un JSON con email e password.
- **Registrazione**: Effettua un POST al backend per la registrazione, includendo email, nome utente e doppia password.
- **Logout**: Effettua un POST al backend per il logout e cancella il cookie.

### Gestione dei dati in base al ruolo
Abbiamo tre tipi di utenti:

- **UR (Utente Registrato)**:
  - **GET**: `api/apartments` - Visualizza tutti gli appartamenti pubblici.
  - **POST**: `api/messages` - Invia un messaggio al backend che verrà salvato nel database delle chat.

- **URA (Utente Registrato con Appartamento)**:
  - **GET**: `api/apartments`, `api/messages`, `api/user` - Visualizza i dati pubblici, i propri dati personali e quelli dell'appartamento.
  - **POST**: `api/apartments` - Crea un nuovo appartamento.
  - **PUT**: `api/apartments` - Modifica i dati dell'appartamento.
  - **DELETE**: `api/apartments` - Cancella i dati dell'appartamento.

- **UI (Utente Interessato)**:
  - **GET**: `api/apartments` - Visualizza i dati pubblici.



# MVP backend

Quindi: 
### Ricezione dei Dati dal Frontend
- **Login**: Il frontend invia una richiesta POST al backend per il login. Il backend verifica l'esistenza dei dati e, se validi, invia un token come cookie al frontend.
- **Registrazione**: Il frontend invia una richiesta POST al backend per registrare un nuovo utente. Il backend crea l'utente con i dati forniti se non esistono già, altrimenti restituisce un errore.
- **Logout**: Il frontend invia una richiesta POST al backend per effettuare il logout. Il backend elimina il token e il frontend rimuove il cookie.

### Gestione dei Dati in Base al Ruolo
Abbiamo tre tipi di utenti:

- **UR (Utente Registrato)**: 
  - **GET**: Può visualizzare i dati.
  - **POST**: Può inviare messaggi ad altri utenti. I messaggi vengono gestiti dal backend e salvati nel database delle chat.

- **URA (Utente Registrato con Appartamento)**:
  - **GET**: Può visualizzare i propri dati personali e quelli dell'appartamento. Il backend invia i dati solo all'utente registrato con l'appartamento.
  - **POST**: Può creare o modificare appartamenti. Il backend consente queste operazioni solo se l'utente che le richiede è lo stesso associato all'appartamento.
  - **PUT**: Può modificare i dati dell'appartamento. Il backend esegue la modifica solo se l'utente è lo stesso associato all'appartamento.
  - **DELETE**: Può cancellare i dati dell'appartamento. Il backend esegue la cancellazione solo se l'utente è lo stesso associato all'appartamento.

- **UI (Utente Interessato)**:
  - **GET**: Può visualizzare solo i dati pubblici. Il backend invia solo i dati pubblici.



# API list:
- /api/user

## Struttura delle Tabelle

### Tabella `users`
- **ID**: `id` (Primary Key)
- **Email**: `email` (Unique)
- **Password**: `password`
- **Nome**: `first_name`
- **Cognome**: `last_name`
- **Data di Nascita**: `birth_date`

### Tabella `apartments`
- **ID**: `id` (Primary Key)
- **Proprietario**: `user_id` (Foreign Key, references `users.id`)
- **Titolo**: `title`
- **Numero di Stanze**: `rooms`
- **Numero di Letti**: `beds`
- **Numero di Bagni**: `bathrooms`
- **Metri Quadrati**: `square_meters`
- **Indirizzo**: `address`
- **Latitudine**: `latitude`
- **Longitudine**: `longitude`
- **Immagine**: `image`
- **Visibile**: `is_visible`

### Tabella `messages`
- **ID**: `id` (Primary Key)
- **Appartamento**: `apartment_id` (Foreign Key, references `apartments.id`)
- **Email Mittente**: `sender_email`
- **Messaggio**: `message`

### Tabella `sponsorships`
- **ID**: `id` (Primary Key)
- **Appartamento**: `apartment_id` (Foreign Key, references `apartments.id`)
- **Data Inizio**: `start_date`
- **Data Fine**: `end_date`
- **Pacchetto**: `package_type`

## Relazioni tra le Tabelle

- **`users`** può avere molti **`apartments`** (relazione uno-a-molti).
- **`apartments`** può avere molti **`messages`** (relazione uno-a-molti).
- **`apartments`** può avere molte **`sponsorships`** (relazione uno-a-molti).


