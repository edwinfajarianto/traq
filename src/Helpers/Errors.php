<?php
/*!
 * Traq
 * Copyright (C) 2009-2015 Jack P.
 * Copyright (C) 2012-2015 Traq.io
 * https://github.com/nirix
 * https://traq.io
 *
 * This file is part of Traq.
 *
 * Traq is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 only.
 *
 * Traq is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Traq. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Traq\Helpers;

use Avalon\Templating\View;
use Avalon\Language;

/**
 * Error helpers.
 *
 * @author Jack P.
 * @since 4.0.0
 */
class Errors
{
    /**
     * Used to render an array of errors.
     *
     * @param array $errors
     */
    public static function show($errors)
    {
        return View::render('Errors/_list', [
            'errors' => (array) $errors
        ]);
    }

    /**
     * Returns the view for a nice error list for the given model.
     *
     * @param object $model
     *
     * @return string
     */
    public static function messagesFor($model, $title = null)
    {
        if (!$title) {
            $title = Language::translate('errors.correct_the_following');
        }

        if (is_object($model) and count($model->errors())) {
            $messages = [];

            foreach ($model->errors() as $field => $fieldMessages) {
                $messages = array_merge($messages, $fieldMessages);
            }

            return View::render('errors/_messages_for.phtml', array(
                'title'  => $title,
                'messages' => $messages
            ));
        }
    }
}
