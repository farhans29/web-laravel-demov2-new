<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $perPage = $request->input('per_page', 5);

        $query = Inventory::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_inventory', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('unit', 'like', '%' . $search . '%')
                    ->orWhere('price_list', 'like', '%' . $search . '%');
            });
        }

        $inventories = $query->paginate($perPage);

        return view('pages/warehouse/inventory/index_list', compact('inventories', 'perPage', 'search'));
    }

    public function indexNew(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);
        $query = Inventory::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_inventory', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('unit', 'like', '%' . $search . '%')
                    ->orWhere('price_list', 'like', '%' . $search . '%');
            });
        }

        $inventories = $query->paginate($perPage);

        return view('pages/warehouse/inventory/index_new', compact('inventories', 'perPage'));
    }

    public function indexEdit(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);
        $query = Inventory::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_inventory', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('unit', 'like', '%' . $search . '%')
                    ->orWhere('price_list', 'like', '%' . $search . '%');
            });
        }

        $inventories = $query->paginate($perPage);

        return view('pages/warehouse/inventory/index_edit', compact('inventories', 'perPage'));
    }

    public function indexDelete(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);
        $query = Inventory::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_inventory', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('unit', 'like', '%' . $search . '%')
                    ->orWhere('price_list', 'like', '%' . $search . '%');
            });
        }

        $inventories = $query->paginate($perPage);

        return view('pages/warehouse/inventory/index_delete', compact('inventories', 'perPage'));
    }

    public function create()
    {
        return view('pages/warehouse/inventory/New/index');
    }

    public function store(Request $request)
    {
        try {
            Inventory::create([
                'id_inventory' => $request->id_inventory ?? Str::uuid(),
                'qty' => "0",
                'hpp' => "0",
                'automargin' => "0",
                'minsales' => "0",
                'price_list' => "0",
                'currency' => "IDR",
                'last_purch' => "0",
                'ws_price' => "0",
                'plu' => "0",
                'id_supplier' => "0",
                'category' => $request->category,
                'name' => $request->name,
                'unit' => $request->nett_weight . ' ' . $request->weight_unit,
                'net_weight' => $request->nett_weight,
                'w_unit' => $request->weight_unit,
                'aktif_y_n' => "y",
                'category_2' => $request->msrp ?? null,
            ]);

            // Redirect ke halaman tambah inventory jika berhasil
            return redirect()->route('indexNew.inventory')->with('success', 'Inventory item added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        // Check if the user is authorized to delete the inventory item
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Find the inventory item by ID
        $inventory = Inventory::find($id);

        if (!$inventory) {
            return response()->json(['success' => false, 'message' => 'Inventory item not found'], 404);
        }

        // Delete the inventory item
        $inventory->delete();

        return response()->json(['success' => true, 'message' => 'Inventory item deleted successfully']);
    }
}
