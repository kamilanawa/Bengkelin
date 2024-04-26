<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link', function (Blueprint $table) {
            $table->id();
            
                // mendapatkan data user
        
                $dataUser['users'] = User::findOrFail($id);
        
        
                $validated = $request->validate([
        
                    'name' => 'string',
        
                    'email' => 'string',
        
                    'phone_number' => 'string',
        
                    'alamat' => 'string',
        
                    'link' => 'string'
        
                    // 'image' => 'required|mimes:jpg,jpeg,png|max:5120'
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link');
    }
};
