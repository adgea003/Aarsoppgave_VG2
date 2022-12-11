<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasjon</title>
</head>
<body>
    <?php
    //Variabler i php koden, koblet med inputene fra index.html
    $navn = $_POST['navn'];
    $epost = $_POST['epost'];
    $transaksjon = $_POST['pengerInn'];
    
    
    //Hoved funksjonen. Først sjekker den om knappen "Trykk her for å sette inn". Hvis den har blitt trukket, skal den gå over til å sjekke om $navn variabelen er tom. Deretter hvis den er ikke tom, sjekker dem om $epost variabelen er tom. Hvis alt er utfylt, skal den gå over til å kjøre resten av koden
    if(isset($_POST["knappInn"])) {
        if(!isset($_POST['navn']) || $_POST['navn'] == '') {
            echo "Skriv inn gyldig navn";
        } else if(!isset($_POST['epost']) || $_POST['epost'] == '') {
            echo "Skriv inn gyldig e-post adresse";
        } else {
            //Lager connection med mySQL databasen. Først er server name skrevet deretter brukernavn, passord og mySQL database. 
            $db = mysqli_connect('localhost', 'Bruker', 'Bruker-pass123', 'bankbrukertest');
            //Koden setter in verdiene av $navn, $epost og $transaksjon inn i database radene navn, epost og saldo
            $insert = "INSERT INTO bruker (navn, epost, saldo) VALUES ('$navn', '$epost', '$transaksjon');";
            //Kjører SQL koden
            $result1 = mysqli_query($db, $insert);

            //Sjekker om det er feil ved kobling og returnerer feil melding.
            if($db->connect_error){
                die("Connection failed");
            }
            
            //Med denne kommandoen velger jeg alt fra database "bruker" hvor row navn i databasen = $navn. Siden $navn er en variabel i php, kan ikke mySQL lese det, derfor er det skrevet som '".$navn."'; Dette gjør det om til string, som mySQL kan lese
            $sql = "SELECT * FROM `bruker` WHERE navn = '".$navn."';";
            //Her utfører vi en spørsel om $sql kommandoen
            $result = $db->query($sql);
            //Hvis num_rows er over 0 (num rows er bare hvis den har fått rader i det hele tatt)
            if($result->num_rows > 0){
                //Den kjøres hvor mange rader du har fått ut. Fetch_assoc betyr at den henter en assosiative array.
                while($row = $result->fetch_assoc()){
                    echo 'ID: ' . $row["id"];
                    echo "<br>";    
                    echo 'Navn: ' . $row["navn"]; 
                    echo "<br>";
                    echo 'Epost: ' . $row["epost"]; 
                    echo "<br>";
                    echo 'Saldo: ' . $row["saldo"];
                    echo "<br>";
                    echo "<br>";

                    //Den endrer data dersom den oppfyller kravene.
                    /*$update = "UPDATE `bruker` SET saldo=300 WHERE id=30";
                    if(mysqli_query($db, $update)){
                        echo "Successfull update";
                    }   */
                    //Den sletter data dersom den oppfyller kravene
                    /*$delete = "DELETE FROM `bruker` WHERE id=30";
                    if(mysqli_query($db, $delete)){
                        echo "Successfull deletion";
                    }*/
                }
                //avslutter koblingen til databasen 
                mysqli_close($db);
            }
        }
    }

    ?>
    
    <!-- Returnerer bruker tilbake til hovedskjerm -->
    <form method="POST" action="index.html">
        <input type="submit" value="Gå tilbake til hovedside">
    </form>

</body>
</html>