<?php
if(isset($_POST["buscar"])){

    $busqueda = $_POST["busqueda"] ?? "twin";
    $listaserie = file_get_contents("https://api.tvmaze.com/search/shows?q=". $busqueda);
    if($listaserie == null){
        exit(0);
    }
    $json = json_decode($listaserie, true);
    $serie = $json[0];
}
else{
    $listaserie = file_get_contents("https://api.tvmaze.com/search/shows?q=twin");
    $json = json_decode($listaserie, true);
    $serie = $json[1];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1e1e2f;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        header {
            width: 100%;
            background: #2a2a40;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        header form {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        header input[type="text"] {
            padding: 10px;
            border: none;
            border-radius: 25px;
            width: 300px;
            font-size: 1rem;
            background: #1e1e2f;
            color: #fff;
        }

        header input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background: #ff6f61;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        header input[type="submit"]:hover {
            background: #ff4a3d;
        }

        .contenedor {
            max-width: 800px;
            width: 90%;
            background: #2a2a40;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 20px;
        }

        .contenedor:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        h1 {
            color: #ff6f61;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .detalles {
            margin-bottom: 25px;
        }

        .detalles p {
            margin: 10px 0;
            font-size: 1.1rem;
            color: #ddd;
        }

        .detalles p strong {
            color: #ff6f61;
        }

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 1.5em;
        }

        ul li {
            background: #ff6f61;
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        ul li:hover {
            cursor: pointer;
            background: #ff4a3d;
            transform: scale(1.1);
        }

        img {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 20px auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        img:hover {
            cursor: pointer;
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        .detalles p {
            transition: color 0.3s ease;
        }

        .detalles p:hover {
            cursor: pointer;
            color: #ff6f61;
        }
    </style>

</head>
<body>
<header>
    <form method="POST" action="">
        <input type="text" name="busqueda" placeholder="Buscar serie..." required>
        <input type="submit" value="Buscar" name="buscar">
    </form>
</header>
<div class="contenedor">
    <?php
        echo "<h1>". $serie["show"]["name"] ?? "placeholder" . "</h1>";
        echo "<div class='detalles'>";
            echo "<p><bold>Idioma:  </bold>".$serie["show"]["language"]?? "placeholder" . "</p>";
            echo "<p><bold>Estado: </bold>".$serie["show"]["status"]?? "placeholder" . "</p>";
            echo "<p><bold>Emisión: </bold>".$serie["show"]["premiered"]?? "placeholder" . "</p>";
            echo "<p><bold>Rating: </bold>".$serie["show"]["rating"]["average"]?? "placeholder" . "</p>";
            echo "<p><bold>Ver en: </bold>".$serie["show"]["network"]["name"]?? "placeholder" . "</p>";
        echo "</div>";
        echo "<ul>";

        foreach($serie["show"]["genres"] as $genre){
            echo "<li>".$genre ?? "placeholder" . "</li>";
        }
        echo "</ul>";
        echo "<img src='". $serie["show"]["image"]["original"]."'alt='placeholder'>";


    ?>
</div>
</body>
</html>