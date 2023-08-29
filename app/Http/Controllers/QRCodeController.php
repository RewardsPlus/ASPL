<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\QRCode;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Services\QRCodeServies;
use Illuminate\Support\Facades\Auth;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qRCodes = QRCode::select(['id','name','title','description','qr_code_url','view_count','created_at'])

        // ->where('company_id',Auth::guard(Helper::getGuard())->user()->id)

        ->simplePaginate(5);
        // dd($qRCodes);
        return view('qrcode.list',compact('qRCodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('qrcode.create');
    }
	
    public function newqrcode(){
        return view('qrcode.createnew');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $input = QRCodeServies::prepeareInput($request);
        $qRCode = QRCode::create($input);
        
        $qRCodeURL = QRCodeServies::prepeareQRCode($qRCode);

        $qRCode->qr_code_url = $qRCodeURL;
        $qRCode->save();
        return redirect()->route('qrcodes.show',$qRCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(QRCode $qRCode)
    {
        return view('qrcode.detail',compact('qRCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QRCode $qRCode)
    {
        return view('qrcode.edit',compact('qRCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QRCode $qRCode)
    {
        $input = QRCodeServies::prepeareInput($request);
        $qRCode->fill($input);
        $qRCode->save();
        return redirect()->route('qrcodes.show',$qRCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QRCode $qRCode)
    {
        $qRCode->delete();
        return redirect()->route('qrcodes.index');
    }

    public function showData(QRCode $qRCode)
    {   
        // dd($qRCode);
        $qRCode->view_count += 1;
        $qRCode->save();
        return view('qrcode.sow-data',compact('qRCode'));
    }

    public function download($qRCode)
    {
        $filePath = public_path('qr_codes/').$qRCode.'.svg';

        $headers = [
            'Content-Type' => mime_content_type($filePath),
            'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
        ];

        return response()->download($filePath, basename($filePath), $headers);

    }
}
