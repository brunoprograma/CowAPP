<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('businesses/businesses/featured', 'BusinessesController@featured')->name('business.featured');
Route::get('businesses/businesses/all', 'BusinessesController@all')->name('business.all');
Route::get('businesses/businesses/businesses-filter', 'BusinessesController@businessesFilter')->name('business.businessesFilter');
Route::get('businesses/businesses/details/{business}', 'BusinessesController@details')->name('business.details');
Route::get('businesses/businesses/addresses', 'BusinessesController@addresses')->name('business.addresses');
Route::get('businesses/businesses/{business}/suroundings/all', 'Businesses\AroundController@all')
    ->name('suroundings.all');
Route::get('businesses/businesses/{business}/galeries/all', 'Businesses\GaleriesController@all')
    ->name('galery.all');
Route::get('businesses/businesses/{business}/characteristics/all', 'Businesses\CharacteristicsController@all')
    ->name('characteristics.all');
Route::get('businesses/businesses/{business}/stagegalleries/all', 'Businesses\StageGalleriesController@all')
    ->name('stage-galery.all');
Route::get(
    'businesses/businesses/{business}/stagegalleries/dates',
    'Businesses\StageGalleriesController@detailsOngoingDates'
)->name('stage-galery.detailsOngoingDates');
Route::get('businesses/businesses/{business}/floors/all', 'Businesses\FloorsController@all')
    ->name('business-floors.all');
Route::get('businesses/businesses/{business}/apartments/all', 'Businesses\ApartmentsController@all')
    ->name('business-apartments.all');
Route::get(
    'businesses/businesses/{business}/floors/{floor}/apartments/{apartment}/rooms/all',
    'Businesses\ApartmentRoomsController@all'
)->name('apartments-rooms.all');
Route::get(
    'businesses/businesses/{business}/floors/{floor}/apartments/{apartment}/features/all',
    'Businesses\ApartmentFeaturesController@all'
)->name('apartments-features.all');
Route::get('businesses/businesses/{business}/differentials/all', 'Businesses\DifferentialsController@all')
    ->name('business-differentials.all');
Route::get('banners/all', 'BannersController@all')->name('banners.all');
Route::get('businesses/categories/all', 'Businesses\CategoriesController@all')->name('business.categories.all');
Route::get('businesses/businesses/{business}/stages/all', 'Businesses\StagesController@all')
    ->name('business.stages.all');
Route::get('businesses/filters/all', 'Businesses\FiltersController@all')->name('businesses.filters.all');
Route::get('blogs/all', 'BlogsController@all')->name('blogs.all');
Route::get('blogs/list', 'BlogsController@list')->name('blog.list');
Route::get('blogs/details/{blog}', 'BlogsController@details')->name('blog.detais');
Route::get('blogs/featured', 'BlogsController@featured')->name('businesses.featured');
Route::get('blogs/tags/all', 'Blogs\TagsController@all')->name('tags.all');
Route::get('pages/list/{page}', 'PagesController@listPage')->name('page.list');
Route::post('contact/send', 'ContactController@emailSender')->name('contact.send');
Route::post('contact/send-active-campaign', 'ContactController@activeCampaign')->name('contact.sendAtiveCampaign');
Route::get('contacts/all', 'ContactController@all')->name('contacts.all');
Route::get('socials/all', 'SocialNetworksController@all')->name('social.all');
Route::get('detail/all', 'CompanyDetailsController@all')->name('details.all');
Route::get('purposes/all', 'PurposesController@all')->name('puporses.all');
Route::get('diferentials/all', 'DiferentialsController@all')->name('diferentials.all');
Route::get('partners/all', 'PartnersController@all')->name('partners.all');
Route::get('client-built-category/unities', 'ClientBuiltCategoryController@unities');
Route::get('client-built-category/users', 'ClientBuiltCategoryController@users');
Route::resource('client-built-category', 'ClientBuiltCategoryController');
Route::resource('client-built-category.built', 'ClientBuiltController');
Route::get('dashboard/climaTempo', 'DashboardController@climaTempo')->name('dashboard.climaTempo');
Route::get('dashboard/businesses/under-construction', 'DashboardController@listUnderConstructionBusiness')->name('dashboard.businesses.listUnderConstructionBusiness');
Route::get('dashboard/businesses/built', 'DashboardController@listBuiltBusiness')->name('dashboard.businesses.listBuiltBusiness');
Route::get('dashboard/messages', 'DashboardController@countUnreadMessages')->name('dashboard.messages.countUnreadMessages');
Route::get('dashboard/blog', 'DashboardController@countWaitingBlogPosts')->name('dashboard.blog.countWaitingBlogPosts');
Route::get('dashboard/business/galery', 'DashboardController@checkStageGallerieHasMonthPictures')->name('dashboard.businesses.checkStageGallerieHasMonthPictures');
Route::get('dashboard/business/pendencies', 'DashboardController@businessesPendencies')->name('dashboard.businesses.businessesPendencies');
Route::get('dashboard/concrete-event/pendencies', 'DashboardController@concreteEventPendencies')->name('dashboard.concreteEventPendencies');
Route::get('dashboard/built/pendencies', 'DashboardController@builtPendencies')->name('dashboard.builtPendencies');
Route::get('dashboard/business/cp-check', 'DashboardController@showConcretingCheckup')->name('dashboard.businesses.showConcretingCheckup');
Route::get('dashboard/business/next-breakings', 'DashboardController@nextBreakingTests')->name('dashboard.businesses.nextBreakingTests');
Route::get('dashboard/business/armor-conference-graph', 'DashboardController@armorConferenceGraph')->name('dashboard.businesses.armorConferenceGraph');
Route::get('dashboard/client-deadline-graph', 'DashboardController@clientDeadlineGraph')->name('dashboard.clientDeadlineGraph');
Route::get('dashboard/accompaniment-graph', 'DashboardController@accompanimentGraph')->name('dashboard.accompanimentGraph');
Route::get('dashboard/unconformities-graph', 'DashboardController@unconformitiesGraph')->name('dashboard.unconformitiesGraph');
Route::get('dashboard/unconformity-categories-graph', 'DashboardController@unconformityCategoriesGraph')->name('dashboard.unconformityCategoriesGraph');
Route::get('dashboard/security-followups-graph', 'DashboardController@securityFollowupsGraph')->name('dashboard.securityFollowupsGraph');
Route::get('dashboard/tickets-open', 'DashboardController@ticketsOpen')->name('dashboard.ticketsOpen');
Route::get('dashboard/tickets-graph', 'DashboardController@ticketsGraph')->name('dashboard.ticketsGraph');
Route::get('dashboard/tickets-category-graph', 'DashboardController@ticketsCategoryGraph')->name('dashboard.ticketsCategoryGraph');
Route::get('dashboard/tickets-time-graph', 'DashboardController@ticketsTimeGraph')->name('dashboard.ticketsTimeGraph');
Route::get('dashboard/top-tickets-graph', 'DashboardController@topTicketsGraph')->name('dashboard.topTicketsGraph');
//---------------- Dash Board Construction ----------------//
Route::get('dashboardConstruction/unities-business', 'DashboardConstructionController@unitiesBusiness')->name('dashboardConstruction.unitiesBusiness');
Route::get('dashboardConstruction/concrete-evente-business', 'DashboardConstructionController@concreteEventeBusiness')->name('dashboardConstruction.concreteEventeBusiness');
Route::get('dashboardConstruction/unconformities-business', 'DashboardConstructionController@unconformitiesBusiness')->name('dashboardConstruction.unconformitiesBusiness');
Route::get('dashboardConstruction/checklists-business', 'DashboardConstructionController@checklistsBusiness')->name('dashboardConstruction.checklistsBusiness');
Route::get('dashboardConstruction/armor-conferences-business', 'DashboardConstructionController@armorConferencesBusiness')->name('dashboardConstruction.armorConferencesBusiness');
Route::get('dashboardConstruction/tickets-business', 'DashboardConstructionController@ticketsBusiness')->name('dashboardConstruction.ticketsBusiness');
Route::get('dashboardConstruction/sales-table', 'DashboardConstructionController@salesTable')->name('dashboardConstruction.salesTable');
Route::get('dashboardConstruction/breakdown-pending', 'DashboardConstructionController@breakdownPending')->name('dashboardConstruction.breakdownPending');
Route::get('dashboardConstruction/deadline-current-month', 'DashboardConstructionController@deadlineCurrentMonth')->name('dashboardConstruction.deadlineCurrentMonth');
Route::get('dashboardConstruction/pendency-checklist-graph', 'DashboardConstructionController@pendencyChecklistGraph')->name('dashboardConstruction.pendencyChecklistGraph');
Route::get('dashboardConstruction/pendency-checklist-category-graph', 'DashboardConstructionController@pendencyChecklistCategoryGraph')->name('dashboardConstruction.pendencyChecklistCategoryGraph');
Route::get('dashboardConstruction/count-accompaniment-graph', 'DashboardConstructionController@countAccompanimentGraph')->name('dashboardConstruction.countAccompanimentGraph');
Route::get('dashboardConstruction/unconformities-pending-graph', 'DashboardConstructionController@unconformitiesPendingGraph')->name('dashboardConstruction.unconformitiesPendingGraph');
Route::get('dashboardConstruction/unconformities-stage-graph', 'DashboardConstructionController@unconformitiesStageGraph')->name('dashboardConstruction.unconformitiesStageGraph');
Route::get('dashboardConstruction/client-delay-deadline-graph', 'DashboardConstructionController@clientDelayDeadlineGraph')->name('dashboardConstruction.clientDelayDeadlineGraph');
//---------------- Sales Table ----------------//
Route::get('sale-tables', 'SalesTableController@index')->name('saleTables.index');
Route::get('sale-tables/show', 'SalesTableController@show')->name('saleTables.show');
Route::post('sale-table', 'SalesTableController@store')->name('saleTables.store');
Route::put('sale-table', 'SalesTableController@update')->name('saleTables.update');
Route::delete('sale-table', 'SalesTableController@destroy')->name('saleTables.destroy');
Route::middleware('auth:api')->group(function () {
    Route::get('user/clients', 'UsersController@userClients')->name('users.clients');
    Route::get('users/profile', 'UsersController@profile')->name('users.userProfile');
    Route::post('users/change-password', 'UsersController@changePassword')->name('users.changePassword');
    Route::get('users/permissions', 'UsersController@acessibleModules')->name('users.acessibleModules');
    Route::get('messages/not-readed', 'MessageController@countNotReaded')->name('messages@countNotReaded');
    
    Route::middleware('access')->group(function () {
        Route::get('users/notifications', 'NotificationController@index')->name('notification.index');
        Route::put('users/notifications', 'NotificationController@update')->name('notification.update');
        Route::middleware('logs:api')->group(function () {
            Route::resource('users', 'UsersController');
            Route::get('modules', 'ModulesController@index')->name('modules.index');
            Route::post('user-groups/{userGroup}/modules', 'UserGroupsController@userGroupModule')
                ->name('user-groups.modules');
            Route::resource('user-groups', 'UserGroupsController');
            Route::prefix('businesses')->group(function () {
                Route::namespace('Businesses')->group(function () {
                    Route::resource('businesses.floors', 'FloorsController');
                    Route::resource('businesses.floors.apartments', 'ApartmentsController');
                    Route::resource('businesses.floors.apartments.features', 'ApartmentFeaturesController');
                    Route::resource('businesses.floors.apartments.rooms', 'ApartmentRoomsController');
                    Route::resource('businesses.pavements', 'PavementController');
                    Route::resource('businesses.unities', 'UnityController');
                    Route::resource('businesses.stages', 'StagesController');
                    Route::resource('businesses.suroundings', 'AroundController');
                    Route::resource('businesses.stagegalleries', 'StageGalleriesController');
                    Route::resource('businesses.blueprints', 'BlueprintsController');
                
                    Route::resource('businesses.galeries', 'GaleriesController');
                    Route::resource('businesses.differentials', 'DifferentialsController');
                    Route::resource('businesses.characteristics', 'CharacteristicsController');
                    Route::resource('businesses.timeline', 'TimelineController');
                    Route::resource('tags', 'TagsController');
                    Route::resource('filters', 'FiltersController');
                    Route::resource('categories', 'CategoriesController');
                });
                Route::resource('businesses', 'BusinessesController');
            });
            Route::resource('banners', 'BannersController');
            Route::resource('blogs/tags', 'Blogs\TagsController');
            Route::resource('blogs', 'BlogsController');
            Route::resource('blogs.galeries', 'Blogs\GalleriesController');
            Route::resource('pages', 'PagesController');
            Route::resource('pages.galeries', 'Pages\GaleriesController');
            Route::resource('pages.features', 'Pages\FeaturesController');
            Route::resource('detail', 'CompanyDetailsController');
            Route::resource('socials', 'SocialNetworksController');
            Route::resource('contacts', 'ContactController');
            Route::resource('purposes', 'PurposesController');
            Route::resource('diferentials', 'DiferentialsController');
            Route::resource('partners', 'PartnersController');
            Route::get('clients/list-by-client', 'ClientController@listByClient')->name('client.listByClient');
            Route::get('clients/all', 'ClientController@all');
            Route::resource('clients', 'ClientController');
            Route::get('real-states/list-by-realstate', 'RealStateController@listByRealState')->name('realState.listByRealState');
            Route::resource('real-states', 'RealStateController');
            Route::delete('tickets/delete-image', 'TicketController@deleteImage');
            Route::resource('ticket-categories', 'TicketCategoryController');
            Route::resource('tickets', 'TicketController');
            Route::resource('tickets.message', 'TicketMessageController');
            Route::delete('tickets/ticket-galery/{galery}', 'TickectGaleryController@deleteGalery')->name('ticket.deleteGalery');
            Route::resource('messages', 'MessageController');
            Route::resource('client-area/ticket-categories', 'TicketCategoryController');
            
            Route::get('client-area/list-my-unities', 'ClientController@listMyUnities')->name('client.listMyUnities');
            Route::get('client-area/list-my-businesses', 'ClientController@listMyBusinesses')->name('client.listMyBusinesses');
            Route::get('client-area/list-architects', 'ClientController@listArchitects')->name('clientArea.listArchitects');
            Route::post('client-area/tickets/{ticket}/message', 'TicketMessageController@store')->name('ticketMessage.store');
            Route::get('client-area/page/{page}', 'ClientController@showPage')->name('clientArea.showPage');
            Route::get('client-area/list-tickets-call/{unity}', 'ClientController@listTicketsCall')->name('clientArea.listTicketsCall');
            Route::get('client-area/list-ticket/{ticket}', 'ClientController@listTicketById')->name('clientArea.listTicketById');
            Route::get('client-area/list-builts', 'ClientController@listBuilts')->name('clientBuilts.listBuilts');
            Route::delete('client-area/delete-built/{id}', 'ClientController@destroyBuilt')->name('clientBuilts.destroyBuilt');
            Route::post('client-area/create-ticket-client', 'ClientController@createTicketClient')->name('clientTicket.createTicketClient');
            Route::delete('client-area/delete-message/{id}', 'ClientController@deleteMessage')->name('clientMessage.deleteMessage');
            Route::get('client-area/download-zip', 'ClientController@downloadZip')->name('clientDownlaod');
            Route::resource('client-area', 'ClientController');
            Route::get('real-state-area', 'RealStateController@listByRealState')->name('realState.listByRealState');
            Route::get('real-state-area/list-news', 'RealStateController@listNews')->name('realState.listNews');
            Route::get('real-state-area/show-page/{page}', 'RealStateController@showPage')->name('realState.showPage');
            Route::resource('diary-activity', 'DiaryActivityController');
            Route::resource('concrete-event', 'ConcreteEventController');
            Route::resource('concrete-event.concreting', 'ConcretingController');
            Route::resource('armor-conference', 'ArmorConferenceController');
            Route::resource('diary-services', 'DiaryServiceController');
            Route::get('diary-accompaniment/show', 'AccompanimentController@show');
            Route::resource('diary-accompaniment', 'AccompanimentController');
            Route::resource('checklist-category', 'ChecklistCategoryController');
            Route::delete('checklist-template-itens', 'ChecklistTemplateItensController@destroy');
            Route::put('checklist-template-itens', 'ChecklistTemplateItensController@update');
            Route::get('checklist-template-itens/all', 'ChecklistTemplateItensController@all');
            Route::resource('checklist-template-itens', 'ChecklistTemplateItensController');
            Route::resource('checklist-template', 'ChecklistTemplateController');
            Route::put('checklists/itens', 'ChecklistController@updateItensChecklist');
            Route::resource('checklists', 'ChecklistController');
            Route::resource('unconformity-categories', 'UnconformityCategoryController');
            Route::resource('unconformity-subcategories', 'UnconformitySubcategoryController');
            Route::resource('unconformities', 'UnconformityController');
            Route::resource('unconformities.galery', 'UnconformityGaleryController');
            Route::resource('security-service', 'SecurityServiceController');
            Route::resource('security-followup', 'SecurityFollowupController');
            Route::resource('realstates-news-categories', 'RealstatesNewsCategoryController');
            Route::resource('realstates-news', 'RealstateNewsController');
            Route::resource('client-business-deadlines', 'ClientBusinessDeadlineController');
        });
        Route::resource('logs', 'LogController');
    });
    
    Route::get('logout', 'UsersController@logout')->name('users.logout');
});
Route::middleware('logs:api')->group(function () {
    Route::post('login', 'UsersController@login')->name('users.login');
});