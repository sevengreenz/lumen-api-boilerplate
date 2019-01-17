<?php

namespace App\Domain;

/**
 * エンティティインターフェース
 *
 * identifier を持っている必要があり、イミュータブルでなければならない
 * idenfifier 以外は変更可能
 */
interface EntityInterface
{
    /**
     * 識別子取得
     */
    public function getIdentifier();
}
