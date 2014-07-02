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
        var_dump('left-leaves ' . $leftLeaves);
        var_dump('right-leaves ' . $rightLeaves);
        var_dump('left-only-left ' . $leftOnlyLeft);
        var_dump('right-only-left ' . $rightOnlyLeft);
        $result = null;
        if ($leftLeaves > 0) {
            //add to leave
            if ($rightOnlyLeft > 0 && $rightOnlyLeft != $leftOnlyLeft) {
                $result['node'] = $availableRight['onlyLeft'][0];
                $result['position'] = 'right';
            } else if ($leftLeaves == $rightLeaves) {
                $result['node'] = $availableLeft['leaves'][0];
                $result['position'] = 'left';
            } else {
                $result['node'] = $availableRight['leaves'][0];
                $result['position'] = 'right';
            }
        } else {
            //add to node that have only children
            if ($rightLeaves > 0) {
                $result['node'] = $availableRight['leaves'][0];
                $result['position'] = 'right';
            } else if ($leftOnlyLeft == $rightOnlyLeft) {
                $result['node'] = $availableLeft['onlyLeft'][0];
                $result['position'] = 'left';
            } else {
                $result['node'] = $availableRight['onlyLeft'][0];
                $result['position'] = 'right';
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
            $leftNode = $node->children->first();
            $rightNode = $node->children->last();
            if ($leftNode->children->count() == $rightNode->children->count()) {
                self::explodeDescendant($leftNode, $availableLeft);
                self::explodeDescendant($rightNode, $availableLeft);
            } else if ($rightNode->children->count() == 1) {
                self::explodeDescendant($rightNode, $availableLeft);
            } else {
                self::explodeDescendant($leftNode, $availableLeft);
                self::explodeDescendant($rightNode, $availableLeft);
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

    public function renderDescendents() {
        
    }

}
