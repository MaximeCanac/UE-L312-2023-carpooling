<!DOCTYPE html>
<html>
<head>
    <title>Actions</title>
    <!-- Ajout des liens Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        /* Style pour les conteneurs iframe */
        .container {
            display: none;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
        }

        iframe {
            width: 100%;
            height: 300px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#" onclick="openTab(event, 'announcements')">Announcements</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="openTab(event, 'users')">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="openTab(event, 'cars')">Cars</a>
        </li>
    </ul>

    <div id="announcements" class="container tab-pane active">
        <!-- Contenu pour les annonces -->
        <iframe src="announcements_create.php"></iframe>
        <iframe src="announcements_read.php"></iframe>
        <iframe src="announcements_update.php"></iframe>
        <iframe src="announcements_delete.php"></iframe>
    </div>

    <div id="users" class="container tab-pane">
        <!-- Contenu pour les utilisateurs -->
        <iframe src="users_create.php"></iframe>
        <iframe src="users_read.php"></iframe>
        <iframe src="users_update.php"></iframe>
        <iframe src="users_delete.php"></iframe>
    </div>

    <div id="cars" class="container tab-pane">
        <!-- Contenu pour les voitures -->
        <iframe src="cars_create.php"></iframe>
        <iframe src="cars_read.php"></iframe>
        <iframe src="cars_update.php"></iframe>
        <iframe src="cars_delete.php"></iframe>
    </div>

</div>

<script>
    function openTab(evt, tabName) {
        var i, containers, navLinks;
        containers = document.getElementsByClassName("container");
        for (i = 0; i < containers.length; i++) {
            containers[i].style.display = "none";
        }
        navLinks = document.getElementsByClassName("nav-link");
        for (i = 0; i < navLinks.length; i++) {
            navLinks[i].classList.remove("active");
        }
        document.getElementById(tabName).style.display = "grid";
        evt.currentTarget.classList.add("active");
    }

</script>

</body>
</html>
