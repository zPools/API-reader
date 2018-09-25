# Not yet for public/productive use. Do not use this repo yet


Write a driver for the specific exchange (core/exchangename) or use existing one

Create a database for every exchange named like the exchange (name from within the exchange db)
 - ID (AUTO INCREMENT)
 - pull (INT)
 - coin (TEXT or VARCHAR)
 - price_btc (FLOAT)
 - price_usd (FLOAT)
 - date (DATETIME)
 
Create a database for exchange names and insert their names into it
 - ID (AUTO INCREMENT)
 - name (TEXT or VARCHAR)
 - link (TEXT or VARCHAR)
 - displayname (TEXT or VARCHAR)
 
Create a database for coin names
 - ID (INT)
 - name (VARCHAR)


Run the driver. Ask the exchanges how often you are allowed to pull. 
Important! Currently crex24 gets asked for the current USD/BTC price per driver-run.

Run update-coins at first startup and every ~24 hours. This will update the coin database with every coin that is within a exchange db.
This is very very slowly and needs improvements