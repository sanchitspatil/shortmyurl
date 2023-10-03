<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('global_settings.site_name', 'Cal');
        $this->migrator->add('global_settings.site_active', true);
        $this->migrator->add('global_settings.site_logo', '');
        $this->migrator->add('global_settings.site_favicon', '');
        $this->migrator->add('global_settings.site_currency', 'GBP');
        $this->migrator->add('global_settings.site_language', 'en');
        $this->migrator->add('global_settings.extra_settings', json_encode([]));
        $this->migrator->add('global_settings.currency_symbol','£');
        // SMTP settings
        $this->migrator->add('global_settings.smtp_mailer', 'smtp');
        $this->migrator->add('global_settings.smtp_host', null);
        $this->migrator->add('global_settings.smtp_user', null);
        $this->migrator->add('global_settings.smtp_pass', null);
        $this->migrator->add('global_settings.smtp_port', null);
        $this->migrator->add('global_settings.smtp_enc', null);
        $this->migrator->add('global_settings.from_email', null);
        $this->migrator->add('global_settings.from_name', null);
        $this->migrator->add('global_settings.system_email_bcc', null);
        // Mailgun settings
        $this->migrator->add('global_settings.mailgun_domain', null);
        $this->migrator->add('global_settings.mailgun_secret', null);
        // Postmark settings
        $this->migrator->add('global_settings.postmark_secret', null);
        // Amazon SES settings
        $this->migrator->add('global_settings.ses_key', null);
        $this->migrator->add('global_settings.ses_secret', null);
        $this->migrator->add('global_settings.ses_region', null);
        // Payment settings
        $this->migrator->add('global_settings.payment_gateway', null);
        $this->migrator->add('global_settings.stripe_key', null);
        $this->migrator->add('global_settings.stripe_secret', null);
        $this->migrator->add('global_settings.stripe_webhook_secret', null);
    }
};
