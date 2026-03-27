<?php

use App\Http\Controllers\Produksi\AlatSupportController;
use App\Http\Controllers\Produksi\BBCatatanPengawasController;
use App\Http\Controllers\Produksi\BBLoadingPointController;
use App\Http\Controllers\Produksi\BBUnitSupportController;
use App\Http\Controllers\Produksi\CatatanPengawasController;
use App\Http\Controllers\Produksi\FormPengawasBatuBaraController;
use App\Http\Controllers\Produksi\FormPengawasController;
use App\Http\Controllers\Produksi\FormPengawasNewController;
use App\Http\Controllers\Produksi\FormPengawasSAPController;
use App\Http\Controllers\Produksi\FrontLoadingController;
use App\Http\Controllers\Produksi\JobPendingController;
use App\Http\Controllers\Produksi\KKHController;
use App\Http\Controllers\Produksi\KLKHBatuBaraController;
use App\Http\Controllers\Produksi\KLKHDisposalController;
use App\Http\Controllers\Produksi\KLKHHaulRoadController;
use App\Http\Controllers\Produksi\KLKHLoadingPointController;
use App\Http\Controllers\Produksi\KLKHLumpurController;
use App\Http\Controllers\Produksi\KLKHOGSController;
use App\Http\Controllers\Produksi\KLKHSimpangEmpatController;
use App\Http\Controllers\Produksi\LaporanKataSandiController;
use App\Http\Controllers\Produksi\MonitoringLaporanKerjaKLKHController;
use App\Http\Controllers\Produksi\MonitoringPayloadController;
use App\Http\Controllers\Produksi\P2HController;
use App\Http\Controllers\Produksi\PayloadRitationController;
use App\Http\Controllers\Produksi\PengawasPitstopController;
use App\Http\Controllers\Produksi\PengawasProduksiPitstopController;
use App\Http\Controllers\Produksi\ProductionController;
use App\Http\Controllers\Produksi\RosterKerjaController;
use App\Http\Controllers\Produksi\SOPProduksiController;
use App\Http\Controllers\Produksi\VerifikasiKLKHController;

use App\Http\Controllers\Engineering\StagingPlanController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HazardReportController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MappingRouteController;
use App\Http\Controllers\OprAssigntmentController;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Produksi\JobPendingProduksiController;
use App\Http\Controllers\Produksi\RosterKerjaProduksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\Safety\ERTController;
use App\Http\Controllers\Safety\PatrolController;
use App\Http\Controllers\Safety\InspeksiDisposalController;
use App\Http\Controllers\Safety\InspeksiJalanTambangController;
use App\Http\Controllers\Safety\InspeksiOGSController;
use App\Http\Controllers\Safety\InspeksiSlurryPumpController;
use App\Http\Controllers\Safety\InspeksiFrontLoadingController;
use App\Http\Controllers\Safety\InspeksiWorkshopController;
use App\Http\Controllers\Safety\InspeksiWorksopController;
use App\Http\Controllers\Safety\JobPendingSafetyController;
use App\Http\Controllers\Safety\RosterKerjaSafetyController;
use App\Http\Controllers\Safety\SOPSafetyController;
use App\Http\Controllers\SAPController;
use App\Http\Controllers\SOPController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifiedController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\isAdmin;
use App\Models\SOP;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Models\StagingPlan;
use Illuminate\Support\Facades\Http;


// Route::get('/dashboards/index', function () {
//     return redirect('/');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout-session', [AuthController::class,'logout_session'])->name('session.logout');

//Payload & Ritation API
Route::get('/payloadritation/api', [PayloadRitationController::class, 'api'])->name('payloadritation.api');

//Operator Assignment
Route::get('/OprAssignment/B1', [OprAssigntmentController::class, 'b1'])->name('opr.b1');
Route::get('/OprAssignment/B1/api', [OprAssigntmentController::class, 'b1_api'])->name('opr.b1.api');
Route::get('/OprAssignment/B2', [OprAssigntmentController::class, 'b2'])->name('opr.b2');
Route::get('/OprAssignment/B2/api', [OprAssigntmentController::class, 'b2_api'])->name('opr.b2.api');
Route::get('/OprAssignment/A3', [OprAssigntmentController::class, 'a3'])->name('opr.a3');
Route::get('/OprAssignment/A3/api', [OprAssigntmentController::class, 'a3_api'])->name('opr.a3.api');


Route::group(['middleware' => ['auth']], function(){
    //dashboard
    // Route::get('/dashboards/index', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::get('/operator/{nik}', [FormPengawasController::class, 'getOperatorByNIK']);

    Route::get('/production/index', [ProductionController::class, 'index'])->name('production.index')->middleware('canAccess');
    Route::get('/production/ex/index', [ProductionController::class, 'ex'])->name('production.ex')->middleware('canAccess');


    //Form Pengawas Baru
    Route::get('/form-pengawas-new/search-users', [FormPengawasNewController::class, 'users'])->name('cariUsers');
    Route::get('/form-pengawas-new/show', [FormPengawasNewController::class, 'show'])->name('form-pengawas-new.show');
    Route::get('/form-pengawas-new/index', [FormPengawasNewController::class, 'index'])->name('form-pengawas-new.index')->middleware('canAccess');
    Route::get('/form-pengawas-new/preview/{uuid}', [FormPengawasNewController::class, 'preview'])->name('form-pengawas-new.preview');
    Route::post('/save-draft', [FormPengawasNewController::class, 'saveAsDraft'])->name('daily-report.saveAsDraft');
    Route::get('/form-pengawas-new/get-draft/{uuid}', [FormPengawasNewController::class, 'getDraft'])->name('get-draft');
    Route::get('/form-pengawas-new/post', [FormPengawasNewController::class, 'post'])->name('form-pengawas-new.post');
    Route::get('/form-pengawas-new/download/pdf/{uuid}', [FormPengawasNewController::class, 'pdf'])->name('form-pengawas-new.pdf');
    Route::get('/form-pengawas-new/download/{uuid}', [FormPengawasNewController::class, 'download'])->name('form-pengawas-new.download');
    Route::get('/form-pengawas-new/verified/all/{uuid}', [FormPengawasNewController::class, 'verifiedAll'])->name('form-pengawas-new.verified.all');
    Route::get('/form-pengawas-new/verified/foreman/{uuid}', [FormPengawasNewController::class, 'verifiedForeman'])->name('form-pengawas-new.verified.foreman');
    Route::get('/form-pengawas-new/verified/supervisor/{uuid}', [FormPengawasNewController::class, 'verifiedSupervisor'])->name('form-pengawas-new.verified.supervisor');
    Route::get('/form-pengawas-new/verified/superintendent/{uuid}', [FormPengawasNewController::class, 'verifiedSuperintendent'])->name('form-pengawas-new.verified.superintendent');
    Route::get('/form-pengawas-new/delete/{uuid}', [FormPengawasNewController::class, 'delete'])->name('form-pengawas-new.delete');
    Route::get('/form-pengawas-new/bundlepdf', [FormPengawasNewController::class, 'bundlepdf'])->name('form-pengawas-new.bundlepdf');

    //Form Pengawas Batu Bara
    Route::get('/form-pengawas-batubara/show', [FormPengawasBatuBaraController::class, 'show'])->name('form-pengawas-batubara.show');
    Route::get('/form-pengawas-batubara/index', [FormPengawasBatuBaraController::class, 'index'])->name('form-pengawas-batubara.index')->middleware('canAccess');
    Route::post('/form-pengawas-batubara/post', [FormPengawasBatuBaraController::class, 'post'])->name('form-pengawas-batubara.post');
    Route::post('/save-draft-form-pengawas-batubara', [FormPengawasBatuBaraController::class, 'saveAsDraft'])->name('form-pengawas-batubara.saveAsDraft');
    Route::get('/form-pengawas-batubara/preview/{uuid}', [FormPengawasBatuBaraController::class, 'preview'])->name('form-pengawas-batubara.preview');
    Route::get('/form-pengawas-batubara/delete/{uuid}', [FormPengawasBatuBaraController::class, 'delete'])->name('form-pengawas-batubara.delete');
    Route::get('/form-pengawas-batubara/verified/all/{uuid}', [FormPengawasBatuBaraController::class, 'verifiedAll'])->name('form-pengawas-batubara.verified.all');
    Route::get('/form-pengawas-batubara/verified/foreman/{uuid}', [FormPengawasBatuBaraController::class, 'verifiedForeman'])->name('form-pengawas-batubara.verified.foreman');
    Route::get('/form-pengawas-batubara/verified/supervisor/{uuid}', [FormPengawasBatuBaraController::class, 'verifiedSupervisor'])->name('form-pengawas-batubara.verified.supervisor');
    Route::get('/form-pengawas-batubara/verified/superintendent/{uuid}', [FormPengawasBatuBaraController::class, 'verifiedSuperintendent'])->name('form-pengawas-batubara.verified.superintendent');
    Route::get('/form-pengawas-batubara/download/pdf/{uuid}', [FormPengawasBatuBaraController::class, 'pdf'])->name('form-pengawas-batubara.pdf');
    Route::get('/form-pengawas-batubara/download/{uuid}', [FormPengawasBatuBaraController::class, 'download'])->name('form-pengawas-batubara.download');
    Route::get('/form-pengawas-batubara/bundlepdf', [FormPengawasBatuBaraController::class, 'bundlepdf'])->name('form-pengawas-batubara.bundlepdf');

    //Pengawas Produksi & Pitstop
    Route::get('/pengawas-produksi-pitstop', [PengawasProduksiPitstopController::class, 'index'])->name('pengawas-produksi-pitstop.index');

    //Form Pengawas Pitstop
    Route::get('/pengawas-pitstop/show', [PengawasPitstopController::class, 'show'])->name('pengawas-pitstop.show');
    Route::get('/pengawas-pitstop/operator', [PengawasPitstopController::class, 'operator'])->name('pengawas-pitstop.operator');
    Route::get('/pengawas-pitstop/operator/api', [PengawasPitstopController::class, 'operatorAPI'])->name('pengawas-pitstop.operatorAPI');
    Route::get('/pengawas-pitstop/index', [PengawasPitstopController::class, 'index'])->name('pengawas-pitstop.index')->middleware('canAccess');
    Route::post('/pengawas-pitstop/post', [PengawasPitstopController::class, 'post'])->name('pengawas-pitstop.post');
    Route::get('/pengawas-pitstop/excel', [PengawasPitstopController::class, 'excel'])->name('pengawas-pitstop.excel');
    Route::post('/save-draft-pengawas-pitstop', [PengawasPitstopController::class, 'saveAsDraft'])->name('pengawas-pitstop.saveAsDraft');
    Route::get('/pengawas-pitstop/preview/{uuid}', [PengawasPitstopController::class, 'preview'])->name('pengawas-pitstop.preview');
    Route::get('/pengawas-pitstop/delete/{uuid}', [PengawasPitstopController::class, 'delete'])->name('pengawas-pitstop.delete');
    Route::get('/pengawas-pitstop/verified/all/{uuid}', [PengawasPitstopController::class, 'verifiedAll'])->name('pengawas-pitstop.verified.all');
    Route::get('/pengawas-pitstop/verified/foreman/{uuid}', [PengawasPitstopController::class, 'verifiedForeman'])->name('pengawas-pitstop.verified.foreman');
    Route::get('/pengawas-pitstop/verified/supervisor/{uuid}', [PengawasPitstopController::class, 'verifiedSupervisor'])->name('pengawas-pitstop.verified.supervisor');
    Route::get('/pengawas-pitstop/verified/superintendent/{uuid}', [PengawasPitstopController::class, 'verifiedSuperintendent'])->name('pengawas-pitstop.verified.superintendent');
    Route::get('/pengawas-pitstop/cetak/{uuid}', [PengawasPitstopController::class, 'cetak'])->name('pengawas-pitstop.cetak');
    Route::get('/pengawas-pitstop/download/{uuid}', [PengawasPitstopController::class, 'download'])->name('pengawas-pitstop.download');
    Route::get('/pengawas-pitstop/bundlepdf', [PengawasPitstopController::class, 'bundlepdf'])->name('pengawas-pitstop.bundlepdf');
    Route::delete('/pengawas-pitstop/delete-pitstop/{id}', [PengawasPitstopController::class, 'destroyPitstop']);

    // Route::get('/form-pengawas-pitstop/show', [FormPengawasPitstopController::class, 'show'])->name('form-pengawas-pitstop.show');
    // Route::get('/form-pengawas-pitstop/insert', [FormPengawasPitstopController::class, 'insert'])->name('form-pengawas-pitstop.insert');
    // Route::post('/form-pengawas-pitstop/save-draft', [FormPengawasPitstopController::class, 'saveAsDraft'])->name('form-pengawas-pitstop.saveAsDraft');
    // Route::post('/form-pengawas-pitstop/save-finish', [FormPengawasPitstopController::class, 'saveAsFinish'])->name('form-pengawas-pitstop.saveAsFinish');



    //Form Pengawas SAP
    Route::get('/form-pengawas-sap/index', [FormPengawasSAPController::class, 'index'])->name('form-pengawas-sap.index');
    Route::post('/form-pengawas-sap/post', [FormPengawasSAPController::class, 'post'])->name('form-pengawas-sap.post');
    Route::get('/form-pengawas-sap/show', [FormPengawasSAPController::class, 'show'])->name('form-pengawas-sap.show');
    Route::get('/form-pengawas-sap/delete/{uuid}', [FormPengawasSAPController::class, 'delete'])->name('form-pengawas-sap.delete');
    Route::get('/form-pengawas-sap/rincian/{uuid}', [FormPengawasSAPController::class, 'rincian'])->name('form-pengawas-sap.rincian');
    Route::post('/form-pengawas-sap/update/{uuid}', [FormPengawasSAPController::class, 'update'])->name('form-pengawas-sap.update');

    //Hazard Report
    Route::get('/hazard-report/index', [HazardReportController::class, 'index'])->name('hazard-report.index')->middleware('canAccess');
    Route::get('/hazard-report/insert', [HazardReportController::class, 'insert'])->name('hazard-report.insert')->middleware('canAccess');
    Route::post('/hazard-report/post', [HazardReportController::class, 'post'])->name('hazard-report.post');
    Route::get('/hazard-report/review/{uuid}', [HazardReportController::class, 'review'])->name('hazard-report.review');
    Route::get('/hazard-report/delete/{uuid}', [HazardReportController::class, 'delete'])->name('hazard-report.delete');
    Route::post('/hazard-report/close', [HazardReportController::class, 'closeHazard'])->name('hazard-report.close');
    Route::post('/hazard-report/verifySCC', [HazardReportController::class, 'verifySCC'])->name('hazard-report.verify.scc');

    //Laporan Kata Sandi
    Route::get('/laporan-kata-sandi/index', [LaporanKataSandiController::class, 'index'])->name('laporan-kata-sandi.index');
    Route::post('/laporan-kata-sandi/post', [LaporanKataSandiController::class, 'post'])->name('laporan-kata-sandi.post');
    Route::get('/laporan-kata-sandi/show', [LaporanKataSandiController::class, 'show'])->name('laporan-kata-sandi.show');
    Route::get('/laporan-kata-sandi/delete/{uuid}', [LaporanKataSandiController::class, 'delete'])->name('laporan-kata-sandi.delete');
    Route::get('/laporan-kata-sandi/preview/{uuid}', [LaporanKataSandiController::class, 'preview'])->name('laporan-kata-sandi.preview');
    Route::get('/laporan-kata-sandi/cetak/{uuid}', [LaporanKataSandiController::class, 'cetak'])->name('laporan-kata-sandi.cetak');
    Route::get('/laporan-kata-sandi/pdf/{uuid}', [LaporanKataSandiController::class, 'pdf'])->name('laporan-kata-sandi.pdf');
    Route::get('/laporan-kata-sandi/jamMonitor', [LaporanKataSandiController::class, 'jamMonitor'])->name('laporan-kata-sandi.jamMonitor');

    //Form Laporan Safety ERT
    Route::get('/ert/show', [ERTController::class, 'show'])->name('ert.show')->middleware('canAccess');
    Route::get('/ert/index', [ERTController::class, 'index'])->name('ert.index')->middleware('canAccess');
    Route::post('/ert/post', [ERTController::class, 'post'])->name('ert.post');
    Route::post('/save-draft-ert', [ERTController::class, 'saveAsDraft'])->name('ert.saveAsDraft');
    Route::get('/ert/preview/{uuid}', [ERTController::class, 'preview'])->name('ert.preview');
    Route::get('/ert/delete/{uuid}', [ERTController::class, 'delete'])->name('ert.delete');
    Route::get('/ert/verified/petugas/{uuid}', [ERTController::class, 'verifiedPetugas'])->name('ert.verified.petugas');
    Route::get('/ert/verified/penerima/{uuid}', [ERTController::class, 'verifiedPenerima'])->name('ert.verified.penerima');
    Route::get('/ert/verified/superintendent/{uuid}', [ERTController::class, 'verifiedSuperintendent'])->name('ert.verified.superintendent');
    Route::get('/ert/download/pdf/{uuid}', [ERTController::class, 'pdf'])->name('ert.pdf');
    Route::get('/ert/download/{uuid}', [ERTController::class, 'download'])->name('ert.download');
    Route::get('/ert/bundlepdf', [ERTController::class, 'bundlepdf'])->name('ert.bundlepdf');
    Route::delete('/delete-ert-subKegiatan/{id}', [ERTController::class, 'destroySubKegiatan']);
    Route::delete('/delete-ert-temuanTindakLanjut/{id}', [ERTController::class, 'destroyTemuanTindakLanjut']);
    Route::delete('/delete-ert-jobPending/{id}', [ERTController::class, 'destroyJobPending']);

    //Form Laporan Safety Patrol
    Route::get('/patrol/show', [PatrolController::class, 'show'])->name('patrol.show')->middleware('canAccess');
    Route::get('/patrol/index', [PatrolController::class, 'index'])->name('patrol.index')->middleware('canAccess');
    Route::post('/patrol/post', [PatrolController::class, 'post'])->name('patrol.post');
    Route::post('/save-draft-patrol', [PatrolController::class, 'saveAsDraft'])->name('patrol.saveAsDraft');
    Route::get('/patrol/preview/{uuid}', [PatrolController::class, 'preview'])->name('patrol.preview');
    Route::get('/patrol/delete/{uuid}', [PatrolController::class, 'delete'])->name('patrol.delete');
    Route::get('/patrol/verified/petugas/{uuid}', [PatrolController::class, 'verifiedPetugas'])->name('patrol.verified.petugas');
    Route::get('/patrol/verified/penerima/{uuid}', [PatrolController::class, 'verifiedPenerima'])->name('patrol.verified.penerima');
    Route::get('/patrol/verified/superintendent/{uuid}', [PatrolController::class, 'verifiedSuperintendent'])->name('patrol.verified.superintendent');
    Route::get('/patrol/download/pdf/{uuid}', [PatrolController::class, 'pdf'])->name('patrol.pdf');
    Route::get('/patrol/download/{uuid}', [PatrolController::class, 'download'])->name('patrol.download');
    Route::get('/patrol/bundlepdf', [PatrolController::class, 'bundlepdf'])->name('patrol.bundlepdf');
    Route::delete('/delete-patrol-subKegiatan/{id}', [PatrolController::class, 'destroySubKegiatan']);
    Route::delete('/delete-patrol-temuanTindakLanjut/{id}', [PatrolController::class, 'destroyTemuanTindakLanjut']);
    Route::delete('/delete-patrol-jobPending/{id}', [PatrolController::class, 'destroyJobPending']);

    //Front Loading
    Route::get('/front-loading/index', [FrontLoadingController::class, 'index'])->name('front-loading.index');
    Route::get('/front-loading/export/excel', [FrontLoadingController::class, 'excel'])->name('front-loading.excel');
    Route::delete('/delete-front-loading/{uuid}', [FrontLoadingController::class, 'destroy'])->name('front-loading.destroy');

    //BB Loading Point
    Route::get('/batu-bara/loading-point/index', [BBLoadingPointController::class, 'index'])->name('bb.loading-point.index');
    Route::get('/batu-bara/loading-point/export/excel', [BBLoadingPointController::class, 'excel'])->name('bb.loading-point.excel');
    Route::delete('/batu-bara/delete-loading-point/{uuid}', [BBLoadingPointController::class, 'destroy'])->name('bb.loading-point.destroy');

    //Alat Support
    Route::get('/alat-support/index', [AlatSupportController::class, 'index'])->name('alat-support.index');
    Route::get('/alat-support/api', [AlatSupportController::class, 'api'])->name('alat-support.api');
    Route::get('/alat-support/excel', [AlatSupportController::class, 'excel'])->name('alat-support.excel');
    Route::post('/alat-support/update/{uuid}', [AlatSupportController::class, 'update'])->name('alat-support.update');
    Route::delete('/alat-support/{id}', [AlatSupportController::class, 'destroy']);
    Route::delete('/delete-support/{id}', [AlatSupportController::class, 'destroy']);

    //SOP
    Route::get('/sop/index', [SOPController::class, 'index'])->name('sop.index');
    Route::get('/sop/preview/{uuid}', [SOPController::class, 'preview'])->name('sop.preview');
    Route::get('/sop/{uuid}', function ($uuid) {

        $data = SOP::where('uuid', $uuid)
            ->where('statusenabled', true)
            ->firstOrFail();

        $pdfUrl = $data->url;

        $response = Http::withOptions([
            'verify' => false,
            'timeout' => 30,
        ])->get($pdfUrl);

        if (!$response->ok()) {
            abort(404);
        }

       $contentType = $response->header('Content-Type');
        return Response::make(
            $response->body(),
            200,
            [
                'Content-Type'         => $contentType,
                'Content-Disposition' => 'inline',
            ]
        );

    })->name('sop.show');


    Route::get('/files/{name}', function ($name) {
        $path = public_path('sop/' . $name);  // sesuaikan lokasi Anda
        abort_unless(File::exists($path), 404);
        return Response::file($path, ['Content-Type' => 'application/pdf']);
    })->where('name', '.*')->name('files.show');

    //BB Unit Support
    Route::get('/batu-bara/unit-support/index', [BBUnitSupportController::class, 'index'])->name('bb.unit-support.index');
    Route::get('/batu-bara/unit-support/api', [BBUnitSupportController::class, 'api'])->name('bb.unit-support.api');
    Route::get('/batu-bara/unit-support/excel', [BBUnitSupportController::class, 'excel'])->name('bb.unit-support.excel');
    Route::post('/batu-bara/unit-support/update/{uuid}', [BBUnitSupportController::class, 'update'])->name('bb.unit-support.update');
    Route::delete('/batu-bara/unit-support/{id}', [BBUnitSupportController::class, 'destroy']);
    Route::delete('/batu-bara/delete-support/{id}', [BBUnitSupportController::class, 'destroy']);

    //Catatan Pengawas
    Route::get('/catatan-pengawas/index', [CatatanPengawasController::class, 'index'])->name('catatan-pengawas.index');
    Route::delete('/delete/catatan-pengawas/{id}', [CatatanPengawasController::class, 'destroy'])->name('catatan-pengawas.destroy');

    //BB Catatan Pengawas
    Route::get('/batu-bara/catatan-pengawas/index', [BBCatatanPengawasController::class, 'index'])->name('bb.catatan-pengawas.index');
    Route::delete('/batu-bara/delete/catatan-pengawas/{id}', [BBCatatanPengawasController::class, 'destroy'])->name('bb.catatan-pengawas.destroy');

    //SAP
    Route::get('/sap/index', [SAPController::class, 'index'])->name('sap.index');
    Route::get('/sap/show', [SAPController::class, 'show'])->name('sap.show');

    //KLKH Loading Point
    Route::get('/klkh/loading-point', [KLKHLoadingPointController::class, 'index'])->name('klkh.loading-point');
    Route::get('/klkh/loading-point/insert', [KLKHLoadingPointController::class, 'insert'])->name('klkh.loading-point.insert')->middleware('canAccess');
    Route::post('/klkh/loading-point/post', [KLKHLoadingPointController::class, 'post'])->name('klkh.loading-point.post');
    Route::get('/klkh/loading-point/delete/{id}', [KLKHLoadingPointController::class, 'delete'])->name('klkh.loading-point.delete');
    Route::get('/klkh/loading-point/preview/{uuid}', [KLKHLoadingPointController::class, 'preview'])->name('klkh.loading-point.preview');
    Route::get('/klkh/loading-point/bundlepdf', [KLKHLoadingPointController::class, 'bundlepdf'])->name('klkh.loading-point.bundlepdf');
    Route::get('/klkh/loading-point/cetak/{uuid}', [KLKHLoadingPointController::class, 'cetak'])->name('klkh.loading-point.cetak');
    Route::get('/klkh/loading-point/download/{uuid}', [KLKHLoadingPointController::class, 'download'])->name('klkh.loading-point.download');
    Route::post('/klkh/loading-point/verified/all/{uuid}', [KLKHLoadingPointController::class, 'verifiedAll'])->name('klkh.loading-point.verified.all');
    Route::post('/klkh/loading-point/verified/foreman/{uuid}', [KLKHLoadingPointController::class, 'verifiedForeman'])->name('klkh.loading-point.verified.foreman');
    Route::post('/klkh/loading-point/verified/supervisor/{uuid}', [KLKHLoadingPointController::class, 'verifiedSupervisor'])->name('klkh.loading-point.verified.supervisor');
    Route::post('/klkh/loading-point/verified/superintendent/{uuid}', [KLKHLoadingPointController::class, 'verifiedSuperintendent'])->name('klkh.loading-point.verified.superintendent');

    //KLKH Haul Road
    Route::get('/klkh/haul-road', [KLKHHaulRoadController::class, 'index'])->name('klkh.haul-road');
    Route::get('/klkh/haul-road/insert', [KLKHHaulRoadController::class, 'insert'])->name('klkh.haul-road.insert')->middleware('canAccess');
    Route::post('/klkh/haul-road/post', [KLKHHaulRoadController::class, 'post'])->name('klkh.haul-road.post');
    Route::get('/klkh/haul-road/delete/{id}', [KLKHHaulRoadController::class, 'delete'])->name('klkh.haul-road.delete');
    Route::get('/klkh/haul-road/preview/{uuid}', [KLKHHaulRoadController::class, 'preview'])->name('klkh.haul-road.preview');
    Route::get('/klkh/haul-road/bundlepdf', [KLKHHaulRoadController::class, 'bundlepdf'])->name('klkh.haul-road.bundlepdf');
    Route::get('/klkh/haul-road/cetak/{uuid}', [KLKHHaulRoadController::class, 'cetak'])->name('klkh.haul-road.cetak');
    Route::get('/klkh/haul-road/download/{uuid}', [KLKHHaulRoadController::class, 'download'])->name('klkh.haul-road.download');
    Route::post('/klkh/haul-road/verified/all/{uuid}', [KLKHHaulRoadController::class, 'verifiedAll'])->name('klkh.haul-road.verified.all');
    Route::post('/klkh/haul-road/verified/foreman/{uuid}', [KLKHHaulRoadController::class, 'verifiedForeman'])->name('klkh.haul-road.verified.foreman');
    Route::post('/klkh/haul-road/verified/supervisor/{uuid}', [KLKHHaulRoadController::class, 'verifiedSupervisor'])->name('klkh.haul-road.verified.supervisor');
    Route::post('/klkh/haul-road/verified/superintendent/{uuid}', [KLKHHaulRoadController::class, 'verifiedSuperintendent'])->name('klkh.haul-road.verified.superintendent');

    //KLKH Disposal
    Route::get('/klkh/disposal', [KLKHDisposalController::class, 'index'])->name('klkh.disposal');
    Route::get('/klkh/disposal/insert', [KLKHDisposalController::class, 'insert'])->name('klkh.disposal.insert')->middleware('canAccess');
    Route::post('/klkh/disposal/post', [KLKHDisposalController::class, 'post'])->name('klkh.disposal.post');
    Route::get('/klkh/disposal/delete/{id}', [KLKHDisposalController::class, 'delete'])->name('klkh.disposal.delete');
    Route::get('/klkh/disposal/preview/{uuid}', [KLKHDisposalController::class, 'preview'])->name('klkh.disposal.preview');
    Route::get('/klkh/disposal/bundlepdf', [KLKHDisposalController::class, 'bundlepdf'])->name('klkh.disposal.bundlepdf');
    Route::get('/klkh/disposal/cetak/{uuid}', [KLKHDisposalController::class, 'cetak'])->name('klkh.disposal.cetak');
    Route::get('/klkh/disposal/download/{uuid}', [KLKHDisposalController::class, 'download'])->name('klkh.disposal.download');
    Route::post('/klkh/disposal/verified/all/{uuid}', [KLKHDisposalController::class, 'verifiedAll'])->name('klkh.disposal.verified.all');
    Route::post('/klkh/disposal/verified/foreman/{uuid}', [KLKHDisposalController::class, 'verifiedForeman'])->name('klkh.disposal.verified.foreman');
    Route::post('/klkh/disposal/verified/supervisor/{uuid}', [KLKHDisposalController::class, 'verifiedSupervisor'])->name('klkh.disposal.verified.supervisor');
    Route::post('/klkh/disposal/verified/superintendent/{uuid}', [KLKHDisposalController::class, 'verifiedSuperintendent'])->name('klkh.disposal.verified.superintendent');

    //KLKH Lumpur
    Route::get('/klkh/lumpur', [KLKHLumpurController::class, 'index'])->name('klkh.lumpur');
    Route::get('/klkh/lumpur/insert', [KLKHLumpurController::class, 'insert'])->name('klkh.lumpur.insert')->middleware('canAccess');
    Route::post('/klkh/lumpur/post', [KLKHLumpurController::class, 'post'])->name('klkh.lumpur.post');
    Route::get('/klkh/lumpur/delete/{id}', [KLKHLumpurController::class, 'delete'])->name('klkh.lumpur.delete');
    Route::get('/klkh/lumpur/preview/{uuid}', [KLKHLumpurController::class, 'preview'])->name('klkh.lumpur.preview');
    Route::get('/klkh/lumpur/bundlepdf', [KLKHLumpurController::class, 'bundlepdf'])->name('klkh.lumpur.bundlepdf');
    Route::get('/klkh/lumpur/cetak/{uuid}', [KLKHLumpurController::class, 'cetak'])->name('klkh.lumpur.cetak');
    Route::get('/klkh/lumpur/download/{uuid}', [KLKHLumpurController::class, 'download'])->name('klkh.lumpur.download');
    Route::post('/klkh/lumpur/verified/all/{uuid}', [KLKHLumpurController::class, 'verifiedAll'])->name('klkh.lumpur.verified.all');
    Route::post('/klkh/lumpur/verified/foreman/{uuid}', [KLKHLumpurController::class, 'verifiedForeman'])->name('klkh.lumpur.verified.foreman');
    Route::post('/klkh/lumpur/verified/supervisor/{uuid}', [KLKHLumpurController::class, 'verifiedSupervisor'])->name('klkh.lumpur.verified.supervisor');
    Route::post('/klkh/lumpur/verified/superintendent/{uuid}', [KLKHLumpurController::class, 'verifiedSuperintendent'])->name('klkh.lumpur.verified.superintendent');

    //KLKH OGS
    Route::get('/klkh/ogs', [KLKHOGSController::class, 'index'])->name('klkh.ogs');
    Route::get('/klkh/ogs/insert', [KLKHOGSController::class, 'insert'])->name('klkh.ogs.insert')->middleware('canAccess');
    Route::post('/klkh/ogs/post', [KLKHOGSController::class, 'post'])->name('klkh.ogs.post');
    Route::get('/klkh/ogs/delete/{id}', [KLKHOGSController::class, 'delete'])->name('klkh.ogs.delete');
    Route::get('/klkh/ogs/preview/{uuid}', [KLKHOGSController::class, 'preview'])->name('klkh.ogs.preview');
    Route::get('/klkh/ogs/bundlepdf', [KLKHOGSController::class, 'bundlepdf'])->name('klkh.ogs.bundlepdf');
    Route::get('/klkh/ogs/cetak/{uuid}', [KLKHOGSController::class, 'cetak'])->name('klkh.ogs.cetak');
    Route::get('/klkh/ogs/download/{uuid}', [KLKHOGSController::class, 'download'])->name('klkh.ogs.download');
    Route::post('/klkh/ogs/verified/all/{uuid}', [KLKHOGSController::class, 'verifiedAll'])->name('klkh.ogs.verified.all');
    Route::post('/klkh/ogs/verified/foreman/{uuid}', [KLKHOGSController::class, 'verifiedForeman'])->name('klkh.ogs.verified.foreman');
    Route::post('/klkh/ogs/verified/supervisor/{uuid}', [KLKHOGSController::class, 'verifiedSupervisor'])->name('klkh.ogs.verified.supervisor');
    Route::post('/klkh/ogs/verified/superintendent/{uuid}', [KLKHOGSController::class, 'verifiedSuperintendent'])->name('klkh.ogs.verified.superintendent');

    //KLKH Batu Bara
    Route::get('/klkh/batubara', [KLKHBatuBaraController::class, 'index'])->name('klkh.batubara');
    Route::get('/klkh/batubara/insert', [KLKHBatuBaraController::class, 'insert'])->name('klkh.batubara.insert')->middleware('canAccess');
    Route::post('/klkh/batubara/post', [KLKHBatuBaraController::class, 'post'])->name('klkh.batubara.post');
    Route::get('/klkh/batubara/delete/{id}', [KLKHBatuBaraController::class, 'delete'])->name('klkh.batubara.delete');
    Route::get('/klkh/batubara/preview/{uuid}', [KLKHBatuBaraController::class, 'preview'])->name('klkh.batubara.preview');
    Route::get('/klkh/batubara/bundlepdf', [KLKHBatuBaraController::class, 'bundlepdf'])->name('klkh.batubara.bundlepdf');
    Route::get('/klkh/batubara/cetak/{uuid}', [KLKHBatuBaraController::class, 'cetak'])->name('klkh.batubara.cetak');
    Route::get('/klkh/batubara/download/{uuid}', [KLKHBatuBaraController::class, 'download'])->name('klkh.batubara.download');
    Route::post('/klkh/batubara/verified/all/{uuid}', [KLKHBatuBaraController::class, 'verifiedAll'])->name('klkh.batubara.verified.all');
    Route::post('/klkh/batubara/verified/foreman/{uuid}', [KLKHBatuBaraController::class, 'verifiedForeman'])->name('klkh.batubara.verified.foreman');
    Route::post('/klkh/batubara/verified/supervisor/{uuid}', [KLKHBatuBaraController::class, 'verifiedSupervisor'])->name('klkh.batubara.verified.supervisor');
    Route::post('/klkh/batubara/verified/superintendent/{uuid}', [KLKHBatuBaraController::class, 'verifiedSuperintendent'])->name('klkh.batubara.verified.superintendent');

    //KLKH Simpang Empat
    Route::get('/klkh/simpangempat', [KLKHSimpangEmpatController::class, 'index'])->name('klkh.simpangempat');
    Route::get('/klkh/simpangempat/insert', [KLKHSimpangEmpatController::class, 'insert'])->name('klkh.simpangempat.insert')->middleware('canAccess');
    Route::post('/klkh/simpangempat/post', [KLKHSimpangEmpatController::class, 'post'])->name('klkh.simpangempat.post');
    Route::get('/klkh/simpangempat/delete/{id}', [KLKHSimpangEmpatController::class, 'delete'])->name('klkh.simpangempat.delete');
    Route::get('/klkh/simpangempat/preview/{uuid}', [KLKHSimpangEmpatController::class, 'preview'])->name('klkh.simpangempat.preview');
    Route::get('/klkh/simpangempat/bundlepdf', [KLKHSimpangEmpatController::class, 'bundlepdf'])->name('klkh.simpangempat.bundlepdf');
    Route::get('/klkh/simpangempat/cetak/{uuid}', [KLKHSimpangEmpatController::class, 'cetak'])->name('klkh.simpangempat.cetak');
    Route::get('/klkh/simpangempat/download/{uuid}', [KLKHSimpangEmpatController::class, 'download'])->name('klkh.simpangempat.download');
    Route::post('/klkh/simpangempat/verified/all/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedAll'])->name('klkh.simpangempat.verified.all');
    Route::post('/klkh/simpangempat/verified/foreman/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedForeman'])->name('klkh.simpangempat.verified.foreman');
    Route::post('/klkh/simpangempat/verified/supervisor/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedSupervisor'])->name('klkh.simpangempat.verified.supervisor');
    Route::post('/klkh/simpangempat/verified/superintendent/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedSuperintendent'])->name('klkh.simpangempat.verified.superintendent');

    //Inspeksi Tambang - Jalan Tambang
    Route::get('/inspeksi/jalantambang', [InspeksiJalanTambangController::class, 'index'])->name('inspeksi.jalantambang');
    Route::get('/inspeksi/jalantambang/insert', [InspeksiJalanTambangController::class, 'insert'])->name('inspeksi.jalantambang.insert')->middleware('canAccess');
    Route::post('/inspeksi/jalantambang/post', [InspeksiJalanTambangController::class, 'post'])->name('inspeksi.jalantambang.post');
    Route::get('/inspeksi/jalantambang/delete/{id}', [InspeksiJalanTambangController::class, 'delete'])->name('inspeksi.jalantambang.delete');
    Route::get('/inspeksi/jalantambang/preview/{uuid}', [InspeksiJalanTambangController::class, 'preview'])->name('inspeksi.jalantambang.preview');
    Route::get('/inspeksi/jalantambang/bundlepdf', [InspeksiJalanTambangController::class, 'bundlepdf'])->name('inspeksi.jalantambang.bundlepdf');
    Route::get('/inspeksi/jalantambang/cetak/{uuid}', [InspeksiJalanTambangController::class, 'cetak'])->name('inspeksi.jalantambang.cetak');
    Route::get('/inspeksi/jalantambang/download/{uuid}', [InspeksiJalanTambangController::class, 'download'])->name('inspeksi.jalantambang.download');

    //Inspeksi Tambang - Disposal
    Route::get('/inspeksi/disposal', [InspeksiDisposalController::class, 'index'])->name('inspeksi.disposal');
    Route::get('/inspeksi/disposal/insert', [InspeksiDisposalController::class, 'insert'])->name('inspeksi.disposal.insert')->middleware('canAccess');
    Route::post('/inspeksi/disposal/post', [InspeksiDisposalController::class, 'post'])->name('inspeksi.disposal.post');
    Route::get('/inspeksi/disposal/delete/{id}', [InspeksiDisposalController::class, 'delete'])->name('inspeksi.disposal.delete');
    Route::get('/inspeksi/disposal/preview/{uuid}', [InspeksiDisposalController::class, 'preview'])->name('inspeksi.disposal.preview');
    Route::get('/inspeksi/disposal/bundlepdf', [InspeksiDisposalController::class, 'bundlepdf'])->name('inspeksi.disposal.bundlepdf');
    Route::get('/inspeksi/disposal/cetak/{uuid}', [InspeksiDisposalController::class, 'cetak'])->name('inspeksi.disposal.cetak');
    Route::get('/inspeksi/disposal/download/{uuid}', [InspeksiDisposalController::class, 'download'])->name('inspeksi.disposal.download');

    //Inspeksi Tambang - OGS
    Route::get('/inspeksi/ogs', [InspeksiOGSController::class, 'index'])->name('inspeksi.ogs');
    Route::get('/inspeksi/ogs/insert', [InspeksiOGSController::class, 'insert'])->name('inspeksi.ogs.insert')->middleware('canAccess');
    Route::post('/inspeksi/ogs/post', [InspeksiOGSController::class, 'post'])->name('inspeksi.ogs.post');
    Route::get('/inspeksi/ogs/delete/{id}', [InspeksiOGSController::class, 'delete'])->name('inspeksi.ogs.delete');
    Route::get('/inspeksi/ogs/preview/{uuid}', [InspeksiOGSController::class, 'preview'])->name('inspeksi.ogs.preview');
    Route::get('/inspeksi/ogs/bundlepdf', [InspeksiOGSController::class, 'bundlepdf'])->name('inspeksi.ogs.bundlepdf');
    Route::get('/inspeksi/ogs/cetak/{uuid}', [InspeksiOGSController::class, 'cetak'])->name('inspeksi.ogs.cetak');
    Route::get('/inspeksi/ogs/download/{uuid}', [InspeksiOGSController::class, 'download'])->name('inspeksi.ogs.download');

    //Inspeksi Slurry Pump
    Route::get('/inspeksi/slurrypump', [InspeksiSlurryPumpController::class, 'index'])->name('inspeksi.slurrypump');
    Route::get('/inspeksi/slurrypump/insert', [InspeksiSlurryPumpController::class, 'insert'])->name('inspeksi.slurrypump.insert')->middleware('canAccess');
    Route::post('/inspeksi/slurrypump/post', [InspeksiSlurryPumpController::class, 'post'])->name('inspeksi.slurrypump.post');
    Route::get('/inspeksi/slurrypump/delete/{id}', [InspeksiSlurryPumpController::class, 'delete'])->name('inspeksi.slurrypump.delete');
    Route::get('/inspeksi/slurrypump/preview/{uuid}', [InspeksiSlurryPumpController::class, 'preview'])->name('inspeksi.slurrypump.preview');
    Route::get('/inspeksi/slurrypump/bundlepdf', [InspeksiSlurryPumpController::class, 'bundlepdf'])->name('inspeksi.slurrypump.bundlepdf');
    Route::get('/inspeksi/slurrypump/cetak/{uuid}', [InspeksiSlurryPumpController::class, 'cetak'])->name('inspeksi.slurrypump.cetak');
    Route::get('/inspeksi/slurrypump/download/{uuid}', [InspeksiSlurryPumpController::class, 'download'])->name('inspeksi.slurrypump.download');

    //Inspeksi Tambang - Front Loading
    Route::get('/inspeksi/frontloading', [InspeksiFrontLoadingController::class, 'index'])->name('inspeksi.frontloading');
    Route::get('/inspeksi/frontloading/insert', [InspeksiFrontLoadingController::class, 'insert'])->name('inspeksi.frontloading.insert')->middleware('canAccess');
    Route::post('/inspeksi/frontloading/post', [InspeksiFrontLoadingController::class, 'post'])->name('inspeksi.frontloading.post');
    Route::get('/inspeksi/frontloading/delete/{id}', [InspeksiFrontLoadingController::class, 'delete'])->name('inspeksi.frontloading.delete');
    Route::get('/inspeksi/frontloading/preview/{uuid}', [InspeksiFrontLoadingController::class, 'preview'])->name('inspeksi.frontloading.preview');
    Route::get('/inspeksi/frontloading/bundlepdf', [InspeksiFrontLoadingController::class, 'bundlepdf'])->name('inspeksi.frontloading.bundlepdf');
    Route::get('/inspeksi/frontloading/cetak/{uuid}', [InspeksiFrontLoadingController::class, 'cetak'])->name('inspeksi.frontloading.cetak');
    Route::get('/inspeksi/frontloading/download/{uuid}', [InspeksiFrontLoadingController::class, 'download'])->name('inspeksi.frontloading.download');

    //Inspeksi Workshop
    Route::get('/inspeksi/workshop', [InspeksiWorkshopController::class, 'index'])->name('inspeksi.workshop');
    Route::get('/inspeksi/workshop/insert', [InspeksiWorkshopController::class, 'insert'])->name('inspeksi.workshop.insert')->middleware('canAccess');
    Route::post('/inspeksi/workshop/post', [InspeksiWorkshopController::class, 'post'])->name('inspeksi.workshop.post');
    Route::get('/inspeksi/workshop/delete/{id}', [InspeksiWorkshopController::class, 'delete'])->name('inspeksi.workshop.delete');
    Route::get('/inspeksi/workshop/preview/{uuid}', [InspeksiWorkshopController::class, 'preview'])->name('inspeksi.workshop.preview');
    Route::get('/inspeksi/workshop/bundlepdf', [InspeksiWorkshopController::class, 'bundlepdf'])->name('inspeksi.workshop.bundlepdf');
    Route::get('/inspeksi/workshop/cetak/{uuid}', [InspeksiWorkshopController::class, 'cetak'])->name('inspeksi.workshop.cetak');
    Route::get('/inspeksi/workshop/download/{uuid}', [InspeksiWorkshopController::class, 'download'])->name('inspeksi.workshop.download');

    //Paylaod & Ritation
    Route::get('/payloadritation/all', [PayloadRitationController::class, 'index'])->name('payloadritation.index');
    Route::get('/payloadritation/exa', [PayloadRitationController::class, 'exa_new'])->name('payloadritation.exa');

    // Profile
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    //Verifikasi Semua KLKH
    Route::get('/verifikasi/klkh', [VerifikasiKLKHController::class, 'index'])->name('verifikasi.klkh');
    Route::get('/verifikasi/klkh/preview/{uuid}', [VerifikasiKLKHController::class, 'preview'])->name('verifikasi.klkh.preview');
    Route::get('/verifikasi/klkh/all', [VerifikasiKLKHController::class, 'all'])->name('verifikasi.klkh.all');


    //Monitoring Laporan Kerja & KLKH
    Route::get('/monitoring-laporan-kerja-klkh', [MonitoringLaporanKerjaKLKHController::class, 'index'])->name('monitoringlaporankerjaklkh');

    //Roster Kerja Produksi
    Route::get('/roster-kerja/produksi', [RosterKerjaProduksiController::class, 'index'])->name('rosterkerja.produksi');
    Route::post('/roster-kerja/produksi/import', [RosterKerjaProduksiController::class, 'import'])->name('rosterkerja.produksi.import');
    Route::get('/roster-kerja/produksi/export', [RosterKerjaProduksiController::class, 'export'])->name('rosterkerja.produksi.export');
    Route::get('/roster-kerja/produksi/templateExcel', [RosterKerjaProduksiController::class, 'templateExcel'])->name('rosterkerja.produksi.templateExcel');

    //Roster Kerja Safety
    Route::get('/roster-kerja/safety', [RosterKerjaSafetyController::class, 'index'])->name('rosterkerja.safety');
    Route::post('/roster-kerja/safety/import', [RosterKerjaSafetyController::class, 'import'])->name('rosterkerja.safety.import');
    Route::get('/roster-kerja/safety/export', [RosterKerjaSafetyController::class, 'export'])->name('rosterkerja.safety.export');
    Route::get('/roster-kerja/safety/templateExcel', [RosterKerjaSafetyController::class, 'templateExcel'])->name('rosterkerja.safety.templateExcel');

    //Monitoring Payload
    Route::get('/monitoring-payload', [MonitoringPayloadController::class, 'index'])->name('monitoringpayload');

    // User
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware('canAccess');
    Route::post('/user/insert', [UserController::class, 'insert'])->name('user.insert');
    Route::post('/user/change-role/{id}', [UserController::class, 'changeRole'])->name('user.change-role');
    Route::get('/user/reset-password/{id}', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::get('/user/status-enabled/{id}', [UserController::class, 'statusEnabled'])->name('user.status-enabled');

    //P2H
    Route::get('/safety/p2h', [P2HController::class, 'index'])->name('p2h.index');
    Route::get('/safety/p2h/api', [P2HController::class, 'api'])->name('p2h.api');
    Route::get('/safety/p2h/detail', [P2HController::class, 'detail'])->name('p2h.detail');
    Route::get('/safety/p2h/monitoring', [P2HController::class, 'monitoring'])->name('monitoring.p2h')->middleware('canAccess');
    Route::get('/safety/p2h/api/monitoring', [P2HController::class, 'api_monitoring'])->name('p2h.api_monitoring');
    Route::get('/safety/p2h/detail_monitoring', [P2HController::class, 'detail_monitoring'])->name('p2h.detail_monitoring');
    Route::post('/safety/p2h/verifikasi', [P2HController::class, 'verifikasi'])->name('p2h.verifikasi');
    Route::get('/safety/p2h/show', [P2HController::class, 'show'])->name('p2h.show');
    Route::post('/safety/p2h/detail/post', [P2HController::class, 'detail_post'])->name('p2h.detail.post');
    Route::get('/safety/p2h/preview/{uuid}', [P2HController::class, 'preview'])->name('p2h.preview');
    Route::get('/safety/p2h/verified/superintendent/{uuid}', [P2HController::class, 'verifiedSuperintendent'])->name('p2h.verified.superintendent');
    Route::get('/safety/p2h/cetak/{uuid}', [P2HController::class, 'cetak'])->name('p2h.cetak');
    Route::get('/safety/p2h/download/{uuid}', [P2HController::class, 'download'])->name('p2h.download');

    //KKH
    Route::get('/kkh/all', [KKHController::class, 'all'])->name('kkh.all')->middleware('canAccess');
    Route::get('/kkh/all/api', [KKHController::class, 'all_api'])->name('kkh.all_api');
    Route::get('/kkh/all/name', [KKHController::class, 'all_name'])->name('kkh.all_name');
    Route::get('/kkh/name', [KKHController::class, 'name'])->name('kkh.name')->middleware('canAccess');
    Route::post('/kkh/verifikasi', [KKHController::class, 'verifikasi'])->name('kkh.verifikasi');
    Route::get('/kkh/download', [KKHController::class, 'download'])->name('kkh.download');

    //Job Pending Produksi
    Route::get('/job-pending/produksi', [JobPendingProduksiController::class, 'index'])->name('jobpending.produksi')->middleware('canAccess');
    Route::get('/job-pending/produksi/insert', [JobPendingProduksiController::class, 'insert'])->name('jobpending.produksi.insert')->middleware('canAccess');
    Route::post('/job-pending/produksi/post', [JobPendingProduksiController::class, 'post'])->name('jobpending.produksi.post');
    Route::post('/job-pending/produksi/catatanPenerima/{uuid}', [JobPendingProduksiController::class, 'catatanPenerima'])->name('jobpending.produksi.catatanPenerima');
    Route::get('/job-pending/produksi/show/{uuid}', [JobPendingProduksiController::class, 'show'])->name('jobpending.produksi.show');
    Route::get('/job-pending/produksi/cetak/{uuid}', [JobPendingProduksiController::class, 'cetak'])->name('jobpending.produksi.cetak');
    Route::get('/job-pending/produksi/download/{uuid}', [JobPendingProduksiController::class, 'download'])->name('jobpending.produksi.download');
    Route::get('/job-pending/produksi/verifikasi/{uuid}', [JobPendingProduksiController::class, 'verifikasi'])->name('jobpending.produksi.verifikasi');
    Route::get('/job-pending/produksi/detail', [JobPendingProduksiController::class, 'detail'])->name('jobpending.produksi.detail')->middleware('canAccess');
    Route::get('/job-pending/produksi/apiDetail', [JobPendingProduksiController::class, 'apiDetail'])->name('jobpending.produksi.apiDetail');
    Route::get('/job-pending/produksi/excelDetail', [JobPendingProduksiController::class, 'excelDetail'])->name('jobpending.produksi.excelDetail');

    //Job Pending Safety
    Route::get('/job-pending/safety', [JobPendingSafetyController::class, 'index'])->name('jobpending.safety')->middleware('canAccess');
    Route::get('/job-pending/safety/insert', [JobPendingSafetyController::class, 'insert'])->name('jobpending.safety.insert')->middleware('canAccess');
    Route::post('/job-pending/safety/post', [JobPendingSafetyController::class, 'post'])->name('jobpending.safety.post');
    Route::post('/job-pending/safety/catatanPenerima/{uuid}', [JobPendingSafetyController::class, 'catatanPenerima'])->name('jobpending.safety.catatanPenerima');
    Route::get('/job-pending/safety/show/{uuid}', [JobPendingSafetyController::class, 'show'])->name('jobpending.safety.show');
    Route::get('/job-pending/safety/cetak/{uuid}', [JobPendingSafetyController::class, 'cetak'])->name('jobpending.safety.cetak');
    Route::get('/job-pending/safety/download/{uuid}', [JobPendingSafetyController::class, 'download'])->name('jobpending.safety.download');
    Route::get('/job-pending/safety/verifikasi/{uuid}', [JobPendingSafetyController::class, 'verifikasi'])->name('jobpending.safety.verifikasi');
    Route::get('/job-pending/safety/detail', [JobPendingSafetyController::class, 'detail'])->name('jobpending.safety.detail')->middleware('canAccess');
    Route::get('/job-pending/safety/apiDetail', [JobPendingSafetyController::class, 'apiDetail'])->name('jobpending.safety.apiDetail');
    Route::get('/job-pending/safety/excelDetail', [JobPendingSafetyController::class, 'excelDetail'])->name('jobpending.safety.excelDetail');

    //Staging Plan
    Route::get('/staging-plan', [StagingPlanController::class, 'index'])->name('stagingplan')->middleware('canAccess');
    Route::get('/staging-plan/insert', [StagingPlanController::class, 'insert'])->name('stagingplan.insert');
    Route::get('/staging-plan/delete/{uuid}', [StagingPlanController::class, 'delete'])->name('stagingplan.delete');
    Route::post('/staging-plan/post', [StagingPlanController::class, 'post'])->name('stagingplan.post');
    Route::get('/staging-plan/preview/{uuid}', [StagingPlanController::class, 'preview'])->name('stagingplan.preview');
    Route::get('/file-staging-plan/{uuid}', function ($uuid) {

        $data = StagingPlan::where('uuid', $uuid)
            ->where('statusenabled', true)
            ->firstOrFail();

        $pdfUrl = $data->document;

        $response = Http::withOptions([
            'verify' => false,
            'timeout' => 30,
        ])->get($pdfUrl);

        if (!$response->ok()) {
            abort(404);
        }

       $contentType = $response->header('Content-Type');
        return Response::make(
            $response->body(),
            200,
            [
                'Content-Type'         => $contentType,
                'Content-Disposition' => 'inline',
            ]
        );

    })->name('fileStagingPlan.show');

    // Log
    Route::get('/log/index', [LogController::class, 'index'])->name('log.index')->middleware('canAccess');

    //Permisision
    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permission/save-role', [PermissionController::class, 'saveRole'])->name('permission.saveRole');
    Route::post('/permission/save-dept', [PermissionController::class, 'saveDept'])->name('permission.saveDept');

    //Reference Config
    Route::get('/reference', [ReferenceController::class, 'index'])->name('reference.index')->middleware('canAccess');
    Route::post('/reference/insert', [ReferenceController::class, 'insert'])->name('reference.insert');
    Route::post('/reference/update/{id}', [ReferenceController::class, 'update'])->name('reference.update');

    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});
Route::get('/verified/{encodedNik}', [VerifiedController::class, 'index'])->name('verified.index');


