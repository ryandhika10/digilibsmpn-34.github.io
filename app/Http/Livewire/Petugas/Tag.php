<?php

namespace App\Http\Livewire\Petugas;

use afrizalmy\BWI\BadWord;
use Livewire\Component;
use App\Exports\TagExport;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Tag as ModelsTag;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class Tag extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public $create, $nama, $edit, $tag_id;
    public $search;

    protected $rules = [
        'nama' => ['required', 'min:3', 'unique:tag', 'max:30'],
    ];

    public function export()
    {

        $this->format();
        return Excel::download(new TagExport, 'tag.xlsx');
    }

    public function create()
    {
        $this->format();

        $this->create = true;
    }

    public function store()
    {
        $this->validate();
        if (BadWord::cek($this->nama)) {
            $nama = Badword::masking($this->nama);
        }
        if (isset($nama)) {
            ModelsTag::create([
                "nama" => $nama,
                "slug" => Str::slug($nama)
            ]);
        } else {
            ModelsTag::create([
                "nama" => $this->nama,
                "slug" => Str::slug($this->nama)
            ]);
        }

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function edit(ModelsTag $tag)
    {
        $this->format();

        $this->edit = true;
        $this->nama = $tag->nama;
        $this->tag_id = $tag->id;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|min:3|max:30',
        ]);

        if ($this->tag_id) {
            $tag = ModelsTag::find($this->tag_id);
            if (BadWord::cek($this->nama)) {
                $nama = Badword::masking($this->nama);
            }
            if (isset($nama)) {
                $tag->update([
                    'nama' => $nama,
                    'slug' => Str::slug($nama)
                ]);
            } else {
                $tag->update([
                    'nama' => $this->nama,
                    'slug' => Str::slug($this->nama)
                ]);
            }
        }

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->tag_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $tag = ModelsTag::where('id', $this->tag_id)->first();
        $tag->delete();

        $this->emit('success', ['pesan' => 'Data berhasil dihapus']);

        $this->format();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        sleep(0.5);
        if ($this->search) {
            $tag = ModelsTag::where('nama', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $tag = ModelsTag::paginate(10);
        }

        return view('livewire.petugas.tag', compact('tag'));
    }

    public function format()
    {
        unset($this->tag_id);
        unset($this->nama);
        unset($this->create);
        unset($this->edit);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
