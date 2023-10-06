# Sessions

---

Het gebruik van sessions is voor een web ontwikkelaar onmisbaar. 
Sessions zijn heel handig, maar het kan ook voor verwarring zorgen. 

Het idee om een session klasse te gebruiken dient om het leven van de 
ontwikkelaar wat te vereenvoudigen, het laat immers toe om:
* Een overzicht bewaren van wat allemaal in mijn session bewaard kan/mag worden
* Toekennen van waarden gebeurt op één centrale plaats, niet meer wijd verspreid doorheen de codebase
* Nooit meer die vervelende `` session_start()`` method vergeten
* Security, session hijacking voorkomen
* Voor de ontwikkelaar, zelf bepalen waar session files bewaard worden
* En nog zo veel meer ...

Kortom dat sessions onmisbaar zijn dat staat kijf. Wat in deze voorbeeld klasse 
gebeurt is niks nieuws, ja kan hetzelfde ook zonder de klasse doen. De klasse 
groepeert de code zodat het overzicht duidelijker wordt en de ontwikkelaar helpt 
tijdens zijn/haar werk.