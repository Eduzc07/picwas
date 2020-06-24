<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countriesName = ["Afganistán", "Albania", "Alemania", "Andorra", "Angola", "Anguila", "Antártida", "Antigua y Barbuda", "Antillas holandesas", "Arabia Saudí", "Argelia", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaiyán", "Bahamas", "Bahrein", "Bangladesh", "Barbados", "Bélgica", "Belice", "Benín", "Bermudas", "Bhután", "Bielorrusia", "Birmania", "Bolivia", "Bosnia y Herzegovina", "Botsuana", "Brasil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Camboya", "Camerún", "Canadá", "Chad", "Chile", "China", "Chipre", "Ciudad estado del Vaticano", "Colombia", "Comores", "Congo", "Corea", "Corea del Norte", "Costa del Marfíl", "Costa Rica", "Croacia", "Cuba", "Dinamarca", "Djibouri", "Dominica", "Ecuador", "Egipto", "El Salvador", "Emiratos Arabes Unidos", "Eritrea", "Eslovaquia", "Eslovenia", "España", "Estados Unidos", "Estonia", "Etiopía", "Ex-República Yugoslava de Macedonia", "Filipinas", "Finlandia", "Francia", "Gabón", "Gambia", "Georgia", "Georgia del Sur y las islas Sandwich del Sur", "Ghana", "Gibraltar", "Granada", "Grecia", "Groenlandia", "Guadalupe", "Guam", "Guatemala", "Guayana", "Guayana francesa", "Guinea", "Guinea Ecuatorial", "Guinea-Bissau", "Haití", "Holanda", "Honduras", "Hong Kong R. A. E", "Hungría", "India", "Indonesia", "Irak", "Irán", "Irlanda", "Isla Bouvet", "Isla Christmas", "Isla Heard e Islas McDonald", "Islandia", "Islas Caimán", "Islas Cook", "Islas de Cocos o Keeling", "Islas Faroe", "Islas Fiyi", "Islas Malvinas Islas Falkland", "Islas Marianas del norte", "Islas Marshall", "Islas menores de Estados Unidos", "Islas Palau", "Islas Salomón", "Islas Tokelau", "Islas Turks y Caicos", "Islas Vírgenes EE.UU.", "Islas Vírgenes Reino Unido", "Israel", "Italia", "Jamaica", "Japón", "Jordania", "Kazajistán", "Kenia", "Kirguizistán", "Kiribati", "Kuwait", "Laos", "Lesoto", "Letonia", "Líbano", "Liberia", "Libia", "Liechtenstein", "Lituania", "Luxemburgo", "Macao R. A. E", "Madagascar", "Malasia", "Malawi", "Maldivas", "Malí", "Malta", "Marruecos", "Martinica", "Mauricio", "Mauritania", "Mayotte", "México", "Micronesia", "Moldavia", "Mónaco", "Mongolia", "Montserrat", "Mozambique", "Namibia", "Nauru", "Nepal", "Nicaragua", "Níger", "Nigeria", "Niue", "Norfolk", "Noruega", "Nueva Caledonia", "Nueva Zelanda", "Omán", "Panamá", "Papua Nueva Guinea", "Paquistán", "Paraguay", "Perú", "Pitcairn", "Polinesia francesa", "Polonia", "Portugal", "Puerto Rico", "Qatar", "Reino Unido", "República Centroafricana", "República Checa", "República de Sudáfrica", "República Democrática del Congo Zaire", "República Dominicana", "Reunión", "Ruanda", "Rumania", "Rusia", "Samoa", "Samoa occidental", "San Kitts y Nevis", "San Marino", "San Pierre y Miquelon", "San Vicente e Islas Granadinas", "Santa Helena", "Santa Lucía", "Santo Tomé y Príncipe", "Senegal", "Serbia y Montenegro", "Sychelles", "Sierra Leona", "Singapur", "Siria", "Somalia", "Sri Lanka", "Suazilandia", "Sudán", "Suecia", "Suiza", "Surinam", "Svalbard", "Tailandia", "Taiwán", "Tanzania", "Tayikistán", "Territorios británicos del océano Indico", "Territorios franceses del sur", "Timor Oriental", "Togo", "Tonga", "Trinidad y Tobago", "Túnez", "Turkmenistán", "Turquía", "Tuvalu", "Ucrania", "Uganda", "Uruguay", "Uzbekistán", "Vanuatu", "Venezuela", "Vietnam", "Wallis y Futuna", "Yemen", "Zambia", "Zimbabue"];

        $countriesCode = ['AF', 'AL', 'DE', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AN', 'SA', 'DZ', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BY', 'MM', 'BO', 'BA', 'BW', 'BR', 'BN', 'BG', 'BF', 'BI', 'CV', 'KH', 'CM', 'CA', 'TD', 'CL', 'CN', 'CY', 'VA', 'CO', 'KM', 'CG', 'KR', 'KP', 'CI', 'CR', 'HR', 'CU', 'DK', 'DJ', 'DM', 'EC', 'EG', 'SV', 'AE', 'ER', 'SK', 'SI', 'ES', 'US', 'EE', 'ET', 'MK', 'PH', 'FI', 'FR', 'GA', 'GM', 'GE', 'GS', 'GH', 'GI', 'GD', 'GR', 'GL', 'GP', 'GU', 'GT', 'GY', 'GF', 'GN', 'GQ', 'GW', 'HT', 'NL', 'HN', 'HK', 'HU', 'IN', 'ID', 'IQ', 'IR', 'IE', 'BV', 'CX', 'HM', 'IS', 'KY', 'CK', 'CC', 'FO', 'FJ', 'FK', 'MP', 'MH', 'UM', 'PW', 'SB', 'TK', 'TC', 'VI', 'VG', 'IL', 'IT', 'JM', 'JP', 'JO', 'KZ', 'KE', 'KG', 'KI', 'KW', 'LA', 'LS', 'LV', 'LB', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MG', 'MY', 'MW', 'MV', 'ML', 'MT', 'MA', 'MQ', 'MU', 'MR', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'MS', 'MZ', 'NA', 'NR', 'NP', 'NI', 'NE', 'NG', 'NU', 'NF', 'NO', 'NC', 'NZ', 'OM', 'PA', 'PG', 'PK', 'PY', 'PE', 'PN', 'PF', 'PL', 'PT', 'PR', 'QA', 'UK', 'CF', 'CZ', 'ZA', 'CD', 'DO', 'RE', 'RW', 'RO', 'RU', 'WS', 'AS', 'KN', 'SM', 'PM', 'VC', 'SH', 'LC', 'ST', 'SN', 'YU', 'SC', 'SL', 'SG', 'SY', 'SO', 'LK', 'SZ', 'SD', 'SE', 'CH', 'SR', 'SJ', 'TH', 'TW', 'TZ', 'TJ', 'IO', 'TF', 'TP', 'TG', 'TO', 'TT', 'TN', 'TM', 'TR', 'TV', 'UA', 'UG', 'UY', 'UZ', 'VU', 'VE', 'VN', 'WF', 'YE', 'ZM', 'ZW'];

        for($i = 0; $i < count($countriesName); $i++) {
            DB::table('countries')->insert([
                'name' => $countriesName[$i],
                'alpha_2_code' => $countriesCode[$i],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
