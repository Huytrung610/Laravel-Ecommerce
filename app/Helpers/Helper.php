<?php
/**
 *
 * Copyright © 2022 Wgentech. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author    Wgentech Dev Team
 * @author    linhpv@mail.wgentech.com
 *
 */

namespace App\Helpers;


use App\Models\CurrencySymbol;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

/**
 * App\Helpers
 */
class Helper
{

    /**
     * @param $localeCode
     * @param bool $skipSession
     * @throws \Exception
     */
    public function setLocate($localeCode, $skipSession = true)
    {

        if (empty($localeCode)) {
            $localeCode = config('app.default_locale');
            if (Session::has('locale')) {
                $localeCode = Session::get('locale');
            }
        }

        if (!in_array(strtolower($localeCode), array_keys(config('app.available_locales')))) {
            throw new \Exception('The language code is not valid');
        }

        app()->setLocale($localeCode);
        if (!$skipSession) {
            session()->put('locale', $localeCode);
        }
    }

    /**
     * @return mixed|string
     */
    public function getLocate()
    {
        $locale = app()->getLocale();
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }

        return $locale;
    }

    /**
     * Format price for each store
     *
     * @param $amount
     * @return string
     */
    public static function formatPrice($amount) {
        $currentLocale = app()->getLocale() ?? '';
        $currencyModel = CurrencySymbol::where('store', $currentLocale)->first();
        $currencySymbol = \App\Models\CurrencySymbol::SYMBOL_DEFAULT;
        if($currencyModel) {
            $currencySymbol = $currencyModel->getAttribute('symbol', \App\Models\CurrencySymbol::SYMBOL_DEFAULT);
        }

        return $currencySymbol . number_format($amount, 2);
    }

    /**
     * Check the conditions for sending notifications
     *
     * @param $request
     * @return RedirectResponse|mixed|string
     */
    public function checkSendNotification($request) {
        $loginUser = auth()->user() ?? backpack_user() ?? null;
        $notification =$loginUser->notifications()->where('id', $request->id)->first();
        $type = $notification->data['type'] ?? null;
        $orderId = $notification->data['order_id'] ?? null;

        if (empty($notification)) {
            request()->session()->flash('error', __('Notification not exist'));

            return back();
        }

        if($type == Order::TYPE) {
            if ($loginUser->getAttribute('role') == User::ROLE_TYPE_ADMIN) {
                $routeName = 'order.show';
            } else {
                $routeName = 'profile';
            }

            $notification->markAsRead();

            return route($routeName, $orderId);
        }

        $notification->markAsRead();

        return $notification->data['actionURL'];
    }

}
