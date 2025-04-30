<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\File;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect()->route('login'); 
});

Route::get('/dashboard', function () {
    $totalFiles = File::count();
    $totalOffices = File::distinct('office')->count('office'); // Count unique offices
    $filesPerOffice = File::select('office', DB::raw('COUNT(*) as count'))
        ->groupBy('office')
        ->get();

    return view('dashboard', compact('totalFiles', 'totalOffices', 'filesPerOffice'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // File Routes
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::get('/files/office', [FileController::class, 'office'])->name('files.office');
    Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::get('/files/download/{id}', [FileController::class, 'download'])->name('files.download');
    Route::delete('/files/delete/{id}', [FileController::class, 'destroy'])->name('files.delete');
    Route::put('/files/update/{file}', [FileController::class, 'update'])->name('files.update');

    
    // Route::get('/files/view/{filename}', function ($filename) {
    //     $path = storage_path('app/public/files/' . $filename);
    
    //     if (!file_exists($path)) {
    //         abort(404);
    //     }
    
    //     return Response::file($path);
    // })->name('files.view');
    
 
});



require __DIR__.'/auth.php';
