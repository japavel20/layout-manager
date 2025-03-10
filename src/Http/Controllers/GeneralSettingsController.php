<?php

namespace Layout\Manager\Http\Controllers;

use finfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Layout\Manager\Models\GeneralSetting;

class GeneralSettingsController extends Controller
{
    private $setups = [
        "title"                         => "Title",
        "favicon"                       => "Favicon",
        "header-logo"                   => "Header Logo",
        "login-logo"                    => "Login Logo",
        "myaccount"                     => "My Account Image",
        "left-bg"                       => "Login Reg Left Backgroud",
        "client"                        => "Client",
        "tech-partner"                  => "Technology Patner",
        "tech-partner-url"              => "Technology Patner Url",
        "is-register-visible"           => "Is Register Visible",
        "second-login-screen"           => "Activate Second Login Screen",
        "app-dashboard"                 => "App Dashboard",
        "loader-text"                   => "Loader Text",
    ];

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 if not specified
        $setups = GeneralSetting::latest()->paginate($perPage);

        //$setups = GeneralSetting::orderBy('created_at', 'desc')->get();
        return view('layout::general-settings.index', compact('setups'));
    }

    public function create()
    {
        return view('layout::general-settings.create', [
            "setups"    => $this->setups
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(GeneralSetting::rules());
        try 
        {
            $setup = GeneralSetting::create([
                            'key'           => $request->key,
                            'value'         => $request->value,
                            'path'          => $request->path,
                        ]);

            if (!$setup)
                throw new Exception("Unable to create setup", 400);

            return redirect()->route('general-settings.index')->withSuccess("Organization Setup created SuccessFully");
        } 
        catch (Exception $e) 
        {
            return redirect()->route('general-settings.index')->withErrors($e->getMessage());
        }
    }

    public function show(GeneralSetting $setup)
    {
        try 
        {
            return view('layout::general-settings.show', compact('setup'));
            
        } 
        catch (Exception $e) 
        {
            return redirect()->route('general-settings.index')->withErrors($e->getMessage());
        }
    }

    public function edit(GeneralSetting $setup)
    {
        try 
        {
            return view('layout::general-settings.edit',[
                "setupOptions" => $this->setups,
                "setup"  => $setup
            ]);
            
        } 
        catch (Exception $e) 
        {
            return redirect()->route('general-settings.index')->withErrors($e->getMessage());
        }
    }

    public function update(Request $request, GeneralSetting $setup)
    {
        $request->validate(GeneralSetting::rules($setup->id));        
        try 
        {
            $setup = $setup->update([
                            'key'           => $request->key,
                            'value'         => $request->value,
                            'path'          => $request->path,
                            'updated_at'    => now(),
                        ]);
            if (!$setup)
                throw new Exception("Unable to update Organization Setup", 400);

            return redirect()->route('general-settings.index')->withSuccess("Organization Setup updated SuccessFully");
        } 
        catch (Exception $e) 
        {
            return redirect()->route('general-settings.index')->withErrors($e->getMessage());
        }
    }

    public function destroy(GeneralSetting $setup)
    {
        try 
        {
            Storage::delete('public/'.substr($setup->value, strpos($setup->value, '/')+1));
            
            $setup_delete = $setup->delete();

            if (!$setup_delete)
                throw new Exception("Unable to delete Organization Setup", 404);
          
            return redirect()->route('general-settings.index')->withSuccess("Organization Setup deleted SuccessFully");
            
        } 
        catch (Exception $e) 
        {
            return redirect()->route('general-settings.index')->withErrors($e->getMessage());
        }
    }

    public function upload_image(Request $request)
    {
        try {  
            $base64_image = $request->input('image_b64');
            $setup_id = $request->input('setup_id');
            $unlink = $request->input('unlink');

            if (!$base64_image) {
                throw new Exception("Image is required", 404);
            }

            if (!empty($base64_image) && $unlink) {
                $setup_data = DB::table('general_settings')->where('id', $setup_id)->first();
                
                if ($setup_data && !empty($setup_data->value)) {
                    Storage::delete('public/' . substr($setup_data->value, strpos($setup_data->value, '/') + 1));
                }
            }

            // Extract base64 string
            $base64_str = substr($base64_image, strpos($base64_image, ',') + 1);
            $image = base64_decode($base64_str);

            if (!$image) {
                throw new Exception("Invalid image format", 400);
            }

            // Get file extension
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($image);
            $extension = explode('/', $mimeType)[1] ?? 'png'; // Default to png

            // Define the file path
            $path = 'general-settings/setup-' . time() . ".$extension";

            // Save file in storage/public directory
            Storage::disk('public')->put($path, $image);

            return response()->json([
                'success' => true,
                'data' => $path
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ], $e->getCode());
        }
    }

}