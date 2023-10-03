<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GlobalSettings extends Settings
{

    public string $site_name;
    public bool $site_active;
    public string $site_logo;
    public string $site_favicon;
    public string $site_currency;
    public string $currency_symbol;
    public string $site_language;
    public array $extra_settings = [];
    public string $smtp_mailer;
    public ?string $smtp_host = null;
    public ?string $smtp_user = null;
    public ?string $smtp_pass = null;
    public ?string $smtp_port = null;
    public ?string $smtp_enc = null;
    public ?string $from_email = null;
    public ?string $from_name = null;
    public ?string $system_email_bcc = null;
    public ?string $mailgun_domain = null;
    public ?string $mailgun_secret = null;
    public ?string $postmark_secret = null;
    public ?string $ses_key = null;
    public ?string $ses_secret = null;
    public ?string $ses_region = null;
    public ?string $payment_gateway = null;
    public ?string $stripe_key = null;
    public ?string $stripe_secret = null;
    public ?string $stripe_webhook_secret = null;

    public static function group(): string
    {
        return 'global_settings';
    }
}
