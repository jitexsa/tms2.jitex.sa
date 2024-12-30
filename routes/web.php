<?php

use App\Http\Controllers\Ajax;
use App\Http\Controllers\Contractor\ContractorStatus;
use App\Http\Controllers\Contractor\SubContractor;
use App\Http\Controllers\Contractor\SubContractorDetail;
use App\Http\Controllers\CostManagement\Category;
use App\Http\Controllers\CostManagement\Item;
use App\Http\Controllers\CostManagement\Purchase;
use App\Http\Controllers\Workspace\WorkspaceController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\EmployeeManagement\Department;
use App\Http\Controllers\EmployeeManagement\Driver;
use App\Http\Controllers\EmployeeManagement\Employee;
use App\Http\Controllers\EmployeeManagement\License;
use App\Http\Controllers\EmployeeManagement\Location;
use App\Http\Controllers\EmployeeManagement\Position;
use App\Http\Controllers\Fuel\Fuel;
use App\Http\Controllers\Fuel\FuelType;
use App\Http\Controllers\SystemSetting\ApiSetting;
use App\Http\Controllers\SystemSetting\Company;
use App\Http\Controllers\SystemSetting\Division;
use App\Http\Controllers\SystemSetting\DocumentType;
use App\Http\Controllers\SystemSetting\EmailSetting;
use App\Http\Controllers\SystemSetting\ServiceTypes;
use App\Http\Controllers\SystemSetting\SMSTemplate;
use App\Http\Controllers\SystemSetting\SystemLog;
use App\Http\Controllers\SystemSetting\VehicleSync;
use App\Http\Controllers\TripManagement\AdditionalRequirements;
use App\Http\Controllers\TripManagement\RequestedBy;
use App\Http\Controllers\TripManagement\SOW;
use App\Http\Controllers\TripManagement\Trip;
use App\Http\Controllers\TripManagement\TripArchive;
use App\Http\Controllers\TripManagement\TripStatus;
use App\Http\Controllers\TripManagement\TripUntracked;
use App\Http\Controllers\VehicleManagement\Insurance;
use App\Http\Controllers\VehicleManagement\LegalDocument;
use App\Http\Controllers\VehicleManagement\Maker;
use App\Http\Controllers\VehicleManagement\Model;
use App\Http\Controllers\VehicleManagement\Route as VehicleManagementRoute;
use App\Http\Controllers\VehicleManagement\Vehicle;
use App\Http\Controllers\VehicleManagement\VehicleInspection;
use App\Http\Controllers\VehicleManagement\VehicleLeasing;
use App\Http\Controllers\VehicleManagement\VehicleType;
use App\Http\Controllers\VendorManagement\Vendor;
use App\Http\Controllers\VendorManagement\VendorType;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/',  [Dashboard::class, 'index']);

    Route::prefix('dashboard')->group(function (){
        Route::get('/', [Dashboard::class, 'index']);
        Route::post('/vehicle-sync-with-google-map', [Dashboard::class, 'vehicleSyncWithGoogleMap']);
        Route::post('/waybill-list', [Dashboard::class, 'waybillList']);
    });

     /**
          * workspace management
          */
        Route::prefix('workspace')->group(function (){
           Route::get('/', WorkspaceController::class)->name('workspace');
           Route::get('/add', WorkspaceController::class)->name('add');
        });

         /**
          * customer management
          */
        Route::prefix('customer')->group(function (){
            Route::get('/', CustomerController::class)->name('customer');
            Route::get('/add', CustomerController::class)->name('add');
         });

           /**
          * vendor management
          */

         Route::prefix('vendor')->group(function (){
            Route::get('/', Vendor::class)->name('vendor');
            Route::get('/add', Vendor::class)->name('add');
            Route::get('/vendor-type', VendorType::class)->name('vendor-type');
            Route::get('/vendor-type/add', VendorType::class)->name('add');
         });

          /**
          * employee management
          */

         Route::prefix('employee')->group(function (){
            Route::get('/', Employee::class)->name('employee');
            Route::get('/add', Employee::class)->name('add');
            Route::prefix('driver')->group(function (){
                Route::get('/', Driver::class)->name('driver');
                Route::get('/add', Driver::class)->name('add');
            });
            Route::prefix('position')->group(function (){
                Route::get('/', Position::class)->name('position');
                Route::get('/add', Position::class)->name('add');
            });
            Route::prefix('department')->group(function (){
                Route::get('/', Department::class)->name('department');
                Route::get('/add', Department::class)->name('add');
            });
            Route::prefix('license')->group(function (){
                Route::get('/', License::class)->name('license');
                Route::get('/add', License::class)->name('add');
            });
            Route::prefix('location')->group(function (){
                Route::get('/', Location::class)->name('location');
                Route::get('/add', Location::class)->name('add');
            });
         });

         /**
          * vehicle management
          */
         Route::prefix('vehicle')->group(function (){
            Route::get('/', Vehicle::class)->name('vehicle');
            Route::get('/add', Vehicle::class)->name('add');

            Route::prefix('leasing')->group(function (){
                Route::get('/', VehicleLeasing::class)->name('leasing');
                Route::get('/add', VehicleLeasing::class)->name('add');
            });
            Route::prefix('inspection')->group(function (){
                Route::get('/', VehicleInspection::class)->name('inspection');
                Route::get('/add', VehicleInspection::class)->name('add');
                Route::get('/pdf/{id}', VehicleInspection::class)->name('pdf')
                ->where('id', '[0-9]+');
            });
            Route::prefix('maker')->group(function (){
                Route::get('/', Maker::class)->name('maker');
                Route::get('/add', Maker::class)->name('add');
            });
            Route::prefix('model')->group(function (){
                Route::get('/', Model::class)->name('model');
                Route::get('/add', Model::class)->name('add');
            });
            Route::prefix('type')->group(function (){
                Route::get('/', VehicleType::class)->name('type');
                Route::get('/add', VehicleType::class)->name('add');
            });
            Route::prefix('route')->group(function (){
                Route::get('/', VehicleManagementRoute::class)->name('route');
                Route::get('/add', VehicleManagementRoute::class)->name('add');
            });
            Route::prefix('insurance')->group(function (){
                Route::get('/', Insurance::class)->name('insurance');
                Route::get('/add', Insurance::class)->name('add');
            });
            Route::prefix('legal-document')->group(function (){
                Route::get('/', LegalDocument::class)->name('legal-document');
                Route::get('/add', LegalDocument::class)->name('add');
            });
         });

         /**
          * trip management
          */
         Route::prefix('trip')->group(function (){
            Route::get('/', Trip::class)->name('trip');
            Route::get('/add', Trip::class)->name('add');

            Route::prefix('archive')->group(function (){
                Route::get('/', TripArchive::class)->name('archive');
            });
            Route::prefix('untracked')->group(function (){
                Route::get('/', TripUntracked::class)->name('untracked');
            });
            Route::prefix('status')->group(function (){
                Route::get('/', TripStatus::class)->name('status');
                Route::get('/add', TripStatus::class)->name('add');
            });
            Route::prefix('sow')->group(function (){
                Route::get('/', SOW::class)->name('sow');
                Route::get('/add', SOW::class)->name('add');
            });
            Route::prefix('additional-requirements')->group(function (){
                Route::get('/', AdditionalRequirements::class)->name('additional-requirements');
                Route::get('/add', AdditionalRequirements::class)->name('add');
            });
            Route::prefix('requested-by')->group(function (){
                Route::get('/', RequestedBy::class)->name('requested-by');
                Route::get('/add', RequestedBy::class)->name('add');
            });
         });

          /**
          * cost management
          */
          Route::prefix('cost')->group(function (){
            Route::prefix('purchase')->group(function (){
                Route::get('/', Purchase::class)->name('purchase');
                Route::get('/add', Purchase::class)->name('add');
            });
            Route::prefix('category')->group(function (){
                Route::get('/', Category::class)->name('category');
                Route::get('/add', Category::class)->name('add');
            });
            Route::prefix('item')->group(function (){
                Route::get('/', Item::class)->name('item');
                Route::get('/add', Item::class)->name('add');
            });
         });

         /**
          * system setting
          */
          Route::prefix('setting')->group(function (){
            Route::prefix('company')->group(function (){
                Route::get('/', Company::class)->name('company');
                Route::get('/add', Company::class)->name('add');
            });
            Route::prefix('service-types')->group(function (){
                Route::get('/', ServiceTypes::class)->name('service-types');
                Route::get('/add', ServiceTypes::class)->name('add');
            });
            Route::prefix('vehicle-sync')->group(function (){
                Route::get('/', VehicleSync::class)->name('vehicle-sync');
            });
            Route::prefix('sms-template')->group(function (){
                Route::get('/', SMSTemplate::class)->name('sms-template');
                Route::get('/add', SMSTemplate::class)->name('add');
            });
            Route::prefix('document-type')->group(function (){
                Route::get('/', DocumentType::class)->name('document-type');
                Route::get('/add', DocumentType::class)->name('add');
            });
            Route::prefix('email-setting')->group(function (){
                Route::get('/', EmailSetting::class)->name('email-setting');
                Route::get('/add', EmailSetting::class)->name('add');
            });
            Route::prefix('division')->group(function (){
                Route::get('/', Division::class)->name('division');
                Route::get('/add', Division::class)->name('add');
            });
            Route::prefix('logs')->group(function (){
                Route::get('/', SystemLog::class)->name('logs');
            });
            Route::prefix('api-setting')->group(function (){
                Route::get('/', ApiSetting::class)->name('api-setting');
            });
         });

          /**
          * fuel
          */
          Route::prefix('fuel')->group(function (){
            Route::get('/', Fuel::class)->name('fuel');
            Route::get('/add', Fuel::class)->name('add');
            Route::prefix('fuel-type')->group(function (){
                Route::get('/', FuelType::class)->name('fuel-type');
                Route::get('/add', FuelType::class)->name('add');
            });
         });

           /**
          * fuel
          */
          Route::prefix('subcontractor')->group(function (){
            Route::get('/', SubContractor::class)->name('subcontractor');
            Route::get('/add', SubContractor::class)->name('add');
            Route::prefix('detail')->group(function (){
                Route::get('/{id}', SubContractorDetail::class)->name('contractor-detail')
                ->where('id', '[0-9]+');
                Route::get('/add/{id}', SubContractorDetail::class)->name('add')->where('id', '[0-9]+');
            });
            Route::prefix('contractor-status')->group(function (){
                Route::get('/', ContractorStatus::class)->name('contractor-status');
                Route::get('/add', ContractorStatus::class)->name('add');
            });
            Route::prefix('contractor-report')->group(function (){
                Route::get('/', FuelType::class)->name('contractor-report');
            });
         });

                  
         /**
          * ajax route call
          */
          Route::prefix('ajax')->group(function (){
            Route::post('/change-workspace', [Ajax::class, 'ChangeWorkspace'])->name('change-workspace');
            Route::post('/get-item', [Ajax::class, 'getItem'])->name('get-item');
            Route::post('/get-company-vehicle', [Ajax::class, 'getCompanyVehicle'])->name('get-company-vehicle');
            Route::post('/inspection-detail', [Ajax::class, 'vehicleInspectionDetail'])->name('inspection-detail');
            Route::post('/add-route', [Ajax::class, 'saveRoute'])->name('save-route');
            Route::post('/add-request', [Ajax::class, 'saveRequest'])->name('save-request');
            Route::post('/add-vehicle', [Ajax::class, 'saveVehicle'])->name('save-vehicle');
            Route::post('/add-driver', [Ajax::class, 'saveDriver'])->name('save-driver');
            Route::post('/add-shipping', [Ajax::class, 'saveShipping'])->name('save-shipping');
            Route::post('/get-saleman', [Ajax::class, 'getSaleman'])->name('get-saleman');
            Route::post('/load-vehicle', [Ajax::class, 'getVehicle'])->name('get-vehicle');
          });

});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
