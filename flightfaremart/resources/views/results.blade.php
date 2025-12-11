
<div class="container">
    <div class="card">
        <div class="card-header">✈️ Search Flights</div>
        <div class="card-body">
            {{-- Point the form to a POST route to handle the search --}}
            <form action="{{ route('flights.search') }}" method="POST">
                @csrf 
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="departure_id" class="form-label">Departure Airport (IATA)</label>
                        <input type="text" class="form-control" id="departure_id" name="departure_id" placeholder="e.g., JFK" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="arrival_id" class="form-label">Arrival Airport (IATA)</label>
                        <input type="text" class="form-control" id="arrival_id" name="arrival_id" placeholder="e.g., LAX" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="outbound_date" class="form-label">Outbound Date</label>
                        <input type="date" class="form-control" id="outbound_date" name="outbound_date" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="return_date" class="form-label">Return Date (Optional)</label>
                        <input type="date" class="form-control" id="return_date" name="return_date">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Find Flights</button>
            </form>
        </div>
    </div>
</div>
