<?php
/**
 *
 * User: Damir djikic
 * Date: 3/7/24
 * Time: 8:36 PM
 */

namespace App\Service;

use App\Http\Middleware\Authenticate;
use App\Http\Requests\StoreWebsiteRequest;
use App\Models\Session;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mockery\Exception;

use Illuminate\Http\Request;

class Analytics
{
    /**
     * get all websites
     * @return mixed
     */
    public function getWebsites()
    {
        return Website::user()->orderBy('created_at', 'desc')->paginate(3);
    }

    /**
     * create the website
     * @param array $request
     * @return void
     */
    public function createWebsite(array $request)
    {
        unset($request['_token']);
        $request['external_id'] = Str::uuid();
        $request['user_id'] = Auth::id();
        Website::create($request);
    }

    /**
     * get single website
     * @param $id
     * @return mixed
     */
    public function getWebsite($id)
    {
        return Website::user()->where('id',$id)->first();
    }

    /**
     * update website
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateWebsite($request, $id)
    {
        unset($request['_token']);
        unset($request['_method']);
        return Website::user()->where('id', $id)->update($request);
    }

    public function deleteWebsite($id)
    {
        return Website::user()->where('id', $id)->delete();
    }

    /**
     * get some sort of stats
     * @param array $request
     * @return array
     */
    public function getStats(array $request): array
    {
        if (empty($request['website'])) {
            return [];
        }
        $from = \DateTime::createFromFormat('d/m/Y', $request['start'])->format('y-m-d');
        $to = \DateTime::createFromFormat('d/m/Y', $request['end'])->format('y-m-d');

        $website = Website::user()->find($request['website']);

        // a lot of bad queries to be optimized
        $total = Session::selectRaw("COUNT(*) views")->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->first()->views;
        $browser = Session::selectRaw("browser,COUNT(*) views")->groupBy('browser')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'browser'
        )->toArray();
        $os = Session::selectRaw("os,COUNT(*) views")->groupBy('os')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'os'
        )->toArray();
        $os_version = Session::selectRaw("os_version,COUNT(*) views")->groupBy('os_version')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get(
        )->pluck(
            'views',
            'os_version'
        )->toArray();
        $cookies = Session::selectRaw("cookies,COUNT(*) views")->groupBy('cookies')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'cookies'
        )->toArray();
        $mobile = Session::selectRaw("mobile,COUNT(*) views")->groupBy('mobile')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'mobile'
        )->toArray();
        $screen = Session::selectRaw("screen,COUNT(*) views")->groupBy('screen')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'screen'
        )->toArray();
        $language = Session::selectRaw("language,COUNT(*) views")->groupBy('language')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'language'
        )->toArray();
        $country = Session::selectRaw("country,COUNT(*) views")->groupBy('country')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'country'
        )->toArray();
        $city = Session::selectRaw("city,COUNT(*) views")->groupBy('city')->whereBetween('created_at', [$from, $to])->where('website_id', $website->id)->get()->pluck(
            'views',
            'city'
        )->toArray();
        $per_day = Session::selectRaw("DATE(created_at) as date,COUNT(*) views")->groupBy(\DB::RAW('DATE(created_at)'))->whereBetween('created_at', [$from, $to])->where(
            'website_id',
            $website->id
        )
            ->get()->pluck(
                'views',
                'date'
            )->toArray();


        $data = [
            'website' => $website,
            'browser' => $browser,
            'os' => $os,
            'os_version' => $os_version,
            'cookies' => $cookies,
            'mobile' => $mobile,
            'screen' => $screen,
            'language' => $language,
            'country' => $country,
            'city' => $city,
            'total' => $total,
            'per_day' => $per_day,
        ];
        return $data;
    }

    /**
     * @param Request $request
     * @return void
     * @todo add event tracking what was it what page and other , also make geoip work so we know where the user is from
     */
    public function track(Request $request)
    {
        $website = Website::where('external_id', $request->trackId)->firstOrFail();


//            $geoData = geoip($request->ip());
        $session = new Session();
        $session->website_id = $website->id;
        $session->browser = $request->data['browserInfo']['browser'];
        $session->os = $request->data['browserInfo']['os'];
        $session->os_version = $request->data['browserInfo']['osVersion'];
        $session->cookies = $request->data['browserInfo']['cookies'];
        $session->mobile = $request->data['browserInfo']['mobile'];
        $session->screen = $request->data['browserInfo']['screen'];
        $session->language = '';
        $session->country = '';
        $session->city = '';
        $session->ip_address = $request->ip();
        $session->save();
    }
}
