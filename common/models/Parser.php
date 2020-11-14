<?php

namespace common\models;


use Yii;

/**
 * ModelsStatusJournalController implements the CRUD actions for ModelsStatusJournal model.
 */
class Parser
{
    public $result;
    public $str;
    public $patter;


    function __construct()
    {

        // ПАТТЕРНЫ ДЛЯ ПАРСИНГА
        // ПАТТЕРНЫ ДЛЯ ПАРСИНГА
        // ПАТТЕРНЫ ДЛЯ ПАРСИНГА
        // ПАТТЕРНЫ ДЛЯ ПАРСИНГА
        // ПАТТЕРНЫ ДЛЯ ПАРСИНГА
        //
        $this->patter['type'] = ParserGemstypes::find()->asArray()->all();
        //сортируем паттерны от длинных к коротким
        usort($this->patter['type'], function ($a, $b) {
            return mb_strlen($b['name_1cparser_gemstype'], 'UTF-8') - mb_strlen($a['name_1cparser_gemstype'], 'UTF-8');
        });
        //
        // СУФФИКСЫ ЗАРЕЗЕРВИРОВАННЫЕ - НАЗВАНИЯ камней из основной базы!
        $this->patter['type_suffix'] = ParserGemstypeReservedkeys::find()->asArray()->all();
        //сортируем паттерны от длинных к коротким
        usort($this->patter['type_suffix'], function ($a, $b) {
            return mb_strlen($b['keyword_1cparser_grk'], 'UTF-8') - mb_strlen($a['keyword_1cparser_grk'], 'UTF-8');
        });

        // НАПОМИНАЮ !!! стандартные значения ключевиков мы тоже пробегаем парсером!!
        // ТИПЫ - НАЗВАНИЯ камней из основной базы!
        $this->patter['type_main'] = ProductType::find()->asArray()->all();
        //сортируем паттерны от длинных к коротким
        usort($this->patter['type_main'], function ($a, $b) {
            return mb_strlen($b['name_product_type'], 'UTF-8') - mb_strlen($a['name_product_type'], 'UTF-8');
        });


        /*  // огранка
          $this->patter['cutshape'] = [
              'круг',
              'круг/конкейв',
              'квадрат',
              'круг /Ф/С',
              'трілліон (033)',
              'трілліон',
              '(45) квадрат',
              'октагон',
              'гудзик',
              'Кр-57',
          ];*/

        $this->patter['cutshape'] = ParserGemshapes::find()->asArray()->all();
        //сортируем паттерны от длинных к коротким
        usort($this->patter['cutshape'], function ($a, $b) {
            return mb_strlen($b['name_1cparser_shapes'], 'UTF-8') - mb_strlen($a['name_1cparser_shapes'], 'UTF-8');
        });

        // НАПОМИНАЮ !!! стандартные значения огранок мы тоже пробегаем парсером!!
        // ТИПЫ - НАЗВАНИЯ камней из основной базы!
        $this->patter['cutshape_main'] = ProductsShapes::find()->asArray()->all();
        //сортируем паттерны от длинных к коротким
        usort($this->patter['cutshape_main'], function ($a, $b) {
            return mb_strlen($b['name_shape'], 'UTF-8') - mb_strlen($a['name_shape'], 'UTF-8');
        });


        //        //цвет
        //        $this->patter['color'] = [
        //            'чорний',
        //            'зелений',
        //            'Pink Rose',
        //            'pink',
        //            'димчатий',
        //            'Lilac',
        //            'африканський кабошон',
        //            'олександріт.',
        //            'Bright red',
        //            'green',
        //            'бріолет',
        //            'біла',
        //        ];

        $this->patter['color'] = ParserGemscolors::find()->asArray()->all();
        //сортируем паттерны от длинных к коротким
        usort($this->patter['color'], function ($a, $b) {
            return mb_strlen($b['name_1cparser_colors'], 'UTF-8') - mb_strlen($a['name_1cparser_colors'], 'UTF-8');
        });
        // НАПОМИНАЮ !!! стандартные значения ключевиков мы тоже пробегаем парсером!!
        // ТИПЫ - НАЗВАНИЯ камней из основной базы!
        $this->patter['color_main'] = ProductsColors::find()->asArray()->all();
        //сортируем паттерны от длинных к коротким
        usort($this->patter['color_main'], function ($a, $b) {
            return mb_strlen($b['name_color'], 'UTF-8') - mb_strlen($a['name_color'], 'UTF-8');
        });
        $this->patter['color_defaults'] = ParserGemscolorsDefaulttype::find()->asArray()->all();
        //сортировать не надо


        // ничего не значащий мусор
        $this->patter['stuff'] = explode("\r\n", Yii::$app->get('settings')->get('stuff.skeywords'));

        // еденицы измрения
        $this->patter['amount'] = explode("\r\n", Yii::$app->get('settings')->get('amount.akeywords'));


        // КОНЕЦ СБОРА ПАТЕРНОВ ДЛЯ ПАРСИНГА
        // КОНЕЦ СБОРА ПАТЕРНОВ ДЛЯ ПАРСИНГА
        // КОНЕЦ СБОРА ПАТЕРНОВ ДЛЯ ПАРСИНГА


    }


    // здесь только анализ, массив значений и диагностика
    // накопление результата и его сохранение вне этой функции
    public function parser1c($str_input)
    {
        $this->str = $str_input;
        $this->str = trim(str_replace(['   ', '  '], ' ', $this->str));


        // обнуляем
        $this->result = [
            'type_id' => null,
            'brand' => '',
            'color_id' => null,
            'size' => '',
            'cutshape_id' => null,
            'amount' => '',
            'params' => '',
            'name_suffix_id' => null,
            'name_suffix_str' => '',
            'notrecg_str' => '',
            '1c_str' => $this->str,
        ];


        $m = "----<h2>строка из 1c : " . $this->str . "</h2>";
        $error = false;


        // подчищаем - ничего не значящий мусор
        // подчищаем - ничего не значящий мусор
        // подчищаем - ничего не значящий мусор
        //echo $this->str;
        foreach ($this->patter['stuff'] AS $stuff) {
            $this->str = preg_replace('/' . $stuff . '/ui', '', $this->str);
        }


        // в начале - т.к. есть ключевики которые не надо удалять из строки
        //ШАГ2 БРЕНД (сваровски синтетика и модельные)
        //ШАГ2 БРЕНД (сваровски синтетика и модельные)
        //ШАГ2 БРЕНД (сваровски синтетика и модельные)

        //Yii::$app->get('settings')->get('brands.drag_natural_machineautokolibred_signiti')
        //Yii::$app->get('settings')->get('brands.drag_artificial_machineautokolibred_other_sintetic')
        //Yii::$app->get('settings')->get('brands.nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon')
        //Yii::$app->get('settings')->get('brands.drag_artificial_machineautokolibred_swarowski')
        //Yii::$app->get('settings')->get('brands.drag_natural_handmademodelnye')
        //
        //Порядок определения брендов должен быть таков:!!!!!!!!!!!!!!!!!!!!
        //brands.nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon
        //brands.drag_artificial_machineautokolibred_swarowski
        //brands.drag_artificial_machineautokolibred_other_sintetic
        //brands.drag_natural_machineautokolibred_signiti
        //brands.drag_natural_handmademodelnye


        //
        //
        //nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon
        //nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon
        //nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon
        if (!$this->result['brand']) {
            $a = explode("\r\n", Yii::$app->get('settings')->get('brands.nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon'));
            //сортируем паттерны от длинных к коротким
            usort($a, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
            foreach ($a AS $stuff) {
                $stuff = trim($stuff);
                if (preg_match('/' . $this->back_slash_spec_chars($stuff) . '/ui', $this->str)) {
                    // Тут есть ризнак ТИПА КАМНЯ - не вырезаем Куб. оксид цирк
                    //$this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff) . '/ui', '', $this->str);
                    // ТУТ ПОТОМ ИЛИ ЗАМЕНИТЬ НА АЙДИШКУ ИЛИ ТАК ОСТАВИТЬ СЛОВО
                    $this->result['brand'] = "brands.nedrag_artificial_machineautokolibred_swarowski_kuboxidcirkon";
                    break;
                }
            }
        }

        //brands.drag_artificial_machineautokolibred_swarowski
        //brands.drag_artificial_machineautokolibred_swarowski
        //brands.drag_artificial_machineautokolibred_swarowski
        if (!$this->result['brand']) {
            $a = explode("\r\n", Yii::$app->get('settings')->get('brands.drag_artificial_machineautokolibred_swarowski'));
            //сортируем паттерны от длинных к коротким
            usort($a, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
            foreach ($a AS $stuff) {
                $stuff = trim($stuff);
                if (preg_match('/' . $this->back_slash_spec_chars($stuff) . '/ui', $this->str)) {
                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff) . '/ui', '', $this->str);
                    // ТУТ ПОТОМ ИЛИ ЗАМЕНИТЬ НА АЙДИШКУ ИЛИ ТАК ОСТАВИТЬ СЛОВО
                    $this->result['brand'] = "brands.drag_artificial_machineautokolibred_swarowski";
                    break;
                }
            }
        }


        //drag_artificial_machineautokolibred_other_sintetic
        //drag_artificial_machineautokolibred_other_sintetic
        //drag_artificial_machineautokolibred_other_sintetic
        //три цифры в описании в скобках = синт
        if (!$this->result['brand'] AND preg_match('/\([0-9]{3}\)/ui', $this->str)) {
            $this->str = preg_replace('/\([0-9]{3}\)/ui', '', $this->str);
            $this->result['brand'] = "drag_artificial_machineautokolibred_other_sintetic";
        }


        if (!$this->result['brand']) {
            $a = explode("\r\n", Yii::$app->get('settings')->get('brands.drag_artificial_machineautokolibred_other_sintetic'));
            //сортируем паттерны от длинных к коротким
            usort($a, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
            foreach ($a AS $stuff) {
                $stuff = trim($stuff);
                if (preg_match('/' . $this->back_slash_spec_chars($stuff) . '/ui', $this->str)) {
                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff) . '/ui', '', $this->str);
                    // ТУТ ПОТОМ ИЛИ ЗАМЕНИТЬ НА АЙДИШКУ ИЛИ ТАК ОСТАВИТЬ СЛОВО
                    $this->result['brand'] = "brands.drag_artificial_machineautokolibred_other_sintetic";
                    break;
                }
            }
        }


        //brands.drag_natural_machineautokolibred_signiti
        //brands.drag_natural_machineautokolibred_signiti
        //brands.drag_natural_machineautokolibred_signiti
        if (!$this->result['brand']) {
            $a = explode("\r\n", Yii::$app->get('settings')->get('brands.drag_natural_machineautokolibred_signiti'));
            //сортируем паттерны от длинных к коротким
            usort($a, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
            foreach ($a AS $stuff) {
                $stuff = trim($stuff);
                if (preg_match('/' . $this->back_slash_spec_chars($stuff) . '/ui', $this->str)) {
                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff) . '/ui', '', $this->str);
                    // ТУТ ПОТОМ ИЛИ ЗАМЕНИТЬ НА АЙДИШКУ ИЛИ ТАК ОСТАВИТЬ СЛОВО
                    $this->result['brand'] = "brands.drag_natural_machineautokolibred_signiti";
                    break;
                }
            }
        }


        //brands.drag_natural_handmademodelnye
        //brands.drag_natural_handmademodelnye
        //brands.drag_natural_handmademodelnye
        if (!$this->result['brand']) {
            $a = explode("\r\n", Yii::$app->get('settings')->get('brands.drag_natural_handmademodelnye'));
            //сортируем паттерны от длинных к коротким
            usort($a, function ($a, $b) {
                return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8');
            });
            foreach ($a AS $stuff) {
                $stuff = trim($stuff);
                if (preg_match('/' . $this->back_slash_spec_chars($stuff) . '/ui', $this->str)) {
                    // здесь признак еденицы ижмерения _ НЕ ВЫРЕЗАЕМ !!!!!
//                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff) . '/ui', '', $this->str);

                    // ТУТ ПОТОМ ИЛИ ЗАМЕНИТЬ НА АЙДИШКУ ИЛИ ТАК ОСТАВИТЬ СЛОВО
                    $this->result['brand'] = "brands.drag_natural_handmademodelnye";
                    break;
                }
            }
        }


        if (!$this->result['brand']) $this->result['brand'] = "МОЖЕТ модельные ???? :)";


        // шаги от более высокой вероятности и гарантии к меньшей встречаемости слов
        // шаги от более высокой вероятности и гарантии к меньшей встречаемости слов
        // шаги от более высокой вероятности и гарантии к меньшей встречаемости слов
        //
        //ШАГ0 - НЕ импортируем выборочные ключевики!
        foreach ($this->patter['type'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_1cparser_gemstype']) . '/ui', $this->str)) {
                // если  скипаем
                // УСТАРЕЛО - если ТИП + ЦВЕТ + ОГРАНКА НЕ определена - пропускаем
                // БАЗУ ЗНАЧЕНИЙ СКИПАТЬ - ЗДЕСЬ РЕШИЛИ НЕ РАСИРЯТЬ
                if ($stuff['exclude_1cparser_gemstype']) {
                    $m .= '<br>это НЕ импортируем = ' . $stuff['name_1cparser_gemstype'];
                    // парсер стоп
                    return ['error' => false, 'comment' => $m, 'result' => false];
                } //если не скипаем
                else {
                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['name_1cparser_gemstype']) . '/ui', '', $this->str);
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['type_id'] = $stuff['product_type_id'];
                    break;
                }
            }
        }


        // пройдемся по стандарнтым названиям камней из базы если название еще не опрелелено
        // пройдемся по стандарнтым названиям камней из базы если название еще не опрелелено
        // пройдемся по стандарнтым названиям камней из базы если название еще не опрелелено
        if (!$this->result['type_id'])
            foreach ($this->patter['type_main'] AS $stuff) {
                if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_product_type']) . '/ui', $this->str)) {
                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['name_product_type']) . '/ui', '', $this->str);
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['type_id'] = $stuff['id_product_type'];
                    break;
                }
            }


        //ШАГ1 ЕДЕНИЦЫ ИЗМЕРЕНИЯ ПЕРЕД БРЕНДОМ !!!
        //ШАГ1 ЕДЕНИЦЫ ИЗМЕРЕНИЯ ПЕРЕД БРЕНДОМ !!!
        foreach ($this->patter['amount'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff) . '/ui', $this->str)) {
                $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff) . '/ui', '', $this->str);
                $this->result['amount'] = $stuff;
                break;
            }
        }


        //
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        foreach ($this->patter['color'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_1cparser_colors']) . '/ui', $this->str)) {
                $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['name_1cparser_colors']) . '/ui', '', $this->str);
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                $this->result['color_id'] = $stuff['product_color_id'];
                break;
            }
        }
        // пройдемся по стандарнтым названиям камней из базы
        if (!$this->result['color_id'])
            foreach ($this->patter['color_main'] AS $stuff) {
                if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_color']) . '/ui', $this->str)) {
                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['name_color']) . '/ui', '', $this->str);
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['color_id'] = $stuff['id_color'];
                    break;
                }
            }
        // цвет все еще не определен?
        // берем цвет из массива стандартных цветов для типов камней
        if (!$this->result['color_id'] AND isset($this->result['type_id'])) {
            foreach ($this->patter['color_defaults'] AS $stuff) {
                if ($stuff['product_type_id'] == $this->result['type_id']) {
                    $this->result['color_id'] = $stuff['product_color_id'];
                    break;
                }
            }
        }


        //ШАГ4 ОГРАНКА
        //ШАГ4 ОГРАНКА
        //ШАГ4 ОГРАНКА
        foreach ($this->patter['cutshape'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_1cparser_shapes']) . '/ui', $this->str)) {
                $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['name_1cparser_shapes']) . '/ui', '', $this->str);
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                $this->result['cutshape_id'] = $stuff['product_shape_id'];


                // Если огранка редкаи и мы ее связали в огранка "ДРУГИЕ" вынесем ее в суфикс названия камня.
                if ($stuff['product_shape_id'] == 31) {
                    $this->result['name_suffix_str'] = $stuff['name_1cparser_shapes'];
                }


                break;
            }
        }
        // пройдемся по стандарнтым огранкам камней из базы
        // пройдемся по стандарнтым огранкам камней из базы
        if (!$this->result['cutshape_id'])
            foreach ($this->patter['cutshape_main'] AS $stuff) {
                if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_shape']) . '/ui', $this->str)) {
                    $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['name_shape']) . '/ui', '', $this->str);
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['cutshape_id'] = $stuff['id_shape'];
                    break;
                }
            }
        //
        //ШАГ выискиваем в мусоре после названия - может остались зарезервированные суффиксы
        //ШАГ выискиваем в мусоре после названия - может остались зарезервированные суффиксы
        //ШАГ выискиваем в мусоре после названия - может остались зарезервированные суффиксы
//        print_r($this->patter['type_suffix']);
//        exit;
//        [id_1cparser_grk] => 5
//            [keyword_1cparser_grk] => багородн.
//    [russian_1cparser_grk] => благородный
        foreach ($this->patter['type_suffix'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['keyword_1cparser_grk']) . '/ui', $this->str)) {
                $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['keyword_1cparser_grk']) . '/ui', '', $this->str);
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                $this->result['name_suffix_id'] = $stuff['id_1cparser_grk'];
                break;
            }
        }


//
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//        echo "{ $this->str }";
        if (preg_match_all('/[\d]{1,4}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}([\w ,]*)/ui', $this->str, $params)) {
            $this->result['params'] = trim($params[1][0], " ,.-");
            if ($this->result['params']) {
                $this->str = preg_replace('/' . $this->result['params'] . '/ui', '', $this->str);
            }
        }


//РАЗМЕРЫ
//РАЗМЕРЫ
//РАЗМЕРЫ
        if (preg_match_all('/([\d]{1,4}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4})/ui', $this->str, $size)) {
            $this->str = preg_replace('/([\d]{1,4}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4})/ui', '', $this->str);
            // из всех возможных результатов берем последний блок цифр
            $size[0][(sizeof($size[0]) - 1)] = str_replace([",", "х"], [".", "*"], $size[0][(sizeof($size[0]) - 1)]);
            $this->result['size'] = trim($size[0][(sizeof($size[0]) - 1)], ",.-");
        }

//мусор подчищаем
//мусор подчищаем
//мусор подчищаем
        $this->str = trim(str_replace([' .', ' ,'], '', $this->str));


        if (trim($this->str)) {
            $m .= "</b><br>остаток строки разбора: <b><font color=red>" . $this->str . "</font></b> - требуется уточнить ЧТО ЗА ФРАГМЕНТ ОСТАЛСЯ для обучения парсера...<br>";
            $this->result['notrecg_str'] = trim($this->str);
        }


// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
        if ($this->result['type_id']) {
            $type_model = ProductType::findOne(['id_product_type' => $this->result['type_id']]);
            $m .= "<br><b>камень:</b> <a href='/product-type/view?id=" . $this->result['type_id'] . "'>" . $type_model->name_product_type . "</a>";
        } else {
            $m .= "<br><b>камень:</b> <font color=red>Ошибка определения Типа камня из существующих в базе.</font> или строка из 1с не содержит название камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
            $error = true;
        }

//
        if ($this->result['color_id']) {
            $type_model = ProductsColors::findOne(['id_color' => $this->result['color_id']]);
            $m .= "<br><b>цвет:</b> <a href='/products-colors/view?id=" . $this->result['color_id'] . "'>" . $type_model->name_color . "</a>";
        } else {
            $m .= "<br><b>цвет:</b> <font color=red>Ошибка определения ЦВЕТ камня из существующих в базе.</font> или строка из 1с не содержит ЦВЕТА камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
            $error = true;

        }

//
        if ($this->result['shape']) {
            $type_model = ProductsShapes::findOne(['id_shape' => $this->result['shape']]);
            $m .= "<br><b>форма:</b>  <a href='/products-shapes/view?id=" . $this->result['shape'] . "'>" . $type_model->name_shape . "</a>";
        } else {
            $m .= "<br><b>форма:</b>  <font color=red>Ошибка определения ФОРМЫ ОГРАНКИ камня из существующих в базе.</font> или строка из 1с не содержит ФОРМЫ ОГРАНКИ камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
            $error = true;

        }

//
        $m .= "<br><b>бренд:</b> " . $this->result['brand'];
        if ($this->result['size'] <> "") {
            $m .= "<br><b>размер:</b> " . $this->result['size'];
        } else {
            $m .= "<br><b>размер:</b><font color=red>нет размеров</font> ";
        }
//

        // СУФИКС найден зарезервированный ID справочника суфиксов к названию
        if ($this->result['name_suffix_id']) {
            $type_model = ParserGemstypeReservedkeys::findOne(['id_1cparser_grk' => $this->result['name_suffix_id']]);
            $m .= "<br><b>суффикс названия:</b>  <a href='/parser-gemstype-reservedkeys/update?id=" . $this->result['name_suffix_id'] . "'>" . $type_model->russian_1cparser_grk . "</a>";
        } else {
            // НЕ обязательное поле
//            $m .= "<br><b>форма:</b>  <font color=red>Ошибка определения ФОРМЫ ОГРАНКИ камня из существующих в базе.</font> или строка из 1с не содержит ФОРМЫ ОГРАНКИ камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
//            $error = true;

        }


        // СУФИКС для редких огранок - ошранку присваиваем "ДРУГИЕ" но саму редкую огранку оставляем в названии
        if ($this->result['name_suffix_str']) {
            $m .= "<br><b>2й суффикс названия - редкий тип огранки \"Другие\" : </b>  " . $this->result['name_suffix_str'] . " ";
        } else {
            // НЕ обязательное поле
//            $m .= "<br><b>форма:</b>  <font color=red>Ошибка определения ФОРМЫ ОГРАНКИ камня из существующих в базе.</font> или строка из 1с не содержит ФОРМЫ ОГРАНКИ камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
//            $error = true;

        }

        if ($this->result['amount'] <> "") {
            $m .= "<br><b>еденицы измерения:</b> " . $this->result['amount'];
        } else {
            $m .= "<br><b>еденицы измерения:</b> <font color=red>нет еденицы измерения</font> ";
        }

//
        if ($this->result['params'] <> "") $m .= "<br><b>харакетристики:</b> " . $this->result['params'];


        return ['error' => $error, 'comment' => $m, 'result' => $this->result];


    }



    // здесь только анализ, массив значений и диагностика
    // накопление результата и его сохранение вне этой функции
    public function parserExcelPrice($excell_row_array)
    {

        /**
         * Тип огранки, Происхождение - натур синтетик, Эксклюзив -  определяются с наруде по переключателю БРЭНД
         * что выбирает оператор при имепорте Эксэля
         */


        // обнуляем
        $this->result = [
            'type_product_id' => '',
            'color_id' => '',
            'shape' => '',


            'size_h' => 0,
            'size_w' => 0,
            'size_d' => 0,

            'weight' => '',
            'price' => '',


            'characteristics_str' => '',
            'this_is_nabor' => '',

            'stock_karats' => '', // наличие
            'stock_points' => '', // наличие

            '1c_str' => implode('; ', $excell_row_array),

            // Что за херня??
            //            'amount' => '', = еденицы измрения ПОЗЖЕ РАЗРУЛИТЬ
            //            'name_suffix_id' => null, = какйто суфкисы справлчник зареганых названий  ПОЗЖЕ РАЗРУЛИТЬ
            'name_suffix' => '',

            'images' => [],


            'nabor_numberstones' => NULL,// по дефолту признак что этон набор и количество камней в нем


        ];


        $error = false;
        $m = '';


        // шаги от более высокой вероятности и гарантии к меньшей встречаемости слов
        // шаги от более высокой вероятности и гарантии к меньшей встречаемости слов
        // шаги от более высокой вероятности и гарантии к меньшей встречаемости слов
        //
        //ШАГ0 - НЕ импортируем выборочные ключевики!
        foreach ($this->patter['type'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_1cparser_gemstype']) . '/ui', $excell_row_array['A'])) {
                // если  скипаем
                // УСТАРЕЛО - если ТИП + ЦВЕТ + ОГРАНКА НЕ определена - пропускаем
                // БАЗУ ЗНАЧЕНИЙ СКИПАТЬ - ЗДЕСЬ РЕШИЛИ НЕ РАСИРЯТЬ
                // ПРизнако плохого слова ...
                if ($stuff['exclude_1cparser_gemstype']) {
                    $m = '<br>это НЕ импортируем = ' . $stuff['name_1cparser_gemstype'];
                    // парсинг закончен этог единицы
                    return ['error' => false, 'comment' => $m, 'result' => false];
                } //если не скипаем
                else {
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['type_product_id'] = $stuff['product_type_id'];
                    break;
                }
            }
        }


        // пройдемся по стандарнтым названиям камней из базы если название еще не опрелелено
        // пройдемся по стандарнтым названиям камней из базы если название еще не опрелелено
        // пройдемся по стандарнтым названиям камней из базы если название еще не опрелелено
        if (!$this->result['type_product_id'])
            foreach ($this->patter['type_main'] AS $stuff) {
                if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_product_type']) . '/ui', $excell_row_array['A'])) {
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['type_product_id'] = $stuff['id_product_type'];
                    break;
                }
            }


        /*  //ШАГ1 ЕДЕНИЦЫ ИЗМЕРЕНИЯ ПЕРЕД БРЕНДОМ !!!
          //ШАГ1 ЕДЕНИЦЫ ИЗМЕРЕНИЯ ПЕРЕД БРЕНДОМ !!!
          foreach ($this->patter['amount'] AS $stuff) {
              if (preg_match('/' . $this->back_slash_spec_chars($stuff) . '/ui', !!$this->str)) {
                  $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff) . '/ui', '', !!$this->str);
                  $this->result['amount'] = $stuff;
                  break;
              }
          }*/


        //
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        //ШАГ3 ЦВЕТ
        foreach ($this->patter['color'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_1cparser_colors']) . '/ui', $excell_row_array['B'])) {
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                $this->result['color_id'] = $stuff['product_color_id'];
                break;
            }
        }
        // пройдемся по стандарнтым названиям камней из базы
        if (!$this->result['color_id'])
            foreach ($this->patter['color_main'] AS $stuff) {
                if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_color']) . '/ui', $excell_row_array['B'])) {
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['color_id'] = $stuff['id_color'];
                    break;
                }
            }
        // цвет все еще не определен?
        // берем цвет из массива стандартных цветов для типов камней
        if (!$this->result['color_id'] AND isset($this->result['type_id'])) {
            foreach ($this->patter['color_defaults'] AS $stuff) {
                if ($stuff['product_type_id'] == $this->result['type_id']) {
                    $this->result['color_id'] = $stuff['product_color_id'];
                    break;
                }
            }
        }


        //ШАГ4 ОГРАНКА
        //ШАГ4 ОГРАНКА
        //ШАГ4 ОГРАНКА
        foreach ($this->patter['cutshape'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_1cparser_shapes']) . '/ui', $excell_row_array['C'])) {
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                $this->result['shape'] = $stuff['product_shape_id'];

                // Если огранка редкаи и мы ее связали в огранка "ДРУГИЕ" вынесем ее в суфикс названия камня.
                if ($stuff['product_shape_id'] == 31) {
                    $this->result['name_suffix'] = $stuff['name_1cparser_shapes'];
                }
                break;
            }
        }
        // пройдемся по стандарнтым огранкам камней из базы
        // пройдемся по стандарнтым огранкам камней из базы
        if (!$this->result['shape'])
            foreach ($this->patter['cutshape_main'] AS $stuff) {
                if (preg_match('/' . $this->back_slash_spec_chars($stuff['name_shape']) . '/ui', $excell_row_array['C'])) {
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                    $this->result['shape'] = $stuff['id_shape'];
                    break;
                }
            }
        //
        //ШАГ выискиваем в мусоре после названия - может остались зарезервированные суффиксы
        //ШАГ выискиваем в мусоре после названия - может остались зарезервированные суффиксы
        //ШАГ выискиваем в мусоре после названия - может остались зарезервированные суффиксы
        //        print_r($this->patter['type_suffix']);
        //        exit;
        //        [id_1cparser_grk] => 5
        //            [keyword_1cparser_grk] => багородн.
        //    [russian_1cparser_grk] => благородный
        //
        /*
        foreach ($this->patter['type_suffix'] AS $stuff) {
            if (preg_match('/' . $this->back_slash_spec_chars($stuff['keyword_1cparser_grk']) . '/ui', $this->str)) {
                $this->str = preg_replace('/' . $this->back_slash_spec_chars($stuff['keyword_1cparser_grk']) . '/ui', '', $this->str);
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                // ВАЖНО ЗДЕСЬ НА ВЫХОДЕ ID!!!
                $this->result['name_suffix_id'] = $stuff['id_1cparser_grk'];
                break;
            }
        }*/


//
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//ХАРАКТЕРИТСИКИ - обычно чразу после размеров}
//        echo "{ $this->str }";
        /* if (preg_match_all('/[\d]{1,4}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}[х*-]{0,1}[\d.,]{0,4}([\w ,]*)/ui', $this->str, $params)) {
             $this->result['params'] = trim($params[1][0], " ,.-");
             if ($this->result['params']) {
                 $this->str = preg_replace('/' . $this->result['params'] . '/ui', '', $this->str);
             }
         }*/


//РАЗМЕРЫ
//РАЗМЕРЫ
//РАЗМЕРЫ
        $excell_row_array['D'] = str_replace(',', '.', $excell_row_array['D']);
        if (preg_match_all('/([\d]{1,4}[\d.,]{0,4})[xх*-]{0,1}([\d.,]{0,4})[xх*-]{0,1}([\d.,]{0,4})/ui', $excell_row_array['D'], $size)) {
            // из всех возможных результатов берем последний блок цифр
            if ($size[1][0]) $this->result['size_h'] = $size[1][0];
            if ($size[2][0]) {
                $this->result['size_w'] = $size[2][0];
            } // навреное круг
            else {
                $this->result['size_w'] = $size[1][0];
            }
            if ($size[3][0]) $this->result['size_d'] = $size[3][0];
        }

//Вес
//Вес
//Вес
        $excell_row_array['E'] = str_replace(',', '.', $excell_row_array['E']);
        $this->result['weight'] = $excell_row_array['E'];

//Цена
//Цена
//Цена
        $excell_row_array['F'] = str_replace(',', '.', $excell_row_array['F']);
        $this->result['price'] = $excell_row_array['F'];
// наличие
        // еслинет или пустотот а или ябучее слов НИ
        // по эжтому нааизируекм слово є
        $this->result['stock_karats'] = (trim($excell_row_array['G']) == 'є') ? 1 : 0;
        $this->result['stock_points'] = (trim($excell_row_array['G']) == 'є') ? 1 : 0;


//Картинка
//Картинка
//Картинка


        if (trim($excell_row_array['H']) != '' AND trim($excell_row_array['H']) != 'no-foto') {


            $a = explode(',', trim($excell_row_array['H'])); // тут может быть несокьлко картинок
            foreach ($a as $b) {
                // превращаем его в массив
                $this->result['images'][] = "/img-gems/" . trim($b) . ".jpg";
            }
        }


//Расширеный эксель для Модельнх Эксклюзивных камней
//Расширеный эксель для Модельнх Эксклюзивных камней
//Расширеный эксель для Модельнх Эксклюзивных камней
//Расширеный эксель для Модельнх Эксклюзивных камней
//Расширеный эксель для Модельнх Эксклюзивных камней
//Расширеный эксель для Модельнх Эксклюзивных камней ВАЖНО !!!! КОЛИЧЕСТВО КАМНЕЙ В НАБОЕР ДОЛЖНО БЫТЬ ВСЕГА
        //if (isset ($excell_row_array['K'])) {
//print_r($excell_row_array['I']);
//            exit;
        echo('TODO: важно заподнитьв базе флаги this_is_nabor exclusive_type обна на соновании nabor_numberstones поле K');
        echo('TODO: важно заподнитьв базе флаги this_is_nabor exclusive_type обна на соновании nabor_numberstones поле K');
        echo('TODO: важно заподнитьв базе флаги this_is_nabor exclusive_type обна на соновании nabor_numberstones поле K');
        echo('TODO: важно заподнитьв базе флаги this_is_nabor exclusive_type обна на соновании nabor_numberstones поле K');
        echo('TODO: важно заподнитьв базе флаги this_is_nabor exclusive_type обна на соновании nabor_numberstones поле K');

        // наличие на складе для расширенных моделей НЕ важно
        $this->result['stock_karats'] = 1;

        if (isset($excell_row_array['I'])) $this->result['exclusiv_priceper_carat'] = trim($excell_row_array['I']);
        if (isset($excell_row_array['J'])) $this->result['exclusiv_priceper_stone'] = trim($excell_row_array['J']);
        if (isset($excell_row_array['K'])) $this->result['nabor_numberstones'] = trim($excell_row_array['K']); // ЭТО НЕ ЭКСКЛЮЗИВ ПРОСТО КОЛИЧЕСТВО КАМНЕЙ
        if (isset($excell_row_array['L'])) $this->result['nabor_sizestones'] = trim($excell_row_array['L']);
        if (isset($excell_row_array['M'])) $this->result['nabor_weightstones'] = trim($excell_row_array['M']);
        if (isset($excell_row_array['N'])) $this->result['exclusiv_params_colorcryst'] = (trim($excell_row_array['N']) == '') ? '' : trim($excell_row_array['N']) . ' / ' . trim($excell_row_array['O']);
        // здесь надо написать скрипт определения ID страны по ее названию из соответсвуюенщго справочника
        if (isset($excell_row_array['P'])) $this->result['country_name_ru'] = trim($excell_row_array['P']);
        if (isset($excell_row_array['Q'])) $this->result['country_name_uk'] = trim($excell_row_array['Q']);


        if (isset($excell_row_array['R'])) $this->result['name_suffix_ru'] = trim($excell_row_array['R']);
        if (isset($excell_row_array['S'])) $this->result['name_suffix_uk'] = trim($excell_row_array['S']);


        if (isset($excell_row_array['T'])) $this->result['nabor_notes_ru'] = trim($excell_row_array['T']);
        if (isset($excell_row_array['U'])) $this->result['nabor_notes_uk'] = trim($excell_row_array['U']);

        if (isset($excell_row_array['V'])) $this->result['sku'] = trim($excell_row_array['V']);
        //
        if (isset($excell_row_array['W'])) $this->result['desc_products_ru'] = trim($excell_row_array['W']);
        if (isset($excell_row_array['X'])) $this->result['desc_products_uk'] = trim($excell_row_array['X']);
        //
        if (isset($excell_row_array['Y'])) $this->result['nabor_seo_desc_ru'] = trim($excell_row_array['Y']);
        if (isset($excell_row_array['Z'])) $this->result['nabor_seo_desc_uk'] = trim($excell_row_array['Z']);


        //
        if (isset($excell_row_array['AA'])) $this->result['seo_title_ru'] = trim($excell_row_array['AA']);
        if (isset($excell_row_array['AB'])) $this->result['seo_title_uk'] = trim($excell_row_array['AB']);
        //
        if (isset($excell_row_array['AC'])) $this->result['seo_keywords_ru'] = trim($excell_row_array['AC']);
        if (isset($excell_row_array['AD'])) $this->result['seo_keywords_uk'] = trim($excell_row_array['AD']);
        //
        if (isset($excell_row_array['AE'])) $this->result['seo_desc_ru'] = trim($excell_row_array['AE']);
        if (isset($excell_row_array['AF'])) $this->result['seo_desc_uk'] = trim($excell_row_array['AF']);


        /** удалить */
        /** удалить */
        /** удалить */
        /** удалить */
        /** удалить */
        /** удалить */
        /** удалить */
        /*       $chars = '';
               //размеров больше чем на один камент
               preg_match_all('/(\*)/', $excell_row_array['D'], $d);
               if (sizeof($d[1]) > 4)
                   $chars .= 'Размер:' . $excell_row_array['D'] . '<br> ';

               // масса описана доян нескольки х камней
               if (preg_match('/\+|;/', $excell_row_array['E']))
                   $chars .= 'Масса кар:' . $excell_row_array['E'] . '<br> ';

               // Цена для нескольких камней
               if (preg_match('/\+|;/', $excell_row_array['I']))
                   $chars .= 'Цена за шт:' . $excell_row_array['I'] . '<br> ';
               //
               $chars .= 'Кол.камней:' . $excell_row_array['M'] . '<br> ';
               $chars .= $excell_row_array['K'] ? 'Цвет:' . $excell_row_array['K'] . '<br>' : '';
               $chars .= $excell_row_array['L'] ? 'Чистота:' . $excell_row_array['L'] . '<br>' : '';
               $chars .= $excell_row_array['N'] ? 'Происхождение:' . $excell_row_array['N'] . '<br>' : '';

               //this_is_nabor
               $this->result['this_is_nabor'] = (trim($excell_row_array['J']) != '') ? 1 : 0;
               // вспомогательная инфа для
               $this->result['characteristics_str'] = $chars;*/
        //} // НАБОРА ЭКСКЛЮЗИВ?

//        echo "<pre>";
//        print_r($this->result);
//        echo "</pre>";
//        exit;

        /**
         * Array
         * (
         * [type_product_id] => 6
         * [color_id] => 2
         * [shape] => 6
         * [size_h] => 8
         * [size_w] => 8
         * [size_d] =>
         * [weight] => 2.72
         * [price] => 2448
         * [characteristics_str] =>
         * [this_is_nabor] =>
         * [stock_karats] => 1
         * [stock_points] => 0
         * [1c_str] =>
         * [name_suffix] =>
         * [images] => Array
         * (
         * [0] => /img-gems/3014-emerald_octagon-2_72ct-1.jpg
         * [1] => /img-gems/3014-emerald_octagon-2_72ct-2.jpg
         * [2] => /img-gems/3014-emerald_octagon-2_72ct-3.jpg
         * )
         *
         * [nabor_numberstones] => 1
         * [exclusiv_priceper_carat] => 900
         * [exclusiv_priceper_stone] =>
         * [nabor_sizestones] => 8,17*7,85*5,53
         * [nabor_weightstones] =>
         * [exclusiv_params_colorcryst] =>
         * --------------------------------------------------------
         * [country_name_ru] =>
         * [country_name_uk] =>
         * [name_suffix_ru] =>
         * [name_suffix_uk] =>
         * [sku] => 3014
         * [desc_products_ru] =>
         * [desc_products_ua] =>
         * [nabor_seo_desc_ru] =>
         * [nabor_seo_desc_ua] =>
         * [seo_title_ru] => Натуральный изумруд октагон, 8х8 см 2,72 карата - очень красивый
         * [seo_title_ua] => Натуральний смарагд октагон, 8х8 см 2,72 карата - великий та красивий
         * [seo_keywords_ru] => натуральный изумруд купить, даргоценный камень изумруд октагон купить, изумруд для мужчин купить, парные камни изумуруд октагон, изумруд  2 карата цена, изумруд 2,5 карата стоимость,
         * [seo_keywords_ua] => натуральний смрагд 2 карати купити, дорогоцінний камінь смарагд октагон купити, смарагд ексклюзивний купити, парні камені смарагд октагон, смарагд  2 карати ціна, смарагд 2 карати вартість, смарагд для чоловіків купити
         * [seo_desc_ru] => Натуральный изумруд октагон, 2,72 карата, 8х8см, Бесплатный сертификат, консультация геммолога.
         * [seo_desc_ua] => Натуральний смарагд октагон, 2,72 карата, 8х8см. Безкоштовний сертифікат,  консультація геммолога.
         * )
         */


//мусор подчищаем
//мусор подчищаем
//мусор подчищаем
        /*    $this->str = trim(str_replace([' .', ' ,'], '', $this->str));


            if (trim($this->str)) {
                $m .= "</b><br>остаток строки разбора: <b><font color=red>" . $this->str . "</font></b> - требуется уточнить ЧТО ЗА ФРАГМЕНТ ОСТАЛСЯ для обучения парсера...<br>";
                $this->result['notrecg_str'] = trim($this->str);
            }*/


// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв
// отладочная инфв


        if ($this->result['type_product_id']) {
            $type_model = ProductType::findOne(['id_product_type' => $this->result['type_product_id']]);
            $m .= "<br><b>камень:</b> <a href='/product-type/view?id=" . $this->result['type_product_id'] . "'>" . $type_model->name_product_type . "</a>";
        } else {
            $m .= "<br><b>камень:</b> <font color=red>Ошибка определения Типа камня из существующих в базе.</font> или строка из 1с не содержит название камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
            $error = true;
        }

//
        if ($this->result['color_id']) {
            $type_model = ProductsColors::findOne(['id_color' => $this->result['color_id']]);
            $m .= "<br><b>цвет:</b> <a href='/products-colors/view?id=" . $this->result['color_id'] . "'>" . $type_model->name_color . "</a>";
        } else {
            $m .= "<br><b>цвет:</b> <font color=red>Ошибка определения ЦВЕТ камня из существующих в базе.</font> или строка из 1с не содержит ЦВЕТА камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
            $error = true;

        }

//
        if ($this->result['shape']) {
            $type_model = ProductsShapes::findOne(['id_shape' => $this->result['shape']]);
            $m .= "<br><b>форма:</b>  <a href='/products-shapes/view?id=" . $this->result['shape'] . "'>" . $type_model->name_shape . "</a>";
        } else {
            $m .= "<br><b>форма:</b>  <font color=red>Ошибка определения ФОРМЫ ОГРАНКИ камня из существующих в базе.</font> или строка из 1с не содержит ФОРМЫ ОГРАНКИ камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
            $error = true;

        }

//
//
//
        if (!$error) {
            if (isset($this->result['size_h'])) {
                $m .= "<br><b>размеры:</b> H:" . $this->result['size_h'] . "/ W:" . $this->result['size_w'] . "/ D:" . $this->result['size_d'];
            } else {
                $m .= "<br><b>размеры:</b><font color=red>нет размеров</font> ";
            }

            if (isset($this->result['weight'])) {
                $m .= "<br><b>вес в каратах:</b> :" . $this->result['weight'];
            } else {
                $m .= "<br><b>вес:</b><font color=red>нет веса</font> ";
            }

            if (isset($this->result['price'])) {
                $m .= "<br><b>Цена $: </b>" . $this->result['price'];
            } else {
                $m .= "<br><b>Цена $: </b><font color=red>нет цены</font> ";
            }

            $m .= "<br><b>Наличие : </b>";
            if ($this->result['stock_karats']) {
                $m .= ' ЕСТЬ в наличии';
            } else {
                $m .= 'в наличии НЕТ';
            }

            if ($this->result['this_is_nabor']) {
                $m .= "<br><b>Это Набор! </b>";
            }

            /*// СУФИКС найден зарезервированный ID справочника суфиксов к названию
            if ($this->result['name_suffix_id']) {
                $type_model = ParserGemstypeReservedkeys::findOne(['id_1cparser_grk' => $this->result['name_suffix_id']]);
                $m .= "<br><b>суффикс названия:</b>  <a href='/parser-gemstype-reservedkeys/update?id=" . $this->result['name_suffix_id'] . "'>" . $type_model->russian_1cparser_grk . "</a>";
            } else {
                // НЕ обязательное поле
            //            $m .= "<br><b>форма:</b>  <font color=red>Ошибка определения ФОРМЫ ОГРАНКИ камня из существующих в базе.</font> или строка из 1с не содержит ФОРМЫ ОГРАНКИ камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
            //            $error = true;

            }*/


            // СУФИКС для редких огранок - ошранку присваиваем "ДРУГИЕ" но саму редкую огранку оставляем в названии
            if (isset($this->result['name_suffix_str'])) {
                $m .= "<br><b>2й суффикс названия - редкий тип огранки \"Другие\" : </b>  " . $this->result['name_suffix_str'] . " ";
            } else {
                // НЕ обязательное поле
                //            $m .= "<br><b>форма:</b>  <font color=red>Ошибка определения ФОРМЫ ОГРАНКИ камня из существующих в базе.</font> или строка из 1с не содержит ФОРМЫ ОГРАНКИ камня, или оно нам не известно, или нет связки ключ_1с - имя_в_базе ";
                //            $error = true;

            }

            if (trim($this->result['characteristics_str'])) {
                $m .= "<br><b>Описательная строка Парамтеров и пр.</b> <br>" . $this->result['characteristics_str'] . " ";
            }

            //print_r($this->result['images']);
            if (sizeof($this->result['images'])) {
                $m .= " <br><img src= '/" . $this->result['images'][0] . "' > ";
            }


            $m .= "<br><b>Артикул : </b>";
            if (isset($this->result['sku'])) {
                $m .= $this->result['sku'];
            } else {
                $m .= ' отсутсвует';
            }


            $m .= "<br><b>Цена за карат : </b>";
            if (isset($this->result['exclusiv_priceper_carat'])) {
                $m .= $this->result['exclusiv_priceper_carat'];
            } else {
                $m .= ' не определена';
            }

            $m .= "<br><b>Характеристики цвет/чистота : </b>";
            if (isset($this->result['exclusiv_params_colorcryst'])) {
                $m .= $this->result['exclusiv_params_colorcryst'];
            } else {
                $m .= ' не определены';
            }


            $m .= "<br><b>Суффикс к названию : </b>";
            if (isset($this->result['name_suffix_ru'])) {
                $m .= $this->result['name_suffix_ru'];
                $m .= '<br>' . $this->result['name_suffix_uk'];

            } else {
                $m .= ' отсутсвует';
            }


            $m .= "<br><b>Происхождение : </b>";
            if (isset($this->result['country_name_ru'])) {
                $m .= $this->result['country_name_ru'];
                $m .= '<br>' . $this->result['country_name_uk'];
            } else {
                $m .= ' не определены';
            }


            $m .= "<br><b>Примечание : </b>";
            if (isset($this->result['nabor_notes_ru'])) {
                $m .= $this->result['nabor_notes_ru'];
                $m .= '<br>' . $this->result['nabor_notes_uk'];

            } else {
                $m .= ' отсуствует';
            }

            $m .= "<br><b>Описание русское/украинское : </b>";
            if (isset($this->result['desc_products_ru'])) {
                $m .= $this->result['desc_products_ru'];
                $m .= '<br>' . $this->result['desc_products_uk'];

            } else {
                $m .= ' отсуствует';
            }

            $m .= "<br><b>SEO описание / подробное описание: </b>";
            if (isset($this->result['nabor_seo_desc_ru'])) {
                $m .= $this->result['nabor_seo_desc_ru'];
                $m .= '<br>' . $this->result['nabor_seo_desc_uk'];

            } else {
                $m .= ' отсуствует';
            }

            $m .= "<br><b>SEO Title: </b>";
            if (isset($this->result['seo_title_ru'])) {
                $m .= $this->result['seo_title_ru'];
                $m .= '<br>' . $this->result['seo_title_uk'];

            } else {
                $m .= ' отсуствует';
            }

            $m .= "<br><b>SEO keywords: </b>";
            if (isset($this->result['seo_keywords_ru'])) {
                $m .= $this->result['seo_keywords_ru'];
                $m .= '<br>' . $this->result['seo_keywords_uk'];

            } else {
                $m .= ' отсуствует';
            }

            $m .= "<br><b>SEO description: </b>";
            if (isset($this->result['seo_desc_ru'])) {
                $m .= $this->result['seo_desc_ru'];
                $m .= '<br>' . $this->result['seo_desc_uk'];

            } else {
                $m .= ' отсуствует';
            }




                $m .= "<br><br><b>НАБОР (ПОДГРУППА ЭКСКЛЮЗИВА)</b>";

                // 1 ЭКСКЛЮЗИВ
                if (isset($this->result['nabor_numberstones']) AND $this->result['nabor_numberstones'] == 1) {

                    $this->result['exclusive_type'] = 1;
                    // зачем нам в НАБОРАХ показывать ЭКСКЛЮЗИВ 1 камня?
                    //$this->result['this_is_nabor'] = 1;

                    $m .= ' это ЭКСКЛЮЗИВ';

                } else if (isset($this->result['nabor_numberstones']) AND $this->result['nabor_numberstones'] > 1) {

                    //this_is_nabor > 1
                    // НО ОН ЖЕ И ЭКСКЛЮЗИВ
                    $this->result['exclusive_type'] = 1;
                    $this->result['this_is_nabor'] = 1;
                    $m .= ' это НАБОР > 1 из камней: ' . $this->result['nabor_numberstones'];


                    $m .= "<br><b>Дополнительные свойства НАБОРА</b>";

                    $m .= "<br><b>- цена за камень: </b>";
                    if ($this->result['exclusiv_priceper_stone']) {
                        $m .= $this->result['exclusiv_priceper_carat'];
                    } else {
                        $m .= ' не определена';
                    }

                    $m .= "<br><b>- размер камней: </b>";
                    if (isset($this->result['nabor_sizestones'])) {
                        $m .= $this->result['nabor_sizestones'];
                    } else {
                        $m .= ' не определено';
                    }

                    $m .= "<br><b>- вес камней: </b>";
                    if (isset($this->result['nabor_weightstones'])) {
                        $m .= $this->result['nabor_weightstones'];
                    } else {
                        $m .= ' не определено';
                    }

                    $m .= "<br>";

                } else {
                    $this->result['exclusive_type'] = 0;
                    $this->result['this_is_nabor'] = 0;
                }




            /*        if ($this->result['amount'] <> "") {
                        $m .= "<br><b>еденицы измерения:</b> " . $this->result['amount'];
                    } else {
                        $m .= "<br><b>еденицы измерения:</b> <font color=red>нет еденицы измерения</font> ";
                    }

            //
                    if ($this->result['params'] <> "") $m .= "<br><b>харакетристики:</b> " . $this->result['params'];*/
        }// если небыло ошибок

        $m .= "<br><font color=gray><b>исходная строка ЭКСЕЛЯ </b> [" . $this->result['1c_str'] . "] </font>-----<br>";


        return ['error' => $error, 'comment' => $m, 'result' => $this->result];


    }


    public
    function back_slash_spec_chars($str)
    {
        return str_replace(["/", "(", ")"], ["\/", "\(", "\)"], trim($str));
    }


    public
    function excelExport($product)
    {
        $objPHPExcel = new \PHPExcel();
        $sheet = 0;
        $objPHPExcel->setActiveSheetIndex($sheet);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(60);

        $objPHPExcel->getActiveSheet()
            ->setTitle('MAIN')
            ->setCellValue('A1', 'type')
            ->setCellValue('B1', 'brand')
            ->setCellValue('C1', 'color')
            ->setCellValue('D1', 'size')
            ->setCellValue('E1', 'cutshape')
            ->setCellValue('F1', 'amount')
            ->setCellValue('G1', 'other characters')
            ->setCellValue('H1', 'name_suffix_id')
            ->setCellValue('I1', 'name_suffix_str')
            ->setCellValue('J1', 'not recognized')
            ->setCellValue('K1', '1c_string');
        /**
         * [type_id] => 4
         * [brand] => brands.drag_natural_handmademodelnye
         * [color_id] => 12
         * [size] => 1.3
         * [cutshape_id] => 1
         * [amount] => кар. алмаз
         * [params] =>
         * [name_suffix_id] =>
         * [name_suffix_str] =>
         * [notrecg_str] =>
         * [1c_str] =>
         */
        // ччтрока Экселя с данными
        $row = 2;
        foreach ($product as $k => $foo) {
            // данные выбраны из двуз таблиц
            // если товар составной, имя картинку цену и актикул берем из второй подтаблицы
            // описание и наличие из основы товара остается
            //под товары
            //
            //print_r($foo);
            //$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $foo['type_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $foo['brand']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $foo['color_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $foo['size']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $foo['cutshape_id']); //освновного товара
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $foo['amount']); //освновного товара
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $foo['params']); //освновного товара
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $foo['name_suffix_id']); //освновного товара
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $foo['name_suffix_str']); //освновного товара
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $foo['notrecg_str']); //освновного товара
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $foo['1c_str']); //освновного товара
            $row++;
        }

        header('Content-Type: application/vnd.ms-excel');
        $filename = "Export_1c_gems.com.ua_" . date("d-m-Y-H-i") . ".xls";
        header('Content-Disposition: attachment;filename=' . $filename . ' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }//function


}








