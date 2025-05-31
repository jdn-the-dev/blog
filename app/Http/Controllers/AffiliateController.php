<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AffiliateController extends Controller
{
    /**
     * Display the Literature & Philosophy affiliate page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('literture-philosophy');
    }

    /**
     * Handle redirection to an affiliate link and optionally log the click.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $category    // "literature" or "philosophy"
     * @param  int     $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToAffiliate(Request $request, string $category, int $itemId)
    {
        // In a more complex implementation, you could look up $category/$itemId
        // in a database or config file. For now, we’ll hardcode a mapping array.
        $allAffiliates = [
            'literature' => [
                1 => 'https://www.amazon.com/dp/XXXXXXXXXX?tag=your-affiliate-id',
                2 => 'https://www.amazon.com/dp/YYYYYYYYYY?tag=your-affiliate-id',
                3 => 'https://www.example.com/affiliate/link3',
                // …add more literature IDs & URLs as needed
            ],
            'philosophy' => [
                1 => 'https://www.amazon.com/dp/ZZZZZZZZZZ?tag=your-affiliate-id',
                2 => 'https://www.example.com/affiliate/link4',
                3 => 'https://www.amazon.com/dp/AAAAAAAAAA?tag=your-affiliate-id',
                // …add more philosophy IDs & URLs as needed
            ],
        ];

        // Check that the category exists and that the specific item ID exists
        if (!isset($allAffiliates[$category]) || !isset($allAffiliates[$category][$itemId])) {
            abort(404);
        }

        $affiliateUrl = $allAffiliates[$category][$itemId];

        // OPTIONAL: Log the click for analytics
        Log::info("Affiliate click: category={$category}, item_id={$itemId}, ip=" . $request->ip());

        // Redirect “away” to the affiliate URL
        return redirect()->away($affiliateUrl);
    }
}
