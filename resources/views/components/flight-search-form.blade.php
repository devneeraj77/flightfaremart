<div x-data="flightSearchForm()" class=" font-sans">
  <div class="max-w-3xl  bg-white rounded-[2rem] shadow-2xl p-6 sm:p-8 border border-gray-100">

    <div class="flex justify-between gap-2 mb-6">
      <div>
        <button
        @click="form.tripType = 'one-way'"
        :class="form.tripType === 'one-way' ? 'bg-accent text-accent-content' : 'bg-base-200 text-accent hover:bg-base-300'"
        class="px-6 py-2 rounded-full font-semibold transition-colors duration-200">
        One Way
      </button>
      <button
        @click="form.tripType = 'round-trip'"
        :class="form.tripType === 'round-trip' ? 'bg-accent text-accent-content' : 'bg-base-200 text-accent hover:bg-base-300'"
        class="px-6 py-2 rounded-full font-semibold transition-colors duration-200">
        Round Trip
      </button>
      </div>
      <button @click="handleSubmit" class="bg-accent text-accent-content hover:bg-accent/90 px-2 py-2 rounded-full font-semibold transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </button>
      <!-- <button
        disabled
        @click="form.tripType = 'multi-city'"
        :class="form.tripType === 'multi-city' ? 'bg-accent text-accent-content' : 'bg-base-200 text-accent hover:bg-base-300'"
        class="px-6 py-2 rounded-full font-semibold transition-colors duration-200">
        <button disabled
          class="px-6 py-2 rounded-full font-semibold transition-colors duration-200 bg-gray-100 text-gray-400 cursor-not-allowed opacity-60">
          Multi City
        </button> -->
    </div>

    <div class="flex flex-col lg:flex-row items-center gap-4">

      <div class="flex items-center w-full lg:w-auto flex-1">
        <div class="relative flex-1">
          <div class="border-2 border-gray-300 rounded-l-3xl rounded-r-[1.5rem] p-4 bg-white focus-within:border-accent transition-all">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider">From</label>
            <input
              type="text"
              x-model="fromSearch"
              @input.debounce.300ms="filterFromAirports"
              @focus="fromActive = true"
              @click.away="fromActive = false"
              placeholder="Tokyo, Japan"
              class="w-full font-bold text-lg outline-none bg-transparent text-gray-800 placeholder-gray-300">
          </div>
          <div x-show="fromActive && fromResults.length > 0" class="absolute z-20 w-full bg-white rounded-xl shadow-2xl mt-2 border border-gray-100 overflow-hidden">
            <template x-for="airport in fromResults" :key="airport.code">
              <div @click="selectFrom(airport)" class="px-4 py-3 hover:bg-base-200 cursor-pointer border-b border-gray-50 last:border-0">
                <div class="font-bold text-gray-800" x-text="airport.city"></div>
                <div class="text-xs text-gray-500" x-text="airport.name"></div>
              </div>
            </template>
          </div>
        </div>

        <div class="relative z-10 -mx-4">
          <button @click="swapLocations" class="bg-accent text-accent-content p-2 rounded-full border-4 border-white shadow-md hover:bg-accent/90 transform transition active:scale-90">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
          </button>
        </div>

        <div class="relative flex-1">
          <div class="border-2 border-gray-300 rounded-r-3xl rounded-l-[1.5rem] p-4 bg-white focus-within:border-accent transition-all pl-6">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider">To</label>
            <input
              type="text"
              x-model="toSearch"
              @input.debounce.300ms="filterToAirports"
              @focus="toActive = true"
              @click.away="toActive = false"
              placeholder="Berlin, Germa"
              class="w-full font-bold text-lg outline-none bg-transparent text-gray-800 placeholder-gray-300">
          </div>
          <div x-show="toActive && toResults.length > 0" class="absolute z-20 w-full bg-white rounded-xl shadow-2xl mt-2 border border-gray-100 overflow-hidden">
            <template x-for="airport in toResults" :key="airport.code">
              <div @click="selectTo(airport)" class="px-4 py-3 hover:bg-base-200 cursor-pointer border-b border-gray-50 last:border-0">
                <div class="font-bold text-gray-800" x-text="airport.city"></div>
                <div class="text-xs text-gray-500" x-text="airport.name"></div>
              </div>
            </template>
          </div>
        </div>
      </div>

      <div class="flex gap-4 w-full lg:w-auto">
        <div class="border-2 border-gray-300 rounded-3xl p-4 flex-1 bg-white focus-within:border-accent transition-all">
          <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Departure</label>
          <div class="flex items-center gap-2">

            <input type="date" x-model="form.departureDate" class="font-bold text-gray-800 outline-none w-full bg-transparent">
          </div>
        </div>

        <div class="border-2 border-gray-300 rounded-3xl p-4 flex-1 bg-white focus-within:border-accent transition-all" x-show="form.tripType === 'round-trip'">
          <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Return</label>
          <div class="flex items-center gap-2">

            <input type="date" x-model="form.returnDate" class="font-bold text-gray-800 outline-none w-full bg-transparent">
          </div>
        </div>
      </div>

      

    </div>
  </div>
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
      },
      airports: [{
          code: 'YUL',
          name: 'Montréal-Trudeau International Airport',
          city: 'Montreal',
          country: 'Canada'
        },
        {
          code: 'YYZ',
          name: 'Toronto Pearson International Airport',
          city: 'Toronto',
          country: 'Canada'
        },
        {
          code: 'YVR',
          name: 'Vancouver International Airport',
          city: 'Vancouver',
          country: 'Canada'
        },
        {
          code: 'JFK',
          name: 'John F. Kennedy International Airport',
          city: 'New York',
          country: 'USA'
        },
        {
          code: 'LAX',
          name: 'Los Angeles International Airport',
          city: 'Los Angeles',
          country: 'USA'
        },
        {
          code: 'LHR',
          name: 'London Heathrow Airport',
          city: 'London',
          country: 'United Kingdom'
        },
        {
          code: 'CDG',
          name: 'Charles de Gaulle Airport',
          city: 'Paris',
          country: 'France'
        },
        {
          code: 'HND',
          name: 'Tokyo Haneda Airport',
          city: 'Tokyo',
          country: 'Japan'
        },
        {
          code: 'DXB',
          name: 'Dubai International Airport',
          city: 'Dubai',
          country: 'UAE'
        },
        {
          code: 'AMS',
          name: 'Amsterdam Airport Schiphol',
          city: 'Amsterdam',
          country: 'Netherlands'
        },
        {
          code: 'FRA',
          name: 'Frankfurt Airport',
          city: 'Frankfurt',
          country: 'Germany'
        },
        {
          code: 'SFO',
          name: 'San Francisco International Airport',
          city: 'San Francisco',
          country: 'USA'
        },
        {
          code: 'MIA',
          name: 'Miami International Airport',
          city: 'Miami',
          country: 'USA'
        },
        {
          code: 'DEL',
          name: 'Indira Gandhi International Airport',
          city: 'New Delhi',
          country: 'India'
        },
        {
          code: 'SYD',
          name: 'Sydney Kingsford Smith Airport',
          city: 'Sydney',
          country: 'Australia'
        },
        {
          code: 'ICN',
          name: 'Incheon International Airport',
          city: 'Seoul',
          country: 'South Korea'
        },
        {
          code: 'SIN',
          name: 'Singapore Changi Airport',
          city: 'Singapore',
          country: 'Singapore'
        },
        {
          code: 'BKK',
          name: 'Suvarnabhumi Airport',
          city: 'Bangkok',
          country: 'Thailand'
        },
        {
          code: 'HKG',
          name: 'Hong Kong International Airport',
          city: 'Hong Kong',
          country: 'China'
        },
        {
          code: 'IST',
          name: 'Istanbul Airport',
          city: 'Istanbul',
          country: 'Turkey'
        },
        {
          code: 'MUC',
          name: 'Munich Airport',
          city: 'Munich',
          country: 'Germany'
        },
        {
          code: 'BCN',
          name: 'Barcelona–El Prat Airport',
          city: 'Barcelona',
          country: 'Spain'
        },
        {
          code: 'FCO',
          name: 'Leonardo da Vinci–Fiumicino Airport',
          city: 'Rome',
          country: 'Italy'
        },
        {
          code: 'ZRH',
          name: 'Zurich Airport',
          city: 'Zurich',
          country: 'Switzerland'
        },
        {
          code: 'CPH',
          name: 'Copenhagen Airport',
          city: 'Copenhagen',
          country: 'Denmark'
        },
        {
          code: 'VIE',
          name: 'Vienna International Airport',
          city: 'Vienna',
          country: 'Austria'
        },
        {
          code: 'DUB',
          name: 'Dublin Airport',
          city: 'Dublin',
          country: 'Ireland'
        },
        {
          code: 'GRU',
          name: 'São Paulo/Guarulhos–Governador André Franco Montoro International Airport',
          city: 'São Paulo',
          country: 'Brazil'
        },
        {
          code: 'MEX',
          name: 'Mexico City International Airport',
          city: 'Mexico City',
          country: 'Mexico'
        },
        {
          code: 'EZE',
          name: 'Ministro Pistarini International Airport',
          city: 'Buenos Aires',
          country: 'Argentina'
        },
        {
          code: 'JNB',
          name: 'O. R. Tambo International Airport',
          city: 'Johannesburg',
          country: 'South Africa'
        },
        {
          code: 'CAI',
          name: 'Cairo International Airport',
          city: 'Cairo',
          country: 'Egypt'
        },
        {
          code: 'BOM',
          name: 'Chhatrapati Shivaji Maharaj International Airport',
          city: 'Mumbai',
          country: 'India'
        },
        {
          code: 'HNL',
          name: 'Daniel K. Inouye International Airport',
          city: 'Honolulu',
          country: 'USA'
        },
        {
          code: 'CUN',
          name: 'Cancún International Airport',
          city: 'Cancún',
          country: 'Mexico'
        },
        {
          code: 'PUJ',
          name: 'Punta Cana International Airport',
          city: 'Punta Cana',
          country: 'Dominican Republic'
        },
        {
          code: 'MBJ',
          name: 'Sangster International Airport',
          city: 'Montego Bay',
          country: 'Jamaica'
        },
        {
          code: 'ATH',
          name: 'Athens International Airport',
          city: 'Athens',
          country: 'Greece'
        },
        {
          code: 'LIS',
          name: 'Lisbon Airport',
          city: 'Lisbon',
          country: 'Portugal'
        },
        {
          code: 'PRG',
          name: 'Václav Havel Airport Prague',
          city: 'Prague',
          country: 'Czech Republic'
        },
        {
          code: 'BUD',
          name: 'Budapest Ferenc Liszt International Airport',
          city: 'Budapest',
          country: 'Hungary'
        },
        {
          code: 'KUL',
          name: 'Kuala Lumpur International Airport',
          city: 'Kuala Lumpur',
          country: 'Malaysia'
        },
        {
          code: 'DPS',
          name: 'Ngurah Rai International Airport',
          city: 'Denpasar',
          country: 'Indonesia'
        },
        {
          code: 'ORD',
          name: 'O\'Hare International Airport',
          city: 'Chicago',
          country: 'USA'
        },
        {
          code: 'DFW',
          name: 'Dallas/Fort Worth International Airport',
          city: 'Dallas',
          country: 'USA'
        },
        {
          code: 'ATL',
          name: 'Hartsfield-Jackson Atlanta International Airport',
          city: 'Atlanta',
          country: 'USA'
        },
        {
          code: 'PEK',
          name: 'Beijing Capital International Airport',
          city: 'Beijing',
          country: 'China'
        },
        {
          code: 'PVG',
          name: 'Shanghai Pudong International Airport',
          city: 'Shanghai',
          country: 'China'
        },
        {
          code: 'CAN',
          name: 'Guangzhou Baiyun International Airport',
          city: 'Guangzhou',
          country: 'China'
        },
        {
          code: 'SZX',
          name: 'Shenzhen Bao\'an International Airport',
          city: 'Shenzhen',
          country: 'China'
        },
        {
          code: 'AUH',
          name: 'Abu Dhabi International Airport',
          city: 'Abu Dhabi',
          country: 'UAE'
        },
        {
          code: 'BRU',
          name: 'Brussels Airport',
          city: 'Brussels',
          country: 'Belgium'
        },
        {
          code: 'NRT',
          name: 'Narita International Airport',
          city: 'Tokyo',
          country: 'Japan'
        }
      ],
      fromSearch: '',
      toSearch: '',
      fromResults: [],
      toResults: [],
      fromActive: false,
      toActive: false,

      filterFromAirports() {
        if (this.fromSearch === '') {
          this.fromResults = [];
          return;
        }
        this.fromResults = this.airports.filter(airport => {
          const search = this.fromSearch.toLowerCase();
          return airport.name.toLowerCase().includes(search) ||
            airport.city.toLowerCase().includes(search) ||
            airport.code.toLowerCase().includes(search);
        });
        this.fromActive = true;
      },

      selectFrom(airport) {
        this.form.from = airport.code;
        this.fromSearch = `${airport.name} (${airport.code})`;
        this.fromActive = false;
      },

      filterToAirports() {
        if (this.toSearch === '') {
          this.toResults = [];
          return;
        }
        this.toResults = this.airports.filter(airport => {
          const search = this.toSearch.toLowerCase();
          return airport.name.toLowerCase().includes(search) ||
            airport.city.toLowerCase().includes(search) ||
            airport.code.toLowerCase().includes(search);
        });
        this.toActive = true;
      },

      selectTo(airport) {
        this.form.to = airport.code;
        this.toSearch = `${airport.name} (${airport.code})`;
        this.toActive = false;
      },

      swapLocations() {
        const tempForm = this.form.from;
        this.form.from = this.form.to;
        this.form.to = tempForm;

        const tempSearch = this.fromSearch;
        this.fromSearch = this.toSearch;
        this.toSearch = tempSearch;
      },

      handleSubmit() {
        if (!this.form.from || !this.form.to) {
          alert('Please select both departure and destination locations');
          return;
        }
        if (!this.form.departureDate) {
          alert('Please select a departure date');
          return;
        }

        if (this.form.tripType === 'round-trip' && !this.form.returnDate) {
          alert('Please select a return date for a round trip');
          return;
        }

        if (this.form.tripType === 'multi-city') {
          alert('Multi-city flights are not supported with this form.');
          return;
        }

        const baseUrl = '/flights';
        const params = new URLSearchParams(this.form);
        const searchUrl = `${baseUrl}?${params.toString()}`;

        // Open in a new tab
        window.open(searchUrl, '_blank');
      }
    };
  }
</script>
</div>