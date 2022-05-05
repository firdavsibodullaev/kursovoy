<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateGrantFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_grant_funds', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->decimal('price', 25)->nullable();
            $table->decimal('full_price', 25);
            $table->year('year');
            $table->timestamps();
            $table->softDeletes(BaseModel::DELETED_AT);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_grant_funds');
    }
}
