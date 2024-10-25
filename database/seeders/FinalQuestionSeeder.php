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
            [
                'question' => '<p class="text-zinc-100">Bilangan a, b, c, d , e adalah bilangan bulat positif berbeda yang memenuhi ABCDE*4 = EDCBA</p><br><p class="text-zinc-100">Berapa nilai dari A + 2B + 3C + 4D + 5E?</p>',
                'answer' => '99',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Kamu memiliki 25 ekor kuda dan hanya 5 lintasan balap. Kamu tidak memiliki alat pengukur waktu, tetapi dapat melakukan balapan untuk mengetahui urutan kuda dalam setiap perlombaan. Berapa jumlah minimum balapan yang diperlukan untuk menemukan 3 kuda tercepat?</p>',
                'answer' => '7',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Ada 4 orang yang harus menyeberangi jembatan di malam hari. Mereka hanya memiliki satu senter dan jembatan hanya bisa menahan dua orang sekaligus. Setiap orang berjalan dengan kecepatan berbeda: 1 menit, 2 menit, 7 menit, dan 10 menit. Ketika dua orang menyeberang bersama, mereka bergerak dengan kecepatan yang lebih lambat. Bagaimana cara tercepat bagi semua orang untuk menyeberangi jembatan?</p>',
                'answer' => '17',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Kamu memiliki 80 koin, di antaranya ada satu koin palsu yang lebih ringan dari koin lainnya. Kamu memiliki neraca tanpa bobot untuk melakukan penimbangan. Berapa jumlah minimum penimbangan yang diperlukan untuk menemukan koin palsu?</p>',
                'answer' => '4',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Terdapat 5 orang mahasiswa dan mereka semua rapat. Di tengah perjalanan mereka memutuskan untuk makan siang di HiHi fried chicken. Berikut adalah menu yang ditawarkan dengan harga dalam ribuan rupiah:</p><br><p class="text-zinc-100">Nasi 4</p><br><p class="text-zinc-100">Burger 4</p><br><p class="text-zinc-100">Paket Lauk 2</p><br><p class="text-zinc-100">Es Cendol 1</p><br><p class="text-zinc-100">Secara kolektif mereka semua hanya memiliki 30.000 rupiah untuk makan siang. Berikut adalah cara mereka menentukan makanan yang dipesan.</p><br><p class="text-zinc-100">- Setiap orang akan makan nasi</p><p class="text-zinc-100">- Setiap yang memesan nasi harus memesan paket lauk.</p> - Setiap orang baik yang memesan nasi maupun burger dapat memesan paling banyak 1 es cendol.</p><br><p class="text-zinc-100">Jika uang mereka tidak harus seluruhnya dibelanjakan tetapi harus memenuhi kriteria di atas, tentukan ada berapa banyak cara mereka membagi menu untuk makan siang</p>',
                'answer' => '638',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Di rumah barumu, circuit breaker terletak di sudut ruang bawah tanah yang tidak nyaman. Yang membuat frustasi, tidak satu pun dari 100 circuit breaker tersebut diberi label, sehingga kamu harus mencocokkan setiap circuit breaker dengan lampu yang dikendalikannya. Setiap circuit breaker hanya memetakan satu lampu tertentu. Untuk memulai, kamu menghidupkan semua 100 lampu di rumah, kemudian pergi ke ruang bawah tanah untuk memulai memetakan. Pada setiap perjalanan ke ruang bawah tanah, kamu bisa menghidupkan atau mematikan sejumlah circuit breaker. Setelah itu, kamu kembali ke seluruh rumah untuk melihat lampu mana yang masih menyala dan mana yang sudah mati. Proses ini terus berlanjut sampai setiap circuit breaker berhasil dicocokkan dengan lampu yang dikendalikannya. Berapa jumlah minimum perjalanan yang perlu kamu lakukan ke ruang bawah tanah untuk memetakan setiap circuit breaker ke setiap lampu?</p>',
                'answer' => '7',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Buatlah angka 100 dari hasil perhitungan pertambahan dan/atau pengurangan deret angka 987654321 tanpa mengubah urutan posisi deret tersebut!</p>',
                'answer' => '98-76+54+3+21',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Dalam Akuarium terdapat 400 ikan. 99% diantaranya berwarna merah dan sisanya berwarna hitam. Berapa banyak ikan merah yang harus dikeluarkan agar populasi ikan merah menjadi 90%?</p>',
                'answer' => '360',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Sebuah keluarga yang terdiri dari ayah, ibu, anak Perempuan, anak Laki-laki ingin menyeberang ke pulau seberang melalui sebuah jembatan pada malam hari. Keluarga ini hanya memiliki 1 senter dan untuk menyebrangi jembatan ini diperlukan penggunaan senter. Karena Kondisi jembatan sudah ringkih, maksimal hanya 2 orang yang dapat berada di jembatan (Jika 2 orang menyeberang, maka 2 orang lainnya menunggu). Ayah memerlukan 5 menit untuk menyebrangi jembatan. Ibu memerlukan 10 menit untuk menyebrangi jembatan. Anak Perempuan memerlukan 2 menit untuk menyebrangi jembatan. Anak Laki-laki memerlukan 1 menit untuk menyebrangi jembatan</p>',
                'answer' => '17',
                'image' => null,
            ],
            [
                'question' => '<p class="text-zinc-100">Bantulah Budi untuk membuka gembok code miliknya dengan clue sebagai berikut:</p><br><p class="text-zinc-100">- Code 682 : Satu digit benar dan posisi digit juga benar.</p><br><p class="text-zinc-100">- Code 614 : Satu digit benar tetapi posisi digit salah.</p><br><p class="text-zinc-100">- Code 206 : Dua digit benar tetapi posisi keduanya salah.</p><br><p class="text-zinc-100">- Code 738 : Semua digit salah.</p><br><p class="text-zinc-100">- Code 380 : Satu digit benar tetapi posisi digit salah.</p>',
                'answer' => '042',
                'image' => null,
            ],
            // [
            //     'question' => '',
            //     'answer' => '',
            //     'image' => null,
            // ],
            // [
            //     'question' => '',
            //     'answer' => '',
            //     'image' => null,
            // ],
            // [
            //     'question' => '',
            //     'answer' => '',
            //     'image' => null,
            // ],
        ];

        foreach ($questions as $question) {
            \App\Models\FinalQuestion::create($question);
        }
    }
}
