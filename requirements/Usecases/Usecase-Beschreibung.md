| Registrieren                     |                    |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Registrierung mit E-Mail Adresse und persönlichen Daten? |
| Auslöser                  | Registrierungsformular ausfüllen |
| Eingehende Daten          | E-Mail Adresse / Name, Passwort, weitere Daten? |
| Vorbedingungen            | E-Mail-Bestätigung|
| Nachbedingungen, Ergebnis | Neuer Chef-Account mit leerem Raum angelegt |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. E-Mail senden <br/> 4. Account anlegen falls Bestätigung erhalten |
| Alternativszenarien       | Daten nach gewissem Zeitraum löschen wenn keine Bestätigung kommt |
| Sonstiges                 ||

| Login | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Anmelden mit Account und Passwortverifizierung |
| Auslöser                  | Anmelden |
| Eingehende Daten          | E-Mail Adresse / Name, Passwort |
| Vorbedingungen            | Registrierung (Chef), Personalaccount (Personal) |
| Nachbedingungen, Ergebnis | Zugang zum zugehörigen Raum in jeweiliger Rolle. Bei falschen Login-Daten Fehlermeldung |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Rückmeldung |
| Alternativszenarien       ||
| Sonstiges                 ||

| Personal hinzufügen | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Anlegen eines Personalaccounts im eigenen Raum |
| Auslöser                  | Chef will Personal erstellen |
| Eingehende Daten          | Eindeutiger Name, Passwort, E-Mail Adresse |
| Vorbedingungen            | Chef muss eingeloggt sein |
| Nachbedingungen, Ergebnis | Neuer Personalaccount im Raum erstellt |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Personalaccount erstellen <br/> 5. E-Mail mit Login-Daten versenden |
| Alternativszenarien       | 1. Ungültige E-Mail -> Fehlermeldung |
| Sonstiges                 ||

| Personal entfernen | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Löschen eines Personalaccounts im eigenen Raum |
| Auslöser                  | Chef will Personal löschen |
| Eingehende Daten          | Eindeutiger Name |
| Vorbedingungen            | Chef muss eingeloggt sein |
| Nachbedingungen, Ergebnis | Personalaccount im Raum gelöscht |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Personalaccount löschen |
| Alternativszenarien       ||
| Sonstiges                 ||

| Schichten verwalten | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Schichten im Kalender anlegen, ändern oder löschen |
| Auslöser                  | Chef will Schichtplan bearbeiten |
| Eingehende Daten          | Änderungen im Kalender |
| Vorbedingungen            | Chef muss eingeloggt sein |
| Nachbedingungen, Ergebnis | Änderungen werden übernommen |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Änderungen übernehmen <br/> 4. Personal benachrichtigen |
| Alternativszenarien       ||
| Sonstiges                 ||

| Zeiträume markieren | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Personal markiert einen Zeitraum, in dem es nicht verfügbar ist |
| Auslöser                  | Personal will Zeitraum markieren |
| Eingehende Daten          | Zeitraum (Datum / Zeit) |
| Vorbedingungen            | Personal muss eingeloggt sein |
| Nachbedingungen, Ergebnis | Chef sieht im Kalender im jeweiligen Zeitraum Markierung des jeweiligen Personals |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Zeitraum im Kalender markieren |
| Alternativszenarien       ||
| Sonstiges                 ||

| Schichten anbieten | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Personal kann eine Schicht, für die sie eingetragen wurde, dem anderen Personal anbieten |
| Auslöser                  | Personal will Schicht abgeben |
| Eingehende Daten          | Schicht, Personaldaten |
| Vorbedingungen            | 1. Personal muss eingeloggt sein <br/> 2. Personal muss in einer Schicht eingetragen sein |
| Nachbedingungen, Ergebnis | Schicht wird als "Angebot" markiert / Personal wird benachrichtigt |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Schicht markieren <br/> 4. Personal benachrichtigen |
| Alternativszenarien       ||
| Sonstiges                 ||

| Schichten übernehmen | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Personal kann eine Schicht, die Angeboten wird übernehmen |
| Auslöser                  | Personal will Schicht abgeben, Personal will schicht übernehmen |
| Eingehende Daten          | Schicht, Personaldaten |
| Vorbedingungen            | 1. Personal muss eingeloggt sein <br/> 2. Personal ist noch nicht in dieser Schicht eingetragen <br/> 3. Schicht muss angeboten werden <br/> |
| Nachbedingungen, Ergebnis | 1. "Angebot"-Markierung der Schicht wird entfernt <br/> 2. Schichtdaten werden geändert <br/> 3. Chef und Personal (Anbieter) wird benachrichtigt |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Schicht markieren <br/> 4. Personal benachrichtigen |
| Alternativszenarien       ||
| Sonstiges                 ||

| Bestätigungs-E-Mail senden | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Das System sendet eine E-Mail zur Bestätigung an einen neu registrierten User |
| Auslöser                  | Registrierungsformular wurde ausgefüllt |
| Eingehende Daten          | E-Mail-Adresse und weitere Daten |
| Vorbedingungen            | E-Mail-Adresse muss gültig sein |
| Nachbedingungen, Ergebnis | E-Mail wurde versand |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. E-Mail senden |
| Alternativszenarien       ||
| Sonstiges                 ||

| E-Mail mit Logindaten senden | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | Das System sendet eine E-Mail mit den Login-Daten an das jeweilige Personal |
| Auslöser                  | Chef erstellt neuen Personalaccount |
| Eingehende Daten          ||
| Vorbedingungen            | Neuer Personalaccount wurde erstellt |
| Nachbedingungen, Ergebnis | E-Mail wurde versand |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. E-Mail senden |
| Alternativszenarien       ||
| Sonstiges                 ||

| User benachrichtigen | |
| ----------------------    |--------------------|
| Kurzbeschreibung          | User über eine ihn betreffende Änderung benachrichtigen |
| Auslöser                  | Eine neue Änderung in Verbindung mit seinem Account wurde getätigt |
| Eingehende Daten          | Personalname |
| Vorbedingungen            ||
| Nachbedingungen, Ergebnis | Personal wurde benachrichtigt |
| Essentielle Schritte      | 1. Daten erfassen <br/> 2. Daten prüfen <br/> 3. Nachricht an Useraccount senden|
| Alternativszenarien       ||
| Sonstiges                 ||

