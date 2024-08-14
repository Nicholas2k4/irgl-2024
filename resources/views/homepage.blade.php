<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Homepage</title>
    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@0.164.1/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.164.1/examples/jsm/"
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");

        @keyframes fizzleText {
            0% {
                opacity: 0.3;
                text-shadow: none;
            }

            10% {
                opacity: 0.2;
            }

            20% {
                opacity: 0.3;
            }

            30% {
                opacity: 0.2;
            }

            40% {
                opacity: 0.2;
            }

            50% {
                opacity: 0.6;
                text-shadow: 0 0 10px #0080e2, 0 0 15px #0080e2, 0 0 25px #0080e2, 0 0 40px #0080e2;
            }

            60% {
                opacity: 0.2;
                text-shadow: none;
            }

            80% {
                opacity: 0.2;
            }

            90% {
                opacity: 0.8;
            }

            95% {
                opacity: 0.2;
                text-shadow: none;
            }

            100% {
                opacity: 0.6;
                text-shadow: 0 0 10px #0080e2, 0 0 15px #0080e2, 0 0 25px #0080e2, 0 0 40px #004097;
            }
        }

        @keyframes fizzleBorder {
            0% {
                opacity: 0.3;
            }

            10% {
                opacity: 0.1;
            }

            20% {
                opacity: 0.4;
                box-shadow: 0 0 15px 4px #bde1ff, 0 0 120px 2px #0080e2, inset 0 0 15px 4px #bde1ff, inset 0 0 50px 2px #0080e2;
            }

            30% {
                opacity: 0.1;
            }

            40% {
                opacity: 0.1;
            }

            50% {
                opacity: 0.6;
            }

            60% {
                opacity: 0.2;
            }

            80% {
                opacity: 0.2;
            }

            90% {
                opacity: 0.9;
            }

            95% {
                opacity: 0.1;
                box-shadow: 0 0 15px 4px #ed1cdc, 0 0 120px 2px #790072, inset 0 0 15px 4px #ed1cdc, inset 0 0 50px 2px #790072;
            }

            100% {
                opacity: 0.8;
            }
        }

        .neon-title {
            font-family: "Share Tech Mono", monospace;
            position: relative;
            display: inline-block;
            padding: 10px 50px 14px !important;
            margin: 30px auto;
            text-align: center;
            z-index: 1;
            max-width: 100%;
            overflow: visible;
            background: transparent;
            border: none;
            text-transform: uppercase;
            text-decoration: none;
            color: #bde1ff;
            text-shadow: 0 0 10px #0080e2, 0 0 20px #0080e2, 0 0 30px #0080e2, 0 0 40px #004097, 0 0 70px #004097;
            line-height: 4rem;
            letter-spacing: 4px;
            transition: all .2s ease;

            &:before {
                content: "";
                display: block;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                border: 2px solid rgba(255, 255, 255, 0.9);
                border-radius: 8px;
                box-shadow: 0 0 15px 4px #ed1cdc, 0 0 120px 2px #790072, inset 0 0 15px 4px #ed1cdc, inset 0 0 50px 2px #790072;
                transition: all .2s ease;
                z-index: -1;
                opacity: 1;
            }

            &:hover {
                cursor: pointer;
                animation: fizzleText ease-in-out .8s;

                &:before {
                    animation: none;
                    animation: fizzleBorder ease-in-out .8s;
                }
            }
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            /* Prevents scrolling */
        }

        nav {
            color: #fff;
            padding: 10px;
            position: absolute;
            z-index: 9;
            width: 100%;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        ul li {
            display: inline;
            margin-right: 10px;
        }

        ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 10px;
            transition: all 0.3s ease;
            font-family: "Share Tech Mono", monospace;
            font-weight: 500;
            font-size: 1.15em;
            font-style: normal;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(11, 6, 30);
            z-index: 10;
        }

        #start-button {
            padding: 10px 20px;
            font-size: 20px;
            cursor: pointer;
        }

        .fixed-container {
            position: fixed;
            right: 0;
            top: 0;
            margin: 30px;
            width: fit-content;
            height: fit-content;
            z-index: 8;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .fixed-container .icon {
            font-size: 2rem;
            color: white;
        }

        .fixed-container .icon.hidden {
            display: none;
        }

        #loading-screen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(11, 6, 30) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2em;
            z-index: 9999;
            flex-direction: column;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #loading-screen {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #000;
        }

        .loading-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading {
            height: 100px;
            width: 100px;
            border-radius: 50%;
            background: linear-gradient(45deg, transparent, transparent 40%, #e5f303);
            animation: animate 1s linear infinite;
        }

        .loading::before {
            content: '';
            display: block;
            position: absolute;
            top: 2px;
            bottom: 2px;
            left: 2px;
            right: 2px;
            background: #000;
            border-radius: 50%;
            z-index: 1;
        }

        .loading::after {
            content: '';
            display: block;
            position: absolute;
            top: 0px;
            bottom: 0px;
            left: 0px;
            right: 0px;
            background: linear-gradient(45deg, transparent, transparent 40%, #e5f303);
            border-radius: 50%;
            filter: blur(30px);
            z-index: 0;
        }

        .loading-text {
            position: absolute;
            font-size: 20px;
            font-family: "Share Tech Mono", monospace;
            color: #bde1ff;
            z-index: 2;
            text-shadow: 0 0 5px #e5f303;
        }

        @keyframes animate {
            0% {
                transform: rotate(0deg);
                filter: hue-rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
                filter: hue-rotate(180deg);
            }
        }

        #entranceVideo {
            width: 100vw;
            height: auto;
            z-index: 0;
            left: 0;
            top: 0;
            margin: 0;
            padding: 0;
            opacity: 1;
            transition: all .5s linear;

        }

        .video-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            z-index: 10;
            opacity: 1;
            transition: all 1.35s linear;
            position: fixed;
            left: 0;
            top: 0;
        }
    </style>
</head>

<body>
    <div class="video-container" id="videoContainer">
        <video id="entranceVideo">
            <source src="/assets/entrance.mp4" type="video/mp4">
        </video>
    </div>
    <nav>
        <ul>
            <li><a id="home-link" href="#">Home</a></li>
            <li><a id="about-link" href="#">About</a></li>
            <li><a id="timeline-link" href="#">Timeline</a></li>
            <li><a id="login-link" href="#">Login</a></li>
        </ul>
    </nav>
    <div id="loading-screen">
        <div class="loading-container">
            <div class="loading"></div>
            <span class="loading-text" id="loading-percentage">IRGL</span>
        </div>
    </div>
    <div id="start-screen" class="overlay" style="display: none;">
        <h1 id="start-button" class="neon-title">Start</h1>
    </div>
    <div class="fixed-container">
        <i id="unmuted" class="fa-solid fa-volume-high icon"></i>
        <i id="muted" class="fa-solid fa-volume-xmark icon hidden"></i>
    </div>
    <script src="js/script.js" type="module"></script>

    <script>
       
        if (window.innerWidth < 768) {
            window.location.href = "{{ route('homepage.hp') }}"
        }
        
        window.addEventListener('resize', function() {
            if (window.innerWidth < 768) {
                window.location.href = "{{ route('homepage.hp') }}"
            }
        });
    </script>
</body>

</html>
