import * as Three from "three";
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

let videoReady = false;
let modelReady = false;

const video = document.getElementById("entranceVideo");
video.addEventListener('canplaythrough', () => {
    videoReady = true;
});
class CameraController {
    constructor(camera, target) {
        this._camera = camera;
        this._target = target;
        this._xmove = 0;
        this._ymove = 0;
        this._prevX = 0;
        this._prevY = 0;
        this._isHold = false;
        this._positionState = 0;
        this._isCameraMove = false;
        this._positions = {
            home: { x: 32.137148559873054, y: 10.934339507232652, z: -11.06945160231319 },
            home_out: { x: 12.950184689755782, y: 12.176477967077068, z: 15.569973545478323 },
            about: { x: 8.5, y: 8, z: 17.3 },
            about_out: { x: 10, y: 7.9046573820083106, z: 21.796876990736383 },
            timeline: { x: -4.85, y: 3.52, z: 18.54030467164695 },
            timeline_out: { x: 16.80896476498577, y: 10.112139828222576, z: 17.02780744372623 },
            login: { x: 14.81, y: 3.606665, z: 12.600139 },
            login_out: { x: 17.703155174424527, y: 3.8174647293483432, z: 12.544091884045505 }
        };
        this._lookPositions = {
            home: { x: -4.274588286299647, y: 14.114813344928013, z: 4.945554507682633 },
            home_out: { x: 11.93577751182221, y: 15.984156527223945, z: -24.140012311360703 },
            about: { x: 8.4, y: 8.1, z: -24.13495228 },
            about_out: { x: 9.012601887652732, y: 5.459247781458146, z: -20.600977871193717 },
            timeline: { x: -4.45, y: 2.9164828638132603, z: -24.46624425085919 },
            timeline_out: { x: -3.5168734956353696, y: 10.834324674085014, z: -20.86785283080913 },
            login: { x: -26.58564185350557, y: -0.6806091267574303, z: 13.679204825126408 },
            login_out: { x: -24.571200396210312, y: 0.280343600874827, z: 11.937758135652755 },
        };

        this._Initialize();
    }

    _Initialize() {
        const audioLoader = new Three.AudioLoader();
        const listener = new Three.AudioListener();
        this._camera.add(listener);

        audioLoader.load('/assets/click.mp3', (buffer) => {
            this._sound = new Three.Audio(listener);
            this._sound.setBuffer(buffer);
            this._sound.setLoop(false);
            this._sound.setVolume(0.5);
        });
        window.addEventListener('mousemove', (e) => {
            if (this._isHold) {
                this._xmove += (e.clientX - this._prevX);
                this._ymove += (e.clientY - this._prevY);

                this._ymove = Math.max(-1000, Math.min(1000, this._ymove));
            }
            this._prevX = e.clientX;
            this._prevY = e.clientY;
        });

        const links = [
            { id: "home-link", position: this._positions.home, lookPosition: this._lookPositions.home, state: 0 },
            { id: "about-link", position: this._positions.about, lookPosition: this._lookPositions.about, state: 1 },
            { id: "timeline-link", position: this._positions.timeline, lookPosition: this._lookPositions.timeline, state: 2 },
            { id: "login-link", position: this._positions.login, lookPosition: this._lookPositions.login, state: 3 }
        ];

        links.forEach(link => {
            const element = document.getElementById(link.id);
            element.addEventListener('click', () => {
                if (this._positionState === link.state || this._isCameraMove) return;
                this._isCameraMove = true;
                if (this._sound) {
                    this._sound.play();
                }
                this.moveCameraTo(this._positions[`${link.id.split('-')[0]}_out`], this._lookPositions[`${link.id.split('-')[0]}_out`]);
                setTimeout(() => this.moveCameraTo(link.position, link.lookPosition), 3000);
                setTimeout(() => { this._isCameraMove = false; }, 6000);
                this._positionState = link.state;
            });
        });

        this.setCameraTo(this._positions.home, this._lookPositions.home);
        this._positionState = 0;
    }

    setCameraTo(pos, lookPos) {
        this._camera.position.set(pos.x, pos.y, pos.z);
        this._target = new Three.Vector3(lookPos.x, lookPos.y, lookPos.z);
    }

    moveCameraTo(pos, lookPos, duration = 3) {
        gsap.to(this._camera.position, {
            x: pos.x, y: pos.y, z: pos.z, duration: duration,
        });
        gsap.to(this._target, {
            x: lookPos.x, y: lookPos.y, z: lookPos.z, duration: duration,
        });
    }

    _Update() {
        this._camera.lookAt(this._target);
    }
}

const renderer = new Three.WebGLRenderer({ antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.setPixelRatio(window.devicePixelRatio);
document.body.appendChild(renderer.domElement);

const scene = new Three.Scene();
const camera = new Three.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const cameraTarget = new Three.Vector3(0, 0, 0);
const cameraController = new CameraController(camera, cameraTarget);

const addLight = (color, intensity, position, castShadow = true) => {
    const light = new Three.PointLight(color, intensity);
    light.position.set(...position);
    light.castShadow = castShadow;
    scene.add(light);
};
const light = new Three.DirectionalLight(0xD3D3D3, 1.5);
light.position.set(3, 13, 12);
scene.add(light);
addLight(0xE900D6, 100, [20, 3, 2.2]);
// addLight(0xE900D6, 1, [17.8, 4, -17]);
addLight(0xDD6CFF, 100, [20.01, 10.256, -4.857]);
// addLight(0xDD6CFF, 140, [20.01, 10.256, -10.857]);
// addLight(0x0C17EF, 140, [10, 8, 11]);
// addLight(0xDD6CFF, 10, [-1.3, 3.45, 8]);
addLight(0x0C17EF, 100, [20, 3, 10]);
// addLight(0xE900D6, 50, [15, 5.7, 20]);

scene.fog = new Three.Fog(0x061327, 0, 55);


const checkReadyState = () => {
    if (videoReady && modelReady) {
        setTimeout(() => {
            document.getElementById('loading-screen').style.display = 'none';
            document.getElementById('start-screen').style.display = 'flex';
        }, 1000);
    }
};

const loadingManager = new Three.LoadingManager();
loadingManager.onLoad = function () {
    console.log(videoReady);
    console.log(modelReady);
    modelReady = true;
    checkReadyState();
};


let mod;
const gltfLoader = new GLTFLoader(loadingManager);
let mixer;
gltfLoader.load("./coba/untitled.gltf", (gltf) => {
    const model = gltf.scene;
    scene.add(model);
    mod = model;
    mixer = new Three.AnimationMixer(model);
    gltf.animations.forEach((clip) => {
        mixer.clipAction(clip).play();
    });
});

function animate(time) {
    renderer.render(scene, camera);
    cameraController._Update();
    if (mixer) mixer.update(0.01);
}
renderer.setAnimationLoop(animate);

window.addEventListener("resize", () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

const listener = new Three.AudioListener();
camera.add(listener);
const sound = new Three.Audio(listener);

const audioLoader = new Three.AudioLoader();
audioLoader.load('/assets/cobalagi.mp3', function (buffer) {
    sound.setBuffer(buffer);
    sound.setLoop(true);
    sound.setVolume(0.5);
});
const mutedIcon = document.getElementById('muted');
const unmutedIcon = document.getElementById('unmuted');
let isMuted = false;

const toggleMute = () => {
    isMuted = !isMuted;
    if (isMuted) {
        sound.setVolume(0);
        mutedIcon.classList.remove('hidden');
        unmutedIcon.classList.add('hidden');
    } else {
        sound.setVolume(1);
        mutedIcon.classList.add('hidden');
        unmutedIcon.classList.remove('hidden');
    }
};
mutedIcon.addEventListener('click', toggleMute);
unmutedIcon.addEventListener('click', toggleMute);

function startAudio() {
    if (Three.AudioContext.state === 'suspended') {
        Three.AudioContext.resume();
    }
    sound.play();
}
const startScreen = document.getElementById('start-screen');
const startButton = document.getElementById('start-button');
let actionTaken = false;
startButton.addEventListener('click', () => {
    startScreen.style.display = 'none';
    video.play();
});
video.addEventListener('ended', () => {
    video.style.display = 'none';
    videoContainer.style.display = 'none';
    startAudio();
    renderer.setAnimationLoop(animate);
});
video.addEventListener('timeupdate', function () {
    if (!actionTaken && video.duration - video.currentTime <= 1.1) {
        actionTaken = true; videoContainer.style.opacity = 0;
        video.style.opacity = 0;
    }
}) 
document.body.style.margin = 0; document.body.style.overflow = "hidden";
renderer.domElement.style.display = "block"; const aboutMeBoxes = new Three.Group(); const hitBoxMaterial = new
    Three.MeshBasicMaterial({ color: 0xff0000, wireframe: true }); const aboutMeHitBoxGeometry = new
        Three.PlaneGeometry(1, 0.35); const logregHitBoxGeometry = new Three.PlaneGeometry(0.3, 0.07); const
            createHitBox = (geometry, position, rotationY = 0) => {
                const hitBox = new Three.Mesh(geometry, hitBoxMaterial);
                hitBox.position.set(...position);
                hitBox.rotation.y = rotationY;
                return hitBox;
            };

const days = [
    { position: [-6.85, 3.55, 14.35] },
    { position: [-6.85, 3.05, 14.35] },
    { position: [-6.85, 2.55, 14.35] },
    { position: [-6.85, 2.05, 14.35] },
    { position: [-6.85, 1.55, 14.35] },
];
days.forEach(day => aboutMeBoxes.add(createHitBox(aboutMeHitBoxGeometry, day.position)));

aboutMeBoxes.add(createHitBox(logregHitBoxGeometry, [13.41, 3.23, 12.57], Math.PI / 2));
aboutMeBoxes.add(createHitBox(logregHitBoxGeometry, [13.41, 3.13, 12.57], Math.PI / 2));


aboutMeBoxes.visible = false;
scene.add(aboutMeBoxes);

const objectsToTest = [...aboutMeBoxes.children];

const touchedPoints = [];
let cursor = new Three.Vector2();
let cursorXMin, cursorXMax, cursorYMin, cursorYMax;
let absX, absY;

window.addEventListener('pointerdown', (event) => {
    touchedPoints.push(event.pointerId);

    cursorXMin = Math.abs((event.clientX / window.innerWidth * 2 - 1) * 0.9);
    cursorXMax = Math.abs((event.clientX / window.innerWidth * 2 - 1) * 1.1);

    cursorYMin = Math.abs((event.clientY / window.innerHeight * 2 - 1) * 0.9);
    cursorYMax = Math.abs((event.clientY / window.innerHeight * 2 - 1) * 1.1);
});

window.addEventListener('pointerup', (event) => {
    cursor.x = event.clientX / window.innerWidth * 2 - 1;
    cursor.y = - (event.clientY / window.innerHeight) * 2 + 1;

    absX = Math.abs(cursor.x);
    absY = Math.abs(cursor.y);

    if (touchedPoints.length === 1 && absX > cursorXMin && absX < cursorXMax && absY > cursorYMin && absY < cursorYMax) {
        handleClick(cursor);
    } touchedPoints.length = 0;
}); const raycaster = new Three.Raycaster(); const
    handleClick = (cursor) => {
        raycaster.setFromCamera(cursor, camera);
        const intersects = raycaster.intersectObjects(objectsToTest);
        if (intersects.length) {
            const selectedModel = intersects[0].object;
            const dayTextures = ['day1', 'day2', 'day3', 'day4', 'day5'];
            const dayIndex = aboutMeBoxes.children.indexOf(selectedModel);
            if (dayIndex !== -1 && dayIndex < 5) { changeTexture(dayTextures[dayIndex]); } else if
                (selectedModel === aboutMeBoxes.children[5]) { window.location.href = '/login'; } else if
                (selectedModel === aboutMeBoxes.children[6]) { window.location.href = '/register'; }
        }
    }; const loader = new
        Three.TextureLoader(); const textures = {
            day1: loader.load('coba/early.jpg'), day2:
                loader.load('coba/normal.jpg'), day3: loader.load('coba/tm.jpg'), day4: loader.load('coba/prelim.jpg'),
            day5: loader.load('coba/final.jpg'),
        }; const geometry = new Three.PlaneGeometry(5, 2.97); const
            material = new Three.MeshBasicMaterial({ map: textures.day1 }); const textureMesh = new Three.Mesh(geometry,
                material); textureMesh.position.set(-5.2, 2.6, 14.329); textureMesh.rotation.x = -0.01;
textureMesh.rotation.z = -0.005; scene.add(textureMesh); const changeTexture = (day) => {
    textureMesh.material.map = textures[day];
    textureMesh.material.needsUpdate = true;
};

const updateRaycaster = () => {
    raycaster.setFromCamera(cursor, camera);
    const intersects = raycaster.intersectObjects(objectsToTest);
    if (intersects.length) {
        document.body.style.cursor = "pointer";
    } else {
        document.body.style.cursor = "";
    }
};
