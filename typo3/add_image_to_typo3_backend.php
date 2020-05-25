// Add Image to backend

// Add to TCA overrides into call_user_func
'tx_image_name' => [
    'exclude' => '1',
    'label' => 'LLL:EXT:verbaende/Resources/Private/Language/Backend:pages.tx_image_name',
    'order' => 3,
    'config' => [
        'type' => 'inline',
        'foreign_table' => 'sys_file_reference',
        'foreign_field' => 'uid_foreign',
        'foreign_sortby' => 'sorting_foreign',
        'foreign_table_field' => 'tablenames',
        'foreign_match_fields' => [
            'fieldname' => 'tx_image_name',
        ],
        'foreign_label' => 'uid_local',
        'foreign_selector' => 'uid_local',
        'overrideChildTca' => [
            'columns' => [
                'uid_local' => [
                    'config' => [
                        'appearance' => [
                            'elementBrowserType' => 'file',
                            'elementBrowserAllowed' => 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg',
                        ],
                    ],
                ],
            ],
            'types' => [
                0 => [
                    'showitem' => '--palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette',
                ],
                1 => [
                    'showitem' => '--palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette',
                ],
                2 => [
                    'showitem' => '--palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette',
                ],
                3 => [
                    'showitem' => '--palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette',
                ],
                4 => [
                    'showitem' => '--palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette',
                ],
                5 => [
                    'showitem' => '--palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette',
                ],
            ],
            'filter' => [
                0 => [
                    'userFunc' => 'TYPO3\\CMS\\Core\\Resource\\Filter\\FileExtensionFilter->filterInlineChildren',
                ],
            ],
            'appearance' => [
                'useSortable' => 'tx_image_name','headerThumbnail' => [
                    'field' => 'uid_local',
                    'width' => '45',
                    'height' => '45c',
                ],
                'enabledControls' => [
                    'info' => 'tx_image_name',
                    'new' => false,'dragdrop' => 'tx_image_name',
                    'sort' => false,
                    'hide' => 'tx_image_name',
                    'delete' => 'tx_image_name',
                ],
                'fileUploadAllowed' => false,
            ],
        ],
    ]
],

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'tx_image_name', '', 'after:doktype');



// Add to ext_tables.sql (foreign_key on files)

tx_image_name int(11) unsigned DEFAULT '0' NOT NULL
