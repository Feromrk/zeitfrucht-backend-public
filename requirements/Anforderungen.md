# Funktionale Anforderungen

- Funktion 1
  - Beschreibung: <br/>
    Ein User kann sich registrieren und ist dann der "Chef" in seinem Raum. Er hat einen eigenen Kalender, den er verwaltet. (Verwalten = Einträge im Kalender bearbeiten)
  - Bedingung: <br/>
    Eindeutige User-Accounts mit Login.
    
- Funktion 2
  - Beschreibung: <br/>
    Chef kann Personalaccounts in seinem Raum erstellen. Ein Personalaccount hat einen einzigartigen Namen und ein Passwort.
  - Bedingung: <br/>
    Räume müssen auf dem Server verwaltet werden. Jeder Chef und jeder Personalaccount ist jeweils EINEM Raum zugeordnet.
  
- Funktion 3
  - Beschreibung: <br/>
    Personal kann in die einzelnen Tage mit Uhrzeit eingetragen und gelöscht werden. (Personal + Uhrzeit = Schicht) 
  - Bedingung: <br/>
    Die Kalendereinträge werden auf dem Server gespeichert.
    
- Funktion 4
  - Beschreibung: <br/>
    Personal kann sich für Zeiträume markieren. (Ob sie eingetragen werden wollen oder nicht.)
    
- Funktion 5
  - Beschreibung: <br/>
    Personal wird benachrichtigt sobald es eine Änderung gab, die sie betrifft. Chef wird bei jeder Änderung in seinem Kalender (Funktion 6) benachrichtigt.
  - Bedingung: <br/>
    Für jeden Account gibt es einen Newsfeed.
    
- Funktion 6
  - Beschreibung: <br/>
    Personal kann Schichten tauschen. Schichten können von anderen Personal übernommen werden (auch ohne Tausch). Zustimmung ist auf beiden Seiten erforderlich.
    
# Nichtfunktionale Anforderungen

- Aussehen
  - Jede Ansicht soll sehr übersichtlich und nicht überladen sein. Auch (oder vorallem) auf einem kleinen Bildschirm (Smartphone) sollte es übersichtlich bleiben.
  - Die Anwendung an sich sollte farblich dezent gehalten werden. Da die Verfügbarkeit der User im Kalender eventuell farblich dargestellt werden soll, könnte es sonst insgesamt zu bunt werden.
- Bedienung
  - Intuitiv natürlich ;)
- Zuverlässigkeit und Geschwindigkeit
  - Daten des jeweiligen Users könnten auf dem persönlichen Gerät gespeichert werden falls der Server nicht erreichbar ist.
- Sicherheit
  - Encryption everywhere
