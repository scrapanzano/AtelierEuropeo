<!DOCTYPE html>

<html>

<head>
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/ae-icon.svg') }}" type="image/svg+xml">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- JS -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

    <!-- Alpine.js per funzionalità interattive -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container text-center">
        <div style="margin: 2rem 0;"></div>

        <h1 class="section-title">Ciao Chiara!</h1>
        <h1 class="section-subtitle">Spero che il sito web ti sia piaciuto.</h1>

        <div style="margin: 2rem 0;"></div>

        <h1 class="section-title mb-3">Perché ti è piaciuto, vero?</h1>

        <div style="margin: 1.5rem 0;"></div>

        <button class="btn btn-success btn-rounded btn-lg me-3" style="width: 250px;" id="like-button">Sì, mi è piaciuto!</button>
        <button class="btn btn-danger btn-rounded btn-lg" style="width: 250px;" id="dislike-button">No, non mi è piaciuto!</button>

        <div style="margin: 2rem 0;"></div>

        <h1 class="section-title">Brava, non avevo dubbi.</h1>
        <h1 class="section-subtitle">Questa è stata la mia prima esperienza per lo sviluppo di un sito web quindi
            potresti domandarti:</h1>
        <h1 class="section-subtitle"><i>"Perché rifare proprio quello di Atelier?"</i></h1>

        <div style="margin: 1.5rem 0;"></div>

        <button class="btn btn-primary btn-rounded btn-lg"><i class="bi bi-arrow-right-circle-fill"></i> Scopri perché</button>

        <div style="margin: 2rem 0;"></div>

        <h1 class="section-title">Pota, perché no?</h1>
        <h1 class="section-title">Scusa, scherzo.</h1>

        <div style="margin: 2rem 0;"></div>

        <h1 class="section-subtitle">Quando a marzo stavo capendo che tipo di sito web sviluppare, ero sicuro di non
            voler fare qualcosa di banale. <br>Volevo qualcosa che mi stimolasse davvero.</h1>

        <h1 class="section-subtitle">Poi mi hai proposto, scherzando, di rifare il sito di Atelier e ho accettato.</h1>

        <div style="margin: 2rem 0;"></div>

        <h1 class="section-title">Hai pensato che fossi pazzo?</h1>

        <div style="margin: 1.5rem 0;"></div>
        
        <button class="btn btn-success btn-rounded btn-lg me-3">Shi</button>
        <button class="btn btn-danger btn-rounded btn-lg disabled">No</button>

        <div style="margin: 2rem 0;"></div>

        <h1 class="section-subtitle">Il mio pensiero è stato: <br>
        <i>"Voglio regalare a Chiara un sito web che le piaccia davvero e che rispetti quanto si impegni ogni giorno per questa associazione"</i></h1>

        <h1 class="section-subtitle">Insomma, volevo farti vivere la mia versione di Atelier, che nel mio immaginario, avrebbe
            potuto farti sorridere un po' di più quando parli del tuo lavoro.</h1>

        <h1 class="section-subtitle">E in un certo senso, lavorare su questo sito web, mi ha permesso di sentirti
            comunque vicina, nonostante avessimo passato periodi in cui ci sentivamo o vedavamo di meno.</h1>

        <div style="margin: 2rem 0;"></div>

        <h1 class="section-subtitle">Sei speciale, ricordatelo sempre.</h1>
        <h5 class="text-end"><i>Davide</i></h5>

    </div>

    <script>
        $(document).ready(function() {
            // Nascondi tutti gli elementi inizialmente
            $('h1, button').hide();
            $('h5').hide();

            // Funzioni di utilità per animazioni
            function fadeInWithDelay(element, duration = 1000, delay = 0) {
                return new Promise(resolve => {
                    setTimeout(() => {
                        $(element).fadeIn(duration, resolve);
                    }, delay);
                });
            }

            function fadeOutWithDelay(element, duration = 500, delay = 0) {
                return new Promise(resolve => {
                    setTimeout(() => {
                        $(element).fadeOut(duration, resolve);
                    }, delay);
                });
            }

            // Sezione iniziale
            function startIntroSequence() {
                $('h1:eq(0)').delay(1000).fadeIn(1000, function() {
                    $('h1:eq(1)').fadeIn(1000, function() {
                        $('h1:eq(2)').delay(500).fadeIn(1000, function() {
                            $('button:lt(2)').fadeIn(1000);
                            setupInitialButtons();
                        });
                    });
                });
            }

            // Configura i bottoni iniziali
            function setupInitialButtons() {
                $('#dislike-button').off('mouseover click').mouseover(function() {
                    $(this).text("Fai la seria.");
                }).click(function() {
                    $(this).addClass("disabled").text("Ora come la mettiamo?");
                });

                $('#like-button').off('click').click(function() {
                    showQuestionSection();
                });
            }

            // Mostra sezione domanda
            function showQuestionSection() {
                $('h1:lt(3), button:lt(2)').fadeOut(500, function() {
                    $('h1:eq(3)').fadeIn(1000, function() {
                        $('h1:eq(4)').fadeIn(1000, function() {
                            $('h1:eq(5)').delay(500).fadeIn(1000);
                            $('button:eq(2)').delay(500).fadeIn(1000, function() {
                                setupDiscoverButton();
                            });
                        });
                    });
                });
            }

            // Configura bottone "Scopri perché"
            function setupDiscoverButton() {
                $('button:eq(2)').off('click').click(function() {
                    showJokeSection();
                });
            }

            // Sezione scherzo
            function showJokeSection() {
                $('h1:eq(6)').fadeIn(500, function() {
                    $('h1:eq(7)').delay(500).fadeIn(500, function() {
                        setTimeout(showStorySection, 1200);
                    });
                });
            }

            // Sezione storia principale
            function showStorySection() {
                $('h1').slice(3, 8).fadeOut(500);
                $('button:eq(2)').fadeOut(500, function() {
                    setTimeout(function() {
                        $('h1:eq(8)').fadeIn(1000, function() {
                            $('h1:eq(9)').delay(1500).fadeIn(1000, function() {
                                $('h1:eq(10)').delay(1500).fadeIn(1000);
                                $('button').slice(3, 5).delay(1500).fadeIn(1000, function() {
                                    setupCrazyButtons();
                                });
                            });
                        });
                    }, 300);
                });
            }

            // Configura bottoni "pazzo"
            function setupCrazyButtons() {
                $('button:eq(3)').off('click').click(function() {
                    showThoughtsSection();
                });
            }

            // Sezione pensieri
            function showThoughtsSection() {
                $('h1').slice(8, 11).fadeOut(500);
                $('button').slice(3, 5).fadeOut(500, function() {
                    setTimeout(function() {
                        $('h1:eq(11)').fadeIn(1500, function() {
                            $('h1:eq(12)').delay(2000).fadeIn(1000, function() {
                                $('h1:eq(13)').delay(2000).fadeIn(1000, function() {
                                    setTimeout(showFinalSection, 4000);
                                });
                            });
                        });
                    }, 300);
                });
            }

            // Sezione finale corretta
            function showFinalSection() {
                $('h1').slice(11, 14).fadeOut(500, function() {
                    setTimeout(function() {
                        $('h1:eq(14)').fadeIn(1000, function() {
                            $('h5').delay(200).fadeIn(1000);
                        });
                    }, 500);
                });
            }

            // Avvia la sequenza
            startIntroSequence();
        });
    </script>
</body>

</html>
