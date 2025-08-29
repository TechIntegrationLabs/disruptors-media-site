<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QR;
use App\Models\QrCode;
class QrCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('adminlogin', 'checkAdminCredentials');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qrcodes = QrCode::all();
        return view('admin/qr_code.index', compact('qrcodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.qr_code.create_qr');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required',
            'logo_url' => 'nullable|url',
            'link' => 'nullable|url',
        ]);

        $qrCode = new QrCode([
            'data' => $request->input('data'),
            'logo_url' => $request->input('logo_url'),
            'link' => $request->input('link'),
        ]);
        $qID = $qrCode->save();
        $qrCodeImagePath = 'public/qr_codes/' . $qrCode->id . '.png';
        $filePath = storage_path('app/' . $qrCodeImagePath);
      $q_data  =   QR::size(300)->generate("https://google.com");


        $qrCode->update(['qr_code_image' => $qrCodeImagePath]);

        return redirect()->route('qrcodes.index')->with('success', 'QR Code created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(QrCode $qrCode)
    {
        return view('qrcodes.show', compact('qrCode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(QrCode $qrCode)
    {
        return view('qrcodes.edit', compact('qrCode'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QrCode $qrCode)
    {
        $request->validate([
            'data' => 'required',
            'logo_url' => 'nullable|url',
            'link' => 'nullable|url',
        ]);

        $qrCode->update([
            'data' => $request->input('data'),
            'logo_url' => $request->input('logo_url'),
            'link' => $request->input('link'),
        ]);

        // Generate QR code if data is updated
        $qrCodeImagePath = 'path/to/store/qr_codes/' . $qrCode->id . '.png';
        QRCode::size(300)->generate($qrCode->data, public_path($qrCodeImagePath));

        $qrCode->update(['qr_code_image' => $qrCodeImagePath]);

        return redirect()->route('qrcodes.index')->with('success', 'QR Code updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCode $qrCode)
    {
        $qrCode->delete();

        return redirect()->route('qrcodes.index')->with('success', 'QR Code deleted successfully!');
    }
}
