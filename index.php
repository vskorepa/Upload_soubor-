<!doctype html>

<html >

<head>

    <meta charset="UTF-8">

    <meta name="viewport"

          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Upload souboru</title>

</head>

<body class="container">

<?php

if($_FILES){

    $targetDir = "uploads/";

    $targetFile = $targetDir . basename($_FILES["uploadedName"]["name"]);

    $FileType = explode("/", $_FILES["uploadedName"]["type"]);



    $uploadSucces = true;

    if ($_FILES["uploadedName"]["error"] != 0){

        echo "Chyba server při uploadu";

        $uploadSucces = false;

    }



    else if (file_exists($targetFile)){

        echo "Soubor již existuje";

        $uploadSucces =false;

    }

    else if ($_FILES["uploadedName"]["size"] > 8000000){

        echo "Soubor je příliš velký";

        $uploadSucces = false;

    }

    else if($FileType[0] !== 'image' && $FileType[0] !== 'video' && $FileType[0] !== 'audio'){

        var_dump($FileType);

        echo "$FileType[0]";



        echo "Soubor má špatný typ";

        $uploadSucces = false;



    }



    if (!$uploadSucces){

        echo "<br> Došlo k chybě uploadu";

    }else{



        if (move_uploaded_file($_FILES["uploadedName"]["tmp_name"],$targetFile)){

            echo "Soubor '" . basename($_FILES["uploadedName"]["name"]) . "' byl uložen. <br>";



            if ($FileType[0] === 'image'){

                echo  "<img alt='fotka' class='img-fluid' src='uploads/{$_FILES["uploadedName"]["name"]}'/>";

            }



            else if ($FileType[0] === 'audio'){

                echo  "<audio loop controls autoplay>";

                echo "<source src='uploads/{$_FILES["uploadedName"]["name"]}'>";

                echo  "</audio>";

            }



            else if($FileType[0] === 'video'){

                echo "<video loop controls autoplay>";

                echo "<source src='uploads/{$_FILES["uploadedName"]["name"]}'>";

                echo "</video>";



            }

        } else{

            echo "Došlo k chybě uploadu";

        }

    }

}



?>

<form method="post" action="" enctype="multipart/form-data">



    <label for="formFile" class="form-label"></label>

    <input class="form-control" id="formFileLg" type="file" name="uploadedName">

    <input class="btn btn-primary" type="submit" value="Nahrát" name="submit"/>

</form>



<!--<form method="post" action="" enctype="multipart/form-data"><div>-->

<!--    Select image to upload:-->

<!--    <input type="file" name="uploadedName" />-->

<!--    <input type="submit" value="Nahrát" name="submit"/>-->

<!---->

<!---->

<!--</div>-->

<!--    </form>-->



</body>

</html>

