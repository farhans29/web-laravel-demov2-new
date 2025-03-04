<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-semibold">Inventory Management</h2>
        </div>

        <div id="containerAccount" class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
            <div class="flex justify-between items-center px-6 py-4 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">Inventory List</h2>

                <div class="flex items-center">
                    <form method="GET" action="{{ route('index.inventory') }}">
                        <label for="search" class="mr-2">Search:</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="border border-gray-300 rounded px-4 py-2 w-48 mr-2" placeholder="Search...">
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table id="inventoryTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID Inventory</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Qty</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Unit</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Wight</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price List</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($inventories as $inventory)
                            <tr class="hover:bg-gray-100 odd:bg-gray-100 even:bg-white">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->id_inventory }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->category }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ number_format($inventory->qty, 0, '', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $inventory->unit }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ number_format($inventory->net_weight, 0, '', '.') }}{{ $inventory->w_unit }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ number_format($inventory->price_list, 0, '', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <button data-modal-target="default-modal"
                                        onclick="showEditModal('{{ $inventory->id_inventory }}', '{{ $inventory->category }}', '{{ $inventory->name }}', '{{ $inventory->unit }}', '{{ $inventory->net_weight }}', '{{ $inventory->w_unit }}', '{{ $inventory->price_list }}')"
                                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Edit</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 rounded p-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <form method="GET" action="{{ route('index.inventory') }}">
                        <div class="flex items-center">
                            <label for="per_page" class="mr-2">Show:</label>
                            <select name="per_page" id="per_page" onchange="this.form.submit()"
                                class="border border-gray-300 rounded px-4 py-2 w-32">
                                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="mt-2">
                    {{ $inventories->links() }}
                </div>
            </div>

            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur bg-opacity-50">
                <div class="relative p-4 w-full max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-gray-800 rounded-lg shadow-lg">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-600">
                            <h3 class="text-xl font-semibold text-white">Edit Inventory</h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                onclick="closeModal()">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form id="editForm" onsubmit="return false;">
                            <div class="p-4 space-y-4">
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <select name="category" id="category"
                                            class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            required onchange="checkCategory()">
                                            <option class="text-black" value="" disabled selected>Select
                                                Category
                                            </option>
                                            <option class="text-black" value="Fix Asset">Fix Asset</option>
                                            <option class="text-black" value="Inventory">Inventory</option>
                                            <option class="text-black" value="Office Supply">Office Supply</option>
                                            <option class="text-black" value="Others">Others..</option>
                                        </select>
                                        <label for="category"
                                            class="peer-focus:font-medium absolute text-sm text-gray-400 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Category</label>
                                    </div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input name="id_inventory" id="id_inventory" autocomplete="off" readonly
                                            class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label for="id_inventory"
                                            class="peer-focus:font-medium absolute text-sm text-gray-400 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Inventory
                                            Code</label>
                                    </div>
                                </div>
                                <div id="otherCategoryDiv" class="hidden">
                                    <input type="text" id="otherCategory" name="otherCategory"
                                        class="block py-2.5 px-3 w-full text-sm text-white bg-transparent border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Enter category">
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input name="name" id="name" autocomplete="off"
                                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required />

                                    <label for="name"
                                        class="peer-focus:font-medium absolute text-sm text-gray-400 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="unit" id="unit" autocomplete="off"
                                            class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label for="unit"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Unit
                                            (pcs/meter/box)</label>
                                    </div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <div class="grid md:grid-cols-2 md:gap-6">
                                            <div class="relative z-0 w-full mb-5 group">
                                                <input type="number" name="nett_weight" id="nett_weight"
                                                    class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " required />
                                                <label for="nett_weight"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nett
                                                    Weight</label>
                                            </div>
                                            <div class="relative z-0 w-full mb-5 group">
                                                <select name="weight_unit" id="weight_unit"
                                                    class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    required>
                                                    <option class="text-black" value="" disabled selected>Select
                                                        Weight Unit
                                                    </option>
                                                    <option class="text-black" value="mg">Milligram (mg)</option>
                                                    <option class="text-black" value="g">Gram (g)</option>
                                                    <option class="text-black" value="kg">Kilogram (kg)</option>
                                                    <option class="text-black" value="t">Ton (t)</option>
                                                </select>
                                                <label for="weight_unit"
                                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Weight
                                                    Unit</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" name="msrp" id="msrp" autocomplete="off"
                                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " required oninput="formatRupiah(this)" />
                                    <label for="msrp"
                                        class="peer-focus:font-medium absolute text-sm text-gray-400 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        MSRP</label>
                                </div>
                            </div>
                            <div class="flex items-center p-4 border-t border-gray-600">
                                <button type="button" onclick="updateInventory()"
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showEditModal(id, category, name, unit, netWeight, weightUnit, price) {
            document.getElementById('id_inventory').value = id;
            document.getElementById('category').value = category;
            document.getElementById('name').value = name;
            document.getElementById('unit').value = unit;
            document.getElementById('nett_weight').value = formatPrice(netWeight);
            document.getElementById('weight_unit').value = weightUnit;
            document.getElementById('msrp').value = formatPrice(price);

            document.getElementById('default-modal').classList.remove('hidden');
        }

        function updateInventory() {
            const id = document.getElementById('id_inventory').value;
            const name = document.getElementById('name').value;
            const category = document.getElementById('category').value;
            const unit = document.getElementById('unit').value;
            const net_weight = document.getElementById('nett_weight').value;
            const w_unit = document.getElementById('weight_unit').value;
            const price = document.getElementById('msrp').value;

            fetch(`/warehouse/inventory/update/${encodeURIComponent(id)}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name,
                        category,
                        unit,
                        net_weight,
                        w_unit,
                        price
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                        Toastify({
                            text: "Inventory updated successfully!",
                            duration: 3000,
                            gravity: "bottom", // "top" or "bottom"
                            position: "left", // "left", "center" or "right"
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            onClick: function() {} // Callback after click
                        }).showToast();
                        closeModal();
                    } else {
                        Toastify({
                            text: "Failed to update inventory: " + data.message,
                            duration: 3000,
                            gravity: "bottom", // "top" or "bottom"
                            position: "left", // "left", "center" or "right"
                            backgroundColor: "linear-gradient(to right, #ff6b6b, #ffe66d)",
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            onClick: function() {} // Callback after click
                        }).showToast();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Toastify({
                        text: "An error occurred while updating the inventory.",
                        duration: 3000,
                        gravity: "bottom", // "top" or "bottom"
                        position: "left", // "left", "center" or "right"
                        backgroundColor: "linear-gradient(to right, #ff6b6b, #ffe66d)",
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        onClick: function() {} // Callback after click
                    }).showToast();
                });
        }


        function closeModal() {
            document.getElementById('default-modal').classList.add('hidden');
        }

        function checkCategory() {
            var categorySelect = document.getElementById("category");
            var otherCategoryDiv = document.getElementById("otherCategoryDiv");

            if (categorySelect.value === "Others") {
                otherCategoryDiv.classList.remove("hidden");
            } else {
                otherCategoryDiv.classList.add("hidden");
            }
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('default-modal');
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>
</x-app-layout>
