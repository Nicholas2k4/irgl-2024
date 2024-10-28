<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinalQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            // ABC
            [
                'question' => '<p class="text-zinc-100">Bilangan a, b, c, d , e adalah bilangan bulat positif berbeda yang memenuhi ABCDE*4 = EDCBA</p><br><p class="text-zinc-100">Berapa nilai dari A + 2B + 3C + 4D + 5E?</p>',
                'answer' => '99',
                'image' => null,
                'category' => 'quiz',
            ],
            // Pacuan Kuda
            [
                'question' => '<p class="text-zinc-100">Kamu memiliki 25 ekor kuda dan hanya 5 lintasan balap. Kamu tidak memiliki alat pengukur waktu, tetapi dapat melakukan balapan untuk mengetahui urutan kuda dalam setiap perlombaan. Berapa jumlah minimum balapan yang diperlukan untuk menemukan 3 kuda tercepat?</p>',
                'answer' => '7',
                'image' => null,
                'category' => 'quiz',
            ],
            // Bridge to the moon
            [
                'question' => '<p class="text-zinc-100">Ada 4 orang yang harus menyeberangi jembatan di malam hari. Mereka hanya memiliki satu senter dan jembatan hanya bisa menahan dua orang sekaligus. Setiap orang berjalan dengan kecepatan berbeda: 1 menit, 2 menit, 7 menit, dan 10 menit. Ketika dua orang menyeberang bersama, mereka bergerak dengan kecepatan yang lebih lambat. Bagaimana cara tercepat bagi semua orang untuk menyeberangi jembatan?</p>',
                'answer' => '17',
                'image' => null,
                'category' => 'quiz',
            ],
            // Real or fake
            [
                'question' => '<p class="text-zinc-100">Kamu memiliki 80 koin, di antaranya ada satu koin palsu yang lebih ringan dari koin lainnya. Kamu memiliki neraca tanpa bobot untuk melakukan penimbangan. Berapa jumlah minimum penimbangan yang diperlukan untuk menemukan koin palsu?</p>',
                'answer' => '4',
                'image' => null,
                'category' => 'quiz',
            ],
            // Sharing is Caring
            // [
            //     'question' => '<p class="text-zinc-100">Terdapat 5 orang mahasiswa dan mereka semua rapat. Di tengah perjalanan mereka memutuskan untuk makan siang di HiHi fried chicken. Berikut adalah menu yang ditawarkan dengan harga dalam ribuan rupiah:</p><br><p class="text-zinc-100">Nasi 4</p><br><p class="text-zinc-100">Burger 4</p><br><p class="text-zinc-100">Paket Lauk 2</p><br><p class="text-zinc-100">Es Cendol 1</p><br><p class="text-zinc-100">Secara kolektif mereka semua hanya memiliki 30.000 rupiah untuk makan siang. Berikut adalah cara mereka menentukan makanan yang dipesan.</p><br><p class="text-zinc-100">- Setiap orang akan makan nasi</p><p class="text-zinc-100">- Setiap yang memesan nasi harus memesan paket lauk.</p><p class="text-zinc-100"> - Setiap orang baik yang memesan nasi maupun burger dapat memesan paling banyak 1 es cendol.</p><br><p class="text-zinc-100">Jika uang mereka tidak harus seluruhnya dibelanjakan tetapi harus memenuhi kriteria di atas, tentukan ada berapa banyak cara mereka membagi menu untuk makan siang</p>',
            //     'answer' => '638',
            //     'image' => null,
            //     'category' => 'quiz',
            // ],
            // Lights out
            [
                'question' => '<p class="text-zinc-100">Di rumah barumu, circuit breaker terletak di sudut ruang bawah tanah yang tidak nyaman. Yang membuat frustasi, tidak satu pun dari 100 circuit breaker tersebut diberi label, sehingga kamu harus mencocokkan setiap circuit breaker dengan lampu yang dikendalikannya. Setiap circuit breaker hanya memetakan satu lampu tertentu. Untuk memulai, kamu menghidupkan semua 100 lampu di rumah, kemudian pergi ke ruang bawah tanah untuk memulai memetakan. Pada setiap perjalanan ke ruang bawah tanah, kamu bisa menghidupkan atau mematikan sejumlah circuit breaker. Setelah itu, kamu kembali ke seluruh rumah untuk melihat lampu mana yang masih menyala dan mana yang sudah mati. Proses ini terus berlanjut sampai setiap circuit breaker berhasil dicocokkan dengan lampu yang dikendalikannya. Berapa jumlah minimum perjalanan yang perlu kamu lakukan ke ruang bawah tanah untuk memetakan setiap circuit breaker ke setiap lampu?</p>',
                'answer' => '7',
                'image' => null,
                'category' => 'quiz',
            ],
            // 1 to 100
            [
                'question' => '<p class="text-zinc-100">Buatlah angka 100 dari hasil perhitungan pertambahan dan/atau pengurangan deret angka 987654321 tanpa mengubah urutan posisi deret tersebut!</p>',
                'answer' => '98-76+54+3+21',
                'image' => null,
                'category' => 'quiz',
            ],
            // Ikan Ong
            [
                'question' => '<p class="text-zinc-100">Dalam Akuarium terdapat 400 ikan. 99% diantaranya berwarna merah dan sisanya berwarna hitam. Berapa banyak ikan merah yang harus dikeluarkan agar populasi ikan merah menjadi 90%?</p>',
                'answer' => '360',
                'image' => null,
                'category' => 'quiz',
            ],
            // Unlock it!
            [
                'question' => '<p class="text-zinc-100">Bantulah Budi untuk membuka gembok code miliknya dengan clue sebagai berikut:</p><br><p class="text-zinc-100">- Code 682 : Satu digit benar dan posisi digit juga benar.</p><br><p class="text-zinc-100">- Code 614 : Satu digit benar tetapi posisi digit salah.</p><br><p class="text-zinc-100">- Code 206 : Dua digit benar tetapi posisi keduanya salah.</p><br><p class="text-zinc-100">- Code 738 : Semua digit salah.</p><br><p class="text-zinc-100">- Code 380 : Satu digit benar tetapi posisi digit salah.</p>',
                'answer' => '042',
                'image' => null,
                'category' => 'quiz',
            ],
            // Under investigation
            [
                'question' => '<p class="text-zinc-100">Seorang Detektif mendapati bahwa ada 4 saksi mata perampokan. Berdasarkan Cerita para saksi, detektif ini menyimpulkan bahwa</p><br><p class="text-zinc-100">- Jika Si pramusaji berkata jujur maka Si koki juga demikian</p><br><p class="text-zinc-100">- Si koki dan Si tukang kebun tidak mungkin mengatakan hal yang benar bersamaan</p><br><p class="text-zinc-100">- Si tukang kebun dan Si badut, keduanya tidak berbohong</p><br><p class="text-zinc-100">- Jika Si badut berkata hal yang benar maka Si koki berbohong</p>',
                'answer' => '7',
                'image' => null,
                'category' => 'quiz',
            ],
            // Two Bucket
            [
                'question' => '<p class="text-zinc-100">Diberikan 2 Ember dengan kapasitas berbeda yaitu 7L dan 4L. Hitunglah Total langkah yang diperlukan untuk mendapatkan 2L, 6L, 5L, dan 1L dan di salah satu Ember ini</p><br><p class="text-zinc-100">Langkah yang Tersedia :</p><br><p class="text-zinc-100">- Mengisi ember hingga penuh,</p><br><p class="text-zinc-100">- Mengosongkan ember,</p><br><p class="text-zinc-100">- Menuang air dari salah satu ember ke ember lainnya hingga penuh (Misal ember dengan kapasitas 5L sekarang memiliki 3L air, jika akan dituangkan air dari ember satunya maka hanya 2L yang dapat dituang).</p>',
                'answer' => '6',
                'image' => null,
                'category' => 'quiz',
            ],
            // Fin fin fin find it!
            [
                'question' => '<p class="text-zinc-100">ABC</p><br><p class="text-zinc-100">ABC</p><br><p class="text-zinc-100">ABC</p><br><p class="text-zinc-100">________ +</p><br><p class="text-zinc-100">CCC</p><br><p class="text-zinc-100">Tentukan nilai A, B, dan C!</p><br>',
                'answer' => '555',
                'image' => null,
                'category' => 'quiz',
            ],
            // Tower of Babel
            [
                'question' => '<p class="text-zinc-100">Diberikan 3 tiang (A, B, C) dan sejumlah cakram dengan ukuran berbeda yang tersusun dari besar ke kecil di tiang A. Tugas Anda adalah memindahkan seluruh cakram dari tiang A ke tiang C dengan aturan:</p><br><p class="text-zinc-100">1. Hanya satu cakram yang dapat dipindahkan dalam satu waktu.</p><br><p class="text-zinc-100">2. Setiap cakram hanya bisa diletakkan di atas cakram yang lebih besar.</p><br><p class="text-zinc-100">3. Gunakan tiang B sebagai tiang bantu.</p><br><p class="text-zinc-100">4. Memindahkan 1 cakram dihitung 1 langkah.</p>',
                'answer' => '15',
                'image' => json_encode([
                    'storage/questions/quiz/babel-1.jpg',
                    'storage/questions/quiz/babel-2.jpg',
                ]),
                'category' => 'quiz',
            ],
            // [
            //     'question' => '',
            //     'answer' => '',
            //     'image' => null,
            // 'category' => 'quiz',
            // ],
            // [
            //     'question' => '',
            //     'answer' => '',
            //     'image' => null,
            // 'category' => 'quiz',
            // ],
            // [
            //     'question' => '',
            //     'answer' => '',
            //     'image' => null,
            // 'category' => 'quiz',
            // ],
            // [
            //     'question' => '',
            //     'answer' => '',
            //     'image' => null,
            // 'category' => 'quiz',
            // ],
            [
                'question' => '<p class="text-zinc-100">Hexadecimal >  Phone multi-tap encrypt </p><br><p class="text-zinc-100">DE 3E7 16 21 309 8 29A 7 1BC 2 0 6 2 3 42 21 1E61 1E61</p>',
                'answer' => 'cybertopia madness',
                'image' => json_encode(['storage/questions/crypto/set-a.jpg']),
                'category' => 'crypto_a',
            ],
            [
                'question' => '',
                'answer' => 'cybernetic dystopia',
                'image' => json_encode(['storage/questions/crypto/set-b.jpg']),
                'category' => 'crypto_b',
            ],
            [
                'question' => '',
                'answer' => 'cyber savant',
                'image' => json_encode(['storage/questions/crypto/set-c.jpg']),
                'category' => 'crypto_c',
            ],
        ];

        foreach ($questions as $question) {
            \App\Models\FinalQuestion::create($question);
        }
    }
}
