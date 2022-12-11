<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se lagde brukere</title>
</head>
<body>
    
    <?php
    //Lager en kobling med mySQL database
    $dbconnect = mysqli_connect("localhost", "Bruker", "Bruker-pass123", "bankbrukertest");

    //Setter tegnsett (character set) til utf-8
    $dbconnect->set_charset("utf8");

    //Med denne kommandoen velger jeg alt fra databasen "bruker", uten noen krav
    $sql = "SELECT * FROM `bruker`";
    //Her utfører vi en spørsel om $sql kommandoen
    $resultat = $dbconnect->query($sql);

            //Den kjøres hvor mange rader du har fått ut. Fetch_assoc betyr at den henter en assosiative array.
            while($row = $resultat->fetch_assoc()){
                    echo 'ID: ' . $row["id"];
                    echo "<br>";
                    echo 'Navn: ' . $row["navn"]; 
                    echo "<br>";
                    echo 'Epost: ' . $row["epost"]; 
                    echo "<br>";
                    echo 'Saldo: ' . $row["saldo"];
                    echo "<br>";
                    echo "<br>";
            }
            //avslutter koblingen til databasen
            mysqli_close($dbconnect);

    ?>
    <!-- Returnerer bruker tilbake til hovedskjerm -->
    <form method="POST" action="index.html">
        <input type="submit" value="Gå tilbake til hovedside">
    </form>

</body>
</html>