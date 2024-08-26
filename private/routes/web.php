<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DokumenkeluarController;
use App\Http\Controllers\Memorandum01Controller;
use App\Http\Controllers\FaximiliController;
use App\Http\Controllers\BeritaacaraController;
use App\Http\Controllers\UamController;
use App\Http\Controllers\M02Controller;
use App\Http\Controllers\KeputusanController;
use App\Http\Controllers\RisalahController;
use App\Http\Controllers\PerjanjianController;
use App\Http\Controllers\UmiController;
use App\Http\Controllers\KekdaController;
use App\Http\Controllers\SiaranController;
use App\Http\Controllers\UipurController;
use App\Http\Controllers\UikspController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemeliharaanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('loginnew');
});

Route::get('/deskapp', function(){
    return view('deskapp.app');
});

Route::get('/adminlte', function () {
    return view('adminlte.index');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified', 'ganti' , 'ceksesi'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Route untuk profile/user
Route::get('/profile', [UserController::Class, 'profile'])->name('profile');
Route::get('/ubahpassword', [UserController::Class, 'ubahpassword'])->name('ubahpassword');
Route::post('/simpanpassword', [UserController::Class, 'simpanpassword'])->name('simpanpassword');
Route::delete('/dokumen/hapus/{show}', [UserController::Class, 'destroy']);


// Route untuk tambah user
Route::get('/user', [UserController::Class, 'user'])->name('user');
Route::get('/user/tambah', [UserController::Class, 'tambahUser'])->name('tambahuser');
Route::post('/user/simpan', [UserController::Class, 'simpanUser'])->name('simpanuser');
Route::delete('/user/hapus/{show}', [UserController::Class, 'destroy']);

// Reset Password
Route::get('/resetpassword', [UserController::Class, 'resetPassword'])->name('resetpassword');
Route::post('/resetpassword/simpan', [UserController::Class, 'resetPasswordSimpan'])->name('resetPasswordSimpan');

/////////////////////////////////////////////////////////////////////////////////////


// Route untuk jenis dokumen dibawah ini
Route::middleware(['checklevel:admin', 'ganti'])->group(function () {
Route::get('/dokumen', [SettingController::Class, 'dokumen'])->name('dokumen');
Route::get('/dokumen/tambah', [SettingController::Class, 'dokumenTambah'])->name('dokumen.tambah');
Route::post('/dokumen/simpan', [SettingController::Class, 'dokumenSimpan'])->name('dokumen.simpan');
Route::delete('/dokumen/hapus/{show}', [SettingController::Class, 'destroy']);
// Route untuk tahun dibawah ini
Route::get('/tahun', [SettingController::Class, 'tahun'])->name('tahun');
Route::get('/tahun/tambah', [SettingController::Class, 'tahunTambah'])->name('tahun.tambah');
Route::post('/tahun/tambah/simpan', [SettingController::Class, 'tahunSimpan'])->name('tahun.simpan');
//Route untuk tambahkan rubrik
Route::get('/rubrik',[SettingCOntroller::Class, 'rubrik'])->name('rubrik');
Route::get('/rubrik/tambah',[SettingCOntroller::Class, 'rubrikTambah'])->name('rubrik.tambah');
Route::post('/rubrik/simpan',[SettingCOntroller::Class, 'rubrikSimpan'])->name('rubrik.simpan');
// Route untuk menambahkan kode rubrik
Route::get('/koderubrik', [SettingController::Class, 'kodeRubrik'])->name('koderubrik');
Route::get('/koderubrik/tambah', [SettingController::Class, 'kodeRubrikTambah'])->name('kodeRubrik.tambah');
Route::post('/koderubrik/simpan', [SettingController::Class, 'KodeRubrikSimpan'])->name('KodeRubrik.simpan');

// Route untuk tambah user
Route::get('/user', [UserController::Class, 'user'])->name('user');
Route::get('/user/tambah', [UserController::Class, 'tambahUser'])->name('tambahuser');
Route::post('/user/simpan', [UserController::Class, 'simpanUser'])->name('simpanuser');

// Reset Password
Route::get('/resetpassword', [UserController::Class, 'resetPassword'])->name('resetpassword');
Route::post('/resetpassword/simpan', [UserController::Class, 'resetPasswordSimpan'])->name('resetPasswordSimpan');

});


Route::middleware([ 'ganti'])->group(function () {       // Pembukaan middleware group

// Route untuk Memorandum 01
Route::get('/m01biasa', [Memorandum01Controller::Class, 'm01biasa'])->name('m01biasa');
Route::get('/cekm01', [Memorandum01Controller::Class, 'cekm01'])->name('cekm01');
Route::get('/m01biasa/ambil', [Memorandum01Controller::Class, 'm01biasaAmbil'])->name('m01biasa.ambil');
Route::post('/m01biasa/simpan', [Memorandum01Controller::Class, 'm01biasaSimpan'])->name('m01biasa.simpan');
Route::delete('/m01biasa/hapus/{show}', [Memorandum01Controller::Class, 'm01biasaHapus']);
Route::get('/m01biasa/ubah/{show}', [Memorandum01Controller::Class, 'm01biasaUbah']);
Route::patch('/m01biasa/update', [Memorandum01Controller::Class, 'm01biasaUpdate']);
Route::get('/m01biasa/backdatenew', [Memorandum01Controller::Class, 'm01biasabackdatenew']);
Route::patch('/m01biasa/backdatenew/store', [Memorandum01Controller::Class, 'm01biasabackdatenewstore']);
Route::get('/m01biasa/edit/{show}', [Memorandum01Controller::Class, 'm01biasaEdit']); // Route khusus admin untuk edit
Route::patch('/m01biasa/store', [Memorandum01Controller::Class, 'm01biasaStore']); // Route untuk simpan hasil edit admin
Route::get('/m01biasa/backdate/{show}', [Memorandum01Controller::Class, 'm01biasaBackdate']); // Route khusus admin untuk edit
Route::patch('/m01biasa/backdateStore', [Memorandum01Controller::Class, 'm01biasaBackdateStore']); // Route untuk simpan hasil edit admin

// Route untuk Memorandum 01
Route::get('/m01rahasia', [Memorandum01Controller::Class, 'm01rahasia'])->name('m01rahasia');
Route::get('/m01rahasia/ambil', [Memorandum01Controller::Class, 'm01rahasiaAmbil'])->name('m01rahasia.ambil');
Route::post('/m01rahasia/simpan', [Memorandum01Controller::Class, 'm01rahasiaSimpan'])->name('m01rahasia.simpan');
Route::delete('/m01rahasia/hapus/{show}', [Memorandum01Controller::Class, 'm01rahasiaHapus']);
Route::get('/m01rahasia/ubah/{show}', [Memorandum01Controller::Class, 'm01rahasiaUbah']);
Route::patch('/m01rahasia/update', [Memorandum01Controller::Class, 'm01rahasiaUpdate']);
Route::get('/m01rahasia/edit/{show}', [Memorandum01Controller::Class, 'm01rahasiaEdit']); // Route khusus admin untuk edit
Route::patch('/m01rahasia/store', [Memorandum01Controller::Class, 'm01rahasiaStore']); // Route untuk simpan hasil edit admin
Route::get('/m01rahasia/backdate/{show}', [Memorandum01Controller::Class, 'm01rahasiaBackdate']); // Route khusus admin untuk edit
Route::patch('/m01rahasia/backdateStore', [Memorandum01Controller::Class, 'm01rahasiaBackdateStore']); // Route untuk simpan hasil edit admin



// Route untuk Surat
Route::get('/suratrahasia', [SuratController::Class, 'suratrahasia'])->name('suratrahasia');
Route::get('/suratrahasia/ambil', [SuratController::Class, 'suratrahasiaAmbil'])->name('suratrahasia.ambil');
Route::post('/suratrahasia/simpan', [SuratController::Class, 'suratrahasiaSimpan'])->name('suratrahasia.simpan');
Route::delete('/suratrahasia/hapus/{show}', [SuratController::Class, 'suratrahasiaHapus']);
Route::get('/suratrahasia/ubah/{show}', [SuratController::Class, 'suratrahasiaUbah']);
Route::patch('/suratrahasia/update', [SuratController::Class, 'suratrahasiaUpdate']);
Route::get('/suratrahasia/edit/{show}', [SuratController::Class, 'suratrahasiaEdit']); // Route khusus admin untuk edit
Route::patch('/suratrahasia/store', [SuratController::Class, 'suratrahasiaStore']); // Route untuk simpan hasil edit admin
Route::get('/suratrahasia/backdate/{show}', [SuratController::Class, 'suratrahasiaBackdate']); // Route khusus admin untuk edit
Route::patch('/suratrahasia/backdateStore', [SuratController::Class, 'suratrahasiaBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk Surat
Route::get('/suratbiasa', [SuratController::Class, 'suratbiasa'])->name('suratbiasa');
Route::get('/suratbiasaambil', [SuratController::Class, 'suratbiasaAmbil'])->name('suratbiasa.ambil');
Route::post('/suratbiasa/simpan', [SuratController::Class, 'suratbiasaSimpan'])->name('suratbiasa.simpan');
Route::delete('/suratbiasa/hapus/{show}', [SuratController::Class, 'suratbiasaHapus']);
Route::get('/suratbiasa/ubah/{show}', [SuratController::Class, 'suratbiasaUbah']);
Route::patch('/suratbiasa/update', [SuratController::Class, 'suratbiasaUpdate']);
Route::get('/suratbiasa/edit/{show}', [SuratController::Class, 'suratbiasaEdit']); // Route khusus admin untuk edit
Route::patch('/suratbiasa/store', [SuratController::Class, 'suratbiasaStore']); // Route untuk simpan hasil edit admin
Route::get('/suratbiasa/backdate/{show}', [SuratController::Class, 'suratbiasaBackdate']); // Route khusus admin untuk edit
Route::patch('/suratbiasa/backdateStore', [SuratController::Class, 'suratbiasaBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk Surat TUGAS
Route::get('/surattugas', [SuratController::Class, 'surattugas'])->name('surattugas');
Route::get('/surattugasambil', [SuratController::Class, 'surattugasAmbil'])->name('surattugas.ambil');
Route::post('/surattugas/simpan', [SuratController::Class, 'surattugasSimpan'])->name('surattugas.simpan');
Route::delete('/surattugas/hapus/{show}', [SuratController::Class, 'surattugasHapus']);
Route::get('/surattugas/ubah/{show}', [SuratController::Class, 'surattugasUbah']);
Route::patch('/surattugas/update', [SuratController::Class, 'surattugasUpdate']);
Route::get('/surattugas/edit/{show}', [SuratController::Class, 'surattugasEdit']); // Route khusus admin untuk edit
Route::patch('/surattugas/store', [SuratController::Class, 'surattugasStore']); // Route untuk simpan hasil edit admin
Route::get('/surattugas/backdate/{show}', [SuratController::Class, 'surattugasBackdate']); // Route khusus admin untuk edit
Route::patch('/surattugas/backdateStore', [SuratController::Class, 'surattugasBackdateStore']); // Route untuk simpan hasil edit admin



// Route untuk Faximli
Route::get('/faximilirahasia', [FaximiliController::Class, 'faximilirahasia'])->name('faximilirahasia');
Route::get('/faximilirahasia/ambil', [FaximiliController::Class, 'faximilirahasiaAmbil'])->name('faximilirahasia.ambil');
Route::post('/faximilirahasia/simpan', [FaximiliController::Class, 'faximilirahasiaSimpan'])->name('faximilirahasia.simpan');
Route::delete('/faximilirahasia/hapus/{show}', [FaximiliController::Class, 'faximilirahasiaHapus']);
Route::get('/faximilirahasia/ubah/{show}', [FaximiliController::Class, 'faximilirahasiaUbah']);
Route::patch('/faximilirahasia/update', [FaximiliController::Class, 'faximilirahasiaUpdate']);
Route::get('/faximilirahasia/edit/{show}', [FaximiliController::Class, 'faximilirahasiaEdit']); // Route khusus admin untuk edit
Route::patch('/faximilirahasia/store', [FaximiliController::Class, 'faximilirahasiaStore']); // Route untuk simpan hasil edit admin
Route::get('/faximilirahasia/backdate/{show}', [FaximiliController::Class, 'faximilirahasiaBackdate']); // Route khusus admin untuk edit
Route::patch('/faximilirahasia/backdateStore', [FaximiliController::Class, 'faximilirahasiaBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk Faximili
Route::get('/faximilibiasa', [FaximiliController::Class, 'faximilibiasa'])->name('faximilibiasa');
Route::get('/faximilibiasaambil', [FaximiliController::Class, 'faximilibiasaAmbil'])->name('faximilibiasa.ambil');
Route::post('/faximilibiasa/simpan', [FaximiliController::Class, 'faximilibiasaSimpan'])->name('faximilibiasa.simpan');
Route::delete('/faximilibiasa/hapus/{show}', [FaximiliController::Class, 'faximilibiasaHapus']);
Route::get('/faximilibiasa/ubah/{show}', [FaximiliController::Class, 'faximilibiasaUbah']);
Route::patch('/faximilibiasa/update', [FaximiliController::Class, 'faximilibiasaUpdate']);
Route::get('/faximilibiasa/edit/{show}', [FaximiliController::Class, 'faximilibiasaEdit']); // Route khusus admin untuk edit
Route::patch('/faximilibiasa/store', [FaximiliController::Class, 'faximilibiasaStore']); // Route untuk simpan hasil edit admin
Route::get('/faximilibiasa/backdate/{show}', [FaximiliController::Class, 'faximilibiasaBackdate']); // Route khusus admin untuk edit
Route::patch('/faximilibiasa/backdateStore', [FaximiliController::Class, 'faximilibiasaBackdateStore']); // Route untuk simpan hasil edit admin



// Route untuk Berita Acara Rhs
Route::get('/barahasia', [BeritaacaraController::Class, 'barahasia'])->name('barahasia');
Route::get('/barahasia/ambil', [BeritaacaraController::Class, 'barahasiaAmbil'])->name('barahasia.ambil');
Route::post('/barahasia/simpan', [BeritaacaraController::Class, 'barahasiaSimpan'])->name('barahasia.simpan');
Route::delete('/barahasia/hapus/{show}', [BeritaacaraController::Class, 'barahasiaHapus']);
Route::get('/barahasia/ubah/{show}', [BeritaacaraController::Class, 'barahasiaUbah']);
Route::patch('/barahasia/update', [BeritaacaraController::Class, 'barahasiaUpdate']);
Route::get('/barahasia/edit/{show}', [BeritaacaraController::Class, 'barahasiaEdit']); // Route khusus admin untuk edit
Route::patch('/barahasia/store', [BeritaacaraController::Class, 'barahasiaStore']); // Route untuk simpan hasil edit admin
Route::get('/barahasia/backdate/{show}', [BeritaacaraController::Class, 'barahasiaBackdate']); // Route khusus admin untuk edit
Route::patch('/barahasia/backdateStore', [BeritaacaraController::Class, 'barahasiaBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk BA Biasa
Route::get('/babiasa', [BeritaacaraController::Class, 'babiasa'])->name('babiasa');
Route::get('/babiasaambil', [BeritaacaraController::Class, 'babiasaAmbil'])->name('babiasa.ambil');
Route::post('/babiasa/simpan', [BeritaacaraController::Class, 'babiasaSimpan'])->name('babiasa.simpan');
Route::delete('/babiasa/hapus/{show}', [BeritaacaraController::Class, 'babiasaHapus']);
Route::get('/babiasa/ubah/{show}', [BeritaacaraController::Class, 'babiasaUbah']);
Route::patch('/babiasa/update', [BeritaacaraController::Class, 'babiasaUpdate']);
Route::get('/babiasa/edit/{show}', [BeritaacaraController::Class, 'babiasaEdit']); // Route khusus admin untuk edit
Route::patch('/babiasa/store', [BeritaacaraController::Class, 'babiasaStore']); // Route untuk simpan hasil edit admin
Route::get('/babiasa/backdate/{show}', [BeritaacaraController::Class, 'babiasaBackdate']); // Route khusus admin untuk edit
Route::patch('/babiasa/backdateStore', [BeritaacaraController::Class, 'babiasaBackdateStore']); // Route untuk simpan hasil edit admin

// Route untuk BASTAM
Route::get('/bastam', [BeritaacaraController::Class, 'bastam'])->name('bastam');
Route::get('/bastam/ambil', [BeritaacaraController::Class, 'bastamAmbil'])->name('bastam.ambil');
Route::post('/bastam/simpan', [BeritaacaraController::Class, 'bastamSimpan'])->name('bastam.simpan');
Route::delete('/bastam/hapus/{show}', [BeritaacaraController::Class, 'bastamHapus']);
Route::get('/bastam/ubah/{show}', [BeritaacaraController::Class, 'bastamUbah']);
Route::patch('/bastam/update', [BeritaacaraController::Class, 'bastamUpdate']);
Route::get('/bastam/edit/{show}', [BeritaacaraController::Class, 'bastamEdit']); // Route khusus admin untuk edit
Route::patch('/bastam/store', [BeritaacaraController::Class, 'bastamStore']); // Route untuk simpan hasil edit admin
Route::get('/bastam/backdate/{show}', [BeritaacaraController::Class, 'bastamBackdate']); // Route khusus admin untuk edit
Route::patch('/bastam/backdateStore', [BeritaacaraController::Class, 'bastamBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk BAMA
Route::get('/bama', [BeritaacaraController::Class, 'bama'])->name('bama');
Route::get('/bamaambil', [BeritaacaraController::Class, 'bamaAmbil'])->name('bama.ambil');
Route::post('/bama/simpan', [BeritaacaraController::Class, 'bamaSimpan'])->name('bama.simpan');
Route::delete('/bama/hapus/{show}', [BeritaacaraController::Class, 'bamaHapus']);
Route::get('/bama/ubah/{show}', [BeritaacaraController::Class, 'bamaUbah']);
Route::patch('/bama/update', [BeritaacaraController::Class, 'bamaUpdate']);
Route::get('/bama/edit/{show}', [BeritaacaraController::Class, 'bamaEdit']); // Route khusus admin untuk edit
Route::patch('/bama/store', [BeritaacaraController::Class, 'bamaStore']); // Route untuk simpan hasil edit admin
Route::get('/bama/backdate/{show}', [BeritaacaraController::Class, 'bamaBackdate']); // Route khusus admin untuk edit
Route::patch('/bama/backdateStore', [BeritaacaraController::Class, 'bamaBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk BANA
Route::get('/bana', [BeritaacaraController::Class, 'bana'])->name('bana');
Route::get('/banaambil', [BeritaacaraController::Class, 'banaAmbil'])->name('bana.ambil');
Route::post('/bana/simpan', [BeritaacaraController::Class, 'banaSimpan'])->name('bana.simpan');
Route::delete('/bana/hapus/{show}', [BeritaacaraController::Class, 'banaHapus']);
Route::get('/bana/ubah/{show}', [BeritaacaraController::Class, 'banaUbah']);
Route::patch('/bana/update', [BeritaacaraController::Class, 'banaUpdate']);
Route::get('/bana/edit/{show}', [BeritaacaraController::Class, 'banaEdit']); // Route khusus admin untuk edit
Route::patch('/bana/store', [BeritaacaraController::Class, 'banaStore']); // Route untuk simpan hasil edit admin
Route::get('/bana/backdate/{show}', [BeritaacaraController::Class, 'banaBackdate']); // Route khusus admin untuk edit
Route::patch('/bana/backdateStore', [BeritaacaraController::Class, 'banaBackdateStore']); // Route untuk simpan hasil edit admin

// Route untuk BAMA
Route::get('/bama', [BeritaacaraController::Class, 'bama'])->name('bama');
Route::get('/bamaambil', [BeritaacaraController::Class, 'bamaAmbil'])->name('bama.ambil');
Route::post('/bama/simpan', [BeritaacaraController::Class, 'bamaSimpan'])->name('bama.simpan');
Route::delete('/bama/hapus/{show}', [BeritaacaraController::Class, 'bamaHapus']);
Route::get('/bama/ubah/{show}', [BeritaacaraController::Class, 'bamaUbah']);
Route::patch('/bama/update', [BeritaacaraController::Class, 'bamaUpdate']);
Route::get('/bama/edit/{show}', [BeritaacaraController::Class, 'bamaEdit']); // Route khusus admin untuk edit
Route::patch('/bama/store', [BeritaacaraController::Class, 'bamaStore']); // Route untuk simpan hasil edit admin
Route::get('/bama/backdate/{show}', [BeritaacaraController::Class, 'bamaBackdate']); // Route khusus admin untuk edit
Route::patch('/bama/backdateStore', [BeritaacaraController::Class, 'bamaBackdateStore']); // Route untuk simpan hasil edit admin


// Route untuk erp
Route::get('/erp', [UamController::Class, 'erp'])->name('erp');
Route::get('/erpambil', [UamController::Class, 'erpAmbil'])->name('erp.ambil');
Route::post('/erp/simpan', [UamController::Class, 'erpSimpan'])->name('erp.simpan');
Route::delete('/erp/hapus/{show}', [UamController::Class, 'erpHapus']);
Route::get('/erp/ubah/{show}', [UamController::Class, 'erpUbah']);
Route::patch('/erp/update', [UamController::Class, 'erpUpdate']);
Route::get('/erp/edit/{show}', [UamController::Class, 'erpEdit']); // Route khusus admin untuk edit
Route::patch('/erp/store', [UamController::Class, 'erpStore']); // Route untuk simpan hasil edit admin
Route::get('/erp/backdate/{show}', [UamController::Class, 'erpBackdate']); // Route khusus admin untuk edit
Route::patch('/erp/backdateStore', [UamController::Class, 'erpBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk CBS
Route::get('/cbs', [UamController::Class, 'cbs'])->name('cbs');
Route::get('/cbsambil', [UamController::Class, 'cbsAmbil'])->name('cbs.ambil');
Route::post('/cbs/simpan', [UamController::Class, 'cbsSimpan'])->name('cbs.simpan');
Route::delete('/cbs/hapus/{show}', [UamController::Class, 'cbsHapus']);
Route::get('/cbs/ubah/{show}', [UamController::Class, 'cbsUbah']);
Route::patch('/cbs/update', [UamController::Class, 'cbsUpdate']);
Route::get('/cbs/edit/{show}', [UamController::Class, 'cbsEdit']); // Route khusus admin untuk edit
Route::patch('/cbs/store', [UamController::Class, 'cbsStore']); // Route untuk simpan hasil edit admin
Route::get('/cbs/backdate/{show}', [UamController::Class, 'cbsBackdate']); // Route khusus admin untuk edit
Route::patch('/cbs/backdateStore', [UamController::Class, 'cbsBackdateStore']); // Route untuk simpan hasil edit admin


// Route untuk gbi
Route::get('/gbi', [KeputusanController::Class, 'gbi'])->name('gbi');
Route::get('/gbiambil', [KeputusanController::Class, 'gbiAmbil'])->name('gbi.ambil');
Route::post('/gbi/simpan', [KeputusanController::Class, 'gbiSimpan'])->name('gbi.simpan');
Route::delete('/gbi/hapus/{show}', [KeputusanController::Class, 'gbiHapus']);
Route::get('/gbi/ubah/{show}', [KeputusanController::Class, 'gbiUbah']);
Route::patch('/gbi/update', [KeputusanController::Class, 'gbiUpdate']);
Route::get('/gbi/edit/{show}', [KeputusanController::Class, 'gbiEdit']); // Route khusus admin untuk edit
Route::patch('/gbi/store', [KeputusanController::Class, 'gbiStore']); // Route untuk simpan hasil edit admin
Route::get('/gbi/backdate/{show}', [KeputusanController::Class, 'gbiBackdate']); // Route khusus admin untuk edit
Route::patch('/gbi/backdateStore', [KeputusanController::Class, 'gbiBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk pbi
Route::get('/pbi', [KeputusanController::Class, 'pbi'])->name('pbi');
Route::get('/pbiambil', [KeputusanController::Class, 'pbiAmbil'])->name('pbi.ambil');
Route::post('/pbi/simpan', [KeputusanController::Class, 'pbiSimpan'])->name('pbi.simpan');
Route::delete('/pbi/hapus/{show}', [KeputusanController::Class, 'pbiHapus']);
Route::get('/pbi/ubah/{show}', [KeputusanController::Class, 'pbiUbah']);
Route::patch('/pbi/update', [KeputusanController::Class, 'pbiUpdate']);
Route::get('/pbi/edit/{show}', [KeputusanController::Class, 'pbiEdit']); // Route khusus admin untuk edit
Route::patch('/pbi/store', [KeputusanController::Class, 'pbiStore']); // Route untuk simpan hasil edit admin
Route::get('/pbi/backdate/{show}', [KeputusanController::Class, 'pbiBackdate']); // Route khusus admin untuk edit
Route::patch('/pbi/backdateStore', [KeputusanController::Class, 'pbiBackdateStore']); // Route untuk simpan hasil edit admin

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


// Route untuk Perjanjian
Route::get('/perjanjian', [PerjanjianController::Class, 'perjanjian'])->name('perjanjian');
Route::get('/perjanjianambil', [PerjanjianController::Class, 'perjanjianAmbil'])->name('perjanjian.ambil');
Route::post('/perjanjian/simpan', [PerjanjianController::Class, 'perjanjianSimpan'])->name('perjanjian.simpan');
Route::delete('/perjanjian/hapus/{show}', [PerjanjianController::Class, 'perjanjianHapus']);
Route::get('/perjanjian/ubah/{show}', [PerjanjianController::Class, 'perjanjianUbah']);
Route::patch('/perjanjian/update', [PerjanjianController::Class, 'perjanjianUpdate']);
Route::get('/perjanjian/edit/{show}', [PerjanjianController::Class, 'perjanjianEdit']); // Route khusus admin untuk edit
Route::patch('/perjanjian/store', [PerjanjianController::Class, 'perjanjianStore']); // Route untuk simpan hasil edit admin
Route::get('/perjanjian/backdate/{show}', [PerjanjianController::Class, 'perjanjianBackdate']); // Route khusus admin untuk edit
Route::patch('/perjanjian/backdateStore', [PerjanjianController::Class, 'perjanjianBackdateStore']); // Route untuk simpan hasil edit admin



// Route untuk M02
Route::get('/m02satkerbiasa', [M02Controller::Class, 'm02satkerbiasa'])->name('m02satkerbiasa');
Route::get('/m02satkerbiasaambil', [M02Controller::Class, 'm02satkerbiasaAmbil'])->name('m02satkerbiasa.ambil');
Route::post('/m02satkerbiasa/simpan', [M02Controller::Class, 'm02satkerbiasaSimpan'])->name('m02satkerbiasa.simpan');
Route::delete('/m02satkerbiasa/hapus/{show}', [M02Controller::Class, 'm02satkerbiasaHapus']);
Route::get('/m02satkerbiasa/ubah/{show}', [M02Controller::Class, 'm02satkerbiasaUbah']);
Route::patch('/m02satkerbiasa/update', [M02Controller::Class, 'm02satkerbiasaUpdate']);
Route::get('/m02satkerbiasa/edit/{show}', [M02Controller::Class, 'm02satkerbiasaEdit']); // Route khusus admin untuk edit
Route::patch('/m02satkerbiasa/store', [M02Controller::Class, 'm02satkerbiasaStore']); // Route untuk simpan hasil edit admin
Route::get('/m02satkerbiasa/backdate/{show}', [M02Controller::Class, 'm02satkerbiasaBackdate']); // Route khusus admin untuk edit
Route::patch('/m02satkerbiasa/backdateStore', [M02Controller::Class, 'm02satkerbiasaBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk M02 rahasia
Route::get('/m02satkerrhs', [M02Controller::Class, 'm02satkerrhs'])->name('m02satkerrhs');
Route::get('/m02satkerrhsambil', [M02Controller::Class, 'm02satkerrhsAmbil'])->name('m02satkerrhs.ambil');
Route::post('/m02satkerrhs/simpan', [M02Controller::Class, 'm02satkerrhsSimpan'])->name('m02satkerrhs.simpan');
Route::delete('/m02satkerrhs/hapus/{show}', [M02Controller::Class, 'm02satkerrhsHapus']);
Route::get('/m02satkerrhs/ubah/{show}', [M02Controller::Class, 'm02satkerrhsUbah']);
Route::patch('/m02satkerrhs/update', [M02Controller::Class, 'm02satkerrhsUpdate']);
Route::get('/m02satkerrhs/edit/{show}', [M02Controller::Class, 'm02satkerrhsEdit']); // Route khusus admin untuk edit
Route::patch('/m02satkerrhs/store', [M02Controller::Class, 'm02satkerrhsStore']); // Route untuk simpan hasil edit admin
Route::get('/m02satkerrhs/backdate/{show}', [M02Controller::Class, 'm02satkerrhsBackdate']); // Route khusus admin untuk edit
Route::patch('/m02satkerrhs/backdateStore', [M02Controller::Class, 'm02satkerrhsBackdateStore']); // Route untuk simpan hasil edit admin
// Route untuk M02 CA
Route::get('/m02CA', [M02Controller::Class, 'm02CA'])->name('m02CA');
Route::get('/m02CAambil', [M02Controller::Class, 'm02CAAmbil'])->name('m02CA.ambil');
Route::post('/m02CA/simpan', [M02Controller::Class, 'm02CASimpan'])->name('m02CA.simpan');
Route::delete('/m02CA/hapus/{show}', [M02Controller::Class, 'm02CAHapus']);
Route::get('/m02CA/ubah/{show}', [M02Controller::Class, 'm02CAUbah']);
Route::patch('/m02CA/update', [M02Controller::Class, 'm02CAUpdate']);
Route::get('/m02CA/edit/{show}', [M02Controller::Class, 'm02CAEdit']); // Route khusus admin untuk edit
Route::patch('/m02CA/store', [M02Controller::Class, 'm02CAStore']); // Route untuk simpan hasil edit admin
Route::get('/m02CA/backdate/{show}', [M02Controller::Class, 'm02CABackdate']); // Route khusus admin untuk edit
Route::patch('/m02CA/backdateStore', [M02Controller::Class, 'm02CABackdateStore']); // Route untuk simpan hasil edit admin

// Route untuk LDP CA
Route::get('/caldp', [M02Controller::Class, 'caldp'])->name('caldp');
Route::get('/caldpambil', [M02Controller::Class, 'caldpAmbil'])->name('caldp.ambil');
Route::post('/caldp/simpan', [M02Controller::Class, 'caldpSimpan'])->name('caldp.simpan');
Route::delete('/caldp/hapus/{show}', [M02Controller::Class, 'caldpHapus']);
Route::get('/caldp/ubah/{show}', [M02Controller::Class, 'caldpUbah']);
Route::patch('/caldp/update', [M02Controller::Class, 'caldpUpdate']);
Route::get('/caldp/edit/{show}', [M02Controller::Class, 'caldpEdit']); // Route khusus admin untuk edit
Route::patch('/caldp/store', [M02Controller::Class, 'caldpStore']); // Route untuk simpan hasil edit admin
Route::get('/caldp/backdate/{show}', [M02Controller::Class, 'caldpBackdate']); // Route khusus admin untuk edit
Route::patch('/caldp/backdateStore', [M02Controller::Class, 'caldpBackdateStore']); // Route untuk simpan hasil edit admin




// DOKUMEN UNIT

// Route untuk M02 UMI
Route::get('/m02umibiasa', [UmiController::Class, 'm02umibiasa'])->name('m02umibiasa')->middleware('checkunit:UMI');
Route::get('/m02umibiasaambil', [UmiController::Class, 'm02umibiasaAmbil'])->name('m02umibiasa.ambil')->middleware('checkunit:UMI');
Route::post('/m02umibiasa/simpan', [UmiController::Class, 'm02umibiasaSimpan'])->name('m02umibiasa.simpan')->middleware('checkunit:UMI');
Route::delete('/m02umibiasa/hapus/{show}', [UmiController::Class, 'm02umibiasaHapus'])->middleware('checkunit:UMI');
Route::get('/m02umibiasa/ubah/{show}', [UmiController::Class, 'm02umibiasaUbah'])->middleware('checkunit:UMI');
Route::patch('/m02umibiasa/update', [UmiController::Class, 'm02umibiasaUpdate'])->middleware('checkunit:UMI');
Route::get('/m02umibiasa/edit/{show}', [UmiController::Class, 'm02umibiasaEdit'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/m02umibiasa/store', [UmiController::Class, 'm02umibiasaStore'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin
Route::get('/m02umibiasa/backdate/{show}', [UmiController::Class, 'm02umibiasaBackdate'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/m02umibiasa/backdateStore', [UmiController::Class, 'm02umibiasaBackdateStore'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin
// Route untuk M02 rahasia
Route::get('/m02umirhs', [UmiController::Class, 'm02umirhs'])->name('m02umirhs')->middleware('checklevel:manajer');
Route::get('/m02umiambil', [UmiController::Class, 'm02umirhsAmbil'])->name('m02umirhs.ambil')->middleware('checklevel:manajer');
Route::post('/m02umirhs/simpan', [UmiController::Class, 'm02umirhsSimpan'])->name('m02umirhs.simpan')->middleware('checklevel:manajer');
Route::delete('/m02umirhs/hapus/{show}', [UmiController::Class, 'm02umirhsHapus'])->middleware('checklevel:manajer');
Route::get('/m02umirhs/ubah/{show}', [UmiController::Class, 'm02umirhsUbah'])->middleware('checklevel:manajer');
Route::patch('/m02umirhs/update', [UmiController::Class, 'm02umirhsUpdate'])->middleware('checklevel:manajer');
Route::get('/m02umirhs/edit/{show}', [UmiController::Class, 'm02umirhsEdit'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02umirhs/store', [UmiController::Class, 'm02umirhsStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin
Route::get('/m02umirhs/backdate/{show}', [UmiController::Class, 'm02umirhsBackdate'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02umirhs/backdateStore', [UmiController::Class, 'm02umirhsBackdateStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin

// Route untuk Batch UMI
Route::get('/batch', [UmiController::Class, 'batch'])->name('batch')->middleware('checkunit:UMI');
Route::get('/batchambil', [UmiController::Class, 'batchAmbil'])->name('batch.ambil')->middleware('checkunit:UMI');
Route::post('/batch/simpan', [UmiController::Class, 'batchSimpan'])->name('batch.simpan')->middleware('checkunit:UMI');
Route::delete('/batch/hapus/{show}', [UmiController::Class, 'batchHapus'])->middleware('checkunit:UMI');
Route::get('/batch/ubah/{show}', [UmiController::Class, 'batchUbah'])->middleware('checkunit:UMI');
Route::patch('/batch/update', [UmiController::Class, 'batchUpdate'])->middleware('checkunit:UMI');
Route::get('/batch/edit/{show}', [UmiController::Class, 'batchEdit'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/batch/store', [UmiController::Class, 'batchStore'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin
Route::get('/batch/backdate/{show}', [UmiController::Class, 'batchBackdate'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/batch/backdateStore', [UmiController::Class, 'batchBackdateStore'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin

// Route untuk LDP UMI
Route::get('/umildp', [UmiController::Class, 'umildp'])->name('umildp')->middleware('checkunit:UMI');
Route::get('/umildpambil', [UmiController::Class, 'umildpAmbil'])->name('umildp.ambil')->middleware('checkunit:UMI');
Route::post('/umildp/simpan', [UmiController::Class, 'umildpSimpan'])->name('umildp.simpan')->middleware('checkunit:UMI');
Route::delete('/umildp/hapus/{show}', [UmiController::Class, 'umildpHapus'])->middleware('checkunit:UMI');
Route::get('/umildp/ubah/{show}', [UmiController::Class, 'umildpUbah'])->middleware('checkunit:UMI');
Route::patch('/umildp/update', [UmiController::Class, 'umildpUpdate'])->middleware('checkunit:UMI');
Route::get('/umildp/edit/{show}', [UmiController::Class, 'umildpEdit'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/umildp/store', [UmiController::Class, 'umildpStore'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin
Route::get('/umildp/backdate/{show}', [UmiController::Class, 'umildpBackdate'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/umildp/backdateStore', [UmiController::Class, 'umildpBackdateStore'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin

// Route untuk TV01 UMI
Route::get('/umitv01', [UmiController::Class, 'umitv01'])->name('umitv01')->middleware('checkunit:UMI');
Route::get('/umitv01ambil', [UmiController::Class, 'tv01Ambil'])->name('umitv01.ambil')->middleware('checkunit:UMI');
Route::post('/umitv01/simpan', [UmiController::Class, 'tv01Simpan'])->name('umitv01.simpan')->middleware('checkunit:UMI');
Route::delete('/umitv01/hapus/{show}', [UmiController::Class, 'tv01Hapus'])->middleware('checkunit:UMI');
Route::get('/umitv01/ubah/{show}', [UmiController::Class, 'tv01Ubah'])->middleware('checkunit:UMI');
Route::patch('/umitv01/update', [UmiController::Class, 'tv01Update'])->middleware('checkunit:UMI');
Route::get('/umitv01/edit/{show}', [UmiController::Class, 'tv01Edit'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/umitv01/store', [UmiController::Class, 'tv01Store'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin
Route::get('/umitv01/backdate/{show}', [UmiController::Class, 'tv01Backdate'])->middleware('checkunit:UMI'); // Route khusus admin untuk edit
Route::patch('/umitv01/backdateStore', [UmiController::Class, 'tv01BackdateStore'])->middleware('checkunit:UMI'); // Route untuk simpan hasil edit admin


// Route untuk M02 UIPUR
Route::get('/m02uipurbiasa', [UipurController::Class, 'm02uipurbiasa'])->name('m02uipurbiasa')->middleware('checkunit:UIPUR');
Route::get('/m02uipurbiasaambil', [UipurController::Class, 'm02uipurbiasaAmbil'])->name('m02uipurbiasa.ambil')->middleware('checkunit:UIPUR');
Route::post('/m02uipurbiasa/simpan', [UipurController::Class, 'm02uipurbiasaSimpan'])->name('m02uipurbiasa.simpan')->middleware('checkunit:UIPUR');
Route::delete('/m02uipurbiasa/hapus/{show}', [UipurController::Class, 'm02uipurbiasaHapus'])->middleware('checkunit:UIPUR');
Route::get('/m02uipurbiasa/ubah/{show}', [UipurController::Class, 'm02uipurbiasaUbah'])->middleware('checkunit:UIPUR');
Route::patch('/m02uipurbiasa/update', [UipurController::Class, 'm02uipurbiasaUpdate'])->middleware('checkunit:UIPUR');
Route::get('/m02uipurbiasa/edit/{show}', [UipurController::Class, 'm02uipurbiasaEdit'])->middleware('checkunit:UIPUR'); // Route khusus admin untuk edit
Route::patch('/m02uipurbiasa/store', [UipurController::Class, 'm02uipurbiasaStore'])->middleware('checkunit:UIPUR'); // Route untuk simpan hasil edit admin
Route::get('/m02uipurbiasa/backdate/{show}', [UipurController::Class, 'm02uipurbiasaBackdate'])->middleware('checkunit:UIPUR'); // Route khusus admin untuk edit
Route::patch('/m02uipurbiasa/backdateStore', [UipurController::Class, 'm02uipurbiasaBackdateStore'])->middleware('checkunit:UIPUR'); // Route untuk simpan hasil edit admin
// Route untuk M02 rahasia
Route::get('/m02uipurrhs', [UipurController::Class, 'm02uipurrhs'])->name('m02uipurrhs')->middleware('checklevel:manajer', 'checkunit:UIPUR');
Route::get('/m02uipurambil', [UipurController::Class, 'm02uipurrhsAmbil'])->name('m02uipurrhs.ambil')->middleware('checklevel:manajer');
Route::post('/m02uipurrhs/simpan', [UipurController::Class, 'm02uipurrhsSimpan'])->name('m02uipurrhs.simpan')->middleware('checklevel:manajer');
Route::delete('/m02uipurrhs/hapus/{show}', [UipurController::Class, 'm02uipurrhsHapus'])->middleware('checklevel:manajer');
Route::get('/m02uipurrhs/ubah/{show}', [UipurController::Class, 'm02uipurrhsUbah'])->middleware('checklevel:manajer');
Route::patch('/m02uipurrhs/update', [UipurController::Class, 'm02uipurrhsUpdate'])->middleware('checklevel:manajer');
Route::get('/m02uipurrhs/edit/{show}', [UipurController::Class, 'm02uipurrhsEdit'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02uipurrhs/store', [UipurController::Class, 'm02uipurrhsStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin
Route::get('/m02uipurrhs/backdate/{show}', [UipurController::Class, 'm02uipurrhsBackdate'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02uipurrhs/backdateStore', [UipurController::Class, 'm02uipurrhsBackdateStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin


// Route untuk LDP UIPUR
Route::get('/uipurldp', [UipurController::Class, 'uipurldp'])->name('uipurldp')->middleware('checkunit:UIPUR');
Route::get('/uipurldpambil', [UipurController::Class, 'uipurldpAmbil'])->name('uipurldp.ambil')->middleware('checkunit:UIPUR');
Route::post('/uipurldp/simpan', [UipurController::Class, 'uipurldpSimpan'])->name('uipurldp.simpan')->middleware('checkunit:UIPUR');
Route::delete('/uipurldp/hapus/{show}', [UipurController::Class, 'uipurldpHapus'])->middleware('checkunit:UIPUR');
Route::get('/uipurldp/ubah/{show}', [UipurController::Class, 'uipurldpUbah'])->middleware('checkunit:UIPUR');
Route::patch('/uipurldp/update', [UipurController::Class, 'uipurldpUpdate'])->middleware('checkunit:UIPUR');
Route::get('/uipurldp/edit/{show}', [UipurController::Class, 'uipurldpEdit'])->middleware('checkunit:UIPUR'); // Route khusus admin untuk edit
Route::patch('/uipurldp/store', [UipurController::Class, 'uipurldpStore'])->middleware('checkunit:UIPUR'); // Route untuk simpan hasil edit admin
Route::get('/uipurldp/backdate/{show}', [UipurController::Class, 'uipurldpBackdate'])->middleware('checkunit:UIPUR'); // Route khusus admin untuk edit
Route::patch('/uipurldp/backdateStore', [UipurController::Class, 'uipurldpBackdateStore'])->middleware('checkunit:UIPUR'); // Route untuk simpan hasil edit admin
// Route untuk TV01 UIPUR
Route::get('/uipurtv01', [UipurController::Class, 'uipurtv01'])->name('uipurtv01')->middleware('checkunit:UIPUR');
Route::get('/uipurtv01ambil', [UipurController::Class, 'tv01Ambil'])->name('uipurtv01.ambil')->middleware('checkunit:UIPUR');
Route::post('/uipurtv01/simpan', [UipurController::Class, 'tv01Simpan'])->name('uipurtv01.simpan')->middleware('checkunit:UIPUR');
Route::delete('/uipurtv01/hapus/{show}', [UipurController::Class, 'tv01Hapus'])->middleware('checkunit:UIPUR');
Route::get('/uipurtv01/ubah/{show}', [UipurController::Class, 'tv01Ubah'])->middleware('checkunit:UIPUR');
Route::patch('/uipurtv01/update', [UipurController::Class, 'tv01Update'])->middleware('checkunit:UIPUR');
Route::get('/uipurtv01/edit/{show}', [UipurController::Class, 'tv01Edit'])->middleware('checkunit:UIPUR'); // Route khusus admin untuk edit
Route::patch('/uipurtv01/store', [UipurController::Class, 'tv01Store'])->middleware('checkunit:UIPUR'); // Route untuk simpan hasil edit admin
Route::get('/uipurtv01/backdate/{show}', [UipurController::Class, 'tv01Backdate'])->middleware('checkunit:UIPUR'); // Route khusus admin untuk edit
Route::patch('/uipurtv01/backdateStore', [UipurController::Class, 'tv01BackdateStore'])->middleware('checkunit:UIPUR'); // Route untuk simpan hasil edit admin

// Route untuk M02 KEKDA
Route::get('/m02kekdabiasa', [KekdaController::Class, 'm02kekdabiasa'])->name('m02kekdabiasa')->middleware('checkunit:KEKDA');
Route::get('/m02kekdabiasaambil', [KekdaController::Class, 'm02kekdabiasaAmbil'])->name('m02kekdabiasa.ambil')->middleware('checkunit:KEKDA');
Route::post('/m02kekdabiasa/simpan', [KekdaController::Class, 'm02kekdabiasaSimpan'])->name('m02kekdabiasa.simpan')->middleware('checkunit:KEKDA');
Route::delete('/m02kekdabiasa/hapus/{show}', [KekdaController::Class, 'm02kekdabiasaHapus'])->middleware('checkunit:KEKDA');
Route::get('/m02kekdabiasa/ubah/{show}', [KekdaController::Class, 'm02kekdabiasaUbah'])->middleware('checkunit:KEKDA');
Route::patch('/m02kekdabiasa/update', [KekdaController::Class, 'm02kekdabiasaUpdate'])->middleware('checkunit:KEKDA');
Route::get('/m02kekdabiasa/edit/{show}', [KekdaController::Class, 'm02kekdabiasaEdit'])->middleware('checkunit:KEKDA'); // Route khusus admin untuk edit
Route::patch('/m02kekdabiasa/store', [KekdaController::Class, 'm02kekdabiasaStore'])->middleware('checkunit:KEKDA'); // Route untuk simpan hasil edit admin
Route::get('/m02kekdabiasa/backdate/{show}', [KekdaController::Class, 'm02kekdabiasaBackdate'])->middleware('checkunit:KEKDA'); // Route khusus admin untuk edit
Route::patch('/m02kekdabiasa/backdateStore', [KekdaController::Class, 'm02kekdabiasaBackdateStore'])->middleware('checkunit:KEKDA'); // Route untuk simpan hasil edit admin
// Route untuk M02 rahasia
Route::get('/m02kekdarhs', [KekdaController::Class, 'm02kekdarhs'])->name('m02kekdarhs')->middleware('checklevel:manajer');
Route::get('/m02kekdaambil', [KekdaController::Class, 'm02kekdarhsAmbil'])->name('m02kekdarhs.ambil')->middleware('checklevel:manajer');
Route::post('/m02kekdarhs/simpan', [KekdaController::Class, 'm02kekdarhsSimpan'])->name('m02kekdarhs.simpan')->middleware('checklevel:manajer');
Route::delete('/m02kekdarhs/hapus/{show}', [KekdaController::Class, 'm02kekdarhsHapus'])->middleware('checklevel:manajer');
Route::get('/m02kekdarhs/ubah/{show}', [KekdaController::Class, 'm02kekdarhsUbah'])->middleware('checklevel:manajer');
Route::patch('/m02kekdarhs/update', [KekdaController::Class, 'm02kekdarhsUpdate'])->middleware('checklevel:manajer');
Route::get('/m02kekdarhs/edit/{show}', [KekdaController::Class, 'm02kekdarhsEdit'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02kekdarhs/store', [KekdaController::Class, 'm02kekdarhsStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin
Route::get('/m02kekdarhs/backdate/{show}', [KekdaController::Class, 'm02kekdarhsBackdate'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02kekdarhs/backdateStore', [KekdaController::Class, 'm02kekdarhsBackdateStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin


// Route untuk LDP UIPUR
Route::get('/kekdaldp', [KekdaController::Class, 'kekdaldp'])->name('kekdaldp')->middleware('checkunit:KEKDA');
Route::get('/kekdaambil', [KekdaController::Class, 'kekdaldpAmbil'])->name('kekdaldp.ambil')->middleware('checkunit:KEKDA');
Route::post('/kekdaldp/simpan', [KekdaController::Class, 'kekdaldpSimpan'])->name('kekdaldp.simpan')->middleware('checkunit:KEKDA');
Route::delete('/kekdaldp/hapus/{show}', [KekdaController::Class, 'kekdaldpHapus'])->middleware('checkunit:KEKDA');
Route::get('/kekdaldp/ubah/{show}', [KekdaController::Class, 'kekdaldpUbah'])->middleware('checkunit:KEKDA');
Route::patch('/kekdaldp/update', [KekdaController::Class, 'kekdaldpUpdate'])->middleware('checkunit:KEKDA');
Route::get('/kekdaldp/edit/{show}', [KekdaController::Class, 'kekdaldpEdit'])->middleware('checkunit:KEKDA'); // Route khusus admin untuk edit
Route::patch('/kekdaldp/store', [KekdaController::Class, 'kekdaldpStore'])->middleware('checkunit:KEKDA'); // Route untuk simpan hasil edit admin
Route::get('/kekdaldp/backdate/{show}', [KekdaController::Class, 'kekdaldpBackdate'])->middleware('checkunit:KEKDA'); // Route khusus admin untuk edit
Route::patch('/kekdaldp/backdateStore', [KekdaController::Class, 'kekdaldpBackdateStore'])->middleware('checkunit:KEKDA'); // Route untuk simpan hasil edit admin
// Route untuk TV01 UIPUR
Route::get('/kekdatv01', [KekdaController::Class, 'kekdatv01'])->name('kekdatv01')->middleware('checkunit:KEKDA');
Route::get('/kekdatv01ambil', [KekdaController::Class, 'tv01Ambil'])->name('kekdatv01.ambil')->middleware('checkunit:KEKDA');
Route::post('/kekdatv01/simpan', [KekdaController::Class, 'tv01Simpan'])->name('kekdatv01.simpan')->middleware('checkunit:KEKDA');
Route::delete('/kekdatv01/hapus/{show}', [KekdaController::Class, 'tv01Hapus'])->middleware('checkunit:KEKDA');
Route::get('/kekdatv01/ubah/{show}', [KekdaController::Class, 'tv01Ubah'])->middleware('checkunit:KEKDA');
Route::patch('/kekdatv01/update', [KekdaController::Class, 'tv01Update'])->middleware('checkunit:KEKDA');
Route::get('/kekdatv01/edit/{show}', [KekdaController::Class, 'tv01Edit'])->middleware('checkunit:KEKDA'); // Route khusus admin untuk edit
Route::patch('/kekdatv01/store', [KekdaController::Class, 'tv01Store'])->middleware('checkunit:KEKDA'); // Route untuk simpan hasil edit admin
Route::get('/kekdatv01/backdate/{show}', [KekdaController::Class, 'tv01Backdate'])->middleware('checkunit:KEKDA'); // Route khusus admin untuk edit
Route::patch('/kekdatv01/backdateStore', [KekdaController::Class, 'tv01BackdateStore'])->middleware('checkunit:KEKDA'); // Route untuk simpan hasil edit admin



// Route untuk M02 uiksp
Route::get('/m02uikspbiasa', [UikspController::Class, 'm02uikspbiasa'])->name('m02uikspbiasa')->middleware('checkunit:UIKSP');
Route::get('/m02uikspbiasaambil', [UikspController::Class, 'm02uikspbiasaAmbil'])->name('m02uikspbiasa.ambil')->middleware('checkunit:UIKSP');;
Route::post('/m02uikspbiasa/simpan', [UikspController::Class, 'm02uikspbiasaSimpan'])->name('m02uikspbiasa.simpan')->middleware('checkunit:UIKSP');;
Route::delete('/m02uikspbiasa/hapus/{show}', [UikspController::Class, 'm02uikspbiasaHapus'])->middleware('checkunit:UIKSP');;
Route::get('/m02uikspbiasa/ubah/{show}', [UikspController::Class, 'm02uikspbiasaUbah'])->middleware('checkunit:UIKSP');;
Route::patch('/m02uikspbiasa/update', [UikspController::Class, 'm02uikspbiasaUpdate'])->middleware('checkunit:UIKSP');;
Route::get('/m02uikspbiasa/edit/{show}', [UikspController::Class, 'm02uikspbiasaEdit'])->middleware('checkunit:UIKSP');; // Route khusus admin untuk edit
Route::patch('/m02uikspbiasa/store', [UikspController::Class, 'm02uikspbiasaStore'])->middleware('checkunit:UIKSP');; // Route untuk simpan hasil edit admin
Route::get('/m02uikspbiasa/backdate/{show}', [UikspController::Class, 'm02uikspbiasaBackdate'])->middleware('checkunit:UIKSP');; // Route khusus admin untuk edit
Route::patch('/m02uikspbiasa/backdateStore', [UikspController::Class, 'm02uikspbiasaBackdateStore'])->middleware('checkunit:UIKSP');; // Route untuk simpan hasil edit admin
// Route untuk M02 rahasia
Route::get('/m02uiksprhs', [UikspController::Class, 'm02uiksprhs'])->name('m02uiksprhs')->middleware('checklevel:manajer');
Route::get('/m02uikspambil', [UikspController::Class, 'm02uiksprhsAmbil'])->name('m02uiksprhs.ambil')->middleware('checklevel:manajer');
Route::post('/m02uiksprhs/simpan', [UikspController::Class, 'm02uiksprhsSimpan'])->name('m02uiksprhs.simpan')->middleware('checklevel:manajer');
Route::delete('/m02uiksprhs/hapus/{show}', [UikspController::Class, 'm02uiksprhsHapus'])->middleware('checklevel:manajer');
Route::get('/m02uiksprhs/ubah/{show}', [UikspController::Class, 'm02uiksprhsUbah'])->middleware('checklevel:manajer');
Route::patch('/m02uiksprhs/update', [UikspController::Class, 'm02uiksprhsUpdate'])->middleware('checklevel:manajer');
Route::get('/m02uiksprhs/edit/{show}', [UikspController::Class, 'm02uiksprhsEdit'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02uiksprhs/store', [UikspController::Class, 'm02uiksprhsStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin
Route::get('/m02uiksprhs/backdate/{show}', [UikspController::Class, 'm02uiksprhsBackdate'])->middleware('checklevel:manajer'); // Route khusus admin untuk edit
Route::patch('/m02uiksprhs/backdateStore', [UikspController::Class, 'm02uiksprhsBackdateStore'])->middleware('checklevel:manajer'); // Route untuk simpan hasil edit admin


// Route untuk LDP UIPUR
Route::get('/uikspldp', [UikspController::Class, 'uikspldp'])->name('uikspldp')->middleware('checkunit:UIKSP');;
Route::get('/uikspambil', [UikspController::Class, 'uikspldpAmbil'])->name('uikspldp.ambil')->middleware('checkunit:UIKSP');;
Route::post('/uikspldp/simpan', [UikspController::Class, 'uikspldpSimpan'])->name('uikspldp.simpan')->middleware('checkunit:UIKSP');;
Route::delete('/uikspldp/hapus/{show}', [UikspController::Class, 'uikspldpHapus'])->middleware('checkunit:UIKSP');;
Route::get('/uikspldp/ubah/{show}', [UikspController::Class, 'uikspldpUbah'])->middleware('checkunit:UIKSP');;
Route::patch('/uikspldp/update', [UikspController::Class, 'uikspldpUpdate'])->middleware('checkunit:UIKSP');;
Route::get('/uikspldp/edit/{show}', [UikspController::Class, 'uikspldpEdit'])->middleware('checkunit:UIKSP');; // Route khusus admin untuk edit
Route::patch('/uikspldp/store', [UikspController::Class, 'uikspldpStore'])->middleware('checkunit:UIKSP');; // Route untuk simpan hasil edit admin
Route::get('/uikspldp/backdate/{show}', [UikspController::Class, 'uikspldpBackdate'])->middleware('checkunit:UIKSP');; // Route khusus admin untuk edit
Route::patch('/uikspldp/backdateStore', [UikspController::Class, 'uikspldpBackdateStore'])->middleware('checkunit:UIKSP');; // Route untuk simpan hasil edit admin
// Route untuk TV01 UIPUR
Route::get('/uiksptv01', [UikspController::Class, 'uiksptv01'])->name('uiksptv01')->middleware('checkunit:UIKSP');;
Route::get('/uiksptv01ambil', [UikspController::Class, 'tv01Ambil'])->name('uiksptv01.ambil')->middleware('checkunit:UIKSP');;
Route::post('/uiksptv01/simpan', [UikspController::Class, 'tv01Simpan'])->name('uiksptv01.simpan')->middleware('checkunit:UIKSP');;
Route::delete('/uiksptv01/hapus/{show}', [UikspController::Class, 'tv01Hapus'])->middleware('checkunit:UIKSP');;
Route::get('/uiksptv01/ubah/{show}', [UikspController::Class, 'tv01Ubah'])->middleware('checkunit:UIKSP');;
Route::patch('/uiksptv01/update', [UikspController::Class, 'tv01Update'])->middleware('checkunit:UIKSP');;
Route::get('/uiksptv01/edit/{show}', [UikspController::Class, 'tv01Edit'])->middleware('checkunit:UIKSP');; // Route khusus admin untuk edit
Route::patch('/uiksptv01/store', [UikspController::Class, 'tv01Store'])->middleware('checkunit:UIKSP');; // Route untuk simpan hasil edit admin
Route::get('/uiksptv01/backdate/{show}', [UikspController::Class, 'tv01Backdate'])->middleware('checkunit:UIKSP');; // Route khusus admin untuk edit
Route::patch('/uiksptv01/backdateStore', [UikspController::Class, 'tv01BackdateStore'])->middleware('checkunit:UIKSP');; // Route untuk simpan hasil edit admin

// Route untuk Siaran Pers
Route::get('/siaran', [SiaranController::Class, 'siaran'])->name('siaran');
Route::get('/siaranambil', [SiaranController::Class, 'siaranAmbil'])->name('siaran.ambil');
Route::post('/siaran/simpan', [SiaranController::Class, 'siaranSimpan'])->name('siaran.simpan');
Route::delete('/siaran/hapus/{show}', [SiaranController::Class, 'siaranHapus']);
Route::get('/siaran/ubah/{show}', [SiaranController::Class, 'siaranUbah']);
Route::patch('/siaran/update', [SiaranController::Class, 'siaranUpdate']);
Route::get('/siaran/edit/{show}', [SiaranController::Class, 'siaranEdit']); // Route khusus admin untuk edit
Route::patch('/siaran/store', [SiaranController::Class, 'siaranStore']); // Route untuk simpan hasil edit admin
Route::get('/siaran/backdate/{show}', [SiaranController::Class, 'siaranBackdate']); // Route khusus admin untuk edit
Route::patch('/siaran/backdateStore', [SiaranController::Class, 'siaranBackdateStore']); // Route untuk simpan hasil edit admin



}); // menutup middleware group


Route::get('kendaraan/detail/{show}', [KendaraanController::class, 'detail']);
Route::get('/kendaraan/edit/{show}', [KendaraanController::class, 'edit']);
Route::patch('/kendaraan/update', [KendaraanController::class, 'update']);
Route::resource('kendaraan', KendaraanController::class);
Route::delete('/kendaraan/hapus/{show}', [KendaraanController::Class, 'kendaraanHapus']);

Route::resource('pemeliharaan', PemeliharaanController::class);
Route::delete('/pemeliharaan/hapus/{show}', [PemeliharaanController::Class, 'pemeliharaanHapus']);



require __DIR__.'/auth.php';
