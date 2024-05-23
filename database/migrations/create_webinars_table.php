public function up()
{
    Schema::create('webinars', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->dateTime('start_datetime');
        $table->string('host');
        $table->timestamps();
    });
}
