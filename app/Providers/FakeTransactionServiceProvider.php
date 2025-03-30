<?php

namespace App\Providers;
use Faker\Generator as Faker;

use Illuminate\Support\ServiceProvider;

class FakeTransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
                $staticNames = [
                    "Abu Mohammed", "Kwame Mensah", "Jane Smith", "Ali Kamara", "John Doe",
                    "Michael Brown", "Fatima Diallo", "David Johnson", "Susan Carter", "Joseph Walker",
                    "Emmanuel Tetteh", "Sarah Williams", "Isaac Mensah", "Hannah Asante", "Kofi Owusu",
                    "Peter Parker", "Linda Thompson", "Robert Evans", "Grace Hammond", "Sam Okoro",
                    "Aisha Bello", "Mohammed Ali", "Amina Sule", "Kwesi Appiah", "Nana Yaw",
                    "Ama Serwaa", "Kofi Mohammed", "Dorothy Adams", "Samuel Boateng", "Elizabeth Ofori"
                ];
                $recipient_names = [
                    "Abu Mohammed", "Kwame Mensah", "Jane Smith", "Ali Kamara", "John Doe",
                    "Michael Brown", "Fatima Diallo", "David Johnson", "Susan Carter", "Joseph Walker",
                    "Emmanuel Tetteh", "Sarah Williams", "Isaac Mensah", "Hannah Asante", "Kofi Owusu",
                    "Peter Parker", "Linda Thompson", "Robert Evans", "Grace Hammond", "Sam Okoro",
                    "Aisha Bello", "Mohammed Ali", "Amina Sule", "Kwesi Appiah", "Nana Yaw",
                    "Ama Serwaa", "Kofi Mohammed", "Dorothy Adams", "Samuel Boateng", "Elizabeth Ofori"
                ];
                $currencies = ["GHS", "USD", "NGN", "KES", "GBP"];
                $countries = ["GH", "US", "NG", "KE", "GB"];

                $transactions = array_map(function ($name) use ($currencies, $countries, $recipient_names) {
                    return [
                        "account" => "233" . rand(500000000, 599999999),
                        "name" => $name,
                        "recipient_account" => "233" . rand(500000000, 599999999),
                        "recipient_name" => $recipient_names[array_rand($recipient_names)],
                        "currency" => $currencies[array_rand($currencies)],
                        "country" => $countries[array_rand($countries)],
                        "amount" => rand(10, 1000),
                        "callbackUrl" => "http://localhost:3000/TEST",
                        "extrId" => sprintf('%03d-%09d', rand(1, 999), rand(1, 999999999)),
                    ];
                }, $staticNames);
        
                // Set the generated transactions in config
                config(['fake_transactions_data.transactions' => $transactions]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
