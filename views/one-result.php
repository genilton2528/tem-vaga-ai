<?php require_once("../autoload.php"); ?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Tem Vaga ai</title>
    <link rel="shortcut icon" href="../img/ico.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@600&display=swap" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.5/examples/album/album.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/slider.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php include 'views-parts/header.php';
    headerResult();
    ?>
    <main>
        <div class="container">
            <div class="content-view">            
                <?php
                include 'views-parts/slider.php';

                $properties = new Properties();
			    $property = $properties->getRecordById($_GET["id"]);
                $images = new Images();

                [					
					"id" => $id,
                	"title" => $title,
                	"price" => $price,
                    "description" => $description,
                    "address" => $address
                ] = $property;                
                $imgs = $images->getImagesByOwnerId($id);
                
                if ( !empty($imgs) ) {
                    $sliders = [ '', '', ''];
                    foreach ($imgs as $key => $img) {
                        $sliders[$key] = 
                            ( array_key_exists ( "src" , $img) )? "../" . $img["src"] : "";    
                    }
                    slider($sliders);
                }                

                echo 
				"<div class='item-view'>
                    <h1 class='dark-text title'>$title</h1>
                    <p class='green-text'>$price</p>
                    <p class='text'>$description</p>
                    <p class='text'>$address</p>
                    <button id='close-deal' class='search-btn transition' type='button'>Fechar Negócio!</button>
                </div>";
                            
                ?>
            </div>
        </div>
    </main>
    <?php include 'views-parts/footer.php';
    footer();
    ?>
    <script src="../js/animation.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/slide.js"></script>
    <script>
        const closeDear = document.getElementById("close-deal");

        if( localStorage.id_user ){
            let id = new URL(window.location.href).searchParams.get('id');
            closeDear.addEventListener( "click", ()=>{
                window.location.href = 
                `../app/closeDeal.php?id_user=${localStorage.id_user}&id_property=${id}`;
            });
        } else {
            closeDear.addEventListener( "click", ()=>{
                alert("Faça Login primeiro")
            });
        }

    </script>
</body>

</html>