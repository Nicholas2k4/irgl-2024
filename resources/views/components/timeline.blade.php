<style>
  @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');

  div {
    font-family: "Share Tech Mono", monospace;
  }

  .triangle-right {
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 15px 0 15px 15px;
    border-color: transparent transparent transparent #b005b5;
    position: absolute;
    right: -15px;
    top: 50%;
    transform: translateY(-50%);
  }

  .triangle-left {
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 15px 15px 15px 0;
    border-color: transparent #b005b5 transparent transparent;
    position: absolute;
    left: -15px;
    top: 50%;
    transform: translateY(-50%);
  }

  @keyframes fadeInSlideUp {
    0% {
      opacity: 0;
      transform: translateY(50px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-slide-in {
    opacity: 0;
    animation: fadeInSlideUp 1s forwards;
  }
  .glitch {
  font-size: 5rem;
  font-weight: bold;
  text-transform: uppercase;
  position: flex;
  text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
    0.025em 0.04em 0 #fffc00;
  animation: glitch 725ms infinite;
}

.glitch h2 {
  position: flex;
  top: 0;
  left: 0;
}

.glitch1{
  animation: glitch 500ms infinite;
  clip-path: polygon(0 0, 100% 0, 100% 35%, 0 35%);
  transform: translate(-0.04em, -0.03em);
  opacity: 0.75;
}

.glitch2 {
  animation: glitch 375ms infinite;
  clip-path: polygon(0 65%, 100% 65%, 100% 100%, 0 100%);
  transform: translate(0.04em, 0.03em);
  opacity: 0.75;
}

@keyframes glitch {
  0% {
    text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
      0.025em 0.04em 0 #fffc00;
  }
  15% {
    text-shadow: 0.05em 0 0 #00fffc, -0.03em -0.04em 0 #fc00ff,
      0.025em 0.04em 0 #fffc00;
  }
  16% {
    text-shadow: -0.05em -0.025em 0 #00fffc, 0.025em 0.035em 0 #fc00ff,
      -0.05em -0.05em 0 #fffc00;
  }
  49% {
    text-shadow: -0.05em -0.025em 0 #00fffc, 0.025em 0.035em 0 #fc00ff,
      -0.05em -0.05em 0 #fffc00;
  }
  50% {
    text-shadow: 0.05em 0.035em 0 #00fffc, 0.03em 0 0 #fc00ff,
      0 -0.04em 0 #fffc00;
  }
  99% {
    text-shadow: 0.05em 0.035em 0 #00fffc, 0.03em 0 0 #fc00ff,
      0 -0.04em 0 #fffc00;
  }
  100% {
    text-shadow: -0.05em 0 0 #00fffc, -0.025em -0.04em 0 #fc00ff,
      -0.04em -0.025em 0 #fffc00;
  }
}


  
</style>

<div id="timeline" class="container mx-auto p-8 pt-10 bg-white bg-opacity-70 shadow-lg rounded-lg fade-slide-in">
<div class="glitch items-center justify-items-center drop-shadow-2xl">
<h2 class="text-4xl mb-4 font-bold text-gray-100 p-4 text-center fade-slide-in">TIMELINE</h2>
</div>

  <!-- timeline -->
  <div class="bg-transparent mx-auto w-full h-full">
    <!-- line -->
    <div class="relative wrap overflow-hidden py-10 h-full fade-slide-in">
      <div class="w-1 bg-gradient-to-b  from-transparent via-[#b005b5] to-transparent absolute h-full"
        style="left: 50%"></div>

      <!-- right timeline -->
      <div class="mb-8 flex justify-between items-center w-full mx-auto fade-slide-in">
        <!-- circle -->
        <div class="order-1 w-5/12"></div>
        <div
          class="z-20 relative items-center justify-center order-1 bg-gradient-to-b from-[#b005b5] to-[#181be1] shadow-xl w-5 h-5 rounded-full ml-1">
        </div>
        <!-- box -->
        <div
          class="break-words relative order-1 bg-opacity-70 bg-gradient-to-b from-[#b005b5] to-[#181be1] rounded-lg shadow-xl w-5/12 px-6 py-4">
          <div class="triangle-left"></div>
          <h3 class="mb-3 font-bold text-white text-xl">19 Aug - 15 Oct 2024</h3>
          <p class="text-lg leading-snug tracking-wide text-white text-opacity-100">Open Registration</p>
        </div>
      </div>

      <!-- left timeline -->
      <div class="mb-8 flex justify-between flex-row-reverse items-center w-full fade-slide-in">
        <div class="order-1 w-5/12"></div>
        <div
          class="z-20 relative items-center justify-center order-1 bg-gradient-to-b from-[#b005b5] to-[#181be1] shadow-xl w-5 h-5 rounded-full ml-1">
        </div>
        <div
          class="break-words relative order-1 bg-opacity-70 bg-gradient-to-b from-[#b005b5] to-[#181be1] rounded-lg shadow-xl w-5/12 px-6 py-4 left-1">
          <div class="triangle-right"></div>
          <h3 class="mb-3 font-bold text-white text-xl">19 Oct 2024</h3>
          <p class="text-lg font-medium leading-snug tracking-wide text-white text-opacity-100">Technical Meeting</p>
        </div>
      </div>

      <div class="mb-8 flex justify-between items-center w-full fade-slide-in">
        <!-- circle -->
        <div class="order-1 w-5/12"></div>
        <div
          class="z-20 relative items-center justify-center order-1 bg-gradient-to-b from-[#b005b5] to-[#181be1] shadow-xl w-5 h-5 rounded-full ml-1">
        </div>
        <div
          class="break-words relative order-1 bg-opacity-70 bg-gradient-to-b from-[#b005b5] to-[#181be1] rounded-lg shadow-xl w-5/12 px-6 py-4">
          <div class="triangle-left"></div>
          <h3 class="mb-3 font-bold text-white text-xl">21-23 Oct 2024</h3>
          <p class="text-lg leading-snug tracking-wide text-white text-opacity-100">Pre-eliminary</p>
        </div>
      </div>

      <div class="mb-8 flex justify-between flex-row-reverse items-center w-full fade-slide-in">
        <div class="order-1 w-5/12"></div>
        <div
          class="z-20 relative items-center justify-center order-1 bg-gradient-to-b from-[#b005b5] to-[#181be1] shadow-xl w-5 h-5 rounded-full ml-1">
        </div>
        <div
          class="break-words relative order-1 bg-opacity-70 bg-gradient-to-b from-[#b005b5] to-[#181be1] rounded-lg shadow-xl w-5/12 px-6 py-4 left-1">
          <div class="triangle-right"></div>
          <h3 class="mb-3 font-bold text-white text-xl">2 Nov 2024</h3>
          <p class="text-lg font-medium leading-snug tracking-wide text-white text-opacity-100">Semifinal & Final</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
 document.addEventListener('DOMContentLoaded', () => {
    const fadeElements = document.querySelectorAll('.fade-slide-in');

    const scrollHandler = () => {
      fadeElements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const viewportHeight = window.innerHeight;

        if (elementTop < viewportHeight - 150) {
          element.classList.add('fade-slide-in');
        }
      });
    };
    scrollHandler();

    window.addEventListener('scroll', scrollHandler);
  });
</script>
