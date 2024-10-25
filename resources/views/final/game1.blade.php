@extends('layout.user')

@section('head')
    <style>
        * {
            font-family: 'Fira Code', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @keyframes flicker {

            0%,
            5%,
            10%,
            42%,
            55%,
            70%,
            85%,
            92% {
                box-shadow: 0 0 5px #853987, 0 0 15px #853987, 0 0 25px #023583;
            }

            2%,
            7%,
            20%,
            47%,
            60%,
            77%,
            89%,
            97% {
                box-shadow: 0 0 15px #853987, 0 0 40px #853987, 0 0 70px #023583;
            }

            3%,
            15%,
            50%,
            63%,
            75%,
            88%,
            95% {
                box-shadow: 0 0 5px #853987, 0 0 20px #853987, 0 0 40px #023583;
            }

            100% {
                box-shadow: 0 0 10px #853987, 0 0 30px #853987, 0 0 50px #023583;
            }
        }


        canvas {
            display: block;
        }

        .main-layer {
            backdrop-filter: blur(15px) brightness(0.7);
        }

        .question-container {
            box-shadow: 0 0 20px #853987, 0 0 60px #853987, 0 0 100px #023583;
            animation: flicker 15s 1s infinite;
            transition: all .5s ease;
            background-color: rgba(51, 123, 238, 0.401);
        }

        .input-answer {
            box-shadow: 0 0 5px #009dff, 0 0 8px rgb(88, 219, 255);
            transition: all .2s ease;
        }

        .input-answer:focus {
            /* box-shadow: 0 0 5px white, 0 0 8px white; */
            box-shadow: 0 0 5px white, 0 0 12px rgb(132, 228, 255);
            outline: none;
        }

        .submit-button {
            transition: all .2s ease;
            box-shadow: 0 0 5px white, 0 0 8px rgb(132, 228, 255);
        }

        .submit-button:hover {
            box-shadow: 0 0 8px white, 0 0 13px rgb(132, 228, 255);
        }

        .submit-button:active {
            box-shadow: 0 0 2px white, 0 0 3px rgb(132, 228, 255);
        }

        body {
            overflow-x: hidden;
        }
    </style>
@endsection

@section('content')
    <div id="mainBackground" class="w-[500px] h-[500px] fixed z-0 top-0 left-0"></div>
    <div class="main-layer absolute w-screen min-h-screen z-50 top-0 left-0">
        <div class="w-full h-full flex items-center flex-col">
            <h1 class="w-full text-center text-4xl text-white font-semibold my-8">IRGL Final Game 1</h1>
            <h1 class="w-full text-center text-2xl text-white font-semibold my-8">{{ $team_name }} Score :
                {{ $score }}</h1>
            @foreach ($questions as $question)
                <div class="question-container w-[800px] h-fit p-8 rounded-3xl bg-opacity-30 my-8">
                    <p class="text-zinc-100">{{ $question->question }}</p>
                    {{-- Tambahi image --}}
                    <div class="flex justify-center items-center mt-8 gap-x-8">
                        <input type="text" id="{{ 'answer-' . $question->id }}" placeholder="Answer here"
                            class="input-answer bg-transparent rounded-lg w-full h-[40px] px-4 text-zinc-100 bg-white bg-opacity-20">
                        <button id="{{ 'submit-' . $question->id }}"
                            class="submit-button bg-[#853987] bg-opacity-70 text-zinc-100 text-sm rounded-xl w-[300px] h-[40px]"
                            name="{{ $question->id }}">
                            Submit This Answer</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function submitAnswer(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let answer = document.getElementById('answer-' + id).value;
                    $.ajax({
                        url: "{{ route('final.game1.store', '') }}/" + id,
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "answer": answer
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops...',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })

        }

        let submitButtons = document.querySelectorAll('.submit-button');
        for (let i = 0; i < submitButtons.length; i++) {
            let questionId = parseInt(submitButtons[i].name, 10)
            submitButtons[i].addEventListener('click', function() {
                submitAnswer(questionId);
            })
        }
    </script>

    <!-- GLSL SCRIPT -->
    <!-- vertex shader -->
    <script id="vertexShader" type="x-shader/x-vertex">
        void main() {
            gl_Position = vec4(position, 1.0);
        }
    </script>

    <!-- fragment shader -->
    <script id="fragmentShader" type="x-shader/x-fragment">
		#define TWO_PI 6.28318530718
		uniform vec2 resolution;
		uniform float time;
		uniform vec2 colsrows;

		float HueToRGB(float f1, float f2, float hue)
		{
			if (hue < 0.0)
				hue += 1.0;
			else if (hue > 1.0)
				hue -= 1.0;
			float res;
			if ((6.0 * hue) < 1.0)
				res = f1 + (f2 - f1) * 6.0 * hue;
			else if ((2.0 * hue) < 1.0)
				res = f2;
			else if ((3.0 * hue) < 2.0)
				res = f1 + (f2 - f1) * ((2.0 / 3.0) - hue) * 6.0;
			else
				res = f1;
			return res;
		}


		vec3 HSLToRGB(vec3 hsl)
		{
			vec3 rgb;

			if (hsl.y == 0.0)
				rgb = vec3(hsl.z);
			else
			{
				float f2;

				if (hsl.z < 0.5)
					f2 = hsl.z * (1.0 + hsl.y);
				else
					f2 = (hsl.z + hsl.y) - (hsl.y * hsl.z);

				float f1 = 2.0 * hsl.z - f2;

				rgb.r = HueToRGB(f1, f2, hsl.x + (1.0/3.0));
				rgb.g = HueToRGB(f1, f2, hsl.x);
				rgb.b= HueToRGB(f1, f2, hsl.x - (1.0/3.0));
			}

			return rgb;
		}

		mat2 rotate2d(float _angle){
			return mat2(cos(_angle),-sin(_angle),
						sin(_angle),cos(_angle));
		}

		vec2 rotateFrom(vec2 uv, vec2 center, float angle){
			vec2 uv_ = uv - center;
			uv_ =  rotate2d(angle) * uv_;
			uv_ = uv_ + center;

			return uv_;
		}

		float random(float value){
			return fract(sin(value) * 43758.5453123);
		}

		float random(vec2 tex){
			return fract(sin(dot(tex.xy, vec2(12.9898, 78.233))) * 43758.5453123);
		}

		vec2 random2D(vec2 uv){
			uv = vec2(dot(uv, vec2(127.1, 311.7)), dot(uv, vec2(269.5, 183.3)));

			return fract(sin(uv) * 43758.5453123);
		}

		vec3 random3D(vec3 uv){
			uv = vec3(dot(uv, vec3(127.1, 311.7, 120.9898)), dot(uv, vec3(269.5, 183.3, 150.457)), dot(uv, vec3(380.5, 182.3, 170.457)));
			return -1.0 + 2.0 * fract(sin(uv) * 43758.5453123);
		}

		float cubicCurve(float value){
			return value * value * (3.0 - 2.0 * value);
		}

		vec2 cubicCurve(vec2 value){
			return value * value * (3.0 - 2.0 * value);
		}

		vec3 cubicCurve(vec3 value){
			return value * value * (3.0 - 2.0 * value);
		}

		float noise(vec2 uv){
			vec2 iuv = floor(uv);
			vec2 fuv = fract(uv);
			vec2 suv = cubicCurve(fuv);

			float dotAA_ = dot(random2D(iuv + vec2(0.0)), fuv - vec2(0.0));
			float dotBB_ = dot(random2D(iuv + vec2(1.0, 0.0)), fuv - vec2(1.0, 0.0));
			float dotCC_ = dot(random2D(iuv + vec2(0.0, 1.0)), fuv - vec2(0.0, 1.0));
			float dotDD_ = dot(random2D(iuv + vec2(1.0, 1.0)), fuv - vec2(1.0, 1.0));

			return mix(
				mix(dotAA_, dotBB_,	suv.x),
				mix(dotCC_, dotDD_, suv.x),
				suv.y);
		}

		float noise(vec3 uv){
			vec3 iuv = floor(uv);
			vec3 fuv = fract(uv);
			vec3 suv = cubicCurve(fuv);

			float dotAA_ = dot(random3D(iuv + vec3(0.0)), fuv - vec3(0.0));
			float dotBB_ = dot(random3D(iuv + vec3(1.0, 0.0, 0.0)), fuv - vec3(1.0, 0.0, 0.0));
			float dotCC_ = dot(random3D(iuv + vec3(0.0, 1.0, 0.0)), fuv - vec3(0.0, 1.0, 0.0));
			float dotDD_ = dot(random3D(iuv + vec3(1.0, 1.0, 0.0)), fuv - vec3(1.0, 1.0, 0.0));

			float dotEE_ = dot(random3D(iuv + vec3(0.0, 0.0, 1.0)), fuv - vec3(0.0, 0.0, 1.0));
			float dotFF_ = dot(random3D(iuv + vec3(1.0, 0.0, 1.0)), fuv - vec3(1.0, 0.0, 1.0));
			float dotGG_ = dot(random3D(iuv + vec3(0.0, 1.0, 1.0)), fuv - vec3(0.0, 1.0, 1.0));
			float dotHH_ = dot(random3D(iuv + vec3(1.0, 1.0, 1.0)), fuv - vec3(1.0, 1.0, 1.0));

			float passH0 = mix(
				mix(dotAA_, dotBB_,	suv.x),
				mix(dotCC_, dotDD_, suv.x),
				suv.y);

			float passH1 = mix(
				mix(dotEE_, dotFF_,	suv.x),
				mix(dotGG_, dotHH_, suv.x),
				suv.y);

			return mix(passH0, passH1, suv.z);
		}

		float rect(vec2 uv, vec2 length, float lembut){
			float dx = abs(uv.x - 0.5);
			float dy = abs(uv.y - 0.5);
			float lenx = 1.0 - smoothstep(length.x - lembut, length.x + lembut, dx);
			float leny = 1.0 - smoothstep(length.y - lembut, length.y + lembut, dy);

			return lenx * leny;
		}

		vec4 addGrain(vec2 uv, float time, float grainIntensity){
    		float grain = random(fract(uv * time)) * grainIntensity;
    		return vec4(vec3(grain), 1.0);
		}

		vec2 fishey(vec2 uv, vec2 center, float ratio, float dist){
			  vec2 puv = uv + vec2(1.0);

			  vec2 m = vec2(center.x, center.y/ratio) + vec2(1.0);

			  vec2 d = puv - m;

			  float r = sqrt(dot(d, d));

			  float power = ( TWO_PI / (2.0 * sqrt(dot(m, m)))) * mix(0.1, 0.4, pow(dist, 0.75));

			  float bind;
			  if (power > 0.0) bind = sqrt(dot(m, m));



			  vec2 nuv;
			  if (power > 0.0)
				nuv = m + normalize(d) * tan(r * power) * bind / tan( bind * power);
			  else if (power < 0.0)
			   nuv = m + normalize(d) * atan(r * -power * 10.0) * bind / atan(-power * bind * 10.0);
			  else
				nuv = puv;

			return nuv - vec2(1.0);
		}

		float addStreamLine(vec2 uv, float rows, float height, float lembut){
			vec2 uvstream = uv * vec2(1.0, rows);
			float distFromCenter = abs(0.5 - fract(uvstream.y));
			float edge = smoothstep(height - lembut*0.5, height + lembut*0.5, distFromCenter);
			/*
			vec2 iuv = floor(uvstream);
			float modrow = mod(iuv.y, 2.0);
			*/
			return edge;
			}

		void main(){
			vec2 uv = gl_FragCoord.xy / resolution.xy;
			vec2 ouv = uv;
			float ratio = resolution.x / resolution.y;

			float horizontalGlitch = sin(random(uv.y) * TWO_PI);
			float noiseAmp = noise(vec2(uv.y + time * horizontalGlitch));
			float minAmp = 0.001;
			float maxAmp = 0.005;
			float amp = mix(minAmp, maxAmp, noiseAmp);
			uv.x = fract(uv.x + amp);

			uv = fishey(uv, vec2(0.5, 0.5/ratio), 1.0, 2.0);
			uv = rotateFrom(uv, vec2(0.5, 0.5 * ratio), time * 0.01);


			float indexCol = floor(uv.x * (colsrows.x * 2.0)/ratio);
			float randColIndex = random(indexCol);
			float orientation = randColIndex * 2.0 - 1.0;
			float minSpeed = 0.1;
			float maxSpeed = 0.5;
			float speed = mix(minSpeed, maxSpeed, randColIndex);

			uv.y += time * speed * orientation;
			uv.y += floor(time);


			vec2 nuv = uv * vec2(colsrows.x, colsrows.x / ratio);
			vec2 fuv = fract(nuv);
			vec2 iuv = floor(nuv);

			#define OCTAVE 4
			#define SUBDIV 3
			float sub = 0.0;
			for(int i=0; i<OCTAVE; i++){
				float randRatio = random(iuv + floor(time));
				float noiseRatio = sin(noise(vec3(iuv * 0.05, time)) * (TWO_PI * 0.5)) * 0.5;
				if(randRatio + noiseRatio > 0.5){
					nuv = fuv * vec2(SUBDIV);
					fuv = fract(nuv);
					iuv += floor(nuv + float(i));
					sub ++;
				}
			}
			float indexRatio = step(2.0, sub);
			float index = random(iuv);
			float isLight = step(0.5, index) * indexRatio;


			float randIndex = random(iuv * 0.01 + floor(time));
			float minSize = 0.05;
			float maxSize = 0.35;
			float size = mix(minSize, maxSize, randIndex);

			float shape = rect(fuv, vec2(size), 0.01) * isLight;


			float shiftNoiseAnimation = noise(vec2(iuv * time * 0.1)) * 0.25;
			float shiftRandomAnimation = random(vec2(time)) * 0.01;
			vec2 offset = vec2(shiftRandomAnimation + shiftNoiseAnimation, 0.0);
			float shapeRed = rect(fuv - offset, vec2(size), 0.01);
			float shapeGreen = rect(fuv + offset, vec2(size), 0.01);
			float shapeBlue = rect(fuv, vec2(size), 0.01);

			float minHue = 0.6;
			float maxHue = 1.0;
			float hue = mix(minHue, maxHue, randIndex);

			float randIndex2 = random(iuv * 0.5 + floor(time));
			float minLightness = 0.65;
			float maxLightness = 0.85;
			float lightness = mix(minLightness, maxLightness, randIndex2);

			vec3 background = HSLToRGB(vec3(336.0/360.0, 0.75, 0.075));
			vec3 foreground = HSLToRGB(vec3(hue, 1.0, lightness));

			vec3 shapeShift = vec3(shapeRed, shapeGreen, shapeBlue) * shape;
			vec3 final = mix(background, foreground, shapeShift);


			float randGrain = random(time * 0.001);
			vec4 grain = addGrain(uv, time, 0.05 + randGrain * 0.05);

			vec2 souv = fract(ouv + vec2(0.0, time * 0.05));
			float brightness = sin(souv.y * TWO_PI * 2.0);
			float vhsLines = addStreamLine(souv, 200.0, 0.35, 0.01) * brightness;

			gl_FragColor = vec4(final, 1.0) + vhsLines * 0.05 + grain;
		}

    </script>

    <script type="module">
        import * as THREE from "three";


        var container;
        var camera, scene, renderer;
        var uniforms;
        var startTime;


        var cols = 3.;
        var rows = 2.0;

        init();
        animate();

        function init() {

            container = document.getElementById('mainBackground');


            startTime = Date.now();
            camera = new THREE.Camera();
            camera.position.z = 1;
            scene = new THREE.Scene();


            var geometry = new THREE.PlaneGeometry(16, 9);


            uniforms = {
                time: {
                    type: "f",
                    value: 1.0
                },
                resolution: {
                    type: "v2",
                    value: new THREE.Vector2()
                },
                colsrows: {
                    type: "v2",
                    value: new THREE.Vector2()
                }
            };


            var material = new THREE.ShaderMaterial({

                uniforms: uniforms,
                vertexShader: document.getElementById('vertexShader').textContent,
                fragmentShader: document.getElementById('fragmentShader').textContent
            });


            var mesh = new THREE.Mesh(geometry, material);
            scene.add(mesh);


            renderer = new THREE.WebGLRenderer();
            container.appendChild(renderer.domElement);


            onWindowResize();
            window.addEventListener('resize', onWindowResize, false);

        }

        function onWindowResize(event) {
            container.style.height = window.innerHeight + "px";
            container.style.width = window.innerWidth + "px";

            var canvasWidth = container.offsetWidth;
            var canvasHeight = container.offsetHeight;

            uniforms.resolution.value.x = canvasWidth;
            uniforms.resolution.value.y = canvasHeight;



            uniforms.colsrows.value.x = cols;
            uniforms.colsrows.value.y = rows;

            renderer.setSize(canvasWidth, canvasHeight);
        }

        function animate() {
            render();
            requestAnimationFrame(animate);
        }

        function render() {
            var currentTime = Date.now();
            var elaspedSeconds = (currentTime - startTime) / 1000.0;
            var maxTime = 4.0;
            var normTime = (elaspedSeconds % maxTime) / maxTime;
            uniforms.time.value = elaspedSeconds * 1.0;

            renderer.render(scene, camera);
        }
    </script>
@endsection
