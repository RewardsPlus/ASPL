<?php
namespace App\Services;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QRCodeServies 
{ 
    public static function prepeareInput($request)
    {
        $input = $request->all();
        $customUrls = $request->get('custom_url');
        // dd($input);
        if (is_array($customUrls) && count($customUrls) > 0) 
        {
            foreach ($customUrls as $key => $value) 
            {
                $fileKey = 'custom_url_'.$key;
                if ($request->hasFile($fileKey)) 
                {
                    $customImages = $request->file($fileKey);
                    $customImagesName = time().$customImages->getClientOriginalName();
                    $customImages->move('uploads', $customImagesName);
                    $input['custom_url'][$key]['file_name'] = $customImagesName;
                }


            }
        }
        if ($request->hasFile('brand_logo_circle')) 
        {
            $logoImage = $request->file('brand_logo_circle');
            $logoImageName = time().$logoImage->getClientOriginalName();
            $logoImage->move('uploads', $logoImageName);
            $input['brand_logo_circle'] = $logoImageName;
        }

        if ($request->hasFile('brand_logo_rectangle')) 
        {
            $linkImage = $request->file('brand_logo_rectangle');
            $linkImageName = time().$linkImage->getClientOriginalName();
            $linkImage->move('uploads', $linkImageName);
            $input['brand_logo_rectangle'] = $linkImageName;
        }
        $input['company_id'] = Auth::guard(Helper::getGuard())->user()->id ?? '';
        $input['custom_url'] = json_encode($input['custom_url']);
        return $input;
    }   

    public static function prepeareQRCode($qRCode)  
    {
        $qRCodeId = $qRCode->id;
        $url = 'https://company.aspl.tech/show-data/'.$qRCodeId;

        $path = public_path('qr_codes/');
        $fileName = $path.$qRCodeId.'.svg';
    
        $QrCode = QrCode::size(200)->generate($url, $fileName);
        return $fileName;
    }
}