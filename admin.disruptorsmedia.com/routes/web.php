<?php

use App\Http\Controllers\AdminController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/',[AdminController::class,'index'])->name('login');

//============ Admin Routes ==============
Route::get('/', [AdminController::class, 'adminlogin'])->name('admin-login');
Route::post('/admin/update/settings/header/{id}',[AdminController::class,'header_settings'])->name('header_settings');
Route::get('admin/settings/header',[AdminController::class,'edit_header_settings'])->name('edit_header_settings');

Route::get('admin/page/services',[AdminController::class,'edit_service_page_settings'])->name('edit_service_page_settings');
Route::post('/admin/update/page/services/{id}',[AdminController::class,'store_services_page_settings'])->name('store_services_page_settings');

Route::post('/admin/update/settings/footer/{id}',[AdminController::class,'update_footer_settings'])->name('update_footer_settings');
Route::get('admin/settings/footer',[AdminController::class,'edit_footer_settings'])->name('edit_footer_settings');

Route::post('/admin/update/settings/get-a-quote/{id}',[AdminController::class,'update_get_a_quote_settings'])->name('update_get_a_quote_settings');
Route::get('admin/settings/get-a-quote',[AdminController::class,'edit_get_a_quote_settings'])->name('get_a_quote');

Route::post('/admin/check-credentials', [AdminController::class, 'checkAdminCredentials'])->name('admin.checkCredentials');
Route::get('/admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'distruptors_dashboard'])->name('admindashboard');


Route::get('/admin/edit_events/{event}/edit', [AdminController::class, 'editEvent'])->name('admin.editEvent');
Route::delete('/admin/delete_event/{event}', [AdminController::class, 'deleteEvent'])->name('admin.deleteEvent');
Route::put('/admin/update_event/{event}', [AdminController::class, 'updateEvent'])->name('admin.updateEvent');


Route::get('/admin/adduser',[AdminController::class ,'user_register'])->name('/admin/adduser');
Route::get('/admin/all_user',[AdminController::class ,'alluser'])->name('/admin/all_user');

Route::get('/admin/edit_user/{user}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
Route::put('/admin/update_user/{user}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
Route::delete('/admin/delete_user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');


// SOCIAL MEDIA LINKS
Route::any('/admin/social-media-link/create',[AdminController::class,'social_media_links'])->name('create_social_media_links');
Route::get('/admin/social-media-link/list',[AdminController::class,'list_social_media_links'])->name('list_social_media_links');
Route::any('/admin/social-media-link/edit/{id}',[AdminController::class,'edit_social_media'])->name('edit_social_media');
Route::get('/admin/social-media-link/delete/{id}', [AdminController::class,'delete_social_media'])->name('destroy_social_media');

Route::any('/admin/social-media-link-cat/create',[AdminController::class,'create_social_media_links_cat'])->name('create_social_media_links_cat');


// SOCIAL MEDIA LINKS ENDS




// FEATURE CLIENTS

Route::any('/admin/featureclients/create',[AdminController::class,'create_featured_clients'])->name('featured_clients');
Route::get('admin/featuredclients/list',[AdminController::class,'featured_clients_list'])->name('featured_clients_list');
Route::any('/admin/featuredclients/edit/{id}',[AdminController::class,'edit_featured_clients'])->name('edit_featured_clients');
Route::get('/admin/featuredclients/delete/{id}', [AdminController::class,'delete_featuredclients'])->name('destroy_featuredclients');
// FEATURE CLIENT ENDS\


// FAQ`S

Route::any('/admin/faq/create',[AdminController::class,'create_faqs'])->name('create_faqs');
Route::get('/admin/faq/list',[AdminController::class,'faqs_list'])->name('faqs_list');
Route::any('/admin/faq/edit/{id}',[AdminController::class,'edit_faq'])->name('edit_faqs');
Route::get('/admin/faq/delete/{id}', [AdminController::class,'delete_Faq'])->name('destroy_faq');

// FAQ`s ends





// Podcast Video

Route::any('/admin/podcast/create',[AdminController::class,'create_podcast_video'])->name('create_podcast_video');
Route::get('/admin/podcast/list',[AdminController::class,'podcasts_lists'])->name('podcast_video_lists');
Route::any('/admin/podcast/edit/{id}',[AdminController::class,'update_podcast_video'])->name('edit_podcast_video');
Route::get('/admin/podcast/delete/{id}', [AdminController::class,'delete_podcast_video'])->name('destroy_podcast_video');

// Podcast Video Ends





// what we do

Route::any('/admin/frames/create',[AdminController::class,'create_what_we_do'])->name('create_what_we_do');
Route::get('/admin/frames/list',[AdminController::class,'what_We_do_list'])->name('what_We_do_list');
Route::any('/admin/frames/edit/{id}',[AdminController::class,'edit_whowedo'])->name('edit_whowedo');
Route::get('/admin/frames/delete/{id}', [AdminController::class,'delete_what_we_do'])->name('destroy_what_we_do');

// what we do ends


// Gallery

Route::any('/admin/gallery/create',[AdminController::class,'create_gallery'])->name('create_gallery');
Route::get('/admin/gallery/list',[AdminController::class,'list_gallery'])->name('list_gallery');
Route::get('/admin/gallery/delete/{id}',[AdminController::class,'destroy_gallery_video'])->name('destroy_gallery_video');
Route::any('/admin/gallery/edit/{id}',[AdminController::class,'edit_gallery'])->name('edit_gallery');

// Gallery ends


// Menu Manager

Route::any('/admin/menu-manager/create',[AdminController::class,'create_menu_manager'])->name('create_menu_manager');
Route::get('/admin/menu-manager/list',[AdminController::class,'list_menu_manager'])->name('list_menu_manager');
Route::any('/admin/menu-manger/edit/{id}',[AdminController::class,'edit_menu_manager'])->name('edit_menu_manager');
Route::get('/admin/menu-manager/delete/{id}', [AdminController::class,'delete_menu_manager'])->name('destroy_menu_manager');

// Menu Manager ends



//About Page

Route::any('/admin/pages/about',[AdminController::class,'create_about'])->name('create_about_us');
Route::any('/admin/pages/about/texts', [AdminController::class, 'update_about_us'])->name('update_about_us');
Route::any('admin/pages/about/store',[AdminController::class,'store_update_about_us'])->name('store_update_about_us');
Route::delete('/admin/pages/about/{id}/delete', [AdminController::class, 'deleteEntry'])->name('delete_entry');



// Contact Page
Route::get('/admin/pages/contact-us',[AdminController::class,'contact_page'])->name('view_contact_page');
Route::post('/admin/pages/update/contact-us/{id}',[AdminController::class,'update_contact_page_settings'])->name('update_contact_page_settings');


Route::get('/admin/pages/podcast-content',[AdminController::class,'view_podcast_content_page'])->name('view_podcast_content');
Route::post('/admin/pages/update/podcast-content/{id}',[AdminController::class,'update_podcast_content'])->name('update_podcast_content_page');




// Homepage Page
Route::get('/admin/pages/home',[AdminController::class,'home_page'])->name('view_home_page');
Route::post('/admin/pages/update/home/{id}',[AdminController::class,'update_home_page_settings'])->name('update_home_page_settings');




// Projects
Route::any('/admin/pages/projects/create',[AdminController::class,'create_work_portolios'])->name('create_work_portolios');
Route::get('admin/pages/projects/list',[AdminController::class,'list_work_projects'])->name('list_work_projects');
Route::any('/admin/pages/projects/edit/{id}',[AdminController::class,'edit_projects'])->name('edit_projects');
Route::get('admin/portfolio-images/{portfolioId}', [AdminController::class,'getPortfolioImages'])->name('get_portfolio_images');
Route::any('/admin/pages/projects/{id}/delete', [AdminController::class, 'delete_project'])->name('delete_project');
Route::post('/admin/pages/update/project/{id}',[AdminController::class,'update_work_portfolios'])->name('update_work_portfolios');
Route::any('/admin/pages/projects/project-category/create',[AdminController::class,'create_project_categories'])->name('create_project_categories');
Route::get('admin/pages/projects/project-category/list',[AdminController::class,'list_work_project_cateogories'])->name('list_work_project_cateogories');
Route::any('/admin/pages/projects/project-category/{id}/delete', [AdminController::class, 'delete_project_category'])->name('delete_project_category');






//Studios
Route::any('/admin/pages/studios/create',[AdminController::class,'create_studio_work'])->name('create_studio_work');
Route::get('admin/pages/studios/list',[AdminController::class,'list_studios'])->name('list_studios');
Route::any('/admin/pages/studios/edit/{id}',[AdminController::class,'edit_studio'])->name('edit_studio');
Route::get('/admin/pages/studios/studio-images/{id}/delete', [AdminController::class, 'delete_studio_img'])->name('delete_studio_img');
Route::post('/admin/pages/studios/studio/{id}',[AdminController::class,'update_work_studios'])->name('update_work_studios');
Route::any('/admin/pages/studios/{id}/delete', [AdminController::class, 'delete_studio'])->name('delete_studio');


//End Studios




Route::get('/admin/pages/projects/project-images/{id}/delete', [AdminController::class, 'delete_img'])->name('delete_img');
// Porjects ends
Route::post('sortabledatatable', [AdminController::class, 'updateOrder'])->name('sortabledatatable');

Route::post('sortabledatatable_social_media', [AdminController::class, 'updateOrder_social_media'])->name('sortabledatatable_social_media');
Route::post('sortabledatatable_featured_clients', [AdminController::class, 'sortabledatatable_featured_clients'])->name('sortabledatatable_featured_clients');
Route::post('sortabledatatable_faqs', [AdminController::class, 'sortabledatatable_faqs'])->name('sortabledatatable_faqs');
Route::post('frames-sort', [AdminController::class, 'sortabledatatable_frames'])->name('sortabledatatable_frames');
Route::post('sortabledatatable_gallries', [AdminController::class, 'sortabledatatable_gallries'])->name('sortabledatatable_gallries');
Route::post('sortabledatatable_projects', [AdminController::class, 'sortabledatatable_projects'])->name('sortabledatatable_projects');


// SEO Scripts

Route::any('/admin/seo/script/create',[AdminController::class,'create_seo_script'])->name('create_seo_script');
Route::get('/admin/seo/script/list',[AdminController::class,'seo_script_list'])->name('seo_script_list');
Route::any('/admin/seo/script/edit/{id}',[AdminController::class,'edit_seo_script'])->name('edit_seo_script');
Route::get('/admin/seo/script/delete/{id}', [AdminController::class,'delete_seo_scripts'])->name('delete_seo_scripts');

// SEO Scripts  ends

// Route::any('/admin/seo/website-meta/update/{id}',[AdminController::class,'update_website_meta'])->name('update_website_meta');
// Route::get('/admin/seo/website-meta/edit/{id}',[AdminController::class,'edit_website_meta'])->name('edit_website_meta');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/seo/website-meta/edit/',[AdminController::class,'edit_website_meta'])->name('edit_website_meta');
Route::any('/admin/seo/website-meta/update/{id}',[AdminController::class,'update_website_meta'])->name('update_website_meta');