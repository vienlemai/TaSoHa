<?php

class MemberHelper {

    public static function introducersForSelect($members, $includeBlank = true) {
        $options = array();
        if ($includeBlank) {
            $options[''] = '-- Là thành viên cấp 1'; // TODO: trans this
        }
        foreach ($members as $mem) {
            $options[$mem . ''] = $mem->full_name . ' (' . $mem->uid . ')';
        }
        return $options;
    }
}
