<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IRGL 2024 | FAQ</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .glow {
            color: #fff;
            text-shadow: 0 0 12px #fff;
        }

        .pirgl {
            text-shadow: 0 0 12px rgba(175, 0, 255, 0.95);
            font-family: "Share Tech Mono", monospace;
        }

        .accordion-icon {
            transition: transform 0.3s ease-in-out;
        }

        .accordion.active .accordion-icon {
            transform: rotate(180deg);
        }

        .panel {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .panel.show {
            max-height: 200px;
        }
    </style>
</head>

<body>
    <button class="absolute top-0 left-0 m-3 cursor-pointer" onclick="history.back()">
        <span class="text-5xl max-lg:text-4xl glow text-white material-icons">arrow_back</span>
    </button>
    <div class="bg-black flex flex-col items-center min-h-screen bg-[url('https://images.hdqwalls.com/download/neon-city-5k-3u-1920x1080.jpg')] bg-cover bg-center bg-no-repeat">
        <div class="my-4 border-white border-b-2 pb-4 w-3/4 flex justify-between items-end">
            <h2 class="text-5xl max-lg:text-4xl max-sm:text-3xl text-white font-bold glow">INFO PESERTA</h2>
            <div class="flex items-center">
                <img src="../assets/logo/logo-02-02.png" class="w-[30px] h-[30px]">
                <p class="text-white font-bold pirgl">IRGL 2024</p>
            </div>
        </div>
    
        <div class="bg-[rgba(100,100,100,0.2)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] w-3/4 p-10 text-center relative flex justify-center">
            <div class="lg:w-5/6 sm:py-7">

                <div class="mb-5 text-left bg-[rgba(0,0,0,0.5)] hover:bg-[#B026FF] p-5">
                    <button class="text-white font-semibold text-lg max-sm:text-base flex justify-between items-center w-full accordion">
                        <span>Q: How do I register for the event?</span>
                        <span class="material-icons accordion-icon">expand_more</span>
                    </button>
                    <div class="panel">
                        <p class="text-white pt-2 border-white border-t-2 mt-2">A: You can register by filling out the registration form on our website.</p>
                    </div>
                </div>

                <div class="mb-5 text-left bg-[rgba(0,0,0,0.5)] hover:bg-[#B026FF] p-5">
                    <button class="text-white font-semibold text-lg max-sm:text-base flex justify-between items-center w-full accordion">
                        <span>Q: What is the deadline for registration?</span>
                        <span class="material-icons accordion-icon">expand_more</span>
                    </button>
                    <div class="panel">
                        <p class="text-white pt-2 border-white border-t-2 mt-2">A: The registration deadline is December 31, 2024.</p>
                    </div>
                </div>

                <div class="mb-5 text-left bg-[rgba(0,0,0,0.5)] hover:bg-[#B026FF] p-5">
                    <button class="text-white font-semibold text-lg max-sm:text-base flex justify-between items-center w-full accordion">
                        <span>Q: Can I edit my registration information later?</span>
                        <span class="material-icons accordion-icon">expand_more</span>
                    </button>
                    <div class="panel">
                        <p class="text-white pt-2 border-white border-t-2 mt-2">A: Yes, you can update your information by logging into your account.</p>
                    </div>
                </div>

                <div class="mb-5 text-left bg-[rgba(0,0,0,0.5)] hover:bg-[#B026FF] p-5">
                    <button class="text-white font-semibold text-lg max-sm:text-base flex justify-between items-center w-full accordion">
                        <span>Q: What is the event schedule?</span>
                        <span class="material-icons accordion-icon">expand_more</span>
                    </button>
                    <div class="panel">
                        <p class="text-white pt-2 border-white border-t-2 mt-2">A: The event schedule will be posted on the website one week before the event.</p>
                    </div>
                </div>

                <div class="mb-5 text-left bg-[rgba(0,0,0,0.5)] hover:bg-[#B026FF] p-5">
                    <button class="text-white font-semibold text-lg max-sm:text-base flex justify-between items-center w-full accordion">
                        <span>Q: Who can I contact for support?</span>
                        <span class="material-icons accordion-icon">expand_more</span>
                    </button>
                    <div class="panel">
                        <p class="text-white pt-2 border-white border-t-2 mt-2">A: You can contact our support team via email at support@example.com.</p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <script>
        var acc = document.getElementsByClassName("accordion");
    
        for (var i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                // Toggle the active class for the clicked accordion
                this.classList.toggle("active");
    
                // Toggle the display of the panel related to this accordion
                var panel = this.nextElementSibling;
                if (panel.classList.contains("show")) {
                    panel.classList.remove("show");
                } else {
                    panel.classList.add("show");
                }
    
                // Find the icon in the current accordion and toggle the rotation
                var icon = this.querySelector('.accordion-icon');
                if (icon.style.transform === "rotate(180deg)") {
                    icon.style.transform = "rotate(0deg)";
                } else {
                    icon.style.transform = "rotate(180deg)";
                }
            });
        }
    </script>

</body>

</html>
