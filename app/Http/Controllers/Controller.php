<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;

abstract class Controller
{
    protected function downloadExcelSpreadsheet(string $fileName, array $rows): StreamedResponse
    {
        return response()->stream(function () use ($rows) {
            $handle = fopen('php://output', 'w');

            if (! empty($rows)) {
                fputcsv($handle, array_keys(reset($rows)));

                foreach ($rows as $row) {
                    fputcsv($handle, $row);
                }
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '.xlsx"',
        ]);
    }
}
