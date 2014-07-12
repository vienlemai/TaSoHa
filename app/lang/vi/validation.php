<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute must be accepted.",
	"active_url"           => ":attribute phải đúng định dạng URL.",
	"after"                => ":attribute phải là ngày sau ngày :date.",
	"alpha"                => ":attribute chỉ được phép nhập chữ cái.",
	"alpha_dash"           => ":attribute chỉ được phép nhập chữ cái, chữ số và dấu gạch ngang.",
	"alpha_num"            => ":attribute chỉ được phép nhập chữ số.",
	"array"                => ":attribute phải là một mảng.",
	"before"               => ":attribute phải là ngày trước ngày :date.",
	"between"              => array(
		"numeric" => ":attribute phải là chữ số nằm giữa :min và :max.",
		"file"    => ":attribute dung lượng file phải nằm giữa :min và :max kilobytes.",
		"string"  => ":attribute số lượng chữ cái phải nằm giữa :min và :max.",
		"array"   => ":attribute số lượng phần tử mảng phải nằm giữa :min và :max.",
	),
	"confirmed"            => ":attribute không được xác nhận.",
	"date"                 => ":attribute không đúng định dạng ngày tháng.",
	"date_format"          => ":attribute không đúng định dạng ngày tháng :format.",
	"different"            => ":attribute và :other phải khác nhau.",
	"digits"               => ":attribute must be :digits digits.",
	"digits_between"       => ":attribute must be between :min and :max digits.",
	"email"                => ":attribute phải đúng định dạng email.",
	"exists"               => "selected :attribute không hợp lệ.",
	"image"                => ":attribute phải là ảnh.",
	"in"                   => "selected :attribute is invalid.",
	"integer"              => ":attribute phải là số nguyên.",
	"ip"                   => ":attribute phải đúng định dạng IP.",
	"max"                  => array(
		"numeric" => ":attribute không được lơn hơn :max.",
		"file"    => ":attribute dung lượng file không được lơn hơn :max kilobytes.",
		"string"  => ":attribute số lượng chữ cái không được lớn hơn :max ký tự.",
		"array"   => ":attribute số lượng mảng không được lớn hơn :max phần tử.",
	),
	"mimes"                => ":attribute phải là định dạng : :values.",
	"min"                  => array(
		"numeric" => ":attribute không được nhỏ hơn :min.",
		"file"    => ":attribute dung lượng không được nhỏ hơn :min kilobytes.",
		"string"  => ":attribute số lượng ký tự không được nhỏ hơn :min.",
		"array"   => ":attribute số lượng phần tử không được nhỏ hơn :min.",
	),
	"not_in"               => ":attribute không hợp lệ.",
	"numeric"              => ":attribute chỉ chấp nhận chữ số.",
	"regex"                => ":attribute định dạng không hợp lệ.",
	"required"             => ":attribute không được để trống.",
	"required_if"          => ":attribute field is required when :other is :value.",
	"required_with"        => ":attribute field is required when :values is present.",
	"required_with_all"    => ":attribute field is required when :values is present.",
	"required_without"     => ":attribute field is required when :values is not present.",
	"required_without_all" => ":attribute field is required when none of :values are present.",
	"same"                 => ":attribute và :other phải giống nhau.",
	"size"                 => array(
		"numeric" => ":attribute phải bằng :size.",
		"file"    => ":attribute dung lượng phải bằng :size kilobytes.",
		"string"  => ":attribute số lượng ký tự phải là :size.",
		"array"   => ":attribute số lượng phần tử phải là :size.",
	),
	"unique"               => ":attribute has already been taken.",
	"url"                  => ":attribute format is invalid.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
