<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Genetika extends Controller
{
    private $kalori;
    private $gram_protein;
    private $gram_lemak;
    private $gram_karbohidrat;
    private $natrium;

    public function __construct(Request $request)
    {
        $this->kalori = $request->session()->get('kalori');
        $this->gram_protein = $request->session()->get('protein');
        $this->gram_lemak = $request->session()->get('lemak');
        $this->gram_karbohidrat = $request->session()->get('karbohidrat');
        $this->natrium = 1500;
    }

    private function generatePopulation($population_size = 100)
    {
        // Mendapatkan data dari database
        $df = DB::table('kategori_makanan')->get();

        // Filter baris berdasarkan kategori
        $karbohidrat = $df->where('Kategori', 'Karbohidrat')->pluck('Id')->toArray();
        $hewani = $df->where('Kategori', 'Hewani')->pluck('Id')->toArray();
        $nabati = $df->where('Kategori', 'Nabati')->pluck('Id')->toArray();
        $buah = $df->where('Kategori', 'Buah')->pluck('Id')->toArray();

        // Inisialisasi populasi
        $population = [];
        for ($i = 0; $i < $population_size; $i++) {
            $chromosome = [
                $karbohidrat[array_rand($karbohidrat)],
                $hewani[array_rand($hewani)],
                $nabati[array_rand($nabati)],
                $buah[array_rand($buah)],
                $karbohidrat[array_rand($karbohidrat)],
                $hewani[array_rand($hewani)],
                $nabati[array_rand($nabati)],
                $buah[array_rand($buah)],
                $karbohidrat[array_rand($karbohidrat)],
                $hewani[array_rand($hewani)],
                $nabati[array_rand($nabati)],
                $buah[array_rand($buah)]
            ];
            $population[] = $chromosome;
        }

        return $population;
    }

    private function hitungFitness($chromosome)
    {
        // Inisialisasi total nilai masing-masing nutrisi
        $total_kalori = 0;
        $total_karbohidrat = 0;
        $total_protein = 0;
        $total_lemak = 0;
        $total_natrium = 0;

        // Hitung total nilai masing-masing nutrisi dari bahan makanan pada kromosom
        for ($i = 0; $i < count($chromosome); $i += 4) {
            $bahan_karbohidrat = DB::table('kategori_makanan')->select('Energi', 'Karbohidrat', 'Protein', 'Lemak', 'Natrium')->where('Id', $chromosome[$i])->first();
            $bahan_hewani = DB::table('kategori_makanan')->select('Energi', 'Karbohidrat', 'Protein', 'Lemak', 'Natrium')->where('Id', $chromosome[$i + 1])->first();
            $bahan_nabati = DB::table('kategori_makanan')->select('Energi', 'Karbohidrat', 'Protein', 'Lemak', 'Natrium')->where('Id', $chromosome[$i + 2])->first();
            $bahan_buah = DB::table('kategori_makanan')->select('Energi', 'Karbohidrat', 'Protein', 'Lemak', 'Natrium')->where('Id', $chromosome[$i + 3])->first();

            $total_kalori += $bahan_karbohidrat->{'Energi'} + $bahan_hewani->{'Energi'} + $bahan_nabati->{'Energi'} + $bahan_buah->{'Energi'};
            $total_karbohidrat += $bahan_karbohidrat->{'Karbohidrat'} + $bahan_nabati->{'Karbohidrat'} + $bahan_buah->{'Karbohidrat'};
            $total_protein += $bahan_hewani->{'Protein'} + $bahan_nabati->{'Protein'} + $bahan_buah->{'Protein'};
            $total_lemak += $bahan_hewani->{'Lemak'} + $bahan_nabati->{'Lemak'} + $bahan_buah->{'Lemak'};
            $total_natrium += $bahan_karbohidrat->{'Natrium'} + $bahan_hewani->{'Natrium'} + $bahan_nabati->{'Natrium'} + $bahan_buah->{'Natrium'};
        }

        // Hitung nilai fitness dari kromosom
        $fitness = 1 / (abs($this->kalori - $total_kalori) + abs($this->gram_karbohidrat - $total_karbohidrat) + abs($this->gram_protein - $total_protein) + abs($this->gram_lemak - $total_lemak) + abs($this->natrium - $total_natrium));

        return $fitness;
    }
    private function crossover($population, $pc)
    {
        // Mengambil 20 individu terbaik
        $sorted_population = collect($population)->sortByDesc(function ($chromosome) {
            return $this->hitungFitness($chromosome);
        })->toArray();
        $top_individuals = array_slice($sorted_population, 0, 10);

        // Membagi dua kelompok
        $group_1 = array_slice($top_individuals, 0, 5);
        $group_2 = array_slice($top_individuals, 5);

        // Melakukan crossover
        $new_population = [];
        for ($i = 0; $i < count($group_1); $i++) {
            if (rand() / getrandmax() < $pc) {
                $crossover_point = rand(1, count($group_1[$i]) - 2);
                $temp = array_slice($group_1[$i], $crossover_point);
                $group_1[$i] = array_merge(array_slice($group_1[$i], 0, $crossover_point), array_slice($group_2[$i], $crossover_point));
                $group_2[$i] = array_merge(array_slice($group_2[$i], 0, $crossover_point), $temp);
            }
            // Menambahkan hasil crossover ke dalam list baru
            $new_population[] = $group_1[$i];
            $new_population[] = $group_2[$i];
        }

        return $new_population;
    }
    private function mutate($new_population, $pm)
    {
        for ($i = 0; $i < count($new_population); $i++) {
            if (rand() / getrandmax() < $pm) {
                // Memilih dua kromosom secara acak untuk dilakukan pertukaran individu
                $kromosom_1 = $new_population[array_rand($new_population)];
                $kromosom_2 = $new_population[array_rand($new_population)];

                // Memilih dua index individu yang akan ditukar secara acak
                $index_1 = rand(0, count($kromosom_1) - 1);
                $index_2 = rand(0, count($kromosom_2) - 1);

                // Mengecek apakah kedua index yang dipilih memiliki kategori yang sama
                if ($this->getFoodCategory($kromosom_1[$index_1]) == $this->getFoodCategory($kromosom_2[$index_2])) {
                    // Melakukan pertukaran individu
                    $temp = $kromosom_1[$index_1];
                    $kromosom_1[$index_1] = $kromosom_2[$index_2];
                    $kromosom_2[$index_2] = $temp;
                }
            }
        }

        return $new_population;
    }

    private function getFoodCategory($food_id)
    {
        // Mendapatkan kategori makanan berdasarkan ID makanan
        $food = DB::table('kategori_makanan')->select('Kategori')->where('Id', $food_id)->first();
        return $food->Kategori;
    }
    private function hitungFitnessMutasi($new_population_mutasi)
    {
        $fitness_populasi_baru = [];
        foreach ($new_population_mutasi as $individu) {
            $fitnessMutasi = $this->hitungFitness($individu);
            $fitness_populasi_baru[] = $fitnessMutasi;
        }
        return $fitness_populasi_baru;
    }
    private function selection($population, $fitness_values, $tournament_size = 3)
    {
        $selected_population = [];

        while (count($selected_population) < count($population)) {
            $tournament = [];

            // Memilih individu secara acak untuk turnamen
            for ($i = 0; $i < $tournament_size; $i++) {
                $random_index = array_rand($population);
                $tournament[] = $population[$random_index];
            }

            // Memilih individu dengan nilai kecocokan tertinggi dalam turnamen
            $max_fitness = -INF;
            $selected_individual = null;
            foreach ($tournament as $individual) {
                $fitness = $fitness_values[array_search($individual, $population)];
                if ($fitness > $max_fitness) {
                    $max_fitness = $fitness;
                    $selected_individual = $individual;
                }
            }

            // Menambahkan individu terpilih ke populasi terpilih
            $selected_population[] = $selected_individual;
        }

        return $selected_population;
    }

    public function performGeneticAlgorithm(Request $request)
    {
        $max_generation = 10;

        // Membangkitkan populasi awal
        $population = $this->generatePopulation();

        // Menghitung nilai fitness dari setiap kromosom dalam populasi
        $fitness_values = $this->hitungFitnessMutasi($population);

        // Melakukan iterasi algoritma genetika
        for ($generation = 1; $generation <= $max_generation; $generation++) {
            // Seleksi individu terbaik untuk crossover
            $selected_population = $this->selection($population, $fitness_values);

            // Melakukan crossover
            $new_population = $this->crossover($selected_population, 0.8);

            // Melakukan mutasi pada populasi hasil crossover
            $new_population_mutasi = $this->mutate($new_population, 0.8);

            // Menghitung nilai fitness dari populasi hasil mutasi
            $fitness_values_mutasi = $this->hitungFitnessMutasi($new_population_mutasi);

            // Mengganti populasi dengan populasi hasil mutasi
            $population = $new_population_mutasi;
            $fitness_values = $fitness_values_mutasi;
        }

        $max_fitness = max($fitness_values);
        $index_max_fitness = array_search($max_fitness, $fitness_values);
        $kromosom_max_fitness = $new_population_mutasi[$index_max_fitness];
        $hasil_kromosom = [];

        foreach ($kromosom_max_fitness as $food_id) {
            $food = DB::table('kategori_makanan')->select('Nama', 'Berat', 'Energi')->where('Id', $food_id)->first();
            $hasil_kromosom[] = [
                'nama_bahan' => $food->{'Nama'},
                'berat' => $food->Berat,
                'energi' => $food->Energi,
            ];
        }

        // Hypertension and calories
        $category = $this->hitungKategoriHipertensi($request);

        // Show the result
        return view('hasil', array_merge(['hasil_kromosom' => $hasil_kromosom], $category));
    }

    public function performFixed(Request $req)
    {
        $data = json_decode($req->input('hasil'), true);

        return view("fix", [
            "hasil_kromosom" => $data
        ]);
    }

    // Hypertension and Calories
    public function hitungKategoriHipertensi(Request $request)
    {
        $sistolik = $request->input('sistolik');
        $diastolik = $request->input('diastolik');

        if ($sistolik < 120 && $diastolik < 80) {
            $kategori = "Normal";
        } elseif ($sistolik >= 120 && $sistolik <= 129 && $diastolik < 80) {
            $kategori = "Prehipertensi";
        } elseif ($sistolik >= 130 && $sistolik <= 139 && $diastolik >= 80 && $diastolik <= 89) {
            $kategori = "Hipertensi Tingkat 1";
        } elseif ($sistolik >= 140 && $diastolik >= 90) {
            $kategori = "Hipertensi Tingkat 2";
        } else {
            $kategori = "Tidak diketahui";
        }

        $jenis_kelamin = $request->input('jenis_kelamin');
        $berat_badan = $request->input('berat_badan');
        $tinggi_badan = $request->input('tinggi_badan');
        $umur = $request->input('umur');
        $aktivitas = $request->input('aktivitas');

        $bmr = $this->menghitung_bmr($jenis_kelamin, $berat_badan, $tinggi_badan, $umur);
        $kalori = round($this->hitung_kalori($bmr, $aktivitas));
        $kebutuhan_gram = $this->hitung_kebutuhan_kalori($kalori);

        $gram_protein = $kebutuhan_gram['protein'];
        $gram_lemak = $kebutuhan_gram['lemak'];
        $gram_karbohidrat = $kebutuhan_gram['karbohidrat'];

        $request->session()->put('kalori', $kalori);
        $request->session()->put('protein', $gram_protein);
        $request->session()->put('lemak', $gram_lemak);
        $request->session()->put('karbohidrat', $gram_karbohidrat);

        return [
            'kalori' => $kalori,
            'kategori' => $kategori,
            'gram' => $kebutuhan_gram
        ];
    }

    private function menghitung_bmr($jenis_kelamin, $berat_badan, $tinggi_badan, $umur)
    {
        if ($jenis_kelamin == 'Laki-laki') {
            $bmr = 66 + (13.7 * $berat_badan) + (5 * $tinggi_badan) - (6.8 * $umur);
        } else {
            $bmr = 655 + (9.6 * $berat_badan) + (1.8 * $tinggi_badan) - (4.7 * $umur);
        }

        return $bmr;
    }

    private function hitung_kalori($bmr, $aktivitas)
    {
        if ($aktivitas == 1) {
            $kalori = $bmr * 1.2;
        } elseif ($aktivitas == 2) {
            $kalori = $bmr * 1.375;
        } elseif ($aktivitas == 3) {
            $kalori = $bmr * 1.55;
        } elseif ($aktivitas == 4) {
            $kalori = $bmr * 1.725;
        } else {
            $kalori = 0;
        }

        return $kalori;
    }

    private function hitung_kebutuhan_kalori($kalori)
    {
        $protein = $kalori * 0.15 / 4;
        $lemak = $kalori * 0.3 / 9;
        $karbohidrat = $kalori * 0.55 / 4;

        return [
            'protein' => $protein,
            'lemak' => $lemak,
            'karbohidrat' => $karbohidrat
        ];
    }
}
