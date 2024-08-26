// Route untuk risalahbiasa
Route::get('/risalahbiasa', [RisalahController::Class, 'risalahbiasa'])->name('risalahbiasa');
Route::get('/risalahbiasaambil', [RisalahController::Class, 'risalahbiasaAmbil'])->name('risalahbiasa.ambil');
Route::post('/risalahbiasa/simpan', [RisalahController::Class, 'risalahbiasaSimpan'])->name('risalahbiasa.simpan');
Route::delete('/risalahbiasa/hapus/{show}', [RisalahController::Class, 'risalahbiasaHapus']);
Route::get('/risalahbiasa/ubah/{show}', [RisalahController::Class, 'risalahbiasaUbah']);
Route::patch('/risalahbiasa/update', [RisalahController::Class, 'risalahbiasaUpdate']);
Route::get('/risalahbiasa/edit/{show}', [RisalahController::Class, 'risalahbiasaEdit']); // Route khusus admin untuk edit
Route::patch('/risalahbiasa/store', [RisalahController::Class, 'risalahbiasaStore']); // Route untuk simpan hasil edit admin
Route::get('/risalahbiasa/backdate/{show}', [RisalahController::Class, 'risalahbiasaBackdate']); // Route khusus admin untuk edit
Route::patch('/risalahbiasa/backdateStore', [RisalahController::Class, 'risalahbiasaBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk risalahrahasia
Route::get('/risalahrahasia', [RisalahController::Class, 'risalahrahasia'])->name('risalahrahasia');
Route::get('/risalahrahasiaambil', [RisalahController::Class, 'risalahrahasiaAmbil'])->name('risalahrahasia.ambil');
Route::post('/risalahrahasia/simpan', [RisalahController::Class, 'risalahrahasiaSimpan'])->name('risalahrahasia.simpan');
Route::delete('/risalahrahasia/hapus/{show}', [RisalahController::Class, 'risalahrahasiaHapus']);
Route::get('/risalahrahasia/ubah/{show}', [RisalahController::Class, 'risalahrahasiaUbah']);
Route::patch('/risalahrahasia/update', [RisalahController::Class, 'risalahrahasiaUpdate']);
Route::get('/risalahrahasia/edit/{show}', [RisalahController::Class, 'risalahrahasiaEdit']); // Route khusus admin untuk edit
Route::patch('/risalahrahasia/store', [RisalahController::Class, 'risalahrahasiaStore']); // Route untuk simpan hasil edit admin
Route::get('/risalahrahasia/backdate/{show}', [RisalahController::Class, 'risalahrahasiaBackdate']); // Route khusus admin untuk edit
Route::patch('/risalahrahasia/backdateStore', [RisalahController::Class, 'risalahrahasiaBackdateStore']); // Route untuk simpan hasil edit admin
