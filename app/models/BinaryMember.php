<?php

use Baum\Node;

/**
 * BinaryMember
 */
class BinaryMember extends Node {
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'binary_members';
    public $timestamps = false;
    public $fillable = array(
        'member_id'
    );

    public function member() {
        return $this->belongsTo('Member');
    }

    public static function getChildren($parenId = null) {
        $nodes = self::with(array(
                'children',
                'children.member'
            ))->where('parent_id', $parenId)
            ->get();
        $data = array();
        foreach ($nodes as $node) {
            $nodeItem = array(
                'id' => $node->id,
                'member_id' => $node->member_id,
                'text' => $node->member->full_name,
                'children' => $node->children->isEmpty() ? false : true,
            );
            array_push($data, $nodeItem);
        }
        return ($data);
    }

    public static function validateNumberOfChildren($parentId) {
        if (!empty($parentId)) {
            $node = self::find($parentId);
            return $node->children->count() < 2;
        }
        return true;
    }

}
