<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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
Route::get('homepage-settings',[HomeController::class,'homepage_settings']);
Route::get('all-faqs', [HomeController::class, 'allFaqs']);
Route::get('header-data', [HomeController::class, 'headerSetting']);
Route::get('featured-clients', [HomeController::class, 'featured_clients']);
Route::get('what-we-do-lists', [HomeController::class, 'who_we_do']);
Route::get('what-we-do-lists-btm', [HomeController::class, 'who_we_do_btm']);
Route::get('header-menu', [HomeController::class, 'headerMenu']);
Route::get('footer-menu', [HomeController::class, 'footerMenu']);
Route::get('footer-data', [HomeController::class, 'footerData']);
Route::get('get-quote', [HomeController::class, 'getQuote']);
Route::get('social-media-links', [HomeController::class, 'social_media']);
Route::get('what-we-do-faqs', [HomeController::class, 'what_wedo_faqs']);
Route::get('get-services-page',[HomeController::class,'services_page_settings']);
Route::get('projects',[HomeController::class,'projects']);
Route::get('project-detail/{slug}',[HomeController::class,'projectDetail']);
Route::get('videos',[HomeController::class,'show_gallery']);
Route::get('contact-page',[HomeController::class,'contact_page']);
Route::get('our-process',[HomeController::class,'our_process']);
Route::get('about-texts',[HomeController::class,'about_texts']);
Route::get('embed-code',[HomeController::class,'embed_code']);
Route::get('/podcasts', [HomeController::class, 'getAllPodcasts']);
Route::get('/podcast-content', [HomeController::class, 'getPodcastContent']);
Route::get('seo-analytics',[HomeController::class,'seo_scripts']);
Route::get('website-meta',[HomeController::class,'website_meta']);
Route::get('/studios', [HomeController::class, 'get_studios_all']);
