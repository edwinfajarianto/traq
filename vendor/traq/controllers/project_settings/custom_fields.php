<?php
/*!
 * Traq
 * Copyright (C) 2009-2013 Traq.io
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

namespace traq\controllers\ProjectSettings;

use avalon\http\Request;
use avalon\output\View;

use traq\models\CustomField;

/**
 * Custom fields controller
 *
 * @author Jack P.
 * @since 3.0
 * @package Traq
 * @subpackage Controllers
 */
class CustomFields extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->title(l('custom_fields'));
    }

    public function action_index()
    {
        View::set('custom_fields', CustomField::select()->where('project_id', $this->project->id)->exec()->fetch_all());
    }

    /**
     * New field page.
     */
    public function action_new()
    {
        // Create field
        $field = new CustomField(array(
            'type'  => 'text',
            'regex' => '(.*)'
        ));

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $data = array();

            // Loop over properties
            foreach (CustomField::properties() as $property) {
                // Check if it's set and not empty
                if (isset(Request::$post[$property])) {
                    $data[$property] = Request::$post[$property];
                }
            }

            // Is required?
            if (!isset(Request::$post['is_required'])) {
                $data['is_required'] = 0;
            }

            // Project ID
            $data['project_id'] = $this->project->id;

            // Set field properties
            $field->set($data);

            // Save and redirect
            if ($field->save()) {
                Request::redirectTo($this->project->href('settings/custom_fields'));
            }
        }

        // Send field object to view
        View::set(compact('field'));
    }

    /**
     * Edit field page.
     *
     * @param integer $id
     */
    public function action_edit($id)
    {
        // Get field
        $field = CustomField::find($id);

        // Verify project
        if ($field->project_id != $this->project->id) {
            return $this->show_404();
        }

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $data = array();

            // Loop over properties
            foreach (CustomField::properties() as $property) {
                // Check if it's set and not empty
                if (isset(Request::$post[$property])) {
                    $data[$property] = Request::$post[$property];
                }
            }

            // Is required?
            if (!isset(Request::$post['is_required'])) {
                $data['is_required'] = 0;
            }

            // Set field properties
            $field->set($data);

            // Save and redirect
            if ($field->save()) {
                Request::redirectTo($this->project->href('settings/custom_fields'));
            }
        }

        // Send field object to view
        View::set(compact('field'));
    }

    /**
     * Delete field.
     */
    public function action_delete($id)
    {
        // Find field
        $field = CustomField::find($id);

        // Verify project
        if ($field->project_id != $this->project->id) {
            return $this->show_404();
        }

        // Delete and redirect
        $field->delete();
        Request::redirectTo($this->project->href('settings/custom_fields'));
    }
}