## Importing database
-To get the application running, clone the repository first.
Copy the repository into the htdocs folder.

-Run your XAMPP or anything else that you're using for db host. Database file is **hotel.sql** and is located in root folder of the repository. Database can be imported by option "Import" in phpmyadmin. Database is created automatically and import is initialized by first two lines of code in **hotel.sql**. 
You can find application users in a table under name "radnici".

**Login shortcut as admin**
```
Username: enginious1
password: hotel2
```

The application should be all set up by now. To test the functionalities, create a couple of guests, make a reservations, etc...

## Description of the application "hotel"

The main goal of the application is that the administrator/user have certain possibilites, ie. impossibilities. I authorized that through the sessions on individual pages. 

PHPMailer automatically sends mail when admin/user logged in. For now, there is the simplest test-mail which indicates whether the user has successfully logged in. 

The page that follows after logging is "dashboard.php" which is the application map. Navigation bar has the same role. 

Options that are currently available are: CRUD sobe.php(rooms), CRUD guests.php(Gosti), CRUD rezervacije.php(reservations), CRUD usluge.php(services), CRUD zaposleni.php(Employees), CRUD Dokumentacija(Dropdown menu=Kalkulacije, Domacinstvo, Dobavljaci, Racuni).

The main focus is on dropdown **Dokumentacija>kalkulacije.php** and dropdown **Dokumentacija>racuni.php**
**kalkulacije.php** serve the admin when purchasing certain needs for the hotel, whilst **racuni.php** helps him 
to forward the bill to the guest. 
The page **dobavljaci.php** shows which suppliers hotel has.

**domacinstvo.php** shows what household items are available, and how many are in stock.

**usluge.php** provide informations about services which guests have at their disposal.

**sobe.php** tells the information about available rooms and what type are each room is. There is option
on that page which can be initiated on the button click "Vrste soba" where the admin can add new room type.

As web development functions, maintaining and improvement of the application can last indefinitely. And based on this nothing is permanent, so I will try to improve it continously. 

I hope that you enjoyed, best regards,
Jovan Radosavljević




