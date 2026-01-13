<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $procedures = Procedure::query()
            ->where('is_active', true)
            ->when($q !== '', function ($query) use ($q) {
                $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
                return $query->where(function ($sub) use ($like) {
                    $sub->where('name', 'like', $like)
                        ->orWhere('note', 'like', $like);
                });
            })
            ->orderBy('name')
            ->get();

        return view('procedures.index', compact('procedures', 'q'));
    }

    public function create()
    {
        return view('procedures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        Procedure::create([
            'name' => $validated['name'],
            'note' => $validated['note'] ?? null,
            'price' => (int) $validated['price'],
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('procedures.index')->with('success', 'Prosedur berhasil ditambahkan.');
    }

    public function export(Request $request): StreamedResponse
    {
        $filename = 'procedures_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, ['id', 'name', 'note', 'price', 'is_active', 'created_at', 'updated_at']);

            Procedure::query()
                ->orderBy('name')
                ->chunk(500, function ($rows) use ($out) {
                    foreach ($rows as $p) {
                        fputcsv($out, [
                            $p->id,
                            $p->name,
                            $p->note,
                            (int) $p->price,
                            $p->is_active ? 1 : 0,
                            optional($p->created_at)->toDateTimeString(),
                            optional($p->updated_at)->toDateTimeString(),
                        ]);
                    }
                });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function importForm()
    {
        return view('procedures.import');
    }

    public function import(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:5120',
        ]);

        $path = $validated['file']->getRealPath();
        if (!$path) {
            return back()->withErrors(['file' => 'File tidak valid.']);
        }

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return back()->withErrors(['file' => 'Gagal membaca file.']);
        }

        $rowNum = 0;
        $created = 0;
        $updated = 0;

        $header = null;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNum++;

            // Skip empty lines
            if (count($row) === 1 && trim((string) $row[0]) === '') {
                continue;
            }

            if ($rowNum === 1) {
                $header = array_map(function ($h) {
                    return strtolower(trim((string) $h));
                }, $row);
                continue;
            }

            $data = [];
            if (is_array($header) && count($header) === count($row)) {
                foreach ($header as $i => $key) {
                    $data[$key] = $row[$i] ?? null;
                }
            } else {
                // Fallback: assume columns order: name, note, price
                $data['name'] = $row[0] ?? null;
                $data['note'] = $row[1] ?? null;
                $data['price'] = $row[2] ?? null;
                $data['is_active'] = $row[3] ?? 1;
            }

            $name = trim((string) ($data['name'] ?? ''));
            if ($name === '') {
                continue;
            }

            $note = isset($data['note']) ? trim((string) $data['note']) : null;
            $priceRaw = $data['price'] ?? 0;
            $price = (int) preg_replace('/[^0-9]/', '', (string) $priceRaw);
            $isActive = isset($data['is_active']) ? (bool) ((int) $data['is_active']) : true;

            $p = Procedure::where('name', $name)->first();
            if ($p) {
                $p->update([
                    'note' => $note !== '' ? $note : null,
                    'price' => $price,
                    'is_active' => $isActive,
                ]);
                $updated++;
            } else {
                Procedure::create([
                    'name' => $name,
                    'note' => $note !== '' ? $note : null,
                    'price' => $price,
                    'is_active' => $isActive,
                ]);
                $created++;
            }
        }

        fclose($handle);

        return redirect()->route('procedures.index')
            ->with('success', "Import selesai. Baru: {$created}, Update: {$updated}.");
    }
}
