<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Spk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $kriteria = [
            [
                'namakriteria' => 'Harga Laptop',
                'bobot' => 0.3,
                'typedata' => 'kurensi',
                'ket' => 'dinamis',
            ], [

                'namakriteria' => 'Memory Laptop',
                'bobot' => 0.15,
                'typedata' => 'huruf',
                'ket' => 'statis',
            ], [
                'namakriteria' =>'Penyimpanan Laptop',
                'bobot' => 0.15,
                'typedata' => 'huruf',
                'ket' => 'statis',
            ], [
                'namakriteria' =>'Ukuran Layar',
                'bobot' => 0.2,
                'typedata' => 'huruf',
                'ket' => 'statis',
            ], [
                'namakriteria' =>'Kondisi',
                'bobot' => 0.1,
                'typedata' => 'huruf',
                'ket' => 'statis',
            ], [
                'namakriteria' =>'Merek',
                'bobot' => 0.1,
                'typedata' => 'huruf',
                'ket' => 'statis',
            ]

        ];

        $hargalaptop = [
            '2000000', '3000000', '4000000','5000000'
        ];
        $merek = [
            'HP', 'Lenovo', 'Asus', 'Dell', 'Acer', 'Samsung', 'Axio', 'Toshiba',
        ];
        $memorylaptop = [
            '2GB','4GB','8GB','16GB'
        ];
        $penyimpananlaptop = [
            '320GB-HDD',
            '500GB-HDD',
            '1TB-HDD',
            '230GB-SSD',
        ];
        $ukuranlayar = [
            '13 Inci',
            '14 Inci',
        ];
        $kondisi = [
            'Baru',
            'Second',
        ];


        Schema::create('kriteria', function (Blueprint $table) {
            $table->bigIncrements('idkriteria');
            $table->String('namakriteria')->unique();
            $table->float('bobot');
            $table->enum('typedata', ['angka','huruf','kurensi']);
            $table->enum('ket', ['statis','dinamis']);
            $table->String('satuan')->nullable();
            $table->timestamps();
        });

        Schema::create('nilai', function (Blueprint $table) {
            $table->bigIncrements('idnilai');
            $table->Integer('idkriteria');
            $table->String('ket');
            $table->integer('nilai');
            $table->timestamps();
        });

        Schema::create('toko', function (Blueprint $table) {
            $table->bigIncrements('idtoko');
            $table->String('namatoko');
            $table->Text('alamat');
            $table->char('hp');
            $table->String('links')->nullable();
            $table->String('gambar')->nullable();
            $table->timestamps();
        });

        Schema::create('laptop', function (Blueprint $table) {
            $table->bigIncrements('idlaptop');
            $table->Integer('idtoko');
            $table->String('namalaptop');
            $table->timestamps();
        });

        $id = 1;
        $nomor = 1;
        foreach ($kriteria as $item) {
            $ket = $item['ket'];
            $nama_k = str_replace(" ", "", strtolower($item['namakriteria']));

            DB::table('kriteria')->insert([
                'idkriteria' => $id,
                'namakriteria' => $item['namakriteria'],
                'bobot' => $item['bobot'],
                'typedata' => $item['typedata'],
                'ket' => $item['ket'],
            ]);

            if($item['namakriteria']=='Harga Laptop'){
                foreach ($hargalaptop as $item2) {
                    DB::table('nilai')->insert([
                        'idkriteria' => $id,
                        'ket' => $item2,
                        'nilai' => $nomor++,
                    ]);
                }
                $nomor = 1;
            }

            if($item['namakriteria']=='Merek'){
                foreach ($merek as $item2) {
                    DB::table('nilai')->insert([
                        'idkriteria' => $id,
                        'ket' => $item2,
                        'nilai' => $nomor++,
                    ]);
                }
                $nomor = 1;
            }

            if($item['namakriteria']=='Ukuran Layar'){
                foreach ($ukuranlayar as $item2) {
                    DB::table('nilai')->insert([
                        'idkriteria' => $id,
                        'ket' => $item2,
                        'nilai' => $nomor++,
                    ]);
                }
                $nomor = 1;
            }

            if($item['namakriteria']=='Memory Laptop'){
                foreach ($memorylaptop as $item2) {
                    DB::table('nilai')->insert([
                        'idkriteria' => $id,
                        'ket' => $item2,
                        'nilai' => $nomor++,
                    ]);
                }
                $nomor = 1;
            }
            if($item['namakriteria']=='Penyimpanan Laptop'){
                foreach ($penyimpananlaptop as $item2) {
                    DB::table('nilai')->insert([
                        'idkriteria' => $id,
                        'ket' => $item2,
                        'nilai' => $nomor++,
                    ]);
                }
                $nomor = 1;
            }

            if($item['namakriteria']=='Kondisi'){
                foreach ($kondisi as $item2) {
                    DB::table('nilai')->insert([
                        'idkriteria' => $id,
                        'ket' => $item2,
                        'nilai' => $nomor++,
                    ]);
                }
                $nomor = 1;
            }

            $id++;

            DB::statement("ALTER TABLE laptop ADD $nama_k bigint");

        }




        Schema::create('pengunjung', function (Blueprint $table) {
            $table->bigIncrements('idpengunjung');
            $table->String('username')->unique();
            $table->String('nama');
            $table->String('password');
            $table->timestamps();
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('idadmin');
            $table->String('username')->unique();
            $table->String('nama');
            $table->String('password');
            $table->timestamps();
        });

        Schema::create('laporan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('idpengunjung');
            $table->float('nilai');
            $table->String('namainstansi');
            $table->String('alamat');
            $table->String('links');
            $table->String('hp');
            $table->String('gambar')->nullable();
            $table->timestamps();
        });

        DB::table('pengunjung')->insert([
            'username' => 'pengunjung@gmail.com',
            'nama' => 'pengunjung',
            'password' => Hash::make('pengunjung'),
        ]);

        DB::table('admin')->insert([
            'username' => 'admin@gmail.com',
            'nama' => 'admin',
            'password' => Hash::make('admin'),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
