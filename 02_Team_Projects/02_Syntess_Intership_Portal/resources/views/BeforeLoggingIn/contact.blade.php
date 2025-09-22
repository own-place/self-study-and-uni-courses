<x-main-before-logging>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css"/>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <section class="flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold my-10">Have questions? Ask us directly!</h1>
        <section class="flex flex-row-reverse gap-10 justify-center items-center">
            <div class="w-1/2 flex flex-col">
                <div class="h-[640px] shadow-xl rounded-xl" id="map"></div>

                <p id="error" class="text-red-700 mx-[160px]"></p>

                <div class="flex justify-evenly flex-wrap my-3.5">
                    <section class="flex flex-col ">
                        <div class="flex flex-row mb-3">
                            <label class="mx-2 mb-4" for="x">X</label>
                            <input
                                class="appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text" id="x">

                        </div>
                        <div class="flex flex-row">
                            <label class="mx-2 mb-4" for="y">Y</label>
                            <input
                                class="appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text" id="y">
                        </div>
                    </section>
                    <div class="flex flex-row w-1/2 gap-4">
                        <button class="hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                onclick="addmarkerButton()">{{__('add marker')}}</button>
                        <button class="hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                onclick="removeMarker()">{{__('remove marker')}}</button>
                        <button class="hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                onclick="refresh()">{{__('refresh map')}}</button>
                        <button class="hover:bg-gray-900 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                onclick="useAdress()">{{__('use adress')}}</button>
                    </div>
                </div>
            </div>

            <form class="shadow-2xl px-24 py-12 rounded-xl">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive
                            mail.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First
                                    name</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last
                                    name</label>
                                <div class="mt-2">
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="telephone" class="block text-sm font-medium leading-6 text-gray-900">Telephone</label>
                                <div class="mt-2">
                                    <input id="telephone" name="telephone" type="tel" autocomplete="tel"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Questions/Comments:</label>
                                <div class="mt-2">
                                    <textarea style="resize: none" rows="5" name="street-address" id="street-address"
                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Send
                    </button>
                </div>
            </form>
        </section>
    </section>

    <script>

        let routed = false;
        let latlng = ''
        const greenIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        let map = ''
        let marker = ''
        let popup = ''
        let markerArray = ''
        let image = ''
        loadMap()
        geocoding()
        marker.on('click', onMapClick);


        function loadMap() {
            map = L.map('map').setView([51.646719930551036, 3.9377264526479374], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            marker = L.marker([51.64670661588062, 3.937340214573278], {icon: greenIcon}).addTo(map)
            popup = L.popup();
            markerArray = []
            image = '<img src="{{ asset('images/Syntess_building.jpg') }}" alt="picture of the building where syntess is located" class="max-w-full h-auto">';

        }

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent(image + "<p>this is the building where the company resides</p>")
                .openOn(map);
        }

        function routing(coordinates) {
            L.Routing.control({
                waypoints: [
                    L.latLng(51.646719930551036, 3.9377264526479374),
                    L.latLng(coordinates)
                ],
                addWaypoints: false,
                draggableWaypoints: false,
            }).addTo(map);
            routed = true;
        }

        function geocoding() {
            L.Routing.control({
                waypoints: [
                    L.latLng(51.646719930551036, 3.9377264526479374),
                    L.latLng()
                ],
                draggableWaypoints: false,
                geocoder: L.Control.Geocoder.nominatim()
            }).addTo(map);
        }

        function addmarkerButton() {

            let cordAllowed = true

            const x = document.getElementById('x').value;
            const y = document.getElementById('y').value;
            let errorText = document.getElementById('error')

            if (x > 180 || x < -180 || y > 90 || y < -90) {
                cordAllowed = false
                errorText.innerHTML = "this value is invalid, x should be between -180 and 180, y should be between -90 and 90"
            }

            latlng = L.latLng(x, y);
            markerArray.push(latlng)

            if (cordAllowed === true) {
                errorText.innerHTML = ''
                for (let i = 0; i < markerArray.length; i++) {
                    L.marker(markerArray[i]).addTo(map);
                    map.setView(latlng)
                    if (markerArray.length >= 1) {
                        markerArray.splice(0, 1)
                        map.remove()
                        loadMap()
                        if (routed === true) {
                            geocoding()
                        }
                        map.setView(latlng, 10)
                        marker.on('click', onMapClick);
                    }
                    routing(latlng)
                    routed = false
                }
            }
        }

        map.on('click', function (e) {
            console.log(e.latlng)
        })

        function refresh() {
            map.remove()
            loadMap()
            geocoding()
            marker.on('click', onMapClick);
        }

        function removeMarker() {
            refresh()
            map.setView(latlng, 10)
        }

        function useAdress() {
            removeMarker()
        }
    </script>
</x-main-before-logging>
