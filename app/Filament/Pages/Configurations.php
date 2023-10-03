<?php

namespace App\Filament\Pages;

use App\Settings\GlobalSettings;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;
use Squire\Models\Currency;

class Configurations extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GlobalSettings::class;

    public function getTitle(): string|Htmlable
    {
        return __("Global Settings");
    }

    public static function getNavigationLabel(): string
    {
        return __("Global Settings");
    }

    public static function getNavigationGroup(): ?string
    {
        return __("System Configurations");
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        Tabs::make('Configurations')
                            ->tabs([
                                Tabs\Tab::make('General Settings')
                                    ->schema([
                                        Grid::make(1)
                                            ->schema([
                                                TextInput::make('site_name')->required(),
                                            ]),
                                        Grid::make(2)
                                            ->schema([
                                                FileUpload::make('site_logo')->image()->disk('public')->required(),
                                                FileUpload::make('site_favicon')->image()->disk('public')->required(),
                                            ]),
                                        Grid::make(3)
                                            ->schema([
                                                Forms\Components\Select::make('site_currency')
                                                    ->options(Currency::all()->pluck('name','id'))->preload()->searchable()->required()->reactive()
                                                    ->afterStateUpdated(function (Set $set, $state) {
                                                        $set('currency_symbol', Currency::find($state)->symbol);
                                                    }),
                                                TextInput::make('currency_symbol')->required(),
                                                TextInput::make('site_language')->required(),
                                            ]),
                                    ]),

                                Tabs\Tab::make('Mail Settings')
                                    ->schema([
                                        Grid::make(1)
                                            ->schema([
                                                Forms\Components\Select::make('smtp_mailer')->options([
                                                    'sendmail' => 'SendMail',
                                                    'smtp' => 'SMTP',
                                                    'mailgun' => 'Mailgun',
                                                    'postmark' => 'Postmark',
                                                    'ses' => 'AWS SES'
                                                ])->required(),
                                            ]),
                                        Fieldset::make('Mail Settings')->columns(3)
                                            ->schema([
                                                TextInput::make('from_email')->required()->email(),
                                                TextInput::make('from_name')->required(),
                                                TextInput::make('system_email_bcc')->placeholder('Comma separated emails'),
                                            ]),
                                        Fieldset::make('SMTP')
                                            ->schema([
                                                TextInput::make('smtp_host')->requiredIf('smtp_mailer', 'smtp'),
                                                TextInput::make('smtp_user')->requiredIf('smtp_mailer', 'smtp'),
                                                TextInput::make('smtp_pass')->requiredIf('smtp_mailer', 'smtp'),
                                                TextInput::make('smtp_port')->requiredIf('smtp_mailer', 'smtp'),
                                                TextInput::make('smtp_enc')->requiredIf('smtp_mailer', 'smtp'),
                                            ]),
                                        Fieldset::make('Mailgun')
                                            ->schema([
                                                TextInput::make('mailgun_domain')->requiredIf('smtp_mailer', 'mailgun'),
                                                TextInput::make('mailgun_secret')->requiredIf('smtp_mailer', 'mailgun'),
                                            ]),
                                        Fieldset::make('Postmark')
                                            ->schema([
                                                TextInput::make('postmark_secret')->requiredIf('smtp_mailer', 'postmark'),
                                            ]),
                                        Fieldset::make('AWS SES')
                                            ->schema([
                                                TextInput::make('ses_key')->requiredIf('smtp_mailer', 'ses'),
                                                TextInput::make('ses_secret')->requiredIf('smtp_mailer', 'ses'),
                                                TextInput::make('ses_region')->requiredIf('smtp_mailer', 'ses'),
                                            ])
                                    ])->columns(4),

                                Tabs\Tab::make('Payment Settings')
                                    ->schema([
                                        TextInput::make('stripe_key')->required(),
                                        TextInput::make('stripe_secret')->required(),
                                        TextInput::make('stripe_webhook_secret'),
                                    ]),

                                Tabs\Tab::make('Miscellaneous Settings')
                                    ->schema([
                                        Grid::make(1)
                                            ->schema([
                                                Repeater::make('extra_settings')
                                                    ->schema([
                                                        TextInput::make('key')->required(),
                                                        Forms\Components\Textarea::make('value')->required()->rows(2),
                                                    ])->grid(4),
                                            ])
                                    ]),
                            ])
                    ])
            ]);
    }
}
