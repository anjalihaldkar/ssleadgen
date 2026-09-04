<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();

        return view('pages.utilities.documents', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|file|max:10240', // 10MB limit
        ]);

        $file = $request->file('document');
        $path = $file->store('documents', 'public');

        Document::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'size' => $file->getSize(),
            'client_name' => $request->input('client_name') ?? null,
        ]);

        return back()->with('success', 'Document uploaded successfully.');
    }

    public function download(Document $document)
    {
        if (Storage::disk('public')->exists($document->path)) {
            return Storage::disk('public')->download($document->path, $document->name);
        }

        return back()->with('error', 'File not found.');
    }

    public function share($token)
    {
        $document = Document::where('token', $token)->firstOrFail();
        if (Storage::disk('public')->exists($document->path)) {
            return Storage::disk('public')->download($document->path, $document->name);
        }
        abort(404);
    }

    public function destroy(Document $document)
    {
        if (Storage::disk('public')->exists($document->path)) {
            Storage::disk('public')->delete($document->path);
        }
        $document->delete();

        return back()->with('success', 'Document deleted successfully.');
    }
}
