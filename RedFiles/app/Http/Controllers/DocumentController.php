<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    // Fetch all documents
    public function index()
    {
        return response()->json(Document::all());
    }

    // Store a new document with file upload
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // max file size 10MB
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            // Store the file and get the path
            $filePath = $request->file('file')->store('documents', 'public');
        }

        // Create the document
        $document = Document::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'category_id' => $request->category_id,
            'user_id' => null, // Assign the authenticated user's ID
            'file_path' => $filePath ?? null,  // Store the file path, if uploaded
        ]);

        // Return the newly created document
        return response()->json($document, 201);
    }

    // Show a specific document
    public function show(Document $document)
    {
        return response()->json($document);
    }

    // Update an existing document
    public function update(Request $request, Document $document)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'contents' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'file' => 'sometimes|file|mimes:pdf,doc,docx|max:10240', // max file size 10MB
        ]);

        // Handle file upload if there's a new file
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Store the new file and get the path
            $filePath = $request->file('file')->store('documents', 'public');
            $document->file_path = $filePath;
        }

        // Update document details
        $document->update([
            'title' => $request->input('title', $document->title),
            'contents' => $request->input('contents', $document->contents),
            'category_id' => $request->input('category_id', $document->category_id),
            'file_path' => $document->file_path,  // Keep the existing file path if no new file uploaded
        ]);

        // Return the updated document
        return response()->json($document);
    }

    // Delete a document
    public function destroy(Document $document)
    {
        // Delete the document file if it exists
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        // Delete the document record from the database
        $document->delete();

        return response()->json(null, 204);
    }
}
