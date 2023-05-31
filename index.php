<?php
    session_start();

    if(isset($_POST['envoi'])){
        if(!empty($_POST['pseudo'])){
            
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $_SESSION['pseudo'] = $pseudo;

        }else{
            echo("Merci de rentrer votre pseudo");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Skyloard.fr/InfoPlayer</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
</head>
<body>
    <form method="POST" action="" align="center">
        <input type="text" name="pseudo">
        </br>
        <input type="submit" name="envoi">

    </form>

    <div class="playerInfo">
        <a class="playerHead">
        <?php
        $head = file_get_contents('https://minecraft-api.com/api/skins/'.$_SESSION['pseudo'].'/head');
        echo $head;
        ?>
        </a>
        <h2>
            Pseudo =
            <?php
            echo $_SESSION['pseudo'];
            ?>
        </h2>
        </br>
        <h2>
            
        </h2>
        </br>
        <h2>
            Money =
            <?php
            $money = json_decode(file_get_contents('https://api.skylord.fr/api/joueur/money?pseudo='.$_SESSION['pseudo']));
            print $money->{'Format'} ." ". $money->{'Devise'};
            ?>
        </h2>
    </div>
    <div class="Crypto">
        <h1 align="center">CRYPTO</h1>
        <?php

        $jsonData = file_get_contents('https://api.skylord.fr/api/joueur/wallet?pseudo='.$_SESSION['pseudo']);

        // Décodage JSON en un tableau associatif
        $data = json_decode($jsonData, true);

        // Accéder aux données
        $wallet = $data['wallet'];

        echo "<h2>Bitcoin : ".$wallet[0]['BTCUSDT']."</h2>";
        echo '<h2>Ethereum : '.$wallet[1]['ETHUSDT'].'</h2>';
        echo "<h2>Litecoin : ".$wallet[2]['LTCUSDT']."</h2>";
        echo "<h2>Binance Coin : ".$wallet[3]['BNBUSDT']."</h2>";
        echo "<h2>Shiba : ".$wallet[4]['SHIBUSDT']."</h2>";
        echo "<h2>DogeCoin : ".$wallet[5]['DOGEUSDT']."</h2>";
        echo "<h2>Ripple : ".$wallet[6]['XRPUSDT']."</h2>";
        echo "<h2>Cardano : ".$wallet[7]['ADAUSDT']."</h2>";
        echo "<h2>Polkadot : ".$wallet[8]['DOTUSDT']."</h2>";
        ?>
    </div>

    <div class="Jobs">

    <h1 align="center">JOBS</h1>
        <?php

        $jsonDataMineur = file_get_contents('https://api.skylord.fr/api/joueur/jobs?pseudo='.$_SESSION['pseudo']."&jobs=Mineur");
        $jsonDataPecheur = file_get_contents('https://api.skylord.fr/api/joueur/jobs?pseudo='.$_SESSION['pseudo']."&jobs=Pecheur");
        $jsonDataAdven = file_get_contents('https://api.skylord.fr/api/joueur/jobs?pseudo='.$_SESSION['pseudo']."&jobs=Aventurier");
        $jsonDataChasseur = file_get_contents('https://api.skylord.fr/api/joueur/jobs?pseudo='.$_SESSION['pseudo']."&jobs=Chasseur");
        $jsonDataBucheron = file_get_contents('https://api.skylord.fr/api/joueur/jobs?pseudo='.$_SESSION['pseudo']."&jobs=Bucheron");
        $jsonDataFermier = file_get_contents('https://api.skylord.fr/api/joueur/jobs?pseudo='.$_SESSION['pseudo']."&jobs=Fermier");
        $jsonDataArchi = file_get_contents('https://api.skylord.fr/api/joueur/jobs?pseudo='.$_SESSION['pseudo']."&jobs=Architecte");

        $dataMineur = json_decode($jsonDataMineur, true);
        $dataPecheur = json_decode($jsonDataPecheur, true);
        $dataAdven = json_decode($jsonDataAdven, true);
        $dataChasseur = json_decode($jsonDataChasseur, true);
        $dataBucheron = json_decode($jsonDataBucheron, true);
        $dataFermier = json_decode($jsonDataFermier, true);
        $dataArchi = json_decode($jsonDataArchi, true);

        $mineur = $dataMineur['Mineur'];
        $pecheur = $dataPecheur['Pecheur'];
        $adven = $dataAdven['Aventurier'];
        $chasseur = $dataChasseur['Chasseur'];
        $bucheron = $dataBucheron['Bucheron'];
        $fermier = $dataFermier['Fermier'];
        $archi = $dataArchi['Architecte'];

        echo "<h2>Architecte : ".$archi[0]['jlevel']." / ".$archi[1]['jmaxlvl']." | ".$archi[2]['jexp']." / ".$archi[3]['jmaxexp']."</h2>";
        echo "<h2>Fermier : ".$fermier[0]['jlevel']." / ".$fermier[1]['jmaxlvl']." | ".$fermier[2]['jexp']." / ".$fermier[3]['jmaxexp']."</h2>";
        echo "<h2>Bucheron : ".$bucheron[0]['jlevel']." / ".$bucheron[1]['jmaxlvl']." | ".$bucheron[2]['jexp']." / ".$bucheron[3]['jmaxexp']."</h2>";
        echo "<h2>Chasseur : ".$chasseur[0]['jlevel']." / ".$chasseur[1]['jmaxlvl']." | ".$chasseur[2]['jexp']." / ".$chasseur[3]['jmaxexp']."</h2>";
        echo "<h2>Adventurier : ".$adven[0]['jlevel']." / ".$adven[1]['jmaxlvl']." | ".$adven[2]['jexp']." / ".$adven[3]['jmaxexp']."</h2>";
        echo "<h2>Pecheur : ".$pecheur[0]['jlevel']." / ".$pecheur[1]['jmaxlvl']." | ".$pecheur[2]['jexp']." / ".$pecheur[3]['jmaxexp']."</h2>";
        echo "<h2>Mineur : ".$mineur[0]['jlevel']." / ".$mineur[1]['jmaxlvl']." | ".$mineur[2]['jexp']." / ".$mineur[3]['jmaxexp']."</h2>";
        ?>
        
    </div>  
</body>
</html>

