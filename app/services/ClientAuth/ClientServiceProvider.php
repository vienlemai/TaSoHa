<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Auth\Reminders\PasswordBroker;
use Illuminate\Auth\Reminders\DatabaseReminderRepository;
use ClientGuard;
use ClientAuth;

class ClientServiceProvider extends ServiceProvider {

    public function register() {
        $this->registerAuth();
        $this->registerReminders();
    }

    protected function registerAuth() {
        $this->registerClientCrypt();
        $this->registerClientProvider();
        $this->registerClientGuard();
    }

    protected function registerClientCrypt() {
        $this->app['client.auth.crypt'] = $this->app->share(function($app) {
            return new BcryptHasher;
        });
    }

    protected function registerClientProvider() {
        $this->app['client.auth.provider'] = $this->app->share(function($app) {
            return new EloquentUserProvider(
                $app['client.auth.crypt'], 'Client'
            );
        });
    }

    protected function registerClientGuard() {
        $this->app['client.auth'] = $this->app->share(function($app) {
            $guard = new Guard(
                $app['client.auth.provider'], $app['session.store']
            );

            $guard->setCookieJar($app['cookie']);
            return $guard;
        });
    }

    protected function registerReminders() {
        # DatabaseReminderRepository
        $this->registerReminderDatabaseRepository();

        # PasswordBroker
        $this->app['client.reminder'] = $this->app->share(function($app) {
            return new PasswordBroker(
                $app['client.reminder.repository'], $app['client.auth.provider'], $app['redirect'], $app['mailer'], 'emails.client.reminder' // email template for the reminder
            );
        });
    }

    protected function registerReminderDatabaseRepository() {
        $this->app['client.reminder.repository'] = $this->app->share(function($app) {
            $connection = $app['db']->connection();
            $table = 'client_reminders';
            $key = $app['config']['app.key'];

            return new DatabaseReminderRepository($connection, $table, $key);
        });
    }

    public function provides() {
        return array(
            'client.auth',
            'client.auth.provider',
            'client.auth.crypt',
            'client.reminder.repository',
            'client.reminder',
        );
    }

}
