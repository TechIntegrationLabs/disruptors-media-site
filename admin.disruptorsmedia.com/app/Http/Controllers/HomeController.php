<?php

namespace App\Http\Controllers;
use App\Models\AboutPage;
use App\Models\ContactPage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\HeaderSettings;
use App\Models\FeatureClients;
use App\Models\FooterSettings;
use App\Models\GetAQuote;
use App\Models\MenuManager;
use App\Models\SocialMedia;
use App\Models\Whatwedo;
use App\Models\ServicesPage;
use App\Models\Porfolios;
use App\Models\Podcast;
use App\Models\Portfolio_Category;
use App\Models\Portfolio_Images;
use App\Models\PodcastContent;
use App\Models\HomePageSettings;
use App\Models\AboutEmbedCode;
use App\Models\Gallery;
use App\Models\SeoModel;
use App\Models\WebsiteMeta;
use App\Models\Studio;
use App\Models\StudioGallery;

class HomeController extends Controller
{


    public function homepage_settings(){
        $homepage_settings = HomePageSettings::get();
        // return response(json_encode($homepage_settings));
         return response()->json($homepage_settings);
    }
    public function allFaqs(){
        $faqs = FAQ::where('category_id', 1)->orderBy('order', 'asc')->get();
        // return response(json_encode($faqs));
          return response()->json($faqs);
    }
    
     public function seo_scripts(){
        $scripts = SeoModel::get();
          return response()->json($scripts);
    }

    public function what_wedo_faqs(){
        $faqs = FAQ::where('category_id', 2)->orderBy('order', 'asc')->get();
        
         return response()->json($faqs);
    }

    public function headerSetting(){
        $header = HeaderSettings::paginate(1);
        
         return response()->json($header);
    }

    public function featured_clients(){
        $feature_clients = FeatureClients::orderBy('order','ASC')->get();
        
         return response()->json($feature_clients);
    }

    public function who_we_do() {
        $what_we_do_lists = Whatwedo::where('category_id', 2)->orderBy('order', 'asc')->get();
      
         return response()->json($what_we_do_lists);
    }

     public function who_we_do_btm() {
        $what_we_do_lists_btm = Whatwedo::where('category_id', 3)->orderBy('order', 'asc')->get();
      
         return response()->json($what_we_do_lists_btm);
    }


    public function our_process() {
        $process = Whatwedo::where('category_id', 1)->orderBy('order', 'asc')->get();
       
         return response()->json($process);
    }
    public function headerMenu(){
        $menu = MenuManager::where('category_id', 1)->orderBy('order', 'asc')->get();
         return response()->json($menu);
    }

    public function footerMenu(){
        $menu = MenuManager::where('category_id', 2)->orderBy('id', 'asc')->get();
         return response()->json($menu);
    }

    public function getQuote(){
        $quote = GetAQuote::get();
       
         return response()->json($quote);
    }
    public function footerData(){
        $footer = FooterSettings::first();
       
         return response()->json($footer);
    }

    public function social_media(){
        $social_medias = SocialMedia::orderBy('order','ASC')->get();
       
         return response()->json($social_medias);
    }

    public function services_page_settings(){
        $services_pages_settings = ServicesPage::where('id', 1)->get();
      
         return response()->json($services_pages_settings);
    }

    public function projects() {
        $projects = Porfolios::orderBy('order','ASC')->get();

        foreach ($projects as $project) {
            $categoryIds = explode(',', $project->category_id);
            $categories = Portfolio_Category::whereIn('id', $categoryIds)->pluck('category_name')->toArray();
            $project->categories = $categories;
        }

        return response()->json($projects);
    }

    // public function projectDetail($slug) {
    //     $portfolios = Porfolios::where('portfolio_slug', $slug)->with('images')->paginate(1);

    //     $formattedPortfolios = [];
    //     foreach ($portfolios as $portfolio) {
    //         $formattedPortfolio = $portfolio->toArray();
    //         $formattedPortfolio['images'] = $portfolio->images->pluck('portfolio_images')->toArray();
    //         $formattedPortfolios[] = $formattedPortfolio;
    //     }

    //     return response()->json($formattedPortfolios);
    // }
    
   public function projectDetail($slug) {
    // Fetch the current portfolio
    $currentPortfolio = Porfolios::where('portfolio_slug', $slug)->with('images')->first();

    // Fetch the next portfolio based on the order
    $nextPortfolio = Porfolios::where('order', '>', $currentPortfolio->order)
                                ->orderBy('order', 'asc')
                                ->first();

    // Fetch the previous portfolio based on the order
    $previousPortfolio = Porfolios::where('order', '<', $currentPortfolio->order)
                                    ->orderBy('order', 'desc')
                                    ->first();

    // Format the current portfolio
    $formattedPortfolio = $currentPortfolio->toArray();
    $formattedPortfolio['images'] = $currentPortfolio->images->pluck('portfolio_images')->toArray();

    // Format the next portfolio if it exists
    $formattedNextPortfolio = null;
    if ($nextPortfolio) {
        $formattedNextPortfolio = $nextPortfolio->toArray();
        // You may format images for the next portfolio if needed
    }

    // Format the previous portfolio if it exists
    $formattedPreviousPortfolio = null;
    if ($previousPortfolio) {
        $formattedPreviousPortfolio = $previousPortfolio->toArray();
        // You may format images for the previous portfolio if needed
    }

    return response()->json([
        'current_portfolio' => $formattedPortfolio,
        'next_portfolio' => $formattedNextPortfolio,
        'previous_portfolio' => $formattedPreviousPortfolio
    ]);
}


    public function contact_page(){
    
        $contactpage = ContactPage::where('id', 1)->get();
       
         return response()->json($contactpage);
    
    }
    public function show_gallery(){

        $galleries =  Gallery::orderBy('order','ASC')->get();
        return response()->json($galleries);
    }


    public function about_texts() {
        $embed_code = AboutEmbedCode::first();  // Retrieve only the first record
        $aboutexts = AboutPage::get();  // Get all about page texts
        return response()->json($aboutexts);
    }


    public function embed_code() {
        $embed_code = AboutEmbedCode::first();  // Retrieve only the first record
        return response()->json($embed_code);
    }
    
     public function website_meta(){

        $meta =  WebsiteMeta::where('id', 1)->get();
        return response()->json($meta);

    }



    public function getAllPodcasts()
    {
        // Fetch all podcasts
        $podcasts = Podcast::all();

        // If no podcasts are found, return a 404 response
        if ($podcasts->isEmpty()) {
            return response()->json([
                'message' => 'No podcasts found'
            ], 404);
        }

        return response()->json($podcasts);
    }


    public function getPodcastContent()
    {
        try {
            $podcast_content = PodcastContent::find(1); 

            if (!$podcast_content) {
                return response()->json([
                    'message' => 'Podcast Content not found.',
                ], 404);
            }
            return response()->json($podcast_content, 200);

        } catch (\Exception $e) {
            Log::error('Error fetching podcast content: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error fetching podcast content. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function get_studios_all()
{
    try {
        $studios = Studio::with('galleries')->get(); 

        return response()->json([
            'studios' => $studios,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error fetching studios. Please try again.'], 500);
    }

}

}
