<?php

namespace Layout\Manager\Http\Controllers;

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
        "logo"                          => "Header Logo",
        "application-logo"              => "Application Logo",
        "myaccount"                     => "My Account Image",
        "left-bg"                       => "Login Reg Left Backgroud",
        "client"                        => "Client",
        "tech-partner"                  => "Technology Patner",
        "tech-partner-url"              => "Technology Patner Url",
        "is-register-visible"           => "Is Register Visible",
        "second-login-screen"           => "Activate Second Login Screen",
        "app-dashboard"                 => "App Dashboard",
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
                            'scope'         => $request->scope,
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
       try
       {  
            $base64_image   = $request->input('image_b64');
            $setup_id       = $request->input('setup_id');
            $unlink         = $request->input('unlink');

            if (!$base64_image)
                throw new Exception("image is required", 404);

            if (!empty($base64_image) && $unlink)
            {
                $setup_data = DB::table('organization_setups')
                                    ->where('id', $setup_id)
                                    ->first();
                                    
                Storage::delete('public/'.substr($setup_data->value, strpos($setup_data->value, '/')+1));
            }
                
            $extension   = explode('/', mime_content_type($base64_image))[1];
            $base64_str  = explode(',',$base64_image);
            $base64_str  = $base64_str[1]??$base64_str;
            $image       = base64_decode($base64_str);
            
            $path = 'organization-setup/'. 'setup-'.time().".$extension";
            Storage::put('public/'.$path, $image);

            return response()->json([
                                'sucess'  => true,
                                'data'      => $path
                            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'success'   => false,
                'msg'       => $e->getMessage()
            ],$e->getCode());
        }
    }
}