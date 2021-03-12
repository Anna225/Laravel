<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CprCertificate;
use Datatables;

class CprCertificateController extends Controller
{
    public function index()
    {
        return view('admin.cpr-certificates.index');
    }

    /**
     * Load the CPR certificates for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadCprCertificates()
    {
        $cpr_certificate = CprCertificate::with('user')->get();

        return Datatables::of($cpr_certificate)
                ->editColumn('user', function(CprCertificate $document) {
                    return '<a href="'.route('admin.users.show', $document->user->id ).'" />'.$document->user->name.'</a>';
                })
                ->editColumn('document', function(CprCertificate $document) {
                    return '<a target="_blank" href="'.route("get.cpr_certificate", $document->document ).'" />'.$document->document.'</a>';
                })
                ->editColumn('uploaded_date', function(CprCertificate $document) {
                    return $document->uploaded_date;
                })
                ->addColumn('action', function (CprCertificate $document) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('admin.cpr-certificates.show', $document->id).'" title="View Details"><i class="fas fa-fw fa-eye"></i></a>
                    <a download class="btn btn-primary btn-sm" href="'.route("get.cpr_certificate", $document->document ).'" title="Download"><i class="fas fa-fw fa-download"></i></a>';
                })
                ->rawColumns(['user','action','document'])
                ->make(true);
    }

    /**
     * Display the Document details.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = CprCertificate::findOrFail($id);
        return view('admin.cpr-certificates.show', compact('document'));
    }

    /**
     * Upload the cpr certificate
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadCprCertificate(Request $request)
    {
        $request->validate(
            [
                "cpr_certificate" => "required|mimes:jpeg,png,jpg,pdf|max:2000"
            ],
            [
                'cpr_certificate.required'  => 'Please upload CPR certificate',
                'cpr_certificate.mimes'     => 'Please upload valid certificate file',
                'cpr_certificate.max'       => 'uploaded file is too large'
            ]
        );

        if ( $request->hasFile('cpr_certificate') ) {
            $extension      = $request->file('cpr_certificate')->getClientOriginalExtension();
            $document_name  = 'cpr_certificate-'.auth()->user()->id.'-'.time().'.'.$extension;
            $request->cpr_certificate->storeAs('cpr_certificates', $document_name );

            $update = CprCertificate::updateOrCreate(
                ['user_id'  => auth()->user()->id],
                ['document' => $document_name]
            );

            return redirect()->route('myaccount')->with('success','CPR Certificate Uploaded');
        }
    }

    /**
     * return the requested file
     *
     * @param  int  $filename
     * @return File
     */
    public function getDocument($filename)
    {
        $path = storage_path().'/'.'app/cpr_certificates/'.$filename;
        return response()->download($path, null, [], null);
    }
}
