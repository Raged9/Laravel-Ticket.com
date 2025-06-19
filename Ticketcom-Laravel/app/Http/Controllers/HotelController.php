<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HotelController extends Controller
{
    /**
     * Show the hotel search form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('hotels.search');
    }

    /**
     * Handle hotel search results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // 1. Validate input
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'checkin' => 'required|date|before:checkout',
            'checkout' => 'required|date|after:checkin',
            'rooms' => 'required|integer|min:1',
            'guests' => 'required|integer|min:1',
        ]);

        // 2. Simulate fetching hotel data based on location
        $hotels = $this->getHotelData(
            $validated['location'],
            $validated['checkin'],
            $validated['checkout'],
            $validated['rooms'],
            $validated['guests']
        );

        return view('hotels.results', [
            'hotels' => $hotels,
            'search' => $validated,
        ]);
    }
 
    /**
     * Simulate fetching hotel data (replace with your actual data source).
     *
     * @param string $location
     * @param string $checkin
     * @param string $checkout
     * @param int $rooms
     * @param int $guests
     * @return array
     */
    private function getHotelData(string $location, string $checkin, string $checkout, int $rooms, int $guests): array
    {
        // This is just sample data.  Replace with your actual database query or API call.
        $allHotels = [
            [
                'id' => 1,
                'name' => 'Hotel Indonesia Kempinski Jakarta',
                'location' => 'Jakarta',
                'stars' => 5,
                'price' => 2500000,
                'available_rooms' => 20,
            ],
            [
                'id' => 2,
                'name' => 'The Ritz-Carlton Jakarta, Mega Kuningan',
                'location' => 'Jakarta',
                'stars' => 5,
                'price' => 3000000,
                'available_rooms' => 15,
            ],
            [
                'id' => 3,
                'name' => 'Grand Hyatt Jakarta',
                'location' => 'Jakarta',
                'stars' => 5,
                'price' => 2800000,
                'available_rooms' => 10,
            ],
            [
                'id' => 4,
                'name' => 'Four Seasons Resort Bali at Sayan',
                'location' => 'Bali',
                'stars' => 5,
                'price' => 6000000,
                'available_rooms' => 5,
            ],
            [
                'id' => 5,
                'name' => 'The Ritz-Carlton, Bali',
                'location' => 'Bali',
                'stars' => 5,
                'price' => 5500000,
                'available_rooms' => 8,
            ],
        ];

        // Filter hotels based on location and available rooms
        $filteredHotels = collect($allHotels)
            ->where('location', ucfirst($location)) // Case-insensitive location matching
            ->where('available_rooms', '>=', $rooms)
            ->toArray();

        return $filteredHotels;
    }
}
