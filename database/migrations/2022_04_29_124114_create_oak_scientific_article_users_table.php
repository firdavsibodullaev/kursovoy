<?php

use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOakScientificArticleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oak_scientific_article_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('oak_scientific_article_id')
                ->constrained('oak_scientific_articles')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('oak_scientific_article_users');
    }
}
