<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikacja</title>
</head>
<body>
    <?php
    //error_reporting(0);
    //$maile = ["noreply@github.com"];
    $input = imap_open("{imap.googlemail.com:993/ssl}INBOX", "michalquandale@gmail.com", "Michu123");
    $maile = imap_search($input, 'FROM "noreply@github.com"');
    $maile_headers = imap_fetch_overview($input, implode(",", $maile), 0);
    $maile_headers = array_reverse($maile_headers);
    //print the body
    foreach ($maile_headers as $maile_header) {
        $body = imap_fetchbody($input, $maile_header->msgno, 1); //printuje body
        $body = imap_qprint($body); //Konwertuje znaki specjalne
        $body = substr($body, strpos($body, "Verification code:") + strlen("Verification code:")); //Usuwa wszystko obrocz "Verification code:"
        $body = substr($body, 0, strpos($body, "\n")); //Usuwa wszystko obrocz spacji oraz "Verification code:"
        $body = preg_replace('/[^0-9]/', '', $body); //Usuwa wszystkie litery
        echo $body;
    }
            

    
   
   
    
?>
    
    
    
</body>
</html>