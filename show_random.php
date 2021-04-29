<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get random</title>
</head>
<body>
    <h1>Blague du jour:</h1>
    <p id="joke"></p>

    <input type="text" />
    <!-- Etape1: Récupérer le contenu du JSON en JavaScript -->
    <!-- Etape2: Afficher la blague -->
    <script>

        function mapToJson(response) {
            return response.json();
        }

        function showJoke(response) {
            document.querySelector('#joke').innerText = response.joke;
        }
        
        function fetchJoke() {
            fetch('http://localhost:8888/bio-blog/get_random.php')
                .then(mapToJson)
                .then(showJoke);
        }

        fetchJoke();
        setInterval(fetchJoke, 10000);


        function prepareRestorantFor(date) {}

        function manifest() {}

        function askForThemePark() {}

        const responseToOpenRestaurant = new Promise(function(accept, reject) {
            accept();
        });

        responseToOpenRestaurant.then(
            function() { prepareRestorantFor("tomorrow"); },
            function() { prepareRestorantFor("next week"); }
        );

        responseToOpenRestaurant.then(
            function() { prepareRestorantFor("next monday"); },
            function() { manifest(); }
        );

        responseToOpenRestaurant.then(
            function() { if (!themeParkAuthorized) askForThemePark(); },
            function() { if (!themeParkAuthorized) askForThemePark(); }
        );



        // const myPromise = new Promise(function(success, error) {
        //     // success("hello");
        //     error("iueiui");
        // });

        // myPromise
        //     .then(
        //         function(r) { console.log('I deploy'); },
        //         function(error) { console.error('I fix error', error); }
        //     )
        //     // .then(function(r) { console.log('log2', r); })



        // Scénario dans la vrai vie:
        /*
         * Vous êtes en attente de votre client pour voir si vous pouvez déployer l'application en production (Client = promise).
         * HappyPath: Le client dit oui
         * * Vous déployez en production
         * BadPath: Le client dit non
         * * Vous faite un correctif
         */

    </script>
</body>
</html>