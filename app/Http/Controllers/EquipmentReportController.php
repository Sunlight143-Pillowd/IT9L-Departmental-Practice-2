<?php

namespace App\Http\Controllers;
use App\Models\equipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EquipmentReportController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getReportData($request);

        return view('equipments.reports.index', $data);
    }

    public function exportpdf(Request $request)
    {
        $data = $this->getReportData($request);
        $pdf = Pdf::loadView('equipments.reports.pdf', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('equipment.report.pdf');
    }

    public function exportcsv(Request $request)
    {
        $data = $this->getReportData($request);
        $csv = $this->csvText($data['equipment']);

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="equipment-report.csv"',
        ]);
    }

    public function getReportData(Request $request): array
    {
        $endDateRules = ['nullable', 'date_format:Y-m-d'];
        if ($request->filled('start_date')) {
            $endDateRules[] = 'after_or_equal:start_date';
        }

        $validated = $request->validate([
            'start_date' => ['nullable', 'date_format:Y-m-d'],
            'end_date' => $endDateRules,
        ]);

        $startDate = $validated['start_date'] ?? null;
        $endDate = $validated['end_date'] ?? null;

        $query = equipment::where('user_id', Auth::id());

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $equipment = $query->latest()->orderByDesc('id')->get();

        return [
            'equipment' => $equipment,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'equipment_count' => $equipment->count(),
        ];
    }

    private function csvText($equipment): string
    {
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['equipment Name', 'Category', 'Description', 'Unit Price', 'Stock Status', 'Created At']);

        foreach ($equipment as $equipments) {
            fputcsv($handle, [
                $equipments->equipment_name,
                $equipments->category,
                $equipments->description,
                $equipments->unit_price,
                $equipments->availability_status,
                $equipments->created_at,
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return $csv ?: '';
    }
}
