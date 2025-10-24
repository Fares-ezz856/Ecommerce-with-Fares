<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class XrayController extends Controller
{
    public function analyzeXray(Request $request)
    {
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'No image uploaded'], 400);
        }

        $image = $request->file('image');

        // $model_id = "pano-fcjgf-lyrhu/3";
        // $api_key = "bScMkjgYN6FqYefIRvnO";
        $url = "https://detect.roboflow.com/pano-fcjgf-lyrhu/3?api_key=bScMkjgYN6FqYefIRvnO";

        $client = new Client();

        try {
            $response = $client->post($url, [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($image->getPathname(), 'r'),
                        'filename' => $image->getClientOriginalName(),
                    ],
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            // تخزين النتيجة في الداتابيز
            DB::table('xray_results')->insert([
                'result' => json_encode($body),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'message' => 'Image analyzed and result stored successfully',
                'result' => $body,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to analyze image',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
  public function downloadLatestResultPdf()
{
    // الحصول على آخر نتيجة مخزنة
    $latestResult = DB::table('xray_results')->latest()->first();

    if (!$latestResult) {
        return response()->json(['error' => 'No x-ray results found'], 404);
    }

    $result = json_decode($latestResult->result, true);

    // توليد ملف PDF من View
    $pdf = Pdf::loadView('result_pdf', [
        'result' => $result,
        'record' => $latestResult,  // السجل كامل
    ]);

    return $pdf->download('tooth-xray-result.pdf');
}

}
