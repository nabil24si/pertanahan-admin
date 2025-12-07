<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Persil;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PersilController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['penggunaan'];
        $searchableColumns = ['kode_persil', 'alamat_lahan', 'rt', 'rw'];

        $data['dataPersil'] = Persil::with('warga')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->simplePaginate(10)
            ->withQueryString();

        return view('pages.persil.index', $data);
    }

    public function create()
    {
        $data['dataWarga'] = Warga::all();
        return view('pages.persil.create', $data);
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'kode_persil'      => 'required|string|max:50|unique:persil,kode_persil',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2'          => 'required|numeric|min:1',
            'penggunaan'       => ['required', Rule::in(['Sawah', 'Kebun', 'Perumahan', 'Ruko', 'Lahan Kosong'])],
            'alamat_lahan'     => 'required|string|max:255',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
            'files.*'          => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:5120', // Validasi File
        ]);

        // 2. Simpan Data Persil (Buang 'files' dari array agar tidak error di tabel persil)
        $persil = Persil::create(\Illuminate\Support\Arr::except($validated, ['files']));

        // 3. Logic Upload File
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // Generate nama file
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan Fisik (Disk Public)
                $file->storeAs('uploads/persil', $filename, 'public');

                // Simpan Database Media
                Media::create([
                    'ref_table'  => 'persil',
                    'ref_id'     => $persil->persil_id,
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data Persil dan Media berhasil ditambahkan!');
    }

    public function show($id)
    {
        $persil = Persil::with(['warga', 'attachments'])->findOrFail($id);
        return view('pages.persil.show', compact('persil'));
    }

    public function edit(string $id)
    {
        // Load relasi attachments agar foto lama muncul di form edit
        $data['dataPersil'] = Persil::with(['warga', 'attachments'])->findOrFail($id);
        $data['dataWarga']  = Warga::all();

        return view('pages.persil.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $persil = Persil::findOrFail($id);

        $validated = $request->validate([
            'kode_persil'      => 'required|string|max:50|unique:persil,kode_persil,' . $persil->persil_id . ',persil_id',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2'          => 'required|numeric|min:1',
            'penggunaan'       => ['required', Rule::in(['Sawah', 'Kebun', 'Perumahan', 'Ruko', 'Lahan Kosong'])],
            'alamat_lahan'     => 'required|string|max:255',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
            'files.*'          => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:5120',
        ]);

        // 1. Update Data Teks
        $persil->update(\Illuminate\Support\Arr::except($validated, ['files']));

        // 2. Logic Tambah File Baru (Append)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                $file->storeAs('uploads/persil', $filename, 'public');

                Media::create([
                    'ref_table'  => 'persil',
                    'ref_id'     => $persil->persil_id,
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil diperbarui!');
    }

    /**
     * Hapus Data Persil Beserta Semua Fotonya
     */
    public function destroy(string $id)
    {
        $persil = Persil::findOrFail($id);

        $mediaItems = Media::where('ref_table', 'persil')->where('ref_id', $persil->persil_id)->get();

        foreach ($mediaItems as $media) {
            Storage::disk('public')->delete('uploads/persil/' . $media->file_name);
            $media->delete();
        }

        $persil->delete();
        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil dihapus!');
    }

    /**
     * Hapus SATU Foto (Dipanggil dari tombol hapus di Edit Page)
     */
    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);

        // Pastikan path sesuai dengan saat upload ('uploads/persil')
        $path = 'uploads/persil/' . $media->file_name;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $media->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
