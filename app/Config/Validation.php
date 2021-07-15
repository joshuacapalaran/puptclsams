<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $students = [
		'student_num' => [
			'rules' => 'required|regex_match[/^[0-9]{4}([-. ])([0-9]{5})([-. ])([A-Z]{2})([-. ])([0-9]{1})$/]',
			'label' => 'Student Number',
			'errors' => [
								'required' => 'Student Number is required.',
								'regex_match' => 'Enter valid Student Number.'
							]
		],

		'first_name' => [
			'rules' => 'required',
			'label' => 'Firstname',
			'errors' => [
								'required' => 'Firstname is required.'

							]
		],

		'last_name' => [
			'rules' => 'required',
			'label' => 'Lastname',
			'errors' => [
								'required' => 'Lastname is required.'

							]
		],

		'm_initial' => [
			'rules' => 'required',
			'label' => 'Middle Initial',
			'errors' => [
								'required' => 'Middle Initial is required.'
							]
		],

		// 'suffix_id' => [
		// 	'rules' => 'numeric',
		// 	'label' => 'Suffix',
		// 	'errors' => [
		// 						'required' => 'Suffix is required.']
		// ],
		//
		// 'course_id' => [
		// 	'rules' => 'numeric',
		// 	'label' => 'Course',
		// 	'errors' => [
		// 						'required' => 'Course is required.']
		// ],
		//
		// 'section_id' => [
		// 	'rules' => 'numeric',
		// 	'label' => 'Section',
		// 	'errors' => [
		// 						'required' => 'Section is required.']
		// ]
	];

	public $professors = [
		'f_code' => [
			'rules' => 'required',
			'label' => 'Faculty Code',
			'errors' => [
								'required' => 'Faculty Code is required.'
							]
		],

		'first_name' => [
			'label' => 'Firstname',
			'rules' => 'required',
			'errors' => [
								'required' => 'Firstname is required.'
							]
		],

		'last_name' => [
			'rules' => 'required',
			'label' => 'Lastname',
			'errors' => [
								'required' => 'Lastname is required.'
							]
		],

		'm_initial' => [
			'rules' => 'required',
			'label' => 'Middle Initial',
			'errors' => [
								'required' => 'Middle Initial is required.'
							]
		],

		// 'suffix_id' => [
		// 	'rules' => 'numeric',
		// 	'label' => 'Suffix'
		// ]
	];

	public $subjects = [
		// 'subj_code' => [
		// 	'rules' => 'required|regex_match[/^[A-Z]{4}([ .])([0-9]{5})$/]',
		// 	'label' => 'Subject Code',
		// 	'errors' => [
		// 						'required' => 'Subject Code is required.',
		// 						'regex_match' => 'Enter valid Subject Code.']
		// ],

		'subj_code' => [
			'rules' => 'required',
			'label' => 'Subject Code',
			'errors' => [
								'required' => 'Subject Code is required.',]
		],

		'subj_name' => [
			'rules' => 'required',
			'label' => 'Subject Name',
			'errors' => [
								'required' => 'Subject Name is required.']
		],
	];

	public $courses = [
		'course_name' => [
			'rules' => 'required',
			'label' => 'Course Name',
			'errors' => [
								'required' => 'Course Name is required.']
		],

		'course_abbrev' => [
			'rules' => 'required',
			'label' => 'Course Abbreviation',
			'errors' => [
								'required' => 'Course Abbreviation is required.']
		],
	];

	public $sections = [
		'year' => [
			'rules' => 'required|regex_match[/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/]', //roman numerals lang kukuhain
			'label' => 'Year',
			'errors' => [
								'required' => '{field} is required.']
		],

		'section' => [
			'rules' => 'required|numeric',
			'label' => 'Section',
			'errors' => [
								'required|numeric' => '{field} is required.']
		]
	];

	public $semesters = [
		'sem' => [
			'rules' => 'required',
			'label' => 'Semester',
			'errors' => [
								'required' => '{field} is required.']
		],
	];

	public $schoolyears = [
		'start_sy' => [
			'rules' => 'required|numeric|regex_match[/^[0-9]{4}$/]',
			'label' => 'Start Year',
			'errors' => [
								'required|numeric' => '{field} is required.']
		],
		'end_sy' => [
			'rules' => 'required|numeric|regex_match[/^[0-9]{4}$/]',
			'label' => 'End Year',
			'errors' => [
								'required|numeric' => '{field} is required.']
		],
	];


	public $labs = [
		'lab_name' => [
			'rules' => 'required',
			'label' => 'Laboratory Name',
			'errors' => [
								'required' => 'Laboratory Name is required.']
		],
		'lab_name' => [
			'rules' => 'in_list',
			'label' => 'Laboratory Name',
			'errors' => [
								'in_list' => 'Laboratory Name is not on the list']
		],
		'lab_name' => [
			'rules' => 'if_exists',
			'label' => 'Laboratory Name',
			'errors' => [
								'if_exists' => 'Laboratory name is already existing.']
		],
		'lab_name' => [
			'rules' => 'is_unique[labs.lab_name]',
			'label' => 'Category',
			'errors' => [
								'alpha' => 'Lab name is already in the database.']
		],
	];

	public $suffixes = [
		'suffix' => [
			'rules' => 'required|alpha',
			'label' => 'Suffix',
			'errors' => [
								'required|alpha' => '{field} is required.']
		],
	];

	public $categories = [
		'category' => [
			'rules' => 'required',
			'label' => 'Category',
			'errors' => [
								'required' => 'Category is required.']
		],
		'category' => [
			'rules' => 'if_exists',
			'label' => 'Category',
			'errors' => [
								'if_exists' => 'Category is already existing.']
		],
		'category' => [
			'rules' => 'alpha',
			'label' => 'Category',
			'errors' => [
								'alpha' => 'Input Alphabet letter only.']
		],
		'category' => [
			'rules' => 'is_unique[categories.category]',
			'label' => 'Category',
			'errors' => [
								'alpha' => 'Category is already in the database.']
		],
	];

	public $capacities = [
		// 'lab_id' => [
		// 	'rules' => 'numeric',
		// 	'label' => 'Laboratory',
		// 	'errors' => [
		// 						'required' => 'Laboratory is required.']
		// ],

		'capacity' => [
			'rules' => 'required',
			'label' => 'Capacity',
			'errors' => [
								'required' => 'Capacity is required.']
		],
		'capacity' => [
			'rules' => 'less_than[50]',
			'label' => 'Capacity',
			'errors' => [
								'less_than' => 'Exceeded the lab capacity.']
		],
		'capacity' => [
			'rules' => 'numeric',
			'label' => 'Capacity',
			'errors' => [
								'numeric' => 'Input numbers only!']
		],
	];

	public $schedlabs = [
		'event_name' => [
			'rules' => 'required',
			'label' => 'Event Name',
			'errors' => [
								'required' => 'Event Name is required.']
		],

		// 'category_id' => [
		// 	'rules' => 'numeric',
		// 	'label' => 'Category',
		// 	'errors' => [
		// 						'required' => 'Category is required.']
		// ],

		'date' => [
			'rules' => 'required',
			'label' => 'Date',
			'errors' => [
								'required' => 'Date is required.']
		],

		'start_time' => [
			'rules' => 'required',
			'label' => 'Start Time',
			'errors' => [
								'required' => 'Start Time is required.']
		],

		'end_time' => [
			'rules' => 'required',
			'label' => 'End Time',
			'errors' => [
								'required' => 'End Time is required.']
		],

		// 'lab_id' => [
		// 	'rules' => 'numeric',
		// 	'label' => 'Laboratory',
		// 	'errors' => [
		// 						'required' => 'Laboratory is required.']
		// ],

		'assigned_person' => [
			'rules' => 'required',
			'label' => 'Personnel',
			'errors' => [
								'required' => 'Personnel is required.']
		],

		'num_people' => [
			'rules' => 'required',
			'label' => 'No. of People',
			'errors' => [
								'required' => 'No. of People is required.']
		],


	];

	public $programs = [
		'program' => [
			'rules' => 'required',
			'label' => 'Course',
			'errors' => [
                'required' => 'Program is required.']
		],

		'abbreviation' => [
			'rules' => 'required',
			'label' => 'Abbreaviation',
			'errors' => [
                'required' => 'Abbreviation is required.']
		],

		'description' => [
			'rules' => 'required',
			'label' => 'Description',
			'errors' => [
                'required' => 'Description is required.']
		],

		'program_type' => [
			'rules' => 'numeric',
			'label' => 'Program Type',
			'errors' => [
                'numeric' => 'Program Type is required.']
		]
	];

	public $programtypes = [
		'type' => [
			'rules' => 'required',
			'label' => 'Program Type',
			'errors' => [
                'required' => 'Program Type is required.']
			]
	];


	public $role = [
        'role_name' => [
            'label'  => 'Role Name',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Role Name field is required.'
            ]
        ],

        'description' => [
            'label'  => 'Role Description',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Role desciption field is required.'
            ]
        ],

        'function_id' => [
            'label'  => 'Landing Page',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Landing Page field is required.'
            ]
        ],

	];
	
	public $schedsubj = [
		'subject_id' => [
			'rules' => 'required',
			'label' => 'Subject',
			'errors' => ['required' => 'Subject is required.']
		],
		'course_id' => [
			'rules' => 'required',
			'label' => 'Course',
			'errors' => ['required' => 'Course is required.']
		],
		'lab_id' => [
			'rules' => 'required',
			'label' => 'Laboratory',
			'errors' => ['required' => 'Laboratory is required.']
		],
		'professor_id' => [
			'rules' => 'required',
			'label' => 'Professor',
			'errors' => ['required' => 'Professor is required.']
		],
		'category' => [
			'rules' => 'required',
			'label' => 'Category',
			'errors' => ['required' => 'Category is required.']
		],
		'semester_id' => [
			'rules' => 'required',
			'label' => 'Semester',
			'errors' => ['required' => 'Semester is required.']
		],
		'sy_id' => [
			'rules' => 'required',
			'label' => 'School Year',
			'errors' => ['required' => 'School Year is required.']
		],
		
	
	];

	public $visitor = [
		'name' => [
			'rules' => 'required',
			'label' => 'Name',
			'errors' => ['required' => 'Name is required.']
		],
		'purpose' => [
			'rules' => '',
			'label' => 'Purpose',
			'errors' => ['required' => 'Purpose is required.']
		],
		'lab_id' => [
			'rules' => '',
			'label' => 'Laboratory',
			'errors' => ['required' => 'Laboratory is required.']
		],
		'event_id' => [
			'rules' => '',
			'label' => 'Event',
			'errors' => ['required' => 'Event is required.']
		],
	];

	public $users = [
		'first_name' => [
			'rules' => 'required',
			'label' => 'Name',
			'errors' => ['required' => 'First Name is required.']
		],
		'last_name' => [
			'rules' => 'required',
			'label' => 'Name',
			'errors' => ['required' => 'Last Name is required.']
		],
		'm_initial' => [
			'rules' => 'required',
			'label' => 'Name',
			'errors' => ['required' => 'Middle Initial is required.']
		],
		'username' => [
			'rules' => 'required',
			'label' => 'Name',
			'errors' => ['required' => 'User Name is required.']
		],
		'password' => [
			'rules' => 'required',
			'label' => 'Name',
			'errors' => ['required' => 'Password is required.']
		],
		'role_id' => [
			'rules' => 'required',
			'label' => 'Name',
			'errors' => ['required' => 'Role is required.']
		],
	];
}
