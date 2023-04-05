<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('players', function (Blueprint $table) {
                $table->id();
                $table->string('tag')->unique();
                $table->string('name');
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
                $table->foreignId('clan_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
                $table->timestamps();
            });

            DB::table('players')->insert(
                [
                    [
                        'id' => 1,
                        'tag' => '2R0QL0VLQ',
                        'name' => 'MISSEY',
                        'user_id' => 1,
                        'clan_id' => 1,
                    ],
                    [
                        'id' => 2,
                        'tag' => '9YUV80C2',
                        'name' => 'N_Lena',
                        'user_id' => null,
                        'clan_id' => 1,
                    ],
                    [
                        'id' => 3,
                        'tag' => 'VQ2CP0G0',
                        'name' => 'Woarey',
                        'user_id' => 1,
                        'clan_id' => 2,
                    ],
                ]
            );
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('players');
        }
    };
