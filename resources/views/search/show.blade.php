@extends('layouts.master')

@section('title', "Busqueda de álbumes")

@section('content')

@include("layouts.navbar")

<div class="container-fluid mt-5 pt-5 px-md-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-muted">
                @if($searchFor)
                    Resultados de <br>
                    <small class="text-success">"{{$searchFor}}" @if($topic != "all")
                        en {{strtolower($topic)}}
                    @endif
                    @if($country != "all")
                        &nbsp;de fotógrafos en {{ucfirst($countryName)}}
                    @endif
                    </small>
                @else
                    Álbumes
                @endif
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-8 mx-auto">
            <form id="formSearchAlbum" action="{{route('search')}}" method="POST" class="text-center" onsubmit="preventMultipleSubmitForm(this, '{{ asset('icons/blocks.svg')}}')">
                @csrf
                <input type="hidden" name="search" value="{{$searchFor}}">

                <div class="form-row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="topic" class="col-sm-2 col-form-label py-0">Tema</label>
                            <div class="col-sm-10 m-0 pl-0">
                                <select name="topic" id="topic" class="form-control form-control-sm color-1 bg-color-2">
                                    <option value="all" {{ $topic == "all"?'selected':''}}>Todos los temas</option>
                                    <option value="Deporte" {{ $topic == "Deporte"?'selected':''}}>Deporte</option>
                                    <option value="Danzas" {{ $topic == "Danzas"?'selected':''}}>Danzas</option>
                                    <option value="Lugares Turísticos" {{ $topic == "Lugares Turísticos"?'selected':''}}>Lugares Turísticos</option>
                                    <option value="Otros" {{ $topic == "Otros"?'selected':''}}>Otros</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row">
                            <label for="country" class="col-sm-2 col-form-label py-0">País</label>
                            <div class="col-sm-10 m-0 pl-0">
                                <select name="country" id="country" class="form-control form-control-sm color-1 bg-color-2">
                                    <option value="all" {{ $country == "all"?'selected':''}}>Todos los países</option>
                                    <option value="AF" {{ $country == "AF"?'selected':''}}>Afganistán</option>
                                    <option value="AL" {{ $country == "AL"?'selected':''}}>Albania</option>
                                    <option value="DE" {{ $country == "DE"?'selected':''}}>Alemania</option>
                                    <option value="AD" {{ $country == "AD"?'selected':''}}>Andorra</option>
                                    <option value="AO" {{ $country == "AO"?'selected':''}}>Angola</option>
                                    <option value="AI" {{ $country == "AI"?'selected':''}}>Anguila</option>
                                    <option value="AQ" {{ $country == "AQ"?'selected':''}}>Antártida</option>
                                    <option value="AG" {{ $country == "AG"?'selected':''}}>Antigua y Barbuda</option>
                                    <option value="AN" {{ $country == "AN"?'selected':''}}>Antillas holandesas</option>
                                    <option value="SA" {{ $country == "SA"?'selected':''}}>Arabia Saudí</option>
                                    <option value="DZ" {{ $country == "DZ"?'selected':''}}>Argelia</option>
                                    <option value="AR" {{ $country == "AR"?'selected':''}}>Argentina</option>
                                    <option value="AM" {{ $country == "AM"?'selected':''}}>Armenia</option>
                                    <option value="AW" {{ $country == "AW"?'selected':''}}>Aruba</option>
                                    <option value="AU" {{ $country == "AU"?'selected':''}}>Australia</option>
                                    <option value="AT" {{ $country == "AT"?'selected':''}}>Austria</option>
                                    <option value="AZ" {{ $country == "AZ"?'selected':''}}>Azerbaiyán</option>
                                    <option value="BS" {{ $country == "BS"?'selected':''}}>Bahamas</option>
                                    <option value="BH" {{ $country == "BH"?'selected':''}}>Bahrein</option>
                                    <option value="BD" {{ $country == "BD"?'selected':''}}>Bangladesh</option>
                                    <option value="BB" {{ $country == "BB"?'selected':''}}>Barbados</option>
                                    <option value="BE" {{ $country == "BE"?'selected':''}}>Bélgica</option>
                                    <option value="BZ" {{ $country == "BZ"?'selected':''}}>Belice</option>
                                    <option value="BJ" {{ $country == "BJ"?'selected':''}}>Benín</option>
                                    <option value="BM" {{ $country == "BM"?'selected':''}}>Bermudas</option>
                                    <option value="BT" {{ $country == "BT"?'selected':''}}>Bhután</option>
                                    <option value="BY" {{ $country == "BY"?'selected':''}}>Bielorrusia</option>
                                    <option value="MM" {{ $country == "MM"?'selected':''}}>Birmania</option>
                                    <option value="BO" {{ $country == "BO"?'selected':''}}>Bolivia</option>
                                    <option value="BA" {{ $country == "BA"?'selected':''}}>Bosnia y Herzegovina</option>
                                    <option value="BW" {{ $country == "BW"?'selected':''}}>Botsuana</option>
                                    <option value="BR" {{ $country == "BR"?'selected':''}}>Brasil</option>
                                    <option value="BN" {{ $country == "BN"?'selected':''}}>Brunei</option>
                                    <option value="BG" {{ $country == "BG"?'selected':''}}>Bulgaria</option>
                                    <option value="BF" {{ $country == "BF"?'selected':''}}>Burkina Faso</option>
                                    <option value="BI" {{ $country == "BI"?'selected':''}}>Burundi</option>
                                    <option value="CV" {{ $country == "CV"?'selected':''}}>Cabo Verde</option>
                                    <option value="KH" {{ $country == "KH"?'selected':''}}>Camboya</option>
                                    <option value="CM" {{ $country == "CM"?'selected':''}}>Camerún</option>
                                    <option value="CA" {{ $country == "CA"?'selected':''}}>Canadá</option>
                                    <option value="TD" {{ $country == "TD"?'selected':''}}>Chad</option>
                                    <option value="CL" {{ $country == "CL"?'selected':''}}>Chile</option>
                                    <option value="CN" {{ $country == "CN"?'selected':''}}>China</option>
                                    <option value="CY" {{ $country == "CY"?'selected':''}}>Chipre</option>
                                    <option value="VA" {{ $country == "VA"?'selected':''}}>Ciudad estado del Vaticano</option>
                                    <option value="CO" {{ $country == "CO"?'selected':''}}>Colombia</option>
                                    <option value="KM" {{ $country == "KM"?'selected':''}}>Comores</option>
                                    <option value="CG" {{ $country == "CG"?'selected':''}}>Congo</option>
                                    <option value="KR" {{ $country == "KR"?'selected':''}}>Corea</option>
                                    <option value="KP" {{ $country == "KP"?'selected':''}}>Corea del Norte</option>
                                    <option value="CI" {{ $country == "CI"?'selected':''}}>Costa del Marfíl</option>
                                    <option value="CR" {{ $country == "CR"?'selected':''}}>Costa Rica</option>
                                    <option value="HR" {{ $country == "HR"?'selected':''}}>Croacia</option>
                                    <option value="CU" {{ $country == "CU"?'selected':''}}>Cuba</option>
                                    <option value="DK" {{ $country == "DK"?'selected':''}}>Dinamarca</option>
                                    <option value="DJ" {{ $country == "DJ"?'selected':''}}>Djibouri</option>
                                    <option value="DM" {{ $country == "DM"?'selected':''}}>Dominica</option>
                                    <option value="EC" {{ $country == "EC"?'selected':''}}>Ecuador</option>
                                    <option value="EG" {{ $country == "EG"?'selected':''}}>Egipto</option>
                                    <option value="SV" {{ $country == "SV"?'selected':''}}>El Salvador</option>
                                    <option value="AE" {{ $country == "AE"?'selected':''}}>Emiratos Arabes Unidos</option>
                                    <option value="ER" {{ $country == "ER"?'selected':''}}>Eritrea</option>
                                    <option value="SK" {{ $country == "SK"?'selected':''}}>Eslovaquia</option>
                                    <option value="SI" {{ $country == "SI"?'selected':''}}>Eslovenia</option>
                                    <option value="ES" {{ $country == "ES"?'selected':''}}>España</option>
                                    <option value="US" {{ $country == "US"?'selected':''}}>Estados Unidos</option>
                                    <option value="EE" {{ $country == "EE"?'selected':''}}>Estonia</option>
                                    <option value="ET" {{ $country == "ET"?'selected':''}}>Etiopía</option>
                                    <option value="MK" {{ $country == "MK"?'selected':''}}>Ex-República Yugoslava de Macedonia</option>
                                    <option value="PH" {{ $country == "PH"?'selected':''}}>Filipinas</option>
                                    <option value="FI" {{ $country == "FI"?'selected':''}}>Finlandia</option>
                                    <option value="FR" {{ $country == "FR"?'selected':''}}>Francia</option>
                                    <option value="GA" {{ $country == "GA"?'selected':''}}>Gabón</option>
                                    <option value="GM" {{ $country == "GM"?'selected':''}}>Gambia</option>
                                    <option value="GE" {{ $country == "GE"?'selected':''}}>Georgia</option>
                                    <option value="GS" {{ $country == "GS"?'selected':''}}>Georgia del Sur y las islas Sandwich del Sur</option>
                                    <option value="GH" {{ $country == "GH"?'selected':''}}>Ghana</option>
                                    <option value="GI" {{ $country == "GI"?'selected':''}}>Gibraltar</option>
                                    <option value="GD" {{ $country == "GD"?'selected':''}}>Granada</option>
                                    <option value="GR" {{ $country == "GR"?'selected':''}}>Grecia</option>
                                    <option value="GL" {{ $country == "GL"?'selected':''}}>Groenlandia</option>
                                    <option value="GP" {{ $country == "GP"?'selected':''}}>Guadalupe</option>
                                    <option value="GU" {{ $country == "GU"?'selected':''}}>Guam</option>
                                    <option value="GT" {{ $country == "GT"?'selected':''}}>Guatemala</option>
                                    <option value="GY" {{ $country == "GY"?'selected':''}}>Guayana</option>
                                    <option value="GF" {{ $country == "GF"?'selected':''}}>Guayana francesa</option>
                                    <option value="GN" {{ $country == "GN"?'selected':''}}>Guinea</option>
                                    <option value="GQ" {{ $country == "GQ"?'selected':''}}>Guinea Ecuatorial</option>
                                    <option value="GW" {{ $country == "GW"?'selected':''}}>Guinea-Bissau</option>
                                    <option value="HT" {{ $country == "HT"?'selected':''}}>Haití</option>
                                    <option value="NL" {{ $country == "NL"?'selected':''}}>Holanda</option>
                                    <option value="HN" {{ $country == "HN"?'selected':''}}>Honduras</option>
                                    <option value="HK" {{ $country == "HK"?'selected':''}}>Hong Kong R. A. E</option>
                                    <option value="HU" {{ $country == "HU"?'selected':''}}>Hungría</option>
                                    <option value="IN" {{ $country == "IN"?'selected':''}}>India</option>
                                    <option value="ID" {{ $country == "ID"?'selected':''}}>Indonesia</option>
                                    <option value="IQ" {{ $country == "IQ"?'selected':''}}>Irak</option>
                                    <option value="IR" {{ $country == "IR"?'selected':''}}>Irán</option>
                                    <option value="IE" {{ $country == "IE"?'selected':''}}>Irlanda</option>
                                    <option value="BV" {{ $country == "BV"?'selected':''}}>Isla Bouvet</option>
                                    <option value="CX" {{ $country == "CX"?'selected':''}}>Isla Christmas</option>
                                    <option value="HM" {{ $country == "HM"?'selected':''}}>Isla Heard e Islas McDonald</option>
                                    <option value="IS" {{ $country == "IS"?'selected':''}}>Islandia</option>
                                    <option value="KY" {{ $country == "KY"?'selected':''}}>Islas Caimán</option>
                                    <option value="CK" {{ $country == "CK"?'selected':''}}>Islas Cook</option>
                                    <option value="CC" {{ $country == "CC"?'selected':''}}>Islas de Cocos o Keeling</option>
                                    <option value="FO" {{ $country == "FO"?'selected':''}}>Islas Faroe</option>
                                    <option value="FJ" {{ $country == "FJ"?'selected':''}}>Islas Fiyi</option>
                                    <option value="FK" {{ $country == "FK"?'selected':''}}>Islas Malvinas Islas Falkland</option>
                                    <option value="MP" {{ $country == "MP"?'selected':''}}>Islas Marianas del norte</option>
                                    <option value="MH" {{ $country == "MH"?'selected':''}}>Islas Marshall</option>
                                    <option value="UM" {{ $country == "UM"?'selected':''}}>Islas menores de Estados Unidos</option>
                                    <option value="PW" {{ $country == "PW"?'selected':''}}>Islas Palau</option>
                                    <option value="SB" {{ $country == "SB"?'selected':''}}>Islas Salomón</option>
                                    <option value="TK" {{ $country == "TK"?'selected':''}}>Islas Tokelau</option>
                                    <option value="TC" {{ $country == "TC"?'selected':''}}>Islas Turks y Caicos</option>
                                    <option value="VI" {{ $country == "VI"?'selected':''}}>Islas Vírgenes EE.UU.</option>
                                    <option value="VG" {{ $country == "VG"?'selected':''}}>Islas Vírgenes Reino Unido</option>
                                    <option value="IL" {{ $country == "IL"?'selected':''}}>Israel</option>
                                    <option value="IT" {{ $country == "IT"?'selected':''}}>Italia</option>
                                    <option value="JM" {{ $country == "JM"?'selected':''}}>Jamaica</option>
                                    <option value="JP" {{ $country == "JP"?'selected':''}}>Japón</option>
                                    <option value="JO" {{ $country == "JO"?'selected':''}}>Jordania</option>
                                    <option value="KZ" {{ $country == "KZ"?'selected':''}}>Kazajistán</option>
                                    <option value="KE" {{ $country == "KE"?'selected':''}}>Kenia</option>
                                    <option value="KG" {{ $country == "KG"?'selected':''}}>Kirguizistán</option>
                                    <option value="KI" {{ $country == "KI"?'selected':''}}>Kiribati</option>
                                    <option value="KW" {{ $country == "KW"?'selected':''}}>Kuwait</option>
                                    <option value="LA" {{ $country == "LA"?'selected':''}}>Laos</option>
                                    <option value="LS" {{ $country == "LS"?'selected':''}}>Lesoto</option>
                                    <option value="LV" {{ $country == "LV"?'selected':''}}>Letonia</option>
                                    <option value="LB" {{ $country == "LB"?'selected':''}}>Líbano</option>
                                    <option value="LR" {{ $country == "LR"?'selected':''}}>Liberia</option>
                                    <option value="LY" {{ $country == "LY"?'selected':''}}>Libia</option>
                                    <option value="LI" {{ $country == "LI"?'selected':''}}>Liechtenstein</option>
                                    <option value="LT" {{ $country == "LT"?'selected':''}}>Lituania</option>
                                    <option value="LU" {{ $country == "LU"?'selected':''}}>Luxemburgo</option>
                                    <option value="MO" {{ $country == "MO"?'selected':''}}>Macao R. A. E</option>
                                    <option value="MG" {{ $country == "MG"?'selected':''}}>Madagascar</option>
                                    <option value="MY" {{ $country == "MY"?'selected':''}}>Malasia</option>
                                    <option value="MW" {{ $country == "MW"?'selected':''}}>Malawi</option>
                                    <option value="MV" {{ $country == "MV"?'selected':''}}>Maldivas</option>
                                    <option value="ML" {{ $country == "ML"?'selected':''}}>Malí</option>
                                    <option value="MT" {{ $country == "MT"?'selected':''}}>Malta</option>
                                    <option value="MA" {{ $country == "MA"?'selected':''}}>Marruecos</option>
                                    <option value="MQ" {{ $country == "MQ"?'selected':''}}>Martinica</option>
                                    <option value="MU" {{ $country == "MU"?'selected':''}}>Mauricio</option>
                                    <option value="MR" {{ $country == "MR"?'selected':''}}>Mauritania</option>
                                    <option value="YT" {{ $country == "YT"?'selected':''}}>Mayotte</option>
                                    <option value="MX" {{ $country == "MX"?'selected':''}}>México</option>
                                    <option value="FM" {{ $country == "FM"?'selected':''}}>Micronesia</option>
                                    <option value="MD" {{ $country == "MD"?'selected':''}}>Moldavia</option>
                                    <option value="MC" {{ $country == "MC"?'selected':''}}>Mónaco</option>
                                    <option value="MN" {{ $country == "MN"?'selected':''}}>Mongolia</option>
                                    <option value="MS" {{ $country == "MS"?'selected':''}}>Montserrat</option>
                                    <option value="MZ" {{ $country == "MZ"?'selected':''}}>Mozambique</option>
                                    <option value="NA" {{ $country == "NA"?'selected':''}}>Namibia</option>
                                    <option value="NR" {{ $country == "NR"?'selected':''}}>Nauru</option>
                                    <option value="NP" {{ $country == "NP"?'selected':''}}>Nepal</option>
                                    <option value="NI" {{ $country == "NI"?'selected':''}}>Nicaragua</option>
                                    <option value="NE" {{ $country == "NE"?'selected':''}}>Níger</option>
                                    <option value="NG" {{ $country == "NG"?'selected':''}}>Nigeria</option>
                                    <option value="NU" {{ $country == "NU"?'selected':''}}>Niue</option>
                                    <option value="NF" {{ $country == "NF"?'selected':''}}>Norfolk</option>
                                    <option value="NO" {{ $country == "NO"?'selected':''}}>Noruega</option>
                                    <option value="NC" {{ $country == "NC"?'selected':''}}>Nueva Caledonia</option>
                                    <option value="NZ" {{ $country == "NZ"?'selected':''}}>Nueva Zelanda</option>
                                    <option value="OM" {{ $country == "OM"?'selected':''}}>Omán</option>
                                    <option value="PA" {{ $country == "PA"?'selected':''}}>Panamá</option>
                                    <option value="PG" {{ $country == "PG"?'selected':''}}>Papua Nueva Guinea</option>
                                    <option value="PK" {{ $country == "PK"?'selected':''}}>Paquistán</option>
                                    <option value="PY" {{ $country == "PY"?'selected':''}}>Paraguay</option>
                                    <option value="PE" {{ $country == "PE"?'selected':''}}>Perú</option>
                                    <option value="PN" {{ $country == "PN"?'selected':''}}>Pitcairn</option>
                                    <option value="PF" {{ $country == "PF"?'selected':''}}>Polinesia francesa</option>
                                    <option value="PL" {{ $country == "PL"?'selected':''}}>Polonia</option>
                                    <option value="PT" {{ $country == "PT"?'selected':''}}>Portugal</option>
                                    <option value="PR" {{ $country == "PR"?'selected':''}}>Puerto Rico</option>
                                    <option value="QA" {{ $country == "QA"?'selected':''}}>Qatar</option>
                                    <option value="UK" {{ $country == "UK"?'selected':''}}>Reino Unido</option>
                                    <option value="CF" {{ $country == "CF"?'selected':''}}>República Centroafricana</option>
                                    <option value="CZ" {{ $country == "CZ"?'selected':''}}>República Checa</option>
                                    <option value="ZA" {{ $country == "ZA"?'selected':''}}>República de Sudáfrica</option>
                                    <option value="CD" {{ $country == "CD"?'selected':''}}>República Democrática del Congo Zaire</option>
                                    <option value="DO" {{ $country == "DO"?'selected':''}}>República Dominicana</option>
                                    <option value="RE" {{ $country == "RE"?'selected':''}}>Reunión</option>
                                    <option value="RW" {{ $country == "RW"?'selected':''}}>Ruanda</option>
                                    <option value="RO" {{ $country == "RO"?'selected':''}}>Rumania</option>
                                    <option value="RU" {{ $country == "RU"?'selected':''}}>Rusia</option>
                                    <option value="WS" {{ $country == "WS"?'selected':''}}>Samoa</option>
                                    <option value="AS" {{ $country == "AS"?'selected':''}}>Samoa occidental</option>
                                    <option value="KN" {{ $country == "KN"?'selected':''}}>San Kitts y Nevis</option>
                                    <option value="SM" {{ $country == "SM"?'selected':''}}>San Marino</option>
                                    <option value="PM" {{ $country == "PM"?'selected':''}}>San Pierre y Miquelon</option>
                                    <option value="VC" {{ $country == "VC"?'selected':''}}>San Vicente e Islas Granadinas</option>
                                    <option value="SH" {{ $country == "SH"?'selected':''}}>Santa Helena</option>
                                    <option value="LC" {{ $country == "LC"?'selected':''}}>Santa Lucía</option>
                                    <option value="ST" {{ $country == "ST"?'selected':''}}>Santo Tomé y Príncipe</option>
                                    <option value="SN" {{ $country == "SN"?'selected':''}}>Senegal</option>
                                    <option value="YU" {{ $country == "YU"?'selected':''}}>Serbia y Montenegro</option>
                                    <option value="SC" {{ $country == "SC"?'selected':''}}>Seychelles</option>
                                    <option value="SL" {{ $country == "SL"?'selected':''}}>Sierra Leona</option>
                                    <option value="SG" {{ $country == "SG"?'selected':''}}>Singapur</option>
                                    <option value="SY" {{ $country == "SY"?'selected':''}}>Siria</option>
                                    <option value="SO" {{ $country == "SO"?'selected':''}}>Somalia</option>
                                    <option value="LK" {{ $country == "LK"?'selected':''}}>Sri Lanka</option>
                                    <option value="SZ" {{ $country == "SZ"?'selected':''}}>Suazilandia</option>
                                    <option value="SD" {{ $country == "SD"?'selected':''}}>Sudán</option>
                                    <option value="SE" {{ $country == "SE"?'selected':''}}>Suecia</option>
                                    <option value="CH" {{ $country == "CH"?'selected':''}}>Suiza</option>
                                    <option value="SR" {{ $country == "SR"?'selected':''}}>Surinam</option>
                                    <option value="SJ" {{ $country == "SJ"?'selected':''}}>Svalbard</option>
                                    <option value="TH" {{ $country == "TH"?'selected':''}}>Tailandia</option>
                                    <option value="TW" {{ $country == "TW"?'selected':''}}>Taiwán</option>
                                    <option value="TZ" {{ $country == "TZ"?'selected':''}}>Tanzania</option>
                                    <option value="TJ" {{ $country == "TJ"?'selected':''}}>Tayikistán</option>
                                    <option value="IO" {{ $country == "IO"?'selected':''}}>Territorios británicos del océano Indico</option>
                                    <option value="TF" {{ $country == "TF"?'selected':''}}>Territorios franceses del sur</option>
                                    <option value="TP" {{ $country == "TP"?'selected':''}}>Timor Oriental</option>
                                    <option value="TG" {{ $country == "TG"?'selected':''}}>Togo</option>
                                    <option value="TO" {{ $country == "TO"?'selected':''}}>Tonga</option>
                                    <option value="TT" {{ $country == "TT"?'selected':''}}>Trinidad y Tobago</option>
                                    <option value="TN" {{ $country == "TN"?'selected':''}}>Túnez</option>
                                    <option value="TM" {{ $country == "TM"?'selected':''}}>Turkmenistán</option>
                                    <option value="TR" {{ $country == "TR"?'selected':''}}>Turquía</option>
                                    <option value="TV" {{ $country == "TV"?'selected':''}}>Tuvalu</option>
                                    <option value="UA" {{ $country == "UA"?'selected':''}}>Ucrania</option>
                                    <option value="UG" {{ $country == "UG"?'selected':''}}>Uganda</option>
                                    <option value="UY" {{ $country == "UY"?'selected':''}}>Uruguay</option>
                                    <option value="UZ" {{ $country == "UZ"?'selected':''}}>Uzbekistán</option>
                                    <option value="VU" {{ $country == "VU"?'selected':''}}>Vanuatu</option>
                                    <option value="VE" {{ $country == "VE"?'selected':''}}>Venezuela</option>
                                    <option value="VN" {{ $country == "VN"?'selected':''}}>Vietnam</option>
                                    <option value="WF" {{ $country == "WF"?'selected':''}}>Wallis y Futuna</option>
                                    <option value="YE" {{ $country == "YE"?'selected':''}}>Yemen</option>
                                    <option value="ZM" {{ $country == "ZM"?'selected':''}}>Zambia</option>
                                    <option value="ZW" {{ $country == "ZW"?'selected':''}}>Zimbabue</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn button-style-2 text-white font-weight-bold pl-5 pr-5 my-3" style="font-size: 1.2rem;">Buscar</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
        @forelse($albums as $album)
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card h-100 border-0">
                    <a href="{{ route('albums.show', [$album->id]) }}" title="Ver álbum">
                        <img src="{{asset('/storage/albums/'.$album->cover_photo)}}" class="card-img-top card-header p-0" style="height: 200px; object-fit: cover">
                    </a>
                    <div class="card-body py-3 px-1">
                        <h5 class="card-title"><a href="{{ route('albums.show', [$album->id]) }}" title="Ver álbum">{{$album->name}}</a></h5>
                        @if (strlen($album->description) > 100)
                            <p class="card-text text-muted">
                                {{substr($album->description, 0, 100)}}<span class="collapse" id="viewFullDescription{{$album->id}}">{{substr($album->description, 100, strlen($album->description))}}</span>
                                <a data-toggle="collapse" data-target="#viewFullDescription{{$album->id}}" href="#viewFullDescription{{$album->id}}"> Ver mas... &raquo;</a>
                            </p>
                        @else
                            <p class="card-text text-muted">
                                {{$album->description}}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <div class="my-4 text-center mx-auto">
                    <h4 class="text-warning">No se han encontrado álbumes.</h4>
                </div>
        @endforelse
    </div>

    <div class="justify-content-center">{{ $albums->onEachSide(3)->links() }}</div>
</div>
@endsection

@section('loadScripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
