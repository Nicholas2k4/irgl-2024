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
            // 1. ABC
            [
                'question' => '<p class="text-zinc-100">Bilangan a, b, c, d , e adalah bilangan bulat positif berbeda yang memenuhi ABCDE*4 = EDCBA</p>
                <br><p class="text-zinc-100">Berapa nilai dari A + 2B + 3C + 4D + 5E?</p>',
                'answer' => '99',
                'image' => null,
                'category' => 'quiz',
            ],
            // 2. Pacuan Kuda
            [
                'question' => '<p class="text-zinc-100">Kamu memiliki 25 ekor kuda dan hanya 5 lintasan balap. Kamu tidak memiliki alat pengukur waktu, sehingga kamu melakukan balapan untuk mengetahui urutan kuda dalam setiap perlombaan. Berapa jumlah minimum balapan yang diperlukan untuk menemukan 3 kuda tercepat?</p>',
                'answer' => '7',
                'image' => null,
                'category' => 'quiz',
            ],
            // 3. Bridge to the moon
            [
                'question' => '<p class="text-zinc-100">Ada 4 orang yang harus menyeberangi jembatan di malam hari. Mereka hanya memiliki satu senter dan jembatan hanya bisa menahan dua orang sekaligus. Setiap orang berjalan dengan kecepatan berbeda: 1 menit, 2 menit, 7 menit, dan 10 menit. Ketika dua orang menyeberang bersama, mereka bergerak dengan kecepatan yang lebih lambat. Berapa menit waktu tercepat bagi semua orang untuk menyeberangi jembatan?</p>',
                'answer' => '17',
                'image' => null,
                'category' => 'quiz',
            ],
            // 4. Lights out
            [
                'question' => '<p class="text-zinc-100">Di rumah barumu, circuit breaker terletak di sudut ruang bawah tanah yang tidak nyaman. Yang membuatmu kesal, tidak satu pun dari 100 circuit breaker tersebut diberi label, sehingga kamu harus mencocokkan setiap circuit breaker dengan lampu yang dikendalikannya. Setiap circuit breaker hanya memetakan satu lampu tertentu. Untuk memulai, kamu menghidupkan semua 100 lampu di rumah, kemudian pergi ke ruang bawah tanah untuk memulai memetakan. Pada setiap perjalanan ke ruang bawah tanah, kamu bisa menghidupkan atau mematikan sejumlah circuit breaker. Setelah itu, kamu kembali ke seluruh rumah untuk melihat lampu mana yang masih menyala dan mana yang sudah mati. Proses ini terus berlanjut sampai setiap circuit breaker berhasil dicocokkan dengan lampu yang dikendalikannya. Berapa jumlah minimum perjalanan yang perlu kamu lakukan ke ruang bawah tanah untuk memetakan setiap circuit breaker ke setiap lampu?</p>',
                'answer' => '7',
                'image' => null,
                'category' => 'quiz',
            ],
            // 5. Sharing is Caring
            [
                'question' => '<p class="text-zinc-100">Terdapat 5 orang mahasiswa dan mereka semua rapat. Di tengah perjalanan mereka memutuskan untuk makan siang di HiHi fried chicken. Berikut adalah menu yang ditawarkan dengan harga dalam ribuan rupiah:</p>
                <br><p class="text-zinc-100">Nasi 4</p>
                <br><p class="text-zinc-100">Burger 5</p>
                <br><p class="text-zinc-100">Paket Lauk 2</p>
                <br><p class="text-zinc-100">Es Cendol 1</p>
                <br><p class="text-zinc-100">Secara kolektif mereka semua hanya memiliki 30.000 rupiah untuk makan siang. Berikut adalah cara mereka menentukan makanan yang dipesan.</p>
                <br><p class="text-zinc-100">- Setiap orang akan makan nasi atau burger</p>
                <br><p class="text-zinc-100">- Setiap yang memesan nasi harus memesan paket lauk.</p>
                <br><p class="text-zinc-100">- Setiap orang, baik yang memesan nasi atau burger, dapat memesan paling banyak 1 es cendol.</p>
                <br><p class="text-zinc-100">Jika uang mereka tidak harus seluruhnya dibelanjakan tetapi harus memenuhi kriteria di atas, tentukan ada berapa banyak cara mereka membagi menu untuk makan siang</p>',
                'answer' => '638',
                'image' => null,
                'category' => 'quiz',
            ],
            // 6. Real or fake
            [
                'question' => '<p class="text-zinc-100">Kamu memiliki 80 koin, di antaranya ada satu koin palsu yang lebih ringan dari koin lainnya. Kamu memiliki neraca tanpa bobot untuk melakukan penimbangan. Berapa jumlah minimum penimbangan yang diperlukan untuk menemukan koin palsu?</p>',
                'answer' => '4',
                'image' => null,
                'category' => 'quiz',
            ],
            // 7. Ikan Ong
            [
                'question' => '<p class="text-zinc-100">Dalam Akuarium terdapat 400 ikan. 99% diantaranya berwarna merah dan sisanya berwarna hitam. Berapa banyak ikan merah yang harus dikeluarkan agar populasi ikan merah menjadi 90%?</p>',
                'answer' => '360',
                'image' => null,
                'category' => 'quiz',
            ],
            // 8. Unlock it!
            [
                'question' => '<p class="text-zinc-100">1. Code 14673 : 4 digit benar tetapi hanya satu berada di posisi yang benar</p>
                <br><p class="text-zinc-100">2. Code 02637 : 3 digit benar dan ketiganya berada di posisi yang benar</p>
                <br><p class="text-zinc-100">3. Code 69308 : 1 digit Benar tetapi posisinya salah</p>
                <br><p class="text-zinc-100">4. Code 56073 : 2 digit benar tetapi keduanya berada di posisi yang salah</p>
                <br><p class="text-zinc-100">5. Code 59418 : 2 digit Benar tetapi hanya 1 yang posisinya benar</p>
                <br><p class="text-zinc-100">6. Code 92716: 4 digit Benar tetapi hanya 2 yang posisinya benar</p>
                <br><p class="text-zinc-100">7. Code 43571: 3 digit Benar tetapi hanya 1 yang posisinya benar, sisanya salah</p>',
                'answer' => '637',
                'image' => null,
                'category' => 'quiz',
            ],
            // 9. Two Bucket
            [
                'question' => '<p class="text-zinc-100">Diberikan 2 Ember dengan kapasitas berbeda yaitu 7L dan 4L. Hitunglah Total langkah minimum yang diperlukan untuk mendapatkan 2L, 6L, dan 1L di salah satu Ember. Jawablah berurutan untuk 2L, 6L, 1L (Format Jawaban -> 10, 1, 4)</p>
                <br><p class="text-zinc-100">Langkah yang Tersedia :</p>
                <br><p class="text-zinc-100">- Mengisi ember hingga penuh,</p>
                <br><p class="text-zinc-100">- Mengosongkan ember,</p>
                <br><p class="text-zinc-100">- Menuang air dari salah satu ember ke ember lainnya hingga penuh (Misal ember dengan kapasitas 5L sekarang memiliki 3L air, jika akan dituangkan air dari ember satunya maka hanya 2L yang dapat dituang).</p>',
                'answer' => '8,6,4',
                'image' => null,
                'category' => 'quiz',
            ],
            // 10. Fin fin fin find it!
            [
                'question' => '<p class="text-zinc-100">ABC</p>
                <br><p class="text-zinc-100">ABC</p>
                <br><p class="text-zinc-100">ABC</p>
                <br><p class="text-zinc-100">________ +</p>
                <br><p class="text-zinc-100">CCC</p>
                <br><p class="text-zinc-100">Tentukan nilai A, B, dan C!</p>
                <br>',
                'answer' => '185',
                'image' => null,
                'category' => 'quiz',
            ],
            // 11. Under investigation
            [
                'question' => '<p class="text-zinc-100">Seorang Detektif mendapati bahwa ada 4 saksi mata perampokan. Berdasarkan Cerita para saksi, detektif ini menyimpulkan bahwa:</p>
                <br><p class="text-zinc-100">- Jika Si pramusaji berkata jujur maka Si koki juga demikian</p>
                <br><p class="text-zinc-100">- Si koki dan Si tukang kebun tidak mungkin mengatakan hal yang benar bersamaan</p>
                <br><p class="text-zinc-100">- Si tukang kebun dan Si badut, keduanya tidak berbohong</p>
                <br><p class="text-zinc-100">- Jika Si badut berkata hal yang benar maka Si koki berbohong</p>
                <br><p class="text-zinc-100">Apakah Si Pramusaji berkata jujur? (jawablah antara jujur atau berbohong)</p>',
                'answer' => 'berbohong',
                'image' => null,
                'category' => 'quiz',
            ],
            // 12. Band
            [
                'question' => 'Tentukan nilai “VIOLIN” dari operasi penjumlahan berikut',
                'answer' => '104207',
                'image' => json_encode([
                    'storage/questions/quiz/band.jpg',
                ]),
                'category' => 'quiz',
            ],
            // 13. Tower of Babel
            [
                'question' => '<p class="text-zinc-100">Diberikan 3 tiang (A, B, C) dan sejumlah cakram dengan ukuran berbeda yang tersusun dari besar ke kecil di tiang A. Tugas Anda adalah memindahkan seluruh cakram dari tiang A ke tiang C dengan aturan:</p>
                <br><p class="text-zinc-100">1. Hanya satu cakram yang dapat dipindahkan dalam satu waktu.</p>
                <br><p class="text-zinc-100">2. Setiap cakram hanya bisa diletakkan di atas cakram yang lebih besar.</p>
                <br><p class="text-zinc-100">3. Gunakan tiang B sebagai tiang bantu.</p>
                <br><p class="text-zinc-100">4. Memindahkan 1 cakram dihitung 1 langkah.</p>
                <br><p class="text-zinc-100">Berapa total langkah yang diperlukan untuk memindahkan seluruh cakram dari tiang A ke tiang C?</p>',
                'answer' => '15',
                'image' => json_encode([
                    'storage/questions/quiz/babel-1.jpg',
                    'storage/questions/quiz/babel-2.jpg',
                ]),
                'category' => 'quiz',
            ],
            // 14. Mazzini
            [
                'question' => '<p class="text-zinc-100">Mazzini, an Italian specialty restaurant, stays open every Monday to Saturday but is closed on all Sundays. On Mondays, only lunch is served, as well as on Tuesdays and Thursdays. On Wednesdays, Fridays and Saturdays, just dinner is served. The restaurant’s floors are polished and plants are watered only on days that Mazzini is open for business, according the following schedule:</p>
                <br><p class="text-zinc-100">- Plants are watered two days each week, but never on consecutive days and never on the same day that floors are polished.</p>
                <br><p class="text-zinc-100">- Floors are polished on Monday and two other days each week, but never on consecutive days and never on the same day that plants are watered.</p>
                <br><p class="text-zinc-100">According to a schedule, if the floor are also polished on saturdays, then the restaurant’s floors are polished on either… (Answer in english, separated by comma without space after the comma, and sorted by days of the week -> Monday to Sunday. For example, the answer is Sunday and Monday, it should be written as Monday,Sunday)</p>',
                'answer' => 'wednesday,thursday',
                'image' => null,
                'category' => 'quiz',
            ],
            // 15. Function
            [
                'question' => 'Diberikan fungsi y(3, 2) = 515, y(6, 1) = 7535, y(6, 3) = 9327. Berapakah y(4, 3)?',
                'answer' => '717',
                'image' => null,
                'category' => 'quiz',
            ],
            // Cryptography Set A
            [
                'question' => '<p class="text-zinc-100">Hexadecimal >  Phone multi-tap encrypt </p>
                <br><p class="text-zinc-100">DE 3E7 16 21 309 8 29A 7 1BC 2 0 6 2 3 42 21 1E61 1E61</p>
                <br><p class="text-zinc-100">222 999 22 33 777 8 666 7 444 2 0 6 2 3 66 33 7777 7777</p>',
                'answer' => 'cybertopia madness',
                'image' => json_encode(['storage/questions/crypto/set-a.jpg']),
                'category' => 'crypto_a',
                'status' => 1,
            ],
            // Cryptography Set B
            [
                'question' => '',
                'answer' => 'cybernetic dystopia!',
                'image' => json_encode(['storage/questions/crypto/set-b.jpg']),
                'category' => 'crypto_b',
            ],
            // Cryptography Set C
            [
                'question' => '',
                'answer' => 'cyber savant',
                'image' => json_encode(['storage/questions/crypto/set-c.jpg', 'storage/questions/crypto/set-c-2.jpg']),
                'category' => 'crypto_c',
            ],
        ];

        foreach ($questions as $question) {
            \App\Models\FinalQuestion::create($question);
        }
    }
}
