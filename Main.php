<!DOCTYPE html>
<html lang="en">

<?php
/*
if you want to inspect the members of a discord server change the guild_id with another one
at line 34;
*/    
?>
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/Discord.png" type="image/png">
    <script src="Scripts/JQuery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Discord Server Dashboard</title>
</head>
<body class="bg-dark">
    <nav class="navbar navbar-expand-lg 
        bg-dark border border-top-0 
        border border-primary 
        border-start-0 border 
        border-end-0 sticky-top">
        <div class="container-fluid d-flex flex-row">
            <h3 class="navbar-brand text-primary">Discord Dashboard Server</h3>
            <div class="justify-content-end">
                <button class="btn btn-primary" role="button" onclick="window.location.reload();">Refresh</button>
            </div>
        </div>
    </nav>
    <main>
        <?php
        $widget_url = "https://discord.com/api/guilds/YOUR_GUILD_ID/widget.json";
        $widget_json = file_get_contents($widget_url);
        $widget_data = json_decode($widget_json, true);
        $member_count = $widget_data["presence_count"];
        $members = $widget_data["members"]
        ?>
        <div class="text-light">
            <div class="containter-fluid p-5 d-flex flex-column justify-content-between">
                <h1 class="text-primary">
                    Discord Members Online :
                    <?php
                    echo '<h3>' . $member_count . '</h3>';
                    echo '<h3 class="text-primary"> Current Online Members : </h3>';
                    foreach ($members as $member) {
                        switch ($member['status']) {
                            case 'dnd':
                                $colored_status = "&nbsp<span class='text-danger h4'>".$member['status']."</span>";
                                break;
                            case 'online':
                                $colored_status = "&nbsp<span class='text-success h4'>".$member['status']."</span>";
                                break;
                            case 'idle':
                                $colored_status = "&nbsp<span class='text-warning h4'>".$member['status']."</span>";
                                break;
                            default:
                                $colored_status = "&nbsp<span class='text-light h4'>".$member['status']."</span>";
                                break;
                            }
                        $avatar_url = $member['avatar_url'];
                        
                        echo "<img src='$avatar_url' class='rounded' style='width:60px;magrin:5px;'/>&nbsp";
                        echo '<span class="h4 text-primary">Name: </span>'.
                        '<span class="h4 text-light">'.$member['username'].'</span>&nbsp'.
                        '<span class="text-primary h4">status:'.'</span>'.$colored_status.'</br><hr class="bg-primary">';
                    }
                    ?>
                </h1>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
