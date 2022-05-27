<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'project',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'team/soap',
        'dev' => true,
    ),
    'versions' => array(
        'econea/nusoap' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'type' => 'library',
            'install_path' => __DIR__ . '/../econea/nusoap',
            'aliases' => array(
                0 => '0.10.x-dev',
            ),
            'reference' => 'e83219ee1add324124fea8e448b4cfddf782f8ff',
            'dev_requirement' => false,
        ),
        'team/soap' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'project',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
    ),
);
