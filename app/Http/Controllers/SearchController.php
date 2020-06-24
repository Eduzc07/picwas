<?php

namespace App\Http\Controllers;

use App\User;
use App\Album;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SearchController extends Controller
{
    public function doSearch(Request $request)
    {
        $searchFor = $request->search;
        $topic = "";
        $countryName = "";
        $country = "";
        $countryId = "";
        $photographersFromCountry = "";

        if ($request->topic && $request->topic != "all") {
            if ($request->country && $request->country != "all") {
                $countryObj = Country::where('alpha_2_code', strtoupper($request->country))->first();
                $photographersFromCountry = User::country($countryObj->id)->get('id');
                $countryName = $countryObj->name;

                $albums = Album::names($searchFor)->descriptions($searchFor)->publicationTime()->where('category', $request->topic)->whereIn('user_id', $photographersFromCountry)->orderBy('created_at', 'desc')->paginate(12);
                $country = $request->country;
            } else {
                $albums = Album::names($searchFor)->descriptions($searchFor)->publicationTime()->where('category', $request->topic)->orderBy('created_at', 'desc')->paginate(12);
                $country = "all";
            }

            $topic = $request->topic;
        } else {
            if ($request->country && $request->country != "all") {
                $countryObj = Country::where('alpha_2_code', strtoupper($request->country))->first();
                $photographersFromCountry = User::country($countryObj->id)->get('id');
                $countryName = $countryObj->name;

                $albums = Album::names($searchFor)->descriptions($searchFor)->publicationTime()->whereIn('user_id', $photographersFromCountry)->orderBy('created_at', 'desc')->paginate(12);
                $country = $request->country;
            } else {
                $albums = Album::names($searchFor)->descriptions($searchFor)->publicationTime()->orderBy('created_at', 'desc')->paginate(12);
                $country = "all";
            }

            $topic = "all";
        }

        return view('search.show', compact(['albums', 'searchFor', 'topic', 'country', 'countryName']));
    }

    public function showPhotographerSearch()
    {
        $photographers = User::photographers()->inRandomOrder()->paginate(12);
        return view('search.show_photographers', compact('photographers'));
    }

    public function doPhotographerSearch(Request $request)
    {
        $countriesCode = ['AF', 'AL', 'DE', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AN', 'SA', 'DZ', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BY', 'MM', 'BO', 'BA', 'BW', 'BR', 'BN', 'BG', 'BF', 'BI', 'CV', 'KH', 'CM', 'CA', 'TD', 'CL', 'CN', 'CY', 'VA', 'CO', 'KM', 'CG', 'KR', 'KP', 'CI', 'CR', 'HR', 'CU', 'DK', 'DJ', 'DM', 'EC', 'EG', 'SV', 'AE', 'ER', 'SK', 'SI', 'ES', 'US', 'EE', 'ET', 'MK', 'PH', 'FI', 'FR', 'GA', 'GM', 'GE', 'GS', 'GH', 'GI', 'GD', 'GR', 'GL', 'GP', 'GU', 'GT', 'GY', 'GF', 'GN', 'GQ', 'GW', 'HT', 'NL', 'HN', 'HK', 'HU', 'IN', 'ID', 'IQ', 'IR', 'IE', 'BV', 'CX', 'HM', 'IS', 'KY', 'CK', 'CC', 'FO', 'FJ', 'FK', 'MP', 'MH', 'UM', 'PW', 'SB', 'TK', 'TC', 'VI', 'VG', 'IL', 'IT', 'JM', 'JP', 'JO', 'KZ', 'KE', 'KG', 'KI', 'KW', 'LA', 'LS', 'LV', 'LB', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MG', 'MY', 'MW', 'MV', 'ML', 'MT', 'MA', 'MQ', 'MU', 'MR', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'MS', 'MZ', 'NA', 'NR', 'NP', 'NI', 'NE', 'NG', 'NU', 'NF', 'NO', 'NC', 'NZ', 'OM', 'PA', 'PG', 'PK', 'PY', 'PE', 'PN', 'PF', 'PL', 'PT', 'PR', 'QA', 'UK', 'CF', 'CZ', 'ZA', 'CD', 'DO', 'RE', 'RW', 'RO', 'RU', 'WS', 'AS', 'KN', 'SM', 'PM', 'VC', 'SH', 'LC', 'ST', 'SN', 'YU', 'SC', 'SL', 'SG', 'SY', 'SO', 'LK', 'SZ', 'SD', 'SE', 'CH', 'SR', 'SJ', 'TH', 'TW', 'TZ', 'TJ', 'IO', 'TF', 'TP', 'TG', 'TO', 'TT', 'TN', 'TM', 'TR', 'TV', 'UA', 'UG', 'UY', 'UZ', 'VU', 'VE', 'VN', 'WF', 'YE', 'ZM', 'ZW'];

        request()->validate([
            'country' => ['string', 'max:255', Rule::in($countriesCode)],
        ]);

        if ($request->country) {
            $countryId = Country::where('alpha_2_code', strtoupper($request->country))->first()->id;

            $photographers = User::photographers()->country($countryId)->inRandomOrder()->paginate(12);
        } else {
            $photographers = User::photographers()->inRandomOrder()->paginate(12);
        }

        return view('search.show_photographers', compact('photographers'));
    }
}
