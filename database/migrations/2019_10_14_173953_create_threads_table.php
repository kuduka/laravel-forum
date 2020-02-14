    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')
                ->unique()
                ->nullable();
            $table->bigInteger('user_id')
                ->unsigned();
            $table->bigInteger('channel_id')
                ->unsigned();
            $table->bigInteger('replies_count')
                ->default(0)
                ->unsigned();
            $table->bigInteger('visits')
                ->default(0)
                ->unsigned();
            $table->string('title');
            $table->text('body');
            $table->bigInteger('best_reply_id')
                ->unsigned()
                ->nullable();
            $table->boolean('locked')->default(false);
            $table->timestamps();
            $table->foreign('best_reply_id')
                ->references('id')
                ->on('replies')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
