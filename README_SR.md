# Import baze 
Da biste mogli da pokrenete aplikaciju prvo je klonirajte.
Klonirani repozitorijum stavite u htdocs.

-Pokrenite vaš XAMPP ili neki web server koji koristite za db host. **Fajl za bazu se nalazi u root folderu repozitorijuma.** Baza se može importovati preko opcije **Import** na phpmyadmin. Baza se automatski kreira i taj proces je inicijalizovan na osnovu prve dve linije koda fajla **hotel.sql**.

Korisnike aplikacije možete naći u tabeli pod imenom "radnici".

**Prečica za logovanje kao admin** 
```
-Korisničko ime: enginious1
-Šifra: hotel2
```
Aplikacija je podešena. Unesite nekoliko gosta, napravite rezervaciju, kalkulaciju za hotel, izdajte račun, itd...

## Opis aplikacije "hotel"

Glavni cilj ove aplikacije jeste da administrator/korisnik ima odredjene mogućnosti, odnosno nemogućnosti. To sam odobravao preko sesija na pojedinim stranicama. 

PHPmailer automatski šalje mejl kada se admin/korisnik ulogovao. Za sada, tu je najjednostavniji test-mejl koji ukazuje da li se korisnik uspešno ulogovao. Stranica koja sledi posle logovanja je "dashboard.php", čija je uloga mape aplikacije. Navigacioni bar takodje ima tu ulogu. 

CRUD je odrađen za celu aplikaciju. 

Opcije koje su trenutno dostupne: CRUD sobe.php, CRUD guests.php, CRUD rezervacije.php, CRUD usluge.php, CRUD zaposleni.php,
CRUD Dokumentacija(dropdown menu= Kalkulacije, Domaćinstvo, Dobavljači, Računi).

Glavni fokus je na dropdown meniju **Dokumentacija>kalkulacije.php** i dropdown meniju **Dokumentacija>racuni.php**. 

**kalkulacije.php** služe adminu kada kupuje određene potrebštine za svoj hotel, dok mu stranica racuni.php pomaže da uspešno prosledi račun određenom gostu. 

Stranica dobavljaci.php pokazuje sa kojim dobavljačima hotel sarađuje. 

Stranica domacinstvo.php pokazuje koje stvari hotel ima kao svoje lično pokućstvo, i koliko tog pokućstva ima na stanju.

Stranica usluge.php pruža informacije o mogućim dodatnim uslugama koje gost ima na raspolaganju. 

Stranica sobe.php sadrži informacije o slobodnim sobama i kojeg je tipa određena soba. Na toj stranici je dugme "Vrste soba", gde se korisnik preusmerava na stranicu tipsobe.php gde on lično može napraviti novi tip sobe po svom izboru. 
Kao što web development funkcioniše, održavanje i usavršavanje aplikacije može trajati u nedogled. Tako da, na osnovu ovoga, ja ću se truditi da ovu aplikaciju usavršavam kontinuirano. Nadam ste da ste uživali, srdačan pozdrav,
Jovan Radosavljević.
