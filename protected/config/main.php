<?php

Yii::setPathOfAlias('LC', dirname(__FILE__).'/../extensions/web/CList');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'theme' => 'ecare',
    'name' => 'Export Management',
    'import' => array(
        'application.models.*',
        'application.components.*'
    ),
    'preload' => array(
        'chartjs'
    ),
    'modules' => array(
		'Install',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => array('ecare'),
            'ipFilters' => array(
                '127.0.0.1',
                '::1'
            )
        )
    ),
    'components' => array(
        //'urlManager'=>array(
        //    'urlFormat'=>'path',
        //    'rules'=>array(
        //        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        //    ),
        //),
        'widgetFactory' => array(
            'widgets' => array(
                'YiiSelectize' => array(
                    'defaultOptions' => array(
                        'create' => false,
                    ),
                ),
            ),
        ),
        'user' => array(
            'allowAutoLogin' => false,
            'class' => 'WebUser',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=export_management',
            'emulatePrepare' => true,
            'username' => 'root',
            //'password' => 'shardiwal',
            'password' => '',
            'charset' => 'utf8'
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning'
                ),
                array(
                    'class' => 'CWebLogRoute'
                )
            )
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf'     => array(
                    'librarySourcePath' => 'application.vendor.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'  => 'mpdf',
                    'defaultParams'     => array( 
                        'format' => 'A4',
                        'orientation' => 'P',
                        'mgl'         => 5,
                        'mgr'         => 5,
                        'mgt'         => 5,
                        'mgb'         => 5,
                        'mgh'         => 5,
                        'mgf'         => 12,
                    )
                )
            )
        ),
    ),
    
    'params' => array(
        'titles' => array(
            'Mr',
            'Miss'
        ),
        'activity' => array(
            "-None-",
            "Meet & Greet",
            "Call Customer",
            "Follow-up",
        ),
		'source' => array(
			"-None-",
			"Advertisement",
			"Cold Call",
			"Employee Referral",
			"External Referral",
			"Online Store",
			"Partner",
			"Public Relations",
			"Sales Email Alias",
			"Seminar Partner",
			"Internal Seminar",
			"Trade Show",
			"Web Download",
			"Web Research",
			"Chat"
		),
		'industry' => array(
			"-None-",
			"ASP (Application Service Provider)",
			"Data/Telecom OEM",
			"ERP (Enterprise Resource Planning)",
			"Government/Military",
			"Large Enterprise",
			"ManagementISV",
			"MSP (Management Service Provider)",
			"Network Equipment Enterprise",
			"Non-management ISV",
			"Optical Networking",
			"Service Provider",
			"Small/Medium Enterprise",
			"Storage Equipment",
			"Storage Service Provider",
			"Systems Integrator",
			"Wireless Industry",
			"ERP"
		),
		'lead_status' => array(
			"-None-",
			"Attempted to Contact",
			"Contact in Future",
			"Contacted",
			"Junk Lead",
			"Lost Lead",
			"Not Contacted",
			"Pre-Qualified"
		),
		'lead_rating' => array(
           "AA",
           "AB",
           "AX",
           "BA",
           "BB",
           "BX",
           "CA",
           "CB",
           "CX",
           "XA",
           "XB",
           "XX",
        ),
		'task_status' => array(
            "Not Started",
            "Deferred",
            "In Progress",
            "Completed",
            "Waiting for input"
        ),
		'task_priority' => array(
            "High",
            "Highest",
            "Low",
            "Lowest",
            "Normal",
        ),
        'presentation_remark'=>array(
            "Meeting",
            "Quotation",
            "Send Video",
            "Demo",
        ),
        'currency' => '₹ ',
        'version' => 'v1.0',
        'billPrefix' => '',
        'org' => array(
            'name' => 'SRM Partners',
        ),
        'company' => array(
            'name' => 'eCare SofTech Pvt. Ltd.',
            'website' => 'http://ecaresoftech.com',
            'contact_number' => '+918010766565'
        ),
        'adminEmail' => 'rakesh.shardiwal@gmail.com',
        'listPerPage' => '30',
    )
);
?>