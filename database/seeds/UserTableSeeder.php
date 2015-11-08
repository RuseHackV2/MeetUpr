<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(
            [

                'id' => '5',
                'name' => 'Alex Kondov',
                'avatar' => 'https://graph.facebook.com/v2.5/1070329712985629/picture?type=normal',
                'email' => 'nestwo@abv.bg',
                'facebook_id' => '1070329712985629',
                'facebook_token' => 'CAACk5hFza18BAGAqbXuLY0f9J4ZA2etWNB2X5jOc4jnVYH6eZA0R0ICY8paI1keopp1U4XyK2ThgDN9riD2sSfkYwRdtPHQthx7whGbQDb87PzDxl7kZCpGAZA5fA75TSCwghje9PanUlUCwIfRr7Oxm8VmuNdDHlmP4c7XmNvZB1hl9tgPQ4kbRnezKjj8zB6XJgPTiusqXOMjEn1ybv',
            ]
        );

        \DB::table('users')->insert(
            [

                'id' => '2',
                'name' => 'MArtin Simeonov',
                'avatar' => 'https://graph.facebook.com/v2.5/122482498113455/picture?type=normal',
                'email' => 'martin.dinkov.simeonov@gmail.com',
                'facebook_id' => '122482498113455',
                'facebook_token' => 'CAAHGFS5OKmsBABAogrAmqlvZBiJRqYsM89Oe98yQTaCugk1g8IMGikDCZBWUvG5lfYTE0aYRUvdFL3YPuJXhaGDnEksYXVFMwUNT27P3r5xzXrh6kTecilknvpZC8nEoiykp0qTrPuF3504WLWy66iZCyHe6ejMv7LLDyuoNLsPMnPwc5WPex05UuZCMUeiVqH3cZCFgiQhgZDZD',
            ]
        );

        \DB::table('users')->insert(
            [

                'id' => '3',
                'name' => 'Petar Simeonov',
                'avatar' => 'https://graph.facebook.com/v2.5/122482498113455/picture?type=normal',
                'email' => 'petar.dinkov.simeonov@gmail.com',
                'facebook_id' => '',
                'facebook_token' => '',
            ]
        );

        \DB::table('users')->insert(
            [

                'id' => '4',
                'name' => 'MArtin Kolev',
                'avatar' => 'https://graph.facebook.com/v2.5/122482498113455/picture?type=normal',
                'email' => 'marin.dinkov.simeonov@gmail.com',
                'facebook_id' => '',
                'facebook_token' => '',
            ]
        );
    }
}
//2	Martin Simeonov	https://graph.facebook.com/v2.5/122482498113455/picture?type=normal	martin.dinkov.simeonov@gmail.com	(null)	122482498113455	CAAHGFS5OKmsBABAogrAmqlvZBiJRqYsM89Oe98yQTaCugk1g8IMGikDCZBWUvG5lfYTE0aYRUvdFL3YPuJXhaGDnEksYXVFMwUNT27P3r5xzXrh6kTecilknvpZC8nEoiykp0qTrPuF3504WLWy66iZCyHe6ejMv7LLDyuoNLsPMnPwc5WPex05UuZCMUeiVqH3cZCFgiQhgZDZD	JY6zAyEoofgFzyclythjjg0PhY34cJNcscgkVHv1JSOxJIFe61r0LcPmmgjS	11/7/2015 12:49:58 PM	11/7/2015 12:49:58 PM