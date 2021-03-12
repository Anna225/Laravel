<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ConsentDocument;
use DataTables;

class ConsentDocumentController extends Controller
{
    public function index()
    {
        return view('admin.consent-documents.index');
    }

    /**
     * Load the Consent Documents for Datatables 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadDocuments()
    {
        $consent_documents = ConsentDocument::query();

        return Datatables::of($consent_documents)
                ->editColumn('user', function(ConsentDocument $document) {
                    return '<a href="'.route('admin.users.show', $document->user->id ).'" />'.$document->user->name.'</a>';
                })
                ->editColumn('document', function(ConsentDocument $document) {
                    return '<a target="_blank" href="'.route("get.document", $document->document ).'" />'.$document->document.'</a>';
                })
                ->editColumn('status', function(ConsentDocument $document) {
                    if ( $document->status == 'pending' ) {
                        return '<span class="badge badge-primary">Pending</span>';
                    } elseif ( $document->status == 'approved' ) {
                        return '<span class="badge badge-success">Approved</span>';
                    } else {
                        return '<span class="badge badge-danger">Not Approved</span>';
                    }
                })
                ->editColumn('uploaded_date', function(ConsentDocument $document) {
                    return $document->uploaded_date;
                })
                ->addColumn('action', function (ConsentDocument $document) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('admin.consent-documents.show', $document->id).'"><i class="fas fa-fw fa-eye"></i></a>';
                })
                ->rawColumns(['user','status','action','document'])
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
        $document = ConsentDocument::findOrFail($id);
        return view('admin.consent-documents.show', compact('document'));
    }

    /**
     * Approve/Disapprove consent document
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request  $request)
    {
        $status    = $request->status;
        $action    = ( $status == 'approved' ) ? 'Approved' : 'Disapproved'; 
        $consentId = $request->id;

        $document = ConsentDocument::findOrFail($consentId);
        $document->status = $status;
        
        if ( $document->save() ) {
            return \Response::json([
                'status' => 'success',
                'msg'    => 'Consent Document '.$action,
            ]);
        } else {
            return \Response::json([
                'status' => 'error',
                'msg'    => 'Something went wrong',
            ]);
        }
        
    }

    /**
     * Upload the consent document
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadConsentForm(Request $request)
    {
        $request->validate(
            [
                "consent_document" => "required|mimetypes:application/pdf|max:2000"
            ],
            [
                'consent_document.required' => 'Please upload valid consent document',
                'consent_document.mimetypes' => 'Please upload valid consent document',
                'consent_document.max' => 'uploaded consent document is too large.' 
            ]
        );

        if ( $request->hasFile('consent_document') ) {
            $extension      = $request->file('consent_document')->getClientOriginalExtension();
            $document_name  = 'consent_document-'.auth()->user()->id.'-'.time().'.'.$extension;
            $request->consent_document->storeAs('documents', $document_name );

            $update = ConsentDocument::updateOrCreate(
                ['user_id'  => auth()->user()->id],
                ['document' => $document_name, 'status' => 'pending']
            );

            return redirect()->route('myaccount')->with('success','Document Uploaded');
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
        $path = storage_path().'/'.'app/documents/'.$filename;
        return response()->download($path, null, [], null);
    }

}
