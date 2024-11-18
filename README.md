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

  ### Struttura degli appartamenti per il frontend
  - **id**: ID dell'appartamento
  - **stanze**: Numero di stanze
  - **letti**: Numero di letti
  - **bagni**: Numero di bagni
  - **metri_quadrati**: Metri quadrati
  - **indirizzo**: Indirizzo completo con latitudine e longitudine
  - **immagine**: Immagine rappresentativa
  - **servizi_aggiuntivi**: Uno o più servizi aggiuntivi (es. WiFi, piscina, portineria, vista mare)
  - **visibile**: Sì o No


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
### API nostri di laravel
Post: 
- /api/login -> effettua il login
- /api/register -> effettua la registrazione
- /api/logout -> effettua il logout
- /api/message -> invia un messaggio
- /api/apartments -> crea un nuovo appartamento (solo per URA)

Get:
- /api/user -> mostra i dati dell'utente registrato, inclusi nome, email e ruolo
- /api/apartments -> mostra tutti gli appartamenti pubblici disponibili
- /api/messages -> mostra tutti i messaggi inviati e ricevuti dall'utente
- /api/apartments/{id} -> mostra i dettagli di un appartamento specifico (solo per URA e UR)

Put:
- /api/apartments/{id} -> modifica un appartamento specifico (solo per URA)
- /api/user -> modifica i dati dell'utente registrato (solo per UR)

Delete:
- /api/apartments/{id} -> cancella un appartamento specifico (solo per URA)

### API esterne



## DB Show
![image](https://github.com/user-attachments/assets/9e78a1d4-bb41-4913-9b38-74e57d25acb8)


## Struttura delle Tabelle

### Tabella `users`
- **ID**: `id` (Primary Key)
- **Email**: `email` (Unique)
- **Password**: `password`
- **Nome**: `first_name`
- **Cognome**: `last_name`
- **Ruolo**: `role` // UI, UR, URA
- **Data di Nascita**: `birth_date`

### Tabella `apartments`
- **ID**: `id` (Primary Key)
- **Proprietario**: `user_id` (Foreign Key, references `users.id`)
- **Servizi Aggiuntivi**: `additional_services` (Foreign Key, references `services.id`)
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

### Tabella `services`
- **ID**: `id` (Primary Key)
- **Nome**: `name`

### Tabella `messages`
- **ID**: `id` (Primary Key)
- **Appartamento**: `apartment_id` (Foreign Key, references `apartments.id`)
- **Utente Mittente**: `user_id` (Foreign Key, references `users.id`)
- **Email Mittente**: `sender_email`
- **Messaggio**: `message`

### Tabella `statistics`
- **ID**: `id` (Primary Key)
- **Appartamento**: `apartment_id` (Foreign Key, references `apartments.id`)
- **Data**: `date`
- **Visite**: `views`

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


