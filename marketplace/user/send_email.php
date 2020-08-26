

<hmtl>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
    </head>
    <body>
        <?php
    $new = hmtlspecialchars("<input type=\"text\">",ENT_QUOTES);
    echo $new;
?>
    </body>
</hmtl>