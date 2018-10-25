# JS and PHP queue managment with activeMQ

In this exercise:
A javscript client app sends messages (data) to a queue on activeMQ, while another PHP server app is subscribed to the same queue and consumes any new messages arriving from the client app.  
 
## In bullet points
- Client app sends data via stomp on websockets
- Data arrives at queue on activeMQ
- Server app detects new data arrival - extracts it and saves it to database
- Client app is polling the same database every 5 seconds and updates dom accordingly

### To run this locally:
#### Setup:
- Create mysql db schema name "notes_board"
- Inside "notes_board" schema create table named "notes" with following fields:
    - id - INT(11), PK, autoIncrement 
    - date - VARCHAR(100) 
    - time - VARCHAR(100) 
    - noteInput - VARCHAR(300) 
- Inside 'client/client/scripts' folder create a file name env.js and inside it define vaiable like so:
    - const env = { STOMP_URL: *your chosen stomp websocket url here*} (e.g "ws://*some ip address*:61614/stomp")

- Inside 'server' and 'client' folders create an "env_vars.php" file, and inside it define following constants (according to your environment variables):
    - DB_HOST
    - DB_USER
    - DB_PASS
- In server/env_vars.php ONLY define:
    - BROKER_URI (typically configured as transporter in conf/activemq.xml)
    
#### Run:
- Run activeMQ (/bin/activemq start)
- Run apache server with mysql
- Open client app (client/index.php)
- Fill the form and send notes to queue 
- Open server app (server/index.php) - all unread notes will be read and delivered to db
- Client app will poll db every 5 seconds and update all newly inserted notes on dom


#### Note: the server app doesnt poll and needs to be refreshed to read new messages on queue 

#### access activeMQ console at localhost:8161 (while its up and running) 