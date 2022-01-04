<?php


namespace App\Constants;


class LanguagesConstant
{

    const UZBEK = 'uzbek';

    const RUSSIAN = 'russian';

    const ENGLISH = 'english';

    /**
     * @return string[]
     */
    static public function list(): array
    {
        return [
            self::UZBEK,
            self::RUSSIAN,
            self::ENGLISH
        ];
    }

    /**
     * @param string|null $lang
     * @return string|array
     */
    static public function translatedList(?string $lang = null)
    {
        $list = [
            self::UZBEK => __('Узбекский язык'),
            self::RUSSIAN => __('Русский язык'),
            self::ENGLISH => __('Английский язык'),
        ];

        if (is_null($lang)) {
            return $list;
        }

        if (!isset($list[$lang])) {
            return '';
        }

        return $list[$lang];
    }
}
