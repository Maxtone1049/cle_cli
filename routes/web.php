<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('clean',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
 });
 
 
 
Route::get('/cron', 'UiController@cronAction');




Route::group(['prefix' => 'admin','namespace'=> 'Admin'], function () {
    Route::get('/', 'AdminLoginController@showAdminLoginForm');
    Route::post('/', 'AdminLoginController@adminLogin')->name('admin.login');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('dashboard', 'AdminController@adminIndex')->name('admin.home');
        Route::post('general', 'GeneralController@generalStore')->name('general.store');

        Route::get('ico', 'GeneralController@icoIndex')->name('ico_settings.index');

        Route::get('banner', 'GeneralController@bannerIndex')->name('banner.index');
        Route::get('about', 'GeneralController@aboutIndex')->name('about-area.index');
        Route::get('logo-icon', 'GeneralController@logoIcon')->name('logo-icon.index');


        Route::get('work-area', 'WorkAreaController@workIndex')->name('work-area.index');
        Route::get('work-area/create', 'WorkAreaController@workCreate')->name('work-area.create');
        Route::post('work-area', 'WorkAreaController@workStore')->name('work-area.store');
        Route::get('work-area/{workArea}', 'WorkAreaController@workEdit')->name('work-area.edit');
        Route::put('work-area/{workArea}', 'WorkAreaController@workUpdate')->name('work-area.update');
        Route::delete('work-area/{workArea}', 'WorkAreaController@workDelete')->name('work-area.delete');


        Route::get('service-area', 'ServiceController@workIndex')->name('service-area.index');
        Route::get('service-area/create', 'ServiceController@workCreate')->name('service-area.create');
        Route::post('service-area', 'ServiceController@workStore')->name('service-area.store');
        Route::get('service-area/{workArea}', 'ServiceController@workEdit')->name('service-area.edit');
        Route::put('service-area/{workArea}', 'ServiceController@workUpdate')->name('service-area.update');
        Route::delete('service-area/{workArea}', 'ServiceController@workDelete')->name('service-area.delete');


        Route::get('investor-area', 'InvestorController@workIndex')->name('investor-area.index');
        Route::get('investor-area/create', 'InvestorController@workCreate')->name('investor-area.create');
        Route::post('investor-area', 'InvestorController@workStore')->name('investor-area.store');
        Route::get('investor-area/{workArea}', 'InvestorController@workEdit')->name('investor-area.edit');
        Route::put('investor-area/{workArea}', 'InvestorController@workUpdate')->name('investor-area.update');
        Route::delete('investor-area/{workArea}', 'InvestorController@workDelete')->name('investor-area.delete');


        Route::get('partner-area', 'PartnerController@workIndex')->name('partner-area.index');
        Route::post('partner-area', 'PartnerController@workStore')->name('partner-area.store');
        Route::put('partner-area/{workArea}', 'PartnerController@workUpdate')->name('partner-area.update');
        Route::delete('partner-area/{workArea}', 'PartnerController@workDelete')->name('partner-area.delete');


        Route::get('news-area', 'NewsController@workIndex')->name('news-area.index');
        Route::get('news-area/create', 'NewsController@workCreate')->name('news-area.create');
        Route::post('news-area', 'NewsController@workStore')->name('news-area.store');
        Route::get('news-area/{workArea}', 'NewsController@workEdit')->name('news-area.edit');
        Route::put('news-area/{workArea}', 'NewsController@workUpdate')->name('news-area.update');
        Route::delete('news-area/{workArea}', 'NewsController@workDelete')->name('news-area.delete');


        Route::get('social-area', 'SocialController@workIndex')->name('social-area.index');
        Route::post('social-area', 'SocialController@workStore')->name('social-area.store');
        Route::put('social-area/{workArea}', 'SocialController@workUpdate')->name('social-area.update');
        Route::delete('social-area/{workArea}', 'SocialController@workDelete')->name('social-area.delete');

        Route::get('menu-area', 'MenuController@workIndex')->name('menu-area.index');
        Route::get('menu-area/create', 'MenuController@workCreate')->name('menu-area.create');
        Route::post('menu-area', 'MenuController@workStore')->name('menu-area.store');
        Route::get('menu-area/{workArea}', 'MenuController@workEdit')->name('menu-area.edit');
        Route::put('menu-area/{workArea}', 'MenuController@workUpdate')->name('menu-area.update');
        Route::delete('menu-area/{workArea}', 'MenuController@workDelete')->name('menu-area.delete');

        Route::get('google-tools', 'GeneralController@googleToolsIndex')->name('google_tools.index');


        Route::get('plan-area', 'PlanController@workIndex')->name('plan-area.index');
        Route::get('plan-area/create', 'PlanController@workCreate')->name('plan-area.create');
        Route::post('plan-area', 'PlanController@workStore')->name('plan-area.store');
        Route::get('plan-area/{workArea}', 'PlanController@workEdit')->name('plan-area.edit');
        Route::put('plan-area/{workArea}', 'PlanController@workUpdate')->name('plan-area.update');
        Route::delete('plan-area/{workArea}', 'PlanController@workDelete')->name('plan-area.delete');

        Route::get('gateway', 'GatewayController@show')->name('gateway');
        Route::post('gateway', 'GatewayController@update')->name('update.gateway');
        Route::post('gateway/store', 'GatewayController@store')->name('store.gateway');

        Route::get('withdraw-method', 'WithDrawMethodController@indexWithdraw')->name('add.withdraw.method');
        Route::post('withdraw-store', 'WithDrawMethodController@storeWithdraw')->name('store.withdraw.method');
        Route::put('withdraw/update/{id}', 'WithDrawMethodController@updateWithdraw')->name('update.withdraw.method');


        Route::get('withdraw/requests', 'WithDrawMethodController@requestWithdraw')->name('withdraw.request.index');
        Route::get('withdraw/details/{id}', 'WithDrawMethodController@detailWithdraw')->name('withdraw.detail.user');
        Route::post('withdraw/update/{id}', 'WithDrawMethodController@repondWithdraw')->name('withdraw.process');
        Route::get('withdraw/log', 'WithDrawMethodController@showWithdrawLog')->name('withdraw.viewlog.admin');

        Route::get('transactions', 'AdminController@transactionIndex')->name('transaction.log.admin');
        Route::get('template', 'AdminController@indexEmail')->name('email.index.admin');
        Route::get('settings', 'AdminController@gnlSetting')->name('admin.gnl.set');
        Route::get('select/template', 'AdminController@selTemplate')->name('admin.gnl.template');

        //language
        Route::get('/language/manager', 'LanguageController@langManage')->name('language-manage');
        Route::post('/language/manager', 'LanguageController@langStore')->name('language-manage-store');
        Route::delete('language-manage/{id}', 'LanguageController@langDel')->name('language-manage-del');
        Route::get('language-key/{id}', 'LanguageController@langEdit')->name('language-key');
        Route::put('key-update/{id}', 'LanguageController@langUpdate')->name('key-update');
        Route::post('language-manage-update/{id}', 'LanguageController@langUpdatepp')->name('language-manage-update');
        Route::post('language-import', 'LanguageController@langImport')->name('import_lang');

        Route::get('users', 'AdminController@usersIndex')->name('user.manage');
        Route::get('active-user', 'AdminController@usersActiveIndex')->name('active.user.manage');
        Route::get('ban-user', 'AdminController@usersBanndedIndex')->name('ban.user.manage');
        Route::get('users/detail/{id}', 'AdminController@indexUserDetail')->name('user.view');
        Route::GET('user/search', 'AdminController@userSearch')->name('username.search');
        Route::GET('user/search/email', 'AdminController@userSearchEmail')->name('email.search');
        Route::post('users/amount/{id}', 'AdminController@indexBalanceUpdate')->name('user.balance.update');
        Route::get('users/send/mail/{id}', 'AdminController@userSendMail')->name('user.mail.send');
        Route::post('send/mail/{id}', 'AdminController@userSendMailUser')->name('send.mail.user');
        Route::get('users/balance/{id}', 'AdminController@indexUserBalance')->name('add.subs.index');
        Route::put('users/update/{id}', 'AdminController@userUpdate')->name('user.detail.update');

        Route::post('active/wallet/users/update/{id}', 'AdminController@activeUserUpdate')->name('adm-active-wallet.update');
        Route::post('reject/wallet/users/update/{id}', 'AdminController@rejectUserUpdate')->name('adm-reject-wallet.update');

        // Deposit Routes...
        Route::get('deposit/pending','DepositController@pending')->name('admin.deposit.pending');
        Route::get('deposit/showReceipt', 'DepositController@showReceipt')->name('admin.deposit.showReceipt');
        Route::post('deposit/accept', 'DepositController@accept')->name('admin.deposit.accept');
        Route::post('deposit/rejectReq','DepositController@rejectReq')->name('admin.deposit.rejectReq');
        Route::get('deposit/acceptedRequests','DepositController@acceptedRequests')->name('admin.deposit.acceptedRequests');
        Route::get('deposit/depositLog','DepositController@depositLog')->name('admin.deposit.depositLog');
        Route::get('deposit/rejectedRequests','DepositController@rejectedRequests')->name('admin.deposit.rejectedRequests');

        Route::get('profile', 'AdminController@changePass')->name('admin.changePass');
        Route::post('profile/updatePassword', 'AdminController@updatePassword')->name('admin.updatePassword');

        Route::get('search-transaction/', 'AdminController@searchResult')->name('search.trans.admin');

        Route::get('referral', 'AdminController@referralIndex')->name('admin.referral');
        Route::post('referral', 'AdminController@referralStore')->name('admin.referral.update');

        Route::get('logout', 'AdminController@adminLogout')->name('admin.logout');
    });
});

Auth::routes();
Route::get('register/{referral_token}', 'Auth\RegisterController@showRegistrationForm');

Route::get('login/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('/', 'UiController@index');
Route::get('/change-lang/{lang}', 'UiController@changeLang')->name('lang');

Route::get('single/{class?}/{id?}', 'UiController@singlePage')->name('single.page');
Route::get('news', 'UiController@newsIndex')->name('news.index');
Route::get('contact', 'UiController@contactsIndex')->name('contacts.index');


Route::get('/showEmailForm', 'Auth\ForgotPasswordController@showEmailForm')->name('user.showEmailForm');
Route::post('/sendResetPassMail', 'Auth\ForgotPasswordController@sendResetPassMail')->name('user.sendResetPassMail');
Route::get('/reset/{code}', 'Auth\ForgotPasswordController@resetPasswordForm')->name('user.resetPasswordForm');
Route::post('/resetPassword', 'Auth\ForgotPasswordController@resetPassword')->name('user.resetPassword');

    Route::get('/authorization', 'HomeController@authorization')->name('authorization');
    Route::post('/sendemailver', 'HomeController@sendemailver')->name('sendemailver');
    Route::post('/emailverify', 'HomeController@emailverify')->name('emailverify');
    Route::post('/g2fa-verify', 'HomeController@verify2fa')->name('go2fa.verify');

Route::group(['middleware' => ['auth','ckstatus']], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('invest', 'HomeController@investIndex')->name('invest.index');

    Route::get('wallet', 'HomeController@walletIndex')->name('wallet.index');
    Route::get('my-wallet-transaction', 'HomeController@myWalletTransactionIndex')->name('my.wallet.transaction.log');
    Route::get('other-wallet-transaction', 'HomeController@otherWalletTransactionIndex')->name('other.wallet.transaction.log');
    Route::post('confirm-coin-wallet/{id}', 'HomeController@confirmWallet')->name('confirm-coin-wallet.store');
    Route::post('reject-coin-wallet/{id}', 'HomeController@rejectWallet')->name('reject-coin-wallet.store');

    Route::get('min-crypto', 'HomeController@purchaseCoin')->name('purchase.coin');
    Route::post('min-crypto', 'HomeController@purchaseCoinStore')->name('purchase-coin.store');
    Route::post('min-crypto-send', 'HomeController@purchaseCoinSendStore')->name('purchase-coin-send.store');
    Route::post('min-crypto-receive', 'HomeController@purchaseCoinReceiveStore')->name('purchase-coin-receive.store');

    Route::post('new-wallet', 'HomeController@newWalletStore')->name('new-wallet.store');

    Route::get('invest-log', 'HomeController@investLog')->name('invest.log');
    Route::get('transaction-log', 'HomeController@transactionLog')->name('transaction.log');
    Route::get('fund-transfer', 'HomeController@fundTransIndex')->name('fund.transfer');
    Route::post('fund-transfer', 'HomeController@fundTransStore')->name('transfer.store');
    Route::post('purchase/{plan}', 'HomeController@purPlan')->name('purchase.plan');
    Route::get('withdraw', 'HomeController@withdrawIndex')->name('user.withdraw.method');
    Route::post('withdraw/preview', 'HomeController@withdrawPreview')->name('withdraw.preview.user');
    Route::post('confirm/withdraw', 'HomeController@storeWithdraw')->name('confirm.withdraw.store');
    Route::get('withdraw-log', 'HomeController@withdrawLog')->name('user.withdraw.log');

    // All deposit methods...
    Route::match(['get', 'post'], 'deposit', 'PaymentGatwayController@addDeposit')->name('users.showDepositMethods');
    Route::post('deposit-amount-insert', 'PaymentGatwayController@depositAmountInsert')->name('submit.amount.deposit');

    Route::get('deposit-preview', 'PaymentGatwayController@depositPreview')->name('user.deposit.preview');
    Route::post('deposit-confirm', 'PaymentGatwayController@depositPayNow')->name('deposit.confirm');
    Route::get('deposit-log', 'HomeController@depositLog')->name('user.deposit.log');

    Route::get('referral/{level?}', 'HomeController@myRef')->name('user.ref.index');

    Route::get('search-transaction/', 'HomeController@searchTrans')->name('search.trans.user');
    Route::get('profile', 'HomeController@profileIndex')->name('profile.index');
    Route::post('profile', 'HomeController@profileUpdate')->name('profile.update');
    Route::post('password', 'HomeController@passwordUpdate')->name('password.update');


    //Authorization
    Route::get('/security/two/step', 'HomeController@twoFactorIndex')->name('two.factor.index');
    Route::post('/g2fa-create', 'HomeController@create2fa')->name('go2fa.create');
    Route::post('/g2fa-disable', 'HomeController@disable2fa')->name('disable.2fa');
});

//ipn
Route::get('payment', 'PayPalController@payment');
Route::get('cancel', 'PayPalController@cancel')->name('paypal.payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('paypal.payment.success');

Route::post('/ipncoin', 'CoinpaymentController@ipnCoin')->name('ipn.coinpayemnt');
Route::post('/ipnstripe', 'StripeController@ipnstripe')->name('ipn.stripe');

Route::any('/payfast-success', 'PayFastController@success')->name('payfast.payment.success');
Route::any('/payfast-cancel', 'PayFastController@cancel')->name('payfast.payment.cancel');
Route::any('/payfast-notify', 'PayFastController@notify')->name('payfast.payment.notify');

Route::post('/paystack-pay', 'PayStackController@redirectToGateway')->name('paystack.pay');
Route::get('/paystack-payment/callback', 'PayStackController@handleGatewayCallback');

Route::post('/rave-pay', 'FlutterwaveController@initialize')->name('rave.pay');
Route::get('/rave/callback', 'FlutterwaveController@callback')->name('rave.callback');


// Route::get('paytm-event-registration', 'PaytmController@register')->name('paytm.');
Route::post('paytm-payment', 'PaytmController@order')->name('paytm.payment');
Route::post('paytm/callback', 'PaytmController@paymentCallback')->name('paytm.callback');


Route::post('skrill-ipn', 'SkrillPaymentController@ipn')->name('skrill.ipn');
Route::get('skrill-complete', 'SkrillPaymentController@complete')->name('skrill.payment.complete');
Route::get('skrill-cancelled', 'SkrillPaymentController@cancelled')->name('skrill.payment.cancelled');

Route::get('/authorize-pay','AuthorizeNetController@pay')->name('authorize.pay');
Route::any('/dopay/online', 'AuthorizeNetController@handleonlinepay')->name('authorize.dopay.online');

Route::get('mollie-paymnet', 'MollieController@preparePayment')->name('mollie.payment');
Route::get('mollie-payment-success','MollieController@paymentSuccess')->name('mollie.payment.success');

Route::get('instamojo-event', 'InstamojoController@instamojoIndex');
Route::post('instamojo-pay', 'InstamojoController@instamojoPay')->name('instamojo.pay');
Route::get('instamojo-pay-success', 'InstamojoController@instamojoSuccess')->name('instamojo.payment.success');

Route::post('sceurionpay-ipn', 'SecurionPayController@ipn')->name('sceurionpay.ipn');

Route::post('coingate-ipn', 'CoingateController@ipn')->name('coingate.ipn');
Route::get('coingate-failed', 'CoingateController@failed')->name('coingate.failed');
Route::get('coingate-success', 'CoingateController@success')->name('coingate.success');

Route::post('coinbasecommerce-ipn', 'CoinbasecommerceController@ipn')->name('coinbasecommerce.ipn');
Route::get('coinbasecommerce-failed', 'CoinbasecommerceController@failed')->name('coinbasecommerce.failed');

Route::post('twocheckout', 'TwocheckoutController@prepareData')->name('twocheckout.prepareData');
Route::post('twocheckout-ipn', 'TwocheckoutController@ipn')->name('twocheckout.ipn');
Route::get('twocheckout-success', 'TwocheckoutController@success')->name('twocheckout.success');
Route::get('twocheckout-failed', 'TwocheckoutController@failed')->name('twocheckout.failed');