<?php

return [
    'mxConnector' => [
        'file' => 'mxconnector',
        'description' => 'mxConnector сниппет вывода связей ресурсов',
        'properties' => [
            'taxons' => [
                'type' => 'textfield',
                'value' => '',
            ],
            'master' => [
                'type' => 'numberfield',
                'value' => '',
            ],
            'slave' => [
                'type' => 'numberfield',
                'value' => '',
            ],
            'tpl' => [
                'type' => 'textfield',
                'value' => 'mxConnectorLinks',
            ],
            'sortby' => [
                'type' => 'textfield',
                'value' => 'id',
            ],
            'sortdir' => [
                'type' => 'list',
                'options' => [
                    ['text' => 'ASC', 'value' => 'ASC'],
                    ['text' => 'DESC', 'value' => 'DESC'],
                ],
                'value' => 'DESC',
            ],
            'limit' => [
                'type' => 'numberfield',
                'value' => 10,
            ],
            'toPlaceholder' => [
                'type' => 'combo-boolean',
                'value' => false,
            ],
            'showLog' => [
                'type' => 'combo-boolean',
                'value' => false,
            ],
        ],
    ],
];