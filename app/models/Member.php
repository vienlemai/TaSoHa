<?php

use Baum\Node;

/**
 * Member
 */
class Member extends Node {
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'members';
    public $fillable = array(
        'email',
        'full_name',
        'sex',
        'day_of_birth',
        'is_left',
        'is_right',
        'managed_by',
    );

    public function findNodeToAdd() {
        $descendants = $this->getDescendantsAndSelf()->toHierarchy();
        $root = $descendants->first();
        $leftNode = $root->children->first();
        $rightNode = $root->children->last();
        $availableLeft = array(
            'leaves' => array(),
            'onlyLeft' => array(),
        );
        $availableRight = array(
            'leaves' => array(),
            'onlyLeft' => array(),
        );
        self::explodeDescendant($leftNode, $availableLeft);
        self::explodeDescendant($rightNode, $availableRight);
        $leftLeaves = count($availableLeft['leaves']);
        $rightLeaves = count($availableRight['leaves']);
        $leftOnlyLeft = count($availableLeft['onlyLeft']);
        $rightOnlyLeft = count($availableRight['onlyLeft']);
//        var_dump('left-leaves '.$leftLeaves);
//        var_dump('right-leaves '.$rightLeaves);
//        var_dump('left-only-left '.$leftOnlyLeft);
//        var_dump('right-only-left '.$rightOnlyLeft);
//        exit();
        $result = null;
        if ($leftLeaves == $rightLeaves && $leftOnlyLeft == $rightOnlyLeft && $leftLeaves != 0) {
            $result['node'] = $availableLeft['leaves'][0];
            $result['position'] = 'left';
        } else if ($leftOnlyLeft == 0 && $rightOnlyLeft > 0) {
            $result['node'] = $availableRight['onlyLeft'][0];
            $result['position'] = 'right';
        } else if ($leftLeaves < $rightLeaves) {
            $result['node'] = $availableRight['leaves'][0];
            $result['position'] = 'right';
        } else {
            $result['position'] = 'left';
            if (count($availableLeft['leaves']) > 0) {
                $result['node'] = $availableLeft['leaves'][0];
            } else {
                $result['node'] = $availableLeft['onlyLeft'][0];
            }
        }
        return $result;
    }

    public static function explodeDescendant($node, &$availableLeft) {
        if ($node->children->isEmpty()) {
            array_push($availableLeft['leaves'], $node);
            return;
        } else if ($node->children->count() == 1) {
            array_push($availableLeft['onlyLeft'], $node);
            return;
        } else {
            foreach ($node->children as $child) {
                self::explodeDescendant($child, $availableLeft);
            }
        }
    }

    public function getListJson() {
        $columns = array(
            'members.full_name as name',
            'members.id',
            'members.parent_id as pId',
        );
        $query = $this->whereBetween('lft', array($this->lft, $this->rgt));
        $result = $query->get($columns);
        $json = $result->toJson();
        $json = str_ireplace('null', '0', $json);
        return $json;
    }

}
