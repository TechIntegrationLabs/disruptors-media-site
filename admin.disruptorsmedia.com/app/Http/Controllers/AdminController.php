<?php


namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\ContactPage;
use App\Models\HomePageSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Podcast;
use App\Models\PodcastContent;
use App\Models\HeaderSettings;
use App\Models\SocialMedia;
use App\Models\FeatureClients;
use App\Models\FooterSettings;
use App\Models\FAQ;
use App\Models\GetAQuote;
use App\Models\Gallery;
use App\Models\MenuCategory;
use App\Models\MenuManager;
use App\Models\Whatwedo;
use App\Models\Studio;
use App\Models\StudioGallery;
use App\Models\FrameCategory;
use App\Models\FAQCategory;
use App\Models\ServicesPage;
use App\Models\Porfolios;
use App\Models\Portfolio_Category;
use App\Models\Portfolio_Images;
use App\Models\SocialMediaCat;
use App\Models\SeoModel;
use App\Models\WebsiteMeta;
use App\Models\AboutEmbedCode;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except('adminlogin', 'checkAdminCredentials');
    }

    public function adminlogin()
    {
        $data = [
            "title" => "Admin Portal | Login"
        ];
        return view("backend.login", $data);
    }

    public function checkAdminCredentials(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'password.required' => 'The password field is required.',
        ]);


        if (auth()->guard('admin')->attempt($request->only('email', 'password'))) {
            // Authentication successful
            return redirect()->route('admindashboard');
        } else {
            // Authentication failed
            return redirect()->back()->withInput($request->only('email'))->withErrors(['password' => 'Invalid email or password.']);
        }
    }

    public function logoutAdmin()
    {
        auth()->guard('admin')->logout();
        return redirect('/');
    }


    public function index()
    {

        $data = [
            'title' => 'Distruptors Admin Panel|Login '
        ];
        return view('backend.login', $data);

    }

    public function distruptors_dashboard()
    {

        $data = [
            'title' => 'Distruptors | Admin Panel '
        ];

        return view('backend.index', $data);


    }


    public function alluser()
    {
        $users = User::all();
        $data = [
            "breadcrumb" => "All Users",
            "title" => "Admin Portal | All User",
            "users" => $users,
        ];

        return view("admin/all_user", $data);
    }


    public function user_register()
    {
        $data = [
            "title" => "Admin Portal | New User",
        ];
        return view("admin/add_user", $data);
    }

    public function registerUser(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,NULL,id,deleted_at,NULL',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'phoneNumber' => 'nullable|numeric',
            'password' => 'required|min:6|confirmed',
            'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'designation' => 'nullable',
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->input('name'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'phoneNumber' => $request->input('phoneNumber'),
            'password' => bcrypt($request->input('password')),
            'designation' => $request->input('designation'),
        ];

        if ($request->hasFile('profilePicture')) {
            $imagePath = $request->file('profilePicture')->store('profile_pictures', 'public');
            $data['profilePicture'] = $imagePath;
        }

        // Create a new user record
        $user = User::create($data);

        return back()->with(['success' => 'User registered successfully', 'data' => $user]);
    }

    //===================== user update  start ======================

    // Display the edit user form
    public function editUser(User $user)
    {
        $data = [
            'breadcrumb' => 'Edit User',
            'user' => $user,
        ];

        return view('admin/edit_user', $data);
    }

    // Handle the update user operation
    public function updateUser(Request $request, User $user)
    {
        try {
            // If a new password is provided, update it; otherwise, keep the current password
            $data = $request->except('password');
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }

            // If a new profile picture is provided, handle the upload
            if ($request->hasFile('profilePicture')) {
                $profilePicturePath = $request->file('profilePicture')->store('profile_pictures', 'public');
                $data['profilePicture'] = $profilePicturePath;
            }

            // Update the user with the provided data
            $user->update($data);

            return redirect()->route('admin.all_user')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating user. Please try again.']);
        }
    }

    // Handle the delete user operation
    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return back()->with(['error' => 'Error deleting user. Please try again.']);
        }
    }

    public function edit_header_settings()
    {
        $header_settings = HeaderSettings::find(1);
        $data = [
            'title' => " Distruptors | Header Settings",
            'header_settings' => $header_settings
        ];

        return view('backend.settings.header_settings', $data);

    }


    public function edit_service_page_settings()
    {
        $service_page = ServicesPage::find(1);
        $data = [
            'title' => " Distruptors | Update Service Page Settings",
            'service_page' => $service_page
        ];

        return view('backend.settings.servicespage_settings.update-settings', $data);

    }


    public function edit_footer_settings()
    {
        $footer_settings = FooterSettings::find(1);
        $data = [
            'title' => " Distruptors | Footer Settings",
            'footer_settings' => $footer_settings
        ];

        return view('backend.settings.footer_settings', $data);

    }


    public function edit_get_a_quote_settings()
    {
        $get_a_quote = GetAQuote::find(1);
        $data = [
            'title' => " Distruptors | Get A Free Quote",
            'get_quote' => $get_a_quote
        ];

        return view('backend.settings.get_a_quote', $data);

    }


    public function update_get_a_quote_settings(Request $request, $id)
    {
        try {


            $validator = Validator::make($request->all(), [
                'get_a_quote_main_heading' => 'required',
                'get_a_quote_contnet' => 'required',
                'get_a_quote_anchor_text' => 'required',
                'get_a_quote_anchor_link' => 'required',
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
            $get_a_quote = GetAQuote::findOrFail($id);
            if ($request->filled('get_a_quote_main_heading')) {
                $get_a_quote->main_heading = $request->input('get_a_quote_main_heading');
            }
            if ($request->filled('get_a_quote_contnet')) {
                $get_a_quote->right_side_content = $request->input('get_a_quote_contnet');
            }

            if ($request->filled('get_a_quote_anchor_text')) {
                $get_a_quote->anchor_text = $request->input('get_a_quote_anchor_text');
            }
            if ($request->filled('get_a_quote_anchor_link')) {
                $get_a_quote->anchor_link = $request->input('get_a_quote_anchor_link');
            }

            $get_a_quote->save();
            return redirect()->route('get_a_quote')->with('message', 'Get A Quote Settings updated  Successfully');
        } catch (\Exception $e) {
            Log::error('Error updating header: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating header. Please try again.']);
        }
    }


    public function update_footer_settings(Request $request, $id)
    {
        try {


            $validator = Validator::make($request->all(), [
                'footer_left_side_heading' => 'required',
                'footer_left_side_address' => 'required',
                'footer_right_side_address' => 'required',
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
            $footer = FooterSettings::findOrFail($id);
            if ($request->filled('footer_left_side_heading')) {
                $footer->left_side_heading = $request->input('footer_left_side_heading');
            }
            if ($request->filled('footer_left_side_address')) {
                $footer->left_side_address = $request->input('footer_left_side_address');
            }

            if ($request->filled('footer_right_side_address')) {
                $footer->right_side_address = $request->input('footer_right_side_address');
            }

            $footer->save();
            return redirect()->route('edit_footer_settings')->with('message', 'Footer Settings updated  Successfully');
        } catch (\Exception $e) {
            Log::error('Error updating header: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating header. Please try again.']);
        }
    }


    public function header_settings(Request $request, $id)
    {
        try {
            $header = HeaderSettings::findOrFail($id);

            if ($request->filled('header_anchor_text')) {
                $header->header_right_side_anchor_text = $request->input('header_anchor_text');
            }
            if ($request->filled('header_anchor_link')) {
                $header->header_right_side_anchor_link = $request->input('header_anchor_link');
            }

            if ($request->hasFile('header_logo')) {
                $file = $request->file('header_logo');
                $filename = 'header_logos/' . $file->getClientOriginalName();
                $file->move(public_path('header_logos'), $filename);
                $header->header_logo = $filename;
            }

            $header->save();
            return response()->json(['success' => 'Header Settings Updated successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating header: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating header. Please try again.']);
        }
    }


    public function store_services_page_settings(Request $request, $id)
    {
        try {
            $servicepage = ServicesPage::findOrFail($id);

            if ($request->filled('services_page_main_heading')) {
                $servicepage->services_page_main_heading = $request->input('services_page_main_heading');
            }
            if ($request->filled('services_page_box_inner_content')) {
                $servicepage->services_page_box_inner_content = $request->input('services_page_box_inner_content');
            }

            if ($request->filled('services_page_second_section_main_heading')) {
                $servicepage->services_page_second_section_main_heading = $request->input('services_page_second_section_main_heading');
            }

            if ($request->filled('services_page_second_section_main_content')) {
                $servicepage->services_page_second_section_main_content = $request->input('services_page_second_section_main_content');
            }

            if ($request->hasFile('services_page_box_inner_image')) {
                $file = $request->file('services_page_box_inner_image');
                $filename = 'services_page_box_inner_image/' . $file->getClientOriginalName();
                $file->move(public_path('services_page_box_inner_image'), $filename);
                $servicepage->services_page_box_inner_image = $filename;
            }

            $servicepage->save();
            return redirect()->route('edit_service_page_settings')->with('message', 'Service Page updated  Successfully');
        } catch (\Exception $e) {
            Log::error('Error updating header: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating header. Please try again.']);
        }
    }
    
    
       public function create_social_media_links_cat(Request $request)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'add_social_media' => 'required',
               
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
          

            $data = [
                'social_media_cat_name' => $request->input('add_social_media'),
            

            ];

            SocialMediaCat::create($data);

            return redirect()->back();

        } else {
            $data = [
                'title' => " Distruptors | Social Media Link",

            ];
            return view('backend.settings.social_media.create-social-media', $data);

        }

    }


    public function social_media_links(Request $request)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'social_media_name' => 'required',
                'social_media_url' => 'required',
                'social_media_icon' => 'required'
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('social_media_icon')) {
                $file = $request->file('social_media_icon');
                $filename = 'social_media_icon/' . $file->getClientOriginalName();
                $file->move(public_path('social_media_icon'), $filename);

            }

            $data = [
                'social_media_link_name' => $request->input('social_media_name'),
                'social_media_link_url' => $request->input('social_media_url'),
                'social_media_icon' => $filename,
                'order' =>'15' ? : '1',


            ];

            SocialMedia::create($data);

            return response()->json(['success' => 'Social Media Link Created Successfully.'], 200);

        } else {
            $links =  SocialMediaCat::all();
            $data = [
                'title' => " Distruptors | Social Media Link",
                'links' =>$links

            ];
            return view('backend.settings.social_media.create', $data);

        }

    }


    public function list_social_media_links()
    {

        $socialMedia = SocialMedia::orderBy('order','ASC')->get();
        $data = [
            'title' => " Distruptors | List Social Media Links",
            'social_links' => $socialMedia,

        ];
        return view('backend.settings.social_media.list', $data);

    }


    public function edit_social_media(Request $request, $id)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'social_media_icon' => 'sometimes|image|mimes:jpeg,png,jpg,,svg,gif|max:2048',
                'social_media_name' => 'required',
                'social_media_url' => 'required'
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
            
               $socialmediaData = [
            'social_media_link_name' => $request->input('social_media_name'),
            'social_media_link_url' => $request->input('social_media_url')
        ];
            if ($request->hasFile('social_media_icon')) {
                $file = $request->file('social_media_icon');
                $filename = 'social_media_icon/' . $file->getClientOriginalName();
                $file->move(public_path('social_media_icon'), $filename);
                 $socialmediaData['social_media_icon'] = $filename;

            }

            // $socialmediaData = array(
            //     'social_media_link_name' => $request->input('social_media_name'),
            //     'social_media_icon' => $filename,
            //     'social_media_link_url' => $request->input('social_media_url')

            // );
            $socialmedia_id = SocialMedia::where('id', '=', $id)->update($socialmediaData);
            if ($socialmedia_id) {

                return redirect()->route('list_social_media_links')->with('message', 'Social Media Link  Updated successfully');
            }


        } else {

                $links =  SocialMediaCat::all();
            $social_media_icons = SocialMedia::find($id);
            $data = ['title' => "Distruptors | Edit Menu", 'edit_social_media' => $social_media_icons ,'links'=>$links];
            return view('backend.settings.social_media.edit', $data);

        }


    }


    public function delete_social_media($id)
    {

        $social_media = SocialMedia::find($id);
        $social_media->delete();
        return redirect()->route('list_social_media_links')->with('message', 'Social Media Link deleted successfully.');
    }


    public function create_featured_clients(Request $request)
    {

        if ($_POST) {


            $validator = Validator::make($request->all(), [
                'featured_clients' => 'required',
               
            ]);


            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }


            if ($request->hasFile('featured_clients')) {
                $file = $request->file('featured_clients');
                $filename = 'featured_clients/' . $file->getClientOriginalName();
                $file->move(public_path('featured_clients'), $filename);

            }
            $data = [
                'add_feature_clients' => $filename,
                'featured_link' => $request->input('featured_link') ? : "#",
                'order' =>'15' ? : '1',
            ];

            FeatureClients::create($data);
            return redirect()->route('featured_clients_list')->with('message', 'Featured Clients added Successfully');

            // return response()->json(['success' => 'Featured Clients Created Successfully.'], 200);

        } else {
            $data = [
                'title' => " Distruptors | Featured Clients",
                'sub_title' => 'Featured Clients'

            ];
            return view('backend.settings.featured_clients.create', $data);

        }


    }

    public function featured_clients_list()
    {

        $clients = FeatureClients::orderBy('order','ASC')->get();
        $data = [
            'title' => " Distruptors | List Featured Clients",
            'clients' => $clients,

        ];
        return view('backend.settings.featured_clients.list', $data);


    }

    public function delete_featuredclients($id)
    {

        $featured_clients = FeatureClients::find($id);
        $featured_clients->delete();
        return redirect()->route('featured_clients_list')->with('message', 'Featured Clients deleted successfully.');
    }


    public function edit_featured_clients(Request $request, $id)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'featured_clients' => 'sometimes|image|mimes:jpeg,png,jpg,,svg,gif|max:2048',
                
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

         $featuredclientsData = array(
                'featured_link' =>$request->input('featured_link') ? : "#"
            );
            if ($request->hasFile('featured_clients')) {
                $file = $request->file('featured_clients');
                $filename = 'featured_clients/' . $file->getClientOriginalName();
                $file->move(public_path('featured_clients'), $filename);
                $featuredclientsData['add_feature_clients'] =  $filename;

            }

          
            $featuredID = FeatureClients::where('id', '=', $id)->update($featuredclientsData);
            if ($featuredID) {

                return redirect()->route('featured_clients_list')->with('message', 'Featured Client  Updated successfully');
            }


        } else {

            $featured_clients = FeatureClients::find($id);
            $data = ['title' => "Distruptors | Edit Featured Clients", 'edit_featured_clients' => $featured_clients];
            return view('backend.settings.featured_clients.edit', $data);

        }


    }


    public function create_faqs(Request $request)
    {

        if ($_POST) {


            $validator = Validator::make($request->all(), [
                'question_ask' => 'required',
                'faq_answer' => 'required',
                'faq_category' => 'required'
            ]);


            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
            $data = [
                'question' => $request->input('question_ask'),
                'answer' => $request->input('faq_answer'),
                'category_id' => $request->input('faq_category'),
            ];

            FAQ::create($data);
            return redirect()->route('faqs_list')->with('message', 'FAQ`s Created Successfully');

            // return response()->json(['success' => 'Featured Clients Created Successfully.'], 200);

        } else {
            $faqs = FAQCategory::all();
            $data = [
                'title' => " Distruptors | FAQ`s",
                'faqs' => $faqs


            ];
            return view('backend.settings.faqs.create', $data);

        }


    }


    public function faqs_list()
    {

        $faqs = FAQ::all();
        $data = [
            'title' => " Distruptors | List FAQ`s",
            'faqs' => $faqs,

        ];
        return view('backend.settings.faqs.list', $data);

    }


    public function edit_faq(Request $request, $id)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'faq_category' => 'required',
                'question_ask' => 'required',
                'faq_answer' => 'required'
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

            $faq_Data = array(
                'category_id' => $request->input('faq_category'),
                'question' => $request->input('question_ask'),
                'answer' => $request->input('faq_answer'),
            );
            $faq_id = FAQ::where('id', '=', $id)->update($faq_Data);
            if ($faq_id) {

                return redirect()->route('faqs_list')->with('message', 'FAQ  Updated successfully');
            }


        } else {
            $faq_category = FAQCategory::all();
            $editfaq = FAQ::find($id);
            $data = ['title' => "Distruptors | Edit FAQ", 'edit_faq' => $editfaq, 'faqs' => $faq_category];
            return view('backend.settings.faqs.edit', $data);

        }


    }

    public function delete_Faq($id)
    {

        $faq = FAQ::find($id);
        $faq->delete();
        return redirect()->route('faqs_list')->with('message', 'FAQ deleted successfully.');
    }


    public function create_what_we_do(Request $request)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'what_we_do_title' => 'required',
                'what_we_do_content' => 'required',
                'what_we_do_main_image' => 'required',
                'frame_category' => 'required',
               
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('what_we_do_main_image')) {
                $file = $request->file('what_we_do_main_image');
                $filename = 'who_we_do/' . $file->getClientOriginalName();
                $file->move(public_path('who_we_do'), $filename);
            }
            
             if ($request->hasFile('add_feature_video')) {
                $file2 = $request->file('add_feature_video');
                $filename2 = 'who_we_do/' . $file2->getClientOriginalName();
                $file2->move(public_path('who_we_do'), $filename2);
            }
            
            


            $data = [
                'main_heading' => $request->input('what_we_do_title'),
                'excerpt' => $request->input('what_we_do_content'),
                'featured_image' => $filename,
                'category_id' => $request->input('frame_category'),
                'order' =>'15' ? : '1',
                'enter_link'=>$request->input('enter_link') ? : '#'
            ];

            Whatwedo::create($data);


            return redirect()->route('what_We_do_list')->with('message', 'Frame Created Successfully');

        } else {
            $frame_categories = FrameCategory::all();
            $data = [
                'title' => " Distruptors | Frames Section",
                'frames' => $frame_categories

            ];
            return view('backend.settings.whatwedo.create', $data);

        }

    }


    public function what_We_do_list()
    {

        $what_we_do = Whatwedo::orderBy('order','ASC')->get();
        $data = [
            'title' => " Distruptors | List Frame Section",
            'records' => $what_we_do,

        ];
        return view('backend.settings.whatwedo.list', $data);

    }


    public function edit_whowedo(Request $request, $id)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'frame_category' => 'required',
                'what_we_do_title' => 'required',
                'what_we_do_content' => 'required',
                'what_we_do_main_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
              $whowedo_data = array(
                'category_id' => $request->input('frame_category'),
                'main_heading' => $request->input('what_we_do_title'),
                'excerpt' => $request->input('what_we_do_content'),
                'enter_link' =>$request->input('enter_link') ? : '#'
               
            );

            if ($request->hasFile('what_we_do_main_image')) {
                $file = $request->file('what_we_do_main_image');
                $filename = 'who_we_do/' . $file->getClientOriginalName();
                $file->move(public_path('who_we_do'), $filename);
                $whowedo_data['featured_image'] =  $filename;
            }
            
            //  if ($request->hasFile('add_feature_video')) {
            //     $file2 = $request->file('add_feature_video');
            //     $filename2 = 'who_we_do/' . $file2->getClientOriginalName();
            //     $file2->move(public_path('who_we_do'), $filename2);
            // }
          
            $whowedo_dataID = Whatwedo::where('id', '=', $id)->update($whowedo_data);
            if ($whowedo_dataID) {

                return redirect()->route('what_We_do_list')->with('message', 'Frame  Updated successfully');
            }
        } else {
            $frames = FrameCategory::all();
            $edit = Whatwedo::find($id);
            $data = ['title' => "Distruptors | Edit Frame", 'edit' => $edit, 'frames' => $frames];
            return view('backend.settings.whatwedo.edit', $data);

        }


    }


    public function delete_what_we_do($id)
    {

        $what_we_do = Whatwedo::find($id);
        $what_we_do->delete();
        return redirect()->route('what_We_do_list')->with('message', 'Frames  deleted successfully.');
    }


    public function create_gallery(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'add_gallery_video' => 'required|file|max:20480',
                  // Adjust validation rule accordingly
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $filename = null;

            if ($request->hasFile('add_gallery_video')) { // Update to match your form input name
                $file = $request->file('add_gallery_video'); // Update to match your form input name
                $filename = 'galleries/' . $file->getClientOriginalName();
                $file->move(public_path('galleries'), $filename);
            }

            $data = [
                'add_gallery_video' => $filename,
                'gallery_link' => $request->input('gallery_link') ? : '#',
                'order' =>'15' ? : '1',
            ];

            Gallery::create($data);
            return redirect()->route('list_gallery')->with('message', 'Gallery Created Successfully');
        } else {
            $data = [
                'title' => " Distruptors | Gallery",
            ];
            return view('backend.settings.gallery.create', $data);
        }
    }
    
    
    public function edit_gallery(Request $request, $id)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'add_gallery_video' => 'sometimes|max:2048',
                 
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

            // $filename = null;

            if ($request->hasFile('add_gallery_video')) { // Update to match your form input name
                $file = $request->file('add_gallery_video'); // Update to match your form input name
                $filename = 'galleries/' . $file->getClientOriginalName();
                $file->move(public_path('galleries'), $filename);
            }
            
            $data = [
                'add_gallery_video' => $filename,
                'gallery_link' => $request->input('gallery_link') ? : '#',
            ];
            
            
            $gallery_id = Gallery::where('id', '=', $id)->update($data);
            if ($gallery_id) {

                return redirect()->route('list_gallery')->with('message', 'Gallery  Updated successfully');
            }
        } else {
            
            $edit = Gallery::find($id);
            $data = ['title' => "Distruptors | Edit Gallery",'edit'=>$edit];
            return view('backend.settings.gallery.edit', $data);

        }


    }


    public function list_gallery()
    {

        $gallries = Gallery::orderBy('order','ASC')->get();
        $data = [
            'title' => " Distruptors | List Gallery",
            'gallries' => $gallries,

        ];
        return view('backend.settings.gallery.list', $data);

    }

    public function destroy_gallery_video($id)
    {

        $gallery = Gallery::find($id);
        $gallery->delete();
        return redirect()->route('list_gallery')->with('message', 'Gallery video deleted successfully.');
    }


    public function create_menu_manager(Request $request)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'menu_category' => 'required',
                'menu_name' => 'required',
                'menu_link' => 'required'
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

            $data = [
                'category_id' => $request->input('menu_category'),
                'menu_name' => $request->input('menu_name'),
                'menu_link' => $request->input('menu_link'),
                'order' =>'15' ? : '1',
            ];

            MenuManager::create($data);


            return redirect()->route('list_menu_manager')->with('message', 'Menu Created Successfully');

        } else {

            $categories = MenuCategory::all();
            $data = [
                'title' => " Distruptors | Menu Manager",
                'categories' => $categories

            ];
            return view('backend.settings.menu_manager.create', $data);

        }

    }


    public function edit_menu_manager(Request $request, $id)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'menu_category' => 'required',
                'menu_name' => 'required',
                'menu_link' => 'required'
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
            $editMenuData = array(
                'category_id' => $request->input('menu_category'),
                'menu_name' => $request->input('menu_name'),
                'menu_link' => $request->input('menu_link')
            );
            $menumanager_id = Menumanager::where('id', '=', $id)->update($editMenuData);
            if ($menumanager_id) {

                return redirect()->route('list_menu_manager')->with('message', 'Menu  Updated successfully');
            }


        } else {
            $categories = MenuCategory::all();
            $edit_menu = MenuManager::find($id);
            $data = ['title' => "Distruptors | Edit Menu", 'edit_menu' => $edit_menu, 'categories' => $categories];
            return view('backend.settings.menu_manager.edit', $data);

        }


    }


    public function list_menu_manager()
    {

        $menus = MenuManager::orderBy('order','ASC')->get();
        $data = [
            'title' => " Distruptors | List Menu Manager",
            'menus' => $menus,

        ];
        return view('backend.settings.menu_manager.list', $data);

    }

    public function delete_menu_manager($id)
    {

        $menu_manager = MenuManager::find($id);
        $menu_manager->delete();
        return redirect()->route('list_menu_manager')->with('message', 'Menu deleted successfully.');
    }


    public function create_work_portolios(Request $request)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'project_name' => 'required',
                'project_categories' => 'required',
                'overview_content' => 'required',
                'teams' => 'required',
                'feature_image' => 'required',
                'project_gallery_images' => 'required',
                'tags' => 'required'
            ]);
           $tags = []; // Initialize an array to store tags
            $teams= [];
                foreach ($request->input('teams') as $team) {
                    $teams[] = $team;
                }
                
                $team_string = implode(', ', $teams);


                foreach ($request->input('tags') as $tag) {
                    $tags[] = $tag;
                }
                
                $tagString = implode(', ', $tags);


            $portfolioCategories = $request->input('project_categories');
            $categoryIds = [];
            foreach ($portfolioCategories as $categoryId) {
                $categoryIds[] = $categoryId;
            }


            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

            $slug = Str::slug($request->input('project_name'));


            if ($request->hasFile('feature_image')) {
                $file = $request->file('feature_image');
                $filename = 'portfolios/' . $file->getClientOriginalName();
                $file->move(public_path('portfolios'), $filename);

            }

            $data = [
                'portfolio_name' => $request->input('project_name'),
                'portfolio_slug' => $slug,
                'portfolio_image' => $filename,
                'overview_description' => $request->input('overview_content'),
                'team_description' => $team_string,
                'portfolio_tags' => $tagString,
                'order' => 2
            ];

            $portfolio = Porfolios::create($data);
            $portfolioCategories = $request->input('project_categories');
            $categoryIds = [];
            foreach ($portfolioCategories as $categoryId) {
                $categoryIds[] = $categoryId;
            }
            $portfolio->category_id = implode(',', $categoryIds);
            $portfolio->save();
            $images = [];
            if ($request->hasFile('project_gallery_images')) {
                foreach ($request->file('project_gallery_images') as $image) {
                    // Save image to the filesystem
                    $filename = 'project_gallery_images/' . $image->getClientOriginalName();
                    $path = $image->move(public_path('project_gallery_images'), $filename);


                    $imageRecord = new Portfolio_Images();
                    $imageRecord->portfolio_id = $portfolio->id;
                    $imageRecord->portfolio_images = $filename;
                    $imageRecord->save();
                }
            }

            return redirect()->route('list_work_projects')->with('message', 'Project Created Successfully');

        } else {

            $projects_categories = Portfolio_Category::all();
            $data = [
                'title' => " Distruptors | Projects",
                'projects_categories' => $projects_categories

            ];
            return view('backend.pages.work.create', $data);

        }

    }
    
    
    
    public function update_work_portfolios(Request $request, $id)
{
    $portfolio = Porfolios::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'project_name' => 'required',
        'project_categories' => 'required',
        'overview_content' => 'required',
        'feature_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        'project_gallery_images.*' => 'required', // Add wildcard for multiple images
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    
    
                $teams= [];
                foreach ($request->input('teams') as $team) {
                    $teams[] = $team;
                }
                $team_string = implode(', ', $teams);
    
        foreach ($request->input('tags') as $tag) {
                    $tags[] = $tag;
                }
                
                $tagString = implode(', ', $tags);

    $slug = Str::slug($request->input('project_name'));


    // Upload and save feature image
    if ($request->hasFile('feature_image')) {
        $file = $request->file('feature_image');
        $filename = 'portfolios/' . $file->getClientOriginalName();
        $file->move(public_path('portfolios'), $filename);
        $portfolio->portfolio_image = $filename;
    }   

    // Update portfolio details
    $portfolio->portfolio_name = $request->input('project_name');
    $portfolio->portfolio_slug = $slug;
    $portfolio->overview_description = $request->input('overview_content');
    $portfolio->team_description = $team_string;
    $portfolio->category_id = implode(',', $request->input('project_categories'));
    $portfolio->portfolio_tags = $tagString;
    $portfolio->save();

    // Save project gallery images
    if ($request->hasFile('project_gallery_images')) {
        foreach ($request->file('project_gallery_images') as $image) {
            $filename = 'project_gallery_images/' . $image->getClientOriginalName();
            $path = $image->move(public_path('project_gallery_images'), $filename);

            $imageRecord = new Portfolio_Images();
            $imageRecord->portfolio_id = $portfolio->id;
            $imageRecord->portfolio_images = $filename;
            $imageRecord->save();
        }
    }

    return redirect()->route('list_work_projects')->with('message', 'Project Updated Successfully');
}



    public function list_work_projects()
    {

        $projects_categories = Portfolio_Category::all();
        $projects = Porfolios::orderBy('order','ASC')->get();
        $data = [
            'title' => " Distruptors | List Projects",
            'projects' => $projects,
            'projects_categories' => $projects_categories

        ];
        return view('backend.pages.work.list', $data);

    }
    
    
     public function list_work_project_cateogories()
    {

        $projects_categories = Portfolio_Category::all();
        $data = [
            'title' => " Distruptors | List Project Categories",
            'projects_categories' => $projects_categories

        ];
        return view('backend.pages.work.list-project-categories', $data);

    }

    public function getPortfolioImages($portfolioId)
    {


        $images = Portfolio_Images::where('portfolio_id', $portfolioId)->get();
        return response()->json($images);
    }
    
       public function create_project_categories(Request $request)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'category_name' => 'required',
               
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
          

            $data = [
                'category_name' => $request->input('category_name'),
            

            ];

            Portfolio_Category::create($data);

            return redirect()->route('list_work_projects')->with('message', 'Project Category added Successfully');

        } else {
            $data = [
                'title' => " Distruptors | Add Project Category",

            ];
            return view('backend.pages.work.create-project-category', $data);

        }

    }


    public function update_contact_page_settings(Request $request, $id)
    {
        try {
            $contact = ContactPage::findOrFail($id);

            if ($request->filled('contact_page_main_heading')) {
                $contact->main_heading = $request->input('contact_page_main_heading');
            }
            if ($request->filled('contact_page_content')) {
                $contact->text_content = $request->input('contact_page_content');
            }
            $contact->save();
            return redirect()->route('view_contact_page')->with('message', 'Contact Page Settings Updated Successfully');
        } catch (\Exception $e) {
            Log::error('Error updating header: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating header. Please try again.']);
        }
    }


    public function contact_page()
    {

        $contactpage = ContactPage::find(1);
        $data = [

            'title' => "Distruptors | Edit Contact Page",
            'contact' => $contactpage
        ];

        return view('backend.pages.contact.contactpage', $data);
    }


    public function update_home_page_settings(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'section_one_main_haading' => 'required',
            'section_one_sub_heading' => 'required',
            'section_one_button_text' => 'required',
            'section_one_button_url' => 'required',
            'section_two_box_text' => 'required',
            'section_three_main_heading' => 'required',
            'section_four_main_heading' => ' required',
            'youtube_embed_code' => 'required'
        ]);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }


        try {
            $homepage_settings = HomePageSettings::findOrFail($id);

            if ($request->filled('section_one_main_haading')) {
                $homepage_settings->section_one_main_heading = $request->input('section_one_main_haading');
            }
            if ($request->filled('section_one_sub_heading')) {
                $homepage_settings->section_one_sub_heading = $request->input('section_one_sub_heading');
            }

            if ($request->filled('section_one_button_text')) {
                $homepage_settings->section_one_button_text = $request->input('section_one_button_text');
            }
            if ($request->filled('section_one_button_url')) {
                $homepage_settings->section_one_button_link = $request->input('section_one_button_url');
            }

            if ($request->filled('section_two_box_text')) {
                $homepage_settings->section_two_box_text = $request->input('section_two_box_text');
            }

            if ($request->filled('section_three_main_heading')) {
                $homepage_settings->section_three_main_heading = $request->input('section_three_main_heading');
            }

            if ($request->filled('section_four_main_heading')) {
                $homepage_settings->section_four_main_heading = $request->input('section_four_main_heading');
            }

            if ($request->filled('youtube_embed_code')) {
                $homepage_settings->embed_code = $request->input('youtube_embed_code');
            }
            $homepage_settings->save();
            return redirect()->route('view_home_page')->with('message', 'HomePage Settings Updated Successfully');
        } catch (\Exception $e) {
            Log::error('Error updating header: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating header. Please try again.']);
        }
    }


    public function home_page()
    {

        $homepage = HomePageSettings::find(1);
        $data = [

            'title' => "Distruptors | Edit Home Page",
            'homepage' => $homepage
        ];

        return view('backend.pages.homepagesettings.updatehomepagesettings', $data);
    }


    public function create_about(Request $request)
    {
        if ($request->isMethod('post')) {
         

        

            $about_embed_code = AboutEmbedCode::findOrFail(1);

            if ($request->hasFile('poster_image')) {
                $file = $request->file('poster_image');
                $filename = time() . '_' . $file->getClientOriginalName(); // Add timestamp for uniqueness
                $file->move(public_path('header_logos'), $filename);
            
                // Store the path in the database
                $about_embed_code->poster_picture = 'header_logos/' . $filename;
            }


            if ($request->hasFile('poster_video')) {
                $file = $request->file('poster_video');
                $filename = time() . '_' . $file->getClientOriginalName(); // Add timestamp for uniqueness
                $file->move(public_path('header_logos'), $filename);
            
                // Store the path in the database
                $about_embed_code->poster_video = 'header_logos/' . $filename;
            }
            
            
            // Save the updated embed code
            $about_embed_code->save();

            foreach ($request->input('about_texts') as $text) {
                AboutPage::create([
                    'about_text' => $text
                ]);
            }


            return redirect()->route('create_about_us')->with('message', 'About Texts Generated Successfully');
        } else {
            $data = [
                'title' => " Distruptors | About us",
            ];
            return view('backend.pages.about.editabout', $data);
        }
    }

    public function update_about_us()
    {
        $abouttexts =  AboutPage::all();
        $data = array('title'=>'Distruptors | Edit About Page','entries' => $abouttexts);
        return  view('backend.pages.about.updateabout',$data);
    }


    public function store_update_about_us(Request $request)
    {

        $ids = $request->input('ids');
        $texts = $request->input('about_texts');

        $about_embed_code = AboutEmbedCode::findOrFail(1);

        if ($request->hasFile('poster_image')) {
            $file = $request->file('poster_image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Add timestamp for uniqueness
            $file->move(public_path('header_logos'), $filename);
        
            // Store the path in the database
            $about_embed_code->poster_picture = 'header_logos/' . $filename;
        }


        if ($request->hasFile('poster_video')) {
            $file = $request->file('poster_video');
            $filename = time() . '_' . $file->getClientOriginalName(); // Add timestamp for uniqueness
            $file->move(public_path('header_logos'), $filename);
        
            // Store the path in the database
            $about_embed_code->poster_video = 'header_logos/' . $filename;
        }
        
        
        // Save the updated embed code
        $about_embed_code->save();


        if ($ids !== null && $texts !== null) {
            foreach ($ids as $index => $id) {
                $textEntry = AboutPage::findOrFail($id);
                $textEntry->update([
                    'about_text' => $texts[$index]
                ]);
            }
            return redirect()->route('create_about_us')->with('message', 'Text entries updated successfully.');
        } else {

            return redirect()->back()->with('error', 'IDs or texts are missing.');
        }
    }

    public function deleteEntry($id)
    {
       
        $entry = AboutPage::findOrFail($id);
        $entry->delete();
    
    
            return response()->json(['success' => true, 'message' => 'Entry deleted successfully.']);
       
    }
    
    public function edit_projects($id)
    {
         $projects_categories = Portfolio_Category::all();
        $projects = Porfolios::find($id);
        $data = [
            'title' => " Distruptors | Edit Project",
            'project' => $projects,
            'projects_categories'=>$projects_categories
        ];

        return view('backend.pages.work.edit', $data);

    }
     public function delete_project($id)
    {

        $project = Porfolios::find($id);
        $project->delete();
        return redirect()->route('list_work_projects')->with('message', 'Project deleted successfully.');
    }
    
      public function delete_project_category($id)
    {

        $project = Portfolio_Category::find($id);
        $project->delete();
        return redirect()->route('list_work_project_cateogories')->with('message', 'Project Category deleted successfully.');
    }

 public function delete_img($id)
    {
        $project_img = Portfolio_Images::find($id);
        $project_img->delete();
         return redirect()->back();
    }
    
    public function updateOrder(Request $request)
        {
            $orderData = $request->input('order');

            // Validate $orderData if necessary

            try {
                foreach ($orderData as $item) {
                    $task = MenuManager::findOrFail($item['id']);
                    $task->update(['order' => $item['position']]);
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        
            public function updateOrder_social_media(Request $request)
        {
            $orderData = $request->input('order');

            // Validate $orderData if necessary

            try {
                foreach ($orderData as $item) {
                    $task = SocialMedia::findOrFail($item['id']);
                    $task->update(['order' => $item['position']]);
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        
             public function sortabledatatable_featured_clients(Request $request)
        {
            $orderData = $request->input('order');

            // Validate $orderData if necessary

            try {
                foreach ($orderData as $item) {
                    $task = FeatureClients::findOrFail($item['id']);
                    $task->update(['order' => $item['position']]);
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        
               public function sortabledatatable_faqs(Request $request)
        {
            $orderData = $request->input('order');

            // Validate $orderData if necessary

            try {
                foreach ($orderData as $item) {
                    $task = FAQ::findOrFail($item['id']);
                    $task->update(['order' => $item['position']]);
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        
        public function sortabledatatable_frames(Request $request)
        {
            $orderData = $request->input('order');
      
            // Validate $orderData if necessary

            try {
                foreach ($orderData as $item) {
                    $task = Whatwedo::findOrFail($item['id']);
                    $task->update(['order' => $item['position']]);
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        
        
         public function sortabledatatable_gallries(Request $request)
        {
            $orderData = $request->input('order');
      
            try {
                foreach ($orderData as $item) {
                    $task = Gallery::findOrFail($item['id']);
                    $task->update(['order' => $item['position']]);
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        
           public function sortabledatatable_projects(Request $request)
        {
            $orderData = $request->input('order');
      
            try {
                foreach ($orderData as $item) {
                    $task = Porfolios::findOrFail($item['id']);
                    $task->update(['order' => $item['position']]);
                }

                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
        
        
        
         public function create_seo_script(Request $request)
    {

        if ($_POST) {


            $validator = Validator::make($request->all(), [
                'google_search_console' => 'required',
                'google_analytics' => 'required',
               
            ]);


            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }
            $data = [
                'google_search_console' => $request->input('google_search_console'),
                'google_analytics' => $request->input('google_analytics'),
               
            ];

            SeoModel::create($data);
            return redirect()->route('seo_script_list')->with('message', ' Seo Script Created Successfully');

            // return response()->json(['success' => 'Featured Clients Created Successfully.'], 200);

        } else {
            
            $data = [
                'title' => " Distruptors | Add Seo Script",
                


            ];
            return view('backend.seo.create', $data);

        }


    }
    
      public function seo_script_list()
    {

        $scripts = SeoModel::all();
        $data = [
            'title' => " Distruptors | List Seo Scripts",
            'scripts' => $scripts,

        ];
        return view('backend.seo.list', $data);

    }
    
        public function edit_seo_script(Request $request, $id)
    {

        if ($_POST) {

           $validator = Validator::make($request->all(), [
                'google_search_console' => 'required',
                'google_analytics' => 'required',
               
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

             $data = [
                'google_search_console' => $request->input('google_search_console'),
                'google_analytics' => $request->input('google_analytics'),
               
            ];
            $script_id = SeoModel::where('id', '=', $id)->update($data);
            if ($script_id) {

                return redirect()->route('seo_script_list')->with('message', 'Seo Script  Updated successfully');
            }

        } else {
            
            $edit_script = SeoModel::find($id);
            $data = ['title' => "Distruptors | Edit Seo Script", 'edit_script' => $edit_script];
            return view('backend.seo.edit', $data);

        }


    }
    
      public function delete_seo_scripts($id)
    {

        $script = SeoModel::find($id);
        $script->delete();
        return redirect()->route('seo_script_list')->with('message', 'Seo Script deleted successfully.');
    }
    
    
    
    
          public function update_website_meta(Request $request, $id){

        if ($_POST) {

                    $data = [
                       
                        'home_meta_title' => $request->input('homepage_meta_title'),
                        'home_meta_description' => $request->input('home_meta_description'),
                        'work_meta_title' => $request->input('work_meta_title'),
                        'work_meta_description' => $request->input('work_meta_description'),
                        'services_meta_title' => $request->input('services_meta_title'),
                        'services_meta_description' => $request->input('services_meta_description'),
                        'about_meta_title' => $request->input('about_meta_title'),
                        'about_meta_description' => $request->input('about_meta_description'),
                        'gallery_meta_title' => $request->input('gallery_meta_title'),
                        'gallery_meta_description' => $request->input('gallery_meta_description'),
                        'faq_meta_title' => $request->input('faq_meta_title'),
                        'faq_meta_description' => $request->input('faq_meta_description'),
                        'contact_meta_title' => $request->input('contact_meta_title'),
                        'contact_meta_description' => $request->input('contact_meta_description'),
                        'podcast_meta_title' => $request->input('podcast_meta_title'),
                        'podcast_meta_description' => $request->input('podcast_meta_description')
                    ];

            $website_meta_id = WebsiteMeta::where('id', '=', $id)->update($data);
            if ($website_meta_id) {

                return redirect()->route('edit_website_meta')->with('message', 'Website Meta  Updated successfully');
            }

        } 

    }
    
      public function edit_website_meta()
    {  
            $edit_website_meta = WebsiteMeta::find(1);
            $data = ['title' => "Distruptors | Edit Website Meta", 'edit_website_meta' => $edit_website_meta];
            return view('backend.meta.pages-meta', $data);

    }




    public function create_podcast_video(Request $request)
    {
        if ($request->isMethod('post')) {  
    
            $request->validate([
                'video_title' => 'required',
                'podcast_poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Poster must be an image (optional), max 10MB
                'podcast_video' => 'required|file|mimes:mp4,mov,avi,mkv|max:512000',    // Video file validation, max 50MB
            ]);
    
            $posterPath = null; 
            $videoPath = null;  
    
            if ($request->hasFile('podcast_poster')) {
                $file = $request->file('podcast_poster');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('podcast_posters'), $filename); 
                $posterPath = 'podcast_posters/' . $filename;  
            }
    
            // Handle the podcast video upload
            if ($request->hasFile('podcast_video')) {
                $file = $request->file('podcast_video');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('podcast_videos'), $filename); 
                $videoPath = 'podcast_videos/' . $filename; 
            }
    
            Podcast::create([
                'video_title' => $request->video_title,
                'video_url' => $videoPath,      
                'video_poster' => $posterPath,  
            ]);
    
            return redirect()->route('podcast_video_lists')->with('message', 'Podcast Created Successfully');
    
        } else {
            // GET request, show the form
            $data = [
                'title' => "Disruptors | Podcast",
            ];
            return view('backend.pages.podcast.podcast-create', $data);
        }
    }
    


    

    public function podcasts_lists()
    {

        $podcasts = Podcast::all();
        $data = [
            'title' => " Distruptors | List Podcasts",
            'podcasts' => $podcasts,

        ];
        return view('backend.pages.podcast.podcast-list', $data);

    }





    public function update_podcast_video(Request $request, $id)
    {
        // Fetch the existing podcast by ID
        $podcast = Podcast::findOrFail($id);
        if ($request->isMethod('post')) {  
            $request->validate([
                'video_title' => 'required',
                'podcast_poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Optional, max 10MB
                'podcast_video' => 'nullable|file|mimes:mp4,mov,avi,mkv|max:512000',    // Optional, max 50MB
            ]);
    
            $posterPath = $podcast->video_poster; // Retain the existing poster path
            $videoPath = $podcast->video_url;     // Retain the existing video path
    
            if ($request->hasFile('podcast_poster')) {
                $file = $request->file('podcast_poster');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('podcast_posters'), $filename);
                $posterPath = 'podcast_posters/' . $filename;
    
                // Optionally delete the old poster if it exists
                if ($podcast->video_poster && file_exists(public_path($podcast->video_poster))) {
                    unlink(public_path($podcast->video_poster));
                }
            }
    
            // Update the podcast video if a new file is uploaded
            if ($request->hasFile('podcast_video')) {
                $file = $request->file('podcast_video');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('podcast_videos'), $filename);
                $videoPath = 'podcast_videos/' . $filename;
    
                // Optionally delete the old video if it exists
                if ($podcast->video_url && file_exists(public_path($podcast->video_url))) {
                    unlink(public_path($podcast->video_url));
                }
            }
    
            // Update the podcast record
            $podcast->update([
                'video_title' => $request->video_title,
                'video_url' => $videoPath,
                'video_poster' => $posterPath,
            ]);
    
            return redirect()->route('podcast_video_lists')->with('message', 'Podcast Updated Successfully');
        } else {
            // GET request, show the update form
            $data = [
                'title' => "Update Podcast",
                'podcast' => $podcast,
            ];
            return view('backend.pages.podcast.edit-podcast', $data);
        }
    }
    




    
    public function delete_podcast_video($id)
    {

        $podcast = Podcast::find($id);
        $podcast->delete();
        return redirect()->route('podcast_video_lists')->with('message', 'Podcast Video deleted successfully.');
    }
    


    
    public function view_podcast_content_page()
    {

        $podcastcontent_page = PodcastContent::find(1);
        $data = [

            'title' => "Distruptors | Edit Podcast Content Page",
            'podcast_content' => $podcastcontent_page
        ];

        return view('backend.pages.podcast.podcast-content', $data);
    }


    public function update_podcast_content(Request $request, $id)
    {
        try {
            $podcast_content = PodcastContent::findOrFail($id);

            if ($request->filled('podcast_page_content')) {
                $podcast_content->description = $request->input('podcast_page_content');
            }
          
            $podcast_content->save();
            return redirect()->route('view_podcast_content')->with('message', 'Podcast Content Page Settings Updated Successfully');
        } catch (\Exception $e) {
            Log::error('Error updating header: ' . $e->getMessage());
            return back()->with(['error' => 'Error updating header. Please try again.']);
        }
    }





    
    public function create_studio_work(Request $request)
    {

        if ($_POST) {

            $validator = Validator::make($request->all(), [
                'studio_name' => 'required',
                'studio_location' => 'required',
                'studio_pricing' => 'required',
                'book_now_link' => 'required',
                'studio_message_us_link' => 'required',
                'about_this_space_content'=>'required',
                'feature_image' => 'required',
                'studio_gallery_images' => 'required',
               
            ]);

            if ($validator->fails()) {

                return back()->withErrors($validator)->withInput();
            }

            $slug = Str::slug($request->input('project_name'));


            if ($request->hasFile('feature_image')) {
                $file = $request->file('feature_image');
                $filename = 'studios/' . $file->getClientOriginalName();
                $file->move(public_path('studios'), $filename);

            }

            $data = [
                'studio_title' => $request->input('studio_name'),
                'location' => $request->input('studio_location'),
                'feature_image' => $filename,
                'about_content' => $request->input('about_this_space_content'),
                'pricing_text' => $request->input('studio_pricing'),
                'booking_action_link' => $request->input('book_now_link'),
                'message_us_link' => $request->input('studio_message_us_link')
            ];

            $studio = Studio::create($data);
         
            $images = [];
            if ($request->hasFile('studio_gallery_images')) {
                foreach ($request->file('studio_gallery_images') as $image) {
                    // Save image to the filesystem
                    $filename = 'studio_gallery_images/' . $image->getClientOriginalName();
                    $path = $image->move(public_path('studio_gallery_images'), $filename);


                    $imageRecord = new StudioGallery();
                    $imageRecord->studio_id = $studio->id;
                    $imageRecord->image = $filename;
                    $imageRecord->save();
                }
            }

            return redirect()->route('list_studios')->with('message', 'Studio Created Successfully');

        } else {

         
            $data = [
                'title' => " Distruptors | Studios",

            ];
            return view('backend.pages.studio.studio-create', $data);

        }

    }
    


    public function list_studios()
    {

      
        $studios = Studio::all();
        $data = [
            'title' => " Distruptors | List Studios",
            'studios' => $studios,
            

        ];
        return view('backend.pages.studio.studio-list', $data);

    }



    public function edit_studio($id)
    {
        
        $studio = Studio::find($id);
        $data = [
            'title' => " Distruptors | Edit Studio" .$id,
            'studio' => $studio,
           
        ];

        return view('backend.pages.studio.studio-edit', $data);

    }


    public function delete_studio_img($id)
    {
        $studio_img = StudioGallery::find($id);
        $studio_img->delete();
         return redirect()->back();
    }


    public function update_work_studios(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'studio_name' => 'required',
            'studio_location' => 'required',
            'studio_pricing' => 'required',
            'book_now_link' => 'required',
            'studio_message_us_link' => 'required',
            'about_this_space_content'=>'required',
           
           
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        
        // Upload and save feature image
        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $filename = 'studios/' . $file->getClientOriginalName();
            $file->move(public_path('studios'), $filename);
            $studio->feature_image = $filename;
        }   
    
        // Update portfolio details
        $studio->studio_title = $request->input('studio_name');
        $studio->location = $request->input('studio_location');
        $studio->about_content = $request->input('about_this_space_content');
        $studio->pricing_text = $request->input('studio_pricing');
        $studio->booking_action_link = $request->input('book_now_link');
        $studio->message_us_link = $request->input('studio_message_us_link');
        $studio->save();
    
        // Save project gallery images
        if ($request->hasFile('studio_gallery_images')) {
            foreach ($request->file('studio_gallery_images') as $image) {
                $filename = 'studio_gallery_images/' . $image->getClientOriginalName();
                $path = $image->move(public_path('studio_gallery_images'), $filename);
    
                $imageRecord = new StudioGallery();
                $imageRecord->studio_id = $studio->id;
                $imageRecord->image = $filename;
                $imageRecord->save();
            }
        }
    
        return redirect()->route('list_studios')->with('message', 'Studio Updated Successfully');
    }
    


    public function delete_studio($id)
    {

        $studio = Studio::find($id);
        $studio->delete();
        return redirect()->route('list_studios')->with('message', 'Studio deleted successfully.');
    }
        
   
}
