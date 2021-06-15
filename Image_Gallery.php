<html>
    <head>
        <style>
            #image_box
            {
                width: 800px;
                height: 531px;
                background-color : #f1e4b8;
                position: fixed; right: 350px;
            }
        </style>
        <script>
            var current = 0;

            function initialize(loc)
            {
                update(loc);
            }

            function next(loc)
            {
                if(current == imageArray[loc].length-1)
                {
                    current = 0;
                }
                else
                {
                    ++current;
                }
                
                update(loc);
            }

            function prev(loc)
            {
                if(current == 0)
                {
                    current = imageArray[loc].length-1;
                }
                else
                {
                    --current;
                }

                update(loc);
            }

            function update(loc)
            {
                document.getElementById("images").src = imageArray[loc][current];
                document.getElementById("current").innerHTML = current + 1;
            }
        </script>
    </head>

    <?php include 'images.php'; 
        $location = $_GET["place"];
        
        if($location != "knossos" && $location != "koules" && $location != "elafonisi")
        {
            echo "There are no photos for the location you are searching!";
        }
        else
        {
            $imagesNum = count($imageMap[$location]);
    ?>
        <body onload = "initialize('<?php echo $location;?>')">
            <script>
                var imageArray = <?php echo json_encode($imageMap); ?>;
            </script>
            <div id="image_box">
                <h2 style="text-align:center;">Images for <?php echo $location;?></h2>
                <img src ="gallery/left.png" style="position:absolute; top:40%;" onclick = "prev('<?php echo $location;?>')" >
                <img id="images" style="display:block; margin: 0px auto; width: 80%; height:75% ;" src ="">
                <img src ="gallery/right.png" style="position:absolute; top:40%; left:92.5%;" onclick="next('<?php echo $location;?>')">
                <p style="position:absolute; top:90%;right: 45%; font-weight:bold;">Image <span id="current">-</span>/<span> <?php echo $imagesNum?> </span></p>
            </div>
        </body>
    <?php } ?>
</html>