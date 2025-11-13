<div x-data="flightSearchForm()" class=" min-w-90 mt-14 min-h-60 md:h-72 lg:h-96  ">
    <div class="w-full max-w-4xl">
        <form @submit.prevent="handleSubmit" class="bg-secondary dark:bg-trans dark:text-black dark:bg-trans rounded-lg shadow-xl p-4 sm:p-6 lg:p-8 space-y-6">
    
    <fieldset class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <legend class="sr-only">Trip Details</legend>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Trip Type</span>
            </label>
            <select x-model="form.tripType" class="select select-bordered w-full">
                <option value="round-trip">Round trip</option>
                <option value="one-way">One way</option>
                <option value="multi-city">Multi-city</option>
            </select>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Passengers</span>
            </label>
            <select x-model="form.passengers" class="select select-bordered w-full">
                <option value="1">1 Passenger</option>
                <option value="2">2 Passengers</option>
                <option value="3">3 Passengers</option>
                <option value="4">4 Passengers</option>
                <option value="5+">5+ Passengers</option>
            </select>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Class</span>
            </label>
            <select x-model="form.class" class="select select-bordered w-full">
                <option value="economy">Economy</option>
                <option value="premium-economy">Premium Economy</option>
                <option value="business">Business</option>
                <option value="first">First Class</option>
            </select>
        </div>
    </fieldset>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-3 items-end">
        
        <div class="form-control sm:col-span-1 lg:col-span-2">
            <label class="label">
                <span class="label-text">Origin / Destination</span>
            </label>
            <div class="flex gap-2">
                <select x-model="form.from" class="select select-bordered w-full">
                    <option value="">From...</option>
                    <option value="YUL">Montreal (YUL)</option>
                    <option value="YYZ">Toronto (YYZ)</option>
                    <option value="YVR">Vancouver (YVR)</option>
                    <option value="JFK">New York (JFK)</option>
                    <option value="LAX">Los Angeles (LAX)</option>
                    <option value="LHR">London (LHR)</option>
                </select>
                <button type="button" @click="swapLocations" class="btn btn-circle text-black btn-primary shrink-0 self-center">
                    ⇄
                </button>
                <select x-model="form.to" class="select select-bordered w-full">
                    <option value="">To...</option>
                    <option value="YUL">Montreal (YUL)</option>
                    <option value="YYZ">Toronto (YYZ)</option>
                    <option value="YVR">Vancouver (YVR)</option>
                    <option value="JFK">New York (JFK)</option>
                    <option value="LAX">Los Angeles (LAX)</option>
                    <option value="LHR">London (LHR)</option>
                </select>
            </div>
        </div>
        
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Departure Date</span>
            </label>
            <input type="date" x-model="form.departureDate" :min="today" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full" x-show="form.tripType === 'round-trip'">
            <label class="label">
                <span class="label-text">Return Date</span>
            </label>
            <input type="date" x-model="form.returnDate" :min="form.departureDate || today" class="input input-bordered w-full" />
        </div>
        
        </div>

    <!-- <fieldset class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        <legend class="sr-only">Advanced Filters</legend>
        
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Stops</span>
            </label>
            <select x-model="form.stops" class="select select-bordered w-full">
                <option value="any">Any stops</option>
                <option value="direct">Direct only</option>
                <option value="1">1 stop</option>
                <option value="2+">2+ stops</option>
            </select>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Duration</span>
            </label>
            <select x-model="form.duration" class="select select-bordered w-full">
                <option value="any">Any duration</option>
                <option value="short">Short (&lt;4h)</option>
                <option value="medium">Medium (4–8h)</option>
                <option value="long">Long (8h+)</option>
            </select>
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">More Options</span>
            </label>
            <select x-model="form.more" class="select select-bordered w-full">
                <option value="any">Any options</option>
                <option value="baggage">Include baggage</option>
                <option value="flexible">Flexible dates</option>
                <option value="nearby">Nearby airports</option>
            </select>
        </div>
    </fieldset> -->

    <div class="text-right">
        <button type="submit" class="btn btn-primary bg-accent w-fit text-lg mt-2">
        Search Flights
    </button>
    </div>
</form>


    </div>
    <script>
        function flightSearchForm() {
            return {
                today: new Date().toISOString().split('T')[0],
                form: {
                    tripType: 'round-trip',
                    passengers: '1',
                    class: 'economy',
                    from: '',
                    to: '',
                    departureDate: '',
                    returnDate: '',
                    stay: '23-56',
                    stops: 'any',
                    duration: 'any',
                    more: 'any',
                },
                results: [],
                loading: false,

                swapLocations() {
                    const temp = this.form.from;
                    this.form.from = this.form.to;
                    this.form.to = temp;
                },

                async handleSubmit() {
                    if (!this.form.from || !this.form.to) {
                        alert('Please select both departure and destination locations');
                        return;
                    }
                    if (!this.form.departureDate) {
                        alert('Please select a departure date');
                        return;
                    }

                    this.loading = true;
                    this.results = [];

                    try {
                        const response = await fetch('{{ route("flights.search") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form)
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.results = data["flights_results"] || [];
                        } else {
                            alert(data.error || 'Failed to search flights.');
                        }
                    } catch (error) {
                        console.error(error);
                        alert('An error occurred. Please try again.');
                    } finally {
                        this.loading = false;
                    }
                }
            };
        }
    </script>

</div>