<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku;
use Livewire\Component;
use App\Models\Kategori;
use Livewire\WithPagination;
use App\Models\Rak as ModelsRak;

class Rak extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['konfirmasiHapus' => 'destroy'];

    public $rak, $baris, $kategori, $kategori_id, $rak_id;
    public $create, $edit;
    public $search;

    protected $validationAttributes = [
        'kategori_id' => 'Kategori'
    ];

    public function create()
    {
        $this->create = true;
        $this->kategori = Kategori::where('jenis_kategori_id', 1)->whereNot('nama', 'None')->get();
    }

    public function store()
    {
        $rak_pilihan = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');

        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_pilihan,
            'kategori_id' => 'required|numeric|min:1',
        ]);

        ModelsRak::create([
            'rak' => $this->rak,
            'baris' => $this->baris,
            'kategori_id' => $this->kategori_id,
            'slug' => $this->rak . '-' . $this->baris,
        ]);

        $this->emit('success', ['pesan' => 'Data berhasil ditambahkan']);

        $this->format();
    }

    public function edit(ModelsRak $rak)
    {
        $this->format();

        $this->rak_id = $rak->id;
        $this->rak = $rak->rak;
        $this->baris = $rak->baris;
        $this->kategori_id = $rak->kategori_id;
        $this->edit = true;
        $this->kategori = Kategori::where('jenis_kategori_id', 1)->get();
    }

    public function update(ModelsRak $rak)
    {
        $rak_lama = ModelsRak::find($this->rak_id);

        if ($rak_lama->rak == $this->rak) {
            $rak_baru = ModelsRak::select('baris')->where('rak', $this->rak)->where('baris', '!=', $rak_lama->baris)->get()->implode('baris', ',');
        } else {
            $rak_baru = ModelsRak::select('baris')->where('rak', $this->rak)->get()->implode('baris', ',');
        }

        $this->validate([
            'rak' => 'required|numeric|min:1',
            'baris' => 'required|numeric|min:1|not_in:' . $rak_baru,
            'kategori_id' => 'required|numeric|min:1',
        ]);

        $rak->update([
            'rak' => $this->rak,
            'baris' => $this->baris,
            'kategori_id' => $this->kategori_id,
            'slug' => $this->rak . '-' . $this->baris,
        ]);

        $this->emit('success', ['pesan' => 'Data berhasil diubah']);

        $this->format();
    }

    public function deleteConfirmation($id)
    {
        $this->rak_id = $id;
        $this->dispatchBrowserEvent('show-konfirmasi-hapus');
    }

    public function destroy()
    {
        $rak = ModelsRak::where('id', $this->rak_id)->first();
        $buku = Buku::where('rak_id', $rak->id)->get();
        foreach ($buku as $value) {
            $value->update([
                'rak_id' => 1
            ]);
        }
        $rak->delete();

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
            $raks = ModelsRak::where('rak', $this->search)->paginate(10);
        } else {
            $raks = ModelsRak::whereNot('rak', 0)->paginate(10);
        }
        $count = ModelsRak::select('rak')->distinct()->get();

        return view('livewire.petugas.rak', compact('raks', 'count'));
    }

    public function format()
    {
        unset($this->create);
        unset($this->edit);
        unset($this->rak);
        unset($this->rak_id);
        unset($this->baris);
        unset($this->kategori_id);
        unset($this->kategori);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function formatSearch()
    {
        $this->search = false;
    }
}
