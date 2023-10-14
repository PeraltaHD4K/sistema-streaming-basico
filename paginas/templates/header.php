<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Mi Streaming</div>
        <nav>
            <ul>
                <li><a href="#" onclick="loadPage('home')">Inicio</a></li>
                <li><a href="#" onclick="loadPage('series')">Series</a></li>
                <li><a href="#" onclick="loadPage('movies')">Películas</a></li>
            </ul>
        </nav>
    </header>